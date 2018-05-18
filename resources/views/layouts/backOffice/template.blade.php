@extends('layouts.html5')

@section('global-head')

  <link rel="stylesheet" type="text/css" href="{{ asset('css/admin_core_boostrap.css')}}"/>
  
  <link rel="stylesheet" type="text/css" href="{{ asset('css/admin_style.css')}}"/>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
  <link href="{{ asset('js/plugins/sidebar-nav/dist/sidebar-nav.min.css')}}" rel="stylesheet">

  <link href="{{ asset('js/plugins/animate/animate.css')}}" rel="stylesheet">  


  <!-- <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet"> -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  @yield('head')
@stop

@section('global-body')
  @include('layouts.backOffice.header')

  <!-- Page Body -->
  @yield('body')
  <!-- End Page Body -->
  
  @include('layouts.backOffice.footer')
@endsection

@section('global-script')

  <!-- Layout JavaScript -->
  

  
  <script src="{{ asset('js/plugins/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
  <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.js') }}"></script>
  <script src="{{ asset('js/plugins/slimscroll/waves.js') }}"></script>
  <script src="{{ asset('js/common/custom_admin.js') }}"></script>
    
  <!-- Page JavaScript -->
  @yield('script')
@endsection
