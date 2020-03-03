<?php

namespace App\Notifications;

use App\Models\Employees;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($emp)
    {
        $this->emp = $emp;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Your password has been reset! Your temporary password is:')
                    ->line('<h4>'.$emp->tempPass.'</h4>')
                    ->action('Change Password', url('/change-password'))
                    ->line('Please change your password using the link above.');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
