@extends('home.layouts.index')

@section('title')
    {{ $category->name }}
@endsection

@section('keywords')
    {{ $category->meta_keyword }}
@endsection

@section('description')
    {{ $category->meta_description }}
@endsection

@section('style')
    <style>
    .category-section{
        background:#fff;
    }
    .card,.card *{
        transition: all .25s ease;
    }
    .card:hover{
        background: #eeebeb;
        border-color: #eeebeb;
    }

    .product-custom-title {
        background:  red !important;
        font-size: 11px;
        color: #000;
        margin-bottom: 7px;
        padding: 0 10px !important;
    }

    .product-details  span, .product-detail p ,.product-details a, .product-detail div,.product-details li ,.product-details ul{
        background-color:#ffffff !important;
        text-align: justify;
    }

    .card:hover .product-details  span, .product-detail p ,.product-details a, .product-detail div,.product-details li ,.product-details ul{
        background-color:#eeebeb !important;
    }

        .card:hover .btn-compare{
            background: #fff;
    border-color: #fff;
    }
            .card:hover .show-product{
            background: #fff;
    border-color: #fff;
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





        .card{
            padding: 21px 18px;
            border: 1px solid;
            border-radius: 12px;
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
            text-align: left;}


        /*.product-details span {*/
        /*    font-size: 11px;*/
        /*    color: #000;*/
        /*    margin-bottom: 7px;*/
        /*}*/

        .product-description{
            font-size: 12px;
            border: 1px solid #000;
            padding: 8px;
            border-radius: 15px;
            color: #000;

        }

        .product-brand{

            width: 42% !important;
    margin: 0 3%;

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
        .card{
            background: #fff;
            height:100%;
            display: flex;
            flex-direction:column;
            align-items: center;
            justify-content: space-between;

        }


        .card-img-top{
            width:100%;
            border-radius: 12px !important;
            margin-bottom: 5px;
            background-color: transparent;
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
                           font-size: 29px;
                           margin-top:10px;
            color: #000 !important;
            text-align: center !important;

        }

        .product-brand{
            /*height:40px !important;*/
        }
    }
@media (max-width:464px){
    .product-title p:nth-child(2) b{
        font-size:25px !important;
    }
}
    </style>
@endsection

@section('script')
    <script>
        $('#myInput').click(function(){

            $('.modal-box-filter').fadeIn();
        });
        $('#close-modal-box-filter').click(function(){

            $('.modal-box-filter').fadeOut();
        });

        $('#btn-modal-filter').click(function () {
            $('.modal-filter').fadeToggle();
        })
        $('#btn-close-modal').click(function () {
            $('.modal-filter').fadeOut();
        })
        var total = {{ $products->lastPage() }};
        var current_page = 1;
        $('.btn-clear-filter').click(function () {
            window.location.reload();
        })
        // Price slider Active
        // ----------------------------------*/

        function change_sort(sort_id) {
            $('#sort_input').val(sort_id)
            filter_products();
        }

        function filter_products(sort_id = null, tag = null) {
            let attribute_values = [];
            let page = 1;

            $.each($('.attr_filter_ids:checked'), function () {
                attribute_values.push($(this).val());
            });

            $.ajax({
                url: "{{ route('home.product_categories',['category'=>$category->alias]) }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    attribute_values: attribute_values,


                    page: page,
                },
                dataType: "json",
                type: 'get',
                beforeSend: function () {
$('.loader-filter').show();
                },
                success: function (msg) {
                    setTimeout(function(){
                                     $('.loader-filter').hide();
                    },500)

                    if (msg[0] === 1) {
                        $('.modal-box-filter').css('display','none');
                        $('#post-data').html(msg[1]);
                        total = msg[2];
                        current_page = 1;
                        $('.modal-filter').fadeOut();
                    }
                }
            })

            // $('#orderby').val(sort);

            // $('#filter_products').submit();
        }

        $('.open_page_description').click(function () {
            let is_open = $(this).attr('data-open');
            let button_html = '';
            if (is_open === 'no') {
                button_html = `نمایش کمتر
                    <i class="fa fa-angle-up ml-3"></i>`;
                $(this).parent().removeClass('page_description');
                $(this).parent().addClass('page_description2');
                $(this).attr('data-open', 'yes');
            } else {
                button_html = `نمایش بیشتر
                    <i class="fa fa-angle-down ml-3"></i>`;
                $(this).parent().removeClass('page_description2');
                $(this).parent().addClass('page_description');
                $(this).attr('data-open', 'no');
            }
            $(this).html(button_html);
        })

        function slideToggleChildren(attr_id, tag) {
            $('#children_attr_' + attr_id).slideToggle();
            $(tag).find('i').toggleClass('active-arrow');
        }


        {{--$(window).scroll(function () {--}}

        {{--    if ($(window).scrollTop() >= $('#load-more').offset().top - 900) {--}}


        {{--        current_page++;--}}
        {{--        loadMoreData(current_page);--}}
        {{--    }--}}
        {{--});--}}

        {{--function loadMoreData(current_page) {--}}

        {{--    if (current_page > total) {--}}

        {{--        // $('.load-more-parent').show() ;--}}
        {{--    } else {--}}

        {{--        let attribute_values = [];--}}

        {{--        if (window.matchMedia("(max-width: 800px)").matches) {--}}
        {{--            var sort = $('input[name="sort"]:checked').val();--}}
        {{--            console.log(sort);--}}
        {{--        } else {--}}

        {{--            var sort = $('.btn-filter-selected').attr('data-sort');--}}

        {{--        }--}}


        {{--        let price_amount = $('#price-amount').val();--}}
        {{--        price_amount = price_amount.replaceAll(',', '');--}}
        {{--        price_amount = price_amount.replaceAll('تومان', '');--}}
        {{--        price_amount = price_amount.replaceAll(' ', '');--}}
        {{--        $('#price_range_filter').val(price_amount);--}}
        {{--        $.each($('.attr_filter_ids:checked'), function () {--}}
        {{--            attribute_values.push($(this).val());--}}
        {{--        });--}}

        {{--        $.ajax(--}}
        {{--            {--}}
        {{--                url: "{{ route('home.product_categories',['category'=>$category->alias]) }}",--}}
        {{--                type: "get",--}}
        {{--                data: {--}}
        {{--                    attribute_values: attribute_values,--}}
        {{--                    sort: sort,--}}
        {{--                    price_amount: price_amount,--}}
        {{--                    page: current_page,--}}
        {{--                },--}}
        {{--                beforeSend: function () {--}}
        {{--                    $('#load-more').show();--}}
        {{--                    $('.load-more-parent').hide();--}}
        {{--                },--}}
        {{--                success: function (data) {--}}

        {{--                    setTimeout(function () {--}}
        {{--                        if (data[1] == "") {--}}
        {{--                            $('.load-more-parent').show();--}}
        {{--                            $('#load-more').hide();--}}
        {{--                        } else {--}}
        {{--                            $("#post-data").html(data[1]);--}}
        {{--                            if (current_page == total) {--}}
        {{--                                $('.load-more-parent').show();--}}
        {{--                                $('#load-more').hide();--}}
        {{--                            }--}}
        {{--                        }--}}
        {{--                        $('#load-more').hide();--}}
        {{--                    }, 1000)--}}
        {{--                }--}}
        {{--            })--}}


        {{--    }--}}
        {{--}--}}
    </script>
@endsection

@section('content')
    <div class="wrapper">

        <section class="category-section section-margin ">



            <div class="container-fluid">
                <div class="w-100 px-5  d-lg-none title-section-product mb-3 d-flex  justify-content-lg-between justify-content-center">
                    <button id="myInput" >

                        {{__('FILTERS')}}

                        <i class="fas  fa-filter"></i>
                    </button>
                </div>
                <div class="w-100 px-5 title-section-product mb-3 d-flex  {{app()->getLocale() =='fa' ? 'justify-content-lg-between': 'justify-content-End'}}  justify-content-lg-between justify-content-center">

@if(app()->getLocale() == 'fa')
<p class="text-center text-lg-right">تمام محصولات</p>
@else
       <p style="margin-left:15%;margin-right:0" class="text-center  text-lg-left">

           <strong>
               ALL
           </strong>
           PRODUCTS
           </p>

@endif


                </div>
                <div class="row justify-content-center justify-content-lg-normal">
                    <div id="filter-section" class="col-2 d-none d-lg-flex  justify-contet-center align-items-center flex-column">
                        @foreach($attributes as $attribute)
                        <div class="box-filter">
                            <p>{{ app()->getLocale() == 'fa' ? $attribute->name : $attribute->name_en }}</p>
                            <ul>
                                @foreach($attribute->AttributeValues()->orderby('priority_show','asc')->whereIn('id',$all_attribute_value_exists_ids)->get() as $attrValue)
                                <li class="d-flex ">
                                    <input autocomplete="off" id="attr_filter_{{ $attrValue->id }}"
                                           onclick="filter_products()"
                                           type="checkbox" name="attr_filter_ids[]"
                                           class="attr_filter_ids mx-2"
                                           value="{{ $attrValue->id }}">
                                    <label
                                            for="attr_filter_{{ $attrValue->id }}">{{ app()->getLocale() == 'fa' ? $attrValue->name : $attrValue->name_en }}</label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach

                    </div>
                    <div class="col-12 col-md-10 col-lg-8">

                        <div id="post-data" class="row">
                            @foreach($products as $product)

                            <div class="col-lg-4 col-sm-6 col-xl-4 col-xxl-3 col-md-4 mb-4">
                                <div  class="card">
                                    <a href="{{ route('home.product',['alias'=>$product->alias]) }}">
                                    <img class="card-img-top" src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$product->primary_image) }}">

                                    </a>
                                    <div class="card-body">
                                        <div class="product-title">
                                            <p>{{app()->getLocale() == 'fa' ? $product->name : $product->name_en}}

                                            </p>
                                           <p>

                                               <b>{{app()->getLocale() == 'fa' ? $product->title_1 : $product->title_1_en}} </b>
                                           </p>
                                            <p>{{app()->getLocale() == 'fa' ? $product->title_2 : $product->title_2_en}}</p>
                                        </div>
                                        <div class="product-details">

                               @if($product->shortDescription != null)
                                            <div class="product-description">
                                                             <span class="product-custom-title">{{__('Attribute')}}</span>
                                                {!! app()->getLocale() == 'fa' ? $product->shortDescription : $product->shortDescription_en !!}
                                            </div>
