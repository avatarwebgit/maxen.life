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
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<!-- شامل کردن JS برای Swiper -->
    <style>

    .details-banner{
        position: absolute;
  bottom: -5%;
  right: 10%;
  display: flex;

  flex-direction: column;
  align-items: start;
  min-height: 250px;
    }
    .product-text{
        color:#fff;
    }






    .margin-0{
        margin:0 !important;
    }
    .padding-0{
        padding:0;
    }


    @media (min-width:997px){

        .log-container{
            max-width:88% !important;position:absolute;    top: 0;
    left: 5%;
        }
    }




    .swiper-button-prev,.swiper-button-next{
        display:none !important;
    }
    .swiper-container {
    width: 100%;
    height: 100%;
}

    .swiper-container{
        padding: 0 7%;
    }


    .swiper-banner {
    width: 100%;
    height: 100%;
}

    .swiper-banner{
        padding: 0 7%;
    }

.swiper-slide {


    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden; /* جلوگیری از نمایش تصویر خارج از اسلاید */
}

.swiper-slide img {
    width: 100%; /* یا می‌توانید از max-width و max-height استفاده کنید */
    height: auto;
}
    .img-main-logo{
        display:none;
    }
    .fas{
        color:#000;
    }
    @media (min-width:1024px) and (max-width:1680px){
            .lcc-modal{
        top:70% !important;
    }
    }

.tooltip-support{
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:25px;
    margin-top:10px;
flex-direction: row-reverse;
  transition:all .6s ease;
}
.tooltip-support p{
opacity:0;
margin-left:5px;
font-size:16px;
  transition:all .8s ease;

}





.tooltip-service svg,.tooltip-support svg{
        border: 1px solid;
    border-radius: 50%;
    padding: 6px;
}
.tooltip-service{
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:25px;
    margin-top:10px;
flex-direction: row-reverse;
  transition:all .6s ease;
}
.tooltip-service p{
opacity:0;
margin-left:5px;
font-size:16px;
  transition:all .8s ease;

}
.tooltip-support::before {
 position: absolute;
 top: -16px;
 left: 50%;
 transform: translatex(-50%) rotate(-45deg);
 content: "";
 display: none;
 width: 0;
 height: 0;
 border: 8px solid #c3c3c3;
 border-top-color: transparent;
 border-right-color: transparent;
}

.tooltip-support::after {
 display: none;
 position: absolute;
 content: attr(data-tooltip);
 bottom: calc(100% + 8px);
 left: 0;
 right: -80px;
 text-align:center;
    min-width: 243px;
    padding: 8px;
    font-size: 21px;

 background-color: #c3c3c3;
 border-radius: 8px;
 color: #000;
}

.tooltip-support:hover:not(:focus)::before,
.tooltip-support:hover:not(:focus)::after {
 display: block;
}

.tooltip-service::before {
 position: absolute;
 top: -16px;
 left: 50%;
 transform: translatex(-50%) rotate(-45deg);
 content: "";
 display: none;
 width: 0;
 height: 0;
 border: 8px solid #c3c3c3;
 border-top-color: transparent;
 border-right-color: transparent;
}

.tooltip-service::after {
 display: none;
 position: absolute;
 content: attr(data-tooltip);
 bottom: calc(100% + 8px);
 left: 0;
 right: -80px;
    min-width: 243px;
    padding: 8px;
    font-size: 21px;
    text-align:center;
 background-color: #c3c3c3;
 border-radius: 8px;
 color: #000;
}

.tooltip-service:hover:not(:focus)::before,
.tooltip-service:hover:not(:focus)::after {
 display: block;
}

.tooltip-service,.tooltip-support{
    padding: 0 5px 0 8px;
    position:relative;
}

.slick-arrow{
    display:none !important;
}

.tooltip-service,.tooltip-support{
    font-size:40px;

}

