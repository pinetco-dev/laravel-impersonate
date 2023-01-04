<?php

namespace Pinetcodev\LaravelImpersonate;

trait ImpersonateManager
{
    public function getSessionKey(): string
    {
        return config('impersonate.session_key');
    }

    /**
     * @return string|null
     */
    public function getImpersonatorGuardName()
    {
        return session($this->getSessionGuard(), null);
    }

    public function getSessionGuard(): string
    {
        return config('impersonate.session_guard');
    }

    public function getTakeRedirectTo(): string
    {
        try {
            $uri = route(config('impersonate.take_redirect_to'));
        } catch (\InvalidArgumentException $e) {
            $uri = config('impersonate.take_redirect_to');
        }

        return $uri;
    }

    public function getLeaveRedirectTo(): string
    {
        try {
            $uri = route(config('impersonate.leave_redirect_to'));
        } catch (\InvalidArgumentException $e) {
            $uri = config('impersonate.leave_redirect_to');
        }

        return $uri;
    }
}
