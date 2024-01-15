<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'esign' => [
        'url' => env('ESIGN_URL', '103.7.13.182'),
        'username' => env('ESIGN_USERNAME', 'esign'),
        'password' => env('ESIGN_PASSWORD', 'qwerty'),
    ],

    'emis' => [
        'url' => env('EMIS_URL', 'http://devapi-pendidikan.kemenag.go.id/v1/institutions/integration/ijop'),
    ],

    'madrasah_ijop_v1' => [
        'url' => env('MADRASAH_IJOP_V1', 'https://ijopmadrasah.kemenag.go.id/v1/api'),
        'token' => env('MADRASAH_IJOP_V1_TOKEN', '07d2fa06408f29117589927e42f8ce2b'),
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
];
