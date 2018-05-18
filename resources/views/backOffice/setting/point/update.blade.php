{{--
	@author: ระบุชื่อ-นามสกุลของคุณที่นี่
	@phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
	@email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
<link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/backOffice/setting/point/create.css') }}">
@endsection

@section('body')
<div class="container-fluid  page-backoffice-points-edit">

	<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="box-header-white clearfix" style="">
					<div class="header-left clearfix" style=" ">
						<figure style="">
							<img src="{{asset('images/backOffice/points/points.png')}}" class="w-100" alt="">
						</figure>
						<a href="{{action('BackOffice\Setting\PointController@index')}}" class="title">
							Points
						</a>
						<a href="#" class="title active">
							/ Edit
						</a>
					</div>

				</div>
			</div>

	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="box-result" style="">
				<div class="row">
					<div class="col-md-6 col-center">
						<form action="{{ route('backOffice.setting.point.update', ['id' => $item->id]) }}" method="POST" class="form-horizontal form-points clearfix" role="form">
							{!! csrf_field() !!}
							{!! method_field('PATCH') !!}

							<div class="form-group">
								<label for="input" class="col-sm-3 control-label">
									จำนวนแต้ม
								</label>
								<div class="col-sm-9">
									<input type="text" name="points" placeholder="จำนวนแต้ม" id="input" class="form-control"  required="required" value="{{old('points', $item->points)}}">
								</div>
							</div>

							<div class="form-group">
								<label for="input" class="col-sm-3 control-label">
									ส่วนลด
								</label>
								<div class="col-xs-11 col-sm-8">
									<input type="text" name="discount" id="input" class="form-control"  required="required" placeholder="ส่วนลด" value="{{old('discount', $item->discount)}}">
								</div>
								<label for="" class="col-xs-1 control-label">บาท</label>
							</div>

							<div class="form-group">
								<div class="col-sm-12 text-center">
									<button type="submit" class="btn btn-save">save</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection

@section('script')
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
		toastr["success"]("{{ session()->get('success') }}", "Success");
	@elseif(session()->has('warning'))
		toastr["warning"]("{{ session()->get('warning') }}", "Warning");
	@endif
	@if ($errors->any())
		@foreach ($errors->all() as $error)
		toastr["error"]("{{ $error }}", "Error");
		@endforeach
	@endif
	});
</script>
@endsection
