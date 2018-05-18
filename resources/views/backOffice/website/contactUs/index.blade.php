{{-- @author: ระบุชื่อ-นามสกุลของคุณที่นี่ @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่ @email: ระบุอีเมลของคุณที่นี่ --}} @extends('layouts.backOffice.template') @section('head')
<link rel="stylesheet" href="{{ asset('css/backOffice/website/contactUs/index.css') }}">
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet"> @endsection @section('body')
<div class="container-back">
    <div class="order">
        <div class="padding">
            <div class="bg shadow radius">
                <div class="header underline">
                    <div class="page-name float-left">
                        <div class="icon float-left">
                            <img src="{{ asset('images/backOffice/website/contactUs/icon.png') }}">
                        </div>
                        <div class="text float-left txt">
                            Contact Us
                        </div>
                    </div>
                </div>

                <!-- <form class="form-horizontal"> -->
                <form action="{{ route('backOffice.website.contact-us.store') }}" class="form-horizontal" method="post" id="form1">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="content">
                        <h1 class="data">แก้ไขข้อมูล</h1>
                        <div class="">
                            <div class="col-xs-12 col-sm-6 col-md-6 mp">
                               <div class="form-group">
                                 
                                    <label for="inputEmail3" class="col-sm-4 control-label">หัวข้อ</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="title_th" class="form-control radius border2" placeholder="หัวข้อ" required="required" @if (isset($contactUs)) value="{{ $contactUs->title_th }}" @endif>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">รายละเอียด</label>
                                    <div class="col-sm-7">
                                        <textarea name="description_th" class="form-control radius border2 box-c" rows="7" id="comment" placeholder="รายละเอียด">@if (isset($contactUs)){{ $contactUs->description_th }}@endif</textarea>
                                        <br>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">หัวข้อย่อย</label>
                                          <div class="col-sm-7">
                                        <input type="text" name="subtitle_th" class="form-control radius border2" placeholder="หัวข้อย่อย" required="required" @if (isset($contactUs)) value="{{ $contactUs->subtitle_th }}" @endif>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">ที่อยู่</label>
                                    <div class="col-sm-7">
                                        <textarea name="address_th" class="form-control radius border2 box-c" rows="4"id="comment" placeholder="ที่อยุ่..." required="required">@if (isset($contactUs)){{ $contactUs->address_th }}@endif</textarea>
                                        <br>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">อีเมล์</label>
                                    <div class="col-sm-7">
                                        <input type="email" name="email" class="form-control radius border2" placeholder="book@" required="required" @if (isset($contactUs)) value="{{ $contactUs->email }}" @endif>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">เบอร์โทร</label>
                                    <div class="col-sm-7">
                                        <input type="phone" name="phone" class="form-control radius border2" placeholder="000000000" required="required" @if (isset($contactUs)) value="{{ $contactUs->phone }}" @endif>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">facebook</label>
                                          <div class="col-sm-7">
                                        <input type="text" name="facebook" class="form-control radius border2" placeholder="https://www.facebook.com/" @if (isset($contactUs)) value="{{ $contactUs->facebook }}" @endif>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">twitter</label>
                                          <div class="col-sm-7">
                                        <input type="text" name="twitter" class="form-control radius border2" placeholder="https://www.twitter.com" @if (isset($contactUs)) value="{{ $contactUs->twitter }}" @endif>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Google map</label>
                                          <div class="col-sm-7">
                                        <input type="text" name="google_map" class="form-control radius border2" placeholder="https://www.google.co.th/maps/" @if (isset($contactUs)) value="{{ $contactUs->google_map }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-1"></div>
                                    <label for="inputEmail3" class="col-sm-4 control-label">Title</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="title_en" class="form-control radius border2" placeholder="Title" required="required" @if (isset($contactUs)) value="{{ $contactUs->title_en }}" @endif>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-1"></div>
                                    <label for="inputEmail3" class="col-sm-4 control-label">Description</label>
                                    <div class="col-sm-7">
                                        <textarea name="description_en" class="form-control radius border2 box-c" rows="7" id="comment" placeholder="Description">@if (isset($contactUs)){{ $contactUs->description_en }}@endif</textarea>
                                        <br>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-1"></div>
                                    <label for="inputEmail3" class="col-sm-4 control-label">SubTitle</label>
                                          <div class="col-sm-7">
                                        <input type="text" name="subtitle_en" class="form-control radius border2" placeholder="SubTitle" required="required" @if (isset($contactUs)) value="{{ $contactUs->subtitle_en }}" @endif>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-1"></div>
                                    <label for="inputEmail3" class="col-sm-4 control-label">Address</label>
                                    <div class="col-sm-7">
                                        <textarea name="address_en" class="form-control radius  border2  box-c" rows="4" id="comment" placeholder="Address..." required="required">@if (isset($contactUs)){{ $contactUs->address_en }}@endif</textarea>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                    </div>
                    <div class="row">
                        <center>
                            <button type="submit" class="btn btn-red">Save</button>
                            <button type="button" class="btn btn-black" onclick="reloadPage()">Cancel</button>
                        </center>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection @section('script')


<script type="text/javascript">
    function reloadPage(){
        location.reload();
    }
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
      $('input,textarea').focus(function(){

$(this).css('color','black');
});
    });
</script>
@endsection