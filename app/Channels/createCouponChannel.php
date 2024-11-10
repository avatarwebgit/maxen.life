<?php

namespace App\Channels;

use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

class createCouponChannel
{
    public function send($notifiable, Notification $notification)
    {
        $receptor = $notifiable->cellphone;
        $param1 = $notifiable->first_name .' '.$notifiable->last_name;
//        $param1=str_replace(' ',',',$user);
        $type = 1;
        $template = "createCoupon";
        $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
        $api->Verify(
            $receptor,  // receptor
            $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
            $template,       // parameters (supporting up to 10 parameters)
            $param1
        );
    }
}
