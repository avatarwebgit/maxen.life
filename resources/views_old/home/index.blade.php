@extends('home.layouts.index')

@section('title')
    {{ $setting['name'] }}
@endsection

@section('description')
{{ $setting->meta_des }}
@endsection

@section('keywords')
{{ $setting->meta_key }}
@endsection

@section('style')
    <style>
        .discount {
            display: flex;
            width: 60px;
            height: 60px;
            border-radius: 100%;
            color: white;
            text-align: center;
            background: #054605;
            vertical-align: middle;
            justify-content: center;
            align-items: center;
        }
     

        .old_price {
            font-size: 17px;
        }
       @media screen and (min-width:890px){
            .banner-no-mobile-1{
            background-image: url({{ imageExist(env('BANNER_IMAGES_UPLOAD_PATH'),$banners[4]->image) }});
                                background-color: #ebeced;
        }
         .banner-no-mobile-2{
          background-image: url({{ imageExist(env('BANNER_IMAGES_UPLOAD_PATH'),$banners[5]->image) }});
                                background-color: #ebeced;
        }
       }
       
       @media screen and (max-width:890px){
           .banner-no-mobile-1{
               background:none !important;
               min-height:0 !important;
                display:none;
           }
            .banner-no-mobile-2{
               background:none !important;
               min-height:0 !important;
               display:none;
           }
           .banner-no-mobile-3{
               display:none;
           }
       }
        .category-banner-wrapper{
                margin-top: -14px;
    margin-bottom: -36px;
        }
             @media screen and (max-width:768px) {
            .banner-fashion-img{
                transform: scale(1.3);
            }
            
        }
        
         .circle-price{
            width: 14px;
            height: 14px;
            display: inline-block;
            background-color: #000;
            border-radius: 50%;
        }
        .product-countdown{
            border: none;
            direction: ltr;

            text-align: left;
        }

        .product-countdown span{
            color: #000000 !important;
            font-size: 25px !important;
        }
        .day-countdown{
            font-size: 13px;
            color: #6E6E6E;
            position: relative;
            bottom: 30px;
            padding-left:13px;
        }
        .day-countdown div{
            margin-left: 19px;
        }
                #quantity{
            border: none !important;
            font-size: 18px;
            font-family: IRANSansfanum !important;

        }
        .product-qty-form.with-label{
            font-size: 21px;
            border: 1px solid black;
            padding: 6px;
            border-radius: 5px;
        }
     @media screen and (max-width:768px){
            .product-wrapper .product-name,.product-wrapper-1 .product-name{
            height:80px !important;
        }

     }
    </style>
@endsection

@section('script')
    <script>
            function change_quantity(type){
            let quantity = $('#quantity').val();
            if (type==1) {
                quantity = parseInt(quantity) + 1;
            }else {
                quantity = parseInt(quantity) -1;
            }
            if (quantity==0){
                quantity=1;
                $('#quantity').val(quantity);
            }else {
                $('#quantity').val(quantity);
            }


        }
        function ActiveCatNav(tag, cat_id) {
            $('.category-icon').removeClass('active');
            $(tag).addClass('active');
            $('.products_category').addClass('d-none');
            $('.cat_' + cat_id).removeClass('d-none');
        }
    </script>
@endsection

