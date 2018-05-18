<!DOCTYPE html>
<html>
  <head lang="{{ app()->getLocale() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SenseBook | @yield('title')</title>

    <!-- Web Fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common/tostr.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common/sweetalert2.min.css') }}">

    <style>
        @font-face {
            font-family: 'quarkbold';
            src: url('{{ asset('fonts/Quark-Bold.eot') }}');
            src: url('{{ asset('fonts/Quark-Bold.eot?#iefix') }}') format('embedded-opentype'),
             url('{{ asset('fonts/Quark-Bold.woff2') }}') format('woff2'),
             url('{{ asset('fonts/Quark-Bold.woff') }}') format('woff'),
             url('{{ asset('fonts/Quark-Bold.ttf') }}') format('truetype'),
             url('{{ asset('fonts/Quark-Bold.svg#quarkbold') }}') format('svg');
            font-weight: normal;
            font-style: normal;

        }


        @font-face {
          font-family: 'Quark';
          src: url('{{ asset('fonts/Quark-Light.eot') }}');
          src: url('{{ asset('fonts/Quark-Light.eot?#iefix') }}') format('embedded-opentype'),
            url('{{ asset('fonts/Quark-Light.woff2') }}') format('woff2'),
            url('{{ asset('fonts/Quark-Light.woff') }}') format('woff'),
            url('{{ asset('fonts/Quark-Light.ttf') }}') format('truetype'),
            url('{{ asset('fonts/Quark-Light.svg#Quark-Light') }} ') format('svg');
          font-weight: 300;
          font-style: normal;
        }


        @font-face {
            font-family: 'bangnanewregular';
            src: url('{{ asset('fonts/bangna-new-webfont.eot') }}');
            src: url('{{ asset('fonts/bangna-new-webfont.eot?#iefix') }}') format('embedded-opentype'),
                 url('{{ asset('fonts/bangna-new-webfont.woff2') }}') format('woff2'),
                 url('{{ asset('fonts/bangna-new-webfont.woff') }}') format('woff'),
                 url('{{ asset('fonts/bangna-new-webfont.ttf') }}') format('truetype'),
                 url('{{ asset('fonts/bangna-new-webfont.svg#bangnanewregular') }}') format('svg');
            font-weight: normal;
            font-style: normal;

        }

        @font-face {
            font-family: 'Glyphicons Halflings';
            src: url('{{ asset('fonts/glyphicons-halflings-regular.eot') }}');
            src: url('{{ asset('fonts/glyphicons-halflings-regular.eot?#iefix') }}') format("embedded-opentype"),
            url('{{ asset('fonts/glyphicons-halflings-regular.woff2') }}') format("woff2"),
            url('{{ asset('fonts/glyphicons-halflings-regular.woff') }}') format("woff"),
            url('{{ asset('fonts/glyphicons-halflings-regular.ttf') }}') format("truetype"),
            url('{{ asset('fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular') }}') format("svg");
        }

    </style>
    @yield('global-head')
  </head>
  <body id="body">
    <!-- Global Body -->
    @yield('global-body')
    
    <!-- Global JavaScript -->
    
    <script src="{{ asset('js/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/common/tostr.min.js') }}"></script>
    <script src="{{ asset('js/common/sweetalert2.min.js') }}"></script>

    @yield('global-script')
  </body>
</html>
