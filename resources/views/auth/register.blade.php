@extends('layouts.auth.template')

@section('head')
    <link rel="stylesheet" href="https://fengyuanchen.github.io/datepicker/css/datepicker.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('header')
@endsection

@section('body')
    <div class="box-login-input" style="padding: 20px 50px !important;">
        <div class="box-login-input-title">
            <h4>Register</h4>
        </div>
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="form-group form-margin-bottom col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                </div>
                <div class="form-group form-margin-bottom col-md-6{{ $errors->has('full_name') ? ' has-error' : '' }}">
                    <label>Full name</label>
                    <input type="text" name="full_name" class="form-control" placeholder="Full name" value="{{ old('full_name') }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group form-margin-bottom col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group form-margin-bottom col-md-6{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                </div>
            </div>
            <div class="row">
                <div class="form-group form-margin-bottom-30 col-md-6{{ $errors->has('dob') ? ' has-error' : '' }}">
                    <label>Date of birth</label>
                    <div class="input-group datetime">
                        <input type="text" class="form-control" data-toggle="datepicker" name="dob" value="{{ old('dob') }}">
                        <span class="input-group-addon bg-white">
                        <img src="{{ asset('images/backOffice/member/time.png') }}" alt="">
                    </span>
                    </div>
                </div>
                <div class="form-group form-margin-bottom-30 col-md-6{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}">
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-login">Register</button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
@endsection

@section('script')
    <script src="https://fengyuanchen.github.io/datepicker/js/datepicker.js"></script>
    <script src="https://fengyuanchen.github.io/datepicker/js/datepicker.en-US.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="datepicker"]').datepicker({
                format: 'yyyy-mm-dd'
            });

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
                toastr["success"]("{{ session()->get('success') }}", "Success")
            @elseif(session()->has('failure'))
                toastr["warning"]("{{ session()->get('failure') }}", "Warning")
                    @endif
                    @if ($errors->any())
            let error = '<ul>'
            @foreach ($errors->all() as $error)
                error += '<li>{{ $error }}</li>'
            @endforeach
                error += '</ul>'
            toastr["warning"](error, "Warning")
            @endif
        })
    </script>
@endsection