@keyframes fadeIn {
  0% {
    opacity: 0;
    visibility: visibale;

  }
  50% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

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

        .detail-slider{
            bottom: 0;
            z-index: 99999;

            padding: 0 5%;
                padding-bottom:60px;
            position: absolute;
        }
        .des-slider{
            border: 1px solid #000;
    border-radius: 17px;
    padding: 7px 16px;
            text-align: left;
            color: #000;
        }

        .text-slider{
            display:flex;
            align-items:flex-end;
        }
        .des-slider p {

        line-height: 120%;
        font-size:11px;
        }
.section-margin{
    margin-top:60px;
    margin-bottom:60px;
}
        .cookie-slider{
            border: 1px solid #9b9b9b;
            border-radius: 20px;

            text-align: left;
            color: #000;
            width: fit-content;
        }
        .intro-about h1{
            text-align:left;
            font-size:82px !important;
            line-height:75px;
            text-transform: uppercase;
        }

        .our-work h2{
            font-size:228px;
        }


@media  (max-width:992px){
            .text-mobile-mobile{
                line-height: 48px;
    text-align: justify;
    font-size:38px;
    word-spacing: -8px;
        }

                .intro-about h1{
            text-align:justify;
            font-size:18px !important;
            line-height:27px !important;
        }

}
       .swiper-banner .swiper-wrapper{
            direction:ltr !important;
        }
.align-item-end{
    align-items:flex-end;
}





        @media (max-width:992px) {
            .intro-about h1{
                text-align:left !important;
            }
        }
    </style>

    @if(app()->getLocale() == 'en')

    <style>
    @media (max-width:1480px){
            .text-slider h2{
        font-size:35px !important;
    }
    }
        .tooltip-support::after,.tooltip-service::after {
            right:unset;
            left:-80px;
        }
    </style>


    @endif


    @if(app()->getLocale() == 'fa')

    <style>
    .justify-end-rtl{
        justify-content:end;
    }
    .text-slider h2{
        font-size:35px !important;
    }
                .intro-about h1{
            text-align:right !important;

        }

        .swiper-banner .swiper-wrapper{
            direction:rtl !important;
        }





        @media (min-width:1480px){
    .intro-about h1{
        line-height:103px !important;
    }
}

    </style>

    @endif

    <style>

    .text-dark{
        color:#000 !important;
    }
    .text-grey{
        color:#aaa6a6 !important;
    }
            @media (max-width:1280px){
        .site-header{
            padding:30px 0 !important;
        }
        .site-header .inner-header .main-logo img{
            height:25px !important;
        }

        .intro-about h1{
                font-size: 20px !important;
    line-height: 33px !important;
        }
    }
.section-scroll{
    height:100vh;
}

@media (max-width:576px){
    .site-header{
        padding:30px !important;
    }
}
    @media (min-width:1420px) and (max-width:1480px){
        .intro-about h1{
            font-size:69px !important;
            line-height:66px;
        }
        .site-header{
            padding:40px 0;
        }
    }

html {
    scroll-behavior: smooth !important; /* این خط انیمیشن نرم برای اسکرول اضافه می‌کند */
}


@media (min-width:412px) and (max-width:455px){


    .site-header.has-scroll-header{
        padding:30px 15px !important;
    }
    #dsn-hero-parallax-title p.has-scroll-header{
        top:5% !important;
        left:4% !important;
    }
}

@media (min-width:455px){


    .site-header.has-scroll-header{
        padding:35px 7.6% !important;
    }
    #dsn-hero-parallax-title p.has-scroll-header{
        top:6% !important;
        left:7% !important;
    }

}

@media (min-width:455px) {
            #dsn-hero-parallax-title img.has-scroll-header{

        transform:scale(0.5) !important;
        left:-21% !important;
        top:0% !important;
    }
}

@media (min-width:455px) {
            #dsn-hero-parallax-title img.has-scroll-header{

        transform:scale(0.4) !important;
        left:-21% !important;
    }
}

@media (min-width:625px) and (max-width:768px) {
            #dsn-hero-parallax-title img.has-scroll-header{

   top:-0.7% !important;
    }


}

html,body{
    overflow-x:hidden !important;
}

@media (min-width:320px) and (max-width:768px) {
    .extend-container.row-md{
        padding: 0 4.6% !important;
    }
}
@media (min-width:768px){
            .log-container{
            max-width:88% !important;position:absolute;    top: 0;
    left: 5%;
        }
}



@media (min-width:768px) and (max-width:992px) {
    #dsn-hero-parallax-title img{
        position: relative;
  right: unset !important;
  z-index: 99 !important;
  width: 94% !important;
  left: -9% !important;
  top: 4% !important;
    }
}
@media (min-width:768px) and (max-width:867px) {
   .extend-container.row-md{
        padding: 0 8.6% !important;
    }
}
@media (min-width:992px) and (max-width:1155px) {
    #dsn-hero-parallax-title img{
        position: relative;
  right: 4.1% !important;
  z-index: 99 !important;
  width: 94% !important;
  top: 2% !important;
    }
}

@media (min-width:300px) and (max-width:400px){
    #dsn-hero-parallax-title p {
        top: 8%;
        color: #000;
        font-size: 13px;
        left: 7.8%;
    }
    #dsn-hero-parallax-title p.has-scroll-header{
                top: 5%;
        color: #000;
        font-size: 13px;
        left: 4.8%;
    }
        #dsn-hero-parallax-title img.has-scroll-header {
        transform: scale(0.4) !important;
        left: -20% !important;
        top: 1% !important;
    }
}

@media (min-width:300px) and (max-width:455px){

        #dsn-hero-parallax-title img.has-scroll-header {
        transform: scale(0.4) !important;
        left: -24% !important;
        top: 1% !important;
    }
}

    @media (min-width:320px) and (max-width:411px) {
    #dsn-hero-parallax-title p.has-scroll-header{
        top: 5%;
  color: #000;
  font-size: 16px;
  left: 4.8%;
    }
}



    </style>

    @if(app()->getLocale() == 'en')
    <style>
            @media (min-width:1120px) and (max-width:1480px){
        .intro-about h1{
            font-size:69px !important;
            line-height:66px !important;
        }
        .site-header{
            padding:40px 0;
        }
    }


    .text-en-mobile{
            position: absolute;
    left: 5%;
    bottom: 10%;
    color: #000;
    font-weight: 800;
    font-size: 40px;
    width: 67%;
    text-align: left;
    }
    </style>
    @endif
    <style>
        @media (max-width:1280px) {
            .intro-about h1{
                letter-spacing:2px !important;
            }
        }
    </style>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
