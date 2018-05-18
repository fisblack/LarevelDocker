{{-- 
    @author: สันติกร สุธาอรรถ
    @phone: 0873569769
    @email: santikorn12@gmail.com
--}}

@extends('layouts.backOffice.template')

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,300i,400,400i,500,500i&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/backOffice/website/home/create.css') }}">
@endsection

@section('body')       
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="wrapper-page-backoffice">
                    <div class="sec-head">
                        <img src="{{ asset('images/backOffice/banner/icon-banner-BOF.png')}}" alt="">
                        <span>Banner</span>
                    </div>
                    <div class="wrapper-inside">
                        <form action="{{ route('backOffice.website.banner.store') }}" method="post" id="" class="" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="row">
                                <?php $no=1; ?>
                                @foreach($data['banners'] as $banner)
                                <input type="hidden" name="id[{{$banner->id}}]" value="{{$banner->id}}">
                                <div class="col-xs-12">
                                    <div class="item-banner">
                                        <div class="number">
                                            <span>{{ $no }}</span>
                                        </div>
                                        <div class="wrap-pic-slide">
                                            <div class="pic-slide">
                                                <img src="{{ getImage($banner->image) }}" alt="" id="display-{{$banner->id}}">
                                            </div>
                                        </div>
                                        <div class="detail-banner">
                                            <div class="browse-img gap-inline-form">
                                                <span class="title-detail">รูปที่ {{ $no++ }}</span>
                                                <div class="inline group-browse-file">
                                                    <a href="javascript:;" class="btn-browse" id="{{$banner->id}}"></a>
                                                    <input type="file" name="image[{{$banner->id}}]" placeholder="" class="hidden addimg">
                                                </div>
                                            </div>
                                            <div class="url-banner">
                                                <span class="title-detail">Url</span>
                                                <div class="inline input-url">
                                                    <input type="text" name="url_image[{{$banner->id}}]" value="{{ $banner->url_image }}" placeholder="Url" class="form-control">
                                                </div>
                                            </div>
                                            <div class="wrap-switch">
                                                <span class="title-detail">สถานะ</span>
                                                <div class="inline wrap-switch">
                                                    <a href="javascript:;" class="btn-switch @if($banner->is_show) active @endif"></a>
                                                    <input type="checkbox" name="is_show[{{$banner->id}}]" class="status hide" @if($banner->is_show) checked @endif>
                                                    <span class="text-switch">{{ $banner->is_show ? 'เปิด' : 'ปิด' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            @endforeach
                        </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <button type="submit" class="btn btn-md btn-primary btn-gap">Save</button>
                                    <a href="{{ route('backOffice.website.banner.index') }}" class="btn btn-md btn-cancel btn-gap">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>     
    <div class="container-fluid fit-gap-M">
        <div class="row">
            <div class="col-xs-12">
                <div class="wrapper-page-backoffice">
                    <form action="{{ route('backOffice.website.banner.update', $data['promotion']->id) }}" method="post" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="sec-head">
                            <img src="{{ asset('images/backOffice/banner/icon-banner-BOF.png')}}" alt="">
                            <span>Banner Promotion</span>
                        </div>  
                        <div class="wrapper-inside">
                            <div class="wrap-banner-promotion">
                                <div class="detail">
                                    @if(file_exists(storage_path($data['promotion']->image)))
                                    <img src="{{ getImage($data['promotion']->image) }}" alt="" id="display-{{ $data['promotion']->id }}">
                                    @endif
                                    <img src="" alt="" id="display-{{ $data['promotion']->id }}" class="hidden">
                                    <div class="wrap-flex flex-banner-promotion">
                                        <div class="browse-img gap-inline-form">
                                            <span class="title-detail">รูปภาพ</span>
                                            <div class="inline group-browse-file">
                                                <a href="javascript:;" class="btn-browse" id="{{ $data['promotion']->id }}"></a>
                                                <input type="file" name="image" value="" placeholder="" class="hidden">
                                            </div>
                                        </div>
                                        <div class="inline input-url">
                                            <input type="text" name="url_image" value="{{$data['promotion']->url_image}}" placeholder="Url" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <button type="submit" class="btn btn-md btn-primary btn-gap">Save</button>
                                <a href="{{ route('backOffice.website.banner.index') }}" class="btn btn-md btn-cancel btn-gap">Cancel</a>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section('script')
    <!-- <script src="{{ asset('js/backOffice/project_name/create.js') }}"></script> -->
<script>
$(document).ready(function(){
    $('a.btn-switch').on('click',function(){
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            $(this).parent('.wrap-switch').find('.text-switch').html('เปิด');
            $(this).parent('.wrap-switch').find('.status').attr('checked', true);
        }else{
            $(this).parent('.wrap-switch').find('.text-switch').html('ปิด');
            $(this).parent('.wrap-switch').find('.status').attr('checked', false);
        }
    });

    $('a.btn-browse').on('click',function(){
        const id = $(this).attr('id');
        $(this).parent('.group-browse-file').find('input[type="file"]').trigger('click');
        
        $(this).parent('.group-browse-file').find('input[type="file"]').change(function(){
            readURL(this, id);
        }); 
    });

    function readURL(input, id) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            console.log(reader)
            reader.onload = function (e) {
                $('#display-'+id).attr('src', e.target.result);
                $('#display-'+id).removeClass('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
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