@extends('layouts.website.template')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/website/writer/show.css')}}"/>

@endsection

@section('body')
<div class="sec-writer">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-5">
        <div class="wrap-writer text-center">
          <div class="pic">
            @if($writer->image !='')
              <img src="{{ getImage($writer->image) }}"
                   width="191"
                   height="190"/>
            @else
              <img src="{{ getImage('images/12_writer-list-detail/profile-writer.png') }}"
                   width="191"
                   height="190"
              />
            @endif
          </div>
          <div class="name-writer">
            {{ getLang() =='en' ?$writer->fullname_en :$writer->fullname_th }}
            <span>{{trans('page.writer')}}</span>
          </div>
          <div class="more-detail">
            <p>
             {{ getLang() =='en' ? $writer->description_en :$writer->description_th }}
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-sm-7">
        <div class="row">
          @foreach($writer->productWriter as $key)
          <div class="col-md-6 col-sm-12">
            <div class="book-list-detail">
              <div class="pic-book">
                <a href="{{ route('book.show', $key->id) }}">
                  <img src="{{ !empty($key->coverImage) ? getImage($key->coverImage->image) : "" }}"
                       alt=""
                       width="142"
                       height="208"
                  >
                </a>
              </div>
              <div class="detail-book">
                <p class="title"><a href="{{ route('book.show', $key->id) }}">
                  <span>{{ $key->name }}</span></a> <br>
                  โดย : {{ getLang() =='en' ?$writer->fullname_en :$writer->fullname_th }}</p>
                <div class="wrap-price">
                  <div class="normal-price">
                    {{ trans('page.price') }}: <span>{{$key->suggested_retail_price}} {{ trans('page.bath') }}</span>
                  </div>
                  <div class="member-price">
                    {{ trans('page.mamberPrice') }} : <span>{{$key->suggested_member_price}} {{ trans('page.bath') }}</span>
                  </div>
                </div>
                <div><a href="javascript:;" class="add-cart"  onclick="cart({{ $key->id }})">
                        <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>
                    {{ trans('page.addToCart') }}
                    </a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          {{--<div class="col-md-6 col-sm-12">--}}
            {{--<div class="book-list-detail">--}}
              {{--<div class="pic-book">--}}
                {{--<a href="{{ route('book.show', 1) }}"><img src="{{ asset('images/12_writer-list-detail/book-02.jpg')}}" alt=""></a>--}}
              {{--</div>--}}
              {{--<div class="detail-book">--}}
                {{--<p class="title"><a href="{{ route('book.show', 1) }}"><span>Knock Knock ส่งรักมาทักหัวใจ!</span></a> <br>โดย : Babylinlin</p>--}}
                {{--<div class="wrap-price">--}}
                  {{--<div class="normal-price">ราคาปกติ : <span>688 บาท</span></div>--}}
                  {{--<div class="member-price">ราคาสมาชิก : <span>206 บาท</span></div>--}}
                {{--</div>--}}
                {{--<div><a href="" class="add-cart"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> เพิ่มลงตระกร้า--}}
                  {{--</a></div>--}}
              {{--</div>--}}
            {{--</div>--}}

          {{--</div>--}}
          {{--<div class="col-md-6 col-sm-12">--}}
            {{--<div class="book-list-detail">--}}
              {{--<div class="pic-book">--}}
                {{--<a href="{{ route('book.show', 1) }}"><img src="{{ asset('images/12_writer-list-detail/book-03.jpg')}}" alt=""></a>--}}
              {{--</div>--}}
              {{--<div class="detail-book">--}}
                {{--<p class="title"><a href="{{ route('book.show', 1) }}"><span>Pretty Boy เปลี่ยนตัวร้ายเป็นคนรัก</span></a> <br>โดย : Babylinlin</p>--}}
                {{--<div class="wrap-price">--}}
                  {{--<div class="normal-price">ราคาปกติ : <span>688 บาท</span></div>--}}
                  {{--<div class="member-price">ราคาสมาชิก : <span>197 บาท</span></div>--}}
                {{--</div>--}}
                {{--<div><a href="" class="add-cart"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> เพิ่มลงตระกร้า</a></div>--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</div>--}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

@endsection
