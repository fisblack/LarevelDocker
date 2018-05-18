<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => SenseBook\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id'     => env('FACEBOOK_APP_KEY'),
        'client_secret' => env('FACEBOOK_SECRET_KEY'),
        'redirect'      => env('FACEBOOK_REDIRECT_URL'),
    ],

    'twitter' => [
        'client_id'     => env('TWITTER_APP_KEY'),
        'client_secret' => env('TWITTER_SECRET_KEY'),
        'redirect'      => env('TWITTER_REDIRECT_URL'),
    ],

    'google' => [
        'client_id'     => env('GOOGLE_APP_KEY'),
        'client_secret' => env('GOOGLE_SECRET_KEY'),
        'redirect'      => env('GOOGLE_REDIRECT_URL'),
    ],

];