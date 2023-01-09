<?php

namespace Pinetcodev\LaravelImpersonate\Tests;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Pinetcodev\LaravelImpersonate\Models\Impersonate;
use Pinetcodev\LaravelImpersonate\Tests\Stubs\Models\User;

class BladeDirectivesTest extends TestCase
{
    /** @var User */
    protected $user;

    /** @var User */
    protected $admin;

    /** @var string */
    protected $view;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['email' => 'admin@example.com']);
        $this->user = User::factory()->create(['email' => 'user@example.com']);
    }

    /** @test */
    public function it_displays_can_impersonate_content_directive_for_admin()
    {
        Notification::fake();
        $this->actingAs($this->admin);
        $this->makeView('can_be_impersonated', ['user' => $this->user]);
        $this->assertStringContainsString('Impersonate this user', $this->view);

        $this->logout();
    }

    /** @test */
    public function it_not_displays_can_impersonate_content_directive_for_user()
    {
        $this->actingAs($this->user);
        $this->makeView('can_be_impersonated', ['user' => $this->user]);
        $this->assertStringNotContainsString('Impersonate this user', $this->view);
        $this->logout();
    }

    /** @test */
    public function it_displays_impersonating_content_directive()
    {
        // Impersonate invitation
        $this->actingAs($this->admin);

        $this->get(route('impersonate', $this->user))
            ->assertStatus(Response::HTTP_OK);
        $impersonate = Impersonate::first();

        //Manual impersonate link
        $logInRoute = URL::temporarySignedRoute('impersonate.log-in',
            now()->addMinutes(config('impersonate.lifetime')),
            [$impersonate]);

        // Login as impersonate
        $this->get($logInRoute)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(config('impersonate.after_request_redirection'));

        $this->makeView();
        $this->assertStringContainsString('Leave impersonation', $this->view);
        $this->logout();
    }
}
