<?php

namespace SenseBook\Http\Controllers\BackOffice;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Http\Requests\Backoffice\SaleOrderRequest;
use SenseBook\Http\Requests\BackOffice\ShippingPriceRequest;
use SenseBook\Models\Date;
use SenseBook\Models\DeliveryTrackingItem;
use SenseBook\Models\PaymentItem;
use SenseBook\Models\Product;
use SenseBook\Models\SaleOrder;
use SenseBook\Models\ShippingType;
use SenseBook\Traits\HandleShippingPriceTrait;
use SenseBook\Traits\OrderableTrait;
use SenseBook\Traits\SaleOrderItemsTrait;
use SenseBook\User;

class OrderController extends Controller
{
    use SaleOrderItemsTrait, OrderableTrait, HandleShippingPriceTrait;
    /**
     * @var array
     */
    protected $orderStatus = [
        [
            'key' => 'unpaid',
            'name' => 'ยังไม่ได้ชำระเงิน',
        ],
        [
            'key' => 'paid_unshipped',
            'name' => 'ยังไม่ได้จัดส่ง',
        ],
        [
            'key' => 'paid_shipping',
            'name' => 'เตรียมการจัดส่ง',
        ],
        [
            'key' => 'paid_shipped',
            'name' => 'จัดส่งแล้ว',
        ]
    ];
    /**
     * @var array
     */
    protected $paymentMethod = [
        [
            'key' => 'money_transfer',
            'name' => 'โอนเงินผ่านบัญชีธนาคาร'
        ],
        [
            'key' => 'credit_card',
            'name' => 'เครดิตการ์ด'
        ]

    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // TODO fix search can found pre-order when stay on order page

        if ($user->type == 'admin') {
            $orders = SaleOrder::query()
                ->where('is_preorder', 0)
                ->with('documentDate')
                ->withTrashed()
                ->search($request)
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $orders = SaleOrder::query()
                ->where('user_id', $user->id)
                ->where('is_preorder', 0)
                ->withTrashed()
                ->search($request)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        return view('backOffice.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $members = User::all();

        $shippingMethod = ShippingType::all();

        $orderStatus = $this->orderStatus;
        $paymentMethod = $this->paymentMethod;

        return view('backOffice.order.create')
            ->with(compact(['members', 'shippingMethod', 'orderStatus', 'paymentMethod']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \SenseBook\Http\Requests\Backoffice\SaleOrderRequest
     * @return \Illuminate\Http\Response
     */
    public function store(SaleOrderRequest $request)
    {
        /**
         * Create delivery date
         */

        $delivery = Carbon::parse($request->get('delivery_date'));

        $deliveryDate = new Date();

        $deliveryDate->fill([
            'date' => $delivery->day,
            'day' => $delivery->format('l'),
            'day_of_week' => $delivery->dayOfWeek,
            'month' => $delivery->month,
            'quarter' => $delivery->quarter,
            'year' => $delivery->year,
            'month_name' => $delivery->format('F'),
            'quarter_name' => 'quarter_name'
        ]);
        $deliveryDate->save();

        /**
         * Create document Date
         */
        $document = Carbon::now();

        $documentDate = new Date();

        $documentDate->fill([
            'date' => $document->day,
            'day' => $document->format('l'),
            'day_of_week' => $document->dayOfWeek,
            'month' => $document->month,
            'quarter' => $document->quarter,
            'year' => $document->year,
            'month_name' => $document->format('F'),
            'quarter_name' => 'quarter_name'
        ]);
        $documentDate->save();

        /**
         * Order
         */
        $order = new SaleOrder();

        $order->fill($request->all());

        $order->delivery_date_id = $deliveryDate->id;
        $order->document_date_id = $documentDate->id;
        $order->price_before_discount = 0;
        $order->shipping_fee = 0;
        $order->discount = 0;
        $order->total_price = 0;

        if ($order->save()) {
            $this->saveOrderLineItems(
                $order,
                $request->get('products'),
                $request->get('products_qty')
            );
            /**
             * Create tracking
             */
            if ($request->has('tracking') && !empty($request->get('tracking'))) {
                $tracking = new DeliveryTrackingItem();
                $tracking->sales_order_id = $order->id;
                $tracking->logistic_tracking_number = $request->get('tracking');
                $tracking->save();
            }

            /**
             * Create
             */
            if ($request->has('payment') && !empty($request->get('payment'))) {
                $payment = new PaymentItem();
                $payment->sales_order_id = $order->id;
                $payment->save();
            }
        }
        return redirect()->route('backOffice.order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.order.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $order = SaleOrder::findOrFail($id);

        return view('backOffice.order.print')
            ->with(compact([
                'order',
            ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleOrder $order)
    {

        $order->load([
            'items',
            'items.product',
            'shippingProvince',
            'shippingDistrict',
            'shippingSubDistrict',
            'shippingPostCode',
            'billingProvince',
            'billingDistrict',
            'billingSubDistrict',
            'billingPostCode',
            'deliveryDate'
        ]);

        $members = User::all();

        $shippingMethod = ShippingType::all();

        $orderStatus = $this->orderStatus;

        $paymentMethod = $this->paymentMethod;

        $dateString = "{$order->deliveryDate->year}-{$order->deliveryDate->month}-{$order->deliveryDate->date}";
        $delivery_date = Carbon::parse($dateString)->format('Y-m-d');

        return view('backOffice.order.update')
            ->with(compact(['members', 'shippingMethod', 'orderStatus', 'paymentMethod', 'order', 'delivery_date']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleOrderRequest $request, SaleOrder $order)
    {

        $deliveryDate = Date::find($order->delivery_date_id);

        if ($deliveryDate) {
            $delivery = Carbon::createFromFormat('d/m/Y', $request->get('delivery_date'));
            $deliveryDate->fill([
                'date' => $delivery->day,
                'day' => $delivery->format('l'),
                'day_of_week' => $delivery->dayOfWeek,
                'month' => $delivery->month,
                'quarter' => $delivery->quarter,
                'year' => $delivery->year,
                'month_name' => $delivery->format('F'),
                'quarter_name' => 'quarter_name'
            ]);
            $deliveryDate->save();
        }

        $order->fill($request->toArray());

        if ($request->has('user_id')) {
            $userId = (is_numeric($request->get('user_id'))) ? $request->get('user_id') : null;
        } else {
            $userId = null;
        }

        if ($request->has('member_id')) {
            $memberId = (is_numeric($request->get('member_id'))) ? $request->get('member_id') : null;
        } else {
            $memberId = null;
        }

        $order->user_id = $userId;
        $order->member_id = $memberId;

        if ($order->save()) {
            $this->saveOrderLineItems(
                $order,
                $request->get('products'),
                $request->get('products_qty')
            );
        }

        \Session::flash('success', 'Update successful!');

        return redirect()->route('backOffice.order.edit', $order->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = SaleOrder::withTrashed()->where('id', $id)->first();
        try {
            if ($order) {
                if (!$order->trashed()) {
                    $order->items()->delete();
                    $order->delete();
                    \Session::flash('success', " Delete Success ");
                } else {
                    $order->items()->forceDelete();
                    $order->forceDelete();
                    \Session::flash('success', "Force Delete Success");
                }
            } else {
                \Session::flash('failure', "Data not found");
                return redirect()->route('backOffice.order.index');
            }
        } catch (Exception $e) {
            \Session::flash('error', "Something went wrong, please try again.");
            return redirect()->route('backOffice.order.index');
        }
        return redirect()->route('backOffice.order.index');
    }

    /**
     * Restore the specified resource back to storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $order = SaleOrder::withTrashed()->where('id', $id)->first();

        if ($order && $order->trashed()) {
            $order->items()->restore();
            $order->restore();
            \Session::flash('success', "Restored Success");
        }
        return redirect()->route('backOffice.order.index');
    }

    public function shippingPrice(ShippingPriceRequest $request)
    {
        $productsRequest = collect($request->get('products'));

        $products = Product::whereIn('id', $productsRequest->pluck('id'))->get();

        if ($products) {
            $productsRequest->each(function ($p) use (&$products) {
                $products = $products->map(function ($product) use ($p) {
                    if (intval($p['id']) === $product->id) {
                        $product->qty = intval($p['qty']);
                    }
                    return $product;
                });
            });
            $regionId = $request->get('region_id');
            $typeId = $request->get('type_id');
            $totalWeight = $this->totalWeight($products);
            return response()->json([
                'shipping_fee' => $this->calculateShippingPrice($typeId, $regionId, $totalWeight),
                'weight' => $totalWeight,
                'type_id' => $typeId,
                'region_id' => $regionId
            ]);
        }
        return 0;
    }
}
