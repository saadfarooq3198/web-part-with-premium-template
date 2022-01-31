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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '510752117046059',
        'client_secret' => '6e82fc4028dc2b3660adde286ce9181e',
        'redirect' => 'http://127.0.0.1:8000/auth/facebook/callback',
    ],
     'github' => [
        'client_id' => '2f5695d686dc9aa79ff2',
        'client_secret' => '2cd98350d8141ea6d8435e4f17b6aed989885286',
        'redirect' => 'http://127.0.0.1:8000/auth/github/callback',
    ],
    'google' => [
        'client_id' => '513766243418-5l3st9v3tgbls9qfu00neps9spdargqe.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
      ], 
      'linkedin' => [
        'client_id' => '777d4jcq3cjy4f',
        'client_secret' => 'mmNngLGv9N3O3meS',
        'redirect' => 'http://127.0.0.1:8000/auth/linkedin/callback',
    ],
];
