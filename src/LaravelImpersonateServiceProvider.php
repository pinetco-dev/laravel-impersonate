<?php

namespace Pinetcodev\LaravelImpersonate;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Pinetcodev\LaravelImpersonate\Commands\LaravelImpersonateCommand;
use Pinetcodev\LaravelImpersonate\Http\Controllers\ImpersonateController;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelImpersonateServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $this->configureAuthorization();

        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-impersonate')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_impersonates_table')
            ->hasCommand(LaravelImpersonateCommand::class);
    }

    public function packageRegistered()
    {
        Route::macro('impersonation', function () {
            $baseUrl = config('impersonate.route_path_prefix');
            Route::prefix($baseUrl)
                ->middleware(config('impersonate.middleware'))
                ->group(function () {
                    Route::get('take/{user}', [ImpersonateController::class, 'take'])
                        ->name('impersonate');
                    Route::get('{impersonate}', [ImpersonateController::class, 'logIn'])
                        ->name('impersonate.log-in');
                    Route::get('leave/{impersonate}', [ImpersonateController::class, 'leave'])
                        ->name('impersonate.leave');
                });
        });
    }

    private function configureAuthorization()
    {
        Gate::define('accessToImpersonate', function ($user) {
            return in_array($user->email, config('impersonate.authorization_emails'));
        });

        Gate::define('accessToLeaveImpersonate', function ($user, $impersonate, $sessionKey) {
            return session()->has($sessionKey) && $user->id == $impersonate->impersonated_id;
        });
    }
}
