<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\InformMe;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Roles;
use App\Models\Setting;
use App\Models\Ticket;
use App\Notifications\RoleRequest;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletHistory;
use App\Notifications\UpdateDeliveryStatusSMS;
use App\Models\City;
use App\Notifications\newTicket;
use App\Notifications\UserUpdateProfileNotification;
use Ghasedak\GhasedakApi;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Province;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\PaymentMethods;
use App\Notifications\pishfactorImageSendSMS;

class UserProfileController extends Controller
{

    public function index()
    {
        $user = User::find(auth()->id());
        return view('home.users_profile.index', compact('user'));
    }

    public function coupon()
    {
        $user = auth()->user();
        $coupons = Coupon::where('user_id', $user->id)->get();
        return view('home.users_profile.coupon', compact('coupons', 'user'));
    }

    public function orders_bijack(Order $order)
    {
        $order_bijack = $order->bijack;
        return view('home.users_profile.bijack', ['order' => $order, 'order_bijack' => $order_bijack]);
    }

    public function change_password(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:4|same:password_confirmation'
        ]);
        try {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            alert()->success('رمز عبور با موفقیت تغییر یافت');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error('change_pass_error:' . $exception->getMessage());
            alert()->error('خطا در تغییر رمز عبور');
            return redirect()->back();
        }

    }

    public function userUpdateInfo(Request $request)
    {

        $user = User::find(auth()->id());
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'national_code' => 'required|melli_code|unique:users,national_code,' . $user->id,
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'national_code' => $request->national_code,
        ]);
        try {
            // $user->notify(new UserUpdateProfileNotification(0));
        } catch (\Exception $exception) {
            Log::error('UserUpdateProfileNotification Error: ' . $exception->getMessage());
        }
        alert()->success('اطلاعات شما با موفقیت ویرایش شد', 'باتشکر');
        return redirect()->back();
    }

    //tickets
    public function TicketIndex()
    {
        $user = auth()->user();
        $tickets = Ticket::where('user_id', $user->id)
            ->where('parent', 0)
            ->latest()
            ->paginate(10);
        return view('home.users_profile.ticket.index', compact('user', 'tickets'));
    }

    public function createTicket()
    {
        $user = auth()->user();
        return view('home.users_profile.ticket.create', compact('user'));
    }

    public function storeTicket(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'title' => 'required|string:max:50',
            'description' => 'required|string|max:1000',
            'file' => 'nullable|max:10000|mimes:png,jpg,jpeg,gif,pdf,doc,docx',
        ]);
        $fileName = null;
        if ($request->has('file')) {
            $fileName = 'ticket_' . time() . '.' . $request->file->extension();
            $request->file->move(public_path(env('UPLOAD_FILE_Ticket')), $fileName);
        }
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $fileName,
            'user_id' => $user->id,
        ]);

        //send sms for user and admin
        $user->notify(new newTicket($ticket->id));

        alert()->success('تیکت جدید با موفقیت ثبت شد', 'با تشکر');
        return redirect()->route('home.ticket.index');

    }

    public function showTicket(Ticket $ticket)
    {
        $user = User::first();
        $conversation = Ticket::where('parent', $ticket->id)->get();
        return view('home.users_profile.ticket.show', compact('user', 'ticket', 'conversation'));
    }

    public function replay(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $request->validate([
            'description' => 'required|max:10000',
            'file' => 'nullable|max:10000|mimes:png,jpg,jpeg,gif,pdf,doc,docx',
        ]);
        $fileName = null;
        if ($request->has('file')) {
            $fileName = 'ticket_' . time() . '.' . $request->file->extension();
            $request->file->move(public_path(env('UPLOAD_FILE_Ticket')), $fileName);
        }
        Ticket::create([
            'user_id' => $ticket->user_id,
            'title' => $ticket->title,
            'file' => $fileName,
            'description' => $request->description,
            'parent' => $ticket->id,
        ]);
        $ticket->update([
            'status_id' => 4
        ]);

        $user = auth()->user();
        $admin = User::where('role', 1)->first();
        $admin['ticket_sender'] = $user->first_name;
        $user->notify(new newTicket($ticket->id));
        alert()->success('پاسخ با موفقیت ارسال شد', 'با تشکر');
        return redirect()->back();
    }

    public function wallet()
    {
        $user = User::where('id', auth()->id())->first();
        $wallet = Wallet::where('user_id', $user->id)->exists();
        if ($wallet == false) {
            Wallet::create([
                'user_id' => $user->id,
            ]);
        }
        $wallet = Wallet::where('user_id', $user->id)->first();
        //wallet history
        $wallet_history = WalletHistory::where('user_id', $user->id)->orderby('id', 'desc')->paginate(20);
        $PaymentMethods = PaymentMethods::where('is_active', 1)->where('name', '!=', 'cash')->get();
        return view('home.users_profile.wallet', compact('wallet',
            'wallet_history',
            'user', 'PaymentMethods'));
    }

    public function orders()
    {
        session()->forget('smspish');
        session()->forget('invoice');
        $user = User::find(auth()->id());
        $orders = Order::where('status', '!=', 0)->where('user_id', auth()->id())->latest()->get();
        $order_status = OrderStatus::all();
        $setting = Setting::first();


        return view('home.users_profile.orders', compact(
            'orders'
            , 'user',
            'order_status',
            'setting'
        ));
    }


    public function order_show(Order $order)
    {
        $user = User::find(auth()->id());
        $setting = Setting::first();
        $order_status = OrderStatus::all();
        $order_bijack = $order->bijack;
        return view('home.users_profile.order_show', compact(
            'order'
            , 'user',
            'order_status',
            'setting',
            'order_bijack'
        ));
    }

    public function order_print(Order $order)
    {
        $user = User::find(auth()->id());
        $setting = Setting::first();
        $order_status = OrderStatus::all();
        return view('home.users_profile.order_print', compact(
            'order'
            , 'user',
            'order_status',
            'setting'
        ));
    }

    public function order_image(Request $request, Order $order)
    {
        $request->validate([
            'image' => 'required|image',
        ]);


        try {
            $fileNamePrimaryImage = generateFileName($request->image->getClientOriginalName());

            $request->image->move(public_path(env('ORDER_IMAGE_UPLOAD_PATH')), $fileNamePrimaryImage);
            $order->update([
                'image' => $fileNamePrimaryImage
            ]);

            try {
                //send sms to admins
                $admins = Setting::first()->delivery_order_numbers;
                $admins_cellphone = explode(',', $admins);
                foreach ($admins_cellphone as $cellphone) {
                    $user = User::where('cellphone', $cellphone)->first();
                    $user->notify(new pishfactorImageSendSMS($order->id));
                }
                alert()->success('رسید واریز ارسال شد')->autoclose(5000);
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
                alert()->error('تصویر با موفقیت ارسال شد.مشکل در ارسال پیامک')->persistent('ok');
            }

        } catch (\Exception $exception) {
            alert()->error('مشکلی در ارسال تصویر بوجود آمده است')->persistent('ok');
        }

        return redirect()->back();
    }

    public function informMe()
    {
        $user = User::where('id', auth()->id())->first();
        //wallet history
        $products = InformMe::where('user_id', $user->id)->paginate(20);
        return view('home.users_profile.informMe', compact('products', 'user'));
    }

    public function remove(Request $request)
    {
        $informMe = InformMe::where('id', $request->id)->first();
        $informMe->delete();
        return response()->json(['ok']);
    }

    public function role_request_index()
    {
        $provinces = Province::all();
        $user = auth()->user();
        $user_province=Province::where('id',$user->company_province)->first();
        return view('home.users_profile.role_request_index', compact('user', 'provinces','user_province'));
    }


    // public function change_role(Request $request)
    // {
    //     $request->validate([
    //         'company_name' => 'required|max:30',
    //         'company_sabt_number' => 'required|max:30',
    //         'company_shenase_melli' => 'required|max:30',
    //         'company_address' => 'required|max:30',
    //         'company_postalCode' => 'required|iran_postal_code',
    //     ]);
    //     try {
    //         $user = auth()->user();
    //         $user->update([
    //             'company_name' => $request->company_name,
    //             'company_sabt_number' => $request->company_sabt_number,
    //             'company_shenase_melli' => $request->company_shenase_melli,
    //             'company_address' => $request->company_address,
    //             'company_postalCode' => $request->company_postalCode,
    //             'role_request_status' => 1,
    //         ]);
    //         //send sms to admins
    //         $admins = Setting::first()->delivery_order_numbers;
    //         $admins_cellphone = explode(',', $admins);
    //         $type = 1;
    //         $api = new GhasedakApi(env('GHASEDAK_API_KEY'));
    //         foreach ($admins_cellphone as $receptor) {
    //             try {
    //                 $template = "newRoleRequest";
    //                 $param1 = 'گرامی';
    //                 $api->Verify($receptor, $type, $template, $param1);
    //             }catch (\Exception $exception){
    //                 Log::error('change Role Request SMS: '.$exception->getMessage());
    //             }

    //         }
    //         alert()->success('به زودی درخواست شما بررسی خواهد شد')->persistent('ok');
    //     } catch (\Exception $exception) {
    //         Log::error($exception->getMessage());
    //         alert('خطا در ویرایش اطلاعات')->persistent('ok');
    //     }
    //     return redirect()->back();
    // }

    public function change_role(Request $request)
    {

        $request->validate([
            'company_name' => 'required|max:30',
            'company_sabt_number' => 'required|max:30',
            'company_shenase_melli' => 'required|max:30',
            'company_address' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'company_postalCode' => 'required|iran_postal_code',
        ]);
        try {
            $user = auth()->user();
            $legal_role = Roles::where('name', 'legal')->first()->id;
            $user->update([
                'company_name' => $request->company_name,
                'company_sabt_number' => $request->company_sabt_number,
                'company_shenase_melli' => $request->company_shenase_melli,
                'company_address' => $request->company_address,
                'company_city' => $request->city_id,
                'company_province' => $request->province_id,
                'company_postalCode' => $request->company_postalCode,
                'role_request_status' => 1,
            ]);
            if ($user->role==3){
                $msg='درخواست ویرایش حساب کاربری حقوقی شما ثبت شد';
            }else{
                $msg='درخواست حساب کاربری حقوقی شما ثبت شد';
            }
            alert()->success($msg)->autoclose('5000');
            $user->notify(new RoleRequest());
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            alert('خطا در ویرایش اطلاعات')->persistent('ok');
        }
        return redirect()->back();
    }
    
    


}
