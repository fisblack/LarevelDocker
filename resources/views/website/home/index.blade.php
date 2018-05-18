@extends('layouts.website.template')

@section('head')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css')}}"/>

	<link rel="stylesheet" href="{{ asset('/js/website/home/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('/js/website/home/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/owlcarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/owlcarousel/dist/assets/owl.theme.default.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/js/website/home/star-rating-svg.css')}}">

@endsection

@section('title')
Home
@endsection

@section('body')

	<!--banner1200*450-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12" style="padding: 0px 0px 20px 0px;">
				<div class="owl-carousel owl-theme" id="owl-banner">

					@foreach( $data['banners'] as $banner )
					@if( fileStorage_exit($banner->image) )
					<div class="item">
						<a href="{{ $banner->url_image }}" target="_blank">
							<img style="height: 713px"src="{{ getImage($banner->image) }}">
						</a>
					</div>
					@endif
					@endforeach

				</div>
			</div>
		</div>
	</div>

	<!--banner1000*100-->
	@if(!empty($data['promotion']->image) && fileStorage_exit($data['promotion']->image) )
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12" style="padding:0">
				<div class="owl-carousel owl-theme" id="owl-banner-sub">
					<a href="{{ $data['promotion']->url_image }}" target="_blank">
					<div class="item">
						<img style="height: 400px;" src="{{ getImage( $data['promotion']->image ) }}">
					</div>
					</a>
				</div>
			</div>
		</div>

	</div>
	@endif

	<!--best seller-->
	@if( count($bestSeller) > 0 )
	<div class="container-fluid box item-best-seller">
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-5 col-xs-6 header-square-front">
					<a href="{{ route('book.index') }}?type=best_seller">{{ trans('page.viewAll') }} >></a>
				</div>
				<div class="col-md-10 col-sm-7 col-xs-6 header-square-back">
					<div class="p1">หนังสือขายดี<br></div>
					<div class="p2">Best Seller<br><hr width="100%"></div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="owl-carousel owl-theme" id="owl-seller">

						@foreach($bestSeller as $bs)
						@if( !empty($bs->product->id) )
						<div class="item" >
							<div class="text-center">
								<div class="thumb">
									<img src="{{ asset('images/book/hot.png')}}" class="img img-hot" />
									<a href="{{ route('book.show', $bs->product->id) }}" class="gup-img">
			  							<img src="{{ !empty($bs->product->coverImage) ? getImage($bs->product->coverImage->image) : noImage() }}">
			  						</a>
			  					</div>
			  					<div class="item-box">
			  						<h4>{{ getLang() == 'en' ? $bs->product->name_en : $bs->product->name }}</h4>
			  							<figure>
			  								<img class="img img-star" src="{{ asset('images/01_home/star_all.png')}}" alt="">
			  							</figure>
			  							<img class="auther" src="{{ !empty($bs->product->writer()->first()) ? getImage($bs->product->writer()->first()->image) : noImage() }}" style="width: 35px; height: 35px;">
			  						@if(getLang() == 'en')
			  						<div class="red">{{ !empty($bs->product->writer()->first()) ? $bs->product->writer()->first()->fullname_en : '' }}</div>
			  						@else
			  						<div class="red">{{ !empty($bs->product->writer()->first()) ? $bs->product->writer()->first()->fullname_th : '' }}</div>
			  						@endif
			  						<del>{{ trans('page.price') }} : {{ $bs->product->suggested_retail_price }} {{ trans('page.bath') }}</del><br>
			  						<b>{{ trans('page.memberPrice') }} : {{ $bs->product->suggested_member_price }} {{ trans('page.bath') }}</b>
			  						<hr>
			  						<button type="button" class="btn btn-default add-to-cart-sm" onclick="cart({{ $bs->product->id }})">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i>{{ trans('page.addToCart') }}</button>
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
	@endif

	<!--new book-->
	@if( count($bestNew) > 0 )
	<div class="container-fluid box item-new-book ">
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-5 col-xs-6 header-square-front">
					<a href="{{ route('book.index') }}?type=new_release">{{ trans('page.viewAll') }} >></a>
				</div>
				<div class="col-md-10 col-sm-7 col-xs-6 header-square-back">
					<div class="p1">หนังสือใหม่<br></div>
					<div class="p2">New book<br><hr width="100%"></div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="owl-carousel owl-theme" id="owl-newbook">

						@foreach($bestNew as $bn)
						@if( !empty($bn->product->id) )
						<div class="item" >
							<div class="text-left gp-bord">
								<div class="thumb">
									<img src="{{ asset('images/book/new-book.png')}}" class="img img-news" />
									<a href="{{ route('book.show', $bn->product->id) }}" class="gup-img">
			  							<img src="{{ !empty($bn->product->coverImage()->first()) ? getImage($bn->product->coverImage->image) : noImage() }}">
			  						</a>
			  					</div>

			  					<div class="item-box">
			  						<h4>{{ getLang() == 'en' ? $bn->product->name_en : $bn->product->name }}</h4>
		  							<figure>
		  								<img class="img img-star" src="{{ asset('images/01_home/star_all.png')}}" alt="">
		  							</figure>
			  						<del>{{ trans('page.price') }} : {{ $bn->product->suggested_retail_price }} {{ trans('page.bath') }}</del><br>
			  						<b>{{ trans('page.memberPrice') }} : {{ $bn->product->suggested_member_price }} {{ trans('page.bath') }}</b>
			  						<hr>
			  						<img class="auther" src="{{ !empty($bn->product->writer()->first()) ? getImage($bn->product->writer()->first()->image) : noImage() }}" style="width: 35px; height: 35px;">
			  						@if(getLang() == 'en')
			  						<p class="red">{{ !empty($bn->product->writer()->first()) ? $bn->product->writer()->first()->fullname_en : '' }}</p>
			  						@else
			  						<p class="red">{{ !empty($bn->product->writer()->first()) ? $bn->product->writer()->first()->fullname_th : '' }}</p>
			  						@endif

			  					</div>
			  				</div>
							<button class="btn btn-default btn-add-cart" onclick="cart({{ $bn->product->id }})">
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
								{{ trans('page.addToCart') }}
							</button>
						</div>
						@endif
						@endforeach

					</div>
				</div>
			</div>
		</div>
	</div>
	@endif

	<!--coming soon-->
	@if( count($commingSoon) > 0 )
	<div class="container-fluid box ">
		<div class="container item-coming-soon">
			<div class="row">
				<div class="col-md-2 col-sm-5 col-xs-6 header-square-front">
					<a href="{{ route('book.index') }}?type=coming_soon">{{ trans('page.viewAll') }} >></a>
				</div>
				<div class="col-md-10 col-sm-7 col-xs-6 header-square-back">
					<div class="p1">หนังสือออกใหม่เร็วๆ นี้<br></div>
					<div class="p2">New books coming soon<br><hr width="100%"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="mid-banner coming-soon bg-comming">

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="owl-carousel owl-theme" id="owl-coming">

						@foreach($commingSoon as $cs)
						@if( !empty($cs->product->id) )
						<div class="item clearfix" >
							<div class="col-xs-12 col-md-6 col-sm-6 col-xs-5">
								<div class="thumb">
									<a href="{{ route('book.show', $cs->product->id) }}" class="gup-img">
										<img class="img" src="{{ !empty($cs->product->coverImage()->first()) ? getImage($cs->product->coverImage->image) : noImage() }}">
									</a>
								</div>
							</div>
							<div class="col-xs-12 col-md-6 col-sm-6 col-xs-7 coming-book">
								<h2 class="title">{{ getLang() == 'en' ? $cs->product->name_en : $cs->product->name }}</h2>
								@if(getLang() == 'en')
								<h4>{{ trans('page.by') }} : {{ !empty($cs->product->writer()->first()) ? $cs->product->writer()->first()->fullname_en : '' }}</h4>
								@else
								<h4>{{ trans('page.by') }} : {{ !empty($cs->product->writer()->first()) ? $cs->product->writer()->first()->fullname_th : '' }}</h4>
								@endif
								<figure>
	  								<img class="img img-star-comming" src="{{ asset('images/01_home/star_all_coming.png')}}" alt="">
	  							</figure>
								<del>{{ trans('page.price') }} : {{ $cs->product->suggested_retail_price }} {{ trans('page.bath') }}</del><br>
			  					<b>{{ trans('page.memberPrice') }} : {{ $cs->product->suggested_member_price }} {{ trans('page.bath') }}</b>
			  					<br><br><br>
			  					<button type="button" class="btn btn-default add-to-cart-sm">
									<span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
									<span class="wish">{{ trans('page.wish') }}</span>
								</button>
							</div>
						</div>
						@endif
						@endforeach

					</div>
				</div>
			</div>
		</div>

	</div>
	@endif

	<!--offcial-->
	@if( count($official) > 0 )
	<div class="container-fluid box item-offcial bg-offcial">
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-5 col-xs-6 header-square-front">
					<a href="{{ route('book.index') }}?type=office_goods">{{ trans('page.viewAll') }} >></a>
				</div>
				<div class="col-md-10 col-sm-7 col-xs-6 header-square-back">
					<div class="p1">สินค้า<br></div>
					<div class="p2">Offcial goods<br><hr width="100%"></div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="owl-carousel owl-theme" id="owl-offcial">

						@foreach($official as $oc)
						@if( !empty($oc->product->id) )
						<div class="item" >
							<div class="text-center">
			  					<div class="item-box">
			  						<ul>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    </ul>
			  						<h4>{{ getLang() == 'en' ? $oc->product->name_en : $oc->product->name }}</h4>
			  						<a href="{{ route('book.show', $oc->product->id) }}" class="g-img">
			  							<img src="{{ !empty($oc->product->coverImage()->first()) ? getImage($oc->product->coverImage->image) : noImage() }}">
			  						</a>
			  						<br><br>
			  						<button type="button" class="btn btn-default add-to-cart-sm" onclick="cart({{ $oc->product->id }})">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i></span>{{ trans('page.addToCart') }}</button>
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
	@endif

	<!--catagory-->
	{{--
	<div class="container-fluid box item-catagory bg-catagory">
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-5 col-xs-6 header-square-front">
					<a href="#">{{ trans('page.viewAll') }} >></a>
				</div>
				<div class="col-md-10 col-sm-7 col-xs-6 header-square-back">
					<div class="p1">ประเภทสินค้า<br></div>
					<div class="p2">CATEGORY BOOK<br><hr width="100%"></div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">

					<div class="owl-carousel owl-theme" id="owl-catagory">

						<div class="item" >
							<div class="text-center">

								<div class="thumb">
									<img class="img img-cat" src="{{ asset('images/book/new-cat.png') }}">
									<a href="{{ route('book.show', 8) }}" class="gup-img">
			  							<img src="{{ asset('images/book/book-1.png')}}">
			  						</a>
			  					</div>
			  					<div class="item-box">
			  						<ul>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    </ul>
			  						<h4>Write a Story of Us <br>พระเอกในนิยาย...</h4>
			  						<button type="button" class="btn btn-default add-to-cart-sm">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i></span>เพิ่มลงตะกร้า</button>
			  					</div>
			  				</div>
						</div>

						<div class="item" >
							<div class="text-center">

								<div class="thumb">
									<img class="img img-cat" src="{{ asset('images/book/new-cat.png') }}">
									<a href="{{ route('book.show', 8) }}" class="gup-img">
			  							<img src="{{ asset('images/book/book-2.png')}}">
			  						</a>
			  					</div>
			  					<div class="item-box">
			  						<ul>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    </ul>
			  						<h4>Write a Story of Us <br>พระเอกในนิยาย...</h4>
			  						<button type="button" class="btn btn-default add-to-cart-sm">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i></span>เพิ่มลงตะกร้า</button>
			  					</div>
			  				</div>
		  				</div>

		  				<div class="item" >
			  				<div class="text-center">

			  					<div class="thumb">
			  						<img class="img img-cat" src="{{ asset('images/book/new-cat.png') }}">
									<a href="{{ route('book.show', 8) }}" class="gup-img">
			  							<img src="{{ asset('images/book/book-3.png')}}">
			  						</a>
			  					</div>

			  					<div class="item-box">
			  						<ul>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    </ul>
			  						<h4>Write a Story of Us <br>พระเอกในนิยาย...</h4>
			  						<button type="button" class="btn btn-default add-to-cart-sm">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i></span>เพิ่มลงตะกร้า</button>
			  					</div>
			  				</div>
		  				</div>

		  				<div class="item" >
			  				<div class="text-center">

			  					<div class="thumb">
			  						<img class="img img-cat" src="{{ asset('images/book/new-cat.png') }}">
									<a href="{{ route('book.show', 8) }}" class="gup-img">
			  							<img src="{{ asset('images/book/book-4.png')}}">
			  						</a>
			  					</div>
			  					<div class="item-box">
			  						<ul>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    </ul>
			  						<h4>Write a Story of Us <br>พระเอกในนิยาย...</h4>
			  						<button type="button" class="btn btn-default add-to-cart-sm">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i></span>เพิ่มลงตะกร้า</button>
			  					</div>
			  				</div>
		  				</div>

		  				<div class="item" >
			  				<div class="text-center">

			  					<div class="thumb">
			  						<img class="img img-cat" src="{{ asset('images/book/new-cat.png') }}">
									<a href="{{ route('book.show', 8) }}" class="gup-img">
			  							<img src="{{ asset('images/book/book-1.png')}}">
			  						</a>
			  					</div>
			  					<div class="item-box">
			  						<ul>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    </ul>
			  						<h4>Write a Story of Us <br>พระเอกในนิยาย...</h4>
			  						<button type="button" class="btn btn-default add-to-cart-sm">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i></span>เพิ่มลงตะกร้า</button>
			  					</div>
			  				</div>
		  				</div>

		  				<div class="item" >
			  				<div class="text-center">

			  					<div class="thumb">
			  						<img class="img img-cat" src="{{ asset('images/book/new-cat.png') }}">
									<a href="{{ route('book.show', 8) }}" class="gup-img">
			  							<img src="{{ asset('images/book/book-2.png')}}">
			  						</a>
			  					</div>
			  					<div class="item-box">
			  						<ul>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    </ul>
			  						<h4>Write a Story of Us <br>พระเอกในนิยาย...</h4>
			  						<button type="button" class="btn btn-default add-to-cart-sm">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i></span>เพิ่มลงตะกร้า</button>
			  					</div>
			  				</div>
		  				</div>

					</div>
				</div>
			</div>
		</div>

	</div>
	--}}

@endsection

@section('script')
	<!-- plugins -->
	<!--script src="{{ asset('js/website/home/slick.min.js') }}"></script-->
	<script src="{{ asset('js/website/home/jquery.star-rating-svg.min.js') }}"></script>
	<script src="{{ asset('/js/plugins/owlcarousel/dist/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js/website/home/index.js') }}"></script>


@endsection
