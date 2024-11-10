<?php
$brands = \App\Models\Brand::all()
?>

<style>
    .img-thumbnail {
        width: 80px;
    }
    #order_status_header_mobile {
        position: fixed;
        top: 200px;
        left: 16px;
        background-color: #6a91aa !important;
        text-align: center;
        z-index: 99999999999999999999;
        padding: 11px;
        display: none;
        color: white;
    }
    @media only screen and (min-width: 725px) {
        #order_status_header_mobile{
            right: 338px;
        }

    }
    .btn-cart-color{
        background-color:#6a91aa;border-color:#6a91aa
    }
    .header-right-2{

        color: #fff;

    }

    @media only screen and (min-width: 711px) {
        #login-bag{
            display: none;
        }
        .divider-login{
            display: none;
        }

    }
    .dropdown{
        margin-left: 28px !important;
        margin-bottom: -4px;
    }
    #login-des{
        margin-right: 22px;
    }
    @media only screen and (max-width: 711px) {
        #login-des{
            display: none !important;
        }
        .wishlist{
            display: none;
        }
        .compare-des{
            display: none !important;
        }

    }
    #check_order_status_btn_mobile i{
        font-size: 21px;
        vertical-align: -6px;
        color: #000;
    }

    .search-header-mobile{
        font-size: 1.9rem;
        line-height: 1;
        letter-spacing: -0.01em;
        font-weight: 500;
        cursor: pointer;
        vertical-align: -5px;
    }
    @media only screen and (min-width: 996px){
        .search-header-mobile{
            display: none;
        }
        .order-tracking{
            display: none;
        }
        #order_status_header_mobile{
            display: none;
        }
    }
    @media only screen and (max-width: 996px){
        .search-header-mobile{

            margin-left: -31px;

        }
        .header-middle{
            position: sticky;
            top: 40px;
            z-index: 9999;
        }
    }
    .search-header-mobile-box{
        margin-top: 20px;
        background-color: #fff;
        margin-bottom: 20px;
        border: 2px solid #5c8097;
        border-radius: 24px;
        color: black;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        min-width: 40px;
        font-size: 1.4rem;

        display: none;


        transition: all .3s ease;

    }
    @media only screen and (min-width:996px) {
        .search-header-mobile-box{
            display: none;
        }
        #check_order_status_input_mobile{
            display: none;
        }
    }
    #check_order_status_input_mobile{
        color: #000;
        display: none;
        background-color: #fff;
        /* border: 1px solid; */
        border: 2px solid #5c8097;
        border-radius: 24px;
        margin-right: auto;
        margin-left: auto;
        margin-top: 10px;
        margin-bottom: 10px;
    }

