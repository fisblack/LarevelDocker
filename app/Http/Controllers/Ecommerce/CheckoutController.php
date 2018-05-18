<?php

namespace SenseBook\Http\Controllers\Ecommerce;

use Carbon\Carbon;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\Point;
use SenseBook\Models\Product;
use SenseBook\Models\Promotion;
use SenseBook\User;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if (is_null($user)) {
            $request->session()->put('back', 'checkout');
            return redirect()->route('login');
        }

        $cart = $request->session()->get('cart');

        if (!$request->session()->has('cart') || empty($cart)) {
            $request->session()->flash('empty-cart', 'Missing books');
            return redirect()->route('index');
        } else {
            $bookIds = collect([]);
            foreach ($cart as $key => $book) {
                $bookIds->put($key, $book['book_id']);
            }
            $products = Product::whereIn('id', $bookIds->toArray())
                ->with('writer')
                ->get();

            if ($products && !empty($cart)) {
                foreach ($cart as $item) {
                    $products = $products->map(function ($product) use ($item) {
                        if ($product->id === intval($item['book_id'])) {
                            $product->qty = intval($item['qty']);
                            $product->total_price = $product->qty * $product->suggested_member_price;
                        }
                        return $product;
                    });
                }
            }
        }

        $discount_price = 0;
        $discount_id = $request->session()->get('discount_id');
        if ($request->session()->has('discount_id') && !empty($discount_id)) {
            $point = Point::find($discount_id);
            if ($point) {
                $discount_price = $point->discount;
            }
        }

        $totalPrice = $products->sum('total_price');

        $points = Point::all();

        $user = User::find($user->id)->first();

        /**
         * Calculate promotion
         */
        $canUserPromotion = collect([]);

        $promotion = Promotion::all();

        $dateOfBirthday = $user->dateOfBirth()->first();

        $currentDate = Carbon::now();

        $testOnly = false; // TODO remove me

        $promotion->each(function ($item) use ($user, $dateOfBirthday, $currentDate, &$canUserPromotion, $testOnly) {
            /**
             * birth day
             */
            if (($dateOfBirthday->date === $currentDate->day) &&
                ($dateOfBirthday->month === $currentDate->month) || $testOnly) {
                $canUserPromotion->push([
                    'name' => 'วันเกิดรับส่วนลด '.intval($item->birthday_discount).' '.
                        ($item->birthday_discount_unit == "percent" ? '%' : 'บาท'),
                    'key_name' => 'DATE_OF_BIRTHDAY',
                    'discount_type' => $item->birthday_discount_unit,
                    'discount_value' => intval($item->birthday_discount),
                ]);
            }
            /**
             * In month of birth day
             */
            if ($dateOfBirthday->month === $currentDate->month || $testOnly) {
                $canUserPromotion->push([
                    'name' => 'เดือนเกิดรับส่วนลด '.intval($item->birthday_month_discount).' '.
                        ($item->birthday_month_discount_unit == "percent" ? '%' : 'บาท'),
                    'key_name' => 'MONTH_OF_BIRTHDAY',
                    'discount_type' => $item->birthday_month_discount_unit,
                    'discount_value' => intval($item->birthday_month_discount)
                ]);
            }
            /**
             * On second tuesday of this month
             */
            if (Carbon::parse("second tuesday of this month")->eq($currentDate) || $testOnly) {
                $canUserPromotion->push([
                    'name' => 'อังคารที่ 2 ของทุกเดือน รับส่วนลด',
                    'key_name' => 'SECOND_TUESDAY',
                    'discount_type' => $item->second_tuesday_discount_unit,
                    'discount_value' => intval($item->second_tuesday_discount)
                ]);
            }

            /**
             * Double Point
             */
            $st = Carbon::parse($item->double_point_start_date);

            $end = Carbon::parse($item->double_point_end_date);

            if ($currentDate->between($st, $end) || $testOnly) {
                $canUserPromotion->push([
                    'name' => 'Double Point',
                    'key_name' => 'DOUBLE_POINT'
                ]);
            }
        });

        $data = [
            'products' => $products,
            'total_price' => $totalPrice,
            'points' => $points,
            'discount_price' => $discount_price,
            'discount_id' => $discount_id,
            'total_price_after_discount' => $totalPrice - $discount_price,
            'promotions' => $canUserPromotion,
            'point_balance' => $user->points_balance
        ];
        return view('eCommerce.checkout.index')
            ->with($data);
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
        if ($request->has('products_id') && $request->has('products_qty') &&
            $request->get('form_name') ==='checkout') {
            $requestProducts = collect([]);

            $requestQty = $request->get('products_qty');

            foreach ($request->get('products_id') as $key => $productId) {
                $requestProducts->put($productId, $requestQty[$key]);
            }

            $products = Product::whereIn('id', $request->get('products_id'))
                ->with('writer')
                ->get();

            if ($products && !empty($requestProducts)) {
                foreach ($requestProducts as $productId => $qty) {
                    $products = $products->map(function ($product) use ($productId, $qty) {

                        if ($product->id === intval($productId)) {
                            $product->qty = intval($qty);
                            $product->total_price = $product->qty * $product->suggested_member_price;
                            $product->total_point += (!empty($product->reward_points)) ? $product->reward_points : 0;
                            $product->total_weight += (!empty($product->weight) && !$product->is_free_shipping == 1) ?
                                $product->weight : 0;
                        }
                        return $product;
                    });
                }
            }

            //promotion
            print_r($request->get('promotion'));

            /**
             * Calculate promotion
             */
            $user = Auth::user();
            $user = User::find($user->id)->first();

            $usePromotion = collect([]);
            $promotion = Promotion::all();
            $dateOfBirthday = $user->dateOfBirth()->first();
            $testOnly = false; // TODO remove me
            $promotion->each(function ($item) use ($user, $dateOfBirthday, &$usePromotion, $testOnly, $request) {
                /**
                 * birth day
                 */
                if ($request->get('promotion') == 'DATE_OF_BIRTHDAY') {
                    $usePromotion->push([
                        'name' => 'วันเกิดรับส่วนลด '.intval($item->birthday_discount).' '.
                            ($item->birthday_discount_unit == "percent" ? '%' : 'บาท'),
                        'key_name' => 'DATE_OF_BIRTHDAY',
                        'discount_type' => $item->birthday_discount_unit,
                        'discount_value' => intval($item->birthday_discount),
                    ]);
                }
                /**
                 * In month of birth day
                 */
                if ($request->get('promotion') == 'MONTH_OF_BIRTHDAY') {
                    $usePromotion->push([
                        'name' => 'เดือนเกิดรับส่วนลด '.intval($item->birthday_month_discount).' '.
                            ($item->birthday_month_discount_unit == "percent" ? '%' : 'บาท'),
                        'key_name' => 'MONTH_OF_BIRTHDAY',
                        'discount_type' => $item->birthday_month_discount_unit,
                        'discount_value' => intval($item->birthday_month_discount)
                    ]);
                }
                /**
                 * On second tuesday of this month
                 */
                if ($request->get('promotion') == 'SECOND_TUESDAY') {
                    $usePromotion->push([
                        'name' => 'อังคารที่ 2 ของทุกเดือน รับส่วนลด',
                        'key_name' => 'SECOND_TUESDAY',
                        'discount_type' => $item->second_tuesday_discount_unit,
                        'discount_value' => intval($item->second_tuesday_discount)
                    ]);
                }

                /**
                 * Double Point
                 */
                if ($request->get('promotion') == 'DOUBLE_POINT') {
                    $usePromotion->push([
                        'name' => 'Double Point',
                        'key_name' => 'DOUBLE_POINT'
                    ]);
                }
            });

            /**
             * Point discount
             */
            $discount_price = 0;
            $discount_point = 0;
            $discount_id = $request->session()->get('discount_id');
            if ($request->session()->has('discount_id') && !empty($discount_id)) {
                $point = Point::find($discount_id);
                if ($point) {
                    $discount_price = $point->discount;
                    $discount_point = $point->points;
                }
            }

            $request->session()->put('cart_checkout', [
                'products' => $products,
                'total_price' => $products->sum('total_price'),
                'total_reward_point' => $products->sum('total_point'),
                'total_weight' => $products->sum('total_weight'),
                'usePromotion' => $usePromotion,
                'discount_price' => $discount_price,
                'discount_point' => $discount_point,
                'discount_id' => $discount_id,
            ]);

            return redirect()->route('shipping.index');
        }
        /**
         * Apply point
         */
        if ($request->has('discount_id') && !empty($request->get('discount_id')) &&
            $request->get('form_name') ==='point') {
            $point = Point::find($request->get('discount_id'));
            if ($point) {
                $request->session()->put([
                    'discount_id' => $point->id,
                    'discount_price' => $point->discount
                ]);
            }
        }
        /**
         * Cancel used point
         */
        if ($request->get('form_name') === 'point_cancel') {
            $request->session()->forget(['discount_id', 'discount_price']);
        }

        return redirect()->route('checkout.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('checkout.show');
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
