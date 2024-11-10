<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttrVariation;
use App\Models\ProductOption;
use App\Models\ProductVariation;
use App\Models\Province;
use App\Models\Wallet;
use Carbon\Carbon;

if (!function_exists('generateFileName')) {
    function generateFileName($name)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $hour = Carbon::now()->hour;
        $minute = Carbon::now()->minute;
        $second = Carbon::now()->second;
        $microsecond = Carbon::now()->microsecond;
        return $year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $microsecond . '_' . $name;
    }
}

if (!function_exists('convertShamsiToGregorianDate')) {
    function convertShamsiToGregorianDate($date)
    {
        if ($date == null) {
            return null;
        }
        $pattern = "/[-\s]/";
        $shamsiDateSplit = preg_split($pattern, $date);

        $arrayGergorianDate = verta()->getGregorian($shamsiDateSplit[0], $shamsiDateSplit[1], $shamsiDateSplit[2]);

        return implode("-", $arrayGergorianDate) . " " . $shamsiDateSplit[3];
    }
}

if (!function_exists('cartTotalSaleAmount')) {
    function cartTotalSaleAmount()
    {
        $cartTotalSaleAmount = 0;
        foreach (\Cart::getContent() as $item) {
            if (sizeof($item->attributes) > 0) {
                $variation = ProductVariation::where('id', $item->attributes[0])->first();
                if (($variation->percentSalePrice > 0 && Carbon::now() > $variation->date_on_sale_from && Carbon::now() < $variation->date_on_sale_to) or ($variation->percentSalePrice > 0 && $variation->has_discount == 1)) {
                    $cartTotalSaleAmount += $item->quantity * ($variation->price - $variation->sale_price);
                }

            } else {
                if ($item->associatedModel->percentSalePrice > 0 && Carbon::now() > $item->associatedModel->DateOnSaleFrom && Carbon::now() < $item->associatedModel->DateOnSaleTo) {
                    $cartTotalSaleAmount += $item->quantity * ($item->associatedModel->price - $item->associatedModel->salePrice);
                }
            }
        }

        return $cartTotalSaleAmount;
    }
}

if (!function_exists('cartTotalAmount')) {
    function cartTotalAmount()
    {
        $delivery_price = 0;
        if (auth()->check()) {
            if (session()->has('delivery_price')) {
                $delivery_price = session()->get('delivery_price');
            }
        }
        $delivery_price = intval($delivery_price);
        if (session()->has('coupon')) {
            if (session()->get('coupon.amount') > (\Cart::getTotal() + $delivery_price)) {
                return 0;
            } else {
                return (\Cart::getTotal() + $delivery_price - session()->get('coupon.amount'));
            }
        } else {
            return \Cart::getTotal() + $delivery_price;
        }


    }
}

if (!function_exists('checkCoupon')) {
    function checkCoupon($code)
    {
        $coupon = Coupon::where('code', $code)->first();
        if ($coupon->user_id == null) {
            $coupon = Coupon::where('code', $code)
                ->where('expired_at', '>', Carbon::now())
                ->where('times', '>', 0)
                ->first();
        } else {
            if (!auth()->check()) {
                session()->forget('coupon');
                return ['error' => 'برای استفاده از کد تخفیف لازم است وارد شوید'];
            }
            $userId = auth()->id();
            $coupon = Coupon::where('code', $code)
                ->where('expired_at', '>', Carbon::now())
                ->where('user_id', $userId)
                ->where('times', '>', 0)
                ->first();
        }
        if ($coupon == null) {
            session()->forget('coupon');
            return ['error' => 'کد تخفیف وارد شده وجود ندارد'];
        }

//    if (Order::where('user_id', auth()->id())->where('coupon_id', $coupon->id)->where('payment_status', 1)->exists()) {
//        session()->forget('coupon');
//        return ['error' => 'شما قبلا از این کد تخفیف استفاده کرده اید'];
//    }


        if ($coupon->getRawOriginal('type') == 'amount') {
            session()->put('coupon', ['id' => $coupon->id, 'code' => $coupon->code, 'amount' => $coupon->amount]);
        } else {
            $total = calculateCartPrice()['sale_price'];

            $amount = (($total * $coupon->percentage) / 100) > $coupon->max_percentage_amount ? $coupon->max_percentage_amount : (($total * $coupon->percentage) / 100);

            session()->put('coupon', ['id' => $coupon->id, 'code' => $coupon->code, 'amount' => $amount]);
        }
        return ['success' => 'کد تخفیف برای شما اعمال شد'];
    }
}

