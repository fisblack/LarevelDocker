{{-- 
    @author: วราทัศน์ พานทองถาวร
    @phone: 087-806-5868
    @email: boss119@hotmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('css/backOffice/website/categoryNewsAndEvent/create.css') }}">
@endsection

@section('body')       
<div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-11 pt-2">
                <form action="{{ route('backOffice.website.category-news-and-event.update', $data['categoryNews']->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="PUT">
                    <!-- START panel-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>
                                        <img src="{{asset('images/backOffice/categorynewsandevent/icon-categorynewsandevent.png')}}" alt="" /><span>Category News & Events</span> /Add
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <!-- End-Header -->

                        <div class="panel-body ">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 m-auto">
                                    <div class="panel-body__block">
                                        <fieldset>
                                            <div class="form-group form-group--inline">
                                                <label class="control-label">ชื่อภาษาไทย</label>
                                                <input type="text" class="form-control" name="name_th" id="name_th" placeholder="ข่าวทั่วไป" value="{{ $data['categoryNews']->name_th }}" required>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-group form-group--inline">
                                                <label class="control-label">ชื่อภาษาอังกฤษ</label>
                                                <input type="text" class="form-control" name="name_en" id="name_en" placeholder="News" value="{{ $data['categoryNews']->name_en }}" required>
                                            </div>
                                        </fieldset>
                                        <fieldset class="text-center">
                                            <button class="btn btn-primary btn-md btn-save" type="submit" name="save">Update</button>
                                            <button class="btn btn-primary btn-md btn-cancel" id="cancel" type="reset" name="cancel">Cancel</button>
                                        </fieldset>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End-Body -->

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

                            <!-- End-Footer -->
                    </div>
                    <!-- END panel-->

                </form>
            </div>
        </div>
    </div>         
@endsection

@section('script')
    <script src="{{ asset('js/backOffice/project_name/create.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('button#cancel').on('click',function(){
                window.location.href = '{{route('backOffice.website.category-news-and-event.store')}}';
            });
        });
    </script>
@endsection