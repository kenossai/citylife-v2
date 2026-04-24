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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'youtube' => [
        'api_key'    => env('YOUTUBE_API_KEY'),
        'channel_id' => env('YOUTUBE_CHANNEL_ID'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'turnstile' => [
        'site_key'   => env('TURNSTILE_SITE_KEY'),
        'secret_key' => env('TURNSTILE_SECRET_KEY'),
    ],

    'churchsuite' => [
        'api_url'       => env('CHURCHSUITE_API_URL', 'https://api.churchsuite.com/v1'),
        'token_url'     => env('CHURCHSUITE_TOKEN_URL', 'https://oauth.churchsuite.com/oauth2/token'),
        'client_id'     => env('CHURCHSUITE_CLIENT_ID'),
        'client_secret' => env('CHURCHSUITE_CLIENT_SECRET'),
        'account_id'    => env('CHURCHSUITE_ACCOUNT_ID'),
    ],

    /*
    | Church WiFi / premises IP whitelist.
    | Set CHURCH_WIFI_IP in .env to the church's public IP address.
    | The course enrolment form is only visible/accessible from this IP.
    | Separate multiple IPs with commas: 1.2.3.4,5.6.7.8
    */
    'church_wifi_ip' => env('CHURCH_WIFI_IP', ''),

];
