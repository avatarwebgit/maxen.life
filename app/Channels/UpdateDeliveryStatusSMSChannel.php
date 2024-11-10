<?php

namespace App\Channels;

use App\Models\Order;
use App\Models\Setting;
use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;
use App\Models\OrderStatus;

class UpdateDeliveryStatusSMSChannel
{
    public function send($notifiable, Notification $notification)
    {
        $setting = Setting::first();
        $type = 1;
        $receptor = $notifiable->cellphone;
        $name = $notifiable->first_name . ' ' . $notifiable->last_name;
        // $name = str_replace(' ', '.', $name);
        $order = Order::where('id', $notification->order_id)->first();
        $order_number = $setting->productCode . '-' . $order->order_number;
        $deliveryMethod_id = $notification->deliveryMethod_id;
        $delivery_status = $notification->delivery_status;
        $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
        $payment_amount = $order->payment_amount;
        if ($delivery_status == 2) {
            //ارسال پیام به جهت تغییر وضعیت پیش فاکتور به "پرداخت شده"
            if ($deliveryMethod_id == 3) {
                $payment_amount = number_format($order->total_amount);
                $template = "pishfactorConfirm";
                $param1 = $name;
                $param2 = $order_number;
                $param3 = $payment_amount;
                $api->Verify(
                    $receptor,  // receptor
                    $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
                    $template,       // parameters (supporting up to 10 parameters)
                    $param1,
                    $param2,
                    $param3,
                );
            } else {
                $this->changeOrderStatus($api, $notification, $receptor, $type, $name, $order_number);
            }
        }
        //ارسال پیامک به جهت لغو شدن سفارش
        if ($delivery_status == 3 or $delivery_status == 7) {
            //ارسال پیام به جهت لغو شدن پیش فاکتور
            if ($deliveryMethod_id == 3) {
                $template = "cancelpishfactor";
                $param1 = $name;
                $param2 = $order_number;
                $api->Verify(
                    $receptor,  // receptor
                    $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
                    $template,       // parameters (supporting up to 10 parameters)
                    $param1,
                    $param2,
                );
            }

            //ارسال پیام به جهت لغو شدن سفارش ها(غیر از پیش فاکتور)
            if ($deliveryMethod_id != 3) {
                $template = "cancelorder";
                $param1 = $name;
                $param2 = $order_number;
                $api->Verify(
                    $receptor,  // receptor
                    $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
                    $template,       // parameters (supporting up to 10 parameters)
                    $param1,
                    $param2,
                );
            }
        }
        //ارسال sms برای وضعیت "ارسال شد"
        if ($delivery_status == 4) {
            if($order->delivery_method == 7 or $order->delivery_method == 6){
                $template = "sendorder";
                $param1 = $name;
                $param2 = $order_number;
                $api->Verify(
                    $receptor,  // receptor
                    $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
                    $template,       // parameters (supporting up to 10 parameters)
                    $param1,
                    $param2,
                );
            }else{
                $template = "sendorderTehran";
                $param1 = $name;
                $param2 = $order_number;
                $api->Verify(
                    $receptor,  // receptor
                    $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
                    $template,       // parameters (supporting up to 10 parameters)
                    $param1,
                    $param2,
                );
            }
        }
        //ارسال sms برای دیپر وضعیت ها
        if ($delivery_status != 2 and $delivery_status != 3 and $delivery_status != 4) {
            $this->changeOrderStatus($api, $notification, $receptor, $type, $name, $order_number);
        }
    }

    protected function changeOrderStatus($api, $notification, $receptor, $type, $name, $order_number)
    {
        $template = "changeOrderStatus";
        $param1 = $name;
        $param2 = $order_number;
        $param3 = OrderStatus::where('id', $notification->delivery_status)->first()->title;
        // $param3 = str_replace(' ', '.', $param3);
        $api->Verify(
            $receptor,  // receptor
            $type,              // 1 for text message and 2 for voice message "my-template",  // name of the template which you've created in you account
            $template,       // parameters (supporting up to 10 parameters)
            $param1,
            $param2,
            $param3,
        );
    }
}
