let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.options({
    processCssUrls: false,
})

mix

// Global
    .copyDirectory('node_modules/font-awesome', 'public/font-awesome')
    .copyDirectory('resources/assets/images', 'public/images')
    .copyDirectory('resources/assets/js', 'public/js')
    .copy('resources/assets/fonts/', 'public/fonts')
    .copy('resources/assets/css/common', 'public/css/common')
    .copy('storage/images/backOffice/bankAcc/logo/uploaded', 'public/images/backOffice/bankAcc/logo/uploaded')
    .sass('resources/assets/sass/layouts/website/core_boostrap.scss', 'public/css')
    .sass('resources/assets/sass/layouts/website/main.scss', 'public/css')
    .sass('resources/assets/sass/layouts/backOffice/admin_core_boostrap.scss', 'public/css')
    .sass('resources/assets/sass/layouts/backOffice/admin_style.scss', 'public/css')
    .js('resources/assets/js/common/tostr.min.js', 'public/js')
    .js('resources/assets/js/common/sweetalert2.min.js', 'public/js')
    .js('resources/assets/js/app.js', 'public/js')

// Website
.sass('resources/assets/sass/website/about_us.scss', 'public/css')
    .sass('resources/assets/sass/website/book/index.scss', 'public/css/website/book')
    .sass('resources/assets/sass/website/book/show.scss', 'public/css/website/book')
    .sass('resources/assets/sass/website/contact_us.scss', 'public/css')
    .sass('resources/assets/sass/website/home.scss', 'public/css')
    .sass('resources/assets/sass/website/news_and_event.scss', 'public/css')
    .sass('resources/assets/sass/website/payment.scss', 'public/css')
    .sass('resources/assets/sass/website/preorder.scss', 'public/css')
    .sass('resources/assets/sass/website/reportPayment/index.scss', 'public/css/website/reportPayment')
    .sass('resources/assets/sass/website/writer/index.scss', 'public/css/website/writer')
    .sass('resources/assets/sass/website/writer/show.scss', 'public/css/website/writer')
    .js('resources/assets/js/website/reportPayment/index.js', 'public/js/website/reportPayment')

// eCommerce
.sass('resources/assets/sass/eCommerce/checkout.scss', 'public/css/eCommerce')
    .sass('resources/assets/sass/eCommerce/shipping.scss', 'public/css')
    .sass('resources/assets/sass/eCommerce/thank.scss', 'public/css')
    .js('resources/assets/js/eCommerce/checkout/index.js', 'public/js/eCommerce/checkout')

// Auth
.sass('resources/assets/sass/auth/login.scss', 'public/css')

.sass('resources/assets/sass/auth/profile.scss', 'public/css/auth')
    .js('resources/assets/js/auth/profile.js', 'public/js/auth')

// BackOffice
.sass('resources/assets/sass/backOffice/dashboard/index.scss', 'public/css/backOffice/dashboard')

.sass('resources/assets/sass/backOffice/member/index.scss', 'public/css/backOffice/member')
    .sass('resources/assets/sass/backOffice/member/create.scss', 'public/css/backOffice/member')
    .sass('resources/assets/sass/backOffice/member/show.scss', 'public/css/backOffice/member')

.sass('resources/assets/sass/backOffice/order/index.scss', 'public/css/backOffice/order')
    .sass('resources/assets/sass/backOffice/order/create.scss', 'public/css/backOffice/order')
    .sass('resources/assets/sass/backOffice/order/show.scss', 'public/css/backOffice/order')
    .sass('resources/assets/sass/backOffice/order/print.scss', 'public/css/backOffice/order')
    .js('resources/assets/js/backOffice/order/create.js', 'public/js/backOffice/order')
    .js('resources/assets/js/backOffice/order/show.js', 'public/js/backOffice/order')
    .js('resources/assets/js/backOffice/order/index.js', 'public/js/backOffice/order')
    .js('resources/assets/js/backOffice/order/print.js', 'public/js/backOffice/order')

