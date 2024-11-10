<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('home/images/icons/favicon.png') }}">
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="D-THEMES">
    <meta name="robots" content="index,follow"/>
    @yield('meta_torob')
    <!-- Favicon -->
    <script src="{{ asset('home/js/sweetalert.min.js') }}"></script>
    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: {families: ['Poppins:400,500,600,700']}
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '{{ asset('home/js/webfont.js') }}';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
        // </script>
    <link rel="preload" href="{{ asset('home/vendor/fontawesome-free/webfonts/fa-regular-400.woff2') }}" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('home/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('home/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('home/fonts/wolmart87d5.woff?png09e') }}" as="font" type="font/woff"
          crossorigin="anonymous">
    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/vendor/animate/animate.min.css') }}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/vendor/magnific-popup/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/vendor/photoswipe/photoswipe.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('home/vendor/photoswipe/default-skin/default-skin.min.css') }}">
    <!-- BOOTSTRAP -->
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.min.css') }}">--}}
    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style-rtl.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/demo1.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/checkout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/plugins/plugins.css') }}">
    @yield('style')
        <style>
        .swal-title {
            font-size: 16px !important;
            font-weight: 400 !important;
        }
    </style>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LDD63VY49D"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LDD63VY49D');
</script>
<style>

        /*.menu-icon {*/
        /*    width: calc(54px * 4 + 30px * 3);*/
        /*    height: 54px;*/
        /*    margin: 0 auto;*/
        /*    -webkit-filter: url("#goo");*/
        /*    filter: url("#goo");*/
        /*}*/

        /*.icon-social {*/
        /*    position: relative;*/
        /*    margin: 0;*/
        /*    padding: 0;*/
        /*    list-style: none;*/
        /*}*/

        /*.icon-social {*/
        /*    width: 54px;*/
        /*    height: 54px;*/
        /*    border-radius: 50%;*/
        /*    cursor: pointer;*/
        /*}*/

        /*svg.social {*/
        /*    overflow: hidden;*/
        /*}*/

        /*.ico01 {*/
        /*    background-color: #d92567;*/
        /*    position: relative;*/
        /*    z-index: 4;*/
        /*}*/

        /*.ico02 {*/
        /*    background-color: #d91e85;*/
        /*    transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1);*/
        /*    z-index: 3;*/
        /*}*/

        /*.ico03 {*/
        /*    background-color: #f24405;*/
        /*    transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1) 0.4s;*/
        /*    z-index: 2;*/
        /*}*/

        /*.ico04 {*/
        /*    background-color: #f23030;*/
        /*    transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1) 0.8s;*/
        /*    z-index: 1;*/
        /*}*/

        /*.move-ico {*/
        /*    position: absolute;*/
        /*    top: 0;*/
        /*}*/

        /*.active .ico02 {*/
        /*    transform: translateX(calc(54px + 30px));*/
        /*    transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1) 0.8s;*/
        /*}*/
        /*.active .ico03 {*/
        /*    transform: translateX(calc(54px * 2 + 30px * 2));*/
        /*    transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1) 0.4s;*/
        /*}*/
        /*.active .ico04 {*/
        /*    transform: translateX(calc(54px * 3 + 30px * 3));*/
        /*    transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1);*/
        /*}*/

        /* menu-object style */
        /*.menu-object {*/
        /*    position: fixed;*/
            /* top: 357px; */
            /* right: 0; */
        /*    bottom: 46px;*/
        /*    left: -201px;*/
        /*    margin: auto;*/
        /*    width: calc(54px * 4 + 30px * 3);*/
        /*    height: 54px;*/
        /*}*/

        /*.whatsapp-ico{*/
        /*    fill: white;*/

        /*    background-color: #4dc247;*/
        /*    border-radius: 50%;*/

            /* box-shadow: 2px 2px 11px rgba(0,0,0,0.7); */



        /*}*/
        /*.menu-object .link {*/
        /*    display: block;*/
        /*    width: 100%;*/
        /*    height: 100%;*/
        /*    color: #fff;*/
        /*    line-height: 1;*/
        /*}*/
        /*.menu-object .link i {*/
        /*    position: absolute;*/
        /*    top: 50%;*/
        /*    left: 50%;*/
        /*    transform: translate3d(-50%, -50%, 0);*/
        /*}*/
        /*.menu-object{*/
        /*    z-index: 22;*/
        /*}*/
        /*@media  screen and (max-width: 768px) {*/
        /*    .menu-object{*/
        /*        bottom: 33px;*/
        /*        left: -237px;*/
        /*    }*/

        /*    .active .ico02{*/
        /*        transform: translatey(calc(2px + -63px));*/
        /*    }*/
        /*    .active .ico03{*/
        /*        transform: translatey(calc(2px + -126px));*/
        /*    }*/
        /*    .active .ico04{*/
        /*        transform: translatey(calc(2px + -189px));*/
        /*    }*/


        /*}*/
        /*.menu-object .link01 {*/
        /*    font-size: 26px;*/
        /*}*/
        /*.menu-object .link02 {*/
        /*    font-size: 30px;*/
        /*}*/
        /*.menu-object .link03 {*/
        /*    font-size: 24px;*/
        /*    font-weight: bold;*/
        /*}*/

        /*.active .menu-object .ico01::before {*/
        /*    transform: rotate(45deg);*/
        /*}*/
        /*.active .menu-object .ico01::after {*/
        /*    transform: rotate(45deg);*/
        /*}*/
