<?php

return [
    'merchant_id' => '764764000001264',//'764764000001264',
    'secret_key'  => env('2C2P_SECRET_KEY'),//'1D26B7C9D485EFFF35FE47B5CDB512DBAFA8AA957FB10A094DBE86C0D0243640',

    'private_key_pass' => '2c2p',
    'private_key_path' => storage_path('cert/private.pem'),
    'public_key_path'  => storage_path('cert/public.crt'),

    'redirect_access_url' => 'https://demo2.2c2p.com/2C2PFrontEnd/RedirectV3/payment',

    'access_url'        => 'https://demo2.2c2p.com/2C2PFrontEnd/SecurePayment/PaymentAuth.aspx',
    'secure_pay_script' => 'https://demo2.2c2p.com/2C2PFrontEnd/SecurePayment/api/my2c2p.1.6.9.min.js',

    'currency_code' => 764, // Ref: http://en.wikipedia.org/wiki/ISO_4217
    'country_code'  => 'TH',

    '123_merchant_id'       => 'merchant@smarthotel.com',
    '123_api_secret_key'    => 'M5WCTP59J544IRRUBTJE0Q7Z2PAJX3CT',
    '123_public_key_path'   => storage_path('cert/123.pem'), // 123' Certificate file
    '123_currency_code'     => 'MMK',
    '123_country_code'      => 'THB',
    '123_agent_code'        => 'ABC',
    '123_channel_code'      => 'OVERTHECOUNTER',
    '123_merchant_url'      => 'merchant url',
    '123_api_call_url'      => 'api call url',
    '123_access_url'        => 'https://demo3.2c2p.com/123MM/Payment/Pay/Slip',

    //QuickPay
    'direct_api'   => 'http://demo2.2c2p.com/2C2PFrontEnd/QuickPay/DirectAPI',
    'delivery_api' => 'http://demo2.2c2p.com/2C2PFrontEnd/QuickPay/DeliveryAPI',
];
