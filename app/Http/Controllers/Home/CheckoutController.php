<?php

namespace App\Http\Controllers\Home;

use App\Alopeyk\Alopeyk;
use App\Http\Controllers\Controller;
use App\Models\AlopeykConfig;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\DeliveryConfig;
use App\Models\DeliveryMethod;
use App\Models\DeliveryMethodAmount;
use App\Models\LimitConfig;
use App\Models\Order;
use App\Models\PaymentMethods;
use App\Models\Product;
use App\Models\ProductAttrVariation;
use App\Models\Province;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Parent_;

class CheckoutController extends Controller
{
    public function checkout()
    {
        session()->forget('alopeyk_price');
        session()->forget('use_wallet');
        $delivery_config = DeliveryConfig::first();
        $order_send_after = $delivery_config->order_send_after;
        $sent_times = $delivery_config->sent_times;
        $days_count = $delivery_config->days_count;
        $holidays = $delivery_config->holidays;
        $date = [];
        $holidaysName = [];
        if ($holidays) {
            $holidays = explode(',', $holidays);
            foreach ($holidays as $holiday) {
                array_push($holidaysName, dayOfWeek($holiday));
            }
        }
            
        if ($sent_times) {
            $sent_times = explode(',', $sent_times);
            
                   $times =  [];
      foreach($sent_times as $key => $time){
          
          $new_time = str_replace('-',' تا ',$time);
          
          $times[] = $new_time;
          unset($sent_times[$key]);
          
      }
      
      foreach($times as $time){
          $sent_times[] = $time;
      }
        } else {
            $sent_times = [];
        }
    
 
        for ($i = 0 + $order_send_after; $i < $days_count + $order_send_after; $i++) {
            $order_send_start = Carbon::now()->addDay($i);
            array_push($date, $order_send_start);
        }

        $cart = Cart::where('user_id', auth()->id())->get();
      
        if ($cart->isEmpty()) {
            alert()->warning('سبد خرید شما خالی میباشد', 'دقت کنید');
            return redirect()->route('home.index');
        }

        $addresses = UserAddress::where('user_id', auth()->id())->latest()->get();
        $PaymentMethods = PaymentMethods::where('is_active', 1)->get();
        $deliveryMethod = DeliveryMethod::where('is_active', 1)->get();
        $provinces = Province::all();

        //calculate delivery price
        if (count($addresses) > 0) {
            $address_id = $addresses[0]->id;
            $province_id = $addresses[0]->province_id;
            foreach ($deliveryMethod as $item) {
                $this->calculateDeliveryPrice($province_id, $addresses[0], $item);
            }
            //check alopeyk
            $alopeyk = $this->exist_aloPeyk($addresses[0]);
        } else {
            $address_id = null;
            $province_id = null;
            $alopeyk = false;
        }
        //set time for methods
        $set_time_for = $delivery_config->methods_id;
        $set_time_for = explode(',', $set_time_for);
        $selected_time = false;
        foreach ($set_time_for as $item) {
            if ($item == $deliveryMethod[0]->id) {
                $selected_time = true;
            }
        }
        $user = auth()->user();
        return view('home.checkout', compact('addresses',
            'provinces',
            'PaymentMethods',
            'deliveryMethod',
            'address_id',
            'province_id',
            'date',
            'holidaysName',
            'sent_times',
            'selected_time',
            'alopeyk',
            'user'
        ));
    }

