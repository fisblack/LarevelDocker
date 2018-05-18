<?php

namespace SenseBook\Http\Controllers\Ecommerce;

use Illuminate\Support\Facades\Auth;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\Address;
use SenseBook\Models\ShippingType;
use SenseBook\User;

class ShippingController extends Controller
{
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
        } else {
            // TODO check has products in cart_checkout[products]
        }

        $user = Auth::user();

        if (is_null($user)) {
            $request->session()->put('back', 'shipping');
            return redirect()->route('login');
        }

        $user = User::find($user->id);

        $address = $user->addresses()
            ->with([
                'subDistrict',
                'district',
                'province',
                'postalCode'
            ])
            ->get();

        $requiredBilling = 0;

        /**
         * Find shipping address
         */
        if ($request->session()->has('shipping_address_id') &&
            !empty($request->session()->get('shipping_address_id'))
        ) {
            $shippingId = intval($request->session()->get('shipping_address_id'));
        } else {
            $shippingId = $user->shipping_address_id;
            $request->session()->put('shipping_address_id', $shippingId);
        }

        /**
         * Find billing address
         */
        if ($request->session()->has('billing_address_id') && !empty($request->session()->get('billing_address_id'))) {
            $billingId = intval($request->session()->get('billing_address_id'));
        } else {
            $billingId = $user->billing_address_id;
            $request->session()->put('billing_address_id', $billingId);
        }

        /**
         * Enable billing
         */
        if ($request->session()->has('billing_required') && !empty($request->session()->get('billing_required'))) {
            $requiredBilling = intval($request->session()->get('billing_required'));
        }


        $address = $address->map(function ($item) {
            $item->address = $item->fullAddress();
            return $item;
        });


        $carts = $request->session()->get('cart_checkout');
        /**
         * Calculate price of shipping base on local
         */
        $currentAddressShipping = Address::find($shippingId);
        $shippings = ShippingType::with('items')->get();

        //ref : http://xn--o3caff9akb7dta7bd7d0jubm.blogspot.com/2014/11/blog-post.html
        $convert_postcode_to_region = array(
            1 => 4,
            2 => 5,
            3 => 2,
            4 => 2,
            5 => 1,
            6 => 1,
            7 => 3,
            8 => 6,
            9 => 6
        );

        $shippings = $shippings->filter(function ($shipping)
 use ($currentAddressShipping, $carts, $convert_postcode_to_region) {
            $shippingItems = $shipping->items->filter(function ($item)
 use ($currentAddressShipping, $carts, $convert_postcode_to_region) {
                    return (
                        $item->minimum_weight >= $carts['total_weight'] &&
                        $item->maximum_weight <= $carts['total_weight']
                    );
            });
            return $shippingItems;
        });

        $user_region = $convert_postcode_to_region[substr($currentAddressShipping->postalCode->code, 0, 1)];
        return view('eCommerce.shipping.index')
            ->with([
                'address' => $address,
                'user' => $user,
                'products' => $carts['products'],
                'total_price' => $carts['total_price'],
                'total_reward_point' => $carts['total_reward_point'],
                'total_weight' => $carts['total_weight'],
                'shipping_address_id' => $shippingId,
                'billing_address_id' => $billingId,
                'billing_required' => $requiredBilling,
                'shippings' => $shippings,
                'user_region' => $user_region,
                'usePromotion' =>  $carts['usePromotion'],
                'discount_price' =>  $carts['discount_price'],
                'discount_point' =>  $carts['discount_point'],
                'discount_id' =>  $carts['discount_id'],
                'shipping_time' =>  $this->thaiDate(strtotime("now"))." ถึง ".
                    $this->thaiDate(strtotime("+1 week")),
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
        $thai_date_return="วัน".$thai_day_arr[date("w", $time)];
        $thai_date_return.= "ที่ ".date("j", $time);
        $thai_date_return.=" เดือน".$thai_month_arr[date("n", $time)];
        $thai_date_return.= " พ.ศ.".(date("Y", $time)+543);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $defineKey = collect([
            'shipping_address_id',
            'billing_address_id',
            'shipping_type_id',
            'shipping_price_point_choose',
        ]);

        $defineKey->each(function ($key) use ($request) {
            if ($request->has($key)) {
                $request->session()->put($key, $request->get($key));
            }
        });

        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createAnotherAddress(Request $request)
    {
        $user = Auth::user();

        $anotherAddress = collect([
            'full_name',
            'address_line_1',
            'address_line_2',
            'postal_code_id',
            'postal_code',
            'sub_district_id',
            'sub_district',
            'district_id',
            'district',
            'province_id',
            'province',
            'phone'
        ]);

        $anotherShippingAddress = [];

        $anotherAddress->each(function ($key) use ($request, &$anotherShippingAddress) {
            if ($request->has($key)) {
                $anotherShippingAddress = array_add($anotherShippingAddress, $key, $request->get($key));
            }
        });

        $anotherShippingAddress['user_id'] = $user->id;
        $address = new Address();
        $address->fill($anotherShippingAddress);

        if ($address->save()) {
            $request->session()->put([
                'shipping_address_id' => $address->id,
                'billing_address_id' => $address->id,
            ]);
        }

        return redirect()->route('shipping.index');
    }
}
