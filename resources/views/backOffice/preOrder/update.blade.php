{{--
    @author: Rat Jantaraksa
    @phone: 0837370301
    @email: rat.jantaraksa@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/order/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/easy-autocomplete.min.css') }}">
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-11 pt-2">
                <form action="{{ route('backOffice.pre-order.update', $pre_order->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="PUT">
                    <!-- START panel-->
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading--action">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>
                                        <img src="{{asset('images/backOffice/preOrder/icon-heading.png')}}" alt="" />
                                        <span>Pre Order</span> / Edit
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>ข้อมูลการจัดส่ง</h4>
                                    <div class="row mt-1 mb-3">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="row mb-1">
                                                <div class="col-xs-12 col-sm-3">
                                                    <label class="label-inline">
                                                        ชื่อ
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-9">
                                                    <input type="text" class="form-control" name="full_name" id="full_name" placeholder="ชื่อ - นามสกุล" value="{{ empty(old('full_name')) ? $pre_order->full_name : old('full_name') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-1 mb-3">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="row mb-1">
                                                <div class="col-xs-12 col-sm-3">
                                                    <label class="label-inline">
                                                        สมาชิก
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-9">
                                                    <select class="form-control" name="member_id" id="selectMember">
                                                        <option value="">โปรดเลือกสมาชิก</option>
                                                        @foreach($members as $member)
                                                            <option value="{{ $member->id }}" @if(old('member_id') == $member->id || $pre_order->member_id == $member->id) selected="selected" @endif>{{ $member->full_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="row mb-1">
                                                <div class="col-xs-12 col-sm-3">
                                                    <label class="label-inline">
                                                        รูปแบบการจัดส่ง
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-9">
                                                    <select class="form-control" name="shipping_method_id" required>
                                                        <option value="">โปรดเลือกรูปแบบการจัดส่ง</option>
                                                        @foreach($shippingMethod as $item)
                                                            <option value="{{ $item->id }}" @if(old('shipping_method_id') == $item->id || $pre_order->shipping_method_id == $item->id) selected="selected" @endif>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-3">
                                                    <label class="label-inline">
                                                        Tracking
                                                    </label>
                                                </div>
                                                <div class="col-xs-12 col-sm-9">
                                                    <input type="text" class="form-control" name="tracking" id="tracking" placeholder="Tracking" value="{{ old('tracking', $pre_order->tracking->logistic_tracking_number) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-2">
                                                    <label class="control-label">ที่อยู่</label>
                                                </div>
                                                <div class="col-xs-12 col-md-10">
                                                    <div class="address">
                                                        <input type="hidden" name="shipping_address_line_1" id="shippingAddressLineOne" value="{{ empty(old('shipping_address_line_1')) ? $pre_order->shipping_address_line_1 : old('shipping_address_line_1') }}">
                                                        <input type="hidden" name="shipping_address_line_2" id="shippingAddressLineTwo" value="{{ empty(old('shipping_address_line_2')) ? $pre_order->shipping_address_line_2 : old('shipping_address_line_2') }}">
                                                        <input type="hidden" name="shipping_sub_district_id" id="shippingSubDistrict" value="{{ empty(old('shipping_sub_district_id')) ? $pre_order->shipping_sub_district_id : old('shipping_sub_district_id') }}">
                                                        <input type="hidden" name="shipping_district_id" id="shippingDistrict" value="{{ empty(old('shipping_district_id')) ? $pre_order->shipping_district_id : old('shipping_district_id') }}">
                                                        <input type="hidden" name="shipping_province_id" id="shippingProvince" value="{{ empty(old('shipping_province_id')) ? $pre_order->shipping_province_id : old('shipping_province_id') }}">
                                                        <input type="hidden" name="shipping_postcode_id" id="shippingPostalCode" value="{{ empty(old('shipping_postcode_id')) ? $pre_order->shipping_postcode_id : old('shipping_postcode_id') }}">
                                                        <div id="shippingAddressArea">
                                                            <div class="row pb-15">
                                                                <textarea class="address__block form-control" disabled>{{ $pre_order->shipping_address_line_1 }} {{ $pre_order->shipping_address_line_2 }} {{ $pre_order->shippingSubDistrict->name }} {{ $pre_order->shippingDistrict->name }} {{ $pre_order->shippingProvince->name }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <a href="javascript:void(0);" class="address__block address__block--add form-control addMoreAddress" data-for="shipping" data-toggle="modal" data-target="#addMoreAddress">
                                                                <img src="{{asset('images/backOffice/preOrder/icon-add-lg.png')}}" alt="" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-2">
                                                    <label class="control-label">ที่อยู่ออกบิล</label>
                                                </div>
                                                <div class="col-xs-12 col-md-10">
                                                    <div class="address">
                                                        <input type="hidden" name="billing_address_line_1" id="billingAddressLineOne" value="{{ empty(old('billing_address_line_1')) ? $pre_order->billing_address_line_1 : old('billing_address_line_1') }}">
                                                        <input type="hidden" name="billing_address_line_2" id="billingAddressLineTwo" value="{{ empty(old('billing_address_line_2')) ? $pre_order->billing_address_line_2 : old('billing_address_line_2') }}">
                                                        <input type="hidden" name="billing_sub_district_id" id="billingSubDistrict" value="{{ empty(old('billing_sub_district_id')) ? $pre_order->billing_sub_district_id : old('billing_sub_district_id') }}">
                                                        <input type="hidden" name="billing_district_id" id="billingDistrict" value="{{ empty(old('billing_district_id')) ? $pre_order->billing_district_id : old('billing_district_id') }}">
                                                        <input type="hidden" name="billing_province_id" id="billingProvince" value="{{ empty(old('billing_province_id')) ? $pre_order->billing_province_id : old('billing_province_id') }}">
                                                        <input type="hidden" name="billing_postcode_id" id="billingPostalCode" value="{{ empty(old('billing_postcode_id')) ? $pre_order->billing_postcode_id : old('billing_postcode_id') }}">
                                                        <div id="billingAddressArea">
                                                            <div class="row pb-15">
                                                                <textarea class="address__block form-control" disabled>{{ $pre_order->billing_address_line_1 }} {{ $pre_order->billing_address_line_2 }} {{ $pre_order->billingSubDistrict->name }} {{ $pre_order->billingDistrict->name }} {{ $pre_order->billingProvince->name }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <a href="javascript:void(0);" class="address__block address__block--add form-control addMoreAddress" data-for="billing" data-toggle="modal" data-target="#addMoreAddress">
                                                                <img src="{{asset('images/backOffice/preOrder/icon-add-lg.png')}}" alt="" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-xs-12 col-md-6">

                                            <div class="row mb-3">
                                                <div class="col-xs-12 col-md-3">
                                                    <label class="inline">รายละเอียด</label>
                                                </div>
                                                <div class="col-xs-12 col-md-9">
                                                    <textarea class="form-control" name="description" placeholder="รายละเอียด">{{ empty(old('description')) ? $pre_order->description : old('description') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-xs-12 col-md-3">
                                                    <label class="inline">สถานะออเดอร์</label>
                                                </div>
                                                <div class="col-xs-12 col-md-9">
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="">โปรดเลือกสถานะออเดอร์</option>
                                                        @foreach($orderStatus as $item)
                                                            <option value="{{ $item['key'] }}" @if($pre_order->status == $item['key'] || old('status') == $item['key']) selected="selected" @endif>{{ $item['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row mb-3">
                                                <div class="col-xs-12 col-md-3">
                                                    <label class="inline">วันที่จัดส่งสินค้า</label>
                                                </div>
                                                <div class="col-xs-12 col-md-9">

                                                    <div class="input-group delivery_date">
                                                        <input type="text" value=""  class="form-control" name="delivery_date" id="date" placeholder="วันที่จัดส่งสินค้า">
                                                        <span class="input-group-addon bg-white">
                                                        <img src="{{asset('images/backOffice/preOrder/icon-calendar.png')}}" alt="" />
                                                    </span>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-xs-12 col-md-3">
                                                    <label class="inline">วิธีชำระเงิน</label>
                                                </div>
                                                <div class="col-xs-12 col-md-9">
                                                    <select name="payment_method" class="form-control">
                                                        <option value="">โปรดเลือกวิธีชำระเงิน</option>
                                                        @foreach($paymentMethod as $item)
                                                            <option value="{{ $item['key'] }}" @if(old('payment_method') == $item['key'] || $pre_order->payment_method == $item['key']) selected="selected" @endif>{{ $item['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-xs-12 mb-1">
                                                    <label class="inline">ประวัติการชำระเงิน</label>
                                                </div>
                                                <div class="col-xs-12 mb-3">
                                                    <div class="paid">

                                                        {{--<div class="paid__history gradient">
                                                            <a href="#">
                                                                <img src="{{asset('images/backOffice/preOrder/icon-paid.png')}}" alt="" />
                                                            <p>ราคา <span class="paid__price">50.-</span></p>
                                                            </a>
                                                        </div>

                                                        <div class="paid__history gradient selected">
                                                        <a href="#">
                                                            <img src="{{asset('images/backOffice/preOrder/icon-paid.png')}}" alt="" />
                                                            <p>ราคา <span class="paid__price">300.-</span></p>
                                                            </a>
                                                        </div>

                                                        <div class="paid__history gradient paid__history--add">
                                                        <a href="#">
                                                            <img src="{{asset('images/backOffice/preOrder/icon-add-lg.png')}}" alt="" />
                                                        </a>

                                                        </div>--}}

                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="col-xs-12 col-md-6">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="product">
                                                        <div class="product__heading">
                                                            <h5 class="text-bold">สินค้า</h5>
                                                        </div>
                                                        <div class="product__heading">
                                                            <div class="row">
                                                                <div class="addProductSection">
                                                                    <div class="col-md-1">
                                                                        <label class="label-inline">
                                                                            สินค้า
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control input-sm" name="product_add" id="product_add" value="{{ old('product_add') }}" placeholder="เลือกสินค้า" data-action="typeaheadProduct">
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="label-inline">
                                                                            จำนวน
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control input-sm" name="product_add_qty" id="product_add_qty" placeholder="จำนวน" value="{{ old('product_add_qty') }}">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="addProductList">เพิ่มสินค้า</a>
                                                                        {{--<input type="submit" class="btn btn-primary btn-sm" value="เพิ่มสินค้า">--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product__body">
                                                            <ul class="product__list" id="productItemList">
                                                                @foreach($pre_order->items as $item)
                                                                    <li class="item">
                                                                        <a href="javascript:void(0)">
                                                                            <div class="item-image">
                                                                                <img class="img-responsive" src="{{ getImage(($imgCover = $item->product->imageCover) ? $imgCover->image : '') }}" alt="" />
                                                                            </div>
                                                                            <div class="item-detail">
                                                                        <span class="item-detail__name">
                                                                            {{ $item->product->name }}
                                                                        </span>
                                                                                <input type="text" name="products[]" value="{{ $item->product_id }}" hidden>
                                                                                <input type="text" name="products_qty[]" value="{{ $item->quantity }}" hidden>
                                                                                <span class="item-detail__quantity">
                                                                            จำนวน {{ $item->quantity }} เล่ม
                                                                        </span>
                                                                                <span class="item-detail__point text-grey">
                                                                            PTS {{ number_format($item->point_per_unit, 0) }} คะแนนสะสม
                                                                        </span>
                                                                            </div>
                                                                            <div class="item-price text-center">
                                                                                <span class="text-grey">ราคา</span>
                                                                                <span class="text-red">{{ number_format($item->price_per_unit, 2) }} บาท</span>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                @endforeach

                                                                @if(empty($pre_order->items))
                                                                    <li class="item noItemInOrder">
                                                                        <span>ยังไม่มีสินค้าในออเดอร์รายการนี้</span>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>

                                                        <div class="product__footer">

                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <div class="calculate text-right">
                                                                        <div class="calculate__text">
                                                                            ราคารวม
                                                                        </div>
                                                                        <div class="calculate__price text-grey">
                                                                            {{--<input type="text" name="price_before_discount" id="price_before_discount" value="{{ old('price_before_discount', 0) }}" hidden>--}}
                                                                            <span id="price_before_discount">{{ number_format($pre_order->price_before_discount, 2) }}</span> บาท
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12">
                                                                    <div class="calculate text-right">
                                                                        <div class="calculate__text">
                                                                            ส่วนลด
                                                                        </div>
                                                                        <div class="calculate__price text-grey">
                                                                            {{--<input type="text" name="discount" id="discount" value="{{ old('discount', 0) }}" hidden>--}}
                                                                            <span id="discount">{{ number_format($pre_order->discount, 2) }}</span> บาท
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12">
                                                                    <div class="calculate text-right">
                                                                        <div class="calculate__text">
                                                                            ค่าขนส่ง
                                                                        </div>
                                                                        <div class="calculate__price text-grey">
                                                                            {{--<input type="text" name="shipping_free" id="shipping_free" value="{{ old('shipping_free', 0) }}" hidden>--}}
                                                                            <span id="shipping_free">{{ number_format($pre_order->shipping_free, 2) }}</span> บาท
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12">
                                                                    <div class="calculate calculate--total text-right">
                                                                        <div class="calculate__text">
                                                                            รวมสุทธิ
                                                                        </div>
                                                                        <div class="calculate__price text-red">
                                                                            {{--<input type="text" name="total_price" value="{{ old('total_price', 0) }}" hidden>--}}
                                                                            <span id="total_price">{{ number_format($pre_order->total_price, 2) }}</span> บาท
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 text-center mt-3">

                                    <button class="btn btn-primary btn-md" type="submit" name="save">Save</button>

                                    <a href="{{ route('backOffice.pre-order.index') }}" class="btn btn-secondary btn-md">Cancel</a>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- END panel-->

                </form>
                <div id="addMoreAddress" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" id="addressMemberID">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">เพิ่มที่อยู่ใหม่</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">ที่อยู่ <small>(บรรทัดแรก)</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="address_line_1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">ที่อยู่ <small>(บรรทัดรอง)</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="address_line_2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">รหัสไปรษณีย์</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="addresses" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="col-md-3 control-label">ตำบล</span>
                                        <div class="col-md-9">
                                            <div class="form-group row" style="margin-bottom: 0 !important;">
                                                <div class="col-md-5 address-span">
                                                    <span id="sub_district_span"></span>
                                                    <input type="hidden" name="sub_district_id" class="form-control" id="sub_district_id">
                                                </div>
                                                <label for="inputValue" class="col-md-2 control-label">อำเภอ</label>
                                                <div class="col-md-5 address-span">
                                                    <span id="district_span"></span>
                                                    <input type="hidden" name="district_id" class="form-control" id="district_id">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="col-md-3 control-label">จังหวัด</span>
                                        <div class="col-md-9">
                                            <div class="form-group row" style="margin-bottom: 0 !important;">
                                                <div class="col-md-5 address-span">
                                                    <span id="province_span"></span>
                                                    <input type="hidden" name="province_id" class="form-control" id="province_id">
                                                </div>
                                                <div class="col-md-4 address-span">
                                                    <input type="hidden" name="postal_code_id" class="form-control" id="postal_code_id">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" id="btnAddAddress" style="color: #fff; background-color: #8a1330; border-color: #731028;">บันทึก</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection

@section('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script src="{{ asset('js/common/jquery.easy-autocomplete.min.js') }}"></script>
    <script src="{{ asset('js/plugins/typeahead.js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/backOffice/preOrder/update.js') }}"></script>


    <script type="text/javascript">
        $(function () {

            var deliveryDate = {!! json_encode($delivery_date) !!};

            $('.delivery_date').datetimepicker({
                date: new Date(deliveryDate),
                format: 'DD/MM/YYYY'
            });

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "3000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            @if(session()->has('success'))
                toastr["success"]("{{ session()->get('success') }}", "Success");
            @elseif(session()->has('failure'))
                toastr["warning"]("{{ session()->get('failure') }}", "Warning");
            @endif
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                toastr["error"]("{{ $error }}", "Error");
            @endforeach
            @endif
        });
    </script>
@endsection
