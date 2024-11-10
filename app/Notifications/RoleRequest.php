<?php

namespace App\Notifications;

use App\Channels\RoleRequestChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RoleRequest extends Notification
{
    use Queueable;
    public function __construct()
    {

    }

    public function via($notifiable)
    {
        return [RoleRequestChannel::class];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toSms()
    {

    }
}
