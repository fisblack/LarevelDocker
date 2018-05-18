{{--
<li class="gradient ">
    <div class="select float-left">
        <input type="checkbox" name="" value="">
    </div>
    <div class="data float-left">
        <div class="profile-img float-left">
            <div class="image-cropper">
                <img src="{{ asset('images/backOffice/order/member2.png') }}">
            </div>
        </div>
        <div class="info float-left">
            <div class="text">
                <div class="col col-1 ">
                    <div><span>Order</span>#{{ $order->id }}</div>
                    <div><span>Name</span>{{ $order->full_name }}</div>
                </div>
                <div class="col col-2 ">
                    <div>
                        <span>Date</span>
                        {{$order->documentDate->date}}/{{$order->documentDate->month}}/{{ $order->documentDate->year + 543 }}
                    </div>
                </div>

            </div>
            <div class="clear"></div>
            <div class="status">
                <div class="box payment">
                    <div class="status__name">การชำระเงิน</div>
                    @if($order->is_paid)
                        <span class="status__badge status__badge--success">ชำระเงินแล้ว</span>
                    @else
                        <span class="status__badge">ยังไม่ได้ชำระเงิน</span>
                    @endif
                </div>
                <div class="box sent ">
                    <div class="topic">การจัดส่ง</div>
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
                <div class="box tracking hide">
                    <div class="topic">เลข Tracking</div>
                    <span class="red">123468794031TH</span>
                </div>
            </div>
        </div>
    </div>
    <div class="print float-right">
        <img class="btn-print" src="{{ asset('images/backOffice/order/print.png') }}">
        <img class="btn-undo" src="{{ asset('images/backOffice/order/undo.png') }}">
    </div>
    <div class="btn-action float-right">
        <div class="edit radius">
            <a href="{{ route('backOffice.order.edit', $order->id) }}">
                <img src="{{ asset('images/backOffice/order/edit.png') }}">
            </a>
        </div>
        <div class="delete radius">
            <a href="javascript:void(0)" onclick="deleteOrder({{ $order->id }})">
                <img src="{{ asset('images/backOffice/order/delete2.png') }}">
            </a>
        </div>
    </div>

</li>
--}}
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
            <a href="{{ route('backOffice.pre-order.edit', $order->id) }}" class="edit">
                <img src="{{asset('images/backOffice/preOrder/icon-edit.png')}}" alt="Edit"/>
            </a>
            <button class="delete" onclick="deleteOrder({{ $order->id }})">
                <img src="{{asset('images/backOffice/preOrder/icon-delete.png')}}" alt="Delete"/>
            </button>
        </div>
        <div class="records__action-right">
            <a href="{{ route('backOffice.pre-order.print', $order->id) }}" class="print">
                <img src="{{asset('images/backOffice/preOrder/report.png')}}" alt="Print"/>
            </a>
            <button class="refresh" onclick="restoreOrder({{ $order->id }})">
                <img src="{{asset('images/backOffice/preOrder/icon-refresh.png')}}" alt="Refresh"/>
            </button>
            <button class="refresh" onclick="deleteOrder({{ $order->id }})">
                <img src="{{asset('images/backOffice/preOrder/icon-delete.png')}}" alt="Delete"/>
            </button>
        </div>

    </div>
</div>
