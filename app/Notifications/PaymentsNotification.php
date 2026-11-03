<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentsNotification extends Notification
{
    use Queueable;

    public $team;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($team)
    {
        $this->team = $team;
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
        return (new MailMessage)
            ->subject(__('sendmail.payment-confirmed.subject', ['team' => $this->team]))
            ->line(__('sendmail.payment-confirmed.line1'))
            ->action(__('sendmail.payment-confirmed.action'), url('/login'))
            ->line(__('sendmail.payment-confirmed.line2'));
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
}
