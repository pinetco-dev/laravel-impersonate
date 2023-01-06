<?php

if (! function_exists('uuid')) {
    /**
     * Returns UUID of 32 characters
     *
     * @return string
     */
    function uuid()
    {
        $currentTime = (string) microtime(true);

        $randNumber = (string) rand(10000, 1000000);

        $shuffledString = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');

        return md5($currentTime.$randNumber.$shuffledString);
    }
}

if (! function_exists('is_impersonating')) {
    /**
     * Check whether the current user is being impersonated.
     *
     * @return bool
     */
    function is_impersonating(): bool
    {
        return session()->has(config('impersonate.session_key'));
    }
}

if (! function_exists('can_impersonate')) {
    /**
     * Check whether the current user is authorized to impersonate.
     *
     * @param  null  $guard
     * @return bool
     */
    function can_impersonate(): bool
    {
        return auth()->check() && in_array(auth()->user()->email, config('impersonate.authorization_emails'));
    }
}