function changeLang(url,event)
{
     event.stopPropagation();
     window.location.href = url;

}

    let rtl = {{app()->getLocale() == 'fa' ? 1 : 0}};

    if(rtl){
                var swiper = new Swiper('.swiper-container', {

         slidesPerView: 1,
      spaceBetween:30,

      rtl:false,
             breakpoints: {

    768: {

      slidesPerView: 4, // در حالت تبلت دو آیتم

    },

    1024: {

      slidesPerView: 4, // در حالت دسکتاپ سه آیتم

    }

  }

    });

    }else{
                var swiper = new Swiper('.swiper-container', {

         slidesPerView: 1,
      spaceBetween:30,
      initialSlide: 2,
                    loop:true,
                    autoplay:true,
      rtl:false,
       breakpoints: {

    768: {

      slidesPerView: 4, // در حالت تبلت دو آیتم

    },

    1024: {

      slidesPerView: 4, // در حالت دسکتاپ سه آیتم

    }

  }

    });

    }


    if(rtl){
           var swiper = new Swiper('.swiper-banner', {

         slidesPerView: 1,
      spaceBetween:20,
      rtl:true,
  on: {
    init: function () {
      updateSelectedSlide(this);
    },
    slideChange: function () {
      updateSelectedSlide(this);
    },
  },




    });

 // تابع برای بروزرسانی آیتم انتخاب شده
function updateSelectedSlide(swiper) {
  // حذف کلاس 'selected' از همه آیتم‌ها
  swiper.slides.forEach(slide => {
    slide.classList.remove('selected');
  });

  // اضافه کردن کلاس 'selected' به آخرین آیتم
  const lastSlide = swiper.slides[swiper.slides.length - 1];
  lastSlide.classList.add('selected');
}
    }else{
           var swiper = new Swiper('.swiper-banner', {

         slidesPerView: 1,
      spaceBetween:20,
      rtl:false



    });
    }


try{
        let tag_p = $('.main-logo p');
 var x = window.matchMedia("(max-width: 700px)")

 if(!x.matches){

$(document).scroll(function(){
        var distanceFromTop = window.scrollY;

        if (distanceFromTop > 70) {
                $('.site-header').css('border-bottom','1px solid rgb(204, 204, 204)');
                $('.site-header').css('background-color','rgb(255, 255, 255)');
                $('.img-main-logo').css('display','block');
                $('.img-main-logo').css('height','33px');
                tag_p.css('font-size','17px');
                $('.site-header').css('padding','30px 0px');
                $('.main-logo').css('display','flex');
                $('.main-logo').css('flex-direction','column');
                $('.main-logo').css('justify-content','end');
                tag_p.css('text-align','left');
        }else{
                $('.site-header').css('border-bottom','none');
                $('.site-header').css('background-color','transparent');
                $('.img-main-logo').css('display','none');
                $('.site-header').css('padding','60px 0px');
                $('.main-logo').css('display','block');
                tag_p.css('text-align','unset');
                tag_p.css('font-size','35px');
        }

});

}else{
    $(document).scroll(function(){
        var distanceFromTop = window.scrollY;

        if (distanceFromTop >= 110) {
                 console.log(distanceFromTop);



                $('#dsn-hero-parallax-title img').css('left','-15% !important');
       $('#dsn-hero-parallax-title img').css('transform','scale(0.6) !important');
          $('#dsn-hero-parallax-title img').css('top','1% !important');
      $('#dsn-hero-parallax-title ').css('z-index','99999999999999999999999999');
                $('.main-logo p').css('font-size','12px');
                $('.main-logo p').css('margin-top','24px');
                $('.main-logo p').css('transform','translateY(10px)');


                $('.site-header').css('border-bottom',' 1px solid rgb(204, 204, 204)');
                $('.site-header').css('background-color','rgb(255, 255, 255)');

                $('.main-logo .search-toggler').css('display','none');
                                $('.main-logo .search-toggler-mobile').css('display','none');
                $('.change-lang-btn-mobile').css('display','none');


                $('#dsn-hero-parallax-title p').addClass('has-scroll-header');
                                $('.site-header').addClass('has-scroll-header');

                                $('#dsn-hero-parallax-title img').addClass('has-scroll-header');





        }else{
                  $('.main-logo p').css('font-size','23px');
                   $('.main-logo p').css('margin-top','0');
                              $('.main-logo p').css('transform','translateY(0)');


                                              $('#dsn-hero-parallax-title img').css('left','5%');
       $('#dsn-hero-parallax-title img').css('transform','scale(0.94)');
          $('#dsn-hero-parallax-title img').css('top','10%');


                    $('.main-logo .search-toggler').css('display','block');
                                        $('.main-logo .search-toggler-mobile').css('display','block');
                $('.change-lang-btn-mobile').css('display','block');
                                $('.site-header').css('border-bottom','none');
                $('.site-header').css('background-color','transparent');


                               $('#dsn-hero-parallax-title p').removeClass('has-scroll-header');
                                $('.site-header').removeClass('has-scroll-header');
                                 $('#dsn-hero-parallax-title img').removeClass('has-scroll-header');


        }

});
}
}catch(err){
    console.log(err)
}
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

        $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


    </script>