    //calculate delivery price function ajax
public function checkout_calculate_delivery(Request $request)
    {
        $delivery_config = DeliveryConfig::first();
        $address_id = $request->address_id;
        $deliveryMethod = DeliveryMethod::where('is_active', 1)->orderby('id', 'desc')->get();
        $address = UserAddress::where('id', $address_id)->first();
        $province_id = $address->province_id;
        foreach ($deliveryMethod as $item) {
            $this->calculateDeliveryPrice($province_id, $address, $item);
        }
        $html = '';
        $check_can_product_send_to_province = $this->check_can_product_send_to_province($province_id);
        if (!$check_can_product_send_to_province[0]) {
            $error = '<div class="alert alert-danger w-100">
<h3 class="limit_send">محدودیت ارسال</i>
</h3>
<hr>
<h5>برای محصولات زیر امکان ارسال به آدرس انتخابی شما وجود ندارد؛ لطفا این محصولات را از سبد خرید خود حذف نمایید:</h5>' . $check_can_product_send_to_province[1] . '
</div>';
            return \response()->json([0, $error]);
        }
  foreach ($deliveryMethod as $key => $item) {
            $item->exist_service = $this->can_send_with_this_method($item);
            if ($item->exist_service == true) {
                $deactive = ' ';
                $onclick = 'onclick="selectDeliveryMethod(this,' . $item->id . ')"';
                $display_none = '';
            } else {
                $deactive = 'deActive';
                $onclick = '';
                $display_none = 'd-none';
            }

            if ($item->delivery_price != 0){
                $cash =  '<div class="price">
                                                        <div class="title">هزینه:</div>
                                                        <div class="priceIn">
                                                        <input type="hidden" class="send_method" value="' . $item->id . '">
                    ' . $item->delivery_price . '</div></div>';
            }else{
                $cash = '';
            }
if ($item->exist_service == true) {
            $html = $html . '<div ' . $onclick . ' class="d-md-flex justify-content-between km-delivery-type-style ' . $deactive . ' ' . $display_none . '">
                                                    <input checked="" class="km-value-control none km-active"
                                                           type="radio" value="">
                                                    <div class="d-flex flex-y-center">
                                                        <div class="km-img">
                                                            <img alt="پیک موتوری"
                                                                 src="' . imageExist(env('IMAGE_DELIVERYMETHOD_UPLOAD_PATH'), $item->image) . '">
                                                        </div>
                                                        <div class="km-content">
                                                            <div class="km-title km-title-right">' . $item->name . '</div>
                                                            <div class="km-description">
                                                                ' . $item->description . '
                                                            </div>
                                                        </div>
                                                    </div>
                                                    '.$cash.'
                                                   </div>';
}
        }
        //set time for methods
        $set_time_for = $delivery_config->methods_id;
        $set_time_for = explode(',', $set_time_for);
        $selected_time = false;
        foreach ($set_time_for as $item) {
            if ($item == $deliveryMethod[0]->id) {
                $selected_time = true;
            }
        }
        return \response()->json([1, $html, $deliveryMethod[0]->id, $selected_time]);
    }

    //show send time
    public function select_delivery_method(Request $request)
    {
        $delivery_config = DeliveryConfig::first();
        $delivery_selected_id = $request->delivery_selected_id;
        //set time for methods
        $set_time_for = $delivery_config->methods_id;
        $set_time_for = explode(',', $set_time_for);
        $selected_time = false;
        foreach ($set_time_for as $item) {
            if ($item == $delivery_selected_id) {
                $selected_time = true;
            }
        }
        return \response()->json([1, $selected_time]);
    }

    //calculateAloPeykPrice
    public function calculateAloPeykPrice(Request $request)
    {
        if ($request->alopeyk_location == null) {
            return response()->json([0, 'انتخاب محل دقیق تحویل کالا الزامی است']);
        }
        $apiResponse = Alopeyk::authenticate();
        if ($apiResponse && $apiResponse->status == "success") {
            //origin location
            $origin_location = AlopeykConfig::first()->alopeyk_location;
            $origin_location = explode('-', $origin_location);
            $origin = [
                "type" => "origin",
                "lat" => $origin_location[0],
                "lng" => $origin_location[1],
            ];
            //destination
            $destination_location = $request->alopeyk_location;
            $destination_location = explode('-', $destination_location);
            session()->put('lat', $destination_location[0]);
            session()->put('lng', $destination_location[1]);
            $destination = [
                "type" => "destination",
                "lat" => $destination_location[0],
                "lng" => $destination_location[1],
            ];

            $user = $apiResponse->object->user;
            //calculatePrice
            $price_response = Alopeyk::NormalPrice($origin, $destination);
            $alopeyk_response = $price_response->object->price;
            session()->put('alopeyk_price', intval($alopeyk_response * 1.2));
            return response()->json([1, number_format($alopeyk_response * 1.2) . ' تومان ']);
        }
    }

