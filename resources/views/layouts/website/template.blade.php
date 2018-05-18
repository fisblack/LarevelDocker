@extends('layouts.html5')

@section('global-head')
  <!-- Layout CSS -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/core_boostrap.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/bootflat/scss/stylesheets/bootflat.css')}}"/>
  @yield('head')
@endsection

@section('global-body')
  <header class="header">
    @include('layouts.website.header')
    @include('layouts.website.menu')
  </header>

  <!-- Page Body -->
  @yield('body')
  <!-- End Page Body -->
  
  @include('layouts.website.footer')
@endsection

@section('global-script')
  <!-- Layout JavaScript -->
  <script src="{{ asset('js/common/goToTop.js')}}"></script>
  <script src="{{ asset('js/common/app.js') }}"></script>
  <script type="text/javascript">
      jQuery(document).ready(function() {
          App.init();
          updateProductsListCart();
      });
  </script>

  <!-- Page JavaScript -->
  @yield('script')
@endsection