@endsection

@section('content')
    <header class="section-scroll" id="text-mobile-mobile" data-dsn-header="parallax">
        <div class="header-master">

            <div class="p-absolute w-100 h-100 over-hidden before-z-index" >
                <img  class="cover-bg-img p-relative  " src="{{ imageExist( env('SLIDER_IMAGES_UPLOAD_PATH'),$sliders[0]->image ) }}" alt="" />
                <div  class="container log-container  h-100">
                <div class="row h-100">
                    <div id="dsn-hero-parallax-title" class="content p-relative  header-no-scale-hero">
         <p class="font-helvetica d-block d-md-none">
                    Lifestyle Solution
                </p>
                        <img src="{{ imageExist(env('LOGO_UPLOAD_PATH'),$setting->image) }}">

                    </div>

                </div>



            </div>




                <div class="w-100 d-none row position-absolute d-xl-flex justify-content-between detail-slider">
                    <div class="text-slider col-2">
                        <h2>

                 {{app()->getLocale() == 'en' ?  $sliders[0]->title_en : $sliders[0]->title}}
                        </h2>
                    </div>

                     <div style="align-items: flex-end !important" class="col-4 d-flex flex-column justify-content-end  align-items-end">

<div role="dialog" aria-labelledby="lcc-modal-alert-label" aria-describedby="lcc-modal-alert-desc" aria-modal="true" class="lcc-modal lcc-modal--alert js-lcc-modal d-flex js-lcc-modal-alert" style="display: none; "
     data-cookie-key="{{ config('cookie-consent.cookie_key') }}"
     data-cookie-value-analytics="{{ config('cookie-consent.cookie_value_analytics') }}"
     data-cookie-value-marketing="{{ config('cookie-consent.cookie_value_marketing') }}"
     data-cookie-value-both="{{ config('cookie-consent.cookie_value_both') }}"
     data-cookie-value-none="{{ config('cookie-consent.cookie_value_none') }}"
     data-cookie-expiration-days="{{ config('cookie-consent.cookie_expiration_days') }}"
     data-gtm-event="{{ config('cookie-consent.gtm_event') }}"
     data-ignored-paths="{{ implode(',', config('cookie-consent.ignored_paths', [])) }}"
>
    <div class="lcc-modal__actions d-flex align-items-center">

                <button style="margin-top:0" type="button" class="lcc-button lcc-button--link js-lcc-essentials">
<img width="70" height="70" src="{{asset('home/img/minues.svg')}}">
        </button>
        <button style="margin-top:0" type="button" class="lcc-button js-lcc-accept">
<img width="70" height="70" src="{{asset('home/img/markdown.svg')}}">
        </button>

    </div>
    <div class="lcc-modal__content">
{{--        <h2 id="lcc-modal-alert-label" class="lcc-modal__title">--}}
{{--            @lang('cookie-consent::texts.alert_title')--}}
{{--        </h2>--}}
        <p id="lcc-modal-alert-desc" class="lcc-text">
        {{$setting->text_cookie_en}}
        </p>
    </div>