@section('content')

    <!-- Start of Main-->
    <main class="main">
        <section class="d-sm-none intro-section">
            <div
                class="swiper-container swiper-theme nav-inner pg-inner swiper-nav-lg animation-slider pg-xxl-hide nav-xxl-show nav-hide"
                data-swiper-options="{
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 8000,
                        'disableOnInteraction': false
                    }
                }">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slider)
                        <div onclick="window.location.href='{{ $slider->button_link }}'"
                             class="cursor-pointer swiper-slide banner banner-fixed intro-slide intro-slide1">
                            <img alt="{{$slider->title}}" style="width: 100%;height: auto" src="{{ imageExist( env('SLIDER_IMAGES_UPLOAD_PATH'),$slider->image ) }}">
                            {{--                            <div class="container">--}}
                            {{--                                <div class="banner-content y-50 text-right">--}}
                            {{--                                    <h5 class="banner-subtitle font-weight-normal text-default ls-50 lh-1 mb-2 slide-animate"--}}
                            {{--                                        data-animation-options="{--}}
                            {{--                                    'name': 'fadeInRightShorter',--}}
                            {{--                                    'duration': '1s',--}}
                            {{--                                    'delay': '.2s'--}}
                            {{--                                }">--}}
                            {{--                                        <span class="p-relative d-inline-block">{{ $slider->title }}</span>--}}
                            {{--                                    </h5>--}}
                            {{--                                    <p class="font-weight-normal text-default slide-animate" data-animation-options="{--}}
                            {{--                                    'name': 'fadeInRightShorter',--}}
                            {{--                                    'duration': '1s',--}}
                            {{--                                    'delay': '.6s'--}}
                            {{--                                }">--}}
                            {{--                                        {{ $slider->text }}--}}
                            {{--                                    </p>--}}

                            {{--                                    <a href="{{ $slider->button_link }}"--}}
                            {{--                                       class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"--}}
                            {{--                                       data-animation-options="{--}}
                            {{--                                    'name': 'fadeInRightShorter',--}}
                            {{--                                    'duration': '1s',--}}
                            {{--                                    'delay': '.8s'--}}
                            {{--                                }">اکنون بخرید <i class="w-icon-long-arrow-left"></i></a>--}}

                            {{--                                </div>--}}
                            {{--                                <!-- End of .banner-content -->--}}
                            {{--                            </div>--}}
                            <!-- End of .container -->
                        </div>
                    @endforeach
                    <!-- End of .intro-slide1 -->
                </div>
                <div class="swiper-pagination"></div>
                <button class="swiper-button-next"></button>
                <button class="swiper-button-prev"></button>
            </div>
            <!-- End of .swiper-container -->
        </section>
        <section class="d-md-none intro-section">
            <div
                class="swiper-container swiper-theme nav-inner pg-inner swiper-nav-lg animation-slider pg-xxl-hide nav-xxl-show nav-hide"
                data-swiper-options="{
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 8000,
                        'disableOnInteraction': false
                    }
                }">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slider)
                        <div onclick="window.location.href='{{ $slider->button_link }}'"
                             class="cursor-pointer swiper-slide banner banner-fixed intro-slide intro-slide1">
                            <img style="width: 100%;height: auto" src="{{ imageExist( env('SLIDER_IMAGES_UPLOAD_PATH'),$slider->image_2 ) }}">
                            {{--                            <div class="container">--}}
                            {{--                                <div class="banner-content y-50 text-right">--}}
                            {{--                                    <h5 class="banner-subtitle font-weight-normal text-default ls-50 lh-1 mb-2 slide-animate"--}}
                            {{--                                        data-animation-options="{--}}
                            {{--                                    'name': 'fadeInRightShorter',--}}
                            {{--                                    'duration': '1s',--}}
                            {{--                                    'delay': '.2s'--}}
                            {{--                                }">--}}
                            {{--                                        <span class="p-relative d-inline-block">{{ $slider->title }}</span>--}}
                            {{--                                    </h5>--}}
                            {{--                                    <p class="font-weight-normal text-default slide-animate" data-animation-options="{--}}
                            {{--                                    'name': 'fadeInRightShorter',--}}
                            {{--                                    'duration': '1s',--}}
                            {{--                                    'delay': '.6s'--}}
                            {{--                                }">--}}
                            {{--                                        {{ $slider->text }}--}}
                            {{--                                    </p>--}}

                            {{--                                    <a href="{{ $slider->button_link }}"--}}
                            {{--                                       class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"--}}
                            {{--                                       data-animation-options="{--}}
                            {{--                                    'name': 'fadeInRightShorter',--}}
                            {{--                                    'duration': '1s',--}}
                            {{--                                    'delay': '.8s'--}}
                            {{--                                }">اکنون بخرید <i class="w-icon-long-arrow-left"></i></a>--}}

                            {{--                                </div>--}}
                            {{--                                <!-- End of .banner-content -->--}}
                            {{--                            </div>--}}
                            <!-- End of .container -->
                        </div>
                    @endforeach
                    <!-- End of .intro-slide1 -->
                </div>
                <div class="swiper-pagination"></div>
                <button class="swiper-button-next"></button>
                <button class="swiper-button-prev"></button>
            </div>
            <!-- End of .swiper-container -->
        </section>
        <!-- End of .intro-section -->

        <div class="container">
            {{--
            <div class="swiper-container appear-animate icon-box-wrapper br-sm mt-6 mb-6" data-swiper-options="{
                    'slidesPerView': 1,
                    'loop': false,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 2
                        },
                        '768': {
                            'slidesPerView': 3
                        },
                        '1200': {
                            'slidesPerView': 4
                        }
                    }
                }">
                <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
                    <div class="swiper-slide icon-box icon-box-side icon-box-primary">
                            <span class="icon-box-icon icon-shipping">
                                <i class="w-icon-truck"></i>
                            </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">ارسال رایگان و مرجوعی</h4>
                            <p class="text-default">برای تمام سفارشات بیش از 99 دلار</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side icon-box-primary">
                            <span class="icon-box-icon icon-payment">
                                <i class="w-icon-bag"></i>
                            </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">پرداخت امن</h4>
                            <p class="text-default">ما تضمین می کنیم</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side icon-box-primary icon-box-money">
                            <span class="icon-box-icon icon-money">
                                <i class="w-icon-money"></i>
                            </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">تضمین بازگشت پول</h4>
                            <p class="text-default">پس از 30 روز بازگشت</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side icon-box-primary icon-box-chat">
                            <span class="icon-box-icon icon-chat">
                                <i class="w-icon-chat"></i>
                            </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title font-weight-bold mb-1">پشتیبانی مشتری</h4>
                            <p class="text-default">24/7 با ما تماس بگیرید یا ایمیل بزنید</p>
                        </div>
                    </div>
                </div>
            </div>
--}}
            <!-- End of Iocn Box Wrapper -->
            <div  class="row category-banner-wrapper appear-animate pt-6 pb-8">
         <div class="col-md-6 mb-4">
                    <a href="{{ $banners[0]->button_link }}"
                       class="intro-banner banner col-md-12 col-sm-6 mb-4 banner-fixed overlay-dark">

                        <div class="banner banner-fixed br-xs">

                            <figure>
                                <img src="{{ imageExist(env('BANNER_IMAGES_UPLOAD_PATH'),$banners[0]->image) }}"
                                     alt="Category Banner"
                                     width="610" height="160" style="background-color: #ecedec;"/>
                            </figure>
                            <div class="banner-content y-50 mt-0">
                                <h5 class="banner-subtitle font-weight-normal text-dark">{{ $banners[0]->title }}</h5>
                                <h3 class="banner-title text-uppercase">
                                    {{ $banners[0]->text }}
                                </h3>
                            </div>

                        </div>
                    </a>
                </div>
                <div class="col-md-6 mb-4">
                    <a href="{{ $banners[1]->button_link }}"
                       class="intro-banner banner col-md-12 col-sm-6 mb-4 banner-fixed overlay-dark">

                        <div class="banner banner-fixed br-xs">

                            <figure>
                                <img src="{{ imageExist(env('BANNER_IMAGES_UPLOAD_PATH'),$banners[1]->image) }}"
                                     alt="Category Banner"
                                     width="610" height="160" style="background-color: #ecedec;"/>
                            </figure>
                            <div class="banner-content y-50 mt-0">
                                <h5 class="banner-subtitle font-weight-normal text-dark">{{ $banners[1]->title }}</h5>
                                <h3 class="banner-title text-uppercase">
                                    {{ $banners[1]->text }}
                                </h3>
                            </div>

                        </div>
                    </a>
                </div>
            </div>
            <!-- End of Category Banner Wrapper -->
            <!-- End of Category Banner Wrapper -->

            <div class="row deals-wrapper appear-animate mb-8">
               <div class="col-lg-8 mb-4">
                    <div class="single-product h-100 br-sm">
                        <h4 class="title-sm title-underline font-weight-bolder ls-normal">
                     تخفیف ویژه
                        </h4>
                        <div class="swiper">
                            <div class="swiper-container swiper-theme nav-top swiper-nav-lg" data-swiper-options="{
                                    'spaceBetween': 20,
                                    'slidesPerView': 1
                                }">
                                <div class="swiper-wrapper row cols-1 gutter-no">
                                    @foreach($product_has_sale_showIndex as $product)
                                        <div class="swiper-slide">
                                            <div class="product product-single row">
                                                <div class="col-md-6">
                                                    <div
                                                        class="product-gallery product-gallery-sticky product-gallery-vertical">




                                                                        <figure >
                                                                            <img
                                                                                src="{{ imageExist(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH'),$product->primary_image) }}"

                                                                                alt="{{ $product->name }}" width="800"
                                                                                height="900">
                                                                        </figure>



                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div style="overflow:unset !important" class="product-details scrollable">
                                                        <h2 style="font-size: 1.8rem !important;" class="product-title mb-1"><a
                                                                href="{{ route('home.product',['alias'=>$product->alias]) }}">{{ $product->name }}</a>
                                                        </h2>

                                                        <hr class="product-divider">
                                                        <div class="product-countdown-container flex-wrap">

                                                            <div class="product-countdown countdown-compact"
                                                                 data-until="{{ discount_timer_creator($product->DateOnSaleTo)['data_until'] }}"
                                                                 data-compact="true"

                                                            >

                                                            </div>


                                                        </div>
                                                        <div dir="ltr" class="d-flex day-countdown ">
                                                            <div   class="text-left">     روز </div>
                                                            <div   class="text-left">  ساعت  </div>
                                                            <div   class="text-left"> دقیقه    </div>
                                                            <div   class="text-left"> ثانیه  </div>
                                                        </div>

                                                        @if(product_price_for_user_normal($product->id)[1]!=0)
                                                            <div
                                                                class="old_price d-flex justify-content-between align-items-center">

                                    <span>
                                         <div class="circle-price"></div>
                                         <del>
                                        {{ number_format(product_price_for_user_normal($product->id)[0]) }}
                                    </del>
                                    تومان
                                    </span>
                                                                <span
                                                                    class="discount">{{ number_format(product_price_for_user_normal($product->id)[1]).' % ' }}</span>
                                                            </div>
                                                        @endif

                                                        <div class="product-price">
                                                            <ins class="new-price ls-50">
<div class="circle-price"></div>
                                                                <span
                                                                        class="product_final_price_span">{{ number_format(product_price_for_user_normal($product->id)[2]) }}</span> تومان
                                                                <input class="product_final_price" type="hidden"
                                                                       value="{{ product_price_for_user_normal($product->id)[2] }}">
                                                            </ins>
                                                        </div>



                                                        <div class="product-form pt-4">
                                                                <div style="max-width:187px !important;" class="product-qty-form with-label">
                                                                <label>تعداد:</label>
                                                                <i style="margin-left: 10px;cursor: pointer;font-size: 14px;" onclick="change_quantity(0)" class="fa fa-minus"></i>
                                                                <input   style="width: 36px" readonly class="text-center quantity-input number-input"
                                                                         id="quantity"
                                                                         min="{{ $product->minimum_measure_to_order }}" max="100000"
                                                                         value="{{ $product->minimum_measure_to_order }}">
                                                                <i style="margin-left: 49px;cursor: pointer;font-size: 14px;" onclick="change_quantity(1)" class="fa fa-plus"></i>
                                                            </div>
                                                            <button onclick="AddToCart({{ $product->id }},$('#quantity').val(),0)" class="btn btn-blue btn-cart">
                                                                <i class="w-icon-cart"></i>
                                                                <span>افزودن به سبد  </span>
                                                            </button>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button style="margin-right: auto" class="swiper-button-prev"></button>
                                <button style="margin-right: auto" class="swiper-button-next"></button>
                            </div>
                        </div>
                    </div>
                </div>
                        
                <div class="col-lg-4 mb-4">
                    <div class="widget widget-products widget-products-bordered h-100">
                        <div class="widget-body br-sm h-100">
                            <h4 class="title-sm title-underline font-weight-bolder ls-normal mb-2">فروش ویژه</h4>
                            <div class="swiper">
                                <div class="swiper-container swiper-theme nav-top" data-swiper-options="{
                                        'slidesPerView': 1,
                                        'spaceBetween': 20,
                                        'breakpoints': {
                                            '576': {
                                                'slidesPerView': 2
                                            },
                                            '768': {
                                                'slidesPerView': 3
                                            },
                                            '992': {
                                                'slidesPerView': 1
                                            }
                                        }
                                    }">
                                    <div class="swiper-wrapper row cols-lg-1 cols-md-3">
                                        @foreach($products_special_sale as $products)
                                            <div class="swiper-slide product-widget-wrap">
                                                @foreach($products as $product)
                                                    <div class="product product-widget bb-no">
                                                        <figure class="product-media">
                                                            <a href="{{ route('home.product',['alias'=>$product->alias]) }}">
                                                                <img
                                                                    src="{{ imageExist(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH'),$product->primary_image) }}"
                                                                    alt="{{ $product->name }}" width="105"
                                                                    height="118"/>
                                                            </a>
                                                        </figure>
                                                        <div class="product-details">
                                                            <h4 class="product-name">
                                                                <a href="{{ route('home.product',['alias'=>$product->alias]) }}">{{ $product->name }}</a>
                                                            </h4>
                                                            <div class="product-price">
                                                                <ins
                                                                    class="new-price">{{ number_format(product_price_for_user_normal($product->id)[2]) }}
                                                                    تومان
                                                                </ins>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="swiper-button-next"></button>
                                    <button class="swiper-button-prev"></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Deals Wrapper -->
        </div>

        <section class="category-section top-category bg-grey pt-10 pb-10 appear-animate">
            <div class="container pb-2">
                <div class="swiper">
                    <div class="swiper-container swiper-theme pg-show" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 5
                                },
                                '992': {
                                    'slidesPerView': 6
                                }
                            }
                        }">
                        <div class="swiper-wrapper row cols-lg-6 cols-md-5 cols-sm-3 cols-2">
                            @foreach($active_categories as $category)
                                <div
                                    class="swiper-slide category category-classic category-absolute overlay-zoom br-xs">
                                    <a href="{{ route('home.product_categories',['category'=>$category->alias]) }}"
                                       class="category-media">
                                        <img src="{{ imageExist(env('CATEGORY_IMAGES_UPLOAD_PATH'),$category->image) }}"
                                             alt="Category"
                                             width="130" height="130">
                                    </a>
                                    <div class="category-content">
                                        <h4 class="category-name">{{ $category->name }} </h4>
                                        <a href="{{ route('home.product_categories',['category'=>$category->alias]) }}"
                                           class="btn btn-primary btn-link btn-underline">مشاهده محصولات</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of .category-section top-category -->

        <div class="container">
            <!--<h2 class="title justify-content-center ls-normal mb-4 mt-10 pt-1 appear-animate">بخش های محبوب-->
            <!--</h2>-->
            <div class="tab tab-nav-boxed tab-nav-outline appear-animate">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <!--<li class="nav-item mr-2 mb-2">-->
                    <!--    <a class="nav-link active br-sm font-size-md ls-normal" href="#tab1-1">تخفیف دار ها</a>-->
                    <!--</li>-->
                     <li class="nav-item mr-2 mb-2">
                        <a class="nav-link active br-sm font-size-md ls-normal" href="#tab1-3">محبوبترین ها</a>
                    </li>
                    <li class="nav-item mr-2 mb-2">
                        <a class="nav-link  br-sm font-size-md ls-normal" href="#tab1-2">جدیدترین ها</a>
                    </li>
                   
                </ul>
            </div>
            <!-- End of Tab -->
            <div class="tab-content product-wrapper appear-animate">
          
                <!-- End of Tab Pane -->
                <div class="tab-pane  pt-4" id="tab1-2">
                    <div class="product-wrap row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                        @php
                            $products=$products_new;
                        @endphp
                        @include('home.sections.product_box')
                    </div>
                </div>
                <!-- End of Tab Pane -->
                <div class="tab-pane active pt-4" id="tab1-3">
                    <div class="product-wrap row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                        @php
                            $products=$products_hit;
                        @endphp
                        @include('home.sections.product_box')
                    </div>
                </div>
                <!-- End of Tab Pane -->
            </div>
            <!-- End of Tab Content -->

            <div class="row category-cosmetic-lifestyle appear-animate mb-5">
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed category-banner-1 br-xs">
                        <a href="{{ $banners[2]->button_link }}"
                           class="intro-banner banner col-md-12 col-sm-6 mb-4 banner-fixed overlay-dark">
                            <figure class="banner-media">
                                <img src="{{ imageExist(env('BANNER_IMAGES_UPLOAD_PATH'),$banners[2]->image) }}"
                                     alt="Banner" width="347" height="245"
                                     style="background-color: #E9E9EB;"/>
                            </figure>
                            <div class="banner-content">
                                <h5 class="banner-subtitle text-light font-weight-bold ls-25 mb-1">{{ $banners[2]->title }}</h5>
                                <h3 class="banner-title text-capitalize text-white ls-25">{{ $banners[2]->text }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed category-banner-2 br-xs">
                        <a href="{{ $banners[3]->button_link }}"
                           class="intro-banner banner col-md-12 col-sm-6 mb-4 banner-fixed overlay-dark">
                            <figure class="banner-media">
                                <img src="{{ imageExist(env('BANNER_IMAGES_UPLOAD_PATH'),$banners[3]->image) }}"
                                     alt="Banner" width="347" height="245"
                                     style="background-color: #E9E9EB;"/>
                            </figure>
                            <div class="banner-content">
                                <h5 class="banner-subtitle text-light font-weight-bold ls-25 mb-1">{{ $banners[3]->title }}</h5>
                                <h3 class="banner-title text-capitalize text-white ls-25">{{ $banners[3]->text }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- End of Category Cosmetic Lifestyle -->
            <?php
            $category = \App\Models\Category::find($sections[0]->category_id);
            $category_ids = children_categories($category);
            $product_category_ids = product_ids_in_children_categories($category_ids);
            $category_products = \App\Models\Product::whereIn('id', $product_category_ids)->where('quantity', '>', 0)
                ->where('price', '>', 0)
                ->inRandomOrder()
                ->take(8)
                ->get()
                ->chunk(2);
            ?>

            <div class="product-wrapper-1 appear-animate mb-5">
                <div class="title-link-wrapper pb-1 mb-4">
                    <h2 class="title ls-normal mb-0">{{ $category->name }}</h2>
                    <a href="{{ route('home.product_categories',['category'=>$category->alias]) }}"
                       class="font-size-normal font-weight-bold ls-25 mb-0">محصولات بیشتر
                        <i class="w-icon-long-arrow-left"></i></a>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-4 mb-4">
                        <div class="banner h-100 br-sm banner-no-mobile-1" >
                            <div class="banner-content content-top">
                                <h5 class="banner-subtitle font-weight-normal mb-2">
                                    {{ $banners[4]->title }}
                                </h5>
                              
                                <h3 class="banner-title font-weight-bolder ls-25 text-uppercase">
                                    {{ $banners[4]->text }}
                                </h3>
                                @if($banners[4]->button_text!=null)
                                    <a href="{{ $banners[4]->button_link }}"
                                       class="btn btn-dark btn-outline btn-rounded btn-sm">
                                        {{ $banners[4]->button_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End of Banner -->
                    <div class="col-lg-9 col-sm-8">
                        <div class="swiper-container swiper-theme" data-swiper-options="{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                    '992': {
                                        'slidesPerView': 3
                                    },
                                    '1200': {
                                        'slidesPerView': 4
                                    }
                                }
                            }">
                            <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">
                                @foreach($category_products as $category_product)
                                    @php
                                        $products=$category_product;
                                    @endphp
                                    <div class="swiper-slide product-col">
                                        @include('home.sections.product_box')
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Product Wrapper 1 -->
            <?php
            $category = \App\Models\Category::find($sections[1]->category_id);
            $category_ids = children_categories($category);
            $product_category_ids = product_ids_in_children_categories($category_ids);
            $category_products = \App\Models\Product::whereIn('id', $product_category_ids)->where('quantity', '>', 0)
                ->where('price', '>', 0)
                ->inRandomOrder()
                ->take(8)
                ->get()
                ->chunk(2);
            ?>

            <div class="product-wrapper-1 appear-animate mb-8">
                <div class="title-link-wrapper pb-1 mb-4">
                    <h2 class="title ls-normal mb-0">{{ $category->name }}</h2>
                    <a href="{{ route('home.product_categories',['category'=>$category->alias]) }}"
                       class="font-size-normal font-weight-bold ls-25 mb-0">محصولات بیشتر
                        <i class="w-icon-long-arrow-left"></i></a>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-4 mb-4">
                        <div class="banner h-100 br-sm banner-no-mobile-2" >
                            <div class="banner-content content-top">
                                <h5 class="banner-subtitle font-weight-normal mb-2">
                                    {{ $banners[5]->title }}
                                </h5>
               
                                <h3 class="banner-title font-weight-bolder ls-25 text-uppercase">
                                    {{ $banners[5]->text }}
                                </h3>
                                @if($banners[5]->button_text!=null)
                                    <a href="{{ $banners[5]->button_link }}"
                                       class="btn btn-dark btn-outline btn-rounded btn-sm">
                                        {{ $banners[5]->button_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End of Banner -->
                    <div class="col-lg-9 col-sm-8">
                        <div class="swiper-container swiper-theme" data-swiper-options="{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                    '992': {
                                        'slidesPerView': 3
                                    },
                                    '1200': {
                                        'slidesPerView': 4
                                    }
                                }
                            }">
                            <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">
                                @foreach($category_products as $category_product)
                                    @php
                                        $products=$category_product;
                                    @endphp
                                    <div class="swiper-slide product-col">
                                        @include('home.sections.product_box')
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Product Wrapper 1 -->

            <div class="banner banner-fashion appear-animate br-sm mb-9" >
                <div class="banner-content align-items-center">
                    {{--                    <div class="content-left d-flex align-items-center mb-3">--}}
                    {{--                        <div class="banner-price-info font-weight-bolder text-secondary text-uppercase lh-1 ls-25">--}}
                    {{--                            25--}}
                    {{--                            <sup class="font-weight-bold">%</sup><sub class="font-weight-bold ls-25">تخفیف </sub>--}}
                    {{--                        </div>--}}
                    {{--                        <hr class="banner-divider bg-white mt-0 mb-0 mr-8">--}}
                    {{--                    </div>--}}
                    
                    <img class="banner-fashion-img" src="{{ imageExist(env('BANNER_IMAGES_UPLOAD_PATH'),$banners[6]->image) }}">
                    <div class="content-right d-flex align-items-center flex-1 flex-wrap">
                        <div class="banner-info mb-0 mr-auto pr-4 mb-3">
                            <h3 class="banner-title text-white font-weight-bolder text-uppercase ls-25">
                                {{ $banners[6]->title }}
                            </h3>
                            <p class="text-white mb-0">
                                {{ $banners[6]->text }}
                            </p>
                        </div>
                        @if($banners[6]->button_text!=null)
                            <a href="{{ $banners[6]->button_link }}"
                               class="btn btn-white btn-outline btn-rounded btn-icon-right mb-3">
                                {{ $banners[6]->button_text }}
                                <i class="w-icon-long-arrow-left"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- End of Banner Fashion -->

            <?php
            
            $category = \App\Models\Category::find($sections[2]->category_id);
            
            $category_ids = children_categories($category);
            $product_category_ids = product_ids_in_children_categories($category_ids);
            $category_products = \App\Models\Product::whereIn('id', $product_category_ids)->where('quantity', '>', 0)
                ->where('price', '>', 0)
                ->inRandomOrder()
                ->take(8)
                ->get()
                ->chunk(2);
       
            ?>

            <div class="product-wrapper-1 appear-animate mb-7">
                <div class="title-link-wrapper pb-1 mb-4">
                    <h2 class="title ls-normal mb-0">{{ $category->name }}</h2>
                    <a href="{{ route('home.product_categories',['category'=>$category->alias]) }}"
                       class="font-size-normal font-weight-bold ls-25 mb-0">محصولات بیشتر
                        <i class="w-icon-long-arrow-left"></i></a>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-4 mb-4">
                        <div class="banner h-100 br-sm banner-no-mobile-3" style="background-image: url({{ imageExist(env('BANNER_IMAGES_UPLOAD_PATH'),$banners[7]->image) }});
                                background-color: #ebeced;">
                            <div class="banner-content content-top">
                                <h5 class="banner-subtitle font-weight-normal mb-2">
                                    {{ $banners[7]->title }}
                                </h5>
             
                                <h3 class="banner-title font-weight-bolder ls-25 text-uppercase">
                                    {{ $banners[7]->text }}
                                </h3>
                                @if($banners[7]->button_text!=null)
                                    <a href="{{ $banners[7]->button_link }}"
                                       class="btn btn-dark btn-outline btn-rounded btn-sm">
                                        {{ $banners[7]->button_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End of Banner -->
                    <div class="col-lg-9 col-sm-8">
                        <div class="swiper-container swiper-theme" data-swiper-options="{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                    '992': {
                                        'slidesPerView': 3
                                    },
                                    '1200': {
                                        'slidesPerView': 4
                                    }
                                }
                            }">
                            <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">
                                @foreach($category_products as $category_product)
                                    <div class="swiper-slide product-col">
                                     
                               
                                            @include('home.sections.product_box',['products' => $category_product])
                                     
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Product Wrapper 1 -->

            <!--<h2 class="title title-underline mb-4 ls-normal appear-animate">برند ها</h2>-->
            <!--<div class="swiper-container swiper-theme brands-wrapper mb-9 appear-animate" data-swiper-options="{-->
            <!--        'spaceBetween': 0,-->
            <!--        'slidesPerView': 2,-->
            <!--        'breakpoints': {-->
            <!--            '576': {-->
            <!--                'slidesPerView': 3-->
            <!--            },-->
            <!--            '768': {-->
            <!--                'slidesPerView': 4-->
            <!--            },-->
            <!--            '992': {-->
            <!--                'slidesPerView': 5-->
            <!--            },-->
            <!--            '1200': {-->
            <!--                'slidesPerView': 6-->
            <!--            }-->
            <!--        }-->
            <!--    }">-->
                
            <!--    <div class="swiper-wrapper row gutter-no cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">-->
            <!--        @foreach($brands as $brand)-->
            <!--            <div class="swiper-slide">-->
            <!--                <figure>-->
            <!--                    <a href="{{ route('home.products.brand',['brand'=>$brand->alias]) }}">-->
            <!--                        <img src="{{ imageExist(env('BRAND_UPLOAD_PATH'),$brand->image) }}" alt="Brand"-->
            <!--                             width="290"-->
            <!--                             height="100"/>-->
            <!--                             <p class="text-center">{{$brand->name}}</p>-->
            <!--                    </a>-->
            <!--                </figure>-->
            <!--            </div>-->
            <!--        @endforeach-->
            <!--    </div>-->
            <!--</div>-->
            <!-- End of Brands Wrapper -->
{{--
            <div class="post-wrapper appear-animate mb-4">
                <div class="title-link-wrapper title-post mb-4 after-none appear-animate">
                    <h2 class="title ls-normal pt-1 pb-1 mb-0">از وبلاگ ما </h2>
                    <a href="blog-listing.html" class="font-weight-bold font-size-normal ls-normal">
                        نمایش همه مقالات
                        <i class="w-icon-long-arrow-left"></i>
                    </a>
                </div>
                <div class="swiper-container swiper-theme post-wrapper pb-2 appear-animate"
                     data-swiper-options="{
                    'slidesPerView': 1,
                    'spaceBetween': 20,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 2
                        },
                        '768': {
                            'slidesPerView': 3
                        },
                        '992': {
                            'slidesPerView': 4,
                            'dots': false
                        }
                    }
                }">
                    <div class="swiper-wrapper row cols-lg-4 cols-md-3 cols-sm-2 cols-1">
                        @foreach($articles as $article)
                            <div class="swiper-slide post text-center overlay-zoom">
                                <figure class="post-media br-sm">
                                    <a href="{{ route('home.article',['alias'=>$article->alias]) }}">
                                        <img
                                            src="{{ imageExist(env('ARTICLES_IMAGES_THUMBNAIL_UPLOAD_PATH'),$article->image)}}"
                                            alt="Post" width="325"
                                            height="214"
                                            style="background-color: #b8bfc4;"/>
                                    </a>
                                </figure>
                                <div class="post-details">
                                    <div class="post-meta">
                                        <a href="{{ route('home.article',['alias'=>$article->alias]) }}"
                                           class="post-date mr-0">{{ verta($article->created_at)->format('Y-m-d') }}</a>
                                    </div>
                                    <h4 class="post-title">
                                        <a href="{{ route('home.article',['alias'=>$article->alias]) }}">{{ $article->title }}</a>
                                    </h4>
                                    <a href="{{ route('home.article',['alias'=>$article->alias]) }}"
                                       class="btn btn-link btn-dark btn-underline">ادامه مطلب <i
                                            class="w-icon-long-arrow-left"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
					--}}
                </div>
            </div>
            <!-- Post Wrapper -->
        </div>
        <!--End of Catainer -->
    </main>
    <!-- End of Main -->
@endsection
