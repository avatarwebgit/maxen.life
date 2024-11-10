<?php

namespace App\Channels;

use App\Models\Setting;

use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

class userChargeWalletChannel
{
    public function send($notifiable, Notification $notification)
    {
              
        $receptor = $notifiable->cellphone;
        $user=$notifiable->first_name.' '.$notifiable->last_name;
       $param1=$user;
   
        $type = 1;
        $template = "userChargeWallet";
 
       
        $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
        $api->Verify(
            $receptor,  // receptor
            $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
            $template,       // parameters (supporting up to 10 parameters)
            $param1
 
        );
        
        
               $admins = Setting::first()->delivery_order_numbers;
        $admins_cellphone = explode(',', $admins);
        $template = "AdminWallet";
        $param1 =$notifiable->first_name .' '.$notifiable->last_name ;
        foreach ($admins_cellphone as $admin) {
            try {
                $receptor = $admin;
                $api->Verify(
                    $receptor,  // receptor
                    $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
                    $template,       // parameters (supporting up to 10 parameters)
                    $param1,
                );
            } catch (\Exception $exception) {
                Log::error('send new ticket sms for admin error:' . $exception->getMessage());
            }

        }
    }
}
