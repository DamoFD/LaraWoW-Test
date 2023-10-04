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

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    | This is the Scopes required for your LaraWoW application.
    |
    */

    'scopes' => env('LARAWOW_SCOPES', null),

    /*
    |--------------------------------------------------------------------------
    | Error Messages
    |--------------------------------------------------------------------------
    |
    | These are the error messages that will be displayed to the user if there
    | is an error.
    |
    */

    'error_messages' => [
        'missing_code' => [
            'message' => 'The authorization code is missing.',
            'redirect' => '/'
        ],
        'invalid_code' => [
            'message' => 'The authorization code is invalid.',
            'redirect' => '/'
        ],
        'authorization_failed' => [
            'message' => 'The authorization failed.',
            'redirect' => '/'
        ],
        'missing_email' => [
            'message' => 'Couldn\'t get your e-mail address.',
            'redirect' => '/'
        ],
        'invalid_user' => [
            'message' => 'The user ID doesn\'t match the logged-in user.',
            'redirect' => '/'
        ],
        'database_error' => [
            'message' => 'There was an error with the database. Please try again later.',
            'redirect' => '/'
        ],
        'missing_access_token' => [
            'message' => 'The access token is missing.',
            'redirect' => '/'
        ],
        'revoke_token_failed' => [
            'message' => 'An error occurred while trying to revoke your access token.',
            'redirect' => '/'
        ],
    ],
];
