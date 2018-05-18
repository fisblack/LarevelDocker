@extends('layouts.eCommerce.template')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/eCommerce/checkout.css')}}"/>
@endsection

@section('body')

    <div class="page_checkout">
        <div class="container continer-width-cart">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="title">
                        Checkout
                    </div>
                </div>
            </div>
            {{--<div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <button type="button" class="btn btn-add-product">Add Product</button>
              </div>
            </div>--}}
        </div>

        <form action="{{ route('checkout.store') }}" method="post" class="clearfix">
            {{ csrf_field() }}
            <div class="container continer-width-cart">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 m-full-right">

                        @foreach($products as $product)
                            @include('eCommerce.checkout._partial.item_cart_detail')
                        @endforeach

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 m-full-left">

                        <div class="group-point clearfix">
                            <form class="form-point clearfix" action="{{ route('checkout.store') }}" method="post">
                                {{ csrf_field() }}
                                <div class="group-title">
                                  <span class="point-title">
                                    คุณมีแต้มสะสม <b>{{$point_balance}}</b> แต้ม
                                  </span>
                                </div>
                                @if($point_balance > 0)
                                    @foreach($points as $point)
                                        @if($point->points <= $point_balance)
                                        <div class="group-radio-point ">
                                            @if($point->id === $discount_id)
                                                <input type="radio" id="f-option-{{$point->id}}" name="discount_id" value="{{ $point->id }}" checked>
                                            @else
                                                <input type="radio" id="f-option-{{$point->id}}" name="discount_id" value="{{ $point->id }}">
                                            @endif
                                            <label for="f-option-{{$point->id}}">
                                                {{ number_format($point->points) }} แต้ม แลกได้ {{ number_format($point->discount) }} บาท
                                            </label>
                                            <div class="check"></div>
                                        </div>
                                        @endif
                                    @endforeach
                                    <div class="group-use-point clearfix">
                                        <button class="btn btn-use" type="submit" name="form_name" value="point">ใช้แต้ม</button>
                                        <button class="btn btn-cancel" type="submit" name="form_name" value="point_cancel">ไม่ใช้แต้ม</button>
                                    </div>
                                @else
                                    <div class="group-use-point clearfix">
                                        <lable style="font-size: large;">มีแต้มไม่พอให้แลกได้</lable>
                                    </div>
                                @endif
                            </form>
                            @if($promotions && count($promotions) > 0)
                                <div class="group-title">
                                  <span class="point-title">
                                    Promotion
                                  </span>
                                </div>
                                @foreach($promotions as $promotion)
                                    <div class="group-radio-point ">
                                        <input type="radio" id="f-option-{{ $promotion['key_name'] }}" name="promotion" value="{{ $promotion['key_name'] }}">
                                        <label for="f-option-{{ $promotion['key_name']  }}">
                                            {{ $promotion['name'] }}
                                        </label>
                                        <div class="check"></div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 total">
                        <h5>
                            <b>
                                Total
                            </b>

                        </h5>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-5 total-detail">
                        @if($discount_id)
                            <s class="">{{ number_format($total_price) }} บาท</s>
                            <br>
                            <p class="">ใช้แต้มแลก {{ number_format($discount_price) }} บาท คงเหลือยอดค้างชำระ {{ number_format($total_price_after_discount) }} บาท</p>
                            <br>
                        @endif
                        <h5><b>{{ number_format($total_price_after_discount) }} บาท</b></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="group-btn-checkout text-center">
                            <button class="btn btn-checkout-next" type="submit" name="form_name" value="checkout">
                                ถัดไป
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>
@endsection

@section('script')
    <script src="{{ asset('js/eCommerce/checkout/index.js') }}"></script>

    <script>
        $(".qty").bind("keypress", function (evt) {
            var charCode = (evt.which) ? evt.which : window.event.keyCode;
            if (charCode <= 10) {
                return true;
            } else {
                var keyChar = String.fromCharCode(charCode);
                var re = /[1-9]/;
                return re.test(keyChar);
            }
        });

        $('.plus').click(function () {
            var plus = 1;
            var _self = $(this);
            var _parent = $(this).closest('.base-input')


            if (parseInt(_parent.find('input').val()) < 0) {
                return false;
            } else {
                var current = parseInt(_parent.find('input').val())
                var new_current = current + plus;
                _parent.find('input').val(new_current)
            }

        })


        $('.minus').click(function () {
            var plus = 1;
            var _self = $(this);
            var _parent = $(this).closest('.base-input')

            if (parseInt(_parent.find('input').val()) <= 1) {

                return false;
            } else {
                var current = parseInt(_parent.find('input').val())
                var new_current = current - plus;
                _parent.find('input').val(new_current)
            }
        })

        @if(session()->has('success'))
            toastr["success"]("{{ session()->get('success') }}", "Success");
        @elseif(session()->has('failure'))
            toastr["warning"]("{{ session()->get('failure') }}", "Warning");
        @elseif(session()->has('empty-cart'))
            toastr["error"]("{{ session()->get('error') }}", "Error");
        setTimeout(function () {
            window.location.replace('/');
        }, 1500);
        @endif

                @if ($errors->any())
                @foreach ($errors->all() as $error)
            toastr["error"]("{{ $error }}", "Error");
        @endforeach
        @endif

        updateProductsListCart();

    </script>
@endsection