if (!function_exists('province_name')) {
    function province_name($provinceId)
    {
        $province_exist = Province::where('id', $provinceId)->exists();
        if ($province_exist) {
            return Province::findOrFail($provinceId)->name;
        } else {
            return $provinceId;
        }
    }
}

if (!function_exists('city_name')) {
    function city_name($cityId)
    {
        $city_exists = City::where('id',$cityId)->exists();
        if ($city_exists){
            return City::findOrFail($cityId)->name;
        }else{
            return $cityId;
        }

    }
}

if (!function_exists('dayOfWeek')) {
    function dayOfWeek($day)
    {
        switch ($day) {
            case '0';
                $dayName = 'شنبه';
                break;
            case '1';
                $dayName = 'یکشنبه';
                break;
            case '2';
                $dayName = 'دوشنبه';
                break;
            case '3';
                $dayName = 'سه شنبه';
                break;
            case '4';
                $dayName = 'چهارشنبه';
                break;
            case '5';
                $dayName = 'پنج شنبه';
                break;
            case '6';
                $dayName = 'جمعه';
                break;
        }
        return $dayName;

    }
}

if (!function_exists('convert')) {
    function convert($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);

        return $convertedPersianNums;
    }
}

if (!function_exists('imageExist')) {
    function imageExist($env, $image)
    {
        $path = public_path($env . $image);

        if (file_exists($path) and !is_dir($path)) {
            $src = url($env . $image);
        } else {
            $src = url('no_image.png');
        }
        return $src;
    }
}

if (!function_exists('unlink_image_helper_function')) {
    function unlink_image_helper_function($path)
    {
        if (file_exists($path) and !is_dir($path)) {
            unlink($path);
        }
    }
}

if (!function_exists('product_price')) {
    function product_price($product_id, $product_attr_variation_id = null)
    {
        $user = auth()->user();
        if ($product_attr_variation_id != null) {
            $product_attr_variation = ProductAttrVariation::where('id', $product_attr_variation_id)->first();
            //محاسبه قیمت برای کاربران عادی

                $price = $product_attr_variation->price;
                $percent_sale = $product_attr_variation->percent_sale_price;
                $sale_price = calculateDiscount($price, $percent_sale);
                return [$price, $percent_sale, $sale_price];


        }

        $product = Product::where('id', $product_id)->first();
        if (($product->DateOnSaleTo > Carbon::now() && $product->DateOnSaleFrom < Carbon::now()) or ($product->has_discount == 1)) {

            //محاسبه قیمت برای کاربران عادی

            $price = $product->price;
            $percent_sale = $product->percent_sale_price;

            $sale_price = calculateDiscount($price, $percent_sale);
                return [$price, $percent_sale, $sale_price];


        } else {
            //محاسبه قیمت برای کاربران عادی

                $price = $product->price;
                $percent_sale = 0;
                $sale_price = calculateDiscount($price, $percent_sale);
                return [$price, $percent_sale, $sale_price];


        }

    }
}

