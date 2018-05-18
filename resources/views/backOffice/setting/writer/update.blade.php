{{--
    @author: ระบุชื่อ-นามสกุลของคุณที่นี่
    @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
    @email: ระบุอีเมลของคุณที่นี่
--}}

@extends('layouts.backOffice.template')

@section('head')
	<link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/setting/writer/create.css') }}">
@endsection

@section('body')
<div class="container-fluid page-backoffice-writers-create">

    <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box-header-white clearfix" style="">
                    <div class="header-left clearfix" style=" ">
                        <figure style="">
                            <img src="{{asset('images/backOffice/writers/writers.png')}}" class="w-100" alt="">
                        </figure>
                        <a href="#" class="title">
                            Writers
                        </a>
                        <a href="#" class="title active">
                            / Edit
                        </a>
                    </div>

                </div>
            </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="box-result" style="">
                <div class="row">
                    <div class="col-md-12 ">
                        <form action="{{ route('backOffice.setting.writer.update', $writer->id) }}" method="POST" class="form-horizontal form-writers clearfix" role="form" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            {{ method_field('PUT')}}
                            <div class="form-group">
                                <label for="input" class="col-xs-12 col-sm-2 control-label">
                                    <span class="author">
                                        เพิ่มข้อมูลผู้เขียน
                                    </span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="input" class="col-sm-2 control-label">
                                    ชื่อ
                                </label>
                                <div class="col-sm-4">
                                    <input type="text" name="name_th" placeholder="ชื่อ" id="input" class="form-control"  required="required" value="{{ (old('fullname_th')) ? old('fullname_th') : $writer->fullname_th }}">
                                </div>
                                <label for="input" class="col-sm-2 control-label">
                                    Name
                                </label>
                                <div class="col-sm-4">
                                    <input type="text" name="name_en" placeholder="Name" id="input" class="form-control"  required="required" value="{{ (old('fullname_en')) ? old('fullname_en') : $writer->fullname_en }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input" class="col-sm-2 control-label">
                                    รายละเอียด
                                </label>
                                <div class="col-sm-4">
                                    <textarea name="desc_th" id="input" class="form-control" rows="5" placeholder="ราบละเอียด..." required="required">{{ (old('desc_th')) ? old('desc_th') : $writer->description_th }}</textarea>
                                </div>
                                <label for="input" class="col-sm-2 control-label">
                                    Description
                                </label>
                                <div class="col-sm-4">

                                    <textarea name="desc_en" id="input" class="form-control" rows="5" placeholder="Description..." required="required">{{ (old('desc_th')) ? old('desc_th') : $writer->description_en }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input" class="col-sm-2 control-label">
                                    รูปภาพ
                                </label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-browse ">
                                                Browse&hellip; <input type="file"  style="display: none;" accept="image/*" name="writer_img" multiple>
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input" class="col-sm-2 control-label">
                                    My Image:
                                </label>
                                <div class="col-sm-4">
                                    <figure>
                                        @if(!$writer->image)
                                        <img src="{{asset('images/backOffice/writers/preview.png')}}" id="display-profile-picture" class="img img-responsive" alt="">
                                        @else
                                        <img src="{{ getImage($writer->image) }}" id="display-profile-picture" class="img img-responsive" alt="">
                                        @endif
                                    </figure>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-12 text-center ">
                                    <button type="submit" class="btn btn-save">save</button>
                                    <button type="button" class="btn btn-cancel">cancel</button>
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
    <script>
        $(function() {


          $(document).on('change', ':file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
          });


            $(document).ready( function() {
                $(':file').on('fileselect', function(event, numFiles, label) {

                    var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                    if( input.length ) {
                          input.val(log);
                          readURL(this);
                    } else {
                          if( log ) alert(log);
                    }

                  });
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        console.log(reader)
                        reader.onload = function (e) {
                            $('#display-profile-picture').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            });

        });
    </script>
@endsection
