<?php

namespace App\Http\Controllers\Admin;

use App\Alopeyk\Alopeyk;
use App\Models\PaymentMethods;
use App\Models\OrderBijack;
use App\Exports\OrdersExport;
use App\Models\AlopeykConfig;
use App\Models\CourierInfo;
use App\Models\LimitConfig;
use App\Models\Order;
use App\Models\OrderExcelCreator;
use App\Models\OrderStatus;
use App\Models\ProductOption;
use App\Models\Roles;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\SendSmsTrackingCode;
use App\Notifications\UpdateDeliveryStatusSMS;
use App\Notifications\UpdateDeliveryStatusSmsTehran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use App\Models\Transaction;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{

    public function index()
    {
        $total_sale = 0;
        $order_status = OrderStatus::all();
        foreach ($order_status as $item) {
            $item['count'] = Order::where('delivery_status', $item->id)->count();
        }
        $all_orders=Order::count();
        $orders = Order::where('status', '!=', 0)->latest()->paginate(100);
        $failed_orders=Order::where('status', 0)->get();
        $show_per_page = 1;
        $payment_methods = 0;
        $total_orders = Order::where('status', '!=', 0)->get();
        $setting = Setting::first();
        foreach ($total_orders as $order) {
            $total_sale = $total_sale + $order->total_amount;
        }
        return view('admin.orders.index', compact('orders',
            'total_sale','payment_methods',
            'show_per_page', 'order_status', 'setting','all_orders','failed_orders'));
    }

public function pagination($show_per_page,$payment_methods)
    {
        $total_sale = 0;
        $order_status = OrderStatus::all();
        foreach ($order_status as $item) {
            $item['count'] = Order::where('delivery_status', $item->id)->count();
        }
        $all_orders=Order::count();
        if ($show_per_page === 'all') {
            $orders_count = Order::where('status', '!=', 0)->latest()->count();
            if ($payment_methods != 0){


                $orders = Order::where('payment_type',$payment_methods)->where('status', '!=', 0)->latest()->paginate($orders_count);

            }else{
                $orders = Order::where('status', '!=', 0)->latest()->paginate($orders_count);
            }


        } elseif ($show_per_page == 'default') {
            if ($payment_methods != 0){


                $orders = Order::where('payment_type',$payment_methods)->where('status', '!=', 0)->latest()->paginate(100);

            }else{
                $orders = Order::where('status', '!=', 0)->latest()->paginate(100);
            }

            $show_per_page = null;
        } else {
            if ($payment_methods != 0){


                $orders = Order::where('payment_type',$payment_methods)->where('status', '!=', 0)->latest()->paginate(100);

            }else{
                $orders = Order::where('status', '!=', 0)->latest()->paginate(100);
            }

        }

        $total_orders = Order::where('status', '!=', 0)->get();
        $failed_orders=Order::where('status', 0)->get();
        $setting = Setting::first();
        foreach ($total_orders as $order) {
            $total_sale = $total_sale + $order->total_amount;
        }

        return view('admin.orders.index', compact('orders',
            'total_sale',
            'show_per_page', 'order_status','payment_methods','all_orders','setting','failed_orders'));
    }

    public function show(Order $order)
    {
        $alopeykConfig = AlopeykConfig::first();
        $order_status = OrderStatus::all();
        $setting = Setting::first();
        return view('admin.orders.show', compact('order', 'alopeykConfig', 'order_status', 'setting'));
    }

    public function update_delivery_status(Request $request)
    {
        $request->validate([
            'delivery_status' => 'required',
            'order_id' => 'required',
        ]);
      
        $order = Order::where('id', $request->order_id)->first();
        $order->update([
            'delivery_status' => $request->delivery_status,
        ]);
        $user = User::where('id', $order->user_id)->first();
        $active_sms = $order->getRawOriginal('active_sms');
      
        if ($active_sms == 1) {
            try {
                
                
                     
                    $user->notify(new UpdateDeliveryStatusSMS($order->id, $order->delivery_status,$request->deliveryMethod_id));
               
                
               return response()->json(['ok']);
            }catch (\Exception $exception){
                return response()->json(['smsError','تغییر وضعیت با موفقیت انجام شد اما اس ام اس ارسال نشد']);
            }
        }else{
            return response()->json(['ok']);
        }
    }

    public function get_orders(Request $request)
    {
        $verta = verta();
        $row_per_page = 100;
        $page = $request->page;
        $startPage = ($page - 1) * $row_per_page;
        $order_status = OrderStatus::all();
        if (!$request->today == null) {
            $orders = Order::skip($startPage)->take($row_per_page)->where('created_at', '>', Carbon::today())->where('status', '!=', 0)->latest()->get()->load('user')->load('DeliveryMethod');
            $total_rows = Order::where('created_at', '>', Carbon::today())->where('status', '!=', 0)->latest()->get()->count();
            $total_orders = Order::where('created_at', '>', Carbon::today())->where('status', '!=', 0)->latest()->get();
            $total_sale = 0;
            foreach ($total_orders as $order) {
                $total_sale = $total_sale + $order->total_amount;
            }
            $total_sale_message = 'مقدار فروش امروز برابر است با ' . number_format($total_sale) . ' تومان';
        }
        if (!$request->thisWeek == null) {
            $start = convertShamsiToGregorianDate($verta->startWeek());
            $end = convertShamsiToGregorianDate($verta->endWeek());
            $orders = Order::skip($startPage)->take($row_per_page)->where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', '!=', 0)->latest()->get()->load('user')->load('DeliveryMethod');
            $total_rows = Order::where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', '!=', 0)->latest()->get()->count();
            $total_orders = Order::where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', '!=', 0)->latest()->get();
            $total_sale = 0;
            foreach ($total_orders as $order) {
                $total_sale = $total_sale + $order->total_amount;
            }
            $total_sale_message = 'مقدار فروش این هفته برابر است با ' . number_format($total_sale) . ' تومان';
        }
        if (!$request->thisMonth == null) {
            $start = convertShamsiToGregorianDate($verta->startMonth());
            $end = convertShamsiToGregorianDate($verta->endMonth());
            $orders = Order::skip($startPage)->take($row_per_page)->where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', '!=', 0)->latest()->get()->load('user')->load('DeliveryMethod');
            $total_rows = Order::where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', 1)->where('status', '!=', 0)->latest()->get()->count();
            $total_orders = Order::where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', '!=', 0)->latest()->get();
            $total_sale = 0;
            foreach ($total_orders as $order) {
                $total_sale = $total_sale + $order->total_amount;
            }
            $total_sale_message = 'مقدار فروش ' . verta($start)->format('%B') . ' ماه برابر است با ' . number_format($total_sale) . ' تومان';
        }
        if (!$request->lastMonth == null) {
            $start = convertShamsiToGregorianDate($verta->startMonth());
            $end = convertShamsiToGregorianDate($verta->endMonth());
            $start = (Carbon::parse($start)->addMonth(-1));
            $end = Carbon::parse($end)->addMonth(-1);
            $orders = Order::skip($startPage)->take($row_per_page)->where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', '!=', 0)->latest()->get()->load('user')->load('DeliveryMethod');
            $total_rows = Order::where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', '!=', 0)->latest()->get()->count();
            $total_orders = Order::where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', '!=', 0)->latest()->get();
            $total_sale = 0;
            foreach ($total_orders as $order) {
                $total_sale = $total_sale + $order->total_amount;
            }
            $total_sale_message = 'مقدار فروش ' . verta($start)->format('%B') . ' ماه برابر است با ' . number_format($total_sale) . ' تومان';
        }
        if ($request->today == null
            && $request->thisWeek == null
            && $request->lastMonth == null
            && $request->thisMonth == null && $request->today == null) {
            $request->validate([
                'order_start' => 'required',
                'order_end' => 'required',
            ]);
            $start = convertShamsiToGregorianDate($request->order_start);
            $end = convertShamsiToGregorianDate($request->order_end);
            $orders = Order::skip($startPage)->take($row_per_page)->where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', '!=', 0)->latest()->get()->load('user')->load('DeliveryMethod');
            $total_rows = Order::where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', '!=', 0)->latest()->get()->count();
            $total_orders = Order::where('created_at', '>', $start)->where('created_at', '<', $end)->where('status', '!=', 0)->latest()->get();
            $total_sale = 0;
            foreach ($total_orders as $order) {
                $total_sale = $total_sale + $order->total_amount;
            }
            $total_sale_message = 'مقدار فروش از تاریخ ' . verta($start)->format('%d %B,Y') . ' تا ' . verta($end)->format('%d %B,Y') . ' برابر است با ' . number_format($total_sale) . ' تومان';
            //
        }
        $html = '';
        foreach ($orders as $order) {
            if ($order->user->first_name == null) {
                $userName = $order->user->cellphone;
            } else {
                $userName = $order->user->first_name . ' '. $order->user->last_name;
            }
            if ($order->getRawOriginal('delivery_status') == 0) {
                $dar_hale_barasi = 'selected';
                $taeed_shode = '';
                $ersale_kala = '';
                $laghvshode = '';
            }
            if ($order->getRawOriginal('delivery_status') == 1) {
                $taeed_shode = 'selected';
                $dar_hale_barasi = '';
                $ersale_kala = '';
                $laghvshode = '';
            }
            if ($order->getRawOriginal('delivery_status') == 2) {
                $ersale_kala = 'selected';
                $taeed_shode = '';
                $dar_hale_barasi = '';
                $laghvshode = '';
            }
            if ($order->getRawOriginal('delivery_status') == 3) {
                $laghvshode = 'selected';
                $taeed_shode = '';
                $ersale_kala = '';
                $dar_hale_barasi = '';
            }
            if ($order->getRawOriginal('delivery_method') == 3 and $order->getRawOriginal('payment_status') == 1) {
                $alopeykBTN = '<a target="_blank" class="btn btn-sm btn-dark"
                                       href="' . route('admin.orders.print', ['order' => $order->id]) . '">
                                        درخواست الوپیک
                                    </a>';
            } else {
                $alopeykBTN = '-';
            }
            $status_for_order = '';
            foreach ($order_status as $item) {
                if ($order->delivery_status == $item->id) {
                    $selected = 'selected=selected';
                } else {
                    $selected = '';
                }
                $status_for_order .= ' <option ' . $selected . ' value="' . $item->id . '">
                                        ' . $item->title . '
                                    </option>';
            }
            if ($order->getRawOriginal('active_sms') == 1) {
                $active_sms_btn = 'btn-success text-white';
            } else {
                $active_sms_btn = 'btn-dark';
            }
            $html .= '<tr>
                            <th>
                                -
                            </th>
                            <th>
                                <a href="' . route('admin.user.edit', ['user' => $order->user->id]) . '">
                                ' . $userName . '
                                </a>
                            </th>
                            <th>
                                ' . number_format($order->wallet) . '
                            </th>
                            <th>
                                ' . number_format($order->paying_amount) . '
                            </th>
                            <th>
                                ' . number_format($order->total_amount) . '
                            </th>
                            <th>
                                ' . $order->payment_type . '
                            </th>
                            <th>
                                ' . $order->payment_status . '
                            </th>
                            <th>
                                ' . verta($order->created_at)->format('%d %B ,Y') . '
                            </th>
                            <th>
                                <a title="ارسال پیامک تغییر وضعیت" id="active_sms_icon_' . $order->id . '"
                                   onclick="active_sms(' . $order->id . ')"
                                   class="btn btn-sm ' . $active_sms_btn . '">
                                   ' . $order->active_sms . '
                                </a>
                            </th>
                            <th>
                                <select onchange="changeOrderStatus(this,' . $order->id . ')" class="form-control form-control-sm">
                               ' . $status_for_order . '
                                </select>
                            </th>
                            <th>
                                ' . $order->order_number . '
                            </th>
                            <th>
                                ' . $order->DeliveryMethod->name . '
                                ' . $alopeykBTN . '
                            </th>
                            <th>
                                <a title="جزئیات" class="btn btn-sm btn-success mb-1"
                                   href="' . route('admin.orders.show', ['order' => $order->id]) . '">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a title="پرینت" target="_blank" class="btn btn-sm btn-dark mb-1"
                                   href="' . route('admin.orders.print', ['order' => $order->id]) . '">
                                    <i class="fa fa-print"></i>
                                </a>
                                <a title="پرینت پیک" target="_blank" class="btn btn-sm btn-warning mb-1"
                                   href="' . route('admin.orders.print_peyk', ['order' => $order->id]) . '">
                                    <i class="fa fa-motorcycle"></i>
                                </a>
                                <button title="حذف" type="button" onclick="RemoveModal(' . $order->id . ')"
                                        class="btn btn-sm btn-danger mb-1"
                                        href=""><i class="fa fa-trash"></i></button>
                            </th>
                        </tr>';
        }
        return response()->json(['ok', $html, $total_rows, $row_per_page, $total_sale_message]);
    }
    
    public function searchKeyWord(Request $request)
    {
        $row_per_page = 100;
        $keyWord = $request->keyWord;
        //search by order number
        $order_ids = [];
        $orders = Order::where('order_number', 'LIKE', '%' . $keyWord . '%')->get();
        foreach ($orders as $order) {
            $order_ids[] = $order->id;
        }
        //search by user_name
        $user_ids = [];
        $users = User::where('first_name', 'LIKE', '%' . $keyWord . '%')
            ->orWhere('last_name', 'LIKE', '%' . $keyWord . '%')
            ->orWhere('cellphone', 'LIKE', '%' . $keyWord . '%')
            ->get();
        foreach ($users as $user) {
            $user_ids[] = $user->id;
        }
        $orders=Order::whereIn('user_id',$user_ids)->get();
        foreach ($orders as $order) {
            $order_ids[] = $order->id;
        }
        $order_ids=array_unique($order_ids);
        $order_status = OrderStatus::all();
        $orders=Order::whereIn('id',$order_ids)->get();
        $total_rows=count($orders);
        $html = '';
        $total_sale=0;
        foreach ($orders as $order) {
            $total_sale = $total_sale + $order->total_amount;
            if ($order->user->first_name == null) {
                $userName = $order->user->cellphone;
            } else {
                $userName = $order->user->first_name . ' ' . $order->user->last_name;
            }
            if ($order->getRawOriginal('delivery_status') == 0) {
                $dar_hale_barasi = 'selected';
                $taeed_shode = '';
                $ersale_kala = '';
                $laghvshode = '';
            }
            if ($order->getRawOriginal('delivery_status') == 1) {
                $taeed_shode = 'selected';
                $dar_hale_barasi = '';
                $ersale_kala = '';
                $laghvshode = '';
            }
            if ($order->getRawOriginal('delivery_status') == 2) {
                $ersale_kala = 'selected';
                $taeed_shode = '';
                $dar_hale_barasi = '';
                $laghvshode = '';
            }
            if ($order->getRawOriginal('delivery_status') == 3) {
                $laghvshode = 'selected';
                $taeed_shode = '';
                $ersale_kala = '';
                $dar_hale_barasi = '';
            }
            if ($order->getRawOriginal('delivery_method') == 3 and $order->getRawOriginal('payment_status') == 1) {
                $alopeykBTN = '<a target="_blank" class="btn btn-sm btn-dark"
                                       href="' . route('admin.orders.print', ['order' => $order->id]) . '">
                                        درخواست الوپیک
                                    </a>';
            } else {
                $alopeykBTN = '-';
            }
            $status_for_order = '';
            foreach ($order_status as $item) {
                if ($order->delivery_status == $item->id) {
                    $selected = 'selected=selected';
                } else {
                    $selected = '';
                }
                $status_for_order .= ' <option ' . $selected . ' value="' . $item->id . '">
                                        ' . $item->title . '
                                    </option>';
            }
            if ($order->getRawOriginal('active_sms') == 1) {
                $active_sms_btn = 'btn-success text-white';
            } else {
                $active_sms_btn = 'btn-dark';
            }
            $html .= '<tr>
                            <th>
                                -
                            </th>
                            <th>
                                <a href="' . route('admin.user.edit', ['user' => $order->user->id]) . '">
                                ' . $userName . '
                                </a>
                            </th>
                            <th>
                                ' . number_format($order->wallet) . '
                            </th>
                            <th>
                                ' . number_format($order->paying_amount) . '
                            </th>
                            <th>
                                ' . number_format($order->total_amount) . '
                            </th>
                            <th>
                                ' . $order->payment_type . '
                            </th>
                            <th>
                                ' . $order->payment_status . '
                            </th>
                            <th>
                                ' . verta($order->created_at)->format('%d %B ,Y') . '
                            </th>
                            <th>
                                <a title="ارسال پیامک تغییر وضعیت" id="active_sms_icon_' . $order->id . '"
                                   onclick="active_sms(' . $order->id . ')"
                                   class="btn btn-sm ' . $active_sms_btn . '">
                                   ' . $order->active_sms . '
                                </a>
                            </th>
                            <th>
                                <select onchange="changeOrderStatus(this,' . $order->id . ')" class="form-control form-control-sm">
                               ' . $status_for_order . '
                                </select>
                            </th>
                            <th>
                                ' . $order->order_number . '
                            </th>
                            <th>
                                ' . $order->DeliveryMethod->name . '
                                ' . $alopeykBTN . '
                            </th>
                            <th>
                                <a title="جزئیات" class="btn btn-sm btn-success mb-1"
                                   href="' . route('admin.orders.show', ['order' => $order->id]) . '">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a title="پرینت" target="_blank" class="btn btn-sm btn-dark mb-1"
                                   href="' . route('admin.orders.print', ['order' => $order->id]) . '">
                                    <i class="fa fa-print"></i>
                                </a>
                                <a title="پرینت پیک" target="_blank" class="btn btn-sm btn-warning mb-1"
                                   href="' . route('admin.orders.print_peyk', ['order' => $order->id]) . '">
                                    <i class="fa fa-motorcycle"></i>
                                </a>
                                <button title="حذف" type="button" onclick="RemoveModal(' . $order->id . ')"
                                        class="btn btn-sm btn-danger mb-1"
                                        href=""><i class="fa fa-trash"></i></button>
                            </th>
                        </tr>';
        }
        $total_sale_message='';
        return response()->json(['ok', $html, $total_rows, $row_per_page, $total_sale_message]);
    }
    
    public function order_bijack(OrderBijack $bijack,Request $request)
    {

        $request->validate([
            'name' => 'required',
            'barname' => 'required',
            'date' => 'required',
            'phone_origin' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'phone_destination' => 'required',
        ]);


        try {
            $bijack->update([
                'name' => $request->name,
                'barname' => $request->barname,
                'date' => convertShamsiToGregorianDate($request->date),
                'phone_origin' => $request->phone_origin,
                'origin' => $request->origin,
                'Destination' => $request->destination,
                'phone_Destination' => $request->phone_destination,
            ]);


        }catch (\Exception $e){
            dd($e->getMessage());
        }
        alert()->success('مشخصات bijack  با موفقیت اپدیت شد.');
        return redirect()->back();

    }
    
      public function bijack_show(Order $order)
    {
        $order_bijack = $order->bijack;

        if ($order_bijack == null){
            $order_bijack =  OrderBijack::create([
                'name' => null,
                'barname' => null,
                'order_id' => $order->id,
                'date' => null,
                'phone_origin' => null,
                'origin' => null,
                'Destination' => null,
                'phone_Destination' => null,
            ]);
        }

        return view('admin.orders.bijack',['order_bijack' => $order_bijack]);
    }

      public function get_with_status(Request $request)
    {
        $row_per_page = 100;
        $page = $request->page;
        $startPage = ($page - 1) * $row_per_page;
        $all_order_status = OrderStatus::all();
        if ($request->status!=null){
            $orders=Order::where('delivery_status',$request->status)->latest()->get();
        }else{
            $orders=Order::where('status',$request->type)->latest()->get();
        }

        $total_rows=count($orders);
        $html = '';
        $total_sale = 0;
        foreach ($orders as $order) {
            $total_sale = $total_sale + $order->total_amount;
        }
        if ($request->status!=null){
            $order_status=OrderStatus::find($request->status);
            $total_sale_message='مبلغ سفارشات '.$order_status->title.' برابر است با : '.$total_sale;
        }else{
            $total_sale_message='مبلغ سفارشات ناموفق برابر است با :'.$total_sale;
        }
        foreach ($orders as $order) {
            if ($order->user->first_name == null) {
                $userName = $order->user->cellphone;
            } else {
                $userName = $order->user->first_name.' '.$order->user->last_name;
            }
            if ($order->getRawOriginal('delivery_status') == 0) {
                $dar_hale_barasi = 'selected';
                $taeed_shode = '';
                $ersale_kala = '';
                $laghvshode = '';
            }
            if ($order->getRawOriginal('delivery_status') == 1) {
                $taeed_shode = 'selected';
                $dar_hale_barasi = '';
                $ersale_kala = '';
                $laghvshode = '';
            }
            if ($order->getRawOriginal('delivery_status') == 2) {
                $ersale_kala = 'selected';
                $taeed_shode = '';
                $dar_hale_barasi = '';
                $laghvshode = '';
            }
            if ($order->getRawOriginal('delivery_status') == 3) {
                $laghvshode = 'selected';
                $taeed_shode = '';
                $ersale_kala = '';
                $dar_hale_barasi = '';
            }
            if ($order->getRawOriginal('delivery_method') == 3 and $order->getRawOriginal('payment_status') == 1) {
                $alopeykBTN = '<a target="_blank" class="btn btn-sm btn-dark"
                                       href="' . route('admin.orders.print', ['order' => $order->id]) . '">
                                        درخواست الوپیک
                                    </a>';
            } else {
                $alopeykBTN = '-';
            }
            $status_for_order = '';
            foreach ($all_order_status as $item) {

                if ($order->delivery_status == $item->id) {
                    $selected = 'selected=selected';
                } else {
                    $selected = '';
                }
                $status_for_order .= ' <option ' . $selected . ' value="' . $item->id . '">
                                        ' . $item->title . '
                                    </option>';
            }
            if ($order->getRawOriginal('active_sms') == 1) {
                $active_sms_btn = 'btn-success text-white';
            } else {
                $active_sms_btn = 'btn-dark';
            }
            $payment_type = PaymentMethods::where('id',$order->payment_type )->first()->title;
            $html .= '<tr>
                            <th>
                                -
                            </th>
                            <th>
                                <a href="' . route('admin.user.edit', ['user' => $order->user->id]) . '">
                                ' . $userName . '
                                </a>
                            </th>
                            <th>
                                ' . number_format($order->wallet) . '
                            </th>
                            <th>
                                ' . number_format($order->paying_amount) . '
                            </th>
                            <th>
                                ' . number_format($order->total_amount) . '
                            </th>
                            <th>
                                ' . $payment_type. '
                            </th>
                            <th>
                                ' . $order->payment_status . '
                            </th>
                            <th>
                                ' . verta($order->created_at)->format('%d %B ,Y') . '
                            </th>
                            <th>
                                <a title="ارسال پیامک تغییر وضعیت" id="active_sms_icon_' . $order->id . '"
                                   onclick="active_sms(' . $order->id . ')"
                                   class="btn btn-sm ' . $active_sms_btn . '">
                                   ' . $order->active_sms . '
                                </a>
                            </th>
                            <th>
                                <select onchange="changeOrderStatus(this,' . $order->id . ')" class="form-control form-control-sm">
                               ' . $status_for_order . '
                                </select>
                            </th>
                            <th>
                                ' . $order->order_number . '
                            </th>
                            <th>
                                ' . $order->DeliveryMethod->name . '
                                ' . $alopeykBTN . '
                            </th>
                            <th>
                                <a title="جزئیات" class="btn btn-sm btn-success mb-1"
                                   href="' . route('admin.orders.show', ['order' => $order->id]) . '">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a title="پرینت" target="_blank" class="btn btn-sm btn-dark mb-1"
                                   href="' . route('admin.orders.print', ['order' => $order->id]) . '">
                                    <i class="fa fa-print"></i>
                                </a>
                                <a title="پرینت پیک" target="_blank" class="btn btn-sm btn-warning mb-1"
                                   href="' . route('admin.orders.print_peyk', ['order' => $order->id]) . '">
                                    <i class="fa fa-motorcycle"></i>
                                </a>
                                <button title="حذف" type="button" onclick="RemoveModal(' . $order->id . ')"
                                        class="btn btn-sm btn-danger mb-1"
                                        href=""><i class="fa fa-trash"></i></button>
                            </th>
                        </tr>';
        }


        return response()->json(['ok', $html, $total_rows, $row_per_page, $total_sale_message]);
    }

    public function print(Order $order)
    {
        $setting = Setting::first();
        return view('admin.orders.print', compact('order', 'setting'));
    }

    public function print_peyk(Order $order)
    {
        $setting = Setting::first();
        return view('admin.orders.print_peyk', compact('order', 'setting'));
    }

    public function active_sms(Request $request)
    {

        $order = Order::where('id', $request->order_id)->first();
        $active_sms = $order->getRawOriginal('active_sms');
        if ($active_sms == 0) {
            $new_active_sms = 1;
        }
        if ($active_sms == 1) {
            $new_active_sms = 0;
        }
        $order->update([
            'active_sms' => $new_active_sms,
        ]);
        return \response()->json([1, $new_active_sms]);
    }

    public function sendPeyk(Request $request)
    {
        $address = Setting::first()->address;
        $orderId = $request->order;
        $order = Order::where('id', $orderId)->first();
        //origin location
        $origin_location = AlopeykConfig::first()->alopeyk_location;
        $origin_location = explode('-', $origin_location);
        //sender info
        $person_fullname = AlopeykConfig::first()->name;
        $person_phone = AlopeykConfig::first()->cellphone;
        $origin = [
            "type" => "origin",
            "lat" => $origin_location[0],
            "lng" => $origin_location[1],
            "description" => $address != null ? $address : 'خیابان امام خمینی بعد از شیخ هادی پاساژ فجر طبقه دوم واحد ۲۲۴',
            "unit" => null,
            "number" => null,
            "person_fullname" => $person_fullname != null ? $person_fullname : "فراز عبدامجید",
            "person_phone" => $person_phone != null ? $person_phone : "09129155145",
        ];
        $destination = [
            "type" => "destination",
            "lat" => $order->lat,
            "lng" => $order->lng,
            "description" => $order->address->address,
            "unit" => null,
            "number" => null,
            "person_fullname" => $order->user->name,
            "person_phone" => $order->user->cellphone,
        ];
        if (!empty($request->order)) {
            if ($order->peykRequested == null) {
                $peykResponse = Alopeyk::createOrder($origin, $destination, $orderId, $order->user->id);
                if (!empty($peykResponse->status) && $peykResponse->status == 'success') {
                    $order->update([
                        'peykPrice' => $peykResponse->object->price,
                        'peykID' => $peykResponse->object->id,
                        'peykRequested' => 1,
                        'peykStatus' => 'searching',
                        'peykToken' => $peykResponse->object->order_token,
                    ]);
                    return response()->json($peykResponse);
                } else {
                    return response()->json(['status' => 'systemError', 'message' => 'درخواست به الوپیک ارسال نشد، لطفا مجددا امتحان کنید']);
                }
            } else {
                switch ($order->peykStatus) {
                    case 'expired':
                    case 'cancelled':
                        $peykResponse = Alopeyk::createOrder($origin, $destination, $orderId, $order->user->id);
                        if (!empty($peykResponse->status) && $peykResponse->status == 'success') {
                            $order->update([
                                'peykPrice' => $peykResponse->object->price,
                                'peykID' => $peykResponse->object->id,
                                'peykRequested' => 1,
                                'peykStatus' => 'searching',
                                'peykToken' => $peykResponse->object->order_token,
                            ]);
                            return response()->json($peykResponse);
                        } else {
                            return response()->json(['status' => 'systemError', 'message' => 'درخواست به الوپیک ارسال نشد، لطفا مجددا امتحان کنید']);
                        }
                        break;

                    case 'searching':
                        return response()->json(['status' => 'systemError', 'message' => 'در حال جست و جو برای پیک.']);
                        break;
                    case 'accepted':
                        return response()->json(['status' => 'systemError', 'message' => 'پیک در حال آمدن به سمت شماست.']);
                        break;
                    case 'picking':
                        return response()->json(['status' => 'systemError', 'message' => 'هم اکنون پیک در محل فروشگاه شما حاضر شده است.']);
                        break;
                    case 'delivering':
                        return response()->json(['status' => 'systemError', 'message' => 'پیک در حال تحویل دادن مرسوله است.']);
                        break;
                    case 'delivered':
                        return response()->json(['status' => 'systemError', 'message' => 'مرسوله تحویل شده است.']);
                        break;
                    case 'finished':
                        return response()->json(['status' => 'systemError', 'message' => 'درخواست انجام شده است.']);
                        break;
                    case 'scheduled':
                        return response()->json(['status' => 'systemError', 'message' => 'درخواست زمان بندی شده ارسال شده است.']);
                        break;
                    default:
                        return response()->json(['status' => 'systemError', 'message' => 'درخواست شما قبلا به الوپیک ارسال شده است.']);
                }
            }
        }
    }

    public function excel(Request $request)
    {
        $request->validate([
            'date_on_sale_from_excel' => 'required',
            'date_to_sale_from_excel' => 'required'
        ]);
       
        try {
            DB::beginTransaction();
            $start = convertShamsiToGregorianDate($request->date_on_sale_from_excel);
            $end = convertShamsiToGregorianDate($request->date_to_sale_from_excel);
            $orders = Order::where('created_at', '>=', $start)->where('created_at', '<=', $end)->get();

            $order_excel = OrderExcelCreator::all();
            foreach ($order_excel as $item) {
                $item->delete();
            }
       
            foreach ($orders as $order) {
               
                $order_items = OrderItem::where('order_id', $order->id)->get();
                foreach ($order_items as $key => $item) {
                     
                    if ($key == 0) {
                        $order_id = $item->order_id;
                    } else {
                        $order_id = null;
                    }
                    if ($key == 0) {
                        $user_name = $order->user->first_name.' '.$order->user->last_name;
                    } else {
                        $user_name = null;
                    }
                    if ($key == 0) {
                        $national_code = $order->user->national_code;
                    } else {
                        $national_code = null;
                    }
                    if ($key == 0) {
                        $cellphone = $order->user->cellphone;
                    } else {
                        $cellphone = null;
                    }
                    if ($key == 0) {
                        $tel = $order->user->tel;
                    } else {
                        $tel = null;
                    }
                    if ($key == 0) {
                        $user_address = province_name($order->address->province_id) . ' / ' . city_name($order->address->city_id) . ' - ' . $order->address->address;
                    } else {
                        $user_address = null;
                    }
                    if ($item->option_ids != null) {
                        $extra = '';
                        $extra_price = '';
             $options = json_decode($item->option_ids);
            
                        foreach ($options as $option) {
                   
                            $product_option = ProductOption::where('id', $option)->first()->VariationValue->name;
                            $extra = $extra . '/' . $product_option;
                            $option_price = ProductOption::where('id', $option)->first()->price . 'تومان';
                            $extra_price = $extra_price . '/' . $option_price;
                        }
                  
                    } else {
                        $extra = null;
                        $extra_price = null;
                    }
                          
                    OrderExcelCreator::create([
     'order_id' => $order_id,
                        'order_number' => $order->order_number,
                        'date' => verta($order->created_at)->format('d-m-Y H:i'),
                        'user_name' => $user_name,
                        'mobile' => $cellphone,
                        'national_code' => $national_code,

                        'tel' => $tel,


                        'orders' => $item->Product->name . '/' . isset($item->AttributeValues->name) ?? '' . '/' . isset($item->Color->name) ?? '',
                        'price' => number_format(product_price($item->product_id, $item->product_attr_variation_id)[2]),
                        'extra' => $extra,
                        'extra_price' => $extra_price,
                        'quantity' => $item->quantity,
                        'order_item_price' => number_format(calculateCartProductPrice(product_price($item->product_id, $item->product_attr_variation_id)[2], $item->option_ids) * $item->quantity),
                        'order_price' => number_format($order->total_amount),
                        'delivery_amount' => number_format($order->delivery_amount),
                        'user_address' => $user_address,
                    ]);
            
                }
            }
            DB::commit();
            return Excel::download(new OrdersExport(), 'orders.xlsx');
        } catch (\Exception $exception) {
            dd($exception);
            alert()->error($exception->getMessage(), 'error')->persistent('ok');
            return redirect()->back();
        }
                
    }

    public function checkPeyk(Request $request)
    {
        $orderId = $request->order;
        $order = Order::where('id', $orderId)->first();
        if ($order->peykRequested != null) {
            $peykResponse = Alopeyk::getOrderDetail($order->peykID);
            if (!empty($peykResponse->status) && $peykResponse->status == 'success') {
                $order->update([
                    'peykStatus' => $peykResponse->object->status,
                ]);
                if ($peykResponse->object->courier_info != null) {
                    $courier = CourierInfo::where('order_id', $orderId)->exists();
                    if ($courier) {
                        $courier = CourierInfo::where('order_id', $orderId)->first();
                        if ($courier->phone != $peykResponse->object->courier_info->phone) {
                            $courier->update([
                                'phone' => $peykResponse->object->courier_info->phone,
                                'firstname' => $peykResponse->object->courier_info->firstname,
                                'lastname' => $peykResponse->object->courier_info->lastname,
                                'avatar' => $peykResponse->object->courier_info->avatar->url,
                            ]);
                        }
                    } else {
                        CourierInfo::create([
                            'order_id' => $orderId,
                            'phone' => $peykResponse->object->courier_info->phone,
                            'firstname' => $peykResponse->object->courier_info->firstname,
                            'lastname' => $peykResponse->object->courier_info->lastname,
                            'avatar' => $peykResponse->object->courier_info->avatar->url,
                        ]);
                    }
                }
                return response()->json($peykResponse);
            } else {
                return response()->json(['status' => 'systemError', 'message' => 'درخواست به الوپیک ارسال نشد، لطفا مجددا امتحان کنید']);
            }
        } else {
            return response()->json(['status' => 'systemError', 'message' => 'درخواست شما قبلا به الوپیک ارسال شده است.']);
        }
    }

    public function TrackingCodeUpdate(Order $order, Request $request)
    {
        $request->validate([
            'TrackingCode' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $order->update([
                'TrackingCode' => $request->TrackingCode
            ]);
            $user = User::where('id', $order->user_id)->first();
            $user->notify(new SendSmsTrackingCode($request->TrackingCode, $order->order_number));
            DB::commit();
            alert()->success('کد رهگیری با موفقیت ثبت شد', 'با تشکر');
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error($exception->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function remove(Request $request)
    {
        $order_id = $request->order_id;
        try {
            DB::beginTransaction();
            $order_items = OrderItem::where('order_id', $order_id)->get();
            foreach ($order_items as $item) {
                $item->delete();
            }
            $transaction = Transaction::where('order_id', $order_id)->first();
            $transaction->delete();

            $order = Order::where('id', $order_id)->first();
            $order->delete();

            $msg = 'سفارش مورد نظر با موفقیت حذف شد';
            DB::commit();
            return response()->json([1, $msg]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([0, $exception->getMessage()]);
        }
    }

    public function limit_edit()
    {
        $roles = Roles::where('id', '!=', 1)->get();
        $limit = LimitConfig::first();
        return view('admin.orders.limit', compact('roles', 'limit'));
    }

    public function limit_update(Request $request, LimitConfig $id)
    {
        $id->update($request->all());
        alert()->success('تغییرات مورد نظر با موفقیت اعمال شد')->autoclose(3000);
        return redirect()->back();
    }

}
