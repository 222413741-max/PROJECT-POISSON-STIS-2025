<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
        return (new MailMessage)
            ->subject(__('sendmail.verif-email.subject'))
            ->line(__('sendmail.verif-email.line1'))
            ->action(__('sendmail.verif-email.action'), $url)
            ->line(__('sendmail.verif-email.line2'))
            ->line(__('sendmail.verif-email.line3'));
    });
    }
}
