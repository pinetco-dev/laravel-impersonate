<?php

namespace Pinetcodev\LaravelImpersonate\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class ProtectFromImpersonation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  mixed
     */
    public function handle($request, Closure $next)
    {
        abort_if(is_impersonating(), Response::HTTP_FORBIDDEN);

        return $next($request);
    }
}
