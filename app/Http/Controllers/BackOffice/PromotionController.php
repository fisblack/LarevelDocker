<?php

namespace SenseBook\Http\Controllers\BackOffice;

use SenseBook\Http\Controllers\Controller;
use Redirect;
use Request;
use Response;
use Session;
use Validator;
use View;

use SenseBook\Models\Product;
use SenseBook\Models\Promotion;
use SenseBook\Models\PromotionVolumePurchase;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ

        $product = Product::whereHas('productType', function ($query) {
            $query->whereIn('key', ['new_release', 'best_seller']);
        })->first();

        $promotion = Promotion::first();

        if (is_null($promotion)) {
            $promotion = (object) [
                'birthday_discount'=>'',
                'birthday_discount_unit' => '',
                'birthday_month_discount' => '',
                'birthday_month_discount_unit' => '',
                'second_tuesday_discount' => '',
                'second_tuesday_discount_unit' => '',
                'free_shipping_amount_condition' => '',
                'free_shipping_weight_condition' => '',
                'date_from' => '',
                'date_to' => '',
            ];
        }

        $volumePurchase = PromotionVolumePurchase::all()->toArray();

        return view('backOffice.promotion.index')
            ->with('product', $product)
            ->with('item', $promotion)
            ->with('promotion', $volumePurchase);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = Request::except('_token');
       
       
        // process the validation
        $validator = Validator::make($data, [
            'birthday_discount'                 => 'nullable|numeric|min:0',
            'birthday_discount_unit'            => 'nullable|string|in:thb,percent',
            'birthday_month_discount'           => 'nullable|numeric|min:0',
            'birthday_month_discount_unit'      => 'nullable|string|in:thb,percent',
            'second_tuesday_discount'           => 'nullable|numeric|min:0',
            'second_tuesday_discount_unit'      => 'nullable|string|in:thb,percent',
            'free_shipping_amount_condition'    => 'nullable|numeric|min:0',
            'free_shipping_weight_condition'    => 'nullable|numeric|min:0',
            'double_point_start_date' => 'nullable|date_format:d/m/Y',
            'double_point_end_date'   => 'nullable|date_format:d/m/Y|after_or_equal:double_point_start_date',
            'volume_purchase'                   => 'array',
            'volume_purchase.*'                 => 'nullable|int',
            'volume_purchase_benefits'          => 'array',
            'volume_purchase_benefits.*'        => 'nullable|int',
        ]);
   
        if ($validator->fails()) {
            echo 'no';
            return back()
                ->with('warning', 'Can\'t Edit Data')
                ->withInput();
        }

        $date = str_replace('/', '-', $data['double_point_start_date']);
        $data['double_point_start_date']=date('Y-m-d', strtotime($date));

        $date = str_replace('/', '-', $data['double_point_end_date']);
        $data['double_point_end_date']=date('Y-m-d', strtotime($date));

        // store
        try {
            Promotion::query()->truncate();
            $result = Promotion::create([
                'birthday_discount'                 => number_format($data['birthday_discount'], 3, '.', ''),
                'birthday_discount_unit'            => trim($data['birthday_discount_unit']),
                'birthday_month_discount'           => number_format($data['birthday_month_discount'], 3, '.', ''),
                'birthday_month_discount_unit'      => trim($data['birthday_month_discount_unit']),
                'second_tuesday_discount'           => number_format($data['second_tuesday_discount'], 3, '.', ''),
                'second_tuesday_discount_unit'      => trim($data['second_tuesday_discount_unit']),
                'free_shipping_amount_condition'    => intval($data['free_shipping_amount_condition']),
                'free_shipping_weight_condition'    => intval($data['free_shipping_weight_condition']),
                'double_point_start_date'           => trim($data['double_point_start_date']),
                'double_point_end_date'             => trim($data['double_point_end_date']),
            ]);
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\'t Edit Data 2')
                ->withInput();
            // dd($e->getMessage());
        }

        $volumePurchase=[];
        for ($i=0; $i<sizeof($data['volume_purchase']); $i++) {
            $volumePurchase[$i]=[
                'volume_purchase'           => $data['volume_purchase'][$i],
                'volume_purchase_benefits'  => $data['volume_purchase_benefits'][$i],
            ];
        }

        $insertData = array_slice($volumePurchase, 0, -1);

        // store
        try {
            PromotionVolumePurchase::query()->truncate();
            $result = PromotionVolumePurchase::insert($insertData);
        } catch (\Exception $e) {
            // return back()
            //     ->with('warning', 'Can\'t Edit Data')
            //     ->withInput();
            dd($e->getMessage());
        }

        return redirect()
                ->route('backOffice.promotion.index')
                ->with('success', 'Create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.promotion.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.promotion.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backOffice.promotion.update');
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
        return redirect()->action('backOffice.promotion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->action('backOffice.promotion.index');
    }

    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        return redirect()->action('backOffice.promotion.index');
    }
}