</div>

                        <div  class="des-slider">
                            <p>{{$sliders[0]->text_en}}</p>
                        </div>
                    </div>
                    <div class="col-3 d-flex align-item-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="280.781" height="41.013" viewBox="0 0 382.781 41.013">
  <g id="Group_36" data-name="Group 36" transform="translate(0 33.783)">
    <path id="Path_43" data-name="Path 43" d="M259,2.41H272.67V-11.261H259Z" transform="translate(55.428 4.82)" fill="#040504"/>
    <path id="Path_44" data-name="Path 44" d="M281.521-8.851h27.341V-22.522H281.521Z" transform="translate(60.247 2.41)" fill="#040504"/>
    <path id="Path_45" data-name="Path 45" d="M304.043,2.41h13.671V-11.261H304.043Z" transform="translate(65.067 4.82)" fill="#040504"/>
    <path id="Path_46" data-name="Path 46" d="M94.907-22.522H67.565V-8.851H94.907Z" transform="translate(14.459 2.41)" fill="#040504"/>
    <path id="Path_47" data-name="Path 47" d="M33.783-8.851H61.124V-22.522H33.783Z" transform="translate(7.23 2.41)" fill="#040504"/>
    <path id="Path_48" data-name="Path 48" d="M56.3,2.41H69.975V-11.261H56.3Z" transform="translate(12.049 4.82)" fill="#040504"/>
    <path id="Path_49" data-name="Path 49" d="M112.608-8.851h13.671V-22.522H112.608Z" transform="translate(24.099 2.41)" fill="#040504"/>
    <path id="Path_50" data-name="Path 50" d="M236.478,2.41h13.671V-11.261H236.478Z" transform="translate(50.608 4.82)" fill="#040504"/>
    <path id="Path_51" data-name="Path 51" d="M236.478-20.112h13.671V-33.783H236.478Z" transform="translate(50.608 0)" fill="#040504"/>
    <path id="Path_52" data-name="Path 52" d="M123.869-20.112h13.672V-33.783H123.869Z" transform="translate(26.509 0)" fill="#040504"/>
    <path id="Path_53" data-name="Path 53" d="M241.3-22.522H213.957V-8.851H241.3Z" transform="translate(45.788 2.41)" fill="#040504"/>
    <path id="Path_54" data-name="Path 54" d="M101.348,2.41h13.67V-11.261h-13.67Z" transform="translate(21.689 4.82)" fill="#040504"/>
    <path id="Path_55" data-name="Path 55" d="M101.348-20.112h13.67V-33.783h-13.67Z" transform="translate(21.689 0)" fill="#040504"/>
    <path id="Path_56" data-name="Path 56" d="M123.869,2.41h13.672V-11.261H123.869Z" transform="translate(26.509 4.82)" fill="#040504"/>
    <path id="Path_57" data-name="Path 57" d="M162.472-22.522H135.131V-8.851h27.341Z" transform="translate(28.919 2.41)" fill="#040504"/>
    <path id="Path_58" data-name="Path 58" d="M157.652,2.41h13.671V-11.261H157.652Z" transform="translate(33.739 4.82)" fill="#040504"/>
    <path id="Path_59" data-name="Path 59" d="M202.7,2.41h13.671V-11.261H202.7Z" transform="translate(43.378 4.82)" fill="#040504"/>
    <path id="Path_60" data-name="Path 60" d="M168.913-20.112h13.671V-33.783H168.913Z" transform="translate(36.149 0)" fill="#040504"/>
    <path id="Path_61" data-name="Path 61" d="M193.844-22.522h-13.67V-8.851h13.67Z" transform="translate(38.558 2.41)" fill="#040504"/>
    <path id="Path_62" data-name="Path 62" d="M0-8.851H27.342V-22.522H0Z" transform="translate(0 2.41)" fill="#040504"/>
  </g>
</svg>

                    </div>







                    <div class="col-3 d-flex justify-end-rtl align-item-end text-left">

