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
