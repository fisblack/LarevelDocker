@extends('layouts.website.template')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/news_and_event.css')}}"/>

@endsection

@section('title')
{!! App::isLocale('en') ? $data['newsAndEvent']->title_en : $data['newsAndEvent']->title_th !!}
@endsection

@section('body')
    <div class="page_news_and_event_detail">
        <div class="container">
        <div class="row hidden-xs">
          
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <figure class="img-toppic">
              <img src="{{ getImage($data['newsAndEvent']->banner) }}" class="img img-responsive" alt="">
            </figure>
          </div>

        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="group-detail">
              <h5 class="title-top">
                ข่าวและกิจกรรม
              </h5>
              <h1 class="title-middle">
                {!! App::isLocale('en') ? $data['newsAndEvent']->title_en : $data['newsAndEvent']->title_th !!}
              </h1>
              <h6 class="title-bot">
                Contrary to popular belief,
              </h6>
            </div>
          </div>
        </div>
        <div class="row">

          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="group-detail-desc">
              <div class="col-xs-12 col-sm-2 col-md-2 share">
                <span class="title-share" id="share-counts">0</span>
                <span class="title-share-sub">
                  share
                </span>
              </div>
              <div class="col-xs-12 col-sm-5 col-md-5 share pad-2">
                <button class="btn btn-fb sharer" data-sharer="facebook" data-title="{!! App::isLocale('en') ? $data['newsAndEvent']->title_en : $data['newsAndEvent']->title_th !!}" data-url="{{ url()->full() }}">
                  <i class="fa fa-facebook fa-lg" aria-hidden="true"></i>
                  Share
                </button>

              </div>
              <div class="col-xs-12 col-sm-5 col-md-5 share pad-2">
                <button class="btn btn-tw sharer" data-sharer="twitter" data-title="{!! App::isLocale('en') ? $data['newsAndEvent']->title_en : $data['newsAndEvent']->title_th !!}" data-url="{{ url()->full() }}">
                  <i class="fa fa-twitter fa-lg" aria-hidden="true"></i>
                  Share
                </button>

              </div>
              {!! App::isLocale('en') ? $data['newsAndEvent']->description_en : $data['newsAndEvent']->description_th !!}
              <button class="btn btn-fb-singler sharer" data-sharer="facebook" data-title="{!! App::isLocale('en') ? $data['newsAndEvent']->title_en : $data['newsAndEvent']->title_th !!}" data-url="{{ url()->full() }}">
                <i class="fa fa-facebook fa-lg" aria-hidden="true"></i>
                Share
              </button>
              <button class="btn btn-tw-singler sharer" data-sharer="twitter" data-title="{!! App::isLocale('en') ? $data['newsAndEvent']->title_en : $data['newsAndEvent']->title_th !!}" data-url="{{ url()->full() }}">
                <i class="fa fa-twitter fa-lg" aria-hidden="true"></i>
                Share
              </button>
            </div>
            <div>
            <div class="fb-comments" data-href="{{ route('news-and-event.show', $data['newsAndEvent']->id) }}" data-width="100%" data-numposts="5"></div>
            </div>
          </div>
        </div>

        </div>

      <div class="container-fluid bg-our-news">
        <div class="row">
          <div class="container our-news">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <h3 class="title">
                    OUR LATEST NEWS
                  </h3>
                </div>
            </div>
            <div class="row">
              <div class="row">
                @foreach($data['lastPosts'] as $lastPost)
                <div class="col-xs-12 col-sm-3 col-md-4 col-lg-4">
                  <figure class="blog-img">

                    <div class="thumbnail">
                      <img src="{{ getImage($lastPost->image) }}" style="    min-width: 100%;" class="img img-responide" alt="">
                      <div class="caption">
                        <p>{{ \Carbon\Carbon::parse($lastPost->news_events_date)->format('F j\\, Y') }}</p>
                        <p class="title-detail">
                          {!! App::isLocale('en') ? $lastPost->title_en : $lastPost->title_th !!}
                        </p>
                        <p class="desc">
                          {!! App::isLocale('en') ? $lastPost->short_description_en : $lastPost->short_description_th !!}
                        </p>
                        <p class="more">
                          <a href="{{ route('news-and-event.show', $lastPost->id) }}" class="readmore">READ >></a>

                        </p>
                      </div>
                    </div>
                  </figure>
                </div>
                @endforeach
              </div>

            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a href="{{ route('news-and-event.index') }}" class="view-all">
                  view all news
                </a>
              </div>
            </div>
            </div>
        </div>
      </div>

    </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
<script src="{{ asset('js/website/socialcount.js')}}"></script>
<script>
  Socialcount.get('facebook', window.location.href, (count) => {
    console.log(count)
    $('#share-counts').text(count)
  })


</script>
@endsection
