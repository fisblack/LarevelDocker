@extends('layouts.html5')

@section('global-head')
    <!-- Layout CSS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/core_boostrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">

    <!-- Page CSS -->
  @yield('head')
@stop

@section('global-body')
<div class="shadow-box"></div>
<div class="container-fuild">
  <div class="box-login">
    @include('layouts.auth.header')

    <!-- Page Body -->
    @yield('body')
    <!-- End Page Body -->

    @include('layouts.auth.footer')
  </div>
</div>
@endsection

@section('global-script')
  <!-- Layout JavaScript -->
  <script type="text/javascript">console.log('© ' + new Date().getFullYear() + ' - AdiwIT Co., Ltd. All rights reserved.');</script>

  <!-- Page JavaScript -->
  @yield('script')
@endsection
