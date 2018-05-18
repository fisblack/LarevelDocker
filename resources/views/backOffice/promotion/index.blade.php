{{--
    @author: Chanikarn Thavornwong
    @phone: 0909737246
    @email: ploid.t@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/backOffice/promotion/index.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Kanit:100,300,400" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
@endsection

@section('body')
    <div class="container-fluid backoffice-promotion-index">
    	<div class="panel panel-default">
    		<div class="section-header">
    			<img src="{{ asset('images/backOffice/promotion/header-icon-promotion.png')}}">
    			<span class="pagination-previous">Promotion</span>
    			<span class="pagination-now"></span>
    		</div>

    		 <div class="section-body">
          		<form action="{{ route('backOffice.promotion.store') }}" method="post">
          			<div class="information">
          				<div class="row">
	          				<div class="col-sm-4">
	          					<label class="control-label col-sm-5">วันเกิดรับส่วนลด</label>
	          					<div class="input col-sm-7">
	          						<input type="text" name="birthday_discount" class="half" value="{!! number_format( $item->birthday_discount , 2 ) !!}">
	          						<select class="form-control" name="birthday_discount_unit">
	          							<option @if ($item->birthday_discount_unit=='thb')selected="selected"@endif value="thb">บาท</option>
	          							<option @if ($item->birthday_discount_unit=='percent')selected="selected"@endif value="percent">%</option>
	          						</select>
	          					</div>
	          				</div>
	          			</div>
	          			<!-- end div row -->

	          			<div class="row">
	          				<div class="col-sm-4">
	          					<label class="control-label col-sm-5">เดือนเกิดรับส่วนลด</label>
	          					<div class="input col-sm-7">
	          						<input type="text" name="birthday_month_discount" class="half" value="{!! number_format( $item->birthday_month_discount , 2 ) !!}">
	          						<select class="form-control" name="birthday_month_discount_unit">
	          							<option @if ($item->birthday_month_discount_unit=='thb')selected="selected"@endif value="thb">บาท</option>
	          							<option @if ($item->birthday_month_discount_unit=='percent')selected="selected"@endif value="percent">%</option>
	          						</select>
	          					</div>
	          				</div>
	          			</div>
	          			<!-- end div row -->

	          			<div class="row">
	          				<div class="col-sm-4">
	          					<label class="control-label col-sm-5">อังคารที่ 2 ของทุกเดือน รับส่วนลด</label>
	          					<div class="input col-sm-7">
	          						<input type="text" name="second_tuesday_discount" class="half" value="{!! number_format( $item->second_tuesday_discount , 2 )  !!}">
	          						<select name="second_tuesday_discount_unit" class="form-control">
	          							<option @if ($item->second_tuesday_discount_unit=='thb')selected="selected"@endif value="thb">บาท</option>
										<option @if ($item->second_tuesday_discount_unit=='percent')selected="selected"@endif value="percent">%</option>
	          						</select>
	          					</div>
	          				</div>
	          				<div class="col-sm-4">
	          					<div class="col-sm-12">
	          						<p>ซื้อและทำการโอนเงินภายในวันเท่านั้น ถ้าไม่โอนเงินภายในวันที่กำหนด ระบบจะทำการยกเลิก ORDER ทันที</p>
	          					</div>

	          				</div>
	          			</div>
	          			<!-- end div row -->

						@for ($i = 0; $i < sizeof($promotion); $i++)
						@php $promo=$promotion[$i] @endphp
	          			<div class="row" id="promoVolume_{{ $i+1 }}">
	          				<div class="col-sm-4">
	          					<label class="control-label col-sm-5">ซื้อครบจำนวน</label>
	          					<div class="input col-sm-7">
	          						<input type="text" name="volume_purchase[]" class="half" value="{!! $promo['volume_purchase'] !!}">
	          						<span>เล่ม</span>
	          					</div>
	          				</div>
	          				<div class="col-sm-4">
	          					<label class="control-label col-sm-3">แถมหนังสือ</label>
	          					<div class="input col-sm-9">
	          						<input type="number" name="volume_purchase_benefits[]" class="half" value="{!! $promo['volume_purchase_benefits'] !!}">
	          						<span>เล่ม</span>
	          					</div>
	          				</div>
	          			</div>
						@endfor
						<div class="row" id="promoVolume_{{ sizeof($promotion)+1 }}">
	          				<div class="col-sm-4">
	          					<label class="control-label col-sm-5">ซื้อครบจำนวน</label>
	          					<div class="input col-sm-7">
	          						<input type="text" name="volume_purchase[]" id="credit" class="half" value="">
	          						<span>เล่ม</span>
	          					</div>
	          				</div>
	          				<div class="col-sm-4">
	          					<label class="control-label col-sm-3">แถมหนังสือ</label>
	          					<div class="input col-sm-9">
	          						<input type="number" name="volume_purchase_benefits[]" id="gift" class="half" value="">
	          						<span>เล่ม</span>
	          					</div>
	          				</div>
	          			</div>
	          			<!-- end div row -->

	          			<div class="row">
	          				<div class="col-sm-4">
	          					<label class="control-label col-sm-5">ซื้อครบ</label>
	          					<div class="input col-sm-7">
	          						<input type="text" name="free_shipping_amount_condition" class="half" value="{!! number_format( $item->free_shipping_amount_condition , 2 ) !!}">
	          						<span>บาท</span>
	          					</div>
	          				</div>
	          				<div class="col-sm-4">
	          					<label class="control-label col-sm-3">น้ำหนักไม่เกิน</label>
	          					<div class="input col-sm-7">
	          						<input type="text" name="free_shipping_weight_condition" class="half" value="{!! $item->free_shipping_weight_condition !!}">
	          						<span>กิโลกรัม</span>
	          					</div>
	          				</div>
	          				<div class="col-sm-4">
	          					<label class="control-label col-xs-3 col-sm-2">ได้รับ</label>
	          					<div class="input col-xs-9 col-sm-7">
	          						<span>ส่งสินค้าลงทะเบียนฟรี</span>
	          					</div>
	          				</div>
	          			</div>
	          			<!-- end div row -->

	          			<div class="row">
	          				<div class="col-sm-4">
	          					<label class="control-label col-sm-5">จากวันที่</label>
	          					<div class="input col-sm-7">
	          						<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy"  data-date="{!! date("d/m/Y") !!}">
          								<input type="text" class="form-control" name="double_point_start_date"  value="{!! date("d/m/Y") !!}">
          								<div class="input-group-addon">
          									<span class="glyphicon glyphicon-calendar"></span>
          								</div>
          							</div>
	          					</div>
	          				</div>
	          				<div class="col-sm-4">
	          					<label class="control-label col-sm-3">สิ้นสุดวันที่</label>
	          					<div class="input col-sm-7">
	          						<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy"  data-date="{!! date("d/m/Y") !!}">
          								<input type="text" class="form-control" name="double_point_end_date"  value="{!! date("d/m/Y") !!}">
          								<div class="input-group-addon">
          									<span class="glyphicon glyphicon-calendar"></span>
          								</div>
          							</div>
	          					</div>
	          				</div>
	          				<div class="col-sm-4">
	          					<label class="control-label col-xs-3 col-sm-2">ได้รับ</label>
	          					<div class="input col-xs-9 col-sm-7">
	          						<span>Double Point</span>
	          					</div>
	          				</div>
	          			</div>
	          			<!-- end div row -->
          			</div>

          			<div class="submit">
          				<div class="form-group">
							{!! csrf_field() !!}
          					<button type="submit" class="button-save" name="save">Save</button>
          					<button type="button" class="button-cancel" name="cancel">Cancel</button>
          				</div>
          			</div>
          		</form>
          	</div>
    	</div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/promotion/index.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script>
	    $(function() {
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
	        toastr["success"]("{{ Session::get('success') }}", "Success");
	    @elseif(session()->has('warning'))
	        toastr["warning"]("{{ Session::get('warning') }}", "Warning");
	    @endif
	    @if ($errors->any())
	        @foreach ($errors->all() as $error)
	        toastr["error"]("{{ $error }}", "Warning");
	        @endforeach
	    @endif


	    });
	</script>
@endsection
