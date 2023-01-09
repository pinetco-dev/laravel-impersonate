<?php

namespace Pinetcodev\LaravelImpersonate\Tests;

class RoutesTest extends TestCase
{
    private $routes;

    public function setUp(): void
    {
        parent::setUp();

        $this->routes = $this->app['router']->getRoutes();
    }

    /** @test */
    public function it_can_request_impersonating()
    {
        $this->assertTrue((bool) $this->routes->getByName('impersonate'));
        $this->assertTrue((bool) $this->routes->getByAction('Pinetcodev\LaravelImpersonate\Http\Controllers\ImpersonateController@take'));
    }

    /** @test */
    public function it_can_log_in_as_an_impersonation()
    {
        $this->assertTrue((bool) $this->routes->getByName('impersonate.log-in'));
        $this->assertTrue((bool) $this->routes->getByAction('Pinetcodev\LaravelImpersonate\Http\Controllers\ImpersonateController@logIn'));
    }

    /** @test */
    public function it_can_leave_impersonation()
    {
        $this->assertTrue((bool) $this->routes->getByName('impersonate.leave'));
        $this->assertTrue((bool) $this->routes->getByAction('Pinetcodev\LaravelImpersonate\Http\Controllers\ImpersonateController@leave'));
    }
}
