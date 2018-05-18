<nav class="navbar nav-bot " role="navigation">
    <div class="container">
        <div class="row nav1">
            <div class="col-xs-6 col-sm-12 col-md-3 col-lg-3">
                <div class="logo" >
                    <figure>
                        <a href="{{ route('index') }}">
                        <img src="{{ asset('images/00_header/logo.png')}}" class="img-w-100" alt="">
                        </a>
                    </figure>

                </div>
            </div>
            <div class="col-xs-6 hidden-sm hidden-md hidden-lg" for="mobile">
                <ul class="top-menu list-inline">
                    <li class="cart" style="position: relative;">
                        <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>
                        &nbsp;
                        <span class="badge cart-count"
                              style="position: absolute;top: -10px;right: 8px;background-color:#ad1a3f;">
                            0
                        </span>
                        <div class="cart-none-open">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <ul class="list-unstyled cart-list">
                                        </ul>
                                        <a href="{{ route('checkout.index') }}" class="btn btn-checkout">
                                            check out
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-login">
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('login') }}">
                            <i class="fa fa-user-o fa-lg" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="lang-chang dropdown lang">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('images/00_header/flag_eng.png')}}" alt="">
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <img src="{{ asset('images/00_header/flag_tha.png')}}" alt="">
                                <a href="#"></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 nav-top">
                <div class="search-popup-main">
                    <form action="" method="GET" class="navbar-form-search" role="form">

                        <div class="form-search search-only">
                            <i class="search-icon glyphicon glyphicon-search"></i>
                            <input type="text" class="form-control input-search search-query" id="filter" placeholder="Search" AUTOCOMPLETE="off" >
                        </div>
                    </form>
                    <nav class="results-search" id="results-search">
                        <ul class="list-unstyled">
                            <li class="item">
                                <a href="javascript:;">
                                    <div class="box-img-search">
                                        <img src="" alt=""></div>
                                    <div class="box-info-search">
                                        <div class="title-search">Boxest Write a Story of us รอบไปรษณีย์ (Kerry)</div>
                                        <div class="price-search by">โดย : หม่อมแม่ </div>
                                    </div>
                                </a>
                            </li>
                            <li class="item">
                                <a href="javascript:;">
                                    <div class="box-img-search">
                                        <img src="" alt=""></div>
                                    <div class="box-info-search">
                                        <div class="title-search">Test Boxest Write a Story of us รอบไปรษณีย์ (Kerry)</div>
                                        <div class="price-search by">โดย : หม่อมแม่ </div>
                                    </div>
                                </a>
                            </li>
                            <li class="item  seeall">
                                <a href="javascript:;">See All</a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 hidden-xs">
                <ul class="top-menu list-inline">
                    <li class="cart" style="position: relative;">
                        <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>
                        &nbsp;
                        <span class="badge cart-count"
                              style="position: absolute;top: -10px;right: 8px;background-color:#ad1a3f;">
                            0
                        </span>
                        <div class="cart-none-open">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <ul class="list-unstyled cart-list">
                                        </ul>
                                        <a href="{{ route('checkout.index') }}" class="btn btn-checkout">
                                            check out
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-login">
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ action('Auth\LoginController@showLoginForm') }}">
                            <i class="fa fa-user-o fa-lg" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="lang-chang dropdown lang">
                        @if(getLang() == 'en')
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('images/00_header/flag_eng.png')}}" alt="">
                            ENG <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" onclick="location.href='{{ url()->current() }}?lang=th'" style="cursor: pointer;"> 
                            <li class="">
                                <img src="{{ asset('images/00_header/flag_tha.png')}}" alt="">
                                <a href="{{ url()->current() }}?lang=th">TH</a>
                            </li>
                        </ul>
                        @else
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('images/00_header/flag_tha.png')}}" alt="">
                            TH <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" onclick="location.href='{{ url()->current() }}?lang=en'" style="cursor: pointer;"> 
                            <li class="">
                                <img src="{{ asset('images/00_header/flag_eng.png')}}" alt="">
                                <a href="{{ url()->current().'?lang=en' }}">ENG</a>
                            </li>
                        </ul>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
