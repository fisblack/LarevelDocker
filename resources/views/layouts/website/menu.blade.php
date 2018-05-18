<nav class="navbar navbar-default navbar-sen" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-sm hidden-md hidden-lg" href="/">
                SENSE BOOK
            </a>
        </div>


        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ (Request::is('/*') ? 'active' : '' ) }}">
                    <a  href="{{ route('index') }}">{{ trans('menu.home') }}</a>
                </li>
                <li class="{{ (Request::is('book*') ? 'active' : '' ) }}">
                    <a  href="{{ route('book.index') }}">{{ trans('menu.book') }}</a>
                </li>
                <li class="{{ (Request::is('writer*') ? 'active' : '' ) }}">
                    <a  href="{{ route('writer.index') }}">{{ trans('menu.writer') }}</a>
                </li >
                <li class="{{ (Request::is('news-and-event*') ? 'active' : '' ) }}">
                    <a  href="{{ route('news-and-event.index') }}">{{ trans('menu.news-and-event') }}</a>
                </li>
                <li class="{{ (Request::is('report-payment*') ? 'active' : '' ) }}">
                    <a  href="{{ route('report-payment.index') }}">{{ trans('menu.report-payment') }}</a>
                </li>
                <li class="{{ (Request::is('about-us*') ? 'active' : '' ) }}">
                    <a  href="{{ route('about-us.index') }}">{{ trans('menu.about-us') }}</a>
                </li>
                <li class="{{ (Request::is('contact-us*') ? 'active' : '' ) }}">
                    <a  href="{{ route('contact-us.index') }}">{{ trans('menu.contact-us') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>