<img width="320" src="{{asset('home/img/earth.svg')}}">

                    </div>

                    <!--<div>-->
                    <!--    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xli nk" width="300" height="210.273" viewBox="0 0 460.972 210.273">-->
                    <!--        <defs>-->
                    <!--            <clipPath id="clip-path">-->
                    <!--                <path id="Path_42" data-name="Path 42" d="M0,127.312H460.972V-82.961H0Z" transform="translate(0 82.961)" fill="#040504"/>-->
                    <!--            </clipPath>-->
                    <!--        </defs>-->
                    <!--        <g id="Group_33" data-name="Group 33" clip-path="url(#clip-path)">-->
                    <!--            <g id="Group_32" data-name="Group 32" transform="translate(1.353 1.352)">-->
                    <!--                <path id="Path_41" data-name="Path 41" d="M157.649,125.674v-4.717h10.415v4.717h10.415v-4.717h31.247v-4.717h20.829v-4.719h20.832V106.8H261.8v-4.717H282.63V92.654h10.417V87.934h20.829V78.5h10.415V69.064h10.415V59.63h10.417V36.043h10.415V7.74H345.123V-15.847H334.706v-9.436H324.292v-9.434H313.877v-4.719H303.462v-9.434H282.63v-4.717H272.216v-4.719H261.8v-4.717H240.972v-4.717H230.554v-4.717H199.31v-4.717H178.479v-4.719H168.064v4.719H157.649v-4.719H84.744v4.719H43.083v4.717H22.251v4.717H11.836v4.717H-8.993v4.717H-19.41v4.719H-40.239v9.434H-50.654v4.717H-61.069v4.719H-71.486V-30H-81.9v14.153H-92.315V-1.7H-102.73V3.02h10.415V7.74H-102.73v28.3h10.415V40.76H-102.73v4.717h10.415V59.63H-81.9v9.434h10.415v4.719h10.417v9.434h10.415v4.717h10.415v4.719h10.415v9.434H-8.993V106.8H1.422v4.717H22.251v4.719H53.5v4.717H74.327v4.717H84.744v-4.717H95.159v4.717Zm0-33.021H147.235V106.8H136.82v4.717H115.988V106.8H105.573V92.654H95.159V78.5h10.415v4.717h10.415V78.5H136.82v4.717h10.415V78.5h10.415Zm62.491-4.719H209.725v9.436H199.31v4.717H178.479V106.8H168.064V97.371h10.415V87.934H188.9V78.5H199.31v4.717h10.415V78.5H220.14Zm0-14.151V69.064H188.9V54.913H199.31V50.194H188.9V45.477H199.31V26.607H261.8v4.719H251.386v28.3H240.972v9.434H230.554v4.719Zm52.076,14.151H261.8v4.719H251.386v4.717H240.972v4.717H230.554V97.371h10.417V87.934h10.415V83.217h20.829Zm52.076-33.021H313.877V59.63H303.462V73.784H261.8V64.347h10.415V50.194H282.63V36.043H272.216V31.326H282.63V26.607h41.661ZM303.462-30v9.434h10.415V-6.414h10.415V17.173H282.63V7.74H272.216V3.02H282.63V-6.414H272.216V-20.567H261.8V-30ZM230.554-53.588h20.832v4.717H261.8v4.717h10.415v4.717H240.972v-9.434H230.554Zm10.417,28.3v14.153h10.415V-1.7H261.8V3.02H251.386V17.173H199.31V12.456H188.9V7.74H199.31V-1.7H188.9V-25.284H220.14V-30h10.415v4.717Zm-72.908-37.74H188.9v4.717H199.31v4.719h10.415v9.434H220.14v4.717H178.479v-18.87H168.064ZM95.159-53.588h10.415v-4.719h10.415v-9.434H136.82v4.717h10.415v14.153h10.415v14.153H136.82v-4.719H126.4v4.719H115.988v-4.719H105.573v4.719H95.159Zm72.905,28.3v9.436H157.649v4.717h10.415V7.74h10.415v4.717H168.064v4.717H84.744V12.456H74.327V7.74H84.744V-25.284ZM32.668-48.871H43.083v-4.717H53.5v-4.719H74.327v-4.717H84.744v9.436H74.327v14.151H43.083v4.719H32.668Zm0,23.587V-30H43.083v4.717H63.912v9.436H53.5v4.717H63.912V-1.7H53.5V3.02H63.912V7.74H53.5v9.434H1.422V12.456H-8.993V7.74H1.422V-15.847H11.836v-9.436Zm31.244,80.2V69.064H43.083v4.719H32.668V69.064H11.836V59.63H1.422v-28.3H-8.993V26.607H53.5v9.436H63.912V40.76H53.5V54.913ZM-19.41-44.154H-8.993v-4.717H1.422v-4.717H11.836v9.434H1.422v4.717H-19.41ZM-71.486-11.131h10.417v-9.436h10.415V-30H-8.993v9.434H-19.41v9.436H-29.825v4.717H-19.41V-1.7H-29.825V3.02H-19.41V7.74H-29.825v9.434H-71.486Zm20.832,84.914V59.63H-61.069V50.194H-71.486V26.607h41.661v18.87H-19.41v18.87H-8.993v9.436ZM22.251,97.371H1.422V92.654H-8.993V83.217H1.422v4.717H11.836v4.719H22.251ZM84.744,106.8H63.912v-4.717H53.5V97.371H43.083V87.934H32.668V78.5H43.083v4.717H74.327v18.87H84.744Zm0-37.74V64.347H95.159V59.63H84.744V45.477H74.327V40.76H84.744V26.607h83.32v4.719h10.415v4.717H168.064V69.064Z" transform="translate(102.73 81.894)" fill="#040504" stroke="#fff" stroke-width="1.067"/>-->
                    <!--            </g>-->
                    <!--        </g>-->
                    <!--    </svg>-->

                    <!--</div>-->
                </div>
                <div class="d-block d-md-none text-en-mobile">
                    {{app()->getLocale() == 'en' ?  $sliders[0]->title_en : $sliders[0]->title}}
                </div>

            </div>




            <div class="scroll-d p-absolute animation-rotate">
                <img src="home/img/scroll_down.html" alt="" />
            </div>
        </div>
    </header>

    <div class="wrapper">
        <section  style="margin-bottom:0 !important;height:auto"   class="intro-about section-scroll section-margin have-dsn-animate-number" data-dsn-animate="section">
            <div class="container-fluid h-100">
                <div  class="row h-100 align-items-xl-center dir-ltr">
                    <div class="col-12 col-sm-12 col-lg-11 h-100">
                        <div class="d-flex h-100 flex-column justify-sm-normal justify-content-center">
                            <h1  style="margin-bottom:40px" class=" mb-4 text-mobile-mobile">
                                     {{app()->getLocale() == 'fa' ? $setting->text_1 : $setting->text_1_en}}
                            </h1>
                            <span  style="font-size:15px !important" class="fs-2x" >
                                     {{app()->getLocale() == 'fa' ? $setting->text_2 : $setting->text_2_en}}
                            </span>

                        </div>
                    </div>
                    <div class="col-1 d-none d-lg-block">
                        <div  class="d-flex justify-content-start align-items-end flex-column">
                           <a data-tooltip="{{__('Guaranty')}}" data-placement="top" title="{{__('Guaranty')}}"  style="{{app()->getLocale() == 'en' ? 'direction:ltr' : ''}}" class="tooltip-service" href="{{$setting->info_link}}">
                               <svg width="45px" viewBox="0 0 16.00 16.00" xmlns="http://www.w3.org/2000/svg" fill="#0000000" stroke="#000000" stroke-width="0.00016"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="1.3439999999999999"></g><g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.773 3.485l-.78-.184-2.108 2.096-1.194-1.216 2.056-2.157-.18-.792a4.42 4.42 0 0 0-1.347-.228 3.64 3.64 0 0 0-1.457.28 3.824 3.824 0 0 0-1.186.84 3.736 3.736 0 0 0-.875 1.265 3.938 3.938 0 0 0 0 2.966 335.341 335.341 0 0 0-6.173 6.234c-.21.275-.31.618-.284.963a1.403 1.403 0 0 0 .464.967c.124.135.272.247.437.328.17.075.353.118.538.127.316-.006.619-.126.854-.337 1.548-1.457 4.514-4.45 6.199-6.204.457.194.948.294 1.444.293a3.736 3.736 0 0 0 2.677-1.133 3.885 3.885 0 0 0 1.111-2.73 4.211 4.211 0 0 0-.196-1.378zM2.933 13.928a.31.31 0 0 1-.135.07.437.437 0 0 1-.149 0 .346.346 0 0 1-.144-.057.336.336 0 0 1-.114-.11c-.14-.143-.271-.415-.14-.568 1.37-1.457 4.191-4.305 5.955-6.046.1.132.21.258.328.376.118.123.245.237.38.341-1.706 1.75-4.488 4.564-5.98 5.994zm11.118-9.065c.002.765-.296 1.5-.832 2.048a2.861 2.861 0 0 1-4.007 0 2.992 2.992 0 0 1-.635-3.137A2.748 2.748 0 0 1 10.14 2.18a2.76 2.76 0 0 1 1.072-.214h.254L9.649 3.839v.696l1.895 1.886h.66l1.847-1.816v.258zM3.24 6.688h1.531l.705.717.678-.674-.665-.678V6.01l.057-1.649-.22-.437-2.86-1.882-.591.066-.831.849-.066.599 1.838 2.918.424.215zm-.945-3.632L4.609 4.58 4.57 5.703H3.494L2.002 3.341l.293-.285zm7.105 6.96l.674-.673 3.106 3.185a1.479 1.479 0 0 1 0 2.039 1.404 1.404 0 0 1-1.549.315 1.31 1.31 0 0 1-.437-.315l-3.142-3.203.679-.678 3.132 3.194a.402.402 0 0 0 .153.105.477.477 0 0 0 .359 0 .403.403 0 0 0 .153-.105.436.436 0 0 0 .1-.153.525.525 0 0 0 .036-.184.547.547 0 0 0-.035-.184.436.436 0 0 0-.1-.153L9.4 10.016z"></path></g></svg>


                           </a>

                            <a  data-tooltip="021-58736" style="{{app()->getLocale() == 'en' ? 'direction:ltr' : ''}}" class="tooltip-support"  tabindex="0" href="{{$setting->question_link}}">
                      <svg  width="45px" height="45px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path d="M6,17 L6,11 L4.5,11 C3.67157288,11 3,11.6715729 3,12.5 L3,15.5 C3,16.3284271 3.67157288,17 4.5,17 L6,17 Z M13.9146471,20 L16.0584816,20 C16.7041272,20 17.2773354,19.5868549 17.4815065,18.9743416 L17.7094306,18.2905694 C17.7432317,18.1891661 17.7850711,18.0921054 17.8340988,18 L17.5,18 C17.2238576,18 17,17.7761424 17,17.5 L17,10.5 C17,10.2238576 17.2238576,10 17.5,10 L18,10 L18,8.98439023 C18,5.67068173 15.3137085,2.98439023 12,2.98439023 C8.6862915,2.98439023 6,5.67068173 6,8.98439023 L6,10 L6.5,10 C6.77614237,10 7,10.2238576 7,10.5 L7,17.5 C7,17.7761424 6.77614237,18 6.5,18 L4.5,18 C3.11928813,18 2,16.8807119 2,15.5 L2,12.5 C2,11.1192881 3.11928813,10 4.5,10 L5,10 L5,8.98439023 C5,5.11839698 8.13400675,1.98439023 12,1.98439023 C15.8659932,1.98439023 19,5.11839698 19,8.98439023 L19,10 L19.5,10 C20.8807119,10 22,11.1192881 22,12.5 L22,15.5 C22,16.8807119 20.8807119,18 19.5,18 C19.1180249,18 18.778905,18.2444238 18.6581139,18.6067972 L18.4301898,19.2905694 C18.0899047,20.3114248 17.1345576,21 16.0584816,21 L13.9146471,21 C13.7087289,21.5825962 13.1531094,22 12.5,22 L11.5,22 C10.6715729,22 10,21.3284271 10,20.5 C10,19.6715729 10.6715729,19 11.5,19 L12.5,19 C13.1531094,19 13.7087289,19.4174038 13.9146471,20 L13.9146471,20 Z M18,11 L18,17 L19.5,17 C20.3284271,17 21,16.3284271 21,15.5 L21,12.5 C21,11.6715729 20.3284271,11 19.5,11 L18,11 Z M11,20.5 C11,20.7761424 11.2238576,21 11.5,21 L12.5,21 C12.7761424,21 13,20.7761424 13,20.5 C13,20.2238576 12.7761424,20 12.5,20 L11.5,20 C11.2238576,20 11,20.2238576 11,20.5 Z"/>
