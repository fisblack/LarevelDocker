@extends('layouts.website.template')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/website/book/index.css')}}"/>
@endsection

@section('title')
{{ getLang() === 'en' ? 'Product' : 'สินค้า' }}
@endsection

@section('body')
    <div class="container-fluid book-slide" style="background-image: url({{ !empty( $allbook->allbook_image ) ? getImage( $allbook->allbook_image ) : null }})" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="carousel carousel-showsixmoveone slide" id="carousel123">
                        <div class="carousel-inner">
                            @foreach($productSliders as $key => $slider)
                            <div class="item {{ $key == 0 ? 'active' : '' }}">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <a href="{{ route('book.show', $slider->id) }}">
                                        <img style="height: 198px!important;width: 150px!important;" src="{{ !empty($slider->coverImage) ? getImage($slider->coverImage->image) : noImage() }}"  alt="{{ $slider->name }}" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a class="left carousel-control" href="#carousel123" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a class="right carousel-control" href="#carousel123" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if( count($productByType) > 0 && empty($_GET['category']) )
    <div class="container-fluid bg_book-detail">
        <div class="container book-detail">
            <div class="row">
                <div class="col-xs-12">
                    <div class="book-detail-preorder">
                        <div class="book-detail-preorder-header">
                            <h3 class="text-left">{{ $typeName->name }}</h3>
                            <h4 class="text-right">{{ trans('page.bookList') }} ({{ trans('page.excludePromo') }})</h4>
                        </div>
                        <hr>
                        <div class="book-detail-preorder-body">
                            <div class="row">
                                @foreach($productByType as $po)
                                @if( !empty($po->product->id) )
                                <div class="col-xs-12 col-sm-6 bk-padding-bottom">
                                    <div class="row row-eq-height">
                                        <div class="col-xs-12 col-sm-5" style="min-height: 245px;">
                                            <a href="{{ route('book.show', $po->product->id) }}">
                                                <img style="height: 270px!important;width: 188px!important;"src="{{ !empty($po->product->coverImage) ? getImage($po->product->coverImage->image) : noImage() }}" alt="{{ $po->product->name }}" class="img-responsive" />
                                            </a>
                                        </div>
                                        <div class="col-xs-12 col-sm-7">
                                            <a href="{{ route('book.show', $po->product->id) }}">
                                                <p class="bookname">{{ getLang() == 'en' ? $po->product->name_en : $po->product->name }}</p>
                                            </a>
                                            @if(getLang() == 'en')
                                            <p class="by">By : <a href="{{url('writer.show')}}"><span class="author">{{ !empty($po->product->writer()->first()) ? $po->product->writer()->first()->fullname_en : '' }}</span></a></p>
                                            @else
                                            <p class="by">โดย : <a href="{{url('writer.show')}}"><span class="author">{{ !empty($po->product->writer()->first()) ? $po->product->writer()->first()->fullname_th : '' }}</span></a></p>
                                            @endif
                                            <div class="price-cart">
                                                <p class="price-dc">{{ trans('page.price') }} : {{ $po->product->suggested_retail_price }} {{ trans('page.bath') }}</p>
                                                <p class="price">{{ trans('page.memberPrice') }} : {{ $po->product->suggested_member_price }} {{ trans('page.bath') }}</p>
                                                <button class="btn btn-default btn-cart" onclick="cart({{ $po->product->id }})"><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ trans('page.addToCart') }}</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="book-all">
                    <div class="book-all-header">
                        <div class="book-all-header-left">
                            <h3>{{ trans('page.allBooks') }}</h3>
                            <select class="book-all-header-left-selectCat" id="select-category">
                                @if(getLang() == 'en')
                                <option value="all">All Catagories</option>
                                @else
                                <option value="all">หมวดหมู่ทั้งหมด</option>
                                @endif
                                @foreach($categories as $category)
                                <option value="{{ $category->name_th }}" @if(!empty($_GET['category']) && $_GET['category'] === $category->name_th) selected="selected" @endif>{{ getLang() == 'en' ? $category->name_en : $category->name_th }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="book-all-header-right">
                            {{-- <span class="text-red">View</span> --}}
                            <div class="book-all-header-right-pagination">
                                {{ $books->links('paginations.default')}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="book-all-body">
                        <div class="row" id="displayBooks">
                            @foreach($books as $book)
                            <div class="col-xs-12 col-sm-3">
                                <div class="thumbnail book-all-body-thumbnail">
                                    <a href="{{ route('book.show', $book->id) }}">
                                        <img src="{{ !empty($book->coverImage) ? getImage($book->coverImage->image) : noImage() }}"
                                             alt="{{ $book->name }}"
                                             class="img-responsive book-all-body-thumbnail-img" />
                                    </a>
                                    <div class="caption book-all-body-thumbnail-caption">
                                        <a href="{{ route('book.show', $book->id) }}' + data.id + '">
                                            <p class="book-all-body-thumbnail-caption-bookname">{{ getLang() == 'en' ? $book->name_en : $book->name }}</p>
                                        </a>
                                        <div class="book-all-body-thumbnail-caption-rate">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                        <div class="book-all-body-thumbnail-caption-price">
                                            <p class="book-all-body-thumbnail-caption-price-dc">{{ trans('page.price') }} : {{ $book->suggested_retail_price }} {{ trans('page.bath') }}</p>
                                            <p class="book-all-body-thumbnail-caption-price-member">{{ trans('page.memberPrice') }} : {{ $book->suggested_member_price }} {{ trans('page.bath') }}</p>
                                        </div>
                                        <hr>
                                        <div class="book-all-body-thumbnail-caption-writer">
                                            <ul>
                                                <li>
                                                    <a href="{{url('writer.show')}}"><img src="{{ !empty($book->writer()->first()) ? getImage($book->writer()->first()->image) : noImage() }}" alt="writer-6" class="img-responsive" />
                                                        @if(getLang() == 'en')
                                                        <span class="text-red">{{ !empty($book->writer()->first()) ? $book->writer()->first()->fullname_en : '' }}</span>
                                                        @else
                                                        <span class="text-red">{{ !empty($book->writer()->first()) ? $book->writer()->first()->fullname_th : '' }}</span>
                                                        @endif
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <button onclick="cart({{ $book->id }})"
                                        class="btn btn-default btn-cart-all">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    {{ trans('page.addToCart') }}
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(function(){
        // Bind the swipeleftHandler callback function to the swipe event on div.box
        $( ".carousel" ).on( "swipeleft", function(){
            $(this).carousel('next');
        });
        $( ".carousel" ).on( "swiperight", function(){
            $(this).carousel('prev');
        });


        $('#select-category').on('change', function(event){
            window.location.href = '{{ route('book.index' ) }}?category=' + $(this).val()
        })

        $('#carousel123').carousel({ interval: 2000 });
        $('#carouselABC').carousel({ interval: 3600 });
        $('.carousel-showsixmoveone .item').each(function(){
    var itemToClone = $(this);

    for (var i=1;i<6;i++) {
      itemToClone = itemToClone.next();

      // wrap around if at end of item collection
      if (!itemToClone.length) {
        itemToClone = $(this).siblings(':first');
      }

      // grab item, clone, add marker class, add to collection
      itemToClone.children(':first-child').clone()
        .addClass("cloneditem-"+(i))
        .appendTo($(this));
    }
  });
    });
</script>
@endsection
