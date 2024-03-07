<?php

namespace Pinetcodev\LaravelImpersonate\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Pinetcodev\LaravelImpersonate\Contracts\Resolver;
use Pinetcodev\LaravelImpersonate\ImpersonateManager;
use Pinetcodev\LaravelImpersonate\Models\Impersonate;
use Pinetcodev\LaravelImpersonate\Notifications\ImpersonationNotification;

class ImpersonateController extends Controller
{
    use ImpersonateManager;

    public function take(User $user)
    {
        Gate::authorize('takeImpersonate', [auth()->user()]);
        auth()->user()->notify(new ImpersonationNotification($user));

        return view('impersonate::success', ['user' => $user, 'authUser' => auth()->user()]);
    }

    public function logIn(Request $request, Impersonate $impersonate)
    {
        if (! $request->hasValidSignature() || $impersonate->logged_in) {
            abort(401);
        }

        session()->put($this->getSessionKey(), $impersonate->getRouteKey());
        Auth::guard($this->getSessionGuard())->loginUsingId($impersonate->impersonated_id);

        $impersonate->update(array_merge([
            'logged_in' => now(),
        ], $this->runResolvers()));

        return redirect()->to($this->getTakeRedirectTo());
    }

    private function runResolvers(): array
    {
        $resolved = [];
        $resolvers = Config::get('impersonate.resolvers', []);
        foreach ($resolvers as $name => $implementation) {
            if (empty($implementation)) {
                continue;
            }

            if (! is_subclass_of($implementation, Resolver::class)) {
                throw new \Exception('Invalid Resolver implementation for: '.$name);
            }
            $resolved[$name] = call_user_func([$implementation, 'resolve'], $this);
        }

        return $resolved;
    }

    public function leave(Impersonate $impersonate)
    {
        $sessionKey = $this->getSessionKey();

        Gate::authorize('leaveImpersonate', [$impersonate, $sessionKey]);

        Auth::guard($this->getSessionGuard())->loginUsingId($impersonate->user_id);
        $impersonate->update(['logouted_at' => now()]);

        session()->forget($sessionKey);

        return redirect()->to($this->getLeaveRedirectTo());
    }
}
