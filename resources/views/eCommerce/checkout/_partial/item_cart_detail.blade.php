<div class="group-item-product item-cart-detail clearfix" id="item-cart-detail">
    <div class="icon-del">
        <i data-book_id="{{$product->id}}" class="fa fa-times fa-2x remove-book-cart" id="item-cart-detail-1"></i>
    </div>
    <div class="group-cart clearfix">
        <div class="group-img">
            <img class="img img-responsive" style="width: 142px;height: 208px;" src="{{ !empty($product->coverImage) ? getImage($product->coverImage->image) : noImage() }}" alt="">
        </div>
        <div class="grou-detail">

            <div class="cart-first">
                <p class="cart-title f-color-default">{{ $product->name }}</p>

                @foreach($product->writer as $writer)
                    <b>โดย : {{ $writer->fullname_th }}</b>
                @endforeach
            </div>

            <div class="cart-second">
                <p class="cart-m-price f-color-default">
                    ราคาสมาชิก
                    <br> {{ $product->suggested_member_price }} บาท
                </p>
                <s class="f-size-20">ราคา : {{ $product->suggested_retail_price  }} บาท</s>
            </div>

            <div class="icon-start">
                <i class="fa fa-star f-size-20 f-color-default"></i>
                <i class="fa fa-star f-size-20 f-color-default"></i>
                <i class="fa fa-star f-size-20 f-color-default"></i>
                <i class="fa fa-star-o f-size-20 f-color-default"></i>
                <i class="fa fa-star-o f-size-20 f-color-default"></i>
            </div>
            <div class="group-input">
                <label class="base-input" id="row_1" for="">
                    <input
                            type="hidden"
                            name="products_id[]"
                            class="form-input-cart-qty  qty"
                            value="{{ $product->id }}"
                    >
                    <input
                            type="text"
                            name="products_qty[]"
                            class="form-input-cart-qty  qty"
                            value="{{ $product->qty }}"
                    >
                    <a href="javascript:void(0);"
                       class="plus add-book-to-cart"
                       data-book_id="{{ $product->id }}"
                       data-qty="1"
                       data-reload="true"
                    >
                        <i class="fa fa-plus"></i>
                    </a>

                    <a href="javascript:void(0);"
                       class="minus add-book-to-cart"
                       data-book_id="{{ $product->id }}"
                       data-qty="-1"
                       data-reload="true"
                    >
                        <i class="fa fa-minus"></i>
                    </a>
                </label>
            </div>

        </div>
    </div>
</div>
