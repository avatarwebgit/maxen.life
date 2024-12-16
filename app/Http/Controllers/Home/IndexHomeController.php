<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\AnimationBanner;
use App\Models\Article;
use App\Models\ArticleCategoriy;
use App\Models\Attribute;
use App\Models\AttributeGroup;
use App\Models\AttributeValues;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommentIndex;
use App\Models\DeliveryMethod;
use App\Models\DeliveryMethodAmount;
use App\Models\FunctionalTypes;
use App\Models\JAttrGroup;
use App\Models\JAttrValues;
use App\Models\JCategory;
use App\Models\JExtraField;
use App\Models\JExtraFieldValue;
use App\Models\JProduct;
use App\Models\JProductAttr;
use App\Models\JProductCategory;
use App\Models\JProductsImages;
use App\Models\JUser;
use App\Models\Khabarname;
use App\Models\News;
use App\Models\Offer;
use App\Models\Order;
use App\Models\PaymentMethods;
use App\Models\Product;
use App\Models\Page;
use App\Models\ProductAttribute;
use App\Models\ProductAttrVariation;
use App\Models\ProductColorVariation;
use App\Models\ProductImage;
use App\Models\ProductOption;
use App\Models\ProductVariation;
use App\Models\Province;
use App\Models\Section;
use App\Models\Slider;
use App\Models\User;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\InsuranceModel;


class IndexHomeController extends Controller
{
    public function __construct()
    {
        $this->visit_insurance();
    }
    public function LoginAdmin(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // گرفتن یوزرنیم و پسورد از درخواست
        $username = $request->input('username');
        $password = $request->input('password');

        // پیدا کردن کاربر با یوزرنیم
        $user = User::where('user_name', $username)->first();
        // $user->update([
        //     'password'=>Hash::make('pYb5o9$!9<4v')
        //     ]);
        if($user != null and isset($user)){
            if($user->role != 1){
                return redirect()->back()->with('error', 'یوزرنیم یا پسورد اشتباه است!');
            }

            // بررسی صحت یوزرنیم و پسورد
            if ($user && Hash::check($password, $user->password)) {
                // پسورد صحیح است، ورود موفقیت‌آمیز
                Auth::login($user);

                alert()->success('شما با موفقیت لاگین شده اید');
                return redirect()->route('admin.dashboard')->with('success', 'ورود با موفقیت انجام شد!');
            } else {
                // اگر یوزرنیم یا پسورد اشتباه است
                return redirect()->back()->with('error', 'یوزرنیم یا پسورد اشتباه است!');
            }
        }else{
            return redirect()->back()->with('error', 'یوزرنیم یا پسورد اشتباه است!');
        }

    }

    public function insuranceResult(Request $request){
        try {
            $start = convertShamsiToGregorianDate($request->start_date);
            $end = convertShamsiToGregorianDate($request->end_date);

            $insurances = InsuranceModel::where('date', '>=', $start)->where('date', '<=', $end)->get();
            $total_visits=0;
            foreach ($insurances as $insurance){
                $total_visits=$total_visits+$insurance->total_visits;
            }
            $msg='تعداد نفرات بازدید برای تاریخ وارد شده برابر است یا '.$total_visits.' نفر';
            return response()->json([1,$msg]);
        }catch (\Exception $e){
            return response()->json([0,$e->getMessage()]);
        }
    }