@endif
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                      <div class="d-flex mb-4 justify-content-center">

                                            <a onclick="AddToCompareList(event,{{ $product->id }},this)" class="btn-compare mr-3  {{session()->get('compareProducts') ? (in_array($product->id,session()->get('compareProducts')) ? 'disabled': '') : ''}}  cursor-pointer">
                                           {{__('Compare')}}
                                        </a>


                                        <a class="show-product cursor-pointer">{{__('More Information')}}</a>
                                      </div>

                                        @foreach($product->attributes->reverse() as $item)

@if($item->attribute_id == 2 or $item->attribute_id == 46)
@if($item->attributeValues($item->value,$item->attribute_id)->image != null)
<img  class="product-brand" src="{{imageExist(env('ATTR_UPLOAD_PATH'),$item->attributeValues($item->value,$item->attribute_id)->image)}}">
@endif
@endif
@endforeach





                                    </div>

                                </div>
                            </div>
                            @endforeach



                        </div>

                    </div>
                    <div class="col-1  d-none d-lg-flex justify-contet-center align-items-center flex-column">

                        <div  class="d-flex justify-content-start align-items-end flex-column">
                           <a style="{{app()->getLocale() == 'en' ? 'direction:ltr' : ''}}" class="tooltip-service" href="{{$setting->info_link}}">
                               <svg fill="#000000" width="45px" height="45px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path d="M17.1870269,5.90925826 L18.670875,5.60561111 C19.3034125,5.47617184 19.9478108,5.76601219 20.2706336,6.32515769 L21.0498744,7.67484231 C21.3726972,8.23398781 21.3015072,8.9369733 20.8731407,9.42004724 L19.869232,10.552167 C19.955984,11.026532 20,11.5105366 20,12 C20,12.4894634 19.955984,12.973468 19.869232,13.447833 L20.8731407,14.5799528 C21.3015072,15.0630267 21.3726972,15.7660122 21.0498744,16.3251577 L20.2706336,17.6748423 C19.9478108,18.2339878 19.3034125,18.5238282 18.670875,18.3943889 L17.1870269,18.0907417 C16.4472202,18.7213719 15.5983246,19.2134101 14.6804637,19.5397477 L14.2022657,20.9743416 C13.9980947,21.5868549 13.4248864,22 12.7792408,22 L11.2207592,22 C10.5751136,22 10.0019053,21.5868549 9.79773427,20.9743416 L9.31953628,19.5397477 C8.40167539,19.2134101 7.55277982,18.7213719 6.81297313,18.0907417 L5.32912501,18.3943889 C4.69658748,18.5238282 4.05218916,18.2339878 3.72936635,17.6748423 L2.95012557,16.3251577 C2.62730277,15.7660122 2.69849282,15.0630267 3.12685929,14.5799528 L4.13076802,13.447833 C4.04401605,12.973468 4,12.4894634 4,12 C4,11.5105366 4.04401605,11.026532 4.13076802,10.552167 L3.12685929,9.42004724 C2.69849282,8.9369733 2.62730277,8.23398781 2.95012557,7.67484231 L3.72936635,6.32515769 C4.05218916,5.76601219 4.69658748,5.47617184 5.32912501,5.60561111 L6.81297313,5.90925826 C7.55277982,5.27862815 8.40167539,4.78658986 9.31953628,4.46025233 L9.79773427,3.02565835 C10.0019053,2.41314514 10.5751136,2 11.2207592,2 L12.7792408,2 C13.4248864,2 13.9980947,2.41314514 14.2022657,3.02565835 L14.6804637,4.46025233 C15.5983246,4.78658986 16.4472202,5.27862815 17.1870269,5.90925826 Z M14.1326282,5.33065677 C13.9806142,5.28209151 13.8609139,5.16388061 13.8104493,5.0124866 L13.2535824,3.34188612 C13.1855254,3.13771505 12.994456,3 12.7792408,3 L11.2207592,3 C11.005544,3 10.8144746,3.13771505 10.7464176,3.34188612 L10.1895507,5.0124866 C10.1390861,5.16388061 10.0193858,5.28209151 9.86737183,5.33065677 C8.91148077,5.63604385 8.03422671,6.14493515 7.29282481,6.8189531 C7.17476231,6.92628523 7.01256297,6.97082432 6.8562438,6.93883595 L5.12864464,6.58530883 C4.9177988,6.54216241 4.70299936,6.63877585 4.59539176,6.82515769 L3.81615098,8.17484231 C3.70854337,8.36122415 3.73227339,8.59555264 3.87506221,8.75657729 L5.04377846,10.0745524 C5.1495098,10.1937869 5.1920708,10.3562805 5.15836615,10.5120367 C5.05341889,10.9970196 5,11.4948846 5,12 C5,12.5051154 5.05341889,13.0029804 5.15836615,13.4879633 C5.1920708,13.6437195 5.1495098,13.8062131 5.04377846,13.9254476 L3.87506221,15.2434227 C3.73227339,15.4044474 3.70854337,15.6387759 3.81615098,15.8251577 L4.59539176,17.1748423 C4.70299936,17.3612241 4.9177988,17.4578376 5.12864464,17.4146912 L6.8562438,17.061164 C7.01256297,17.0291757 7.17476231,17.0737148 7.29282481,17.1810469 C8.03422671,17.8550648 8.91148077,18.3639561 9.86737183,18.6693432 C10.0193858,18.7179085 10.1390861,18.8361194 10.1895507,18.9875134 L10.7464176,20.6581139 C10.8144746,20.862285 11.005544,21 11.2207592,21 L12.7792408,21 C12.994456,21 13.1855254,20.862285 13.2535824,20.6581139 L13.8104493,18.9875134 C13.8609139,18.8361194 13.9806142,18.7179085 14.1326282,18.6693432 C15.0885192,18.3639561 15.9657733,17.8550648 16.7071752,17.1810469 C16.8252377,17.0737148 16.987437,17.0291757 17.1437562,17.061164 L18.8713554,17.4146912 C19.0822012,17.4578376 19.2970006,17.3612241 19.4046082,17.1748423 L20.183849,15.8251577 C20.2914566,15.6387759 20.2677266,15.4044474 20.1249378,15.2434227 L18.9562215,13.9254476 C18.8504902,13.8062131 18.8079292,13.6437195 18.8416339,13.4879633 C18.9465811,13.0029804 19,12.5051154 19,12 C19,11.4948846 18.9465811,10.9970196 18.8416339,10.5120367 C18.8079292,10.3562805 18.8504902,10.1937869 18.9562215,10.0745524 L20.1249378,8.75657729 C20.2677266,8.59555264 20.2914566,8.36122415 20.183849,8.17484231 L19.4046082,6.82515769 C19.2970006,6.63877585 19.0822012,6.54216241 18.8713554,6.58530883 L17.1437562,6.93883595 C16.987437,6.97082432 16.8252377,6.92628523 16.7071752,6.8189531 C15.9657733,6.14493515 15.0885192,5.63604385 14.1326282,5.33065677 Z M12,16 C9.790861,16 8,14.209139 8,12 C8,9.790861 9.790861,8 12,8 C14.209139,8 16,9.790861 16,12 C16,14.209139 14.209139,16 12,16 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"/>
