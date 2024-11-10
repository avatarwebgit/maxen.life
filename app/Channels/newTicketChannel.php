<?php

namespace App\Channels;

use App\Models\Setting;
use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class newTicketChannel
{
    public function send($notifiable, Notification $notification)
    {
        $receptor = $notifiable->cellphone;
  
        $user = $notifiable->first_name . ' ' . $notifiable->last_name;
        $ticket_number = $notification->ticket;
        $type = 1;
        $template = "newTicketForUser";
        $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
        //send sms for user
        try {
            $param1 = $user;
            // $param1 = str_replace(' ', '', $param1);
            $param2 = $ticket_number;
            $api->Verify(
                $receptor,  // receptor
                $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
                $template,       // parameters (supporting up to 10 parameters)
                $param1,
                $param2,
            );
        } catch (\Exception $exception) {
            Log::error('send new ticket sms for user error:' . $exception->getMessage());
        }


        //send sms for admin
        $admins = Setting::first()->delivery_order_numbers;
        $admins_cellphone = explode(',', $admins);
        $template = "newTicketForAdmin";
        $param1 = $ticket_number;
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
