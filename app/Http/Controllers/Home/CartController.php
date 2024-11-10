<?php

namespace App\Http\Controllers\Home;

use App\Models\Cart;
use App\Models\ProductAttrVariation;
use App\Models\ProductOption;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductColorVariation;

class CartController extends Controller
{
    public function index(Request $request)
    {
        if ($request->method() == 'GET') {
            if (auth()->check()) {
                $user = auth()->user();
                $carts = Cart::where('user_id', $user->id)->get();
                if (count($carts) == 0) {
                    alert()->error('سبد خرید شما خالی است', 'دقت کنید');
                    return redirect()->route('home.index');
                }
            } else {
                alert()->error('ابتدا باید وارد حساب کاربری خود شوید', 'متاسفیم');
                return redirect()->route('login');
            }
        }
        if (!auth()->check()) {
            session()->put('addToCart');
            $route = route('login');
            return \response()->json([0, 'login', $route]);
        }
        $user = \auth()->user();
        $carts = Cart::where('user_id', $user->id)->get();
        session()->forget('use_wallet');
        session()->forget('coupon');
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
        return view('home.cart', compact('carts'));
    }

    public function add(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::where('id', $product_id)->first();
        $alias = $product->alias;
        if (!auth()->check()) {
            // session()->put('add_to_cart_product_id', $request->product_id);
            $route = route('login');
            return \response()->json([0, 'login', $route]);
        }
        //sale_off for Category
        $categories = $product->Categories;
        if (count($categories)>0){
            foreach ($categories as $category) {
                if ($category->is_sale==0){
                    return response()->json([0, 'sale_off']);
                }
            }
        }
        //cant sale for legal
        $user=auth()->user();
        if($user->getRawOriginal('role')==3 and $product->sale_for_legal==0){
            return response()->json([0, 'sale_for_legal']);
        }
        if ($request->is_single_page == 0) {
            $exist_productVariation = ProductAttrVariation::where('product_id', $request->product_id)->exists();
            if ($exist_productVariation) {
                $route = route('home.product', ['alias' => $alias]);
                return response()->json(['has_attr', $route]);
            }
                        $exist_product_Variation = ProductColorVariation::where('product_id', $request->product_id)->exists();
            if ($exist_product_Variation) {
                $route = route('home.product', ['alias' => $alias]);
                return response()->json(['has_attr', $route]);
            }
            $exist_product_option = ProductOption::where('product_id', $request->product_id)->exists();
            
            if ($exist_product_option) {
                $product_options = ProductOption::where('product_id', $request->product_id)->get();
               
               foreach ($product_options as $product_option){
                   if ($product_option->VariationName->limit_select==1){
                       $route = route('home.product', ['alias' => $alias]);
                       return response()->json(['has_option', $route]);
                   }
               }
            }
        }
        $variation_id = $request->variation_id;
        $color_id = $request->color_id;
        $product_has_variation = $request->product_has_variation;
        $option_ids = json_encode($request->option_ids);
        if ($request->option_ids == null) {
            $option_ids = null;
        }
        $product_price = product_price_for_user_normal($product_id)[2];
        if ($product_price == 0) {
            return response()->json([0, 'price_error']);
        }
        $user_id = auth()->id();
        $product_exist_in_cart = Cart::where('product_id', $product_id)
            ->where('variation_id', $variation_id)
            ->where('color_id', $color_id)
            ->where('option_ids', $option_ids)
            ->where('user_id', $user_id)->first();
        if ($product_exist_in_cart == null) {
            //create cart
            $check_product_quantity = parent::check_product_quantity($product_id, $product_has_variation, $variation_id, $color_id, $request->quantity);
            if (!$check_product_quantity[0]) {
                return response()->json([0, 'quantity']);
            }
            $product = Product::find($request->product_id);
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'variation_id' => $variation_id,
                'color_id' => $color_id,
                'option_ids' => $option_ids,
                'product_has_tax' => $product->tax,
            ]);
            if (session()->exists('coupon.code')) {
                checkCoupon(session()->get('coupon.code'));
            }
            return response()->json([1, 'ok']);
        }
        if ($product_exist_in_cart != null) {
            //update cart
            $quantity = $product_exist_in_cart->quantity + $request->quantity;
            $check_product_quantity = parent::check_product_quantity($product_id, $product_has_variation, $variation_id, $color_id, $quantity);
            if (!$check_product_quantity[0]) {
                return response()->json([0, 'quantity']);
            }
            $product_exist_in_cart->update([
                'quantity' => $quantity
            ]);
            if (session()->exists('coupon.code')) {
                checkCoupon(session()->get('coupon.code'));
            }
            return response()->json([1, 'ok']);
        }
    }

    public function update(Request $request)
    {
        $cart = Cart::where('id', $request->cart_id)->first();
        $product_id = $cart->product_id;
        $variation_id = $cart->variation_id;
        $color_id = $cart->color_id;
        $quantity = $request->quantity;
        if ($quantity == 0) {
            $cart->delete();
        }
        $variation_exists = ProductAttrVariation::where('product_id', $product_id)
            ->where('attr_value', $variation_id)
            ->where('color_attr_value', $color_id)->exists();
        if ($variation_exists) {
            $product_has_variation = 1;
        } else {
            $product_has_variation = 0;
        }

        $check_product_quantity = parent::check_product_quantity($product_id, $product_has_variation, $variation_id, $color_id, $quantity);
        if (!$check_product_quantity[0]) {
            return response()->json([0, $check_product_quantity[1]]);
        }
        $cart->update([
            'quantity' => $request->quantity
        ]);
        if (session()->exists('coupon.code')) {
            checkCoupon(session()->get('coupon.code'));
        }
        return response()->json([1, $check_product_quantity[1]]);

    }

    public function remove_cart(Request $request)
    {
        try {
            DB::beginTransaction();
            $cart_id = $request->cart_id;
            $user_id = auth()->id();
            $cart = Cart::where('id', $cart_id)
                ->where('user_id', $user_id)
                ->first();
            $cart->delete();
            DB::commit();
   $msg = 'محصول از سبد خرید حذف شد';
            return response()->json([1, $msg]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([0, $exception->getMessage()]);
        }

    }

    public function remove_carts()
    {
        try {
            DB::beginTransaction();
            $user = \auth()->user();
            Cart::where('user_id', $user->id)->delete();
            DB::commit();
            $msg = 'سبد خرید شما خالی شد';
            return response()->json([1, $msg]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([0, $exception->getMessage()]);
        }
    }

    public function get()
    {
        $productsInCart = '';
        $carts = Cart::where('user_id', auth()->id())->get();
        if ($carts != null) {
            foreach ($carts as $cart) {
                if (isset($cart->AttributeValues->name)) {
                    $attr_name = $cart->AttributeValues->name;
                } else {
                    $attr_name = '';
                }
                if (isset($cart->Color->name)) {
                    $color_name = $cart->Color->name;
                } else {
                    $color_name = '';
                }
                $options = '';
                if ($cart->option_ids != null) {
                    if (product_price_for_user_normal($cart->product_id, $cart->product_attr_variation_id)[1] != 0) {
                        $options .= '<br>';
                    }
                    foreach (json_decode($cart->option_ids) as $option) {

                        $options .= '<br>' . ProductOption::where('id', $option)->first()->VariationValue->name;
                    }
                }
               
                $product_attr_variation = ProductAttrVariation::where('product_id', $cart->product_id)
                    ->where('attr_value', $cart->variation_id)
                    ->where('color_attr_value', $cart->color_id)->first();
                if (isset($product_attr_variation)) {
                    $product_attr_variation_id = $product_attr_variation->id;
                } else {
                    $product_attr_variation_id = null;
                }
                if (calculateCartProductPrice(product_price_for_user_normal($cart->product_id, $product_attr_variation_id)[1], json_decode($cart->option_ids)) == 0) {
                    $del = '';
                } else {
                    if(!$cart->option_ids){
     
                    
                    $del = '<div class="mr-2"><del class="products_old_price">' . number_format(calculateCartProductPrice(product_price_for_user_normal($cart->product_id, $product_attr_variation_id)[0], json_decode($cart->option_ids))) . 'تومان </del></div>';
               
                    } else{
               
                        $del = '';
                    }
                    
                }
                $productsInCart .= '<div class="product product-cart">
                                        <div class="product-detail">
                                            <td class="product-name">
                                                <a href="' . route('home.product', ['alias' => $cart->Product->alias]) . '">
                                                    ' . $cart->Product->name . '
                                                    <br>
                                                    ' . $attr_name . '
                                                    <br>
                                                     ' . $color_name . '
                                                    <br>
                                                     ' . $options . '
                                                </a>
                                            </td>
                                            ' . $del . '
                                            <div class="price-box">
                                                <span class="product-quantity">' . $cart->quantity . '</span>
                                                <span class="product-price">
                                                    ' . number_format(calculateCartProductPrice(product_price_for_user_normal($cart->product_id, $product_attr_variation_id)[2], json_decode($cart->option_ids))) . '
                                          تومان
                                          </span>
                                            </div>
                                        </div>
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img
                                                    src="' . imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'), $cart->Product->primary_image) . '"
                                                    alt="product"
                                                    height="84"
                                                    width="94"/>
                                            </a>
                                        </figure>
                                        <button onclick="cart_side_bar(' . $cart->id . ')" class="btn btn-link btn-close" aria-label="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>';
            }
        }
        $count = Cart::where('user_id', auth()->id())->count();
        $cartTotal = '<label>مجموع + ارزش افزوده: </label>
                            <span class="price">
                            ' . number_format(calculateCartPrice()['sale_price'] - session()->get('coupon.amount')) . ' تومان
</span>';
        return \response()->json(['ok', $cartTotal, $count, $productsInCart]);
    }

    public function checkCartAjax()
    {
        $check = parent::checkCart();
        if (array_key_exists('success', $check)) {
            return response()->json([1]);
        }
        return response()->json([0, $check['error']]);
    }
}
