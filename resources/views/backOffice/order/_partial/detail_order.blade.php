<div class="records__item {{ (!is_null($order->deleted_at)) ? 'records__item--delete' : ''}}">
    <div class="records__check">
        <input type="checkbox" name="row[]" value="1" id="row_1">
    </div>
    <div class="records__detail">

        <div class="img hidden-xs">
            <img src="{{asset('images/backOffice/preOrder/user-1.jpg')}}" alt="Name" />
        </div>

        <div class="order">
            <div class="order__detail">
                <div class="order__id">
                    <span>Order: </span>
                    #{{ $order->id }}
                </div>
                <div class="order__date">
                    <span>Date: {{ $order->documentDate->date}}/{{$order->documentDate->month}}/{{ $order->documentDate->year + 543  }}</span>
                </div>
                <div class="order__name">
                    <span>Name: {{ $order->full_name }}</span>
                </div>
            </div>
            <div class="order__tag">

                <div class="status">
                    <span class="status__name">การชำระเงิน</span>
                    @if($order->is_paid)
                        <span class="status__badge status__badge--success">ชำระเงินแล้ว</span>
                    @else
                        <span class="status__badge">ยังไม่ได้ชำระเงิน</span>
                    @endif
                </div>

                <div class="status">
                    <span class="status__name">การจัดส่ง</span>
                    @if($order->status === 'paid_unshipped' || $order->status === 'unpaid')
                        <span class="status__badge">ยังไม่ได้จัดส่ง</span>
                    @endif
                    @if($order->status === 'paid_shipping')
                        <span class="status__badge status__badge--warning">เตรียมการจัดส่ง</span>
                    @endif
                    @if($order->status === 'paid_shipped')
                        <span class="status__badge status__badge--success">จัดส่งแล้ว</span>
                    @endif
                </div>


            </div>
        </div>

    </div>
    <div class="records__action">
        <div class="records__action-left">
            <a href="{{ route('backOffice.order.edit', $order->id) }}" class="edit">
                <img src="{{asset('images/backOffice/preOrder/icon-edit.png')}}" alt="Edit"/>
            </a>
            <button class="delete" onclick="deleteOrder({{ $order->id }})">
                <img src="{{asset('images/backOffice/preOrder/icon-delete.png')}}" alt="Delete"/>
            </button>
        </div>
        <div class="records__action-right">
            <a href="{{ route('backOffice.order.print', $order->id) }}" class="report">
                <img src="{{asset('images/backOffice/order/report.png')}}" alt="Report"/>
            </a>

            <button class="refresh" onclick="restoreOrder({{ $order->id }})">
                <img src="{{asset('images/backOffice/preOrder/icon-refresh.png')}}" alt="Refresh"/>
            </button>
            <button class="refresh" onclick="deleteOrder({{ $order->id }})">
                <img src="{{asset('images/backOffice/report/report.png')}}" alt="Delete"/>
            </button>
        </div>

    </div>
</div>
