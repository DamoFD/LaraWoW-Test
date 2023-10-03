<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Client ID
    |--------------------------------------------------------------------------
    |
    | This is the Client ID of your LaraWoW application.
    |
    */

    'client_id' => env('LARAWOW_CLIENT_ID', null),

    /*
    |--------------------------------------------------------------------------
    | Client Secret
    |--------------------------------------------------------------------------
    |
    | This is the Client Secret of your LaraWoW application.
    |
    */

    'client_secret' => env('LARAWOW_CLIENT_SECRET', null),

    /*
    |--------------------------------------------------------------------------
    | Redirect URI
    |--------------------------------------------------------------------------
    |
    | This is the Redirect URI of your LaraWoW application.
    |
    */

    'redirect_uri' => env('APP_URL', null) . '/' . env('LARAWOW_PREFIX', null) . '/callback',

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | This is the Route Prefix of your LaraWoW application.
    |
    */

    'route_prefix' => env('LARAWOW_PREFIX', null),
];
