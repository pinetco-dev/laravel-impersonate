<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Session Key
    |--------------------------------------------------------------------------
    |
    | The session key used to store the original impersonation unique id.
    |
    */
    'session_key' => 'impersonated_by',

    /*
    |--------------------------------------------------------------------------
    | Session Guard
    |--------------------------------------------------------------------------
    |
    | The default impersonator guard used for auth user.
    |
    */
    'session_guard' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Impersonate Route Prefix
    |--------------------------------------------------------------------------
    |
    | Here you may specify which prefix will assign to all the
    | routes that it registers with the application for impersonation.
    | If necessary, you may change the subdomain under which the Impersonate routes will be available.
    |
    */
    'route_path_prefix' => 'impersonates',

    /*
   |--------------------------------------------------------------------------
   | Impersonate route middleware.
   |--------------------------------------------------------------------------
   |
   | The middleware should enable session and cookies support in order for impersonate to work.
   | The 'web' middleware will be applied automatically if empty.
   |
   */

    'middleware' => ['web'],

    /*
   |--------------------------------------------------------------------------
   | Impersonate Authorized Emails
   |--------------------------------------------------------------------------
   |
   | Here you may specify the authentication emails which
   | will use while authenticating users for impersonation.
   |
   */
    'authorized_emails' => [
        //
    ],

    /*
   |--------------------------------------------------------------------------
   | After Request Redirection
   |--------------------------------------------------------------------------
   |
   | The URI to redirect after requesting an impersonation.
   |
   */
    'after_request_redirection' => url()->previous(),

    /*
   |--------------------------------------------------------------------------
   | Leave redirection
   |--------------------------------------------------------------------------
   |
   | The URI to redirect after leaving an impersonation.
   |
   */
    'leave_redirect_to' => '/dashboard',

    /*
    |--------------------------------------------------------------------------
    | Impersonate Link Lifetime
    |--------------------------------------------------------------------------
    |
    | Here you may specify the number of minutes that you wish the link
    | to be allowed to remain idle before it expires.
    |
    */
    'lifetime' => 60,
];
