<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="discrption" content=""/>
    <meta name="keyword" content=""/>

    <!--  Title -->
    <title>MAXEN</title>

    <link rel="shortcut icon" href="{{ imageExist(env('LOGO_UPLOAD_PATH'),$setting->favicon) }}" type="image/x-icon"/>
    <link rel="icon" href="{{ imageExist(env('LOGO_UPLOAD_PATH'),$setting->favicon) }}" type="image/x-icon"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <!-- custom styles (optional) -->
    <link href="{{asset('home/css/plugins.css')}}" rel="stylesheet"/>
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet"/>
    @if(app()->getLocale() == 'en')
        <link href="{{asset('home/css/style_en.css')}}" rel="stylesheet"/>
    @endif
    <link href="{{asset('home/css/custom.css')}}" rel="stylesheet"/>
    <link href="{{asset('home/css/animate.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{asset("vendor/cookie-consent/css/cookie-consent.css")}}">

    @yield('style')
    <style>
        .white-img {
            filter: brightness(0) invert(1) !important;
        }
    </style>
    @if(request()->is('/'))
        <style>
            @media (max-width: 770px) {
                .title-scroll-other-page {
                    display: none !important;
                }
            }

        </style>
    @endif
    @if(!request()->is('/'))
        <style>

            .site-header .inner-header .main-logo .search-toggler, .search-toggler-mobile {
                display: none !important;
            }

            .change-lang-btn-mobile {
                display: none;
            }

            @media (min-width: 410px) {
                .site-header .inner-header .main-logo {
                    width: 192px !important;
                }
            }

            @media (min-width: 470px) {
                .site-header .inner-header .main-logo {
                    width: 250px !important;
                }
            }
        </style>
    @endif

    <style>
        @media (max-width: 760px) {
            .accent-menu ul {
                padding: 50px;
            }
        }


        .change-lang-btn-mobile {
            color: #000 !important;
        }

        @media (min-width: 767.98px) {
            .d-md-none {
                display: none !important; /* نمایش در سایزهای زیر 768px */
            }
        }

        body {
            overflow-x: hidden !important;
        }

        .swiper-container {
            overflow-x: hidden;
        }


        .slick-prev {
            top: 45% !important;
            font-size: 22px;
            left: 2% !important;
            z-index: 999 !important;
            position: absolute !important;

        }

        .cursor-pointer {
            cursor: pointer !important;
        }

        .main-logo {
            cursor: pointer !important;
        }

        .slick-next {
            top: 45% !important;
            font-size: 22px;
            right: 2% !important;
            z-index: 999 !important;
            position: absolute !important;

        }

        .font-family-Heltiveca {
            font-family: HelveticaNeu !important;
        }


        @if(!request()->is('/'))
        .lcc-modal {
            display: none !important;
        }


        @endif


        @media (max-width: 867px) {

            .lcc-modal {
                display: none !important;
            }

        }

        .arrow_icon {
            width: 20px;
            height: 20px;
        }

        .background-color-fff {
            background-color: #fff !important;
        }

        .text-close {
            display: none !important;
        }


    </style>

    @if(app()->getLocale() == 'fa')
        <style>
            .product-title p:nth-child(2) {
                font-family: 'Pelak' !important;
            }

            .lcc-modal__content {
                text-align: right;
            }

            .slick-slide.col-3 {
                padding-left: 45px !important;
                padding-right: 45px !important;

            }
        </style>
    @else
        <style>
            .des-slider p {
                line-height: 120% !important;
            }

            .lcc-modal {
                top: 70% !important;
                right: -9% !important;
                direction: rtl !important;
            }

            @media only screen and (min-width: 992px) {
                .classic-menu .site-header .extend-container .main-navigation ul.extend-container > li:first-of-type {
                    margin-right: 22px;
                }
            }

            .dsn-drop-down img {
                vertical-align: super;
                transform: translateY(15px);

            }

            .site-header .dsn-title-menu {
                font-size: 18px !Important;
                font-weight: 700;
            }

            .product-title p:nth-child(2) {
                font-family: 'HelveticaNeu' !important;
            }


        </style>
    @endif


    <style>
        @media (min-width: 768px) {
            .row-md {

                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                margin-left: -15px;
                margin-right: -15px;


            }


        }

        @media (max-width: 768px) {

            #dsn-hero-parallax-title img {
                position: fixed !important;
            }

            .site-header {
                padding: 22px 15px !important;
            }

        }


        @media (min-width: 992px) and (max-width: 1244px) {
            .search-toggler {
                display: none;
            }

            .change-lang-btn ~ .user-no-selection {
                display: none;
            }
        }


        @media (min-width: 992px) and (max-width: 1249px) {

            .change-lang-btn ~ .user-no-selection {
                display: none;
            }
        }

        @media (min-width: 992px) and (max-width: 1155px) {
            .main-navigation ul li {
                display: none !important;
            }

            .main-navigation ul li:last-child {
                display: block !important;
            }
        }

        @if(request()->is('/'))