    public function index()
    {
        $sliders = Slider::all();
        $banners = Banner::where('position',0)->get();
        $banners_bottom = Banner::where('position',1)->get();

        $news = News::all();
        $lang = app()->getLocale();
        $brands = Brand::all();
        $product_has_sale = Product::where('is_active', 1)
            ->where('quantity', '>', 0)
            ->where('has_discount', 1)
            ->where('percent_sale_price', '>', 0)
            ->inRandomOrder()
            ->get();
        $product_has_sale_showIndex = Product::where('is_active', 1)
            ->where('quantity', '>', 0)
            ->where('showOnIndex', 1)
            ->where('percent_sale_price', '>', 0)
            ->where('DateOnSaleTo', '>', Carbon::now())
            ->where('DateOnSaleFrom', '<', Carbon::now())
            ->inRandomOrder()
            ->get();
        $articles = Article::inRandomOrder()->take(4)->get();
        //جدیدترین محصولات
        $products_new = Product::where('quantity', '>', 0)
            ->where('Set_as_new', 1)
            ->where('is_active', 1)
            ->orderby('created_at', 'desc')
            ->take(10)
            ->get();
        //فروش ویژه
        $products_special_sale = Product::where('quantity', '>', 0)
            ->where('is_active', 1)
            ->where('specialSale', 1)
            ->where('price', '>', 0)
            ->take(9)
            ->inRandomOrder()
            ->get()
            ->chunk(3);
        $products_hit = Product::where('quantity', '>', 0)
            ->where('is_active', 1)
            ->where('price','>',0)
            ->orderby('hit','desc')
            ->take(10)
            ->get();
        $animation_banner = AnimationBanner::first();
        $active_categories = Category::where('showOnIndex', 1)->orderby('priority', 'asc')->get();
        $types = FunctionalTypes::orderby('priority', 'asc')->get();
        $sections = Section::all();
        return view('home.index', compact('sliders',
            'brands',
            'articles',
            'news',
            'lang',
            'product_has_sale',
            'products_new',
            'products_special_sale',
            'product_has_sale_showIndex',
            'animation_banner',
            'banners',
             'banners_bottom',
            'active_categories',
            'products_hit',
            'types',
            'sections',
        ));
    }


    public function fa()
    {

             App::setLocale('fa');
          session()->put('locale', 'fa');
             return redirect()->back();

    }

    public function en()
    {
        App::setLocale('en');
        session()->put('locale', 'en');
        return redirect()->back();
    }
    public function cashPage(Order $order)
    {
        $payment=PaymentMethods::where('id',9)->first();
        return view('home.cash_page',compact('order','payment'));
    }

    public function categories()
    {
        $categories = Category::where('is_active', 1)->paginate(12);
        return view('home.categories', compact('categories'));
    }

    public function getCategoryChild($parent)
    {
        return Category::where('parent_id', $parent)->get();
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home.index');
    }

