{{--
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
	<link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/writer/index.css') }}">
@endsection

@section('body')
<div class="container-fluid page-backoffice-writers ">

    <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box-header-white clearfix" style="">
                    <div class="header-left clearfix" style=" ">
                        <figure style="">
                            <img src="{{asset('images/backOffice/writers/writers.png')}}" class="w-100" alt="">
                        </figure>
                        <span class="title">
                           Writers
                        </span>
                    </div>
                    <div class="header-right clearfix" style=" ">

                        <ul class="nav navbar-top-links navbar-right  ">
                            <li class="m-r-20">
                                <form role="search" class="app-search " method="get" action="{{ route('backOffice.setting.writer.index') }}">
                                    <input type="text" placeholder="Search..." class="form-control" name="search"> <a id="search_btn" href="javascript:;"><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                            <li class="add" style="">
                                <a href="{{action('BackOffice\Setting\WriterController@create')}}" style="    ">
                                    <img  src="{{asset('images/backOffice/writers/btn-add.png')}}" alt="Add">
                                </a>
                            </li>
                            <li class="del" style="">
                                <a href="javascript:;" style="" id="delete-all">
                                    <img src="{{asset('images/backOffice/writers/btn-del.png')}}" alt="Delete">
                                </a>
                            </li>
                            <form action="{{route('backOffice.setting.writer.delete-all')}}" method="POST" id="form_delete_all">
                                {!! csrf_field() !!}
                                <input id="ar_delete_all" name="ar_delete_all" type="hidden" value="">
                                <input id="check_force" name="check_force" type="hidden" value="">
                            </form>
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
                        @if(count($writer) <= 0)
                            <h4>Empty</h4>
                        @endif
                        @foreach($writer as $key => $val)
                            <tr @if($val->trashed()) class="del-colspan" @endif>
                                <td class="first" >
                                    <input type="checkbox" name="wri[]"  UseForce="@if($val->trashed()) true @endif" class="deleteAll" value="{{$val->id}}">
                                </td>
                                <td class="second" style="">
                                    <figure style="">
                                        @if($val->image)
                                            <img src="{{ getImage($val->image) }}" class="w-40  img-circle" alt="" width="60" height="60">
                                        @else
                                            <img src="{{ getImage('images/backOffice/writers/logo01.png')}}">
                                        @endif
                                    </figure>
                                    <ul class="list-unstyled" >
                                        <li>
                                            <strong>ชื่อ</strong>
                                            <span>: {{ $val->fullname_th }}</span>
                                        </li>
                                        <li class="desc clearfix">
                                            <strong>รายละเอียด :</strong>
                                            <span>{{ $val->description_th }}</span>
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled" >
                                        <li>
                                            <strong>Name</strong>
                                            <span>: {{ $val->fullname_en }}</span>
                                        </li>
                                        <li class="desc clearfix">
                                            <strong>Description :</strong>
                                            <span>{{ $val->description_en }}</span>
                                        </li>
                                    </ul>
                                </td>
                                <td class="three">
                                    @if(!$val->trashed())
                                    <ul class="list-unstyled" style="    ">
                                        <li style=" ">
                                            <a href="{{ route('backOffice.setting.writer.edit', $val->id) }}" style="    ">
                                                <img style="" src="{{asset('images/backOffice/writers/edit.png')}}" alt="Edit">
                                            </a>
                                        </li>
                                        <li style="">
                                            <form action="{{ route('backOffice.setting.writer.destroy', $val->id) }}" method="post" class="delete radius b">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <a href="javascript:;" class="delete submitForm" data-id="{{ $val->id }}">
                                                    <img style="" src="{{asset('images/backOffice/writers/bin.png')}}" alt="Delete">
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                    @else
                                        <ul class="list-unstyled" style="    ">
                                            <li style=" ">
                                                    <form action="{{ route('backOffice.setting.writer.restore',$val->id) }}" method="post">
                                                        {!! csrf_field() !!}
                                                        <input name="_method" type="hidden" value="PUT">
                                                        <input type="hidden" name="id" value="{{ $val->id }}">
                                                        <a href="javascript:;" style="    " class="submitForm2" data-id="{{ $val->id }}">
                                                            <img style="" src="{{asset('images/backOffice/writers/refresh.png')}}" alt="Restore">
                                                        </a>
                                                    </form>
                                            </li>
                                            <li style="">
                                                <form action="{{ route('backOffice.setting.writer.destroy', $val->id) }}" method="post">
                                                    {!! csrf_field() !!}
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <a href="javascript:;" class="btn-force-delete" style="cursor: pointer;">
                                                        <img style="" src="{{asset('images/backOffice/writers/bin.png')}}" alt="Delete">
                                                    </a>
                                                </form>

                                            </li>
                                        </ul>
                                    @endif
                                </td>
                            </tr>
                        @endforeach




                        </tbody>
                    </table>

                </div>
                <div class="pagination-detail clearfix">

                    <div class="col-xs-12 col-sm-4 left">
                        <p style="">
                        <div class="text">ทั้งหมด <span>{{ number_format($writer->total()) }}</span> รายการ</div>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-8 right">
                        @if(request()->get('search'))
                            {{ $writer->appends(['search' => request()->get('search')])->links('backOffice.setting.writer.pagination') }}
                        @else
                            {{ $writer->links('backOffice.setting.writer.pagination') }}
                        @endif
                        {{--<nav>--}}
                            {{--<ul class="pagination" style="    ">--}}
                                {{----}}
                                {{--<li class="active">--}}
                                    {{--<a href="#">1</a>--}}
                                {{--</li>--}}
                                {{----}}
                            {{--</ul>--}}
                        {{--</nav>--}}
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
    <!--script src="{{ asset('js/backOffice/project_name/create.js') }}"></script-->
    <script>
        $(document).ready(function(){
            $('.submitForm2').on('click', function(e){
                $(this).parents('form').submit();
            });
            $('.submitForm').on('click', function(e){
                console.log($(this).data('id'));
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{route('backOffice.setting.writer.check-writer')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {id: $(this).data('id'),_method : 'POST'},
                    success: (data) => {
                        console.log(data.status);
                        if(data.status === '1') {
                            $(this).parents('form').submit();
                        } else if(data.status === '0') {
                            swal({
                                title: 'Are You Sure ?',
                                text: "This member will be delete forever.",
                                type: 'warning',
                                confirmButtonColor: '#d60500',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, delete it !'
                            }).then(result => {
                                if (result.value) {
                                    $(this).parents('form').submit()
                                }
                            });
                        } else {
                            toastr["warning"](data.message , "Warning");
                        }
                    }
                });

            });
            $('#search_btn').on('click',function () {
               $(this).parent('form').submit();
            });
            $('.btn-force-delete').click(function () {
                swal({
                    title: 'Are You Sure ?',
                    text: "This member will be delete forever.",
                    type: 'warning',
                    confirmButtonColor: '#d60500',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it !'
                }).then(result => {
                    if (result.value) {
                        $(this).closest('form').submit()
                    }
                });
                return false
            });
            $('#delete-all').click(function(){
                let ar_delete_all = [];
                let check_force =[];
                $("input[name='wri[]']:checked").each( function () {
                    ar_delete_all.push($(this).val());
                    if($(this).attr('UseForce')) {
                        check_force.push(true)
                    }else{
                        check_force.push(false)
                    }
                });
                $('#ar_delete_all').val(ar_delete_all);
                $('#check_force').val(check_force);
                if(ar_delete_all.length >0){
                    if(check_force.indexOf(true)>=0){
                        swal({
                            title: 'Are You Sure ?',
                            text: "Do you want to force delete?",
                            type: 'warning',
                            confirmButtonColor: '#d60500',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.value) {
                                $('#form_delete_all').submit()
                            }
                        });
                    }else{
                        $('#form_delete_all').submit()
                    }

                }


            })

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
            };
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
