<?php

namespace Pinetcodev\LaravelImpersonate\Tests;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Pinetcodev\LaravelImpersonate\Models\Impersonate;
use Pinetcodev\LaravelImpersonate\Notifications\ImpersonationNotification;
use Pinetcodev\LaravelImpersonate\Tests\Stubs\Models\User;

class ImpersonateControllerTest extends TestCase
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
    public function it_authorizes_a_person_can_request_impersonating()
    {
        Notification::fake();
        $this->actingAs($this->admin);

        $this->get(route('impersonate', $this->user))
            ->assertStatus(Response::HTTP_OK);

        Notification::assertSentTo([$this->admin], ImpersonationNotification::class);
    }

    /** @test */
    public function non_authorize_person_cant_request_to_impersonate()
    {
        $this->actingAs($this->user);

        Notification::fake();

        $this->get(route('impersonate', $this->user))
            ->assertStatus(Response::HTTP_FORBIDDEN);

        Notification::assertNotSentTo([$this->user], ImpersonationNotification::class);
    }

    /** @test */
    public function it_authorizes_a_person_can_log_in_as_impersonating()
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

        $this->assertDatabaseHas('impersonates', ['logged_in' => now()]);

        $this->makeView();
        $this->assertStringContainsString('Leave impersonation', $this->view);
    }

    /** @test */
    public function it_authorizes_a_person_can_leave_the_impersonation_mode()
    {
        $this->actingAs($this->admin);

        // Send invitation for impersonation
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
        $this->assertDatabaseHas('impersonates', ['logged_in' => now()]);

        $this->makeView();
        $this->assertStringContainsString('Leave impersonation', $this->view);

        // Logout from impersonation
        $this->get(route('impersonate.leave', ['impersonate' => get_impersonate_session_value()]))
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('impersonates', ['logouted_at' => now()]);

        $this->makeView('can_be_impersonated', ['user' => $this->user]);
        $this->assertStringContainsString('Impersonate this user', $this->view);
    }
}
