@extends('layouts.website.template')

@section('head')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/about_us.css')}}"/>

@endsection

@section('body')
<div class="page_about_us bg-about-us">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-9 col-md-10 group-head">
                <figure>
                    <img src="{{ getImage($aboutUs->image_head) }}" class="img img-responsive img-center" alt="">
                    <div class="title text-center">
                        {{$aboutUs->title}}
                    </div>
                    <div class="detail text-center">
                        {{$aboutUs->head_description}}
                    </div>
                </figure>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-2 group-detail-right">
                <div class="heade-title">
                    {{ $contactUs->title_th }}
                </div>
                <address class="address">
                    {{ $contactUs->address_th }}
                </address>
                <address class='email'>
                    <p>{{ $contactUs->email }}</p>
                    <p>{{ $contactUs->phone }}</p>
                </address>
                <span class="icon">
                    <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>
                    Place
                </span>
            </div>
        </div>
        <div class="row group-content">
            <div class="col-xs-12 col-sm-12 col-md-12 ">
                <div class="gp-img">
                    <img src="{{ asset('images/06_about_us/up.png')}}" class="" alt="">
                </div>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 group-img-left">
                <figure>
                    <img src="{{ getImage($aboutUs->image_1) }}" class="img img-responsive img-one" alt="">
                </figure>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 group-img-right">
                <figure>
                    <img src="{{ asset('images/06_about_us/about-right.png')}}" class="img img-responsive" alt="">
                </figure>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 group-midde-left">
                <p>{{$aboutUs->description_1}}</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 group-midde-right">
                <figure>
                    <img src="{{ getImage($aboutUs->image_2) }}" class="img img-responsive img-two" alt="">
                </figure>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 group-ps-right">
                <div class="text">
                    <p>{{$aboutUs->description_2}}</p>
               
                    
                    
                    
                    
                     @foreach($writers as $item)

                        <a href="{{ route('writer.show', $item->id) }}">
                        
                        
                            @if($item->image)
                                <img src="{{ getImage($item->image) }}"
                                     class="writer_item" />
                            @else
                                <img src="{{ getImage('images/website/writer/writer-1.png')}}"
                                     class="writer_item" />
                            @endif
                            
                            
                            
                        </a>
    
                @endforeach

  
                    
                    
                 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 group-last">
                <p>{{$aboutUs->footer}}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
