

    <div id="wrapper" class="hidden">

        <nav class="navbar navbar-default navbar-static-top m-b-0 hidden-print">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>

                <div class="top-left-part">
                    <a class="logo" href="{{ route('index') }}">
                        <b>
                            <img src="{{ asset('images/admin_dashboard/dashboard/logo_dashboard_mobile.png')}}" alt="IMG" />
                        </b>
                        <span class="hidden-xs">
                            SENSEBOOK
                        </span>
                    </a>
                </div>

                <ul class="nav navbar-top-links navbar-right pull-right">

                    <li class="dropdown">
                        <a href="#" class="profile-pic dropdown-toggle" data-toggle="dropdown">
                        @if(Auth::user()->image)
                            <img class="img-circle member-profile-img" src="{{ getImage(Auth::user()->image) }}" width="36" height="36">
                        @else
                            <img class="img-circle member-profile-img" src="{{ asset('images/admin_dashboard/main_menu/user.png')}}" width="36" height="36">
                        @endif
                        {{ Auth::user()->full_name }}


                        <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('profile.index')}}">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="fa fa-power-off" aria-hidden="true"></i>
                                    Logout
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul>

            </div>

        </nav>

        <div class="navbar-default sidebar hidden-print" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav nav-sidebar" id="">
                    <li style="">
                        <a href="javascript:;" class="waves-effect">

                            <span class="hide-menu">Main Menu</span>

                        </a>
                        <ul class="nav" id="side-menu">
                            <li class="">
                                <a href="{{ route('backOffice.order.index') }}" class="waves-effect" >
                                <figure>
                                    <img src="{{ asset('images/admin_dashboard/main_menu/order.png')}}" class="img w-100" alt="">
                                </figure>
                                <span class="hide-menu">Orders</span>
                                </a>
                            </li>
                            @if(Auth::user()->type == 'member')
                                <li class="">
                                    <a href="{{ route('backOffice.pre-order.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/main_menu/pre_order.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Pre-Order</span>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->type == 'admin')
                                <li class="">
                                    <a href="{{ route('backOffice.scan-po.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/main_menu/scan_po.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Scan PO</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.pre-order.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/main_menu/pre_order.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Pre-Order</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.member.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/main_menu/member.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Member</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.report.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/main_menu/report.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Report</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.pos.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/main_menu/pos.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Pos</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.print-delivery.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/main_menu/print.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Print Delivery</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.promotion.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/main_menu/promotion.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Promotion</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>

                    @if(Auth::user()->type == 'admin')
                        <li style="">
                            <a href="javascript:;" class="waves-effect">

                                <span class="hide-menu">Website</span>

                            </a>
                            <ul class="nav" id="side-menu">
                                <li class="">
                                    <a href="{{ route('backOffice.website.general.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/website/general.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">General</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.website.allbook.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/website/all_book.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">All Book</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.website.banner.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/website/banner.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Banner</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.website.home.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/website/home.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Home</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.website.category-news-and-event.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/website/category.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Category  News & Events</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.website.news-and-event.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/website/news.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">News & Events</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.website.contact-us.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/website/contact.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Contact Us</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.website.about-us.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/website/aboutus.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">About Us</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li style="">
                            <a href="javascript:;" class="waves-effect">

                                <span class="hide-menu">Settings</span>

                            </a>
                            <ul class="nav" id="side-menu">
                                <li class="">
                                    <a href="{{ route('backOffice.setting.writer.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/setting/writers.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Writers</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.setting.category.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/setting/cat_pro.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Category Product</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.setting.product.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/setting/product.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Products</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.setting.point.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/setting/point.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Points</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.setting.user-class.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/setting/user.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">User Class</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.setting.bank-account.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/setting/bank.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Bank Account Us</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('backOffice.setting.shipping.index') }}" class="waves-effect" >
                                        <figure>
                                            <img src="{{ asset('images/admin_dashboard/setting/shipping.png')}}" class="img w-100" alt="">
                                        </figure>
                                        <span class="hide-menu">Shipping</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                </ul>
                <div class="p-20 text-center">
                    <span class="hide-menu side-copy">
                        Copyright <?php echo date("Y"); ?> Sensebook <br>
                        All Rights Reserved
                    </span>
                </div>
            </div>
        </div>

		<div id="page-wrapper">



