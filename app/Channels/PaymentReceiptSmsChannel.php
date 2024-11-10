<?php

namespace App\Channels;

use App\Models\Order;
use App\Models\Setting;
use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

class PaymentReceiptSmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        $admins = Setting::first()->delivery_order_numbers;
        $admins_cellphone = explode(',', $admins);
        $setting = Setting::first();
        $receptor = $notifiable->cellphone;
        $name = $notifiable->first_name . ' ' . $notifiable->last_name;
        // $name = str_replace(' ', '.', $name);
        $type = 1;
        $order_number = $setting->productCode . '-' . $notification->order_number;

        $order_id = $notification->order_id;
        $order = Order::where('id', $order_id)->first();
        $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
        if($order->payment_type == 8){
            $template = "WalletPayment";
            $param1 = $name;
            $param2 = $order_number;
            $param3 = number_format($order->total_amount);
            $api->Verify($receptor, $type, $template,$param1, $param2,$param3);
            foreach ($admins_cellphone as $receptor) {
                $template = "AdminOrderWallet";
                $param1=$order_number;
                $param2 = number_format($order->wallet);
                $api->Verify($receptor, $type, $template, $param1, $param2);
            }
        }
        //ارسال اس ام اس پیش فاکتور
        if ($order->payment_type == 3){
            if (session()->exists('smspish')){
                session()->forget('invoice');
                session()->forget('smspish');
                //ارسال پیام به کاربر
                $template = "PardakhtPishfactor";
                $param1=$name;
                $param2=$order_number;
                $param3 = number_format($notification->amount);
                $api->Verify($receptor, $type, $template, $param1, $param2, $param3);
                //ارسال پیام به ادمین ها
                foreach ($admins_cellphone as $receptor) {
                    $template = "PardakhtPishfactorAdmin";
                    $param1=$order_number;
                    $param2 = number_format($notification->amount);
                    $api->Verify($receptor, $type, $template, $param1, $param2);
                }
            }else{
                session()->forget('invoice');
                session()->forget('smspish');
                //ارسال پیام به کاربر
                $template = "userPishfactor";
                $param1=$name;
                $param2=$order_number;
                $param3 = number_format($notification->amount);
                $api->Verify($receptor, $type, $template, $param1, $param2, $param3);
                //ارسال پیام به ادمین ها
                foreach ($admins_cellphone as $receptor) {
                    $template = "adminPishfactor";
                    $param1=$order_number;
                    $param2 = number_format($notification->amount);
                    $api->Verify($receptor, $type, $template, $param1, $param2, $param3);
                }
            }

        }
        //ارسال اس ام اس اگر خرید از درگاه های بانک باشد
        if ($order->payment_type == 4  or $order->payment_type==6){
            $template = "paymentReceipt";
            $param1=$name;
            $param2=$order_number;
            $param3 = number_format($notification->amount);
            $api->Verify($receptor, $type, $template, $param1, $param2, $param3);
            //ارسال پیام به ادمین ها
            foreach ($admins_cellphone as $receptor) {
                $template = "AdminOrderReceipt";
                $param1=$order_number;
                $param2 = number_format($notification->amount);
                $api->Verify($receptor, $type, $template, $param1, $param2, $param3);
            }
        }
        //اگر خرید به صورت بیعانه باشد
        if ($order->payment_type == 7){
            //ارسال پیام به کاربر
            $template = "userbeyane";
            $param1=$name;
            $param2=$order_number;
            $param3 = number_format($notification->amount);
            $param4 = number_format($order->deposit);
            $api->Verify($receptor, $type, $template, $param1, $param2, $param3, $param4);
            //ارسال پیام به ادمین ها
            foreach ($admins_cellphone as $receptor) {
                $template = "AdminBeyane";
                $param1=$order_number;
                $param2 = number_format($notification->amount);
                $param3 = number_format($order->deposit);
                $api->Verify($receptor, $type, $template, $param1, $param2, $param3);
            }
        }
    }
}
