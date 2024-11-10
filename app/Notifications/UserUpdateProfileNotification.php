<?php

namespace App\Notifications;

use App\Channels\ticketReplaySmsChannel;
use App\Channels\UserUpdateProfileNotificationChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUpdateProfileNotification extends Notification
{
    use Queueable;

    public $change_address;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($change_address)
    {
        $this->change_address = $change_address;
    }

    public function via($notifiable)
    {
        return [UserUpdateProfileNotificationChannel::class];
    }


    public function toSms()
    {
        return ['change_address'];
    }
}
