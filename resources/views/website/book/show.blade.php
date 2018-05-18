@extends('layouts.website.template')

@section('head')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/website/book/show.css')}}"/>
  <link rel="stylesheet" href="{{ asset('js/plugins/slick-1.6.0/slick/slick.css')}}">
@endsection

@section('title')
{{ $product->name }}
@endsection

@section('body')

<div class="content">
  <section class="book-detail-container">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h1 class="text-title">{{ getLang() == 'en' ? $product->name_en : $product->name }}</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-md-offset-2">
          <a href="" data-toggle="modal" data-target="#modalSlideBook">
            <div class="cover-book">
              <span class="label">{{ getLang() == 'en' ? $product->productType->name_en : $product->productType->name }}</span>
              <img src="{{ !empty($product->coverImage) ? getImage($product->coverImage->image) : noImage() }}" alt="">
              <div class="caption-point">{{ $product->point_redemption_for_free_gift }} {{ trans('page.point') }}</div>
            </div>
          </a>
          <div class="rating">
            <i class="fa fa-star fa-2x"></i>
            <i class="fa fa-star fa-2x"></i>
            <i class="fa fa-star fa-2x"></i>
            <i class="fa fa-star fa-2x"></i>
            <i class="fa fa-star fa-2x"></i>
          </div>
        </div>

        <div class="col-md-6">
          <div class="detail pl-3">
            <table class="detail-intro">
              <tr>
                <td>{{ trans('page.productName') }}</td>
                <td>:</td>
                <td>{{ getLang() == 'en' ? $product->name_en : $product->name }}</td>
              </tr>
              <tr>
                <td>ISBN</td>
                <td>:</td>
                <td>{{ $product->isbn }}</td>
              </tr>
            </table>
            <table>
              <tr>
                <td>{{ trans('page.totalPage') }}</td>
                <td>:</td>
                <td>{{ $product->page_count }} {{ trans('page.pages') }}</td>
              </tr>
              <tr>
                <td>{{ trans('page.writer') }}</td>
                <td>:</td>
                @if(getLang() == 'en')
                <td class="text-primary-bold">{{ !empty($product->writer()->first()) ? $product->writer()->first()->fullname_en : '' }}</td>
                @else
                <td class="text-primary-bold">{{ !empty($product->writer()->first()) ? $product->writer()->first()->fullname_th : '' }}</td>
                @endif
              </tr>
              <tr>
                <td>{{ trans('page.price') }}</td>
                <td>:</td>
                <td><del>{{ $product->suggested_retail_price }} {{ trans('page.bath') }}</del></td>
              </tr>
              <tr>
                <td>{{ trans('page.memberPrice') }}</td>
                <td>:</td>
                <td>{{ $product->suggested_member_price }} {{ trans('page.bath') }}</td>
              </tr>
            </table>

            <div class="add-to-cart">
              <div class="quantity">
                <input id="qty" type="number" min="1" value="1">
              </div>
              <button class="btn-add-cart" onclick="cart({{ $product->id }})">
                <i class="fa fa-shopping-cart"></i>
                {{ trans('page.addToCart') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container">
    <div class="short-story">
      <p>{!! $product->description !!}</p>
      @if(fileStorage_exit($product->file_ref))
      <a class="btn-read-simple" id="btn-read-simple" target="_blank" href="{{ asset($product->file_ref) }}">{{ trans('page.example') }}</a>
      @endif
    </div>
  </div>
</div>

<div class="bg-secondary-color">
  <div class="container">
    <div class="row">
      <div class="fb-comments" data-href="{{ route('news-and-event.show', $product->id) }}" data-width="100%" data-numposts="5"></div>
    </div>
  </div>
</div>

<!-- Modal Slide Book -->
<div class="modal fade" id="modalSlideBook" tabindex="-1" role="dialog" aria-labelledby="modalSlideBookLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
        <div class="image-slider-content">
          <div class="row justify-content-center">
            <div class="col-sm-8 col-sm-offset-2">
              <div class="slider-for">
                @foreach($product->imageCover()->get() as $bookCover)
                <div class="item text-center"><span class="helper"></span><img src="{{ getImage($bookCover->image) }}"> </div>
                @endforeach
              </div>
              <div class="slider-nav">
                @foreach($product->imageCover()->get() as $bookCover)
                <div class="item text-center"><span class="helper"></span><img src="{{ getImage($bookCover->image) }}"> </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<!-- Flipbook -->
<div class="flipbook-wrap">
  <div class="flipbook-content">
    <div class="flipbook-close">
      <i class="fa fa-remove fa-2x"></i>
    </div>
    <div class="container">
      <div id="flipbook">
        <div class="hard"><img src="{{ asset('images/book/book-1.png')}}"></div>
        <div class="hard"><img src="{{ asset('images/book/book-2.png')}}"></div>
        <div class="hard"><img src="{{ asset('images/book/book-3.png')}}"></div>
        <div class="hard"><img src="{{ asset('images/book/book-4.png')}}"></div>
        <div class="hard"><img src="{{ asset('images/book/book-5.png')}}"></div>
        <div class="back-cover">&nbsp;</div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    {{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> -->  --}}

    <!-- Slick js -->
    <script src="{{ asset('js/plugins/slick-1.6.0/slick/slick.js')}}"></script>

    <!-- Turnjs -->
    <script src="{{ asset('js/plugins/turnjs4/lib/turn.min.js')}}"></script>

    <script type="text/javascript">
    $(document).ready(function(){

      $('#modalSlideBook').on('shown.bs.modal', function (e) {
        $('.slider-for').slick({
          setPosition: 'resize',
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '.slider-nav'
        });

    $('.slider-nav').slick({
      setPosition: 'resize',
      slidesToShow: 3,
      slidesToScroll: 1,
      asNavFor: '.slider-for',
      dots: false,
      centerMode: true,
      focusOnSelect: true,
      prevArrow: '<i class="fa fa-2x fa-chevron-left slick-prev"></i>',
      nextArrow: '<i class="fa fa-2x fa-chevron-right slick-next"></i>',
    });
  })

    $("#flipbook").turn({
      width: 600,
      height: 420,
      elevation: 50,
      gradients: true,
      autoCenter: true
    });

      // Flipbook
//    $('#btn-read-simple').click(function() {
//    $('.flipbook-wrap').fadeIn();
//    });

    $('.flipbook-close').click(function() {
    $('.flipbook-wrap').fadeOut();
    });

      $(window).click(function(e) {
        let el = $(e.target).attr('class');
        if ( el == 'image-slider-wrap' || el == 'flipbook-wrap') {
          $('.image-slider-wrap').fadeOut();
          $('.flipbook-wrap').fadeOut();
        }
      });
    });
    </script>

    <script>
      jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
      jQuery('.quantity').each(function() {
        var spinner = jQuery(this),
          input = spinner.find('input[type="number"]'),
          btnUp = spinner.find('.quantity-up'),
          btnDown = spinner.find('.quantity-down'),
          min = input.attr('min'),
          max = input.attr('max');

        btnUp.click(function() {
          var oldValue = parseFloat(input.val());
          if (oldValue >= max) {
            var newVal = oldValue;
          } else {
            var newVal = oldValue + 1;
          }
          spinner.find("input").val(newVal);
          spinner.find("input").trigger("change");
        });

        btnDown.click(function() {
          var oldValue = parseFloat(input.val());
          if (oldValue <= min) {
            var newVal = oldValue;
          } else {
            var newVal = oldValue - 1;
          }
          spinner.find("input").val(newVal);
          spinner.find("input").trigger("change");
        });

      });
    </script>
@endsection
