<?php

namespace Pinetcodev\LaravelImpersonate\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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

        $impersonate->update([
            'logged_in' => now(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('user-agent'),
        ]);

        return redirect()->to($this->getTakeRedirectTo());
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