</svg>


                            </a>


                        </div>
                    </div>
                </div>
            </div>
        </section>

@if(count($banners)> 0)
     <section  class="service service-3 section-margin dsn-animate" data-dsn-animate="section">

            <div class="container-fluid padding-0 " data-dsn-animate="section">
          <div class="row row-custom mb-5">
              <div class="w-100  title-section-product mb-5 d-flex justify-content-between">
               <img src="{{asset('home/img/Allproduct.svg')}}">

                </div>
          </div>

                <div class="row margin-0 row-custom swiper-banner">


                <div class="swiper-wrapper">



                    @foreach($banners as $banner)
                        <div  class="col-12 mb-5 mt-5 swiper-slide service-content ">
                            <div  class="product-item">
                                <div class="product-banner">
                                    <img src="{{imageExist(env('BANNER_IMAGES_UPLOAD_PATH'),$banner->image)}}">
                                </div>
                                <div class="details-banner position-absolute">
                                <div class="product-title mb-2 mb-md-3">
                                    <h3 class="text-white">
                                        {{app()->getLocale() == 'fa' ? $banner->title: $banner->title_en}}
                                                                       </h3>


                                </div>
                                    @if(($banner->text =! null and app()->getLocale() =='fa') or ($banner->text_en =! null and app()->getLocale() =='en'))
                                        <div class="product-text mb-2 mb-md-3">

                                            {{app()->getLocale() == 'fa' ? $banner->text: $banner->text_en}}
                                        </div>
                                    @endif
                                    @if(($banner->button_text =! null and app()->getLocale() =='fa') or ($banner->button_text_en =! null and app()->getLocale() =='en'))
                                <div class="product-show mb-2 mb-md-3">

                                    <a href="{{$banner->button_link}}" class=" text-white text-center">
                                        {{app()->getLocale() == 'fa' ? $banner->button_text : $banner->button_text_en}}
                                    </a>
                                </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                     </div>






                </div>
            </div>
        </section>

