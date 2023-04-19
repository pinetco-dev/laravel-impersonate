<?php

namespace Pinetcodev\LaravelImpersonate\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as Orchestra;
use Pinetcodev\LaravelImpersonate\LaravelImpersonateServiceProvider;
use Pinetcodev\LaravelImpersonate\Tests\Stubs\Models\User;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app['view']->addLocation(__DIR__.'/Stubs/views/');

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Pinetcodev\\LaravelImpersonate\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        $this->setUpConfig();
        $this->setUpRoutes();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelImpersonateServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $this->userTableSetup($app);

        $migration = include __DIR__.'/../database/migrations/create_impersonates_table.php.stub';
        $migration->up();

        // Setup the right User class (using stub)
        $app['config']->set('auth.providers.users.model', User::class);
        $app['config']->set('auth.providers.admins', [
            'driver' => 'eloquent',
            'model' => User::class,
        ]);
    }

    private function userTableSetup($app)
    {
        $app['db']->connection()->getSchemaBuilder()
            ->create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
    }

    /**
     * @return void
     */
    protected function setUpRoutes()
    {
        // Add routes by calling macro
        $this->app['router']->impersonation();

        // Refresh named routes
        $this->app['router']->getRoutes()->refreshNameLookups();
        $this->app['router']->view('after-request-redirection', 'impersonate')->name('after-request-redirection');
        $this->app['router']->view('can_be_impersonated', 'can_be_impersonated')->name('can_be_impersonated');
    }

    private function setUpConfig()
    {
        Config::set('app.key', 'base64:gvMDxVTnKO7v5C8daL4XSfLmurb8kSL19MR85fLVg7o=');

        Config::set('impersonate.authorized_emails', ['admin@example.com']);
        Config::set('impersonate.after_request_redirection', 'after-request-redirection');
        Config::set('impersonate.leave_redirect_to', 'can_be_impersonated');
    }

    /**
     * @return  void
     */
    protected function makeView(string $view = 'impersonate', array $with = [])
    {
        $this->view = $this->app['view']->make($view, $with)->render();
    }

    /**
     * @param void
     * @return  void
     */
    protected function logout()
    {
        $this->app['auth']->logout();
    }
}
