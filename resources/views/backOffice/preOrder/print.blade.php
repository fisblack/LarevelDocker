{{-- 
    @author: Rat Jantaraksa
    @phone: 0837370301
    @email: rat.jantaraksa@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/preOrder/print.css') }}">
@endsection

@section('body')       
    {{-- <div class="container-fluid"> --}}

	<div class="container-back">
	<div class="order">
	<div class="padding">
	<div class="bg shadow radius">
	<div class="header underline">
	<div class="page-name float-left">
	<div class="icon float-left">
	<img src="{{ asset('images/backOffice/order/order.png') }}">
	</div>
	<div class="text float-left txt">
	Pre Order <span>/ Print</span>
	</div>
	</div>
	</div>
	<div class="content">
	<div class="row">
	<div class="col-xs-12  col-xs-offset-0  col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3  ">
	<div class="border">
	<div class="top">
	<div class="print">
	<img src="{{ asset('images/backOffice/order/logo.png') }}">
	</div>
	</div>
	<div class="address">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<h4>กรุณาส่ง</h4>
	<div class="body">
	<span>คุณ  {{ $order->full_name }}</span><br>
	{{ $order->shipping_address_line_1 }} {{ $order->shipping_address_line_2 }} </br>
 {{ $order->shippingSubDistrict->name }} {{ $order->shippingDistrict->name }} </br>
 {{ $order->shippingProvince->name }} {{ $order->shippingPostCode->code}}
	{{-- 44/187 ซอยคู้บอน 27 แยก 22 <br>
	ถนนรามอินทรา แขวงท่าแร้ง เขตบางเขน<br>
	กทม 10220<br> --}}
	<br>
	<div class="barcode">
	{{-- <img src="{{ asset('images/backOffice/order/barcode.png') }}"> --}}
	<img src="{{'data:image/png;base64,'.DNS1D::getBarcodePNG($order->id, 'C128','3','50')}}" alt="barcode"/>
	<div class="txt">
	<span class="red">Order:</span>#{{$order->id}}
	</div>
	</div>
	</div>
	</div>
	</div>
	<div class="clear">
	</div>
	</div>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="form-group text-center hidden-print">
	<button type="button" class=" btn btn-red radius" onclick="window.print()">Print</button>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>






    {{-- </div> --}}
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/preOrder/create.js') }}"></script>
@endsection