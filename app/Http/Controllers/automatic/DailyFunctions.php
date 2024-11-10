<?php

namespace App\Http\Controllers\automatic;

use App\Http\Controllers\Controller;
use App\Models\CronJob;
use App\Models\InsuranceModel;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\UpdateDeliveryStatusSMS;
use Carbon\Carbon;
use Ghasedak\GhasedakApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Shetabit\Visitor\Models\Visit;
use App\Models\SiteVisit;

class DailyFunctions extends Controller
{

    
            public function index()
    {
        $visits=SiteVisit::all();
        $yesterday=Carbon::yesterday();

        InsuranceModel::create([
            'date'=>$yesterday,
            'total_visits' => count($visits),
            'created_at' => $yesterday,
        ]);

        foreach ($visits as $visit) {
            $visit->delete();
        }
        //باید بازدید های یک ماه قبل را پاک کرد
    }

    public function ExpireOrder()
    {
        $setting = Setting::first();
        $type = 1;
        $now = Carbon::now();
        $orders = Order::where('payment_type', 3)->where('delivery_status', 1)->latest()->get();
        $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
        foreach ($orders as $order) {
            $created_at = Carbon::parse($order->created_at);
            $difference = $created_at->diffInHours($now);
            if ($difference > 1) {
                try {
                    $order->update([
                        'delivery_status' => 3
                    ]);
                    try {
                        //send sms to user
                        $user = User::where('id', $order->user_id)->first();
                        $name = $user->first_name . ' ' . $user->last_name;
                        $receptor = $user->cellphone;
                        $order_number = $setting->productCode . '-' . $order->order_number;
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
                    }catch (\Exception $exception){
                        Log::error('Expire SMS Order Error:'.$exception->getMessage());
                    }

                }catch (\Exception $exception){
                    Log::error('Expire Order Error:'.$exception->getMessage());
                }
            }
        }

    }
    public function check_order()
    {
        $orders = Order::where('payment_type', 3)
            ->where('created_at','<', Carbon::now()->subDay(2))
            ->where('delivery_status',1)
            ->get();
        foreach ($orders as $order){
            $order->update([
                'delivery_status' => 7,
                'payment_status' => 3
            ]);
            $user = User::where('id' , $order->user_id)->first();
            $user->notify(new UpdateDeliveryStatusSMS($order->id, 7,3));

        }
    }
}