</style>
</head>

<body>
<div class="page-wrapper">
    <!-- Start of Header -->
    @include('home.sections.header')
    <!-- End of Header -->

    <!-- Start of Main -->
    @yield('content')
    <!-- End of Main -->
    <!-- Start of Footer -->
    @include('home.sections.footer')
    <!-- End of Footer -->
</div>
<!-- End of Page Wrapper -->


<!-- Start of Mobile Menu -->
@include('home.sections.mobile_menu')
<!-- End of Mobile Menu -->

<!-- Root element of PhotoSwipe. Must have class pswp -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
        PhotoSwipe keeps only 3 of them in the DOM to save memory.
        Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" aria-label="بستن (Esc)"></button>
                <button class="pswp__button pswp__button--zoom" aria-label="بزرگ و کوچک نمایی"></button>

                <div class="pswp__preloader">
                    <div class="loading-spin"></div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button--arrow--right" aria-label="قبلی"></button>
            <button class="pswp__button--arrow--left" aria-label="بعدی"></button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<!-- End of PhotoSwipe -->

<!-- Start of Quick View -->
<div class="product product-single product-popup">
    <div class="row gutter-lg">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-gallery product-gallery-sticky">
                <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                    <div class="swiper-wrapper row cols-1 gutter-no">
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="{{ asset('home/images/products/popup/1-440x494.jpg') }}"
                                     data-zoom-image="assets/images/products/popup/1-800x900.jpg') }}"
                                     alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="{{ asset('home/images/products/popup/2-440x494.jpg') }}"
                                     data-zoom-image="assets/images/products/popup/2-800x900.jpg') }}"
                                     alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="{{ asset('home/images/products/popup/3-440x494.jpg') }}"
                                     data-zoom-image="assets/images/products/popup/3-800x900.jpg') }}"
                                     alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                        <div class="swiper-slide">
                            <figure class="product-image">
                                <img src="{{ asset('home/images/products/popup/4-440x494.jpg') }}"
                                     data-zoom-image="assets/images/products/popup/4-800x900.jpg') }}"
                                     alt="Water Boil Black Utensil" width="800" height="900">
                            </figure>
                        </div>
                    </div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
                <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                        'navigation': {
                            'nextEl': '.swiper-button-next',
                            'prevEl': '.swiper-button-prev'
                        }
                    }">
                    <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                        <div class="product-thumb swiper-slide">
                            <img src="{{ asset('home/images/products/popup/1-103x116.jpg') }}" alt="Product Thumb"
                                 width="103"
                                 height="116">
                        </div>
                        <div class="product-thumb swiper-slide">
                            <img src="{{ asset('home/images/products/popup/2-103x116.jpg') }}" alt="Product Thumb"
                                 width="103"
                                 height="116">
                        </div>
                        <div class="product-thumb swiper-slide">
                            <img src="{{ asset('home/images/products/popup/3-103x116.jpg') }}" alt="Product Thumb"
                                 width="103"
                                 height="116">
                        </div>
                        <div class="product-thumb swiper-slide">
                            <img src="{{ asset('home/images/products/popup/4-103x116.jpg') }}" alt="Product Thumb"
                                 width="103"
                                 height="116">
                        </div>
                    </div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
            </div>
        </div>
        <div class="col-md-6 overflow-hidden p-relative">
            <div class="product-details scrollable pl-0">
                <h2 class="product-title">ساعت مچی مشکی الکترونیکی</h2>
                <div class="product-bm-wrapper">
                    <figure class="brand">
                        <img src="{{ asset('home/images/products/brand/brand-1.jpg') }}" alt="Brand" width="102"
                             height="48"/>
                    </figure>
                    <div class="product-meta">
                        <div class="product-categories">
                            دسته بندی:
                            <span class="product-category"><a href="#">الکترونیک </a></span>
                        </div>
                        <div class="product-sku">
                            کد: <span>MS46891340</span>
                        </div>
                    </div>
                </div>

                <hr class="product-divider">

                <div class="product-price">80000 تومان</div>

                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width: 80%;"></span>
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <a href="#" class="rating-reviews">(3 نظر )</a>
                </div>

                <div class="product-short-desc">
                    <ul class="list-type-check list-style-none">
                        <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                            با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است..
                        </li>
                        <li>چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی.</li>
                        <li>مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا
                            مورد استفاده قرار گیرد..
                        </li>
                    </ul>
                </div>

                <hr class="product-divider">

                <div class="product-form product-variation-form product-color-swatch">
                    <label>رنگ :</label>
                    <div class="d-flex align-items-center product-variations">
                        <a href="#" class="color" style="background-color: #ffcc01"></a>
                        <a href="#" class="color" style="background-color: #ca6d00;"></a>
                        <a href="#" class="color" style="background-color: #1c93cb;"></a>
                        <a href="#" class="color" style="background-color: #ccc;"></a>
                        <a href="#" class="color" style="background-color: #333;"></a>
                    </div>
                </div>
                <div class="product-form product-variation-form product-size-swatch">
                    <label class="mb-1">سایز :</label>
                    <div class="flex-wrap d-flex align-items-center product-variations">
                        <a href="#" class="size">کوچک </a>
                        <a href="#" class="size">متوسط </a>
                        <a href="#" class="size">بزرگ </a>
                        <a href="#" class="size">خبلی بزرگ </a>
                    </div>
                    <a href="#" class="product-variation-clean">پاک کردن همه </a>
                </div>

                <div class="product-variation-price">
                    <span></span>
                </div>

                <div class="product-form">
                    <div class="product-qty-form">
                        <div class="input-group">
                            <input class="quantity form-control" type="number" min="1" max="10000000">
                            <button class="quantity-plus w-icon-plus"></button>
                            <button class="quantity-minus w-icon-minus"></button>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-cart">
                        <i class="w-icon-cart"></i>
                        <span>افزودن به سبد  </span>
                    </button>
                </div>

                <div class="social-links-wrapper">
                    <div class="social-links">
                        <div class="social-icons social-no-color border-thin">
                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                            <a href="#" class="social-icon social-pinterest fab fa-pinterest-p"></a>
                            <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                            <a href="#" class="social-icon social-youtube fab fa-linkedin-in"></a>
                        </div>
                    </div>
                    <span class="divider d-xs-show"></span>
                    <div class="product-link-wrapper d-flex">
                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                        <a href="#"
                           class="btn-product-icon btn-compare btn-icon-left w-icon-compare"><span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Quick view -->
