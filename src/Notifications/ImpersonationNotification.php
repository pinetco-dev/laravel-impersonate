<?php

namespace Pinetcodev\LaravelImpersonate\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Pinetcodev\LaravelImpersonate\Models\Impersonate;

class ImpersonationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected User $impersonateUser)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $impersonate = $this->createImpersonateLog($notifiable);

        return (new MailMessage)
            ->subject(__('Impersonation || :app', ['app' => config('app.name')]))
            ->markdown('impersonate::mails.impersonation', [
                'creator' => $notifiable,
                'impersonateUser' => $this->impersonateUser,
                'link' => URL::temporarySignedRoute('impersonate.log-in',
                    now()->addMinutes(config('impersonate.lifetime')),
                    [$impersonate->getRouteKey()]),
                'impersonate' => $impersonate,
                'impersonateLifetime' => config('impersonate.lifetime'),
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    private function createImpersonateLog(User $auth)
    {
        return Impersonate::create([
            'impersonated_id' => $this->impersonateUser->id,
            'user_id' => $auth->id,
        ]);
    }
}
