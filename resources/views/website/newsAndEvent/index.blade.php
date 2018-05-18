@extends('layouts.website.template')

@section('head')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/news_and_event.css')}}"/>
@endsection

@section('title')
{!! App::isLocale('en') ? 'News and events' : 'ข่าวและกิจกรรม' !!}
@endsection

@section('body')
    <div class="page_news_and_event">
      <div class="container-fluid bg-news">
        <div class="row">
            <div class="container">
              @if(empty($data['newsAndEvent']))
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <h2 style="text-align: center; color: white;">Empty</h2>
                </div>
              </div>
              @else
              <div class="row">
                  <div class="col-xs-12 col-sm-8 col-md-3 col-lg-3">
                    <figure class="img-toppic">
                      <a href="{{ route('news-and-event.show', ['id'=> $data['newsAndEvent']->id]) }}" class="thumbnail">
                        <img src="{{ getImage($data['newsAndEvent']->image) }}" alt="{{ $data['newsAndEvent']->title_en }}" class="img-fluid">
                      </a>
                    </figure>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-9 col-lg-9">
                  <div class="header-title">
                    <h3 class="title">
                        {!! App::isLocale('en') ? $data['newsAndEvent']->title_en : $data['newsAndEvent']->title_th !!}
                    </h3>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-12 col-lg-9">
                  <div class="detail clearfix">
                    <div class="detail-header">
                      <span class="title">
                        July James
                      </span>
                      <span class="writer">
                        Books Writer
                      </span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 detail-content">
                      {!! App::isLocale('en') ? $data['newsAndEvent']->short_description_en : $data['newsAndEvent']->short_description_th !!}
                    </div>
                  
                  </div>
                  <div class="footer">

                    <span class="title">
                      follow us
                    </span>
                    <span class="icon fb">
                      <i class="fa fa-facebook fa-lg" aria-hidden="true"></i>
                    </span>
                    <span class="icon tw">
                      <i class="fa fa-twitter fa-lg" aria-hidden="true"></i>
                    </span>
                  </div>
                </div>
              </div>
              @endif
            </div>
        </div>

      </div>
      @if( count($data['lastPosts']) > 0 )
      <div class="container-fluid lastest_blog">
        <div class="row">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 class="title">
                  Lastest blog post
                </h3>
              </div>
            </div>
            <div class="row">
  
              @foreach($data['lastPosts'] as $newsLastPost)
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <figure class="blog-new-img clearfix">
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pad-0">
                    <a href="{{ route('news-and-event.show',['id'=> $newsLastPost->id]) }}" class="thumbnail">
                      <img style="width: 175px; height: 245px;" src="{{ getImage($newsLastPost->image) }}" alt="" class="img-fluid">
                    </a>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pad-0">
                    <div class="detail">
                      <span class="icon">
                        <i class="fa fa-user fa-lg" aria-hidden="true"></i>
                        {{ $newsLastPost->user->full_name }}
                      </span>
                      <span class="desc">
                        {!!
                          App::isLocale('en') ? 
                            $newsLastPost->title_en 
                            :
                            $newsLastPost->title_th
                        !!}
                      </span>
                      <span class="time clearfix">

                        <div class="col-xs-12 col-sm-6 col-md-6 pad-0">
                          <i class="fa fa-calendar" aria-hidden="true"></i>
                          <span class="text">
                            {{ \Carbon\Carbon::parse($newsLastPost->news_events_date)->format('F j\\, Y') }}
                          </span>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 pad-0">
                          <i class="fa fa-comment-o" aria-hidden="true"></i>
    
                          <span class="text">
                            <span class="fb-comments-count" data-href="{{ route('news-and-event.show', $newsLastPost->id) }}"></span> comment
                          </span>
                        </div>
                      </span>
                    </div>
                  </div>
                </figure>
              </div>
              @endforeach
              
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
@endsection

@section('script')

@endsection
