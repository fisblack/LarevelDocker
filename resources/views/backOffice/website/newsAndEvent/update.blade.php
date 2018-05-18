{{-- 
    @author: วราทัศน์ พานทองถาวร
    @phone: 087-806-5868
    @email: boss119@hotmail.com
--}}


@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet"> 
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/website/newsAndEvent/create.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-lite.css') }}">
    
@endsection

@section('body')       
 
<div class="container-fluid page-backoffice-news&events">

        <div class="row">

            <div class="col-xs-12 col-md-11 pt-2">

                <form action="{{ route('backOffice.website.news-and-event.update', $data['newsAndEvent']->id) }}" method="POST" enctype="multipart/form-data">

                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="member_id" value="1">

                    <!-- START panel-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>
                                        <img src="{{asset('images/backOffice/newsandevent/icon-newsandevent.png')}}" alt="" /><span>News & Events</span> / Add
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">

                            <h3 class="title">เพิ่มข่าว</h3>

                            <div class="row">
                                <div class=" col-md-5">
                                    <fieldset>
                                        <div class="form-group form-group--inline">
                                            <label class="control-label">หมวด</label>
                                            <select class="form-control" name="category_news_events_id" id="group-select" placeholder="News & Event" value="{{ old('group-select') }}" required>
                                                @foreach($data['categories'] as $category)  
                                                <option value="{{ $category->id }}" {{$category->id == $data['newsAndEvent']->category_news_events_id ? 'selected' : null }}>{{ $category->name_th }}</option>
                                                @endforeach
                                            </select>
                                         </div>
                                    </fieldset>
                                </div>

                                <div class=" col-md-1"></div>
                                
                                <div class=" col-md-5">
                                    <div class="form-group form-group--inline">
                                        <div class='input-group date'>
                                            <label class="control-label">วันที่เขียนข่าว</label>
                                            <input type='text' name="news_events_date" value="{{ old('news_events_date') ? old('news_events_date') : $data['newsAndEvent']->news_events_date }}" placeholder="dd/mm/yyyy" class="form-control" id="datetimepicker1" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-5">
                                    <fieldset>
                                        <div class="form-group form-group--inline">
                                            <label class="control-label">ชื่อข่าว (ไทย)</label>
                                            <input type="text" class="form-control" name="title_th" id="news-input" placeholder="ชื่อข่าว" value="{{ old('title_th') ? old('title_th') : $data['newsAndEvent']->title_th  }}" required>
                                         </div>
                                    </fieldset>
                                    
                                    <fieldset>
                                        <div class="form-group form-group--inline">
                                            <label class="control-label">รายละเอียดอย่อ (ไทย)</label>
                                            <textarea class="form-control short_description" name="short_description_th" id="detail-news-input" placeholder="รายละเอียด (ไทย)" rows="5" cols="20" >{{ old('short_description_th') ? old('short_description_th') : $data['newsAndEvent']->short_description_th }}</textarea>
                                         </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group form-group--inline">
                                            <label class="control-label">รายละเอียด (ไทย)</label>
                                            <textarea type="text" class="form-control textarea" name="description_th" id="detail-news-input" placeholder="รายละเอียด (ไทย)" rows="5" cols="20" >{{ old('description_th') ? old('description_th') : $data['newsAndEvent']->description_th }}</textarea>
                                         </div>
                                    </fieldset>
                                </div>

                                <div class=" col-md-1"></div>

                                <div class=" col-md-5">
                                    <fieldset>
                                        <div class="form-group form-group--inline">
                                            <label class="control-label">ชื่อข่าว (อังกฤษ)</label>
                                            <input type="text" class="form-control" name="title_en" id="news-input" placeholder="ชื่อข่าว (อังกฤษ)" value="{{ old('title_en') ? old('title_en') : $data['newsAndEvent']->title_en }}" required>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group form-group--inline">
                                            <label class="control-label">รายละเอียดย่อ (อังกฤษ)</label>
                                            <textarea class="form-control short_description" name="short_description_en" id="detail-news-input" placeholder="Description" rows="5" cols="20" >{{ old('short_description_en') ? old('short_description_en') : $data['newsAndEvent']->short_description_en }}</textarea>
                                        </div>
                                    </fieldset>
                                    
                                    <fieldset>
                                        <div class="form-group form-group--inline">
                                            <label class="control-label">รายละเอียด (อังกฤษ)</label>
                                            <textarea type="text" class="form-control textarea" name="description_en" id="detail-news-input" placeholder="Description" rows="5" cols="20" >{{ old('description_en') ? old('description_en') : $data['newsAndEvent']->description_en }}</textarea>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <div class="form-group form-group--inline">
                                                    <label class="control-label">แบนเนอร์ข่าว (1920 x 450)</label>  
                                                    <div class="input-group upload__images">
                                                        <label class="input-group-btn">
                                                            <span class="btn btn-primary btn-file">
                                                                เลือก <input type="file" name="banner" id="Imgbanner" style="display: none;" multiple>
                                                            </span>
                                                        </label>
                                                        <input type="text" class="form-control" readonly>
                                                    </div>
                                                    <div style="padding-top: 20px;">
                                                        <img id='banner-upload' src="{{ getImage($data['newsAndEvent']->banner) }}" width="100%">
                                                    </div>
                                                    
                                                 </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12">
                                            <fieldset>
                                                <div class="form-group form-group--inline">
                                                    <label class="control-label">รูปหน้าปก (360 x 300)</label>  
                                                    <div class="input-group upload__images">
                                                        <label class="input-group-btn">
                                                            <span class="btn btn-primary btn-file">
                                                                เลือก <input type="file" name="image" id="imgInp" style="display: none;" multiple>
                                                            </span>
                                                        </label>
                                                        <input type="text" class="form-control" readonly>
                                                    </div>
                                                    <div>
                                                        <img id='img-upload' src="{{ getImage($data['newsAndEvent']->image) }}" width="100%">
                                                    </div>
                                                 </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class=" col-md-1"></div>

                                <div class=" col-md-5">
                                    <fieldset>
                                        <div class="form-group form-group--inline">
                                            <label class="control-label">สถานะ</label>
                                            <label class="switch">
                                                <input {{ old('is_show') || $data['newsAndEvent']->is_show ? 'checked' : '' }} data-toggle="toggle" type="checkbox" name="is_show">
                                                <span class="slider">
                                                    <label class="status__show" style="width: 50px;">ไม่แสดง</label>
                                                    <label class="status__hide">แสดง</label>
                                                </span>
                                            </label>
                                         </div>
                                    </fieldset>
                                    
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-12">
                                    <fieldset class="text-center">
                                        <button class="btn btn-primary btn-md btn-save" type="submit" name="save">Save</button>
                                        <a href="{{ route('backOffice.website.news-and-event.index') }}" class="btn btn-primary btn-md btn-cancel">Cancel</a>
                                    </fieldset>
                                </div>
                            </div>

                        </div>

                         <div class="panel-footer">
                            <!-- ERROR MESSAGES -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div> 

                    </div>
                    <!-- END panel-->
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
<script src="{{ asset('js/backOffice/website/newsAndEvent/create.js') }}"></script>
<script src="{{ asset('js/plugins/summernote/summernote-lite.js') }}"></script>
<script>
$(document).ready( function() {
    $('.textarea').summernote({
        tabsize: 1,
        height: 300
    });

    $('.short_description').summernote({
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
    ],
    height: 100
});

    $('#datetimepicker1').val('{{$data['newsAndEvent']->news_events_date}}')
});
</script>
@endsection