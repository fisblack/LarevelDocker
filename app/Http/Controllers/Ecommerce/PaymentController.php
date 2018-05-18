<?php

namespace SenseBook\Http\Controllers\Ecommerce;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\Address;
use SenseBook\Models\Date;
use SenseBook\Models\DeliveryTrackingItem;
use SenseBook\Models\PaymentItem;
use SenseBook\Models\SaleOrder;
use SenseBook\Traits\SaleOrderItemsTrait;
use SenseBook\User;
use SenseBook\Models\ShippingFee;
use SenseBook\Models\ShippingType;
use Payment2C2P;

class PaymentController extends Controller
{
    use SaleOrderItemsTrait;

    const PAYMENT_BANK_TRANSFER = 'BANK_TRANSFER';
    const PAYMENT_CREDIT_CARD = 'CREDIT_CARD';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * Missing data redirect to index page
         */
        if (!$request->session()->has('cart_checkout') || empty($request->session()->get('cart_checkout'))) {
            return redirect()->route('index');
        }
        $user = Auth::user();

        if (is_null($user)) {
            $request->session()->put('back', 'payment');
            return redirect()->route('login');
        }

        $carts = $request->session()->get('cart_checkout');
        /**
         * shipping
         */
        $shipping_name = "";
        $shipping_type_id = $request->session()->get('shipping_type_id');
        if ($request->session()->has('shipping_type_id') && !empty($shipping_type_id)) {
            $shipping = ShippingFee::find($shipping_type_id);
            if ($shipping) {
                $shipping_type = ShippingType::find($shipping->type_id);
                if ($shipping_type) {
                    $shipping_name = $shipping_type->name;
                }
            }
        }

