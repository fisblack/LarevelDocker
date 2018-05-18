@extends('layouts.auth.template')

@section('head')
    <!-- base core css -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
@endsection

@section('header')
    <header></header>
@endsection

@section('body')
    <div class="box-login-input">
        <div class="box-login-input-title">
            <h4>Reset password</h4>
        </div>
        <form method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group form-margin-bottom-30 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="control-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div>
                <button type="submit" class="btn btn-primary btn-sendemail">Reset !</button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
  <footer></footer>
@endsection

@section('script')
@endsection
