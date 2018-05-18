<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    Route::prefix('address')->name('address.')->group(function () {
        Route::prefix('sub-district')->name('sub-district.')->group(function () {
            Route::get('all', 'BackOffice\AddressController@getAllSubDistricts')->name('all');
            Route::get('{id}', 'BackOffice\AddressController@getSubDistrict')->name('get');
            Route::get('search/{query}', 'BackOffice\AddressController@searchSubDistrict')->name('search');
            Route::get('{id}/postal-code', 'BackOffice\AddressController@getPostalCodeBySubDistrict')->name('postal-code');
        });
        Route::prefix('district')->name('district.')->group(function () {
            Route::get('all', 'BackOffice\AddressController@getAllDistricts')->name('all');
            Route::get('{id}', 'BackOffice\AddressController@getDistrict')->name('get');
            Route::get('search/{query}', 'BackOffice\AddressController@searchDistrict')->name('search');
            Route::get('{id}/sub-district', 'BackOffice\AddressController@getSubDistrictByDistrict')->name('sub-district');
        });
        Route::prefix('province')->name('province.')->group(function () {
            Route::get('all', 'BackOffice\AddressController@getAllProvinces')->name('all');
            Route::get('{id}', 'BackOffice\AddressController@getProvince')->name('get');
            Route::get('search/{query}', 'BackOffice\AddressController@searchProvince')->name('search');
            Route::get('{id}/district', 'BackOffice\AddressController@getDistrictByProvince')->name('district');
        });
        Route::prefix('postal-code')->name('postal-code.')->group(function () {
            Route::get('all', 'BackOffice\AddressController@getAllPostalCodes')->name('all');
            Route::get('{id}', 'BackOffice\AddressController@getPostalCode')->name('get');
            Route::get('search/{query}', 'BackOffice\AddressController@searchPostalCode')->name('search');
        });
        Route::prefix('search')->name('search.')->group(function () {
            Route::get('address/{query}', 'BackOffice\AddressController@search')->name('address');
        });
    });

    Route::prefix('member')->name('member.')->group(function () {
        Route::get('{id}/addresses', 'BackOffice\AddressController@getUserAddresses')->name('addresses');
    });

    Route::prefix('product')->name('product.')->group(function () {
        Route::get('all', 'BackOffice\Setting\ProductController@getAllProduct')->name('all');
        Route::get('find', 'BackOffice\Setting\ProductController@findProduct')->name('find');
        Route::get('full', 'BackOffice\Setting\ProductController@getProductFull');
        Route::get('product-image', 'BackOffice\Setting\ProductController@getImageSource')->name('product-image');
        Route::get('calculate', 'BackOffice\Website\HomeController@getFromCalculate');
    });

    Route::prefix('member')->name('member.')->group(function () {
        Route::get('all', 'BackOffice\MemberController@getMembers')->name('all');
    });

    Route::prefix('cart')->name('cart.')->group(function ($router) {
        $router->get('cart/delete', 'Website\CartController@delete');
        $router->resource('cart', 'Website\CartController');
    });

    Route::prefix('shipping')->name('shipping.')->group(function ($router) {
        $router->get('price', 'BackOffice\OrderController@shippingPrice');
    });
});