</style>
<header  class="header header-border">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">
                    {{ $setting->message }}
                </p>
            </div>
            <div class="header-right">
                {{--<a style="color: #ededed;" href="{{ asset('home/ajax/login.html') }}" class="d-lg-show login sign-in"><i
                        class="w-icon-instagram"></i></a>--}}
                <!-- End of Dropdown Menu -->
                <span class="divider divider-login d-lg-show"></span>
                {{--<a style="color: #ededed;" href="{{ route('home.articles') }}" class="d-lg-show">بلاگ </a>
                <a style="color: #ededed;" href="{{ route('home.contact') }}" class="d-lg-show">تماس با ما </a>--}}
                @auth
                    <?php
                    $user = auth()->user();
                    $name = $user->cellphone;
                    ?>
                    <a id="login-bag" class="text-white" href="{{ route('login') }}">
                        <i class="w-icon-account"></i>
                        {{$name}}
                        <br>
                        حساب کاربری
                    </a>
                @else
                    <a id="login-bag" class="text-white" href="{{ route('login') }}">
                        <i class="w-icon-account"></i>ورود | ثبت نام
                    </a>
                @endif
            </div>
        </div>
    </div>
    <!-- End of Header Top -->
    <div  class="header-middle fix-header ">
        <div class="container">
            <div class="header-left mr-md-4">
                <a class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                </a>
                <?php
                $setting = \App\Models\Setting::first();
                ?>
                <a href="{{ route('home.index') }}" class="logo ml-lg-0">
                    <img src="{{ imageExist(env('LOGO_UPLOAD_PATH'),$setting->image) }}" alt="logo" width="144"
                         height="87"/>
                </a>
                <nav class="main-nav">
                    <ul class="menu ">
                        <li class="{{ request()->is('/') ? 'active' : '' }}">
                            <a href="{{ route('home.index') }}">صفحه اصلی </a>
                        </li>


                        <li class="{{ request()->is('products/new') ? 'active' : '' }}">
                            <a href="{{ route('home.products.new') }}">محصولات جدید</a>

                        </li>
                        <li class="{{ request()->is('products/special') ? 'active' : '' }}">
                            <a href="{{ route('home.products.special') }}">فروش ویژه</a>
                        </li>
                        <!--<li class="{{ request()->is('products/discount') ? 'active' : '' }}">-->
                        <!--    <a href="{{ route('home.products.discount') }}">تخفیف ویژه</a>-->
                        <!--</li>-->
                        <!--<li class="{{ request()->is('products/brands') ? 'active' : '' }}">-->
                        <!--    <a href="{{ route('home.brands') }}">برند ها</a>-->
                        <!--</li>-->
                        <li class="{{ request()->is('contact') ? 'active' : '' }}">
                            <a href="{{ route('home.contact') }}">تماس با پروفیل سازه</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-right ml-4">

                <a id="check_order_status_btn_mobile" class="order-tracking" ><i
                        class="w-icon-map-marker mr-1"></i>
                </a>
                <a>
                    <i class="w-icon-search search-header-mobile"></i>
                </a>
                <div class="account align-items-center d-sm-show">
                    @auth
                        <?php
                        $user = auth()->user();
                        $name = $user->first_name;

                        ?>


                        <a id="login-des" class="login inline-type d-flex ls-normal" href="{{ route('login') }}">
                            <i class="w-icon-account d-flex align-items-center justify-content-center br-50"></i>
                            <span class="d-flex flex-column justify-content-center ml-3 d-xl-show">
                                {{ $user->cellphone }}
                                    <b class="d-block font-weight-bold ls-25">
                                        حساب کاربری
                        </b>
                                </span>
                        </a>
                    @else

                        <a id="login-des" class="login inline-type d-flex ls-normal" href="{{ route('login') }}">
                            <i class="w-icon-account d-flex align-items-center justify-content-center br-50"></i>
                            <span class="d-flex flex-column justify-content-center ml-3 d-xl-show">ورود
                                    <b class="d-block font-weight-bold ls-25">حساب کاربری </b>
                                </span>
                        </a>
                    @endauth
                </div>
                <a title="علاقه مندی ها" class="wishlist label-down link d-xs-show" href="{{ route('home.wishlist.users_profile.index') }}">
                    <i class="w-icon-heart"></i>

                </a>
                {{--
                  <a class="compare label-down link d-xs-show" href="{{ route('home.profile.wallet.index') }}">
                      <i class="w-icon-wallet2"></i>
                      <span class="compare-label d-lg-show">کیف پول من </span>
                  </a>
                --}}
                <div
                    class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2 @if(!request()->is('product-compare/index')) compare-dropdown @endif">
                    <div class="cart-overlay"></div>
                    <a title="مقایسه محصولات" class="label-down link compare-des">
                        <i class="w-icon-compare">
                            <span
                                id="compare_count">{{ session()->exists('compareProducts') ? count(session()->get('compareProducts')) : '0' }}</span>
                        </i>

                    </a>
                    @if(!request()->is('product-compare/index'))
                        <div class="dropdown-box">
                            <div class="cart-header">
                                <span>لیست مقایسه</span>
                            </div>
                                <?php
                                if (session()->exists('compareProducts')) {
                                    $ids = session()->get('compareProducts');
                                    $compare_list = \App\Models\Product::findOrFail($ids);
                                } else {
                                    $compare_list = null;
                                }
                                ?>
                            <div id="Compare_Items" class="products">
                                @if($compare_list!=null)
                                    @foreach($compare_list as $product)
                                        <div class="product product-cart">
                                            <div class="product-detail">
                                                <td class="product-name">
                                                    <a href="{{ route('home.product',['alias'=>$product->alias]) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </td>
                                            </div>
                                            <figure class="product-media">
                                                <a href="{{ route('home.product',['alias'=>$product->alias]) }}">
                                                    <img
                                                        src="{{ imageExist(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH'),$product->primary_image) }}"
                                                        alt="product"
                                                        height="84"
                                                        width="94"/>
                                                </a>
                                            </figure>
                                            <button type="button" onclick="compare_side_bar({{ $product->id }})"
                                                    class="btn btn-link btn-close" aria-label="button">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="cart-action">
                                <a style="width:100%" href="{{ route('home.compare') }}" class="btn btn-primary  btn-rounded">مشاهده لیست
                                    مقایسه</a>
                            </div>
                        </div>
                    @endif
                    <!-- End of Dropdown Box -->
                </div>
                @auth
                    <?php
                    $carts = \App\Models\Cart::where('user_id', auth()->id())->get();


                    foreach ($carts as $cart) {
                        $product_attr_variation = \App\Models\ProductAttrVariation::where('product_id', $cart->product_id)
                            ->where('attr_value', $cart->variation_id)
                            ->where('color_attr_value', $cart->color_id)
                            ->first();
                        if ($product_attr_variation != null) {
                            $product_attr_variation_id = $product_attr_variation->id;
                            $cart['product_attr_variation_id'] = $product_attr_variation_id;
                        }
                        // $option_ids = json_decode($cart->option_ids);
                        // $cart['option_ids'] = $option_ids;
                    }

                    ?>

                @else
                    <?php
                    $carts = [];
                    ?>
                @endauth
                <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                    <div class="cart-overlay"></div>
                    <a  title="سبد خرید" href="{{ route('home.cart') }}" class="cart-toggle label-down link">
                        <i class="w-icon-cart">
                            <span class="cart-count">{{ count($carts) }}</span>
                        </i>

                    </a>
                    <div class="dropdown-box">
                        <div class="cart-header">
                            <span>سبد خرید </span>
                        </div>

                        <div id="CartItems" class="products">
                            @if($carts!=null)
                                @foreach($carts as $cart)

                                    @php
                                        $product_attr_variation=\App\Models\ProductAttrVariation::where('product_id',$cart->product_id)
                                       ->where('attr_value',$cart->variation_id)
                                       ->where('color_attr_value',$cart->color_id)->first();
                                          if (isset($product_attr_variation)){
                                            $product_attr_variation_id=$product_attr_variation->id;
                                        }else{
                                            $product_attr_variation_id=null;
                                        }
                                    @endphp

                                    <div class="product product-cart">
                                        <div class="product-detail">
                                            <td class="product-name">
                                                @php
                                                    $options = ' ';

                                                @endphp

                                                @if($cart->option_ids != null)
                                                    @if(product_price_for_user_normal($cart->product_id, $cart->product_attr_variation_id)[1] != 0)
                                                        @php

                                                            $options .= '<br>';

                                                        @endphp
                                                    @endif
                                                    @foreach(json_decode($cart->option_ids) as $option)
                                                        @php

                                                            if(isset(\App\Models\ProductOption::where('id', $option)->first()->VariationValue->name)){

                                                                 $options .=  \App\Models\ProductOption::where('id', $option)->first()->VariationValue->name;
                                                            }else{
                                                                continue;
                                                            }



                                                        @endphp

                                                    @endforeach
                                                @endif
                                                <a href="{{ route('home.product',['alias'=>$cart->Product->alias]) }}">
                                                    {{ $cart->Product->name }}
                                                    <br>
                                                    {{ isset($cart->AttributeValues->name) ? $cart->AttributeValues->name : '' }}
                                                    <br>
                                                    {{ isset($cart->Color->name) ? $cart->Color->name : '' }}
                                                    <br>
                                                    {{$options}}
                                                </a>
                                            </td>



                                            @if(calculateCartProductPrice(product_price_for_user_normal($cart->product_id, $product_attr_variation_id)[1], json_decode($cart->option_ids)) == 0)

                                                <div class="mr-2"></div>
                                            @else
                                                @if(!$cart->option_ids)

                                                    <div class="mr-2">
                                                        <del class="products_old_price">
                                                            {{ number_format(calculateCartProductPrice(product_price_for_user_normal($cart->product_id,$product_attr_variation_id)[0],$cart->option_ids)) }}
                                                        </del>
                                                    </div>
                                                @endif
                                            @endif

                                            <div class="price-box">
                                                <span class="product-quantity">{{ $cart->quantity }}</span>
                                                <span class="product-price">
                                                    {{ number_format(calculateCartProductPrice(product_price_for_user_normal($cart->product_id,$product_attr_variation_id)[2],$cart->option_ids)) }}
                                          تومان
                                                </span>
                                            </div>
                                        </div>
                                        <figure class="product-media">
                                            <a href="{{ route('home.product',['alias'=>$cart->Product->alias]) }}">
                                                <img
                                                    src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$cart->Product->primary_image) }}"
                                                    alt="product"
                                                    height="84"
                                                    width="94"/>
                                            </a>
                                        </figure>
                                        <button type="button" onclick="cart_side_bar({{ $cart->id }})"
                                                class="btn btn-link btn-close" aria-label="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="cart-total">

                                <label>مجموع + ارزش افزوده: </label>
                        
                            <span class="price">{{ number_format(calculateCartPrice()['sale_price']- session()->get('coupon.amount')) }} تومان</span>
                        </div>

                        <div class="cart-action">
                            <a href="{{ route('home.cart') }}"  class="btn text-white btn-blue btn-cart-color  btn-outline btn-rounded">سبد
                                خرید </a>
                            <a href="{{ route('home.checkout') }}" class="btn btn-gold btn-primary  btn-rounded">انتخاب آدرس </a>
                        </div>
                    </div>
                    <!-- End of Dropdown Box -->
                </div>

            </div>
        </div>
    </div>
    <!-- End of Header Middle -->

    <div class="header-bottom sticky-content fix-top sticky-header">

        <div class="container">
            <div class="inner-wrap justify-content-between">
                <div class="header-left flex-1">
                    <div class="dropdown category-dropdown has-border"
                         data-visible="true">
                        <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="true" data-display="static"
                           >
                            <i class="w-icon-category"></i>
                            <span>دسته بندی محصولات</span>
                        </a>
                        <?php
                        $categories = \App\Models\Category::where('parent_id', 0)->where('is_active',1)->orderby('priority','asc')->get();
                        ?>
                        <div class="dropdown-box mt-0">
                            <ul class="menu vertical-menu category-menu">
                                <?php
                                $user=auth()->user();
                                ?>
                                @foreach($categories as $cat)
                                    @if($cat->id!=30)
                                            <?php
                                            $children_categories = \App\Models\Category::where('parent_id', $cat->id)->where('is_active',1)->orderby('priority','asc')->get();
                                            ?>
                                        @if(count($children_categories)>0)
                                            <li>
                                                <a href="{{ route('home.product_categories',['category'=>$cat->alias]) }}">
                                                    @if($cat->icon!=null)
                                                        <i class="{{ $cat->icon }}"></i>
                                                    @endif
                                                    {{ $cat->name }}
                                                </a>
                                                <ul class="megamenu">
                                                    <li>
                                                        <ul>
                                                            @foreach($children_categories as $item)
                                                                <li>
                                                                    <a href="{{ route('home.product_categories',['category'=>$item->alias]) }}">{{ $item->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('home.product_categories',['category'=>$cat->alias]) }}">
                                                    @if($cat->icon!=null)
                                                        <i class="{{ $cat->icon }}"></i>
                                                    @endif
                                                    {{ $cat->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach($categories as $cat)
                                    @if($cat->id==30 and isset($user) and $user->getRawOriginal('role')==3)
                                            <?php
                                            $children_categories = \App\Models\Category::where('parent_id', $cat->id)->where('is_active',1)->orderby('priority','asc')->get();
                                            ?>
                                        @if(count($children_categories)>0)
                                            <li>
                                                <a href="{{ route('home.product_categories',['category'=>$cat->alias]) }}">
                                                    @if($cat->icon!=null)
                                                        <i class="{{ $cat->icon }}"></i>
                                                    @endif
                                                    {{ $cat->name }}
                                                </a>
                                                <ul class="megamenu">
                                                    <li>
                                                        <ul>
                                                            @foreach($children_categories as $item)
                                                                <li>
                                                                    <a href="{{ route('home.product_categories',['category'=>$item->alias]) }}">{{ $item->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('home.product_categories',['category'=>$cat->alias]) }}">
                                                    @if($cat->icon!=null)
                                                        <i class="{{ $cat->icon }}"></i>
                                                    @endif
                                                    {{ $cat->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <form style="position: relative" method="get" action="{{ route('home.product.search') }}"
                          class="header-search hs-expanded hs-round bg-white br-xs d-md-flex input-wrapper mr-4 ml-4">
                        <div class="select-box">
                            <select id="brand" name="category" onchange="search_header()">
                                <option
                                    value="0" {{ isset($_GET['category']) ? ($_GET['category']==0 ? 'selected' : '') : '' }}>
                                    همه دسته بندی ها
                                </option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ isset($_GET['category']) ? ($_GET['category']==$category->id ? 'selected' : '') : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input autocomplete="off" id="search_input" onkeyup="search_header()" type="text"
                               class="form-control" name="search"
                               value="{{ $_GET['search']??'' }}" placeholder="جستجو در پروفیل سازه..." required/>
                        <button  class="btn btn-search" type="submit"><i  class="w-icon-search"></i>
                        </button>

                    </form>

                </div>
                <div  class="header-right header-right-2 position-relative">
                    <div class="d-flex align-items-center">
                        <i id="check_order_status_btn_icon" class="w-icon-map-marker mr-1"></i>
                        <a  id="check_order_status_btn" href="#" class="d-xl-show">پیگیری
                            سفارش </a>
                        <input autocomplete="off" onkeyup="search_status_order()"
                               id="check_order_status_input" class="form-control form-control-sm"
                               placeholder="شماره سفارش خود را وارد کنید">
                    </div>
                    <div id="order_status_header" >

                    </div>
                </div>

            </div>
            <!--<div id="divParent">-->
            <!--             <div id="product_search_box" class="mt-2">-->
            <!--             </div>-->
            <!--         </div>-->
        </div>
    </div>
</header>
<form style="position: relative" method="get" action="{{ route('home.product.search') }}">
    <input   id="search_input_mobile" onkeyup="search_header_mobile()" type="text" class="form-control search-header-mobile-box" name="search" autocomplete="off" placeholder="جستجو در پروفیل سازه..." required="">
</form>
<!--<div style="display: none" id="divParent_mobile">-->
<!--    <div id="product_search_box_mobile" class="mt-2">-->
<!--    </div>-->
<!--</div>-->

<input onkeyup="search_status_order_mobile()"
       id="check_order_status_input_mobile" class="form-control form-control-sm"
       placeholder="شماره سفارش خود را وارد کنید">
<div id="order_status_header_mobile">

</div>

