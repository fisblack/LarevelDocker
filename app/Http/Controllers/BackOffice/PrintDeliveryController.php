<?php

namespace SenseBook\Http\Controllers\BackOffice;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SenseBook\Models\SaleOrder;
use Carbon\Carbon;
use DB;

class PrintDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date_now = Carbon::today();
        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ
        
        return view('backOffice.printDelivery.index', compact('date_now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('backOffice.printDelivery.print');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->action('backOffice.printDelivery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        
        $user = Auth::user();
        $check = false;
        if ($request->has('date')) {
            $date = $request->get('date');
            $date = explode('/', $date);
            if (count($date)==3) {
                $date = $date[2].'-'.$date[1].'-'.$date[0];
            } else {
                $date = Carbon::today()->format('Y-m-d');
            }
        } else {
            $date = Carbon::today()->format('Y-m-d');
        }
            $date_start = $date." 00:00:01";
            $date_end = $date." 23:59:59";
        
        $orders = SaleOrder::select(
            'dim_sale_orders.*',
            'dim_users.phone',
            DB::raw("DATE_FORMAT(dim_sale_orders.created_at, '%Y-%m-%d') as date")
            // DB::raw("DATE_FORMAT(dim_sale_orders.created_at, '%m') as month"),
            // 'provinces.name'
        )
            ->leftJoin('dim_users', 'dim_users.id', 'dim_sale_orders.member_id')
            ->with('shippingProvince')
            ->with('shippingDistrict')
            ->with('items')
            ->with('items.product.imageCover')
            ->with('items.product')
            ->with('shippingSubDistrict')
            ->with('shippingPostCode')
            ->where('is_preorder', 0)
            ->with('documentDate')
            ->withTrashed()
            ->orderBy('dim_sale_orders.id', 'DESC')
            ->get();
            $orders_outstanding = $orders;
        if ($id=="all") {
            //ทั้งหมดที่ค้างส่ง
            $orders = $orders_outstanding->filter(function ($item) {
                return $item->status =='paid_unshipped' || $item->status =='unpaid';
            });
        } else {
            if ($request->has('check')) {
                // วันที่เลือก
                $orders = $orders->filter(function ($item) use ($date) {
                    return $item->date == $date;
                });
                // ยังไม่จัดส่ง
                $orders_outstanding = $orders_outstanding->filter(function ($item) {
                    return $item->status =='paid_unshipped' || $item->status =='unpaid';
                });
                // ไม่ใช้วันที่เลือก
                $orders_outstanding = $orders_outstanding->filter(function ($item) use ($date) {
                    return $item->date != $date;
                });
                $orders_outstanding->map(function ($item) use ($orders) {
                    $orders->push($item);
                });
            } else {
                $orders = $orders->filter(function ($item) use ($date) {
                    return $item->date == $date;
                });
                // $orders = $orders
                // ->whereBetween('created_at', [$date_start,$date_end]);
            }
        }

        // return $orders;
        
        
        return view('backOffice.printDelivery.show', compact('id', 'orders'));
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.printDelivery.print1')->withId($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backOffice.printDelivery.update');
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
        return redirect()->action('backOffice.printDelivery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->action('backOffice.printDelivery.index');
    }
    
    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        return redirect()->action('backOffice.printDelivery.index');
    }
}
