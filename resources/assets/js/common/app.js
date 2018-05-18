/* app.js */

var App = function () {

    function onloadpage() {

        window.onload = function () {
            $('body').removeClass('hidden')
        }

        console.log('welcome to sensebook ')
    }

    function device_mobile(){
        var device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
        if(device) {


        }else{

        }


    }
    function back_to_top(){
        jQuery(document).ready(function($){
            var offset = 300,
                offset_opacity = 1200,
                scroll_top_duration = 700,
                $back_to_top = $('.cd-top');


            $(window).scroll(function(){
                ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
                if( $(this).scrollTop() > offset_opacity ) {
                    $back_to_top.addClass('cd-fade-out');
                }
            });


            $back_to_top.on('click', function(event){
                event.preventDefault();
                $('body,html').animate({
                    scrollTop: 0 ,
                    }, scroll_top_duration
                );
            });

        });
    }

    function smoothscroll(){
        $(document).on('click', 'a[href^="#"]', function(event){
            event.preventDefault();

            $('html, body').animate({
                scrollTop: $( $.attr(this, 'href') ).offset().top
            }, 500);
        });
    }

    function search_memu(){
    	$("#filter").on("keyup", function() {
            var countWatch = 5;

            var filter = $(this).val(),
                countSearch = 0;

            var results_search_ul = $("#results-search ul");
            var wrap_see_all_results = $("#wrap-see-all-results");
            for (var i = 0, len = results_search_ul.children(".item").length; i < len; i++) {
                results_search_ul.children(".item").eq(i).hide().removeClass("activebackg bgcolorsearch");

                if (results_search_ul.children(".item").eq(i).text().search(new RegExp(filter, "i")) > 0) {
                    results_search_ul.children(".item").eq(i).show().addClass("activebackg");
                    results_search_ul.css("display", "block");
                    countSearch++;

                } else {
                    results_search_ul.children(".item").eq(i).hide().removeClass("activebackg bgcolorsearch");
                }
                if (countSearch > countWatch) {
                    results_search_ul.children(".item").eq(i).hide();
                    wrap_see_all_results.css("display", "block");
                } else {
                    wrap_see_all_results.css("display", "none");
                    $('.seeall').css('display','block')
                }

                if( countSearch > 0 ){
                    if( $('.seeall').css('display') == 'none' ){
                        $('.seeall').css('display','block')


                    }
                }else{
                    $('.seeall').css('display','none')
                }


                $(".activebackg:even").addClass("bgcolorsearch");
                $('.seeall').addClass('bgcolorsearch')

            }

        });
    }

    function check_Cart(){
        $('ul.top-menu li.cart').click(function(){

            console.log('click cart')

            if( $('ul.top-menu li.cart').hasClass('open') == false ){
                $(this).addClass('open');
            }else{
                $(this).removeClass('open');
            }
        })
    }

    function fb_init_cb(){

        window.fbAsyncInit = function() {
            FB.init({
              appId            : '1448523238577000',
              autoLogAppEvents : true,
              xfbml            : true,
              version          : 'v2.10'
            });
            FB.AppEvents.logPageView();
          };

          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "https://connect.facebook.net/en_US/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));
    }

    /**
     * Global method for add a book into a cart
     * Usage:: add class 'add-book-to-cart' and data attribute book_id into button
     */
    function addBookToCart() {
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.add-book-to-cart').click(function () {
                const bookId = $(this).data('book_id');
                const reload = ($(this).data('reload')) ? $(this).data('reload') : false;
                const qty = ($(this).data('qty')) ? $(this).data('qty') : 1;
                $.ajax({
                    type: 'POST',
                    url: '/api/cart/cart',
                    data: {
                        book_id: bookId,
                        qty: qty
                    },
                    success: function (data) {
                        if (reload) {
                            window.location.reload(true);
                        } else {
                            updateCart()
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

            });
        });
    }

    function removeBookFromCart() {
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.remove-book-cart').click(function () {
                const bookId = $(this).data('book_id');
                $.ajax({
                    type: 'DELETE',
                    url: '/api/cart/cart/'+ bookId,
                    success: function (data) {
                        window.location.reload(true);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

            });
        });
    }

    /**
     * Update items in cart
     */
    function updateCart() {
        $.ajax({
            type: 'GET',
            url: '/api/cart/cart',
            success: function (data) {
                console.log(data)
                // TODO put data to html
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    /**
     * Delete all items on cart
     */
    function clearCart() {
        $.ajax({
            type: 'GET',
            url: '/api/cart/cart/delete',
            success: function (data) {
                updateCart()
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function updateShipping() {
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.update-shipping').click(function () {

                var data = null;

                switch($(this).data('type')) {
                    case 'billing-address':
                        data = { billing_address_id: $(this).data('billing_address_id')};
                        break;
                    case 'billing-required':
                        data = { billing_required: $(this).find('input').val() };
                        break;
                    case 'shipping-address':
                        data = { shipping_address_id: $(this).data('shipping_address_id') };
                        break;
                }

                if (data != null) {
                    $.ajax({
                        type: 'POST',
                        url: '/shipping',
                        data: data,
                        success: function (data) {
                            //window.location.reload(true);
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }

            });
        });

    }


    return {
        init: function () {
            onloadpage();
            device_mobile();
            back_to_top();
            // smoothscroll();
            search_memu();
            check_Cart();
            fb_init_cb();
            addBookToCart();
            removeBookFromCart();
            updateShipping();
        }
    };
}();

/**
 *  Global method for add a book into a cart
 * @param bookId
 */
function cart(bookId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var val = $('#qty').val();
    $.ajax({
        type: 'POST',
        url: '/api/cart/cart',
        data: {
            book_id: bookId,
            qty: (val) ? val : 1
        },
        success: function (data) {
            updateProductsListCart();
            toastr['success']('เพิ่มสินค้าแล้ว');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

function updateProductsListCart() {
    $.ajax({
        type: 'GET',
        url: '/api/cart/cart',
        success: function (data) {
            console.log(data);
            $('.cart-list').empty();
            if (typeof data.products !== 'undefined' && data.products.length > 0) {
                var num_book = 0;
                data.products.forEach(function (product) {
                    $('.cart-list').append(`
                          <li>
                              <span class="item">
                                <span class="item-left">
                                    <img style="width: 55px;height: 80px;" src="`+product.image_path.encoded+`" alt="" />
                                    <span class="item-info">
                                        <span style="font-size: medium;font-weight: bold;">`+product.name+`</span>
                                        <span>จำนวน `+product.qty+` เล่ม</span>
                                        <span>ราคา `+ (product.suggested_retail_price * product.qty ).toFixed(2)+` บาท</span>
                                        <span>ราคาสมาชิก `+ (product.suggested_member_price * product.qty ).toFixed(2)+` บาท</span>
                                    </span>
                                </span>
                                <span class="item-right">
                                    <button data-book_id="`+product.id+`" class="btn btn-xs btn-danger pull-right remove-book-cart-nav">x</button>
                                </span>
                              </span>
                          </li>
                       `);
                    num_book += product.qty;
                });
                $('.cart-count').html(num_book);
                removeBookFromCartNav();
            }else{
                $('.cart-count').empty();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

function removeBookFromCartNav() {
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.remove-book-cart-nav').click(function () {
            const bookId = $(this).data('book_id');

            $.ajax({
                type: 'DELETE',
                url: '/api/cart/cart/'+ bookId,
                success: function (data) {
                    if (window.location.pathname.replace("/", "") == "checkout") {
                        window.location.reload(true);
                    } else {
                        updateProductsListCart();
                        toastr['success']('ลบสินค้าแล้ว');
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

        });
    });
}