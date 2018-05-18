@extends('layouts.eCommerce.template')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/payment.css')}}"/>
@endsection


@section('body')
    <div class="page_payment">
        <form action="#" method="POST" class="" role="form" id="2c2p-payment-form">

            <div class="container ">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-full">
                        <div class="payment-title">
                            payment
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7 m-full">
                        <div class="panel panel-default credit-card-box">
                            <form role="form" id="payment-form" action="{{ route('payment.store') }}" >
                                {{ csrf_field() }}
                            @include('eCommerce._partial.form_credit_card')

                            <div class="panel-heading display-tran">
                                <div class="row display-tr">
                                    <h3 class="panel-title display-td radio-group">

                                        <input type="radio" id="f-option1" name="paymentWay" value="BANK_TRANSFER">
                                        <label for="f-option1">Transfer Money</label>

                                        <div class="check"></div>

                                        <span class="safemoney">

                      Safe money transfer using your bank account.
                      Visa, maestro, discover, american express.
                    </span>
                                    </h3>
                                    <div class="display-td">

                                        <img class="img-responsive pull-right"
                                             src="{{ asset('images/10_payment/payment-credit.png')}}">
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-offset-1 col-lg-4 m-full">
                        @include('eCommerce._partial.order_detail')
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <div class="clearfix group-btn">
                            <!-- <button type="submit" class="btn btn-primary btn-checkout">ชำระเงิน</button> -->
                            <button class="btn btn-primary btn-checkout" id="submitFrom" type="button">ชำระเงิน</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
@endsection

@section('script')
 <script type="text/javascript" src="{{ config('laravel-2c2p.secure_pay_script') }}"></script>
<script type="application/javascript">

    $('#card-number').prop('required', true);
    $('#card-ccv').prop('required', true);
    $('#card-exp').prop('required', true);

    $('#f-option').click(function () {
        $('#card-number').prop('required', true);
        $('#card-ccv').prop('required', true);
        $('#card-exp').prop('required', true);
        $('#cart-exp-year').prop('required', true);
    });
    $('#f-option1').click(function () {
        $('#card-number').prop('required', false);
        $('#card-ccv').prop('required', false);
        $('#cart-exp-month').prop('required', false);
        $('#cart-exp-year').prop('required', false);
    });
    $('#submitFrom').on('click',function (event) {
        event.preventDefault();
        if($('#f-option').is(':checked')) {
            if($('#card-number').val()==''){
                $('#card_error').html('<p style="color: red;">field is required</p>');
                return
            }
            if($('#card-ccv').val()==''){
                $('#cvc_error').html('<p style="color: red;">field is required</p>');
                return
            }
            if($('#cart-exp-month').val()==''){
                $('#cardExpiryM_error').html('<p style="color: red;">field is required</p>');
                return
            }
            if($('#cart-exp-year').val()==''){
                $('#cardExpiryY_error').html('<p style="color: red;">field is required</p>');
                return
            }
            My2c2p.getEncrypted("2c2p-payment-form", function (encryptedData, errCode, errDesc) {
                console.log(encryptedData);
                console.log(errDesc);
               // $(this).submit();
                if (errCode != 0) {
                    alert(errDesc + " (" + errCode + ")");
                }
                else {
                    var form = document.getElementById("2c2p-payment-form");
                    form.encryptedCardInfo.value = encryptedData.encryptedCardInfo;
                    form.maskedCardInfo.value = encryptedData.maskedCardInfo;
                    form.expMonthCardInfo.value = encryptedData.expMonthCardInfo;
                    form.expYearCardInfo.value = encryptedData.expYearCardInfo;
                    form.submit();
                }
            });
        }else{
            var form = document.getElementById("2c2p-payment-form");
            form.submit();
        }
    });

</script>
@endsection