    public function redirects()
    {
        if (!\auth()->check()) {
            return redirect()->route('login');
        }

            if(\auth()->check() and \auth()->user()->is_active == 0){


            \auth()->logout();
                alert()->error('حساب کاربری شما مسدود شده است');
            return redirect()->route('home.index');
        }
        $user = auth()->user();
        $cellphone = $user->cellphone;
        if ($cellphone == null) {
            $email = $user->email;
            \auth()->logout();
            return view('auth.confirmMobile', compact('email'));
        } else {
            if (\session()->has('add_to_cart_product_id')){
                $alias=Product::where('id',session('add_to_cart_product_id'))->first()->alias;
                // alert()->success('لطفا محصول را مجدد به سبد خرید اضافه کنید','به پروفیل سازه خوش آمدید')->autoclose(5000);
                \session()->forget('add_to_cart_product_id');
                return redirect()->route('home.product',['alias'=>$alias]);
            }
            if (session()->has('comment_login')) {
                $alias = Product::where('id', session('comment_login'))->first()->alias;
                alert()->success('شما می توانید دیدگاه خود را در خصوص این محصول درج نمایید.')->autoclose(5000);
                \session()->forget('comment_login');
                return redirect()->route('home.product', ['alias' => $alias]);
            }
            $role = $user->getRawOriginal('role');
            if ($role != 1) {
                return redirect()->route('home.orders.users_profile.index');
            } elseif ($role == 1) {
                return redirect()->route('dashboard');
            }
        }
    }
    public function comment_login(Request $request)
    {


        session()->put('comment_login', $request->product_id);
        $route = route('login');
        return \response()->json([0, 'login', $route]);

    }
    //khabarName
    public function AddEmailNews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:Khabarname|email',
        ]);

        if ($validator->fails()) {
            return response()->json('error');
        }

        Khabarname::create([
            'email' => $request->email,
        ]);
        return response()->json('ok');

    }
    //get product Info
    public function getProductInfo(Request $request)
    {
        $productID = $request->productID;
        $product = Product::where('id', $productID)->first()->load('images');;
        //rate
        $rate = ceil($product->rates->where('product_id', $product->id)->avg('rate'));
        //price
        if ($product->percentSalePrice != 0 && $product->DateOnSaleTo > Carbon::now() && $product->DateOnSaleFrom < Carbon::now()) {
            $price = '<div class="product_price float-left mr-3"><del class="price text-dark">' . number_format($product->price) . ' تومان</del></div><div class="product_price float-left"><span class="price">' . number_format($product->salePrice) . ' تومان</span></div>';
        } else {
            $price = '<div class="product_price float-left"><span class="price">' . number_format($product->price) . ' تومان</span></div>';
        }
        if ($rate == 0) {
            $class = 'text-left emptyStar';
        } else {
            $class = 'text-left';
        }
        //wishlistIcon
        if (Auth::check()) {
            if ($product->checkUserWishlist(auth()->id())) {
                $heart = '<a class="add_wishlist bg-red" onclick="RemoveFromWishList(this,event,' . $product->id . ')" href="#"><i class="ti-heart"></i></a>';
            } else {
                $heart = '<a class="add_wishlist" onclick="AddToWishList(this,event,' . $product->id . ')" href="#"><i class="ti-heart"></i></a>';
            }
        } else {
            $heart = '<a class="add_wishlist bg-red" onclick="RemoveFromWishList(this,event,' . $product->id . ')" href="#"><i class="ti-heart"></i></a>';
        }


        return response()->json([$product, $rate, $price, $heart, $class]);
    }

    public function blogs()
    {
        $blogs = Article::latest()->paginate(12);
        $categories = ArticleCategoriy::all();
        return view('home.blogs', compact('blogs', 'categories'));
    }

    public function articles_category_sort($cat)
    {
        $cat = ArticleCategoriy::where('alias', $cat)->first();
        $articles = Article::where('category_id', $cat->id)->latest()->paginate(12);
        $categories = ArticleCategoriy::all();
        return view('home.articles', compact('articles', 'categories', 'cat'));
    }

    public function blog($alias)
    {
        $blog = Article::where('alias', $alias)->first();
        $categories = ArticleCategoriy::all();
        return view('home.blog', compact('blog', 'categories'));
    }

    public function variation_getPrice(Request $request)
    {
        $variation_ids = $request->attr_ids;
        $total_price = 0;
        $titles = [];
        if ($variation_ids != null) {
            foreach ($variation_ids as $variation_id) {
                $variation = ProductOption::where('id', $variation_id)->first();
                $total_price = $total_price + $variation->price;
                array_push($titles, $variation->VariationValue->name);
            }
        }
        return response()->json([1, $total_price, $titles]);
    }

    public function page(Page $page)
    {
        return view('home.page', compact('page'));
    }
    public function check_order(Request $request){
        $order_number=$request->order_number;
        $order_number=explode('-',$order_number);
        if (count($order_number)===2){
            $key=$order_number[1];
        }else{
            $key=$request->order_number;
        }
        $order_exist=Order::where('order_number',$key)->exists();
        if ($order_exist){
            $order=Order::where('order_number',$key)->first();
            $status=$order->DeliveryMethodStatus->title;
            $msg='<span> وضعیت سفارش: '.$status.'</span>';
            if ($order->TrackingCode!=null){
                $tracking_code='<span> شماره رهگیری پست : '.$order->TrackingCode.'</span>';
                $msg=$msg.'<br>'.$tracking_code;
            }
            return response()->json([1,$msg]);
        }
        $msg='<span>سفارشی یافت نشد</span>';
        return response()->json([1,$msg]);
    }

    public function join_news(Request $request)
{

    $request->validate([
        'email'=>'required|email'
    ]);
    $email = DB::table('news_email')->where('email', $request->email)->exists();
    if($email){
alert()->error('شما قبلا در خبرنامه مکسن عضو شده اید');

return redirect()->back();
    }
    DB::table('news_email')->insert(['email'=>$request->email]);

    alert()->success('عضویت شما در خبرنامه مکسن انجام شد.');
    return redirect()->back();


}
}
