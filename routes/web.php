<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth
Auth::routes();
Route::middleware(['check_shop'])->group(function () {
Route::get('logout', 'Auth\LoginController@logout');

// OAuth Routes
Route::get('auth/{provider}', 'Auth\SocialiteController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback');

Route::middleware(['auth'])->group(function () {
    Route::resource('profile', 'Auth\ProfileController');
});

// WebSite
Route::resource('/', 'Website\HomeController');
Route::resource('about-us', 'Website\AboutUsController');
Route::resource('book', 'Website\BookController');
Route::resource('contact-us', 'Website\ContactUsController');
Route::resource('news-and-event', 'Website\NewsAndEventController');
Route::resource('report-payment', 'Website\ReportPaymentController');
Route::resource('writer', 'Website\WriterController');
// Show PDF
Route::get('documents/setting/products/{file}', 'Website\BookController@pdf');

Route::resource('payment2c2p','Payment2c2pController');
Route::match(['post'],'payment2c2p/prepare','Payment2c2pController@prepare')->name('2c2p.prepare');
Route::match(['get','put','post','patch'],'e-commerce/thank-you','Payment2c2pController@res2c2p')->name('2c2p.response');

// eCommerce
Route::resource('checkout', 'Ecommerce\CheckoutController');
Route::post('shipping/create-address', 'Ecommerce\ShippingController@createAnotherAddress')->name('shipping.createAddress');
Route::resource('shipping', 'Ecommerce\ShippingController');
Route::resource('payment', 'Ecommerce\PaymentController');
Route::resource('thank-you', 'Ecommerce\ThankYouController');


// BackOffice
Route::group(['prefix' => 'backOffice', 'as' => 'backOffice.'], function () {

    Route::middleware(['auth'])->group(function () {

        Route::resource('order', 'BackOffice\OrderController');
        Route::get('order/{order}/print', 'BackOffice\OrderController@print')->name('order.print');
        Route::match(['put', 'patch'], 'order/{order}/restore', 'BackOffice\OrderController@restore')->name('order.restore');

        // Address
        Route::post('address', 'BackOffice\AddressController@store')->name('address.store');
        Route::get('address/{id}', 'BackOffice\AddressController@destroy')->name('address.destroy');

        //pre-order
        Route::resource('pre-order', 'BackOffice\PreOrderController');
        Route::get('pre-order/{pre-order}/print', 'BackOffice\PreOrderController@print')->name('pre-order.print');
        Route::match(['put', 'patch'], 'pre-order/{pre-order}/restore', 'BackOffice\PreOrderController@restore');

        Route::middleware(['admin'])->group(function () {

            Route::resource('dashboard', 'BackOffice\DashboardController');
            Route::get('dashboard/{id}/print', 'BackOffice\DashboardController@print');
            Route::match(['put', 'patch'], 'dashboard/{$id}/restore', 'BackOffice\DashboardController@restore');

            Route::resource('member', 'BackOffice\MemberController');
            Route::match(['put', 'patch'], 'member/{id}/restore', 'BackOffice\MemberController@restore')->name('member.restore');
            Route::post('member/deleteSelected', 'BackOffice\MemberController@deleteSelected')->name('member.deleteSelected');
            Route::post('member/restoreSelected', 'BackOffice\MemberController@restoreSelected')->name('member.restoreSelected');
            Route::post('member/print/{id?}', 'BackOffice\MemberController@print')->name('member.print');

            Route::resource('pos', 'BackOffice\PosController');
            Route::match(['put', 'patch'], 'pos/{id}/restore', 'BackOffice\PosController@restore')->name('pos.restore');
            Route::post('pos/deleteSelected', 'BackOffice\PosController@deleteSelected')->name('pos.deleteSelected');
            Route::get('pos/print/{id?}', 'BackOffice\PosController@print');

//            Route::resource('pre-order', 'BackOffice\PreOrderController');
//            Route::get('pre-order/{id}/print', 'BackOffice\PreOrderController@print');
//            Route::match(['put', 'patch'], 'pre-order/{$id}/restore', 'BackOffice\PreOrderController@restore');

            Route::resource('print-delivery', 'BackOffice\PrintDeliveryController');
            Route::get('print-delivery/{id}/print', 'BackOffice\PrintDeliveryController@print');
            Route::match(['put', 'patch'], 'print-delivery/{$id}/restore', 'BackOffice\PrintDeliveryController@restore');

            Route::resource('promotion', 'BackOffice\PromotionController');
            Route::get('promotion/{id}/print', 'BackOffice\PromotionController@print');
            Route::match(['put', 'patch'], 'promotion/{$id}/restore', 'BackOffice\PromotionController@restore');

            Route::resource('report', 'BackOffice\ReportController');
            Route::get('report/{id}/print', 'BackOffice\ReportController@print');
            Route::match(['put', 'patch'], 'report/{$id}/restore', 'BackOffice\ReportController@restore');

            Route::resource('scan-po', 'BackOffice\ScanPoController');
            Route::get('scan-po/{id}/print', 'BackOffice\ScanPoController@print');
            Route::match(['put', 'patch'], 'scan-po/{$id}/restore', 'BackOffice\ScanPoController@restore');

            // BackOffice > Website
            Route::group(['prefix' => 'website', 'as' => 'website.'], function () {
                Route::resource('about-us', 'BackOffice\Website\AboutUsController');
                Route::get('website/about-us/{id}/print', 'BackOffice\Website\AboutUsController@print');
                Route::match(['put', 'patch'], 'website/about-us/{$id}/restore', 'BackOffice\Website\AboutUsController@restore');

                Route::resource('banner', 'BackOffice\Website\BannerController');
                Route::get('website/banner/{id}/print', 'BackOffice\Website\BannerController@print');
                Route::match(['put', 'patch'], 'website/banner/{$id}/restore', 'BackOffice\Website\BannerController@restore');

                Route::resource('category-news-and-event', 'BackOffice\Website\CategoryNewsAndEventController');
                Route::get('website/category-news-and-event/{id}/print', 'BackOffice\Website\CategoryNewsAndEventController@print');
                Route::match(['post', 'patch'], 'category-news-and-event/restore', 'BackOffice\Website\CategoryNewsAndEventController@restore');

                Route::resource('contact-us', 'BackOffice\Website\ContactUsController');
                Route::get('website/contact-us/{id}/print', 'BackOffice\Website\ContactUsController@print');
                Route::match(['put', 'patch'], 'website/contact-us/{$id}/restore', 'BackOffice\Website\ContactUsController@restore');

                Route::resource('general', 'BackOffice\Website\GeneralController');
                Route::get('website/general/{id}/print', 'BackOffice\Website\GeneralController@print');
                Route::match(['put', 'patch'], 'website/general/{$id}/restore', 'BackOffice\Website\GeneralController@restore');

                Route::resource('allbook', 'BackOffice\Website\AllbookController');
                Route::get('website/allbook/{id}/print', 'BackOffice\Website\AllbookController@print');
                Route::match(['put', 'patch'], 'website/allbool/{$id}/restore', 'BackOffice\Website\AllbookController@restore');

                Route::resource('home', 'BackOffice\Website\HomeController');
                Route::get('website/home/{id}/print', 'BackOffice\Website\HomeController@print');
                Route::match(['put', 'patch'], 'website/home/{$id}/restore', 'BackOffice\Website\HomeController@restore');

                Route::resource('news-and-event', 'BackOffice\Website\NewsAndEventController');
                Route::get('website/news-and-event/{id}/print', 'BackOffice\Website\NewsAndEventController@print');
                Route::match(['post', 'patch'], 'news-and-event/restore', 'BackOffice\Website\NewsAndEventController@restore');
            });

            // BackOffice > Setting
            Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {

                Route::resource('bank-account', 'BackOffice\Setting\BankAccountController');
                Route::get('setting/backOffice/bank-account/{id}/print', 'BackOffice\Setting\BankAccountController@print');
                Route::delete('/', 'BackOffice\Setting\BankAccountController@destroyAll');
                Route::match(
                    ['put', 'patch'],
                    'bank-account/{id}/restore',
                    ['as' => 'bank-account.restore', 'uses' => 'BackOffice\Setting\BankAccountController@restore']
                );

                Route::resource('category', 'BackOffice\Setting\CategoryController');
                Route::get('setting/category/{id}/print', 'BackOffice\Setting\CategoryController@print');
                Route::match(['get', 'patch'], 'setting/category/{id}/checkDeleteType', ['as' => 'category.checkDeleteType', 'uses' => 'BackOffice\Setting\CategoryController@checkDeleteType']);
                Route::match(['post', 'patch'], 'setting/category/checkDeleteTypeFromDeleteAll', ['as' => 'category.checkDeleteTypeFromDeleteAll', 'uses' => 'BackOffice\Setting\CategoryController@checkDeleteTypeFromDeleteAll']);
                Route::match(['post', 'patch'], 'setting/category/deleteAll', ['as' => 'category.deleteAll', 'uses' => 'BackOffice\Setting\CategoryController@deleteAll']);
                Route::match(['put', 'patch'], 'setting/category/{id}/restore', ['as' => 'category.restore', 'uses' => 'BackOffice\Setting\CategoryController@restore']);

                Route::resource('point', 'BackOffice\Setting\PointController');
                Route::get('point/{id}/print', 'BackOffice\Setting\PointController@print');
                Route::match(['put', 'patch'], 'point/{id}/restore', 'BackOffice\Setting\PointController@restore');
                Route::post('point/deleteAll', ['as' => 'point.deleteAll', 'uses' => 'BackOffice\Setting\PointController@destroyAll']);

                Route::resource('product', 'BackOffice\Setting\ProductController');
                Route::get('product/{id}/print', 'BackOffice\Setting\ProductController@print');
                Route::match(['post', 'patch'], 'product/restore', 'BackOffice\Setting\ProductController@restore');

                Route::resource('shipping', 'BackOffice\Setting\ShippingController');
                Route::get('setting/shipping/{id}/print', 'BackOffice\Setting\ShippingController@print');
                Route::match(['put', 'patch'], 'shipping/{id}/restore', ['as' => 'shipping.restore', 'uses' => 'BackOffice\Setting\ShippingController@restore']);
				Route::post('shipping/deleteAll', ['as' => 'shipping.deleteAll', 'uses' => 'BackOffice\Setting\ShippingController@destroyAll']);

                Route::resource('user-class', 'BackOffice\Setting\UserClassController');
                Route::get('setting/user-class/{id}/print', 'BackOffice\Setting\UserClassController@print');
                Route::match(['put', 'patch'], 'user-class/{user_class}/restore', ['as' => 'user-class.restore', 'uses' => 'BackOffice\Setting\UserClassController@restore']);
                Route::match(['post'], 'user-class/delete-all', ['as' => 'user-class.delete-all', 'uses' => 'BackOffice\Setting\UserClassController@deleteAll']);

                Route::resource('writer', 'BackOffice\Setting\WriterController');
                Route::get('setting/writer/{id}/print', 'BackOffice\Setting\WriterController@print');
                Route::match(['put', 'patch'], 'writer/{id}/restore', ['as' => 'writer.restore', 'uses' => 'BackOffice\Setting\WriterController@restore']);
                Route::match(['post'], 'writer/delete-all', ['as' => 'writer.delete-all', 'uses' => 'BackOffice\Setting\WriterController@deleteAll']);
				Route::match(['post', 'put', 'patch'],'writer/check-writer', ['as' =>'writer.check-writer', 'uses' =>'BackOffice\Setting\WriterController@checkwriter']);
            });
        });
    });

});
});
