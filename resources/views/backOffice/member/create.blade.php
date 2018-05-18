{{-- 
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
    <!--link rel="stylesheet" href="{{ asset('/css/backOffice/member/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backOffice/project_name/create.css') }}">

    <link rel="stylesheet" media="all" type="text/css" href="{{ asset('bootstrap/jquerydatepicker/jquery-ui-timepicker-addon.css') }}" />
    <link rel="stylesheet" media="all" type="text/css" href="{{ asset('bootstrap/jquerydatepicker/jquery-ui.css') }}" /-->

    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/backOffice/member/create.css') }}">
    
    <!-- plugin -->
    <link rel="stylesheet" href="https://fengyuanchen.github.io/datepicker/css/datepicker.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

@endsection

@section('body')
    <div class="container-fluid page-backoffice-member-add">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box-header-white clearfix" style="">
                    <div class="header-left clearfix" style=" ">
                        <figure style="">
                            <img src="{{ asset('images/backOffice/member/member.png') }}" class="w-100" alt="">
                        </figure>
                        <a href="{{ route('backOffice.member.index') }}" class="title">
                            Member
                        </a>
                        <a href="{{ route('backOffice.member.create') }}" class="title active">
                            / Add
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="box-result" style="">
                    <div class="row">
                        <div class="col-md-12 ">
                            <form action="{{ route('backOffice.member.store') }}" method="POST" class="form-horizontal form-writers clearfix" role="form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="input" class="col-xs-12 col-sm-2 control-label">
								<span class="author">
								เพิ่มสมาชิก
								</span>
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6 @if($errors->has('full_name')) has-error @endif">
                                        <label for="input" class="col-sm-4 control-label one">
                                            ชื่อ
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}">
                                            @if($errors->has('full_name'))
                                                <div class="has-error">
                                                    <label for="input" class="col-sm-9 control-label">
                                                        {{ $errors->first('full_name') }}
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 @if($errors->has('email')) has-error @endif">
                                        <label for="input" class="col-sm-4 control-label two">
                                            Email
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                            @if($errors->has('email'))
                                                <div class="has-error">
                                                    <label for="input" class="col-sm-9 control-label">
                                                        {{ $errors->first('email') }}
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6 @if($errors->has('phone')) has-error @endif">
                                        <label for="input" class="col-sm-4 control-label one">
                                            เบอร์โทร
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                            @if($errors->has('phone'))
                                                <div class="has-error">
                                                    <label for="input" class="col-sm-9 control-label">
                                                        {{ $errors->first('phone') }}
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 @if($errors->has('type')) has-error @endif">
                                        <label for="input" class="col-sm-4 control-label two">
                                            ประเภท
                                        </label>
                                        <div class="col-sm-8">
                                            <select name="type" class="form-control">
                                                <option value="member" {{ (old('type') == 'member') ? 'selected' : '' }}>Member</option>
                                                <option value="admin" {{ (old('type') == 'admin') ? 'selected' : '' }}>Administrator</option>
                                            </select>
                                            @if($errors->has('type'))
                                                <div class="has-error">
                                                    <label for="input" class="col-sm-9 control-label">
                                                        {{ $errors->first('type') }}
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6 @if($errors->has('register_date')) has-error @endif">
                                        <label for="input" class="col-sm-4 control-label one">
                                            วันที่สมัคร
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group datetime">
                                                <input type="text" class="form-control " data-toggle="datepicker" name="register_date" readonly value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" disabled>
                                                <span class="input-group-addon bg-white">
										            <img src="{{ asset('images/backOffice/member/time.png') }}" alt="">
										        </span>
                                            </div>
                                            @if($errors->has('register_date'))
                                                <div class="has-error">
                                                    <label for="input" class="col-sm-9 control-label">
                                                        {{ $errors->first('register_date') }}
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 @if($errors->has('dob')) has-error @endif">
                                        <label for="input" class="col-sm-4 control-label two">
                                            วันเดือนปีเกิด
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group datetime">
                                                <input type="text" class="form-control" data-toggle="datepicker" name="dob" value="{{ old('dob') }}">
                                                <span class="input-group-addon bg-white">
										            <img src="{{ asset('images/backOffice/member/time.png') }}" alt="">
										        </span>
                                            </div>
                                            @if($errors->has('dob'))
                                                <div class="has-error">
                                                    <label for="input" class="col-sm-9 control-label">
                                                        {{ $errors->first('dob') }}
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6 @if($errors->has('profile_picture')) has-error @endif">
                                        <label for="input" class="col-sm-4 control-label one">
                                            รูปภาพ
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <label class="input-group-btn">
										            <span class="btn btn-browse ">
										                Browse&hellip; <input type="file" style="display: none;" accept="image/*" name="profile_picture" multiple>
										            </span>
                                                </label>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                            @if($errors->has('profile_picture'))
                                                <div class="has-error">
                                                    <label for="input" class="col-sm-9 control-label">
                                                        {{ $errors->first('profile_picture') }}
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="input" class="col-sm-4 control-label two">
                                            รูปภาพของฉัน
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="wrap-pic-slide">
                                                <div class="pic-slide">
                                                    <img src="http://localhost/images/backOffice/banner/banner-no-img.png" alt="" id="display-profile-picture" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 text-center ">
                                        <button type="submit" class="btn btn-save">save</button>
                                        <a href="{{ route('backOffice.member.index') }}" class="btn btn-cancel">cancel</a>
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
    <!--script src="{{ asset('js/website/home/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/jquerydatepicker/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('bootstrap/jquerydatepicker/jquery-ui-timepicker-addon.js') }}"></script>
    <script src="{{ asset('bootstrap/jquerydatepicker/jquery-ui-sliderAccess.js') }}"></script>
    <script src="{{ asset('js/backOffice/member/create.js') }}"></script-->


    <!-- plugin -->
    <script src="https://fengyuanchen.github.io/datepicker/js/datepicker.js"></script>
    <script src="https://fengyuanchen.github.io/datepicker/js/datepicker.en-US.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(document).ready( function() {

            $(document).on('change', ':file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            $('[data-toggle="datepicker"]').datepicker({
                format: 'yyyy-mm-dd'
            });

            $(':file').on('fileselect', function(event, numFiles, label) {
                var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;
                if( input.length ) {
                    input.val(log);
                    readURL(this);
                } else {
                    if( log ) alert(log);
                }

            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    console.log(reader)
                    reader.onload = function (e) {
                        $('#display-profile-picture').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

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
            @if ($errors->any())
                toastr["warning"]("Please enter the correct information.", "Warning");
            @endif
        });
    </script>
@endsection