        return view('eCommerce.payment.index')
            ->with([
                'shipping_name' => $shipping_name,
                'products' => $carts['products'],
                'total_price' => $carts['total_price'],
                'total_reward_point' => $carts['total_reward_point'],
                'total_weight' => $carts['total_weight'],
                'usePromotion' =>  $carts['usePromotion'],
                'discount_price' =>  $carts['discount_price'],
                'discount_point' =>  $carts['discount_point'],
                'discount_id' =>  $carts['discount_id'],
                'shipping_time' =>  $this->thaiDate(strtotime("now"))." ถึง ".$this->thaiDate(strtotime("+1 week")),
            ]);
    }

    public function thaiDate($time)
    {
        $thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
        $thai_month_arr=array(
            "0"=>"",
            "1"=>"มกราคม",
            "2"=>"กุมภาพันธ์",
            "3"=>"มีนาคม",
            "4"=>"เมษายน",
            "5"=>"พฤษภาคม",
            "6"=>"มิถุนายน",
            "7"=>"กรกฎาคม",
            "8"=>"สิงหาคม",
            "9"=>"กันยายน",
            "10"=>"ตุลาคม",
            "11"=>"พฤศจิกายน",
            "12"=>"ธันวาคม"
        );

        $thai_date_return = "วัน".$thai_day_arr[date("w", $time)];
        $thai_date_return .= "ที่ ".date("j", $time);
        $thai_date_return .= " เดือน".$thai_month_arr[date("n", $time)];
        $thai_date_return .= " พ.ศ.".(date("Y", $time)+543);
        return $thai_date_return;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        if ($request->has('paymentWay') && !empty($request->get('paymentWay'))) {
            $authUser = Auth::user();

            $user = User::find($authUser->id);

            $paymentWay = $request->get('paymentWay');

            if (empty($paymentWay)) {
                return redirect()->route('payment.index');
            }

            $products = $request->session()->get('cart_checkout')['products'];
            $total_price = $request->session()->get('cart_checkout')['total_price'];


            if (empty($products) || empty($total_price)) {
                return redirect()->route('index');
            }


            $billingAddressId = $request->session()->get('billing_address_id');
            $shippingAddressId = $request->session()->get('shipping_address_id');

            if (empty($billingAddressId) || empty($shippingAddressId)) {
                return redirect()->route('shipping.index');
            }

            $billingAddress = Address::find($billingAddressId);
            $shippingAddress = Address::find($shippingAddressId);


            if ($paymentWay === self::PAYMENT_CREDIT_CARD) {
                // TODO charge card
                $payload = \Payment2C2P::paymentRequest([
                'desc' => '2 book for testing',
                'uniqueTransactionCode' => "Invoice".time(),
                'amt' => $total_price,
                'currencyCode' => config('laravel-2c2p.currency_code'),
                'cardholderName' => 'Card holder Name',
                'cardholderEmail' => 'email@emailcom',
                'panCountry' => 'TH',
                'encCardData' => $request->input('encryptedCardInfo'), // Retrieve encrypted credit card data
                'userDefined1' => 'userDefined1',
                'userDefined2' => 'userDefined2'
                ]);
                return view('website.app2c2p.prepare')->with(compact('payload'));
            } else {
                try {
                    $currentDate = Carbon::now();
                    $date = new Date();
                    $date->fill([
                        'date' => $currentDate->day,
                        'day' => $currentDate->format('l'),
                        'day_of_week' => $currentDate->dayOfWeek,
                        'month' => $currentDate->month,
                        'quarter' => $currentDate->quarter,
                        'year' => $currentDate->year,
                        'month_name' => $currentDate->format('F'),
                        'quarter_name' => 'quarter_name'
                    ]);
                    $date->save();

                    $order = new SaleOrder();

                    $order->fill([
                        'user_id' => $authUser->id,
                        'member_id' => $authUser->id,
                        'full_name' => $user->full_name,
                        'document_date_id' => $date->id,
                        'billing_address_line_1' => $billingAddress->address_line_1,
                        'billing_address_line_2' => $billingAddress->address_line_2,
                        'billing_sub_district_id' => $billingAddress->sub_district_id,
                        'billing_district_id' => $billingAddress->district_id,
                        'billing_province_id' => $billingAddress->province_id,
                        'billing_postcode_id' => $billingAddress->postal_code_id,
                        'shipping_address_line_1' => $shippingAddress->address_line_1,
                        'shipping_address_line_2' => $shippingAddress->address_line_2,
                        'shipping_sub_district_id' => $shippingAddress->sub_district_id,
                        'shipping_district_id' => $shippingAddress->district_id,
                        'shipping_province_id' => $shippingAddress->province_id,
                        'shipping_postcode_id' => $shippingAddress->postal_code_id,
                        'delivery_date_id' => $date->id, // TODO fix to document_date
                        'is_preorder' => false, // TODO
                        'is_paid' => false, // TODO
                        'shipping_method_id' => 1, // TODO
                        'payment_method' => 'money_transfer',
                        'point_redemption_id' => 1, // TODO
                        'point_accural_id' => 1, // TODO
                        'price_before_discount' => 0,
                        'shipping_fee' => 0,
                        'discount' => 0,
                        'total_price' => $total_price
                    ]);

                    if ($order->save()) {
                        $this->saveOrderItemFromProduct($order, $products);
//                        /**
//                         * Create tracking
//                         */
//                        $tracking = new DeliveryTrackingItem();
//                        $tracking->sales_order_id = $order->id;
//                        $tracking->save();
//
//                        /**
//                         * Create
//                         */
//                        $payment = new PaymentItem();
//                        $payment->sales_order_id = $order->id;
//                        $payment->save();
                        /**
                         * Clear session
                         */
                        $request->session()->forget([
                            'cart_checkout',
                            'billing_address_id',
                            'shipping_address_id',
                            'cart'
                        ]);
                        /**
                         * Put order_in into session
                         */
                        $request->session()->put([
                            'sale_order_id' => $order->id
                        ]);
                        return redirect()->route('thank-you.index');
                    }
                } catch (\Exception $e) {
                    return redirect()->route('index');
                }
            }
        }
        return redirect()->route('payment.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
