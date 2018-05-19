{{--
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}
@extends('layouts.backOffice.template')

@section('head')
	<link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/shipping/index.css') }}">
@endsection

@section('body')
<div class="container-fluid page-backoffice-shipping ">

    <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box-header-white clearfix" style="">
                    <div class="header-left clearfix" style=" ">
                        <figure style="">
                            <img src="{{asset('images/backOffice/shipping/shipping.png')}}" class="w-100" alt="">
                        </figure>
                        <span class="title">
                           Shipping
                        </span>
                    </div>
                    <div class="header-right clearfix" style=" ">

                        <ul class="nav navbar-top-links navbar-right  ">
                            <li class="m-r-20">
                                <form role="search" class="app-search ">
                                    <input type="text" name="search" placeholder="Search..." class="form-control" value="{{ $search }}">
                                    <a href="javascript:void(0);" id="link_search"><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                            <li class="add" style="">
                                <a href="{{route('backOffice.setting.shipping.create', ['type_id' => $type_id])}}" style="    ">
                                    <img  src="{{asset('images/backOffice/shipping/btn-add.png')}}" alt="Add">
                                </a>
                            </li>
                            <li class="del" style="">
                                <a href="#" style="" id="deleteAll">
                                    <img src="{{asset('images/backOffice/shipping/btn-del.png')}}" alt="Delete"></a>
								<form id="form_multiple_delete" action="{{ route('backOffice.setting.shipping.deleteAll', ['type_id' => $type_id]) }}" method="POST">
	                                {!! csrf_field() !!}
	                                <input type="hidden" name="deleteId" />
	                            </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="box-result" style="">
                <div class="text-left">
                    <div class="btn-group">
                        @foreach( $data['shippingTypes'] as $i => $shippingType )
                        <a href="{{ action('BackOffice\Setting\ShippingController@index', ['type_id' => $shippingType->id, 'search' => $search ]) }}" id="{{ strtolower($shippingType->name) }}" class="btn btn-express {{ $type_id == $shippingType->id ? 'active' : '' }}">
                            {{$shippingType->name}}
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">

                    <tbody>
                    @if(!$data['shippingFees']->count())
                        <tr>
		                    <td colspan="6">There are no data.</td>
                        </tr>
                    @else
                        @foreach( $data['shippingFees'] as $index => $shippingFee )
                        {{--@if ($shippingFee->trashed())
                        <tr class="del-colspan">
                            <td class="first" >
                                <input type="checkbox" name="wri[]" value="1" id="wri_1">
                            </td>
                            <td class="second text-left" style="">
                                <ul class="list-unstyled" >
									<li>
                                        <strong>ภาค:</strong>
                                        <span> {{ $data['shippingRegions']->find($shippingFee->region_id)->region_name }}</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="second text-center" style="">
                                <ul class="list-unstyled" >
									<li>
                                    @php ($minWeight = 0)
                                    @if($data['shippingFees'][$index-1])
                                        @if ($data['shippingFees'][$index-1]->region_id == $shippingFee->region_id)
                                            @php ($minWeight = $data['shippingFees'][$index-1]->maximum_weight + 0.01)
                                        @endif
                                    @endif
                                        <strong>น้ำหนัก:</strong>
                                        <span> {{ $minWeight }}-{{$shippingFee->maximum_weight}} กรัม</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="second text-center" style="">
                                <ul class="list-unstyled" >
                                    <li>
                                        <strong>ราคา:</strong>
                                        <span> {!! $shippingFee->amount !!} บาท</span>
                                    </li>
                                    <li>
                                        <span>
                                            - หรือ -
                                        </span>
                                    </li>
									<li>
                                        <strong>แต้ม:</strong>
                                        <span> {{$shippingFee->point_redemption}} Point</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="second text-center" style="">
                                <ul class="list-unstyled" >
                                    <li>
                                        <strong class="not-active">Active</strong>
                                        <br>
                                        <span class="active">สถานะ</span>
                                    </li>
                                </ul>
                            </td>

                            <td class="three">
                                <ul class="list-unstyled" style="">
                                    <li style=" ">
                                        <form action="{{ route('backOffice.setting.shipping.restore', $shippingFee->id ) }}" method="POST" class="form-horizontal form-points clearfix" role="form">
                                            {!! csrf_field() !!}
                                            {!! method_field('PATCH') !!}
                                            <input type="image" src="{{asset('images/backOffice/shipping/refresh.png')}}" alt="Restore" >
                                        </form>
                                    </li>

                                </ul>
                            </td>
                        </tr>
                        @else--}}
                        <tr>
                            <td class="first" >
                                <input type="checkbox" name="wri[]" value="{!! $shippingFee->id !!}" id="wri_1">
                            </td>
                            <td class="second text-left zone" style="">
                                <ul class="list-unstyled" >
                                    <li>
                                        <!-- <strong>ภาค:</strong> -->
                                        <span> {{ $data['shippingRegions']->find($shippingFee->region_id)->region_name }}</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="second weight" style="">
                                <ul class="list-unstyled" >
                                    <li>
                                    @php ($minWeight = 0)
                                    @if($data['shippingFees'][$index-1])
                                        @if ($data['shippingFees'][$index-1]->region_id == $shippingFee->region_id)
                                            @php ($minWeight = $data['shippingFees'][$index-1]->maximum_weight + 0.01)
                                        @endif
                                    @endif
                                        <strong>น้ำหนัก:</strong>
                                        <span> {{ $minWeight }}@if($shippingFee->maximum_weight)-{{$shippingFee->maximum_weight}} กรัม@else ขึ้นไป @endif</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="second price text-center" style="">
                                <ul class="list-unstyled" >
                                    <li>
                                        <strong>ราคา:</strong>
                                        <span> {!! $shippingFee->amount !!} บาท</span>
                                    </li>
                                    <li>
                                        <span>
                                            - หรือ -
                                        </span>
                                    </li>
                                    <li>
                                        <strong>แต้ม:</strong>
                                        <span> {{$shippingFee->point_redemption}} Point</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="second status text-center" style="">
                                <ul class="list-unstyled" >
                                    <li>
                                        <strong class="active">Active</strong>
                                        <br>
                                        <span class="active">สถานะ</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="three">
                                <ul class="list-unstyled" style="">
                                    <li style="">
                                        <a href="{{ route('backOffice.setting.shipping.edit', ['id'=>$shippingFee->id, 'type_id'=>$shippingFee->type_id]) }}" style="">
                                            <input type="image" src="{{asset('images/backOffice/shipping/edit.png')}}" alt="Edit">
                                        </a>
                                    </li>
                                    <li style="">
                                        <form action="{{ route('backOffice.setting.shipping.destroy', ['id'=>$shippingFee->id, 'type_id'=>$shippingFee->type_id]) }}" method="POST" class="form-horizontal form-points clearfix" role="form">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                            <input type="image" src="{{asset('images/backOffice/shipping/bin.png')}}" alt="Delete" >
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        {{--@endif--}}
                        @endforeach
                    @endif
                    </tbody>
                    </table>

                </div>
                <div class="pagination-detail clearfix">

                    <div class="col-xs-12 col-sm-4 left">
                        <p style="">
                            ทั้งหมด {{ $data['shippingFees']->total() }} รายการ
                        </p>
                    </div>

                    {{ $data['shippingFees']->appends(request()->query())->links() }}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/setting/shipping/index.js') }}"></script>

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
