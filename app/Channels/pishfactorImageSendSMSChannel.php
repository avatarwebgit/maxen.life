<?php

namespace App\Channels;

use App\Models\Order;
use App\Models\Setting;
use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

class pishfactorImageSendSMSChannel
{
    public function send($notifiable, Notification $notification)
    {
        $setting = Setting::first();
        $type = 1;
        $order_id = $notification->order_id;
        $order = Order::where('id', $order_id)->first();
        $receptor = $notifiable->cellphone;
        $param1 = $setting->productCode . '-' . $order->order_number;
        $param2 = number_format($order->paying_amount);
        $template = "pishfactorImageSend";
        $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
        $api->Verify($receptor, $type, $template, $param1, $param2,);
    }
}