.sass('resources/assets/sass/backOffice/pos/index.scss', 'public/css/backOffice/pos')
    .sass('resources/assets/sass/backOffice/pos/create.scss', 'public/css/backOffice/pos')
    .sass('resources/assets/sass/backOffice/pos/show.scss', 'public/css/backOffice/pos')

.sass('resources/assets/sass/backOffice/preOrder/index.scss', 'public/css/backOffice/preOrder')
    .sass('resources/assets/sass/backOffice/preOrder/create.scss', 'public/css/backOffice/preOrder')
    .sass('resources/assets/sass/backOffice/preOrder/show.scss', 'public/css/backOffice/preOrder')
    .js('resources/assets/js/backOffice/preOrder/index.js', 'public/js/backOffice/preOrder')

.sass('resources/assets/sass/backOffice/printDelivery/index.scss', 'public/css/backOffice/printDelivery')
    .sass('resources/assets/sass/backOffice/printDelivery/create.scss', 'public/css/backOffice/printDelivery')
    .sass('resources/assets/sass/backOffice/printDelivery/show.scss', 'public/css/backOffice/printDelivery')

.sass('resources/assets/sass/backOffice/promotion/index.scss', 'public/css/backOffice/promotion')
    .sass('resources/assets/sass/backOffice/promotion/create.scss', 'public/css/backOffice/promotion')
    .sass('resources/assets/sass/backOffice/promotion/show.scss', 'public/css/backOffice/promotion')

.sass('resources/assets/sass/backOffice/report/index.scss', 'public/css/backOffice/report')
    .sass('resources/assets/sass/backOffice/report/create.scss', 'public/css/backOffice/report')
    .sass('resources/assets/sass/backOffice/report/show.scss', 'public/css/backOffice/report')

.sass('resources/assets/sass/backOffice/scanPO/index.scss', 'public/css/backOffice/scanPO')
    .sass('resources/assets/sass/backOffice/scanPO/create.scss', 'public/css/backOffice/scanPO')
    .sass('resources/assets/sass/backOffice/scanPO/show.scss', 'public/css/backOffice/scanPO')

.sass('resources/assets/sass/backOffice/setting/bankAccount/index.scss', 'public/css/backOffice/setting/bankAccount')
    .sass('resources/assets/sass/backOffice/setting/bankAccount/create.scss', 'public/css/backOffice/setting/bankAccount')
    .sass('resources/assets/sass/backOffice/setting/bankAccount/show.scss', 'public/css/backOffice/setting/bankAccount')

.sass('resources/assets/sass/backOffice/setting/category/index.scss', 'public/css/backOffice/setting/category')
    .sass('resources/assets/sass/backOffice/setting/category/create.scss', 'public/css/backOffice/setting/category')
    .sass('resources/assets/sass/backOffice/setting/category/show.scss', 'public/css/backOffice/setting/category')

.sass('resources/assets/sass/backOffice/setting/point/index.scss', 'public/css/backOffice/setting/point')
    .sass('resources/assets/sass/backOffice/setting/point/create.scss', 'public/css/backOffice/setting/point')
    .sass('resources/assets/sass/backOffice/setting/point/show.scss', 'public/css/backOffice/setting/point')

.sass('resources/assets/sass/backOffice/setting/product/index.scss', 'public/css/backOffice/setting/product')
    .sass('resources/assets/sass/backOffice/setting/product/create.scss', 'public/css/backOffice/setting/product')
    .sass('resources/assets/sass/backOffice/setting/product/show.scss', 'public/css/backOffice/setting/product')

.sass('resources/assets/sass/backOffice/setting/shipping/index.scss', 'public/css/backOffice/setting/shipping')
    .sass('resources/assets/sass/backOffice/setting/shipping/create.scss', 'public/css/backOffice/setting/shipping')
    .sass('resources/assets/sass/backOffice/setting/shipping/show.scss', 'public/css/backOffice/setting/shipping')

