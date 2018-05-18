@extends('layouts.auth.template')

@section('head')
@endsection

@section('header')
    <header></header>
@endsection

@section('body')             
<div class="box-login-input">
    <div class="box-login-input-title">
        <h4>LOG IN</h4>
    </div>
    <form method="post" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="form-group form-margin-bottom{{ $errors->has('email') ? ' has-error' : '' }}">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group form-margin-bottom{{ $errors->has('password') ? ' has-error' : '' }}">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-login">LOG IN</button>
            <a href="{{ route('register') }}" class="btn btn-default btn-signup">SIGN UP</a>
        </div>
    </form>
    <div class="box-login-input-forgetpass">
        <a href="{{ route('password.request')}}">Forget password?</a>
    </div>
    <div class="box-login-input-or">
        <h4>Or</h4>
    </div>
    <div class="box-login-input-social">
        <ul>
            <li><a href="{{ url('/auth/facebook') }}"><img src="{{ asset('images/auth/login/facebook.png') }}" alt="facebook" /></a></li>
            <li><a href="{{ url('/auth/google') }}"><img src="{{ asset('images/auth/login/google.png') }}" alt="google" /></a></li>
            <li><a href="{{ url('/auth/twitter') }}"><img src="{{ asset('images/auth/login/twitter.png') }}" alt="facebook" /></a></li>
        </ul>
    </div>
</div>
@endsection

@section('footer')
  <footer></footer>
@endsection

@section('script')
@endsection
