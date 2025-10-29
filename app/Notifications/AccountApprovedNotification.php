<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountApprovedNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your LabCore Account Has Been Approved!')
            ->markdown('emails.account-approved', [
                'userName' => $notifiable->name,
                'loginUrl' => route('show.login'),
            ]);
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}