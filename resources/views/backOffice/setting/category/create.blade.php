{{-- 
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/category/create.css') }}">
@endsection

@section('body')       
<div class="container-fluid page-backoffice-category-create">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="box-header-white clearfix" style="">
                <div class="header-left clearfix" style=" ">
                    <figure style="">
                        <img src="{{asset('images/backOffice/category/category.png')}}" class="w-100" alt="">
                    </figure>
                    <a href="{{action('BackOffice\Setting\CategoryController@index')}}" class="title">
                        Category Product
                    </a>
                    <a href="#" class="title active">
                        / Add
                    </a>
                </div>
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="box-result" style="">
                <!-- @if (session('failure'))
                <div class="alert alert-danger" id="alert">
                    {{ session('failure') }}
                </div>
                @endif -->
                <div class="row">
                    <div class="col-md-6 col-center">
                        <!-- <form action="" method="POST" class="form-horizontal form-category clearfix" role="form"> -->
                        @if($type == 'edit')
                        <form action="{{ route('backOffice.setting.category.update', $category->id) }}" class="form-horizontal form-category clearfix" method="post" id="form1">
                        <input type="hidden" name="_method" value="PUT">
                        @else
                        <form action="{{ route('backOffice.setting.category.store') }}" class="form-horizontal form-category clearfix" method="post" id="form1">
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="input" class="col-sm-5 control-label">
                                    ชื่อหมวดหลักภาษาไทย
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="name_th" placeholder="ชื่อหมวดหลักภาษาไทย" id="input" class="form-control" required="required" @if (isset($category)) value="{{ old('name_th', $category->name_th) }}" @endif>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input" class="col-sm-5 control-label">
                                    ชื่อหมวดหลักภาษาอังกฤษ
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="name_en" id="input" class="form-control" required="required" placeholder="ชื่อหมวดหลักภาษาอังกฤษ" @if (isset($category)) value="{{ old('name_en', $category->name_en) }}" @endif>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-save">save</button>
                                    <button type="button" class="btn btn-cancel" onclick="goBack()">cancel</button>
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
<!-- <script src="{{ asset('js/back-office/templates/jquery.min.js') }}"></script> -->
<!-- <script src="{{ asset('js/back-office/templates/ellipsis/jquery.ellipsis.min.js') }}"></script> -->

<script type="text/javascript">    
  function goBack() {

    window.location = "{{route('backOffice.setting.category.index')}}";
    // window.history.back();
    // var type = {!! json_encode($type) !!};

    // var pathArray = window.location.pathname.split( '/' );
    // var newPathname = "";

    // if(type == 'create') {
    //   for (i = 0; i < pathArray.length-1; i++) {
    //     newPathname += pathArray[i];
    //     newPathname += "/";
    //   }
    // }
    // else {
    //   for (i = 0; i < pathArray.length-2; i++) {
    //     newPathname += pathArray[i];
    //     newPathname += "/";
    //   }
    // }
    // document.location.href = newPathname
  }

  $(document).ready(function(){
    $("#alert").fadeTo(2000, 500).slideUp(500, function(){
      $("#alert").slideUp(500);
    });
  });

</script>
<script>
    $(function() {
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