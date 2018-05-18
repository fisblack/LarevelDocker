{{--
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/category/index.css') }}">
@endsection

@section('body')
<div class="container-fluid page-backoffice-category ">

    <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box-header-white clearfix" style="">
                    <div class="header-left clearfix" style=" ">
                        <figure style="">
                            <img src="{{asset('images/backOffice/category/category.png')}}" class="w-100" alt="">
                        </figure>
                        <span class="title">
                           Category Product
                        </span>
                    </div>
                    <div class="header-right clearfix" style=" ">

                        <ul class="nav navbar-top-links navbar-right  ">
                            <li class="m-r-20">
                                <form role="search" class="app-search ">
                                    <input type="text" placeholder="Search..." class="form-control" id="search" name="search" @if(isset($_GET['search'])) value="{{$_GET['search']}}"@endif > <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                            <li class="add" style="">
                                <a href="{{route('backOffice.setting.category.create')}}" style="    ">
                                    <img  src="{{asset('images/backOffice/category/btn-add.png')}}" alt="Add">
                                </a>
                            </li>
                            <li class="del" style="">
                                <a href="javascript:void(0)" id="deleteAll" style="">
                                    <img src="{{asset('images/backOffice/category/btn-del.png')}}" alt="Delete"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="box-result" style="">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">

                        <tbody>
                        @foreach($categories as $category)
                            <form method="post" action="{{ route('backOffice.setting.category.restore', $category->id) }}" class="restore-form" id="restore-{{$category->id}}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                            </form>
                            <form method="post" action="{{ route('backOffice.setting.category.destroy', $category->id) }}" class="delete-form" id="delete-{{$category->id}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                            @if (!$category->trashed())
                            <tr>
                                <td class="first" >
                                    <input form="deleteAll" type="checkbox" class="iCheck" data-name="{{$category}}"
                                        name="selectCheckbox[]" id="selectCheckbox-{{$category->id}}" value="{{$category->id}}">
                                </td>
                                <td class="second" style="">
                                    <ul class="list-unstyled" >
                                        <li>
                                            <strong>หมวดไทย</strong>
                                            <span>: {{$category->name_th}}</span>
                                        </li>
                                        <li>
                                            <strong>หมวดหมู่อังกฤษ</strong>
                                            <span>: {{$category->name_en}}</span>
                                        </li>
                                    </ul>
                                </td>
                                <td class="three">
                                    <ul class="list-unstyled" style="    ">
                                        <li style=" ">
                                            <a href="{{route('backOffice.setting.category.edit', $category->id)}}" style="    ">
                                                <img style="" src="{{asset('images/backOffice/category/edit.png')}}" alt="Edit">
                                            </a>
                                        </li>
                                        <li style="">
                                            <a href="javascript:void(0)" onclick="submitDelete({{ $category->id }}, '{{ route('backOffice.setting.category.checkDeleteType', $category->id) }}')" style=" ">
                                                <img style="" src="{{asset('images/backOffice/category/bin.png')}}" alt="Delete">
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @else
                            <tr class="del-colspan">
                                <td class="first" >
                                    <input form="deleteAll" type="checkbox" class="iCheck" data-name="{{$category}}"
                                        name="selectCheckbox[]" id="selectCheckbox-{{$category->id}}" value="{{$category->id}}">
                                </td>
                                <td class="second">
                                    <ul class="list-unstyled" >
                                        <li class="del-space">
                                            <span>หมวดไทย</span>
                                            <span>: {{$category->name_th}}</span>
                                        </li>
                                        <li class="del-space">
                                            <span>หมวดหมู่อังกฤษ</span>
                                            <span>: {{$category->name_en}}</span>
                                        </li>
                                    </ul>
                                </td>
                                <td class="three">
                                    <ul class="list-unstyled" style="    ">
                                        <li style=" ">
                                            <a href="javascript:void(0)" onclick="submitUndo({{ $category->id }}, '{{ route('backOffice.setting.category.checkDeleteType', $category->id) }}')" style="    ">
                                                <img style="" src="{{asset('images/backOffice/category/refresh.png')}}" alt="Edit">
                                            </a>
                                        </li>
                                        <li style="">
                                            <a href="javascript:void(0)" onclick="submitDelete({{ $category->id }}, '{{ route('backOffice.setting.category.checkDeleteType', $category->id) }}')" style=" ">
                                                <img style="" src="{{asset('images/backOffice/category/bin.png')}}" alt="Delete">
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <!-- PAGINATION -->

                <div>{{ $categories->links('backOffice.setting.category.pagination') }}</div>

                <!-- END PAGINATION -->

                <!-- <div class="pagination-detail clearfix">

                    <div class="col-xs-12 col-sm-4 left">
                        <p style="">
                            ทั้งหมด 10 รายการ
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-8 right">
                        <nav>
                            <ul class="pagination" style="    ">

                                <li class="active">
                                    <a href="#">1</a>
                                </li>
                                <li class="">
                                    <a href="#">2</a>
                                </li>
                                <li class="">
                                    <a href="#">3</a>
                                </li>
                                <li class="">
                                    <a href="#">4</a>
                                </li>
                                <li class="">
                                    <a href="#">5</a>
                                </li>
                                <li class="">
                                    <a href="#">...</a>
                                </li>
                                <li class="">
                                    <a href="#">7</a>
                                </li>
                                <li class="">
                                    <a href="#">></a>
                                </li>


                            </ul>
                        </nav>
                    </div>

                </div> -->
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<!-- <script src="{{ asset('js/back-office/templates/jquery.min.js') }}"></script> -->
<!-- <script src="{{ asset('js/back-office/templates/bootstrap.min.js') }}"></script> -->
<script type="text/javascript">

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function submit (formId) {
    document.getElementById(formId).submit();
  }

  function submitDelete (id, route_name) {
    var formId = 'delete-' + id;

    $.ajax({
      url: route_name,
      type: 'get',
      success: function(response){
        if (response.type === 'forceDelete') {
            swal({
                title: 'Are You Sure ?',
                text: "มีข้อมูลที่จะถูกลบถาวร!!",
                type: 'warning',
                confirmButtonColor: '#d60500',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById(formId).submit();
                }
            });
        }
        else if (response.type === 'delete'){
          document.getElementById(formId).submit();
        }
        else {
          location.reload();
        }
      }
    });
  }

  function submitUndo (id, route_name) {
    var formId = 'restore-' + id;

    $.ajax({
      url: route_name,
      type: 'get',
      success: function(response){
        if (response.type === 'forceDelete'){
          document.getElementById(formId).submit();
        }
        else {
          location.reload();
        }
      }
    });
  }

  $(document).ready(function(){
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
      $("#success-alert").slideUp(500);
    });

    $("#failure-alert").fadeTo(2000, 500).slideUp(500, function(){
      $("#failure-alert").slideUp(500);
    });

    $("#selectall").on('ifChecked', function () {
      $(".iCheck").iCheck('check');
    });

    $("#selectall").on('ifUnchecked', function () {
      $(".iCheck").iCheck('uncheck');
    });

    $("#deleteAll").click(function (e) {
      e.preventDefault();
      var route_name= '{{ route("backOffice.setting.category.deleteAll") }}';

      var searchIDs = $("input[name='selectCheckbox[]']:checked").map(function(){
        return $(this).val();
      });

      if(searchIDs.length <= 0) {
          swal(
              'Warning!',
              'ไม่มีข้อมูลที่เลือก!',
              'warning'
          )
      } else {
        var param = [];

        for(var i = 0 ; i<searchIDs.length ; i++){
          param.push(searchIDs[i]);
        }

        var l_categories = {!! json_encode($categories->toArray()) !!};
        var categories = l_categories.data

        $.ajax({
          url: '{{ route("backOffice.setting.category.checkDeleteTypeFromDeleteAll") }}',
          type: 'post',
          data: {
            checkboxId: param
          }, success: function(response){
            if (response.type === 'forceDelete') {
              swal({
                title: 'Are You Sure ?',
                text: "มีข้อมูลที่จะถูกลบถาวร!!",
                type: 'warning',
                confirmButtonColor: '#d60500',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                  if (result.value) {
                      $.ajax({
                      url: route_name,
                      type: 'post',
                      data: {
                        checkboxId: param
                      }, success: function(response){
                        location.reload();
                      }
                    });
                  }
              });
            } else {
              $.ajax({
                url: route_name,
                type: 'post',
                data: {
                  checkboxId: param
                }, success: function(response){
                  location.reload();
                }
              });
            }
          }
        });
      }
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
