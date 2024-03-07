<?php

namespace Pinetcodev\LaravelImpersonate\Resolvers;

use Illuminate\Support\Facades\Request;
use Pinetcodev\LaravelImpersonate\Contracts\Resolver;

class UserAgentResolver implements Resolver
{
    public static function resolve()
    {
        return Request::header('User-Agent');
    }
}