@media (min-width: 1425px) {
            .site-header .inner-header .main-logo {
                width: fit-content !important;
            }
        }
        @endif
    </style>

    @if(app()->getLocale() == 'fa')
        <style>

            @media (min-width: 992px) and (max-width: 1155px) {
                .main-navigation ul li {
                    display: none !important;
                }

                .main-navigation ul li:last-child {
                    display: none !important;
                }

                .main-navigation ul li:first-child {
                    display: block !important;
                }
            }

            @media (min-width: 1150px) and (max-width: 1330px) {
                .classic-menu .site-header .extend-container .main-navigation ul.extend-container > li {
                    margin-right: 11px !important;
                }
            }

            @media (min-width: 1420px) and (max-width: 1480px) {
                .intro-about h1 {
                    font-size: 69px !important;
                    line-height: 86px !important;
                }
            }

            .our-work h2 {
                font-size: 169px !important;
            }

            @media (min-width: 1200px) and (max-width: 1400px) {
                .lcc-button img {
                    width: 50px !important;
                }

                .text-slider h2 {
                    font-size: 25px !important;
                }
            }

            @media (min-width: 320px) and (max-width: 992px) {
                .text-mobile-mobile {
                    letter-spacing: 3px !important;
                }
            }

            .text-en-mobile {
                position: absolute;
                right: 5%;
                bottom: 10%;
                color: #000;
                font-weight: 800;
                font-size: 40px;
                width: 67%;
                text-align: right;
            }

        </style>
    @endif
    <style>
        .theme-btn-mobile {
            background: #000;
            color: #fff;
            position: absolute;
            width: fit-content;
            left: 0%;
            top: 1%;
        }

        .search-popup-mobile .close-search {
            position: absolute !important;
            right: 25px !important;
            top: 5% !important;
            font-size: 22px !important;
            color: #ffffff !important;
            cursor: pointer !important;
            z-index: 99999999999999999999999999 !important;
        }

        .animate-change-lang-btn {
            border-color: #fff !important;
        }

        .animate-change-lang-btn .divider {
            background: #fff !important;
        }


        #overlay-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            display: none;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            transition: all ease .3s;
            z-index: 99999999999999999999999999999999999999999999999999999;
        }

        #sidebar-right {
            position: fixed;
            top: 0;
            left: 0;
            transform: translatex(-1500px);
            width: 60vw;
            height: 100%;
            background: white;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
            z-index: 999999999999999999999999999999999999999999;
            padding: 20px;
            transition: all ease .3s;
        }


        #sidebar-right.active {
            transform: translatex(0);
        }

        #overlay-sidebar.active {
            display: block;
        }

        ul.main-navigation {
            margin: -45px 0;
        }


        ul.main-navigation li {
            margin: 45px 0;
            font-size: 22px;
        }

        .axil-contact-info-inner span.title {

            font-size: 25px;
            line-height: 1;
            color: #000;
            font-weight: 500;
            display: block;
            margin: 26px 0;
            font-style: normal !important;
        }


        .social-share {
            display: flex;
            align-items: start;
            justify-content: start;
        }

        ul.main-navigation li {
            color: #000 !important;
        }

        .axil-contact-info h5 {
            text-align: left;
            font-size: 40px;
            margin-top: 30px;
        }

        #sidebar-right {
            padding: 60px
        }
    </style>
    @if(app()->getLocale() == 'fa')
        <style>
            #sidebar-right {

                right: 0 !important;
                left: unset !important;
                transform: translatex(1500px) !important;

            }

            .axil-contact-info h5 {
                text-align: right;

            }

            #sidebar-right.active {
                transform: translatex(0) !important;
            }

            .contact-social-share {
                justify-content: start;
            }

            .scroll-to-top {
                display: none;
            }
        </style>
    @endif
    <style>
        /* موقعیت‌دهی دکمه به صورت فیکس در سمت چپ صفحه */
        .compare-btn-container {
            position: fixed;
            left: 20px;
            bottom: 20px;
            display: none;
            z-index: 1000;
        }

        /* طراحی دکمه */
        .compare-btn {
            background-color: #000; /* رنگ سبز */
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 50px;
            padding: 12px 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative; /* برای استفاده از باجت */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        /* تغییر رنگ دکمه هنگام hover */
        .compare-btn:hover {
            background-color: #45a049;
        }

        /* آیکون مقایسه */
        .compare-btn i {
            font-size: 20px; /* سایز آیکون */
            margin-left:10px;
        }

        /* باجت تعداد مقایسه‌ها */
        .compare-badge {
            position: absolute;
            top: -5px; /* فاصله از بالای آیکون */
            right: -5px; /* فاصله از سمت راست آیکون */
            background-color: white; /* پس‌زمینه سفید */
            color: #000; /* رنگ سبز */
            font-size: 12px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 50%;
            border: 2px solid #000; /* حاشیه سبز */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); /* سایه برای باجت */
        }

        /* تغییر رنگ باجت هنگام پر شدن تعداد */
        .compare-badge.active {
            background-color: #4CAF50;
            color: white;
        }


        /* وقتی دکمه غیرفعال است */
        .btn-compare.disabled {
            background-color: #d3d3d3; /* رنگ خاکی برای دکمه غیرفعال */
            color: #a1a1a1; /* رنگ متن خاکی */
            cursor: not-allowed; /* نشانگر موس به صورت "دست" نمی‌شود */
            pointer-events: none; /* جلوگیری از کلیک دوباره */
        }
    </style>


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MFDXRMNR');</script>
<!-- End Google Tag Manager -->

    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MFDXRMNR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-YWV6GDFPM2');
    </script>
</head>

<body style="overflow:hidden !important" class=" dsn-ajax classic-menu v-light">

@include('home.sections.header')

<main class="main-root">
    <div>


        @yield('content')

        @include('home.sections.footer')

    </div>
</main>
@yield('modal')
<div class="scroll-to-top">
    <img src="assets/img/scroll_top.png" alt=""/>
    <div class="box-numper">
        <span>0%</span>
    </div>
</div>

<div id="search-popup" class="search-popup ">
    <div class="close-search ">
        <img width="22" src="{{asset('home/img/close-modal.svg')}}">
    </div>
    <div class="popup-inner">
        <div class="overlay-layer"></div>
        <div class="search-form">
            <form method="get" action="{{ route('home.product.search') }}">

                <div class="form-group">
                    <fieldset>
                        <input type="search" class="form-control" name="search" placeholder="{{__('Search')}}  ...."
                               required="">
                        <input type="submit" value="{{__('Search')}}" class="theme-btn">
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="search-popup-mobile" class="search-popup search-popup-mobile ">
    <div class="close-search ">
        <img width="22" src="{{asset('home/img/close-modal.svg')}}">
    </div>
    <div class="popup-inner">
        <div class="overlay-layer"></div>
        <div class="search-form">
            <form method="get" action="{{ route('home.product.search') }}">

                <div style="padding:0 !important" class="form-group col-12">

                    <input type="search" class="form-control" name="search" placeholder="{{__('Search')}}  ...."
                           required="">
                    <input type="submit" value="{{__('Search')}}" class="theme-btn-mobile form-control">


                </div>

            </form>
        </div>
    </div>
</div>
<div class="magnic-popup">


</div>

<div id="overlay-sidebar" class="hidden-sidebar"></div>
<div id="sidebar-right" class="hidden-sidebar">
    <div class="side-nav-content">
        <div class="row ">
            <!-- Start Left Bar  -->
            <div class="col-lg-5 col-xl-6 col-12">
                <ul class="main-navigation">
                    @php
                        $menu_sidebar = \App\Models\Menu::whereIn('is_show_header',[0,2])->orderBy('sort')->get();

                    @endphp
                    @foreach($menu_sidebar as $menu)
                        @if($menu->type == 'blog')
                            <li>
                                <?php
                                $categories_article = \App\Models\ArticleCategoriy::all();
                                ?>
                                <a href="{{route('home.articles')}}">
                                    <span>  {{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}} </span>

                                </a>
                                @if(count($categories_article) > 0)
                                    <ul>
                                        @foreach($categories_article as $category)

                                            <li>
                                                <a href="{{ route('home.articles.category',['category'=>$category->alias]) }}"><span>{{app()->getLocale() == 'en' ? $category->title_en : $category->title }}</span></a>
                                            </li>
                                        @endforeach

                                    </ul>
                                @endif

                            </li>
                        @endif

                        @if($menu->type == 'product')

                            <li>
                                <?php
                                $categories = \App\Models\Category::where('parent_id', 0)->where('is_active', 1)->orderby('priority', 'asc')->get();
                                ?>
                                <a href="#">
                                    <span>  {{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}} </span>
                                    <span></span>
                                </a>
                                @if(count($categories) > 0)
                                    <ul>
                                        @foreach($categories as $category)

                                            <li>
                                                <a href="{{route('home.product_categories',['category'=>$category->alias ])}}"><span>{{app()->getLocale() == 'en' ? $category->name_en : $category->name }}</span></a>
                                            </li>
                                        @endforeach

                                    </ul>
                                @endif

                            </li>
                        @endif


                        @if($menu->type == 'link')

                            <li>


                                <a href="{{$menu->link}}">
                                    <span>  {{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}} </span>
                                    <span></span>
                                </a>
                                @if(!$menu->children->isEmpty())
                                    <ul>
                                        @foreach($menu->children as $menu)
                                            @if($menu->type == 'link')
                                                <li>
                                                    <a href="{{$menu->link}}"><span>{{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}}</span></a>
                                                </li>

                                            @endif

                                            @if($menu->type == 'page')
                                                @php

                                                    $page = \App\Models\Page::where('id', $menu->page_id)->first();

                                                @endphp
                                                <li>
                                                    <a href="{{route('home.page',['page'=>$page->alias])}}"><span>{{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}}</span></a>
                                                </li>

                                            @endif

                                        @endforeach

                                    </ul>
                                @endif

                            </li>

                        @endif


                        @if($menu->type == 'page')
                            @php

                                $page = \App\Models\Page::where('id', $menu->page_id)->first();

                            @endphp

                            <li>
                                <a href="{{route('home.page',['page'=>$page->alias])}}">
                                    <span>   {{app()->getLocale() == 'fa' ? $menu->name : $menu->name_en}} </span>

                                </a>


                            </li>


                        @endif


                    @endforeach
                </ul>
            </div>
            <!-- End Left Bar  -->

            <!-- Start Right Bar  -->
            <div class="col-lg-7 col-xl-6 col-12">
                <div class="axil-contact-info-inner">

                    <!-- Start Single Address  -->
                    <div class="axil-contact-info">
                        <address class="address">
                            <img src="{{ imageExist(env('LOGO_UPLOAD_PATH'),$setting->image) }}">
                            <span class="title"> {{__('Address')}}</span>
                            <p> {{ app()->getLocale() == 'fa' ? $setting->address : $setting->address_en }}  </p>

                        </address>
                        <address class="address">
                            <span class="title">{{__('Contact Us')}} </span>

                            <p><a class="tel" href="tel:{{$setting->tel}}"><i class="fas fa-phone"></i>
                                    {{$setting->tel}}</a></p>

                        </address>
                    </div>
                    <!-- End Single Address  -->

                    <!-- Start Single Address  -->
                    <div class="axil-contact-info">
                        <h5 class="title"> {{__('Follow Us')}}   </h5>
                        <div class="contact-social-share d-flex align-items-center">
                            <ul class="social-share style-rounded">
                                <li class="mr-2">
                                    <a href="{{$setting->linkedin}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="56" height="100"
                                             viewBox="0 0 50 50">
                                            <path
                                                d="M25,2C12.318,2,2,12.317,2,25s10.318,23,23,23s23-10.317,23-23S37.682,2,25,2z M18,35h-4V20h4V35z M16,17 c-1.105,0-2-0.895-2-2c0-1.105,0.895-2,2-2s2,0.895,2,2C18,16.105,17.105,17,16,17z M37,35h-4v-5v-2.5c0-1.925-1.575-3.5-3.5-3.5 S26,25.575,26,27.5V35h-4V20h4v1.816C27.168,20.694,28.752,20,30.5,20c3.59,0,6.5,2.91,6.5,6.5V35z"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li class="mr-2">
                                    <a href="{{$setting->youtube}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100"
                                             viewBox="0 0 58.536 58.536">
                                            <path id="Path_177" data-name="Path 177"
                                                  d="M596.5,65.707l10.138-5.854L596.5,54Z"
                                                  transform="translate(-571.13 -30.586)" fill="#040504"/>
                                            <path id="Path_178" data-name="Path 178"
                                                  d="M567.264,0a29.268,29.268,0,1,0,29.268,29.268A29.267,29.267,0,0,0,567.264,0m18.7,38.661a4.887,4.887,0,0,1-3.45,3.45c-3.043.816-15.246.816-15.246.816s-12.2,0-15.247-.816a4.887,4.887,0,0,1-3.45-3.45c-.815-3.043-.815-9.393-.815-9.393s0-6.35.815-9.393a4.888,4.888,0,0,1,3.45-3.45c3.043-.815,15.247-.815,15.247-.815s12.2,0,15.246.815a4.888,4.888,0,0,1,3.45,3.45c.816,3.043.816,9.393.816,9.393s0,6.349-.816,9.393"
                                                  transform="translate(-537.996)" fill="#040504"/>
                                        </svg>


                                    </a>
                                </li>
                                <li class="mr-2">
                                    <a href="{{$setting->twitter}}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="50"
                                             height="100" viewBox="0 0 256 256" xml:space="preserve">

<defs>
</defs>
                                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                               transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                                <polygon points="24.89,23.01 57.79,66.99 65.24,66.99 32.34,23.01 "
                                                         style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                         transform="  matrix(1 0 0 1 0 0) "/>
                                                <path
                                                    d="M 45 0 L 45 0 C 20.147 0 0 20.147 0 45 v 0 c 0 24.853 20.147 45 45 45 h 0 c 24.853 0 45 -20.147 45 -45 v 0 C 90 20.147 69.853 0 45 0 z M 56.032 70.504 L 41.054 50.477 L 22.516 70.504 h -4.765 L 38.925 47.63 L 17.884 19.496 h 16.217 L 47.895 37.94 l 17.072 -18.444 h 4.765 L 50.024 40.788 l 22.225 29.716 H 56.032 z"
                                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                    transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                            </g>
</svg>

                                    </a>
                                </li>
                                <!--<li class="mr-2">-->
                                <!--    <a>-->
                                <!--        <svg xmlns="http://www.w3.org/2000/svg" width="58.536" height="58.536" viewBox="0 0 58.536 58.536">-->
                                <!--            <path id="Path_177" data-name="Path 177" d="M596.5,65.707l10.138-5.854L596.5,54Z" transform="translate(-571.13 -30.586)" fill="#040504"/>-->
                                <!--            <path id="Path_178" data-name="Path 178" d="M567.264,0a29.268,29.268,0,1,0,29.268,29.268A29.267,29.267,0,0,0,567.264,0m18.7,38.661a4.887,4.887,0,0,1-3.45,3.45c-3.043.816-15.246.816-15.246.816s-12.2,0-15.247-.816a4.887,4.887,0,0,1-3.45-3.45c-.815-3.043-.815-9.393-.815-9.393s0-6.35.815-9.393a4.888,4.888,0,0,1,3.45-3.45c3.043-.815,15.247-.815,15.247-.815s12.2,0,15.246.815a4.888,4.888,0,0,1,3.45,3.45c.816,3.043.816,9.393.816,9.393s0,6.349-.816,9.393" transform="translate(-537.996)" fill="#040504"/>-->
                                <!--        </svg>-->


                                <!--    </a>-->
                                <!--</li>-->
                                <li class="mr-2">
                                    <a href="{{$setting->instagram}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100"
                                             viewBox="0 0 58.536 58.536">
                                            <path id="Path_174" data-name="Path 174"
                                                  d="M776.8,53.333a6.143,6.143,0,1,0,6.143,6.143,6.143,6.143,0,0,0-6.143-6.143"
                                                  transform="translate(-747.536 -30.208)" fill="#040504"/>
                                            <path id="Path_175" data-name="Path 175"
                                                  d="M779.459,36.9a6.108,6.108,0,0,0-3.5-3.5,10.209,10.209,0,0,0-3.422-.634c-1.943-.088-2.526-.108-7.447-.108s-5.5.019-7.446.108a10.21,10.21,0,0,0-3.422.634,6.1,6.1,0,0,0-3.5,3.5,10.2,10.2,0,0,0-.634,3.422c-.089,1.943-.108,2.526-.108,7.447s.019,5.5.108,7.446a10.2,10.2,0,0,0,.634,3.422,6.1,6.1,0,0,0,3.5,3.5,10.2,10.2,0,0,0,3.422.634c1.943.089,2.526.108,7.446.108s5.5-.019,7.447-.108a10.2,10.2,0,0,0,3.422-.634,6.1,6.1,0,0,0,3.5-3.5,10.2,10.2,0,0,0,.634-3.422c.088-1.943.108-2.526.108-7.446s-.019-5.5-.108-7.447a10.2,10.2,0,0,0-.634-3.422M765.093,57.228a9.463,9.463,0,1,1,9.463-9.463,9.463,9.463,0,0,1-9.463,9.463m9.837-17.089a2.211,2.211,0,1,1,2.211-2.211,2.211,2.211,0,0,1-2.211,2.211"
                                                  transform="translate(-735.825 -18.497)" fill="#040504"/>
                                            <path id="Path_176" data-name="Path 176"
                                                  d="M746.6,0a29.268,29.268,0,1,0,29.268,29.268A29.268,29.268,0,0,0,746.6,0m18.317,36.866a13.524,13.524,0,0,1-.856,4.473,9.425,9.425,0,0,1-5.39,5.39,13.529,13.529,0,0,1-4.473.857c-1.965.089-2.593.111-7.6.111s-5.632-.021-7.6-.111a13.524,13.524,0,0,1-4.473-.857,9.422,9.422,0,0,1-5.39-5.39,13.523,13.523,0,0,1-.857-4.473c-.089-1.966-.111-2.593-.111-7.6s.021-5.632.111-7.6a13.528,13.528,0,0,1,.857-4.473,9.422,9.422,0,0,1,5.39-5.39A13.525,13.525,0,0,1,739,10.951c1.966-.09,2.593-.111,7.6-.111s5.632.021,7.6.111a13.531,13.531,0,0,1,4.473.856,9.425,9.425,0,0,1,5.39,5.39,13.529,13.529,0,0,1,.856,4.473c.09,1.966.111,2.593.111,7.6s-.021,5.632-.111,7.6"
                                                  transform="translate(-717.328)" fill="#040504"/>
                                        </svg>


                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- End Single Address  -->
                </div>
            </div>
            <!-- End Right Bar  -->
        </div>
    </div>
</div>
<div class="compare-btn-container">
    <a href="{{route('home.compare')}}" id="compareBtn" class="compare-btn">
        <i class="fa fa-exchange-alt mx-atuto"></i> <!-- آیکون مقایسه -->
        نمایش لیست مقایسه

        <span id="compareCount" class="compare-badge">{{session()->get('compareProducts') != null ? count(session()->get('compareProducts')) : 0}}</span> <!-- باجت تعداد -->
    </a>
</div>

<script src="{{asset('home/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('home/js/plugins.js')}}"></script>
<script src="{{asset('home/js/dsn-grid.js')}}"></script>
<script src="{{asset('home/js/custom.js')}}"></script>
<script src="{{asset('home/js/wow.js')}}"></script>
<script>

    let image = $('#dsn-hero-parallax-title img');
    let p = $('.main-logo p');
    let fontsize_p = $('.main-logo p').css('font-size');
    fontsize_p = fontsize_p.replace('px', '')
    var x = window.matchMedia("(max-width: 700px)")


    $('.change-lang-btn').click(function () {
        $(this).toggleClass('animate-change-lang-btn');
    })
    @if(session()->get('compareProducts') != null)
    @if(count(session()->get('compareProducts')))
    $('.compare-btn-container').fadeIn();
    @endif
    @endif



    function AddToCompareList(event, productId,tag = null) {
        event.preventDefault();
        if(tag){
            $(tag).attr('disabled',true)
            $(tag).addClass('disabled')
        }
        $.ajax({
            url: "{{ route('home.compare.add') }}",
            type: "POST",
            dataType: "json",
            data: {
                productId: productId,
                _token: "{{ csrf_token() }}"
            },
            success: function (msg) {
                if (msg[0] === 'ok') {
                    swal({

                        text: "محصول به لیست مقایسه افزوده شد ",
                        icon: "success",
                        timer: 5000,
                        button: false
                    })
                    let count = msg[1];
                    updateCompareList();
                }
                if (msg[0] === 'exist') {
                    swal({

                        text: "این کالا از قبل به لیست مقایسه شما اضافه شده است",
                        icon: "warning",
                        timer: 5000,
                        button: false
                    })
                }
                if (msg[0] === 'full') {
                    swal({

                        text: "حداکثر چهار محصول را می توانید به لیست مقایسه اضافه کنید",
                        icon: "warning",
                        timer: 5000,
                        button: false

                    })
                }
                $('.compare-dropdown').addClass('opened');
            },
            error: function () {
                console.log("something went wrong");
            },
        });
    }

    function compare_side_bar(product_id) {
        $.ajax({
            url: "{{ route('home.compare.remove_sideBar') }}",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id,
            },
            dataType: "json",
            type: 'POST',
            beforeSend: function () {

            },
            success: function (msg) {
                console.log(msg);
                if (msg) {
                    if (msg[0] == 1) {
                        updateCompareList();
                    }
                    if (msg[0] == 0) {
                        let message = msg[1];
                        swal({
                            title: 'error',
                            text: message,
                            icon: 'error',
                            buttons: 'ok',
                        })
                    }
                }
            },
        })
    }

    function updateCompareList() {
        $.ajax({
            url: "{{ route('home.compare.get') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (msg) {
                if (msg[0] === 'ok') {
                    let count = msg[1];
                    console.log(msg);

                    $('#compare_count').text(count);
                    $('#compareCount').text(count);
                    $('.magnic-popup').html(msg[2]);
                    $('.magnic-popup').css('opacity', '1');
                    $('.magnic-popup').css('visibility', 'inherit');
                    $('.magnic-popup').css('left', '1%');


                    setTimeout(function () {
                        $('.magnic-popup').css('opacity', '0');

                        $('.magnic-popup').css('left', '-13%');

                        $('.magnic-popup').html(' ');
                    }, 5000);

                    $('.compare-btn-container').fadeIn();


                }
            },
            error: function () {
                console.log("something went wrong");
            },
        });
    }

