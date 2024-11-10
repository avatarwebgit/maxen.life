<?php

namespace App\Channels;

use App\Models\Setting;
use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

class UserUpdateProfileNotificationChannel
{
    public function send($notifiable, Notification $notification)
    {
        $admins = Setting::first()->delivery_order_numbers;
        $admins_cellphone = explode(',', $admins);
        $change_address=$notification->change_address;
        if ($change_address==0){
            $template = "UserUpdateProfile";
        }else{
            $template = "UserAddressUpdate";
        }

        $type = 1;

        $user_name = $notifiable->first_name.' '.$notifiable->last_name;
        $param = preg_replace('/\s+/', '', $user_name);

        $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
        foreach ($admins_cellphone as $receptor){
            $api->Verify(
                $receptor,  // receptor
                $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
                $template,       // parameters (supporting up to 10 parameters)
                $param,
            );
        }



    }
}