    public function checkoutSaveStep1(Request $request)
    {
        $address_id = $request->address_id;
        $delivery_method_selected_id = $request->delivery_method_selected_id;
        $dayNameInput = $request->dayNameInput;
        $send_time_select = $request->send_time_select;
        $alopeyk_location = $request->alopeyk_location;
        //validation
        if ($address_id == null) {
            return \response()->json([0, 'انتخاب آدرس برای ارسال سفارش الزامی است.']);
        }
        if ($delivery_method_selected_id == null) {
            return \response()->json([0, 'انتخاب روش ارسال سفارش الزامی است.']);
        }
        if ($delivery_method_selected_id == 3 and $alopeyk_location == null) {
            return \response()->json([2, 'محل دقیق خود را انتخاب کنید']);
        }
        if ($delivery_method_selected_id == 3 and !session()->exists('alopeyk_price')) {
            return \response()->json([2, 'خطا در محاسبه قیمت الوپیک.لطفا دوباره امتحان کنید']);
        }
        //check send day
        $delivery_config = DeliveryConfig::first();
        $set_time_for = $delivery_config->methods_id;
        $set_time_for = explode(',', $set_time_for);
        foreach ($set_time_for as $item) {
            if ($item == $delivery_method_selected_id) {
                if ($dayNameInput == null) return \response()->json([0, 'انتخاب روز برای ارسال سفارش الزامی است.']);
                if ($send_time_select == null) return \response()->json([0, 'انتخاب ساعت برای ارسال سفارش الزامی است.']);
            }
        }
        session()->put('address_info', [
            'address_id' => $address_id,
            'delivery_method_selected_id' => $delivery_method_selected_id,
            'dayNameInput' => $dayNameInput,
            'send_time_select' => $send_time_select,
        ]);
//        $address = UserAddress::where('id', $address_id)->first();
//        if ($delivery_method_selected_id == 1 and $address->postal_code == null) {
//            return \response()->json([3, $address->address]);
//        }
    return \response()->json([1, 'آدرس ثبت شد']);

    }

