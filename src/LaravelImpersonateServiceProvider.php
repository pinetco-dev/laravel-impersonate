<?php

namespace Pinetcodev\LaravelImpersonate;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Compilers\BladeCompiler;
use Pinetcodev\LaravelImpersonate\Commands\LaravelImpersonateCommand;
use Pinetcodev\LaravelImpersonate\Http\Controllers\ImpersonateController;
use Pinetcodev\LaravelImpersonate\Http\Middleware\ProtectFromImpersonation;
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

        $this->registerMiddleware();
        $this->registerBladeDirectives();
    }

    public function packageRegistered()
    {
        Route::macro('impersonation', function () {
            $baseUrl = config('impersonate.route_path_prefix');
            Route::prefix($baseUrl)
                ->middleware(config('impersonate.middleware'))
                ->middleware('throttle:3,1')
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
        Gate::define('takeImpersonate', function ($user) {
            return can_impersonate();
        });

        Gate::define('leaveImpersonate', function ($user, $impersonate, $sessionKey) {
            return session()->has($sessionKey) && $user->id == $impersonate->impersonated_id;
        });
    }

    private function registerBladeDirectives()
    {
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            $bladeCompiler->directive('impersonating', function () {
                return '<?php if (is_impersonating()) : ?>';
            });

            $bladeCompiler->directive('endImpersonating', function () {
                return '<?php endif; ?>';
            });

            $bladeCompiler->directive('canImpersonate', function () {
                return '<?php if (can_impersonate()) : ?>';
            });

            $bladeCompiler->directive('endCanImpersonate', function () {
                return '<?php endif; ?>';
            });
        });
    }

    private function registerMiddleware()
    {
        $this->app['router']->aliasMiddleware('impersonate.protect', ProtectFromImpersonation::class);
    }
}
