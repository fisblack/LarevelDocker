<?php

namespace SenseBook\Http\Controllers\BackOffice;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Http\Requests\Backoffice\SaleOrderRequest;
use SenseBook\Models\Date;
use SenseBook\Models\DeliveryTrackingItem;
use SenseBook\Models\PaymentItem;
use SenseBook\Models\SaleOrder;
use SenseBook\Models\ShippingType;
use SenseBook\Scopes\SaleOrderScope;
use SenseBook\Traits\SaleOrderItemsTrait;
use SenseBook\User;

class PreOrderController extends Controller
{
    use SaleOrderItemsTrait;
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

        if ($user->type == 'admin') {
            $pre_orders = SaleOrder::withoutGlobalScope(SaleOrderScope::class)
                // ->query()
                ->where('is_preorder', 1)
                ->with('documentDate')
                ->withTrashed()
                ->search($request)
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $pre_orders = SaleOrder::withoutGlobalScope(SaleOrderScope::class)
                // ->query()
                ->where('user_id', $user->id)
                ->where('is_preorder', 1)
                ->withTrashed()
                ->search($request)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        return view('backOffice.preOrder.index', compact('pre_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $members = User::query()->where('type', 'member')->get();

        $shippingMethod = ShippingType::all();

        $orderStatus = $this->orderStatus;
        $paymentMethod = $this->paymentMethod;

        return view('backOffice.preOrder.create')
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
        $pre_order = new SaleOrder();

        $pre_order->fill($request->all());

        $pre_order->delivery_date_id = $deliveryDate->id;
        $pre_order->document_date_id = $documentDate->id;
        $pre_order->price_before_discount = 0;
        $pre_order->shipping_fee = 0;
        $pre_order->discount = 0;
        $pre_order->total_price = 0;
        $pre_order->is_preorder = 1;
        $pre_order->user_id = Auth::user()->id;

        if ($pre_order->save()) {
            $this->saveOrderLineItems(
                $pre_order,
                $request->get('products'),
                $request->get('products_qty')
            );

            /**
             * Create tracking
             */
            if ($request->has('tracking') && !empty($request->get('tracking'))) {
                $tracking = new DeliveryTrackingItem();
                $tracking->sales_order_id = $pre_order->id;
                $tracking->logistic_tracking_number = $request->get('tracking');
                $tracking->save();
            }

            /**
             * Create
             */
            if ($request->has('payment') && !empty($request->get('payment'))) {
                $payment = new PaymentItem();
                $payment->sales_order_id = $pre_order->id;
                $payment->save();
            }
        }
        return redirect()->route('backOffice.pre-order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.preOrder.show');
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

        return view('backOffice.preOrder.print')
            ->with(compact([
                'order',
            ]));
    }

    /**
     * @param SaleOrder $pre_order
     * @return $this
     */
    public function edit(SaleOrder $pre_order)
    {

        $pre_order->load([
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

        $members = User::query()->where('type', 'member')->get();

        $shippingMethod = ShippingType::all();

        $orderStatus = $this->orderStatus;

        $paymentMethod = $this->paymentMethod;

        $dateString = "{$pre_order->deliveryDate->year}-{$pre_order->deliveryDate->month}";
        $dateString .= "-{$pre_order->deliveryDate->date}";
        $delivery_date = Carbon::parse($dateString)->format('Y-m-d');

        return view('backOffice.preOrder.update')
            ->with(compact([
                'members',
                'shippingMethod',
                'orderStatus',
                'paymentMethod',
                'pre_order',
                'delivery_date'
            ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleOrderRequest $request, SaleOrder $pre_order)
    {

        $pre_order->fill($request->toArray());
        $pre_order->save();

        $deliveryDate = Date::find($pre_order->delivery_date_id);

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

        if ($pre_order->save()) {
            $this->saveOrderLineItems(
                $pre_order,
                $request->get('products'),
                $request->get('products_qty')
            );
        }

        \Session::flash('success', 'Update successful!');

        return redirect()->route('backOffice.pre-order.edit', $pre_order->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pre_order = SaleOrder::withTrashed()->where('id', $id)->first();
        try {
            if ($pre_order) {
                if (!$pre_order->trashed()) {
                    $pre_order->items()->delete();
                    $pre_order->delete();
                    \Session::flash('success', " Delete Success ");
                } else {
                    $pre_order->items()->forceDelete();
                    $pre_order->forceDelete();
                    \Session::flash('success', "Force Delete Success");
                }
            } else {
                \Session::flash('failure', "Data not found");
                return redirect()->route('backOffice.pre-order.index');
            }
        } catch (Exception $e) {
            \Session::flash('error', "Something went wrong, please try again.");
            return redirect()->route('backOffice.pre-order.index');
        }
        return redirect()->route('backOffice.pre-order.index');
    }

    /**
     * Restore the specified resource back to storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $pre_order = SaleOrder::withTrashed()->where('id', $id)->first();

        if ($pre_order && $pre_order->trashed()) {
            $pre_order->items()->restore();
            $pre_order->restore();
            \Session::flash('success', "Restored Success");
        }
        return redirect()->route('backOffice.pre-order.index');
    }
}