</svg>

                           </a>

                            <a style="{{app()->getLocale() == 'en' ? 'direction:ltr' : ''}}" class="tooltip-support"  tabindex="0" href="{{$setting->question_link}}">
                      <svg  width="45px" height="45px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path d="M6,17 L6,11 L4.5,11 C3.67157288,11 3,11.6715729 3,12.5 L3,15.5 C3,16.3284271 3.67157288,17 4.5,17 L6,17 Z M13.9146471,20 L16.0584816,20 C16.7041272,20 17.2773354,19.5868549 17.4815065,18.9743416 L17.7094306,18.2905694 C17.7432317,18.1891661 17.7850711,18.0921054 17.8340988,18 L17.5,18 C17.2238576,18 17,17.7761424 17,17.5 L17,10.5 C17,10.2238576 17.2238576,10 17.5,10 L18,10 L18,8.98439023 C18,5.67068173 15.3137085,2.98439023 12,2.98439023 C8.6862915,2.98439023 6,5.67068173 6,8.98439023 L6,10 L6.5,10 C6.77614237,10 7,10.2238576 7,10.5 L7,17.5 C7,17.7761424 6.77614237,18 6.5,18 L4.5,18 C3.11928813,18 2,16.8807119 2,15.5 L2,12.5 C2,11.1192881 3.11928813,10 4.5,10 L5,10 L5,8.98439023 C5,5.11839698 8.13400675,1.98439023 12,1.98439023 C15.8659932,1.98439023 19,5.11839698 19,8.98439023 L19,10 L19.5,10 C20.8807119,10 22,11.1192881 22,12.5 L22,15.5 C22,16.8807119 20.8807119,18 19.5,18 C19.1180249,18 18.778905,18.2444238 18.6581139,18.6067972 L18.4301898,19.2905694 C18.0899047,20.3114248 17.1345576,21 16.0584816,21 L13.9146471,21 C13.7087289,21.5825962 13.1531094,22 12.5,22 L11.5,22 C10.6715729,22 10,21.3284271 10,20.5 C10,19.6715729 10.6715729,19 11.5,19 L12.5,19 C13.1531094,19 13.7087289,19.4174038 13.9146471,20 L13.9146471,20 Z M18,11 L18,17 L19.5,17 C20.3284271,17 21,16.3284271 21,15.5 L21,12.5 C21,11.6715729 20.3284271,11 19.5,11 L18,11 Z M11,20.5 C11,20.7761424 11.2238576,21 11.5,21 L12.5,21 C12.7761424,21 13,20.7761424 13,20.5 C13,20.2238576 12.7761424,20 12.5,20 L11.5,20 C11.2238576,20 11,20.2238576 11,20.5 Z"/>
