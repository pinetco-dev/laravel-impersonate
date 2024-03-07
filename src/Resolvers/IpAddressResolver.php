<?php

namespace Pinetcodev\LaravelImpersonate\Resolvers;

use Illuminate\Support\Facades\Request;
use Pinetcodev\LaravelImpersonate\Contracts\Resolver;

class IpAddressResolver implements Resolver
{
    public static function resolve(): string
    {
        return Request::ip();
    }
}
