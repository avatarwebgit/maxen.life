<?php

namespace App\Channels;

use App\Models\Setting;
use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

class RoleRequestChannel
{
    public function send($notifiable, Notification $notification)
    {
        $admins = Setting::first()->delivery_order_numbers;
        $admins_cellphone = explode(',', $admins);
        $type = 1;
        $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
        foreach ($admins_cellphone as $receptor) {
            $template = "changeRoleRequest";
            $param1='گرامی';
            $api->Verify($receptor, $type, $template, $param1);
        }
    }
}
