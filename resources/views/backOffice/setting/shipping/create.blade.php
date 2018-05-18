{{--
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
	<link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/shipping/create.css') }}">
@endsection

@section('body')
<div class="container-fluid page-backoffice-shipping-create">

    <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box-header-white clearfix" style="">
                    <div class="header-left clearfix" style=" ">
                        <figure style="">
                            <img src="{{asset('images/backOffice/shipping/shipping.png')}}" class="w-100" alt="">
                        </figure>
                        <a href="#" class="title active">
                            Shipping
                        </a>
                    </div>

                </div>
            </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="box-result" style="">
                <div class="row">
                    <div class="col-md-8 col-center">

                        <form action="{{ route('backOffice.setting.shipping.store') }}" method="POST" class="form-horizontal form-shpping clearfix" role="form">
                        	{!! csrf_field() !!}

                            <div class="form-group">
                                <label for="input" class="col-sm-3 control-label">
                                    ประเภทการส่ง
                                </label>
                                <div class="col-sm-5">
                                    <select name="shippingType" id="input" class="form-control" required="required">
                                        <option value="">--Please Select--</option>
                                    @foreach($data['shippingTypes'] as $shippingType)
                                        <option value="{{ $shippingType->id }}" @if($type_id == $shippingType->id) selected="selected" @endif>{{ $shippingType->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            @php
                                $start_loop = 0;
								$fix_loop   = 1;
							@endphp
							
                            @foreach($data['shippingFees'] as $shippingRegion)
							@php
							if($start_loop<$fix_loop){
							
								$regionIndex = $shippingRegion->id;
							@endphp
                            <div class="form-group">
                                <label for="input" class="col-sm-3 geo control-label">
                                    
                                </label>
                                <div class="col-sm-9">
                                    <div class="table-responsive table-shipping-create">
                                        <table class="table" id="table{{ $regionIndex }}">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        น้ำหนัก (กรัม)
                                                    </th>
                                                    <th class="text-center">
                                                        ราคา
                                                    </th>
                                                    <th class="text-center">
                                                        แลกแต้ม
                                                    </th>
                                                    <th class="text-center">
                                                        <a href="javascript:;">
                                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                        </a>

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
											@php
												$lastMin = 0;
												$lastAmount = '';
												$lastPoint = '';
											@endphp
											@foreach($shippingRegion->fees as $shippingFee)
											@if (!$loop->last)
												<tr>
                                                    <td class="text-right">
														<input type="hidden" name="shippingFee[{!! $regionIndex !!}][minWeight][]" value="{!! $shippingFee->minimum_weight !!}">
                                                        <span class="minWeight">{!! $shippingFee->minimum_weight !!}</span>
														-​
                                                        <span class="border-sm">
                                                            <input type="number" min="0" step="any" name="shippingFee[{!! $regionIndex !!}][maxWeight][]" value="{!! $shippingFee->maximum_weight !!}">
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="border-sm">
                                                            <input type="number" min="0" step="any" name="shippingFee[{!! $regionIndex !!}][amount][]" value="{!! $shippingFee->amount !!}">
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="border-sm">
                                                            <input type="number" min="0" step="any" name="shippingFee[{{$regionIndex}}][point][]" value="{!! $shippingFee->point_redemption !!}">
                                                        </span>
                                                    </td>
                                                    <td @if($loop->first) class="hidden" @endif>
                                                        <a class="border-sm delRow" href="javascript:;">
                                                            <img style="" src="{{asset('images/backOffice/shipping/bin.png')}}" alt="Delete">
                                                        </a>
                                                    </td>
                                                </tr>
											@endif
											@if ($loop->last && $shippingFee->maximum_weight != null)
												<tr>
													<td class="text-right">
														<input type="hidden" name="shippingFee[{!! $regionIndex !!}][minWeight][]" value="{!! $shippingFee->minimum_weight !!}">
														<span class="minWeight">{!! $shippingFee->minimum_weight !!}</span>
														-​
														<span class="border-sm">
															<input type="number" min="0" step="any" name="shippingFee[{!! $regionIndex !!}][maxWeight][]" value="{!! $shippingFee->maximum_weight !!}">
														</span>
													</td>
													<td class="text-center">
														<span class="border-sm">
															<input type="number" min="0" step="any" name="shippingFee[{!! $regionIndex !!}][amount][]" value="{!! $shippingFee->amount !!}">
														</span>
													</td>
													<td class="text-center">
														<span class="border-sm">
															<input type="number" min="0" step="any" name="shippingFee[{{$regionIndex}}][point][]" value="{!! $shippingFee->point_redemption !!}">
														</span>
													</td>
													<td class="hidden">
														<a class="border-sm delRow" href="javascript:;">
															<img style="" src="{{asset('images/backOffice/shipping/bin.png')}}" alt="Delete">
														</a>
													</td>
												</tr>
											@else
											@php
												$lastMin = $shippingFee->minimum_weight;
												$lastMax = $shippingFee->maximum_weight;
												$lastAmount = $shippingFee->amount;
												$lastPoint = $shippingFee->point_redemption;
											@endphp
											@endif
											@endforeach
                                                <tr>
                                                    <td class="text-left" colspan="4">
                                                        <a href="javascript:void(0);" onClick="AddShippingFee({{ $regionIndex }});">
                                                            <span class="icon">
                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                            </span>

                                                            เพิ่มเงื่อนไขราคาค่าขนส่ง
                                                        </a>
                                                    </td>
                                                </tr>

												<tr>
                                                    <td class="text-right">
														<input type="hidden" name="shippingFee[{!! $regionIndex !!}][minWeight][]" value="{{ $lastMin }}">
														<input type="hidden" name="shippingFee[{!! $regionIndex !!}][maxWeight][]" value="">
                                                        <span class="minWeight">{{ $lastMin }}</span>
														<span class="maxWeight" style="width: 71px;display: inline-block;text-align: left;">ขึ้นไป</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="border-sm">
                                                            <input type="number" min="0" step="any" name="shippingFee[{!! $regionIndex !!}][amount][]" value="{{ $lastAmount }}">
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="border-sm">
                                                            <input type="number" min="0" step="any" name="shippingFee[{!! $regionIndex !!}][point][]" value="{{ $lastPoint }}">
                                                        </span>
                                                    </td>
                                                    <td class="hidden">
                                                        <a class="border-sm delRow" href="javascript:;">
                                                            <img style="" src="{{asset('images/backOffice/shipping/bin.png')}}" alt="Delete">
                                                        </a>
                                                    </td>
                                                </tr>


											</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            @php
                            
                            $start_loop++;
                            }
						
							@endphp
							
                            @endforeach

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

<script src="{{ asset('js/backOffice/setting/shipping/create.js') }}"></script>

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
