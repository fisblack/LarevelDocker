@extends('layouts.auth.template')

@section('head')
@endsection

@section('header')
    <header></header>
@endsection

@section('body')
<div class="box-login-input">
    <div class="box-login-input-title">
        <h4>Reset Password</h4>
    </div>
    <form method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <div class="form-group form-margin-bottom-30{{ $errors->has('email') ? ' has-error' : '' }}">
            <label>Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-sendemail">Send Email</button>
        </div>
    </form>
</div>
@endsection

@section('footer')
  <footer></footer>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
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
            @if(session()->has('status'))
                toastr["success"]("{{ session()->get('status') }}", "Success");
            @endif
        })
    </script>
@endsection
