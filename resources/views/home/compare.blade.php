@extends('home.layouts.index')

@section('title')
    مقایسه محصولات
@endsection

@section('description')
@endsection

@section('keywords')
@endsection

@section('script')

    <script>
        $('.mobile-menu-toggle').click(function(){
            $('.loaded').addClass('mmenu-active');
        })
        $('.mobile-menu-close').click(function(){
            $('.loaded').removeClass('mmenu-active');
        })
        $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
        $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
        $('div#categories > ul.mobile-menu > li > a > span.toggle-btn').click(function(e){

            e.preventDefault();
            $(this).parent().next().slideToggle(300).parent().toggleClass("show");
        })

        function open_tab_group(tag, attr_group_id) {
            $('.attr_group_table_' + attr_group_id).slideToggle(500);
            $(tag).find('.left_icon').toggleClass('d-none');
            $(tag).find('.down_icon').toggleClass('d-none');
        }
    </script>
@endsection

@section('style')
    <style>
        @media (max-width:992px){
            .page-content-text{
                padding:2% 4% !important;
            }
            .title-page-content{
                padding:2% 4% !important;
            }

        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" integrity="sha512-rd0qOHVMOcez6pLWPVFIv7EfSdGKLt+eafXh4RO/12Fgr41hDQxfGvoi1Vy55QIVcQEujUE1LQrATCLl2Fs+ag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--}}


    <style>
        .category-section{
            background:#fff;
        }




        .site-header{
            padding:30px 0 !important;
            background:#fff;
            border-bottom:1px solid ;
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


        .tooltip-support:hover{
            background: #000;
            padding: 0 15px  0  8px;
        }
        .tooltip-support:hover p{
            opacity:1;
            color:#fff;
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

        .tooltip-service:hover{
            background: #000;
            padding: 0 15px  0  8px;
        }

        .tooltip-service,.tooltip-support{
            padding: 0 15px 0 8px;
        }
        .tooltip-service:hover p{
            opacity:1;
            color:#fff;
        }
        .tooltip-service:hover svg{

            fill:#fff;
        }
        .tooltip-support:hover svg{

            fill:#fff;
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

        .product-attribute ul li:first-child {
            min-width:150px;
        }

        .product-title{
            min-height:60px !important;
            margin-bottom:10px !important;
        }
        .justify-content-End{
            justify-content:end !important;
        }
        #dsn-hero-parallax-title img{
            transition: all .5s ease;
            position: fixed;
            left: 7%;
            max-width: 88%;



        }
        .box-filter{
            width: 50%;
        }
        .copyright svg{
            width: 32px;
        }
        .resize-img{
            transform: scale(.089);

            top: 4%;
            left: -45%;




        }
        .site-header .dsn-title-menu{
            font-size: 18px !important;
        }
        .site-header input{
            background: transparent;
            border: 1px solid #000;
            border-radius: 21px;
            width: 101px;
            font-size: 15px;
            padding: 2px 12px;
            text-align: left;
            color: #000 !important;
        }
        .site-header input::placeholder{

            color: #000 !important;
            font-weight: bold;
        }
        .change-lang{
            display: flex;
            justify-content: space-between;
        }
        .change-lang p{
            margin-bottom: 0 !important;
            border-bottom: none;


        }
        /*.change-lang-btn{*/
        /*    width: 120px;*/
        /*    background: transparent;*/
        /*    border: 1px solid #000;*/
        /*    margin-left: 17px;*/
        /*    padding: 2px 12px;*/
        /*    border-radius: 21px;*/
        /*    font-size: 15px;*/
        /*    display: flex;*/
        /*    justify-content: space-around;*/
        /*    flex-direction: column;*/
        /*    align-items: center;*/
        /*    transition: all ease .4s;*/
        /*    height: 28px;*/
        /*}*/
        /*.change-lang-btn .divider{*/
        /*    height: 1px ;*/
        /*    transition: all ease .4s;*/
        /*    width: 66%;*/
        /*    background:#000;*/

        /*}*/
        /*.animate-change-lang-btn{*/
        /*    width: 41px;*/
        /*    background: transparent;*/
        /*    border: 1px solid #000;*/
        /*    margin-left: 17px;*/
        /*    padding: 2px 12px;*/
        /*    border-radius: 50%;*/
        /*    font-size: 15px;*/
        /*    display: flex;*/
        /*    justify-content: space-around;*/
        /*    flex-direction: column;*/
        /*    align-items: center;*/
        /*    height: 41px;*/
        /*}*/


        .intro-about{
            height: 70vh;
        }
        .intro-about .row{
            padding: 0 7% !important;

        }
        .row-custom{
            padding: 0 7% !important;
        }
        .fs-2x{
            font-size: 22px;
        }
        .title-section-product > p{
            font-size: 45px;
            color: #000 !important;
            align-content: center;
        }
        .title-section-product h1{
            font-size: 75px;
        }
        .title-section-product h1 p{

            font-weight: 200;
            display: inline-block
        }

        .product-title h3 {
            color: #fff !important;
            font-size: 75px ;
            font-weight: 400 !important;
        }
        .product-item .product-banner{
            position: relative;
        }
        .product-item .product-title{
            position: absolute;
            top: 10%;
            right: 7%;
        }
        .product-item .product-show{
            position: absolute;
            bottom: 15%;
            right: 6%;
            border: 1px solid #fff;
            font-size: 20px;
            color: #fff !important;
            padding: 10px 14px;
            width: 20%;
            text-align: left;
            cursor: pointer;
            border-radius: 22px;
        }
        .product-slider .slick-slide{
            margin: 0 20px;
        }
        .our-work h2{
            font-size: 200px;
            font-weight: 100;
        }
        .des-about{
            color: #000 !important;
            line-height:1.2;
            text-align: justify;
        }
        .footer-title-2{
            color: #000 !important;
            font-weight: 500;
        }
        .divider-line-footer{
            background-color:#000 !important ;
            height: 1px;
        }
        footer form button{
            color: #fff !important;
            background-color: #000 !important;
            padding: 20px;

        }
        footer form p{
            color: #0e0e0d;
            font-size: 18px;
        }
        footer form input{
            border-radius: 20px;
            border: 1px solid #c3c3c3;
            padding: 16px 21px;
        }
        footer form input::placeholder {
            font-size: 17px;
            color: #000 !important;
        }

        footer form button{
            border-radius: 20px;
            font-size: 20px;
            cursor: pointer;
        }
        .intro-about h1{
            font-size: 45px;
        }
        .main-logo p {
            font-size:35px;
        }
        @media (max-width:700px){
            .our-work h2{
                font-size:60px !important;
            }
            .des-about{
                line-height:1.6 !important;
            }
            .row-custom {
                padding: 0 3% !important;
            }
            .title-section-product > p{
                font-size:20px !important;
            }
            .title-section-product h1 {
                font-size: 33px !important;
            }
            .title-section-product{
                padding:0 10px !important;
            }
            .product-title h3{
                font-size:28px !important;
            }
            .product-item .product-show {
                position: absolute;
                bottom: 15%;
                right: 6%;
                border: 1px solid #fff;
                font-size: 12px !important;
                color: #fff !important;
                padding: 10px 13px !important;
                width: 47% !important;
                text-align: right;
                cursor: pointer;
                border-radius: 22px;
            }
            .service-content{
                margin-top:10px !important;
                margin-bottom:10px !important;
            }
            .intro-about h1 {
                font-size: 20px;
                margin-bottom:20px;
            }

            .intro-about span {
                font-size: 13px !important;
            }
            .intro-about {
                margin-top:20px !important;
                margin-bottom:20px !important;
                height:auto !important;
            }
            .justify-sm-normal {
                justify-content: normal !important;

            }
            #dsn-hero-parallax-title img{
                transform: scale(.6) ;
                left: 7% ;
                top: 7% ;



            }
            header .header-master{
                height:32vh !important;
            }
            .main-logo p {
                font-size:23px;
            }

            .site-header .extend-container .main-navigation ul.extend-container li{

                color:#fff !important;
            }
        }






        .product-title  p:nth-child(1){
            margin-bottom:-10px;

            text-align: left;
            font-size: 20px;
            color: #000 !important;
        }
        .product-title  p:nth-child(2) {

            text-align: left;

        }

        .product-title  p:nth-child(2) b{
            margin: 15px 0 5px 0;
            text-align: left;
            font-size: 22px;
            color: #000 !important;
        }
        .product-title  p:nth-child(2){
            font-size: 16px;
            font-family: 'Pelak'!important;

        }

        .product-title  p:nth-child(3) {
            font-size: 25px;
            color: #000 !important;
            text-align: left;

        }
        .product-details span {
            font-size: 11px;
            /* padding: 4px; */
            /* border: 1px solid; */
            color: #000;
            margin-bottom: 7px;
        }

        .product-description{
            font-size: 12px;
            border: 1px solid #000;
            padding: 8px;
            border-radius: 15px;
            color: #000;
        }

        .product-brand{

            width: auto !important;
            height: 26px !important;
            margin: 0 5px;

        }
        .btn-compare{
            color: #000;
            font-size: 12px;
            border: 1px solid;
            padding: 9px 7px;
            padding: 7px 7px;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .show-product{
            color: #000;
            font-size: 12px;
            border: 1px solid;
            padding: 7px 7px;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .product-title{
            min-height:60px !important;
            margin-bottom:10px !important;
        }
        .card-footer{
            margin-top:15px;
            display: block;
            justify-content: space-between;
        }
        .box-filter{
            border-top: 1px solid;
            padding: 10px;

        }
        .box-filter p{
            color: #000;
            margin-bottom: 5px;
        }
        .box-filter ul li {
            margin-bottom:5px;
        }

        .text-dark{
            color:#000 !important;
        }
        .title-section-product > p {
            margin-right:6%;
        }

        .main-logo p {
            font-size: 16px;
            margin-top: 2%;
            margin-left: -3px;
            float:left;
        }
        .main-logo img{
            height:auto !important;
            width:100%;
        }
        .site-header .inner-header .main-logo {
            width: 250px !important;
        }

        .category-section{
            border-top: 1px solid;
            padding-top: 50px;
            position:relative;
        }


        @media (max-width:768px){
            .title-section-product > p{
                margin-right:0 !important;
            }
        }

        .btn-filter-show{
            border:1px solid #000;
            padding: 10px 15px;
            margin:5px auto;
        }

        .modal-box-filter{
            display:none;
            padding:15px;

            z-index: 9999999999999999;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #fff;
        }



        .card-img-top{
            width:100%;
        }

        @media (min-width: 992px) {
            .d-lg-none {
                display: none;
            }
        }

        .loader-filter{
            display: none;
            transition: all ease .3s;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            background: rgba(255, 255, 255, .8);
            z-index: 9999999999999;
        }
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        @keyframes pulse {
            50% {
                background: white;
            }
        }

        .loading {
            border-radius: 50%;
            width: 45px;
            height: 45px;
            border: 0.25rem solid rgba(0, 0, 0, 0.2);
            border-top-color: #000;
            animation: spin 1s infinite linear;
        }
        .loading--double {
            border-style: double;
            border-width: 0.5rem;
            position: absolute;
            top: 50%;
            z-index: 999999999999999999999999999999999999999999999999999999;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .loading-pulse {
            position: relative;
            width: 6px;
            height: 24px;
            background: rgba(0, 0, 0, 0.2);
            animation: pulse 750ms infinite;
            animation-delay: 250ms;
        }
        .loading-pulse:before, .loading-pulse:after {
            content: "";
            position: absolute;
            display: block;
            height: 16px;
            width: 6px;
            background: rgba(0, 0, 0, 0.2);
            top: 50%;
            transform: translateY(-50%);
            animation: pulse 750ms infinite;
        }
        .loading-pulse:before {
            left: -12px;
        }
        .loading-pulse:after {
            left: 12px;
            animation-delay: 500ms;
        }
        @media (max-width:992px){
            .category-section{
                padding-top:100px;
                border-top:none;
            }
        }
    </style>
    <style>

        @media (min-width: 1200px) {


            /* استایل‌های Grid در بوت‌استرپ */

            .col-xl {
                -ms-flex: 0 0 auto;  /* برای IE */
                flex: 0 0 auto;
                width: auto;         /* به صورت پیش‌فرض */
            }

            .col-xl-1 {
                flex: 0 0 8.333333%;  /* 1 از 12 */
                max-width: 8.333333%;
            }

            .col-xl-2 {
                flex: 0 0 16.666667%;  /* 2 از 12 */
                max-width: 16.666667%;
            }

            .col-xl-3 {
                flex: 0 0 25%;    /* 3 از 12 */
                max-width: 25%;
            }

            .col-xl-4 {
                flex: 0 0 33.333333%; /* 4 از 12 */
                max-width: 33.333333%;
            }

            .col-xl-5 {
                flex: 0 0 41.666667%; /* 5 از 12 */
                max-width: 41.666667%;
            }

            .col-xl-6 {
                flex: 0 0 50%;    /* 6 از 12 */
                max-width: 50%;
            }

            .col-xl-7 {
                flex: 0 0 58.333333%; /* 7 از 12 */
                max-width: 58.333333%;
            }

            .col-xl-8 {
                flex: 0 0 66.666667%; /* 8 از 12 */
                max-width: 66.666667%;
            }

            .col-xl-9 {
                flex: 0 0 75%;    /* 9 از 12 */
                max-width: 75%;
            }

            .col-xl-10 {
                flex: 0 0 83.333333%; /* 10 از 12 */
                max-width: 83.333333%;
            }

            .col-xl-11 {
                flex: 0 0 91.666667%; /* 11 از 12 */
                max-width: 91.666667%;
            }

            .col-xl-12 {
                flex: 0 0 100%;   /* 12 از 12 */
                max-width: 100%;
            }
        }
        @media (min-width: 1400px) {
            .col-xxl {
                -ms-flex: 0 0 auto;  /* برای IE */
                flex: 0 0 auto;
                width: auto;         /* به صورت پیش‌فرض */
            }

            .col-xxl-1 {
                flex: 0 0 8.333333%;  /* 1 از 12 */
                max-width: 8.333333%;
            }

            .col-xxl-2 {
                flex: 0 0 16.666667%;  /* 2 از 12 */
                max-width: 16.666667%;
            }

            .col-xxl-3 {
                flex: 0 0 25%;    /* 3 از 12 */
                max-width: 25%;
            }

            .col-xxl-4 {
                flex: 0 0 33.333333%; /* 4 از 12 */
                max-width: 33.333333%;
            }

            .col-xxl-5 {
                flex: 0 0 41.666667%; /* 5 از 12 */
                max-width: 41.666667%;
            }

            .col-xxl-6 {
                flex: 0 0 50%;    /* 6 از 12 */
                max-width: 50%;
            }

            .col-xxl-7 {
                flex: 0 0 58.333333%; /* 7 از 12 */
                max-width: 58.333333%;
            }

            .col-xxl-8 {
                flex: 0 0 66.666667%; /* 8 از 12 */
                max-width: 66.666667%;
            }

            .col-xxl-9 {
                flex: 0 0 75%;    /* 9 از 12 */
                max-width: 75%;
            }

            .col-xxl-10 {
                flex: 0 0 83.333333%; /* 10 از 12 */
                max-width: 83.333333%;
            }

            .col-xxl-11 {
                flex: 0 0 91.666667%; /* 11 از 12 */
                max-width: 91.666667%;
            }

            .col-xxl-12 {
                flex: 0 0 100%;   /* 12 از 12 */
                max-width: 100%;
            }
        }
        @media (max-width:768px){

            #dsn-hero-parallax-title img{
                position:fixed !important;
            }

            .site-header{
                padding: 22px 15px !important;
            }

        }


        @media (max-width:1280px){
            .box-filter {
                width:83% !important;
            }
        }
        @media (min-width:410px) {
            .site-header .inner-header .main-logo{
                width:192px !important;
            }
        }
        @media (min-width:470px){
            .site-header .inner-header .main-logo{
                width:250px !important;
            }
        }
    </style>

    @if(app()->getLocale() == 'en')

        <style>
            .title-section-product > p{
                margin-left:6% !important;
            }
            @media (min-width:992px) and (max-width:1280px){
                .title-section-product > p{
                    margin-left:2% !important;
                }
            }




            @media (min-width:1440px) {
                .title-section-product > p{
                    margin-left:2.5% !important;
                }
            }

            @media (min-width:1400px) and (max-width:1980px){
                .title-section-product > p{
                    margin-left:3.6% !important;
                }
            }

            @media (max-width: 700px) {
                .title-section-product > p {
                    margin-left: -1% !important;
                }
            }

            @media (min-width:700px) and (max-width:768px){
                .title-section-product > p {
                    margin-left: -7% !important;
                }
            }


            @media (min-width:768px) and (max-width:992px){
                .title-section-product > p {
                    margin-left: 4% !important;
                }

                .extend-container .row-md{
                    padding: 0 12.6% !important;
                }


            }

            @media (min-width:867px) and (max-width:992px){
                .extend-container.row-md {
                    padding: 0 12.6% !important;
                }
            }

            @media (min-width:1280px) and (max-width:1400){
                .title-section-product > p {
                    margin-left: 2.5% !important;
                }
            }
        </style>


    @endif

    @if(app()->getLocale() == 'fa')

        <style>
            .title-section-product > p{
                margin-right:6% !important;
            }
            @media (min-width:992px) {
                .title-section-product > p{
                    margin-right:2% !important;
                }
            }
            @media (min-width:992px) and (max-width:1280px){
                .title-section-product > p{
                    margin-right:2% !important;
                }
            }




            @media (min-width:1440px) {
                .title-section-product > p{
                    margin-right:2.5% !important;
                }
            }

            @media (min-width:1400px) and (max-width:1980px){
                .title-section-product > p{
                    margin-right:3.6% !important;
                }
            }

            .product-title  p:nth-child(1){
                margin-bottom:-10px;

                text-align: right !important;
                font-size: 16px !important;
                color: #000 !important;
            }
            .product-title  p:nth-child(2) {

                text-align: right  !important;

            }

            .product-title  p:nth-child(2) b{
                margin: 15px 0 5px 0;
                text-align: right !important;
                font-size: 18px;
                color: #000 !important;
            }
            .product-title  p:nth-child(2){
                font-size: 16px;
                font-family: 'Pelak'!important;
                margin-top:13px;

            }

            .product-title  p:nth-child(3) {
                font-size: 18px;
                margin-top:10px;
                color: #000 !important;
                text-align: right !important;

            }



        </style>


    @endif
    <style>
        .box-filter{
            width:83%;
        }


        @media (max-width:410px){
            .site-header .inner-header .main-logo{
                width:150px !important;
            }
        }



        @media (max-width: 700px) {
            .title-section-product > p {
                font-size: 38px !important;
            }
        }

        @media (min-width:300px) and (max-width:768px) {
            .show-product,.btn-compare{
                font-size:18px !important;
                padding: 7px 20px !important;
            }
        }

        @media (min-width:300px) and (max-width:370px) {
            .site-header .inner-header .main-logo{
                width: 125px !important;
                left: 10px !important;
                top:-5px !important;
                position: absolute;
            }
        }
        @media (min-width:992px) and (max-width:1088px){
            .show-product{
                font-size:10px !important;
                padding:7px 5px !important;
            }
        }

        @media (min-width:1088px){
            .btn-compare{
                width:40% !important;
            }
            .show-product{
                width:56% !important;
            }
        }
    </style>


    <style>
        @media (max-width:575px){

            .product-title  p:nth-child(1){
                margin-bottom:-10px;

                text-align: center !important;
                font-size: 25px !important;
                color: #000 !important;
            }
            .product-title  p:nth-child(2) {

                text-align: center  !important;

            }

            .product-title  p:nth-child(2) b{
                margin: 15px 0 5px 0;
                text-align: center !important;
                font-size: 50px;
                color: #000 !important;
            }
            .product-title  p:nth-child(2){
                font-size: 16px;
                font-family: 'Pelak'!important;
                margin-top:13px;

            }

            .product-title  p:nth-child(3) {
                font-size: 35px;
                margin-top:10px;
                color: #000 !important;
                text-align: center !important;

            }
        }
        @media (max-width:464px){
            .product-title p:nth-child(2) b{
                font-size:25px !important;
            }
        }
    </style>
    <style>
        @media (min-width: 1200px) {
            .container {
                max-width: 86% !important;
                margin: 0 7% !important;
            }
        }
        .page-content-text ul li {
            list-style:inside !important;
        }
    </style>
    <style>

    @media(max-width:992px){
           .margin-0{
        margin:0 !important;
    }

    }

    @media only screen and (max-width: 991px) {
    .section-margin {
        margin-top: 62px;
        margin-bottom: 20px;
    }
}
        th {
            text-align: center;
        }

        @media screen and (max-width:780px){
            .name-compare{
                height:162px;
            }
        }

        td {
            text-align: center;

            padding: 5px;
        }


        thead {
            height: 70px;
        }
        .color-green{
            color: green !important;
        }


        .section-attributes{
            padding: 0 5%;
        }
 .product-attribute:first-of-type .header-product-attribute{
            border-top:none;
        }
        /*.product-attribute {*/
        /*    border-top: 2px solid #ccc;*/
        /*}*/
        .title-product {
            padding: 10px 0;
            cursor: pointer;
        }
        @media (min-width: 992px) {
            .d-lg-none {
                display: none;
            }
        }
        .arrow_icon {
            width: 20px;
            height: 20px;
        }
        .d-none {
            display: none;
        }
        .product-attribute ul li {
            padding: 15px;

            color: #000;
        }
        .product-attribute ul li span {
            margin: 0 20px;
        }
        /*.product-attribute {*/
        /*    border-top: 2px solid #ccc;*/
        /*}*/

        .border-top{
            border-top: 2px solid #ccc;
        }
        /*.product-attribute ul li:last-of-type {*/
        /*    border-bottom: none;*/
        /*}*/

        .attr_children{
            border-bottom: 2px solid #ccc;
        }
        /*.product-attribute .attr_children:last-of-type {*/
        /*    border-bottom: none;*/
        /*}*/
        .border-bottom-none{
            border-bottom: none !important;
        }

        .no-padding{
            padding: 10px 0 !important;
        }
        .margin-0{
            margin: 0 !important;
        }


        @media (min-width: 992px) {
            .d-lg-flex {
                display: -ms-flexbox;
                display: flex;
            }
        }
    .product-title h4 {
        font-size:18px !important;
    }

    .remove-from-compare {
        margin-top: 10px;
        background-color: #f44336; /* رنگ قرمز برای حذف */
        color: white;
        font-size: 14px;
        padding: 5px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:before{
        content: ''  !important;
    }

    </style>
@endsection

@section('content')
    <div class="wrapper">
        <section  class="product-section section-margin">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-center justify-content-md-normal">
                            <div class="col-4 col-lg-1 d-none d-md-block"></div>
                            @foreach ($products as $item)
                            <div class="col-{{ceil(8/count($products))}} ">
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    @if(file_exists(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH').$item->primary_image))
              and !is_dir(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH').$item->primary_image)))
                                        <img style="width: 40%"
                                            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->primary_image) }}"
                                            alt="">
                                    @else
                                        <img src="{{ asset('admin/images/no_image.jpg') }}" alt="">
                                    @endif
                                    <div class="product-title  text-right">
                                        <h4>{{$item->title_2}} <span style="font-weight:500">{{$item->title_1}}</span> </h4>
                                        <h4>{{$item->name}}</h4>
                                    </div>

                                        <a href="{{ route('home.compare.remove',['productId'=>$item->id]) }}" class=" remove-from-compare" data-product-id="{{ $item->id }}">
                                            حذف از مقایسه
                                        </a>
                                </div>


                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12 ">
                            <p> {{__('Main features')}}</p>
                        </div>


                   @foreach($attr_group as $key_group => $attributes)
                            @foreach($attributes as $key=> $attribute)
                                <div  class="col-12 margin-0 product-attribute row {{$key == 0 ? 'border-top' : ''}}">

                                    <div class="col-12 d-flex d-lg-block justify-content-center justify-content-lg-between align-items-center col-lg-1">
                                      @if($key == 0)
                                            <p onclick="open_tab_group(this,{{ $key_group }})" class="title-product">               {{ app()->getLocale() == 'fa' ? $attribute->Group->name  :  $attribute->Group->name_en }}</p>
                                            <div class=" d-flex d-lg-none ">
                                                <img class="arrow_icon left_icon {{ $key==0 ? 'd-none' : '' }}"
                                                     src="{{ asset('home/img/left.png') }}">
                                                <img class="arrow_icon down_icon {{ $key==0 ? '' : 'd-none' }}"
                                                     src="{{ asset('home/img/down.png') }}">
                                            </div>
                                        @endif


                                    </div>

                                    <div   class="col-12 attr_group_table_{{ $key_group }} col-lg-10  {{ $loop->last ? 'border-bottom-none' :  ' ' }} attr_children ">
                                        <ul >
                                            <li  class="row d-none d-lg-flex">
                                                @foreach ($products as $key=> $item)
                                                    @if($key == 0)
                                                        <div class="col-2">
                                                            <span>{{ app()->getLocale() == 'fa' ? ($attribute->name ?? '-' )  : $attribute->name_en}}</span>
                                                        </div>
                                                    @endif

                                                        <?php
                                                        $product_attribute = \App\Models\ProductAttribute::where('attribute_id', $attribute->id)
                                                            ->where('product_id', $item->id)->first();



                                                        if($product_attribute!=null){
                                                            $attribute_values=$product_attribute->attributeValues($product_attribute->value,$product_attribute->attribute_id);
                                                        }else{
                                                            $attribute_values=null;
                                                        }
                                                        ?>



                                                    <div class="col">



                                                  <span>
                                                                    @if($attribute_values==null)
                                                          @if($product_attribute==null)
                                                              -
                                                          @else
                                                              {{ $product_attribute->value }}
                                                          @endif
                                                      @else
                                                          {{ app()->getLocale() == 'fa' ? $attribute_values->name :  $attribute_values->name_en}}
                                                      @endif
                                                        </span>
                                                    </div>


                                                @endforeach
                                            </li>

                                            <li   class="row no-padding  d-lg-none">
                                                @foreach ($products as $key=> $item)
                                                    @if($key == 0)
                                                        <div class="col-2 text-right">
                                                            <span class="margin-0">{{ app()->getLocale() == 'fa' ? ($attribute->name ?? '-' )  : $attribute->name_en}}</span>
                                                        </div>
                                                    @endif
                                                @endforeach





                                                    <div  class="col-10 justify-content-around d-flex">

                                                        @foreach ($products as $key=> $item)
                                                                <?php
                                                                $product_attribute = \App\Models\ProductAttribute::where('attribute_id', $attribute->id)
                                                                    ->where('product_id', $item->id)->first();



                                                                if($product_attribute!=null){
                                                                    $attribute_values=$product_attribute->attributeValues($product_attribute->value,$product_attribute->attribute_id);
                                                                }else{
                                                                    $attribute_values=null;
                                                                }
                                                                ?>

                                                  <span class="margin-0">
                                                                    @if($attribute_values==null)
                                                          @if($product_attribute==null)
                                                              -
                                                          @else
                                                              {{ $product_attribute->value }}
                                                          @endif
                                                      @else
                                                          {{ app()->getLocale() == 'fa' ? $attribute_values->name :  $attribute_values->name_en }}
                                                      @endif
                                                        </span>
                                                        @endforeach
                                                    </div>



                                            </li>

                                        </ul>

                                    </div>
                                    @if($key == 0)
                                    <div class="col-1  d-lg-flex justify-content-center align-items-center">
                                        <img class="arrow_icon left_icon {{ $key==0 ? '' : 'd-none' }}"
                                             src="{{ asset('home/img/left.png') }}">
                                        <img class="arrow_icon down_icon {{ $key==0 ? 'd-none' : '' }}"
                                             src="{{ asset('home/img/down.png') }}">
                                    </div>
                                    @endif

                                </div>
                            @endforeach

                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