</svg>


                            </a>


                        </div>


                    </div>

                </div>
            </div>
        </section>


        <section class="brand-client section-margin">
            <img class="mb-3 w-100" src="{{ imageExist(env('CATEGORY_IMAGES_UPLOAD_PATH'),$category->banner_image) }}">

            <div class="container-fluid mt-5">
                <div class="row-custom row">
                    <div class="col-12">
                        <p class="des-about">
        {!! app()->getLocale() =='fa' ? $category->description : $category->description_en!!}
                        </p>
                    </div>
                </div>
            </div>




        </section>
    </div>

    <div class="modal-box-filter" >
        <div class="col-12 text-left">
            <button id="close-modal-box-filter">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div  class="col-12  justify-contet-center align-items-center flex-column">
            @foreach($attributes as $attribute)
                <div class="box-filter">
                    <p>{{ $attribute->name }}</p>
                    <ul>
                        @foreach($attribute->AttributeValues()->orderby('priority_show','asc')->whereIn('id',$all_attribute_value_exists_ids)->get() as $attrValue)
                            <li class="d-flex ">
                                <input autocomplete="off" id="attr_filter_{{ $attrValue->id }}"
                                       onclick="filter_products()"
                                       type="checkbox" name="attr_filter_ids[]"
                                       class="attr_filter_ids mx-2"
                                       value="{{ $attrValue->id }}">
                                <label
                                        for="attr_filter_{{ $attrValue->id }}">{{ $attrValue->name }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

    <div class="loader-filter">
        <div class='loading loading--double'></div>
    </div>
@endsection