<div class="modal-filter">
    <div class="d-flex flex-column justify-content-between  modal-filter-box">
        <div style="border-bottom: 1px solid" class="d-flex justify-content-between mb-3">
            <span style="font-size: 18px" class="mb-3 font-weight-bold"> ترتیب نمایش:</span>
            <span id="btn-close-modal" class="mb-3 font-weight-bold">
      <i style="font-size: 18px !important;" class="fa fa-times-circle"></i>
      </span>
        </div>
        <div class="mb-3 box-radio">
            <label for="sort-0">پیش فرض</label>
            <input onclick="change_sort(0)" name="sort" value="0" id="sort-0" type="radio">
        </div>
        <div class="mb-3 box-radio">
            <label for="sort-5">پر فروش ترین</label>
            <input onclick="change_sort(5)" name="sort" value="5" id="sort-5" type="radio">
        </div>
        <div class="mb-3 box-radio">
            <label for="sort-4">ارزان ترین</label>
            <input onclick="change_sort(4)" name="sort" value="4" id="sort-4" type="radio">
        </div>
        <div class="mb-3 box-radio">
            <label for="sort-3">گران ترین</label>
            <input onclick="change_sort(3)" name="sort" value="3" id="sort-3" type="radio">
        </div>
        <div class="mb-3 box-radio">
            <label for="sort-1">جدید ترین</label>
            <input onclick="change_sort(1)" name="sort" value="1" id="sort-1" type="radio">
        </div>
        <div class="mb-3 box-radio">
            <label for="sort-2">قدیمی ترین</label>
            <input onclick="change_sort(2)" name="sort" value="2" id="sort-2" type="radio">
        </div>

    </div>