</script>
<script>

    $('.icon-m').click(function () {
        $('.site-header .menu-icon .icon-m .menu-icon-line').toggleClass('background-color-fff');
        $('.search-toggler img').addClass('white-img');
        $('.search-toggler').removeClass('search-toggler');


        $('.change-lang-btn-mobile').toggleClass('d-none');

        $('.change-lang-btn-mobile').toggle(function () {
            $(".change-lang-btn-mobile").css({'display': "none !important"});
        }, function () {
            $(".change-lang-btn-mobile").css({'display': "block !important"});
        });


    })


    const element = document.querySelector('.menu-icon');

    element.addEventListener('mouseenter', (event) => {
        event.stopPropagation(); // جلوگیری از عملیات هاور
    });
</script>
<script>
    $('.search-toggler').on('click', function () {
        $('#search-popup').addClass('popup-visible');
    });
    $('.search-toggler-mobile').on('click', function () {
        $('#search-popup-mobile').addClass('popup-visible');
    });
    $(document).keydown(function (e) {
        if (e.keyCode === 27) {
            $('#search-popup').removeClass('popup-visible');
        }
    });
    //Hide Popup
    $('.close-search,.search-popup .overlay-layer').on('click', function () {
        $('#search-popup').removeClass('popup-visible');
    });

    $('#search-popup-mobile .close-search,.search-popup-mobile .overlay-layer').on('click', function () {
        $('#search-popup-mobile').removeClass('popup-visible');
    });

    AOS.init({
        once: true // انیمیشن ها فقط یک بار اجرا می شوند
    });

    $('.menu-sidebar .change-lang-btn').click(function () {
        const sidebar = document.getElementById('sidebar-right');
        const overlay = document.getElementById('overlay-sidebar');


        if (!sidebar.classList.contains('active')) {
            sidebar.classList.add('active');
            overlay.style.display = 'block'; // نمایش overlay
        } else {
            sidebar.classList.remove('active');
            overlay.style.display = 'none'; // مخفی کردن overlay
        }

    })
    const overlay = document.getElementById('overlay-sidebar');
    overlay.addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar-right');
        sidebar.classList.remove('active');
        overlay.style.display = 'none';
        $('.change-lang-btn').removeClass('animate-change-lang-btn');
    });


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(!request()->is('/'))
    <script>
        $('.main-logo').click(function () {
            window.location.href = '/'
        });
    </script>
@endif
@include('sweet::alert')
@yield('script')
</body>
</html>