if (!function_exists('product_price_for_user_normal')) {
    function product_price_for_user_normal($product_id, $product_attr_variation_id = null)
    {
        if ($product_attr_variation_id != null) {
            $product_attr_variation = ProductAttrVariation::where('id', $product_attr_variation_id)->first();
            //محاسبه قیمت برای کاربران عادی
            $price = round($product_attr_variation->price,-2);
            $percent_sale_price = $product_attr_variation->percent_sale_price;
            $sale_price = calculateDiscount($price, $percent_sale_price);
            return [$price, $percent_sale_price, round($sale_price,-1)];
        }

        $product = Product::where('id', $product_id)->first();
        if (($product->DateOnSaleTo > Carbon::now() && $product->DateOnSaleFrom < Carbon::now()) or ($product->has_discount == 1)) {
            //محاسبه قیمت برای کاربران عادی
            $price = round($product->price,-2);
            $percent_sale = $product->percent_sale_price;
            $sale_price = calculateDiscount($price, $percent_sale);
            return [$price, $percent_sale, round($sale_price,-1)];
        } else {
            //محاسبه قیمت برای کاربران عادی
            $price = $product->price;
            $percent_sale = 0;
            $sale_price = calculateDiscount($price, $percent_sale);
            return [$price, $percent_sale, $sale_price];
        }

    }
}
if (!function_exists('calculateDiscount')) {
    function calculateDiscount($price, $percent_sale)
    {
        return $price - ($price * $percent_sale / 100);
    }
}

if (!function_exists('calculateCartProductPrice')) {
    function calculateCartProductPrice($product_price, $product_options)
    {
        if ($product_options != null) {

            if(!is_array($product_options)){
                $product_options = json_decode($product_options);
            }


            foreach ($product_options as $product_option) {
                if(isset(ProductOption::where('id', $product_option)->first()->price)){
                                    $price_option = ProductOption::where('id', $product_option)->first()->price;
                }else{
                    $price_option = 0;
                }


                $product_price += $price_option;


            }

        }


        return $product_price;
    }
}

if (!function_exists('calculateCartPrice')) {
    function calculateCartPrice()
    {
        $user_id = auth()->id();
        $carts = Cart::where('user_id', $user_id)->get();
        $original_price = 0;
        $sale_price = 0;
        $tax = 0;
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
        foreach ($carts as $cart) {
            $original_price += calculateCartProductPrice(product_price_for_user_normal($cart->product_id, $cart->product_attr_variation_id)[0], $cart->option_ids) * $cart->quantity;
            $sale_price += calculateCartProductPrice(product_price_for_user_normal($cart->product_id, $cart->product_attr_variation_id)[2], $cart->option_ids) * $cart->quantity;
        }
        foreach ($carts as $cart) {
            if ($cart->product_has_tax == 1) {
                $tax += calculateCartProductPrice(product_price_for_user_normal($cart->product_id, $cart->product_attr_variation_id)[2], $cart->option_ids) * $cart->quantity*0.1;
            }
        }
        $total_sale = $original_price - $sale_price;
        $sale_price = $sale_price + $tax;
        return [
            'original_price' => $original_price,
            'sale_price' => $sale_price,
            'tax' => $tax,
            'total_sale' => $total_sale,
        ];
    }
}