.sass('resources/assets/sass/backOffice/setting/userClass/index.scss', 'public/css/backOffice/setting/userClass')
    .sass('resources/assets/sass/backOffice/setting/userClass/create.scss', 'public/css/backOffice/setting/userClass')
    .sass('resources/assets/sass/backOffice/setting/userClass/show.scss', 'public/css/backOffice/setting/bankAccount')

.sass('resources/assets/sass/backOffice/setting/writer/index.scss', 'public/css/backOffice/setting/writer')
    .sass('resources/assets/sass/backOffice/setting/writer/create.scss', 'public/css/backOffice/setting/writer')
    .sass('resources/assets/sass/backOffice/setting/writer/show.scss', 'public/css/backOffice/setting/writer')

.sass('resources/assets/sass/backOffice/website/aboutUs/index.scss', 'public/css/backOffice/website/aboutUs')
    .sass('resources/assets/sass/backOffice/website/aboutUs/create.scss', 'public/css/backOffice/website/aboutUs')
    .sass('resources/assets/sass/backOffice/website/aboutUs/show.scss', 'public/css/backOffice/website/aboutUs')

.sass('resources/assets/sass/backOffice/website/banner/index.scss', 'public/css/backOffice/website/banner')
    .sass('resources/assets/sass/backOffice/website/banner/create.scss', 'public/css/backOffice/website/banner')
    .sass('resources/assets/sass/backOffice/website/banner/show.scss', 'public/css/backOffice/website/banner')

.sass('resources/assets/sass/backOffice/website/categoryNewsAndEvent/index.scss', 'public/css/backOffice/website/categoryNewsAndEvent')
    .sass('resources/assets/sass/backOffice/website/categoryNewsAndEvent/create.scss', 'public/css/backOffice/website/categoryNewsAndEvent')
    .sass('resources/assets/sass/backOffice/website/categoryNewsAndEvent/show.scss', 'public/css/backOffice/website/categoryNewsAndEvent')

.sass('resources/assets/sass/backOffice/website/contactUs/index.scss', 'public/css/backOffice/website/contactUs')
    .sass('resources/assets/sass/backOffice/website/contactUs/create.scss', 'public/css/backOffice/website/contactUs')
    .sass('resources/assets/sass/backOffice/website/contactUs/show.scss', 'public/css/backOffice/website/contactUs')

.sass('resources/assets/sass/backOffice/website/general/index.scss', 'public/css/backOffice/website/general')
    .sass('resources/assets/sass/backOffice/website/general/create.scss', 'public/css/backOffice/website/general')
    .sass('resources/assets/sass/backOffice/website/general/show.scss', 'public/css/backOffice/website/general')

.sass('resources/assets/sass/backOffice/website/allBook/index.scss', 'public/css/backOffice/website/allBook')
    .sass('resources/assets/sass/backOffice/website/allBook/create.scss', 'public/css/backOffice/website/allBook')
    .sass('resources/assets/sass/backOffice/website/allBook/show.scss', 'public/css/backOffice/website/allBook')
    .js('resources/assets/js/backOffice/website/allBook/index.js', 'public/js/backOffice/website/allBook')

.sass('resources/assets/sass/backOffice/website/home/index.scss', 'public/css/backOffice/website/home')
    .sass('resources/assets/sass/backOffice/website/home/create.scss', 'public/css/backOffice/website/home')
    .sass('resources/assets/sass/backOffice/website/home/show.scss', 'public/css/backOffice/website/home')

.sass('resources/assets/sass/backOffice/website/newsAndEvent/index.scss', 'public/css/backOffice/website/newsAndEvent')
    .sass('resources/assets/sass/backOffice/website/newsAndEvent/create.scss', 'public/css/backOffice/website/newsAndEvent')
    .sass('resources/assets/sass/backOffice/website/newsAndEvent/show.scss', 'public/css/backOffice/website/newsAndEvent')

.sass('resources/assets/sass/backOffice/profile/index.scss', 'public/css/backOffice/profile')

;