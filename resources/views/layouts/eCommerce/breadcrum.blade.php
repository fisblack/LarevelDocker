<div class="path">
<div class="container-fluid">
    <div class="row">
    <div class="container">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-full">
        <ol class="breadcrumb clearfix" style="">
            <li class="{{ (Request::is('checkout*') ? 'active' : '' ) }}">
            <a href="{{ route('checkout.index') }}">
                <span class="icon">
                1
                </span>
                Checkout
            </a>
            </li>
            <li class="{{ (Request::is('shipping*') ? 'active' : '' ) }}">
            <a href="{{ route('shipping.index') }}">
                <span class="icon">
                2
                </span>
                Shipping
            </
            </li>
            <li class="{{ (Request::is('payment*') ? 'active' : '' ) }}">
            <a href="{{ route('payment.index') }}">
                <span class="icon">
                3
                </span>
                Payment
            </a>
            </li>
        </ol>
        </div>
    </div>
    </div>
</div>
</div>