</div>
<!--<div class="wrapper">-->

<!--    <div class="menu-object">-->
<!--        <ul class="toggle icon-social">-->
<!--         <li title="پشتیبانی آنلاین" class="ico01 icon-social">-->
<!--                <img src="{{asset('home/images/icons/support.svg')}}">-->
<!--            </li>-->
<!--            <li class="move-ico ico02 icon-social">-->
<!--                <a href="https://wa.me/9122898074" target="_blank" class="link link01">-->
<!--                    <svg viewBox="0 0 32 32" class="whatsapp-ico"><path d=" M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z" fill-rule="evenodd"></path></svg>                </a>-->
<!--            </li>-->
<!--            <li style="    background-color: var(--color-primary);-->
<!--    /* margin-right: 10px; */-->
<!--    overflow: hidden;" class="move-ico ico03 icon-social">-->
<!--                <a style="display: flex;-->
<!--    justify-content: center;-->
<!--    align-items: center;" href="https://t.me/+989122898074" target="_blank" class="link link02">-->
<!--                  <img style="height: 44px;-->
<!--    width: 44px;" src="{{asset('home/images/icons/telegram2.png')}}">-->
<!--                </a>-->
<!--            </li>-->
<!--            <li class="move-ico ico04 icon-social">-->
<!--                <a href="tel:09122898074" target="_blank" class="link link03">-->
<!--                    <img src="{{asset('home/images/icons/telephone.png')}}">-->
<!--                </a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<!--</div>-->
<!-- LOGIN MODAL -->
@include('auth.login_modal')

<!-- Plugin JS File -->
<script src="{{ asset('home/vendor/jquery/jquery.min.js') }}"></script>
<!-- Main JS File -->
<script src="{{ asset('home/js/main.min.js') }}"></script>
<script src="{{ asset('home/js/plugins/plugins.js') }}"></script>

