<?php

namespace SenseBook\Http\Controllers\BackOffice;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\User;
use Illuminate\Support\Facades\Auth;
use SenseBook\Models\SaleOrder;
use SenseBook\Models\PreOrder;

use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $date = 'day';
        $date_start ="2018-04-28";
        $date_end = "2018-04-29";
        if ($request->has('date')) {
            $date = $request->get('date');
            if ($date=='day') {
                $date_start = Carbon::today();
                $date_end = Carbon::today();
            } elseif ($date=='week') {
                $date_start = Carbon::today()->startOfWeek();
                $date_end = Carbon::today()->endOfWeek();
            } elseif ($date=='month') {
                $date_start = Carbon::today()->startOfYear();
                $date_end = Carbon::today()->endOfYear();
            }
        } else {
            $date_start = Carbon::today();
            $date_end = Carbon::today();
        }
        $head = $this->head($date_start, $date_end, $date);
        $day = $this->day($date_start->format('l'));
        $date_start1 = $date_start;
        $date_end1 = $date_end;
        $date_start = $date_start->format('Y-m-d')." 00:00:01";
        $date_end = $date_end->format('Y-m-d')." 23:59:59";
        // dd($date_start,$date_end);
        $dashboard = SaleOrder::query()
                ->where('is_preorder', 0)
                ->with('documentDate')
                ->withTrashed()
                ->whereBetween('created_at', [$date_start,$date_end])
                ->get();

        $users = User::withTrashed()->orderBy('created_at', 'DESC')->paginate(10);
        if ($user->type == 'admin') {
            // order last
            $orders = SaleOrder::query()
                ->where('is_preorder', 0)
                ->with('documentDate')
                ->withTrashed()
                ->orderBy('id', 'desc')
                ->paginate(10);

            // dashboard
            $dashboard = SaleOrder::select(
                '*',
                // 'DB::raw("Date(created_at)") as date',
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"),
                DB::raw("DATE_FORMAT(created_at, '%m') as month")
                // DB::raw("SUM(total_price) as SUM_total_price")
            )
                ->with('items')
                ->with('items.product')
                ->with('items.product.category')
                ->where('is_preorder', 0)
                ->with('documentDate')
                ->withTrashed()
                ->whereBetween('created_at', [$date_start,$date_end])
                // ->groupBy(DB::raw("Date(created_at)"))
                // ->groupBy(DB::raw("Date(created_at)"))
                ->get();
                $PreOrder = PreOrder::select()
                            ->where('is_preorder', 0)
                            ->withTrashed()
                            ->get();
            
                // dd($dashboard);
                $dashboard = collect($dashboard);
                $data = $this->data($dashboard, $date, $date_start1, $date_end1);
                $data = json_encode($data);
                $salable = $this->salable($dashboard);
                $catagory = $this->catagory($dashboard);
                // $data = ([100,200]);
                // return [$catagory];
        } else {
            // order last
            $orders = SaleOrder::query()
            ->with('items')
                ->where('user_id', $user->id)
                ->where('is_preorder', 0)
                ->withTrashed()
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
            // dashboard
            $dashboard = SaleOrder::query()
                ->where('user_id', $user->id)
                ->where('is_preorder', 0)
                ->withTrashed()
                ->whereBetween('created_at', [$date_start,$date_end])
                ->get();
                $dashboard = collect($dashboard);
                $data = $this->data($dashboard, $date, $date_start1, $date_end1);
                $data = json_encode($data);
                $salable = $this->salable($dashboard);
                $catagory = $this->catagory($dashboard);
            // $data = $this->data($dashboard,$date,$date_start1,$date_end1);
        }
       
        // return $users;
        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ
        return view(
            'backOffice.dashboard.index',
            compact(
                'users',
                'orders',
                'dashboard',
                'head',
                'date',
                'request',
                'day',
                'data',
                'salable',
                'catagory'
            )
        );
    }
    public function salable($dashboard)
    {
        $list_product = collect([]);
        $dashboard->map(function ($value, $key) use ($list_product) {
            $value->items->map(function ($item, $key_item) use ($list_product) {
                $list_product->push($item);
            });
        });
        $list_product = $list_product->groupBy('product_id');
        // check max
        $max = 0;
        $max_value = collect();
        foreach ($list_product as $key => $value) {
            if (count($value) > $max) {
                $max = count($value);
                $max_value = $value;
            }
        }
        
        return $max_value->first();
    }
    public function catagory($dashboard)
    {
        
        $list_product = collect([]);
        $list_category = collect([]);
        $dashboard->map(function ($value, $key) use ($list_product) {
            $value->items->map(function ($item, $key_item) use ($list_product) {
                $list_product->push($item);
            });
        });
        foreach ($list_product as $key => $value) {
            foreach ($value->product->category as $key1 => $category) {
                $list_category->push($category);
            }
        }
        $list_category = $list_category->groupBy('id');
        // dd($list_product);
        // check max
        $max = 0;
        $max_value = collect();
        foreach ($list_category as $key => $value) {
            if (count($value) > $max) {
                $max = count($value);
                $max_value = $value;
            }
        }
        return $max_value->first();
    }
    public function data($dashboard, $date, $start, $end)
    {
        // $start = Carbon::today()->startOfWeek();
        // $end = Carbon::today()->endOfWeek();
        $collection = $dashboard;
       
        $stack = [];
        if ($date =='day' || $date =="week") {
            $date = $start;
            while ($date <= $end) {
                $date1 = $date->format('Y-m-d');
                $collect =  $collection->filter(function ($value, $key) use ($date1) {
                    if ($value->date==$date1) {
                        return true;
                    }
                });
                if ($collect) {
                    array_push($stack, (int)$collect->sum('total_price'));
                    // array_push($stack,number_format((float)$collect->SUM_total_price, 2, '.', ''));
                } else {
                    array_push($stack, 0);
                }
                
                // if (! $date->isWeekend()) {
                //     $stack[] = $date->copy();
                // }
                $date->addDays(1);
            }
        }
        if ($date =="month") {
            // $test = $collection;
            for ($i=1; $i <= 12; $i++) {
                $collect =  $collection->filter(function ($value, $key) use ($i) {
                    if ($value->month==$i) {
                        return true;
                    }
                });
                array_push($stack, $collect->sum('total_price'));
            }
            
            // dd($stack);
        }
        // dd($stack,
        // $start,
        // $end
        // );
        return $stack;
    }

    public function head($start, $end, $date)
    {
        $result = "";
        $day = $this->day($start->format('l'));
       
        $start = $start->format('Y-m-d');
        $end = $end->format('Y-m-d');
        
        $start = explode('-', $start);
        $end = explode('-', $end);
        $month = $this->month($start[1]);
        
        
        if ($date =='day') {
            $result = $day." : ".$start[2]." ". $month ." ". ($start[0]+543);
        } elseif ($date =='week') {
            $result = $start[2] . " " . $this->submonth($start[1]) . " - ".$end[2]
            . " " . $this->submonth($end[1])." ". ($start[0]+543);
        } elseif ($date =='month') {
            $result = $start[2] . " " . $this->submonth($start[1]) . " - ".$end[2]
            . " " . $this->submonth($end[1])." ". ($start[0]+543);
        }
        return $result;
        // dd($start,
        // $end,
        // $date,
        // $month,
        // $result,
        // $day
        
        // );
    }
    
    public function month($month)
    {
        $text = '';
        if ($month === '01') {
            $text = 'มกราคม';
        } elseif ($month === "02") {
            $text = 'กุมภาพันธ์';
        } elseif ($month === "03") {
            $text = 'มีนาคม';
        } elseif ($month === "04") {
            $text = 'เมษายน';
        } elseif ($month === "05") {
            $text = 'พฤษภาคม';
        } elseif ($month === "06") {
            $text = 'มิถุนายน';
        } elseif ($month === "07") {
            $text = 'กรกฎาคม';
        } elseif ($month === "08") {
            $text = 'สิงหาคม';
        } elseif ($month === "09") {
            $text = 'กันยายน';
        } elseif ($month === "10") {
            $text = 'ตุลาคม';
        } elseif ($month === "11") {
            $text = 'พฤศจิกายน';
        } elseif ($month === "12") {
            $text = 'ธันวาคม';
        } else {
            $text = '';
        }
        return $text;
    }
    public function submonth($month)
    {
        $text = '';
        if ($month === '01') {
            $text = 'ม.ค.';
        } elseif ($month === "02") {
            $text = 'ก.พ.';
        } elseif ($month === "03") {
            $text = 'มี.ค.';
        } elseif ($month === "04") {
            $text = 'เม.ย.';
        } elseif ($month === "05") {
            $text = 'พ.ค.';
        } elseif ($month === "06") {
            $text = 'มิ.ย.';
        } elseif ($month === "07") {
            $text = 'ก.ค.';
        } elseif ($month === "08") {
            $text = 'ส.ค.';
        } elseif ($month === "09") {
            $text = 'ก.ย.';
        } elseif ($month === "10") {
            $text = 'ต.ค.';
        } elseif ($month === "11") {
            $text = 'พ.ย.';
        } elseif ($month === "12") {
            $text = 'ธ.ค.';
        } else {
            $text = '';
        }
        return $text;
    }
    public function day($value)
    {
        $result ="";
        if ($value === "Sunday") {
            $result = 'อาทิตย์';
        } elseif ($value === "Monday") {
            $result = 'จันทร์';
        } elseif ($value === "Tuesday") {
            $result = 'อังคาร';
        } elseif ($value === "Wednesday") {
            $result = 'พุธ';
        } elseif ($value === "Thursday") {
            $result = 'พฤหัสบดี';
        } elseif ($value === "Friday") {
            $result = 'ศุกร์';
        } elseif ($value === "Saturday") {
            $result = 'เสาร์';
        }
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->action('backOffice.dashboard.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.dashboard.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.dashboard.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backOffice.dashboard.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect()->action('backOffice.dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->action('backOffice.dashboard.index');
    }
    
    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        return redirect()->action('backOffice.dashboard.index');
    }
}
