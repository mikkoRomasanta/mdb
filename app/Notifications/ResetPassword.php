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
    public function __construct($data)
    {
        $this->emp = $data['emp'];
        $this->pass = $data['pass'];
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('[MasterDB]Account Details')
                    // ->line('Your password has been reset! See below details:')
                    ->line('Below are the details of your login account to MasterDB.')
                    ->line('Login ID : '.$this->emp->emp_id)
                    ->line('Password : '.$this->pass)
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