if (!function_exists('summery_cart')) {
    function summery_cart()
    {
        //get user wallet
        $wallet_amount = 0;
        $use_wallet = 0;
        //calculate cart-summery options
        $original_price = calculateCartPrice()['original_price'];
        $total_sale = calculateCartPrice()['total_sale'];
        $sale_price = calculateCartPrice()['sale_price'];
        $tax = calculateCartPrice()['tax'];
        $coupon_amount = session()->get('coupon.amount');
        $delivery_price = session()->get('delivery_price');
        $total_amount = intval($sale_price) + intval($delivery_price) - intval($coupon_amount);
        $payment = $total_amount;
        $left_over_wallet = $wallet_amount;
        //if use wallet
        if (session()->exists('use_wallet')) {
            $use_wallet = session()->get('use_wallet');
        }
        if ($use_wallet != 0) {
            $wallet = Wallet::where('user_id', auth()->id())->first();
            if ($wallet != null) {
                $wallet_amount = $wallet->amount;
            }
            if ($total_amount > $wallet_amount or $total_amount == $wallet_amount) {
                $payment = $total_amount - $wallet_amount;
                $left_over_wallet = 0;
            } else {
                $payment = 0;
                $left_over_wallet = $wallet_amount - $total_amount;
            }
            $wallet_amount = $wallet_amount - $left_over_wallet;
        } else {
            $wallet = Wallet::where('user_id', auth()->id())->first();
            $wallet == null ? $left_over_wallet = 0 : $left_over_wallet = $wallet->amount;
        }
        return
            [
                'original_price' => $original_price,
                'total_sale' => $total_sale,
                'sale_price' => $sale_price,
                'coupon_amount' => $coupon_amount,
                'total_amount' => $total_amount,
                'payment' => $payment,
                'left_over_wallet' => $left_over_wallet,
                'delivery_price' => $delivery_price,
                'wallet_amount' => $wallet_amount,
                'tax' => $tax,
            ];
    }
}

if (!function_exists('discount_timer_creator')) {
    function discount_timer_creator($DateOnSaleTo)
    {
        $year = Carbon::createFromFormat('Y-m-d H:i:s', $DateOnSaleTo)->year;
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $DateOnSaleTo)->month;
        $day = Carbon::createFromFormat('Y-m-d H:i:s', $DateOnSaleTo)->day;
        $hour = Carbon::createFromFormat('Y-m-d H:i:s', $DateOnSaleTo)->hour;
        $minute = Carbon::createFromFormat('Y-m-d H:i:s', $DateOnSaleTo)->minute;
        $second = Carbon::createFromFormat('Y-m-d H:i:s', $DateOnSaleTo)->second;
        $data_until = $year . ', ' . $month . ', ' . $day;
        $data_labels_short = $day . ':' . $hour . ':' . $minute . ':' . $second;
        return [
            'data_until' => $data_until,
            'data_labels_short' => $data_labels_short,
        ];
    }
}

if (!function_exists('children_categories')) {
    function children_categories($category)
    {
        $category_ids = [];
        $ids = [];
        array_push($category_ids, $category->id);
        array_push($ids, $category->id);
        do {
            $categories = Category::whereIn('parent_id', $ids)->get();
            $ids = [];
            if (count($categories) > 0) {
                foreach ($categories as $cat) {
                    array_push($category_ids, $cat->id);
                    array_push($ids, $cat->id);
                }
            }
        } while (count($categories) > 0);
        return $category_ids;
    }
}

if (!function_exists('products_in_children_categories')) {
    function product_ids_in_children_categories($category_ids)
    {
        $product_category_ids = [];
        foreach ($category_ids as $category_id) {
            $Category = Category::find($category_id);
            $products_category = $Category->Products()->where('is_active', 1)->get();
            foreach ($products_category as $item) {
                array_push($product_category_ids, $item->id);
            }
        }
        return $product_category_ids;
    }
}

if (!function_exists('set_print_characters')) {
    function set_print_characters($content)
    {
        $content=str_replace([')','('],['%%%','***'],$content);
        $content=str_replace(['%%%','***'],['<span dir="ltr">(</span>','<span dir="ltr">)</span>'],$content);
        $content=str_replace(':','<span >:</span>',$content);
        return $content;
    }
}
function uploadImage($image,$env)
{
    $name = $image->getClientOriginalName();
    $file_name = pathinfo($name, PATHINFO_FILENAME);
    $fileNameImage = generateFileName($file_name.'.webp');
    $image->move(public_path($env), $fileNameImage);
    $path = public_path($env . $fileNameImage);
    $image = imagecreatefromstring(file_get_contents($path));
    $webpPath = $path ;
    // Save the image in WebP format
    imagewebp($image, $webpPath);
    imagedestroy($image);
    return $fileNameImage;
}