@endif



        <section class="our-work  section-margin dsn-arrow" data-dsn-col="3">
            <div style="padding: 0 7.6% ; margin-bottom: 15px ;" class=" text-center">
<img src="{{asset('home/img/LifeStyle_1.svg')}}">

            </div>

            <!--<div class="container-fluid">-->
            <!--    <div class="work-container over-hidden">-->
            <!--        <div class="product-slider row ">-->
            <!--            @foreach($news as $new)-->
            <!--                <div class="slider-item col-3">-->
            <!--                    <a href="{{$new->link}}">-->
            <!--                         <img src="{{imageExist(env('SLIDER_IMAGES_UPLOAD_PATH'),$new->image)}}">-->
            <!--                    </a>-->

            <!--                </div>-->
            <!--            @endforeach-->



            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="swiper-container">
    <div class="swiper-wrapper">
         @foreach($news as $new)
            <div class="swiper-slide">
                <img src="{{imageExist(env('SLIDER_IMAGES_UPLOAD_PATH'),$new->image)}}" alt="Image">
            </div>
        @endforeach
    </div>
    <!-- اضافه کردن دکمه‌های Next و Prev -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    <!-- نمایش صفحه‌نمایش -->
    <div class="swiper-pagination"></div>
</div>
        </section>
        <section class="brand-client section-margin">

            <div class="container-fluid">
                <div class="row-custom row">
                    <div class="col-12">
                        <p class="des-about">
           {{app()->getLocale() == 'fa' ? $setting->description_index : $setting->description_index_en}}
                        </p>
                    </div>
                </div>
            </div>
        </section>

   @if(count($banners_bottom)> 0)
     <section class="service service-3 section-margin dsn-animate" data-dsn-animate="section">

            <div class="container-fluid" data-dsn-animate="section">
                <!--<div class="w-100 px-5 title-section-product mb-3 d-flex justify-content-between">-->
                <!--    <p data-aos-delay="500" data-aos-duration="500" data-aos="fade-left" class="aos-init  aos-animate">-->
                <!--        {{$lang == 'fa' ? $setting->title_1 : $setting->title_1_en}}-->
                <!--    </p>-->
                <!--    <h1 data-aos-delay="500" data-aos-duration="500" data-aos="fade-right" class="aos-init font-family-Heltiveca aos-animate">-->
                <!--        <p class="font-family-Heltiveca">-->
                <!--            {{$lang == 'fa' ? $setting->title_3 : $setting->title_3_en}}-->
                <!--        </p>-->
                <!--        {{$lang == 'fa' ? $setting->title_2 : $setting->title_2_en}}-->

                <!--    </h1>-->

                <!--</div>-->

                <div class="row row-custom">
                    @foreach($banners_bottom as $banner)
                        <div data-aos-delay="100" data-aos-duration="450" data-aos="fade-up" class="col-12 mb-5 aos-init aos-animate service-content dsn-up">
                            <div  class="product-item">
                                <div class="product-banner">
                                    <img src="{{imageExist(env('BANNER_IMAGES_UPLOAD_PATH'),$banner->image)}}">
                                </div>
                                <div class="product-title">
                                    <h3 class="text-white">
                                        {{$lang == 'fa' ? $banner->title: $banner->title_en}}
                                                                       </h3>


                                </div>
                                <div class="product-show">
                                    <a href="{{$banner->button_link}}" class=" text-white text-center">
                                        {{$lang == 'fa' ? $banner->button_text: $banner->button_text_en}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach




                </div>
            </div>
        </section>

@endif

    </div>
@endsection
