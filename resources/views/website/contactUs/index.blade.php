@extends('layouts.website.template')

@section('head')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/contact_us.css')}}"/>

@endsection

@section('body')
<div class="page_contact_us bg-contact">
    <div class="container ">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-12 col-lg-12">
                <div class="container header-title clearfix">
                    <h3 class="title">
                        {{ $contactUs->title_th }}
                    </h3>
                    <p class="desc">
                        {{ $contactUs->description_th }}
                    </p>
                </div>
            </div>
        </div>

        <div class="row row-relative">
            <div class="container group-map">
                <div id="map" style="" class="col-md-8"></div>
                <div id="list-detail" class="col-md-4">
                    <h3 class="title">
                        {{ $contactUs->subtitle_th }}
                    </h3>
                    <ul class="list-unstyled list-detail ">
                        <li class="clearfix">
                            <span class="icon">
                                <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>
                            </span>
                            <span class="detail">
                                {{ $contactUs->address_th }}
                            </span>
                        </li>
                        <li class="clearfix">
                            <span class="icon">
                                <i class="fa fa-mobile fa-lg" aria-hidden="true"></i>
                            </span>
                            <span class="detail red">
                                {{ $contactUs->phone }}
                            </span>
                        </li>
                        <li class="clearfix">
                            <span class="icon">
                                <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                            </span>
                            <span class="detail">
                                {{ $contactUs->email }}
                            </span>
                        </li>
                    </ul>
                    <ul class="list-inline list-logo">
                        <li>
                            <a class="icon" target="_blank" href="https://{{ $contactUs->facebook }}">
                                <i class="fa fa-facebook fa-lg" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a class="icon" target="_blank" href="https://{{ $contactUs->twitter }}">
                                <i class="fa fa-twitter fa-lg" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <figure>
                                <img src="{{ asset('images/07_contact_us/logo-detail.png')}}" alt="">
                            </figure>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('script')
  <script>
        function initMap() {
          var uluru = {lat: 13.8625101, lng: 100.6661267};
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: uluru
          });
          var marker = new google.maps.Marker({
            position: uluru,
            map: map
          });
        }
  </script>
  <script async defer>
        var googleMapUrl = {!! json_encode($contactUs->google_map) !!};
        var script = document.createElement('script');
        script.src = googleMapUrl;
        document.getElementsByTagName('script')[0].parentNode.appendChild(script);
  </script>  

@endsection


