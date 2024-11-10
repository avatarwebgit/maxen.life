<?php

namespace App\Channels;

use App\Models\Setting;
use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class commentCreatedChannel
{
    public function send($notifiable, Notification $notification)
    {
        $type = 1;
        $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
        //send sms for admins
        // try {
        //     $receptor = $notifiable->cellphone;
        //     $template = "newCommentUser";
        //     $user = $notifiable->first_name . ' ' . $notifiable->last_name;
        //     // $user = str_replace(' ', '', $user);
        //     $param = $user;
        //     $api->Verify(
        //         $receptor,  // receptor
        //         $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
        //         $template,       // parameters (supporting up to 10 parameters)
        //         $param,
        //     );
        // }catch (\Exception $exception){
        //     Log::error($exception->getMessage());
        // }

        //send sms for users
        try {
            $admins = Setting::first()->delivery_order_numbers;
            $admins_cellphone = explode(',', $admins);
            foreach ($admins_cellphone as $receptor) {

                $template = "newCommentAdmin";
                $param = 'کامنت';

                $api->Verify(
                    $receptor,  // receptor
                    $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
                    $template,       // parameters (supporting up to 10 parameters)
                    $param,
                );
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }


    }
}
