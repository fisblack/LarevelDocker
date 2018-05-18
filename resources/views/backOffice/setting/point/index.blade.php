{{--
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
<link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/backOffice/setting/point/index.css') }}">
@endsection

@section('body')
<div class="container-fluid page-backoffice-points">

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="box-header-white clearfix" style="">
                <div class="header-left clearfix" style=" ">
                    <figure style="">
                        <img src="{{asset('images/backOffice/points/points.png')}}" class="w-100" alt="">
                    </figure>
                    <span class="title">
                        Points
                    </span>
                </div>
                <div class="header-right clearfix" style=" ">

                    <ul class="nav navbar-top-links navbar-right  ">
                        <li class="m-r-20">
                            <form role="search" class="app-search ">
                                <input class="form-control" type="search" name="search" id="search" placeholder="search" value="{{ $search }}" required>
                                <a href="javascript:void(0);" id="link_search"><i class="fa fa-search"></i></a>

                            </form>
                        </li>
                        <li class="add" style="">
                            <a href="{{ route('backOffice.setting.point.create') }}" style="    ">
                                <img src="{{asset('images/backOffice/points/btn-add.png')}}" alt="Add">
                            </a>
                        </li>
                        <li class="del" style="">
                            <a href="javascript:void(0);" style="" id="deleteAll">
                                <img src="{{asset('images/backOffice/points/btn-del.png')}}" alt="Delete">
                            </a>
                            <form id="form_multiple_delete" action="{{ route('backOffice.setting.point.deleteAll') }}" method="POST" class="form-horizontal form-points clearfix" role="form">
                                {!! csrf_field() !!}
                                <input type="hidden" name="deleteId" />
                                <input type="hidden" name="fDeleteId" />
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

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">

                        <tbody>
                        @foreach($items as $item)
                            @if ($item->trashed())
                            <tr style="background-color:  #DFDFE0 !important;">
                                <td class="first" >
                                    <input type="checkbox" name="points[]" value="{{ $item->id }}" id="points_{{ $item->id }}" class="softDeleted">
                                </td>
                                <td class="second">

                                    <ul class="list-unstyled" style="text-decoration: line-through;">
                                        <li>
                                            <strong><span style="color:#666 !important;">จำนวนแต้ม</span></strong>
                                            <span style="color:#666 !important">: {{ $item->points }} คะแนนสะสม</span>
                                        </li>
                                        <li>
                                            <strong><span style="color:#666 !important;">ส่วนลด</span></strong>
                                            <span style="color:#666 !important">: {{ $item->discount }} บาท</span>
                                        </li>
                                    </ul>
                                </td>
                                <td class="three">
                                    <ul class="list-unstyled" style="    ">
                                        <li style=" ">
                                            <form id="form_restore_{{ $item->id }}" action="{{ action('BackOffice\Setting\PointController@restore', ['id' => $item->id]) }}" method="POST" class="form-horizontal form-points clearfix" role="form">
                                                {!! csrf_field() !!}
                                                {!! method_field('PATCH') !!}
                                                <input type="image" src="{{asset('images/backOffice/preOrder/icon-refresh.png')}}" alt="Restore" width="20">
                                                <!--a href="javascript:void(0);" onclick="document.getElementById('form_restore_{{ $item->id }}').submit()" style=" ">
                                                    <img style="" src="{{asset('images/backOffice/preOrder/icon-refresh.png')}}" alt="Restore">
                                                </a-->
                                            </form>
                                        </li>
                                        <li style="">

                                            <form id="form_fdelete_{{ $item->id }}" action="{{ route('backOffice.setting.point.destroy', ['id' => $item->id, 'type' => 'force']) }}" method="POST" class="form-horizontal form-points clearfix" role="form">
                                                {!! csrf_field() !!}
                                                {!! method_field('DELETE') !!}
                                                <input type="image" src="{{asset('images/backOffice/points/bin.png')}}" alt="Delete" width="20">
                                                <!--a href="javascript:void(0);" id="fdelete_{{ $item->id }}" style=" ">
                                                    <img style="" src="{{asset('images/backOffice/points/bin.png')}}" alt="Delete">
                                                </a-->
                                            </form>

                                        </li>
                                    </ul>
                                </td>

                            </tr>
                            @else
                            <tr>
                                <td class="first" >
                                    <input type="checkbox" name="points[]" value="{{ $item->id }}" id="points_{{ $item->id }}" @if( old('points')) checked @endif class="delete">
                                </td>
                                <td class="second" style="">

                                    <ul class="list-unstyled" >
                                        <li>
                                            <strong>จำนวนแต้ม</strong>
                                            <span>: {{ $item->points }} คะแนนสะสม</span>
                                        </li>
                                        <li>
                                            <strong>ส่วนลด</strong>
                                            <span>: {{ $item->discount }} บาท</span>
                                        </li>
                                    </ul>
                                </td>
                                <td class="three">
                                    <ul class="list-unstyled" style="    ">
                                        <li style=" ">
                                            <a href="{{ route('backOffice.setting.point.edit', ['id' => $item->id]) }}" >
                                                <img style="" src="{{asset('images/backOffice/points/edit.png')}}" alt="Edit">
                                            </a>
                                        </li>
                                        <li style="">
                                            <form id="form_delete_{{ $item->id }}" action="{{ route('backOffice.setting.point.destroy', ['id' => $item->id, 'type' => 'soft']) }}" method="POST" class="form-horizontal form-points clearfix" role="form">
                                                {!! csrf_field() !!}
                                                {!! method_field('DELETE') !!}
                                                <!--input type="image" src="{{asset('images/backOffice/points/bin.png')}}" alt="Delete" width="20"-->
                                                <a href="javascript:void(0);" style=" ">
                                                    <img style="" src="{{asset('images/backOffice/points/bin.png')}}" alt="Delete">
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </td>

                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="pagination-detail clearfix">

                    <div class="col-xs-12 col-sm-4 left">
                        <p style="">
                            ทั้งหมด {{ $items->total() }} รายการ
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-8 right">
                        <nav>
                        @if ($items->total() <= $items->perPage())
                            <ul class="pagination">
                                <li class="disabled"><span>«</span></li>
                                <li class="active"><span>1</span></li>
                                <li class="disabled"><span>»</span></li>
                            </ul>
                        @else
                            {!! str_replace('/?','?',$items->render()) !!}
                        @endif
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script src="{{ asset('js/backOffice/setting/point/index.js') }}"></script>
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