<script src="{{ asset('home/vendor/sticky/sticky.min.js') }}"></script>
<script src="{{ asset('home/vendor/jquery.plugin/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('home/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('home/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('home/vendor/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('home/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('home/vendor/zoom/jquery.zoom.js') }}"></script>
<script src="{{ asset('home/vendor/photoswipe/photoswipe.min.js') }}"></script>
<script src="{{ asset('home/vendor/photoswipe/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ asset('home/vendor/parallax/parallax.min.js') }}"></script>
<script src="{{ asset('home/vendor/jquery.countdown/jquery.countdown.min.js') }}"></script>
<!-- Bootstrap JS File -->
<script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
<!-- LeafLet JS File -->
<script src="{{ asset('home/js/leaflet.js') }}"></script>
{{--//rating js--}}
<script src="{{ asset('home/js/rating.js') }}"></script>

<script src="{{ asset('home/js/persiannumber.js') }}"></script>

@yield('script')
@livewireStyles


{{--//global functions--}}
{{--    //modal login--}}
<script>
    $('.search-header-mobile').click(function () {
        $('#search_input_mobile').slideToggle();
        $('html,body').animate({scrollTop: 0}, 600);
    })
    $('.loginWithSMS').click(function () {
        $('.DefaultLogin').hide();
        $('.SMSLoginBox').show();
    })
    $('.SwitchToDefaultLogin').click(function () {
        $('.SMSLoginBox').hide();
        $('.DefaultLogin').show();
    })
    $('#checkOTPForm').hide();
    $('#resendOTPButton').hide();
    //ready to Send Code Ajax
    let login_token;
    $('#loginOTPForm').submit(function (event) {
        var cellphone = $('#cellphoneInput').val();
        event.preventDefault();
        $.post("{{ url('/smsLogin') }}", {
            '_token': "{{ csrf_token() }}",
            'cellphone': cellphone
        }, function (response, status) {
            console.log(response, status);
            login_token = response.login_token;
            swal({
                icon: 'success',
                button:null,
                text: 'رمز یکبار مصرف برای شما ارسال شد',
                timer: 2000
            });
            $('#loginOTPForm').fadeOut();
            $('#checkOTPForm').fadeIn();
            timer();

        }).fail(function (response) {
            console.log(response.responseJSON);
            $('#cellphoneInput').addClass('mb-1');
            $('#cellphoneInputError').fadeIn()
            $('#cellphoneInputErrorText').html(response.responseJSON.errors.cellphone[0])
        })
    })

    //ready to check Code and login Ajax
    $('#checkOTPForm').submit(function (event) {
        let otp = $('#checkOTPInput').val();
        let is_product_page = "{{ request()->is('product/*') }}";
        event.preventDefault();
        $.post("{{ url('/check-otp') }}", {
            '_token': "{{ csrf_token() }}",
            'otp': otp,
            'login_token': login_token
        }, function (response, status) {
            swal({
                title: "ورود با موفقیت انجام شد",
                icon: 'success',
                button:null,
                text: 'لطفا دوباره عملیات خود را تکرار نمایید',
                timer: 5000
            });
            setTimeout(function (){
                let login_modal = $('#login_modal');
                login_modal.modal('hide');
                setTimeout(function () {
                    if (is_product_page) {
                        window.location.reload();
                    } else {
                        $('#addToCartBtn').trigger('click');
                    }
                }, 1000)
            },5000)



        }).fail(function (response) {
            // console.log(response.responseJSON);
            $('#checkOTPInput').addClass('mb-1');
            $('#checkOTPInputError').fadeIn()
            $('#checkOTPInputErrorText').html(response.responseJSON.errors.otp[0])
        })
    });
    var elementPosition = $('header').height();
    var heightScroll = $('.height-scroll').height();
    const mediaQuery = window.matchMedia('(max-width: 867px)');
    $(window).scroll(function () {
        $('#order_status_header_mobile').hide();
    })

    $(window).scroll(function () {
        if ($(window).scrollTop() > elementPosition && mediaQuery.matches) {
            $('header').css('position', 'sticky').css('top', 0).css('z-index', '999');
        } else {
            $('header').css('position', 'static');
        }
    });


    //resend Code
    $('#resendOTPButton').click(function (event) {
        event.preventDefault();
        $.post("{{ url('/resend-otp') }}", {
            '_token': "{{ csrf_token() }}",
            'login_token': login_token
        }, function (response, status) {
            console.log(response, status);
            login_token = response.login_token;
            swal({
                icon: 'success',
                text: 'رمز یکبار مصرف برای شما ارسال شد',
                button:null,
                timer: 2000
            });
            $('#resendOTPButton').fadeOut();
            timer();
            $('#resendOTPTime').fadeIn();
            $('#resendCodeDiv').fadeIn();

        }).fail(function (response) {
            console.log(response.responseJSON);
            swal({
                icon: 'error',
                text: 'مشکل در ازسال مجدد رمز یکبار مصرف.دوباره تلاش کنید',
                button:null,
                timer: 2000
            });
        })
    })

    //timer for resend Code
    function timer() {
        let time = "2:01";
        let interval = setInterval(function () {
            let countdown = time.split(':');
            let minutes = parseInt(countdown[0], 10);
            let seconds = parseInt(countdown[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) {
                clearInterval(interval);
                $('#resendOTPTime').hide();
                $('#resendCodeDiv').hide();
                $('#resendOTPButton').fadeIn();
            }
            ;
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $('#resendOTPTime').html(minutes + ':' + seconds);
            time = minutes + ':' + seconds;
        }, 1000);
    }

    function login_modal() {
        $('#cellphoneInput').val('');
        $('#checkOTPInput').val('');
        let login_modal = $('#login_modal');
        login_modal.modal('show');
    }

    //add To CompairList
    function AddToCompareList(event, productId) {
        event.preventDefault();
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
                    $('#compare_count').text(count);
                    $('#Compare_Items').html(msg[2]);
                }
            },
            error: function () {
                console.log("something went wrong");
            },
        });
    }

    function AddToCart(product_id,
                       quantity,
                       is_single_page = 0,
                       product_has_variation = null,
                       variation_id = null,
                       product_has_color = null,
                       color_id = null,
                       product_has_option = null,
                       option_ids = null) {

        $.ajax({
            url: "{{ route('home.cart.add') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id,
                quantity: quantity,
                is_single_page: is_single_page,
                product_has_variation: product_has_variation,
                variation_id: variation_id,
                product_has_color: product_has_color,
                color_id: color_id,
                product_has_option: product_has_option,
                option_ids: option_ids,

            },
            success: function (msg) {
                if (msg[0] == 0) {
                    if (msg[1] == 'quantity') {
                        swal({
                            title: "متاسفیم",
                            text: "تعداد بیشتری از این کالا در انبار موجود نیست",
                            icon: "error",
                            timer: 3000,
                        })
                    }
                    if (msg[1] == 'price_error') {
                        swal({
                            title: "متاسفیم",
                            text: "جهت استعلام قیمت با پشتیبانی تماس بگیرید",
                            icon: "error",
                            timer: 3000,
                        })
                    }
                    if (msg[1] == 'sale_off') {
                        swal({

                            text: "متاسفانه در حال حاضر امکان فروش این کالا وجود ندارد",
                            icon: "error",
                            timer: 5000,
                             button: false
                        })
                    }
                    if (msg[1] == 'sale_for_legal') {
                        swal({
                            title: "متاسفیم",
                            text: "فروش این کالا فقط برای افراد حقیقی امکان پذیر است",
                            icon: "error",
                            timer: 3000,
                        })
                    }
                    if (msg[1] == 'login') {
                        // window.location.href = msg[2];
                        login_modal();

                    }
                }
                if (msg[0] == 1) {
                    if (msg[1] == 'ok') {
                        swal({

                            text: "محصول به سبد خرید افزوده شد",
                            icon: "success",
                            timer: 5000,
                            button: false
                        });
                        UpdateCart();
                    }
                }
                if (msg[0] == 'has_attr') {
                    window.location.href = msg[1];
                }
                if (msg[0] == 'has_option') {
                    window.location.href = msg[1];
                }

            },
            error: function () {
                console.log("something went wrong");
            },
        });
    }

    //updateCart
    function UpdateCart() {
        $.ajax({
            url: "{{ route('home.cart.get') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (msg) {
                if (msg[0] == 'ok') {
                    let cartTotal = msg[1];
                    let count = msg[2];
                    let productsInCart = msg[3];
                    $('.cart-total').html(cartTotal);
                    $('.cart-count').text(count);
                    $('#CartItems').html(productsInCart);
                    $('.cart-toggle').trigger('click');
                }
            },
            error: function () {
                console.log("something went wrong");
            },
        });
    }

    //add To WishList
    function AddToWishList(tag, event, productId) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('home.wishlist.add') }}",
            type: "POST",
            dataType: "json",
            data: {
                productId: productId,
                _token: "{{ csrf_token() }}"
            },
            success: function (msg) {
                if (msg[0] == 'ok') {
                    swal({
                        text: "محصول به لیست علاقه‌مندی های شما افزوده شد",
                        icon: "success",
                        timer: 5000,
                        buttons: false,
                    })
                    $(tag).find('i').addClass('color-red');
                    $(tag).removeAttr('onclick');
                    $(tag).attr('onclick', 'RemoveFromWishList(this,event,' + productId + ')');
                    wishListUpdate();
                }
                if (msg[0] == 'exist') {
                    swal({
                        title: "دقت کنید",
                        text: "کالای مورد نظر در لیست علاقه‌مندی های شما موجود است",
                        icon: "warning",
                        timer: 3000,
                    })
                }
                if (msg[0] == 'login') {
                    swal({
                        title: "دقت کنید",
                        text: "ابتدا باید وارد شوید",
                        icon: "warning",
                        timer: 1500,
                    });
                    setTimeout(function () {
                        login_modal();
                    },1500)
                }
            },
            error: function () {
                console.log("something went wrong");
            },
        });
    }

    //remove from wishlist
    function RemoveFromWishList(tag, event, productId) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('home.wishlist.remove') }}",
            type: "POST",
            dataType: "json",
            data: {
                productId: productId,
                _token: "{{ csrf_token() }}"
            },
            success: function (msg) {
                if (msg[0] == 'ok') {
                    swal({

                        text: " محصول از لیست علاقه‌مندی های شما حذف شد",
                        icon: "success",
                        buttons: false,
                        timer: 5000,
                    })
                    $(tag).find('i').removeClass('color-red');
                    $(tag).removeAttr('onclick');
                    $(tag).attr('onclick', 'AddToWishList(this,event,' + productId + ')');
                    wishListUpdate();
                }
                if (msg[0] == 'login') {
                    swal({
                        title: "دقت کنید",
                        text: "ابتدا باید وارد شوید",
                        icon: "warning",
                        timer: 3000,
                    })
                }
            },
            error: function () {
                console.log("something went wrong");
            },
        });
    }

    //update wishListCount
    function wishListUpdate() {
        $.ajax({
            url: "{{ route('home.wishlist.get') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (msg) {
                $('.wishListCount').text(msg[0]);
            },
            error: function () {
                console.log("something went wrong");
            },
        });

    }

    //remove cart sideBar
    function cart_side_bar(cart_id) {
        $.ajax({
            url: "{{ route('home.cart.remove') }}",
            data: {
                _token: "{{ csrf_token() }}",
                cart_id: cart_id,
            },
            dataType: "json",
            type: 'POST',
            beforeSend: function () {

            },
            success: function (msg) {
                console.log(msg);
                if (msg) {
                    if (msg[0] == 1) {
                        UpdateCart();
                    }
                    if (msg[0] == 0) {
                        let message = msg[1];
                        swal({
                            title: 'error',
                            text: message,
                            icon: 'error',
                              timer: 5000,
                             button: false
                        })
                    }
                }
            },
        })
    }

    //remove compare sideBar
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

    function search_header() {
        $('#divParent').hide();
        $('#product_search_box').html('');
        let value = $('#search_input').val();
        let brand = $('#brand').val();
        if (value.length > 1) {
            $.ajax({
                url: "{{ route('home.product.search') }}",
                data: {
                    title: value,
                    brand: brand,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg[0] == 1) {
                        let products = msg[1];
                        $('#product_search_box').html(products);
                        $('#divParent').show();
                        $('#product_search_box').slideDown(500);
                    }
                },
                error: function () {

                }
            })
        }
    }

    function search_header_mobile() {
        $('#divParent_mobile').hide();
        $('#product_search_box_mobile').html('');
        let value = $('#search_input_mobile').val();
        let brand = 0;
        if (value.length > 1) {
            $.ajax({
                url: "{{ route('home.product.search') }}",
                data: {
                    title: value,
                    brand: brand,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function () {

                },
                success: function (msg) {
                    console.log(msg[1]);
                    if (msg[0] == 1) {
                        let products = msg[1];
                        $('#product_search_box_mobile').html(products);
                        $('#divParent_mobile').show();
                        $('#product_search_box_mobile').slideDown(500);
                        $('#mobile_search_icon').hide();
                        $('#mobile_close_icon').show();
                    }
                },
                error: function () {

                }
            })
        }
    }

    $('#search_input').blur(function () {
        $('#divParent').slideUp(1000);
    })
    $('#mobile_close_icon').click(function () {
        $('#divParent_mobile').slideUp(1000);
        $('#mobile_search_icon').show();
        $('#mobile_close_icon').hide();
    })

    function search_status_order() {
        let order_number = $('#check_order_status_input').val();

        if (order_number.length > 1) {
            $.ajax({
                url: "{{ route('home.check_order') }}",
                data: {
                    order_number: order_number,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function () {
                    $('#order_status_header').html('<span>در حال جست و جو...</span>');
                    $('#order_status_header').show();
                },
                success: function (msg) {
                    if (msg) {
                        if (msg[0] == 1) {
                            $('#order_status_header').html(msg[1]);
                            $('#order_status_header').show();
                        }
                    }
                },
                error: function () {

                }
            })
        } else {
            $('#order_status_header').hide();
        }
    }


    function search_status_order_mobile() {
        $('#order_status_header_mobile').html('');
        let order_number = $('#check_order_status_input_mobile').val();
        if (order_number.length > 1) {
            $.ajax({
                url: "{{ route('home.check_order') }}",
                data: {
                    order_number: order_number,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function () {
                    $('#order_status_header_mobile').html('<span>در حال جست و جو...</span>');
                    $('#order_status_header_mobile').show();
                },
                success: function (msg) {
                    if (msg) {
                        if (msg[0] == 1) {
                            $('#order_status_header_mobile').html(msg[1]);
                            $('#order_status_header_mobile').show();
                        }
                    }
                },
                error: function () {

                }
            })
        } else {
            $('#order_status_header_mobile').hide(1000);
        }
    }

    $('#check_order_status_btn').click(function () {
        $('#check_order_status_input').show(1000);
    })
    $('#check_order_status_btn_mobile').click(function () {
        $('#check_order_status_input_mobile').slideToggle();
    })

    function informMe(product_id) {
        $.ajax({
            url: "{{ route('product.informMe') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id,
            },
            success: function (msg) {
                if (msg[0] == 0) {
                    if (msg[1] == 'login') {
                        login_modal();
                    }
                    if (msg[1] == 'exists') {
                        swal({
                            title: "دقت کنید",
                            text: "این کالا از قبل در لیست در انتظار موجودی شما وجود دارد",
                            icon: "warning",
                            button: false,
                        });
                    }
                }
                if (msg[0] == 1) {
                    if (msg[1] == 'ok') {
                        swal({
                            text: "موجود شدن این محصول از طریق پیامک به اطلاع شما خواهد رسید",
                            icon: "success",
                            timer: 5000,
                            button: false,
                        });
                    }
                }
            },
            error: function () {
                console.log("something went wrong");
            },
        });
    }

    $('.compare-dropdown').click(function () {
        $(this).addClass('opened');
    });

</script>

@if(request()->is('/'))
    <script>
        $('.category-dropdown').addClass('show');
    </script>
@endif

@include('sweet::alert')
@livewireScripts
<script>
    Livewire.on('showTimerForResendOtp', () => {
        timerForResendOtp();
    })
    {{--//timer for resend Code--}}
    function timerForResendOtp() {
        let resendOTPTime = $('#resendOTPTime');
        resendOTPTime.removeClass('d-none');
        $('#resendCodeDiv').removeClass('d-none');
        let time = "2:00";
        let interval = setInterval(function () {
            let countdown = time.split(':');
            let minutes = parseInt(countdown[0], 10);
            let seconds = parseInt(countdown[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) {
                clearInterval(interval);
                resendOTPTime.addClass('d-none');
                $('#resendCodeDiv').addClass('d-none');
                $('#resendOTP').removeClass('d-none');
            }
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            resendOTPTime.html(minutes + ':' + seconds);
            time = minutes + ':' + seconds;
        }, 1000);
    }

    $('#mobile_menu_nav').click(function () {
        $('#mobile_menu_nav_ul').slideToggle(1000);
    })
    $('#check_order_status_btn').click(function () {
        $('#check_order_status_btn').hide();
        $('#check_order_status_btn_icon').hide();
        $('#check_order_status_input').show();
    })


</script>

<!-- Start of Scroll Top -->
<a id="scroll-top" class="scroll-top" href="#top" title="بالا" role="button"> <i class="w-icon-angle-up"></i>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
        <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
                r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
    </svg>
</a>
<!-- End of Scroll Top -->
</body>
</html>
