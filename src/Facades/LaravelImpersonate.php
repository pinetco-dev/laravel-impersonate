<?php

namespace Pinetcodev\LaravelImpersonate\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pinetcodev\LaravelImpersonate\LaravelImpersonate
 */
class LaravelImpersonate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Pinetcodev\LaravelImpersonate\LaravelImpersonate::class;
    }
}
