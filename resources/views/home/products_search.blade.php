@extends('home.layouts.index')

@section('title')
    {{ $title }}
@endsection

@section('style')
    <style>
    .category-section{
        background:#fff;
    }
    .card:hover{
            background: #eeebeb;
    border-color: #eeebeb;
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
        .change-lang-btn{
            width: 120px;
            background: transparent;
            border: 1px solid #000;
            margin-left: 17px;
            padding: 2px 12px;
            border-radius: 21px;
            font-size: 15px;
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            align-items: center;
            transition: all ease .4s;
            height: 28px;
        }
        .change-lang-btn .divider{
            height: 1px ;
            transition: all ease .4s;
            width: 66%;
            background:#000;

        }
        .animate-change-lang-btn{
            width: 41px;
            background: transparent;
            border: 1px solid #000;
            margin-left: 17px;
            padding: 2px 12px;
            border-radius: 50%;
            font-size: 15px;
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            align-items: center;
            height: 41px;
        }
        .animate-change-lang-btn .divider{
            width: 161%;
        }
        .animate-change-lang-btn .divider:nth-child(1){
            transform: rotate(45deg) translate(6px, 6px);
        }
        .animate-change-lang-btn .divider:nth-child(2){
            transform: rotate(-45deg) translate(6px, -6px);
        }
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
        .card{
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
@media (min-width:300px) and (max-width:370px) {
.site-header .inner-header .main-logo{
    width: 125px !important;
    left: 5px !important;
    top:-17px !important;
    position: absolute;
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
                url: "{{ route('home.product.search') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    attribute_values: attribute_values,


                    page: page,
                },
                dataType: "json",
                type: 'get',
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg[0] === 1) {
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
                    <button id="myInput" >فیلتر

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
                      
                            <div class="col-lg-3 mb-4">
                                <div  class="card">
                                    <a href="{{ route('home.product',['alias'=>$product->alias]) }}">
                                    <img class="card-img-top" src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$product->primary_image) }}">

                                    </a>
                                    <div class="card-body">
                                        <div class="product-title">
                                            <p>{{$product->title_1}} <b> {{$product->title_2}}</b></p>
                                            <p>{{$product->name}}</p>
                                        </div>
                                        <div class="product-details">

                                            <span>{{__('Attribute')}}</span>
                                            <div class="product-description">
                                                {!! $product->shortDescription !!}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        @foreach($product->attributes as $item)
@if($item->attribute_id == 2)
<img class="product-brand" src="{{imageExist(env('ATTR_UPLOAD_PATH'),$item->attributeValues($item->value,$item->attribute_id)->image)}}">
@endif
@endforeach
                                        
                                        <a onclick="AddToCompareList(event,{{ $product->id }})" class="btn-compare cursor-pointer">
                                           {{__('Add To CompareList')}}
                                        </a>

                                    </div>

                                </div>
                            </div>
                            @endforeach



                        </div>

                    </div>
                    <div class="col-2  d-none d-lg-flex justify-contet-center align-items-center flex-column">

                        <div class="mb-2">
                            <a href="{{$setting->support_link}}" class="d-flex flex-column text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="82.545" height="73.755" viewBox="0 0 82.545 73.755">
                                    <path id="Path_1357" data-name="Path 1357" d="M69.482,34.077a33.577,33.577,0,1,0-67.154,0" transform="translate(5.508)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1358" data-name="Path 1358" d="M12.3,44.054A33.577,33.577,0,0,0,45.881,10.477" transform="translate(29.109 23.603)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1359" data-name="Path 1359" d="M21.833,24.387a5.6,5.6,0,1,0-5.6,5.6A5.6,5.6,0,0,0,21.833,24.387Z" transform="translate(25.177 43.27)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <line id="Line_57" data-name="Line 57" x2="15.109" transform="translate(0 34.078)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <line id="Line_58" data-name="Line 58" x2="15.109" transform="translate(67.436 34.078)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1360" data-name="Path 1360" d="M46.545,25.036A20.146,20.146,0,1,0,26.4,45.183,20.147,20.147,0,0,0,46.545,25.036Z" transform="translate(14.793 10.381)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                </svg>

                                <span class="text-dark mt-2 text-center" >SUPPORT</span>
                            </a>
                        </div>
                        <div class="mb-2">
                            <a href="{{$setting->login_link}}" class="d-flex flex-column text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="68.155" height="58.176" viewBox="0 0 68.155 58.176">
                                    <path id="Path_1361" data-name="Path 1361" d="M29.351,55.243,19.344,45.237,9.2,55.378" transform="translate(14.576 -16.229)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1362" data-name="Path 1362" d="M59.607,46.6A33.579,33.579,0,0,0,12.119,94.09" transform="translate(-1.787 -36.267)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1363" data-name="Path 1363" d="M19.317,87.177a33.58,33.58,0,0,0,0-47.488" transform="translate(38.503 -29.354)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1364" data-name="Path 1364" d="M46.5,61.3A20.146,20.146,0,1,0,26.355,81.45,20.147,20.147,0,0,0,46.5,61.3Z" transform="translate(7.497 -25.886)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                </svg>


                                <span class="text-dark mt-2 text-center">LOG IN</span>
                            </a>
                        </div>


                    </div>

                </div>
            </div>
        </section>


        <section class="brand-client section-margin">





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
@endsection
