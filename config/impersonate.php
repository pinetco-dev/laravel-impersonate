<?php

return [
    /**
     * The session key used to store the original user id.
     */
    'session_key' => 'impersonated_by',

    /**
     * The default impersonator guard used.
     */
    'session_guard' => 'web',

    'route_path_prefix' => 'impersonates',

    'middleware' => 'auth',

    'authorization_emails' => [
        'raviraj@pinetco.com',
        'pooja@pinetco.com',
        'test@example.com',
    ],

    /**
     * The URI to redirect after taking an impersonation.
     *
     * Only used in the built-in controller.
     * * Use 'back' to redirect to the previous page
     */
    'take_redirect_to' => '/dashboard',

    /**
     * The URI to redirect after leaving an impersonation.
     *
     * Only used in the built-in controller.
     * Use 'back' to redirect to the previous page
     */
    'leave_redirect_to' => '/dashboard',
];