    public function AddPostalCodeToAddress(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'modal_postalCode' => 'required|iran_postal_code'
        ]);
        if ($validate->fails()) {
            $err = 'کد پستی وارد شده صحیح نمیباشد';
            return \response()->json([0, $err]);
        }
        try {
            DB::beginTransaction();
            $address = UserAddress::where('id', $request->address_id)->first();
            $address->update([
                'postal_code' => $request->modal_postalCode
            ]);
            $msg = 'کد پستی با موفقیت ثبت شد';
            DB::commit();
            return \response()->json([1, $msg]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return \response()->json([0, $exception->getMessage()]);
        }
    }

    //check alopeyk exist
    public function exist_aloPeyk($address)
    {
        $alopeyk = false;
        $exist_cities = [304, 303, 311];
        foreach ($exist_cities as $exist_city) {
            if ($exist_city == $address->city_id) {
                $alopeyk = true;
            }
        }
        return $alopeyk;
    }

    //calculate delivery price function
    public function calculateDeliveryPrice($province_id, $address, $item)
    {
        if ($item->id == 1 or $item->id == 6 or $item->id == 7) {
            $this->check_other_delivery_price($province_id, $item);
        }
        if ($item->id == 2) {
            $this->check_peyk_delivery_price($item, $address);
        }
        if ($item->id == 3) {
            $alopeyk = $this->exist_aloPeyk($address);
            $item['delivery_price'] = $item->payment_type;
            if ($alopeyk) {
                $item['exist_service'] = true;
                $alopeyk_price = session()->get('alopeyk_price');
                session()->put('delivery_price', $alopeyk_price);
            }
        }
        if ($item->id == 4) {
            $item['exist_service'] = true;
            $item['delivery_price'] = $item->payment_type;
            session()->put('delivery_price', $item->payment_type);
        }
        if ($item->id == 5) {
            $item['exist_service'] = true;
            $item['delivery_price'] = $item->payment_type;
            session()->put('delivery_price', $item->payment_type);
        }
        $this->check_free_delivery($item);
    }

    protected function check_free_delivery($method)
    {
        $delivery_config = DeliveryConfig::first();
        $free_delivery_for = $delivery_config->free_delivery_for;
        $free_delivery_for = explode(',', $free_delivery_for);
        $free_delivery = $delivery_config->free_delivery;
        if (in_array($method->id, $free_delivery_for)) {
            if (calculateCartPrice()['sale_price'] > $free_delivery) {
                session()->put('delivery_price', 'ارسال رایگان');
                $method['delivery_price'] = 'ارسال رایگان';
            }
        }

    }

    public function preview_checkout()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        if (count($carts) == 0) {
            alert()->error('سبد خرید شما خالی است', 'متاسفیم');
            return redirect()->route('home.index');
        }
        foreach ($carts as $cart) {
            $product_attr_variation = ProductAttrVariation::where('product_id', $cart->product_id)
                ->where('attr_value', $cart->variation_id)
                ->where('color_attr_value', $cart->color_id)
                ->first();
            if ($product_attr_variation != null) {
                $product_attr_variation_id = $product_attr_variation->id;
                $cart['product_attr_variation_id'] = $product_attr_variation_id;
            }
            $option_ids = json_decode($cart->option_ids);
            $cart['option_ids'] = $option_ids;
        }


                    $address_info = session()->get('address_info');
        $address_id = $address_info['address_id'];
        $delivery_method_selected_id = $address_info['delivery_method_selected_id'];
        $delivery_method = DeliveryMethod::where('id', $delivery_method_selected_id)->first();
        $delivery_day = $address_info['dayNameInput'];
        $delivery_time = $address_info['send_time_select'];
        $address = UserAddress::where('id', $address_id)->first();
      

        //day and time for send
        //check send day
        $delivery_config = DeliveryConfig::first();
        $set_time_for = $delivery_config->methods_id;
        $set_time_for = explode(',', $set_time_for);
        $set_time = false;
        foreach ($set_time_for as $item) {
            if ($item == $delivery_method_selected_id) {
                $set_time = true;
            }
        }
        //calculate delivery price
        $this->calculateDeliveryPrice($address->province_id, $address, $delivery_method);
        //payments
        $PaymentMethods = PaymentMethods::where('is_active', 1)->orderby('priority', 'asc')->get();
        $wallet = Wallet::where('user_id', auth()->id())->first();
        if ($wallet != null) {
            $amount = $wallet->amount;
        } else {
            $amount = 0;
        }
        //بررسی امکان این که امکان پرداخت بیعانه وجود دارد یا خیر
        $limited_products_for_pay_cash=$this->check_pay_cash($carts, $address);
        return view('home.preview_check_out', compact('carts',
            'address',
            'delivery_method',
            'delivery_day',
            'delivery_time',
            'set_time',
            'PaymentMethods',
            'amount',
            'limited_products_for_pay_cash',
        ));
    }

    public function check_pay_cash($carts, $address)
    {
        $province_id = $address->province_id;
        $limited_pay_cash = [];
        foreach ($carts as $cart) {
            $product = Product::where('id', $cart->product_id)->first();
            $provinces_id = $product->Provinces()->pluck('id')->toArray();
            if (!in_array($province_id, $provinces_id)) {
                $limited_pay_cash[] = $cart->product_id;
            }
        }
        return $limited_pay_cash;
    }

    public function WalletUsage(Request $request)
    {
        $use_wallet = $request->use_wallet;
        if ($use_wallet == 1) {
            session()->put('use_wallet', 1);
        } else {
            session()->forget('use_wallet');
        }
        $original_price = summery_cart()['original_price'];
        $total_sale = summery_cart()['total_sale'];
        $coupon_amount = summery_cart()['coupon_amount'];
        $delivery_price = summery_cart()['delivery_price'];
        if (intval($delivery_price) == 0) {
            $delivery_price = $delivery_price;
        } else {
            $delivery_price = number_format($delivery_price) . ' تومان ';
        }
          $tax = number_format(calculateCartPrice()['tax']);
        $total_amount = summery_cart()['total_amount'];
        $wallet_amount = summery_cart()['wallet_amount'];
        $payment = summery_cart()['payment'];
        $html = ' <div class="cart-summary mb-4">
                                        <h3 class="cart-title text-uppercase">خلاصه سبد خرید </h3>
                                        <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                            <label class="ls-25">کل سبد خرید </label>
                                            <span>' . number_format($original_price) . ' تومان </span>
                                        </div>
                                        <hr class="divider">
                                        <div class="order-total d-flex justify-content-between align-items-center">
                                            <label>تخفیف</label>
                                            <span>' . number_format($total_sale) . ' تومان </span>
                                        </div>
                                             <hr class="divider">
                                        <div class="order-total d-flex justify-content-between align-items-center">
                                            <label>مالیات</label>
                                            <span>' . $tax . ' تومان </span>
                                        </div>
                                        <hr class="divider">
                                        <div class="order-total d-flex justify-content-between align-items-center">
                                            <label>مبلغ کد تخفیف</label>
                                            <span>' . number_format($coupon_amount) . ' تومان </span>
                                        </div>
                                        <hr class="divider">
                                        <div class="order-total d-flex justify-content-between align-items-center">
                                            <label>هزینه ارسال</label>
                                            <span>' . $delivery_price . '</span>
                                        </div>
                                     
                                        <hr class="divider">
                                        <div class="order-total text-black d-flex justify-content-between align-items-center">
                                            <label>کسر از کیف پول</label>
                                            <span>' . number_format($wallet_amount) . ' تومان </span>
                                        </div>
                                        <hr class="divider">
                                        <div class="order-total text-black d-flex justify-content-between align-items-center">
                                            <label>مبلغ قابل پرداخت</label>
                                            <span>' . number_format($payment) . ' تومان </span>
                                        </div>
                                    </div>';
        return response()->json([1, $html]);
    }

    public function check_limit()
    {
        if (!auth()->check()) {
            $route = route('home.cart');
            $msg = 'خطا در شناسایی کاربر!لطفا دوباره وارد شوید';
            return [
                'status' => 0,
                'message' => $msg,
                'redirect' => $route,
            ];
        }
        $user = auth()->user();
        $role = $user->Role->id;
        $limit = LimitConfig::first();
        $count_limit = $limit->count;
        $day = (-1) * ($limit->day);
        if ($role != 2 or $count_limit == 0 or $limit->day == 0 or $limit->is_active == 0) {
            return [
                'status' => 1,
            ];
        }
        $limit_date = Carbon::now()->addDay($day);
        $orders = Order::where('user_id', $user->id)->where('status', '!=', 0)->where('created_at', '>', $limit_date)->get();
        if (count($orders) == 0) {
            return [
                'status' => 1,
            ];
        }
        $total_quantity = 0;
        foreach ($orders as $order) {
            $total_quantity += $order->orderItems->sum('quantity');
        }
        $quantity_can_order = $count_limit - $total_quantity;
        if ($quantity_can_order < 1) {
            $end_limit_date = Carbon::parse($orders[0]->created_at)->addDay($limit->day);
            $end_limit_date = verta($end_limit_date)->format('%d %B Y H:i');
            $msg = 'محدودیت خرید! شما هر ' . $limit->day . ' روز میتوانید ' . $limit->count . ' کالا را خریداری نمایید.محدودیت شما در تاریخ ' . $end_limit_date . ' به پایان میرسد';
            $route = route('home.index');
            return [
                'status' => 0,
                'message' => $msg,
                'redirect' => $route,
            ];
        }
        $carts = Cart::where('user_id', auth()->id())->get();
        $quantity_product_in_cart = $carts->sum('quantity');
        if ($quantity_product_in_cart <= $quantity_can_order) {
            return [
                'status' => 1,
            ];
        }
        $end_limit_date = Carbon::parse($orders[0]->created_at)->addDay($limit->day);
        $end_limit_date = verta($end_limit_date)->format('%d %B Y H:i');
        $route = route('home.cart');
        $msg = 'محدودیت خرید! شما تا تاریخ ' . $end_limit_date . ' حداکثر ' . $quantity_can_order . ' کالای دیگر را میتوانید خریداری کنید';
        return [
            'status' => 0,
            'message' => $msg,
            'redirect' => $route,
        ];

    }

    public function check_national_code(Request $request)
    {
        if (!auth()->check()) {
            $route = route('home.cart');
            $msg = 'خطا در شناسایی کاربر!لطفا دوباره وارد شوید';
            return [
                'status' => 0,
                'message' => $msg,
                'redirect' => $route,
            ];
        }
        $user = User::find($request->user_id);
        $national_code = $user->national_code;
        if ($national_code == null) {
            $msg = 'وارد کردن کد ملی الزامی است';
            return [
                'status' => 2,
                'message' => $msg,
            ];
        }
        return [
            'status' => 1,
        ];
    }

    public function check_sale_for_legal(Request $request)
    {
        session()->put('order_description',$request->description);
        if (!auth()->check()) {
            $route = route('home.cart');
            $msg = 'خطا در شناسایی کاربر!لطفا دوباره وارد شوید';
            return [
                'status' => 0,
                'message' => $msg,
                'redirect' => $route,
            ];
        }
        $user = User::find($request->user_id);
        $carts = Cart::where('user_id', $user->id)->get();
        foreach ($carts as $cart) {
            $product = $cart->Product;
            if ($user->getRawOriginal('role') == 3 and $product->sale_for_legal == 0) {
                $msg = 'خرید کالای ' . $product->name . ' فقط با حساب کاربری حقیقی امکان پذیر است.لطفا با حساب کاربری حقیقی اقدام به خرید نمایید';
                return [
                    'status' => 0,
                    'message' => $msg,
                ];
            }
        }
        foreach ($carts as $cart) {
            $product = $cart->Product;
            $categories = $product->Categories;
            $is_sale = true;
            foreach ($categories as $category) {
                if ($category->is_sale == 0) {
                    $msg = 'در حال حاضر قادر به فروش کالای ' . $product->name . ' نیستیم.لطفا برای ادامه خرید این کالا را از سبد خرید خود حذف نمایید';
                    return [
                        'status' => 0,
                        'message' => $msg,
                    ];
                }
            }

        }
        return [
            'status' => 1,
        ];
    }

    public function add_national_code(Request $request)
    {
        if (!auth()->check()) {
            $route = route('home.cart');
            $msg = 'خطا در شناسایی کاربر!لطفا دوباره وارد شوید';
            return [
                'status' => 0,
                'message' => $msg,
                'redirect' => $route,
            ];
        }
        $request->validate([
            'national_code' => 'required|melli_code',
        ]);
        $user = User::find($request->user_id);
        $user->update([
            'national_code' => $request->national_code,
        ]);
        return response()->json([1, 'کد ملی شما با موفقیت ثبت شد']);
    }

    protected function check_can_product_send_to_province($province_id)
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        $tehran = Province::where('name', 'تهران')->first();
        $alborz = Province::where('name', 'البرز')->first();
        $products_html = '';
        $has_error = false;
        foreach ($carts as $cart) {
            $product = $cart->Product;
            if ($province_id == $tehran->id) {
                if ($product->send_to_tehran == 0) {
                    $products_html .= '<div class="text-right">' . $product->name . '</div>';
                    $has_error = true;
                }
            } else if ($province_id == $alborz->id) {
                if ($product->send_to_alborz == 0) {
                    $products_html .= '<div class="text-right">' . $product->name . '</div>';
                    $has_error = true;
                }
            } else {
                if ($product->send_to_others == 0) {
                    $products_html .= '<div class="text-right">' . $product->name . '</div>';
                    $has_error = true;
                }
            }
        }
        if ($has_error) {
            return [false, $products_html];
        } else {
            return [true];
        }

    }

    protected function can_send_with_this_method($method)
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        foreach ($carts as $cart) {
            $product = Product::where('id', $cart->product_id)->first();
            $categories=$product->Categories()->where('parent_id','!=',0)->get();
            if (count($categories)>0){
                $send_setting = unserialize($categories[0]->send_setting);
                if (is_array($send_setting)) {
                    if (in_array($method->id, $send_setting)) {
                        return false;
                    }
                }
            }
            
        }
        return $method->exist_service;
    }

    protected function check_peyk_delivery_price($item, $address)
    {
        $city_id = $address->city_id;
        $province_id = $address->province_id;
        $carts = Cart::where('user_id', auth()->id())->get();
        $max_price = 0;
        foreach ($carts as $cart) {
            $product = Product::where('id', $cart->product_id)->first();
            $category = $product->Categories()->where('parent_id', '!=', 0)->first();
            if (isset($category->PeykPrice) and count($category->PeykPrice) > 0) {
                $peyk = $category->PeykPrice()->where('province_id', $province_id)->where('city_id', $city_id)->first();
                if ($peyk != null) {
                    $peyk_price = $category->PeykPrice()->where('province_id', $province_id)->where('city_id', $city_id)->first()->price;
                    if ($category->depends_on_quantity == 1) {
                        $quantity = $cart->quantity;
                    } else {
                        $quantity = 1;
                    }
                    $product_delivery_price = $peyk_price * $quantity;
                    if ($max_price < $product_delivery_price) {
                        $max_price = $product_delivery_price;
                    }
                }
            }
            $delivery_price = $max_price;
        }
        if ($delivery_price === 0) {
            $item['exist_service'] = false;
            $item['delivery_price'] = $item->payment_type;
        } else {
            $item['exist_service'] = true;
            session()->put('delivery_price', $delivery_price);
            $item['delivery_price'] = number_format($delivery_price) . ' تومان ';
        }
    }

    protected function check_other_delivery_price($province_id, $item)
    {
        $delivery_price = DeliveryMethodAmount::where('province_id', $province_id)->where('method_id', $item->id)->first();
        if ($delivery_price) {
            $price = $delivery_price->price;
            if ($price == 0) {
                session()->put('delivery_price', $item->payment_type);
                $item['delivery_price'] = '-';
            } else {
                $this->check_delivery_price_with_quantity($price, $item);
            }
        } else {
            $item['exist_service'] = false;
            $item['delivery_price'] = '-';
        }
    }

    protected function check_delivery_price_with_quantity($delivery_price, $item)
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        $max_price = 0;
        foreach ($carts as $cart) {
            $product = $cart->Product;
            $category = $product->Categories()->where('parent_id', '!=', 0)->first();
            if (isset($category) and $category->depends_on_quantity == 1) {
                $quantity = $cart->quantity;
            } else {
                $quantity = 1;
            }
            $product_delivery_price = ($delivery_price * $quantity);
            if ($max_price < $product_delivery_price) {
                $max_price = $product_delivery_price;
            }
        }
        $final_price = $max_price;
        session()->put('delivery_price', intval($final_price));
        $item['delivery_price'] = number_format($final_price) . ' تومان ';
        $item['exist_service'] = true;
    }

    public function checkCoupon(Request $request)
    {
        $request->validate([
            'couponCode' => 'required'
        ]);
        $coupon = Coupon::where('code', $request->couponCode)->first();
        if ($coupon == null) {
            session()->forget('coupon');
            alert()->error('کد تخفیف وارد شده معتبر نیست', 'دقت کنید');
            return redirect()->back();
        }
        if ($coupon->user_id == null) {
            $result = checkCoupon($request->couponCode);
            if (array_key_exists('error', $result)) {
                alert()->error($result['error'], 'دقت کنید');
            } else {
             alert()->success($result['success'] )->autoclose(5000);
            }
            return redirect()->back();
        }

        if (!auth()->check()) {
            session()->forget('coupon');
            alert()->error('برای استفاده از کد تخفیف نیاز هست ابتدا وارد وب سایت شوید', 'دقت کنید');
            return redirect()->back();
        }

        $result = checkCoupon($request->couponCode);

        if (array_key_exists('error', $result)) {
            alert()->error($result['error']);
        } else {
                 alert()->success($result['success'])->autoclose(5000);
        }
        return redirect()->back();
    }

}

