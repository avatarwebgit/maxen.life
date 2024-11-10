@extends('home.layouts.index')
@section('title')
    {{app()->getLocale() == 'fa' ? 'تماس با  ما':'Contact Us' }}
@endsection
@section('style')

    <style>
     

    @media (max-width:867px){
        .root-contact{
            margin-top:40%;
        }
    }
    .subtitle-page{
        text-align:justify;
    }
    @media (max-width:992px){
        .background-theme{
            margin-right:0;
        }
    }
    .contact-info-item{
        color:#fff;
    }
    .contact-info-item p,.contact-info-item a{
        font-size:18px;
        z-index:999;
    }
    header .header-page .contenet-hero,header .header-page .subtitle-page{
        max-width:100% !important;
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
            margin: 15px 0 5px 0;
            text-align: center;
            font-size: 31px;
            color: #000 !important;
        }
        .product-title  p:nth-child(2){
            font-size: 16px;
            font-family: 'Pelak'!important;
            color: #000;
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
            padding: 10px 15px;
            border-radius: 11px;
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
            margin-right:15%;
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

            z-index: 9999999;
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

iframe{
    width:100%;
    height:100%;
}

@media (min-width:300px) and (max-width:370px) {
.site-header .inner-header .main-logo{
    width: 125px !important;
    left: 10px !important;
    top:-5px !important;
    position: absolute;
}
}


@media (max-width:992px){
    .image-head .box-text{
        top: -76px !important;
    }
}
.site-header {
    padding: 30px 0 !important;
    background: #fff;
    border-bottom: 1px solid;
}
    </style>
    
@endsection
@section('script')

@endsection
@section('content')


            <header class="d-none d-lg-block">
                <div class="header-page background-section">
                    <div class="container h-100">
                        <div class="contenet-hero p-relative">
                           
                            <h1 class="title">
                            {{app()->getLocale() == 'fa' ? $setting->contact_1 : $setting->contact_1_en}}
                            </h1>
                            <p class="subtitle-page">
                                {{app()->getLocale() == 'fa' ? $setting->contact_2 : $setting->contact_2_en}}
                                 </p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="wrapper root-contact">
                <div class="image-head p-relative mb-section">
                    <div class=" p-absolute w-100 h-100" >
                        
                        
                        <iframe src="https://balad.ir/embed?p=5A9Uxvt4Wf311Q" title="مشاهده «شرکت ویتانا» روی نقشه بلد" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>

                    <div class="box-text margin-lr-100 section-padding p-relative background-theme">
                        <h5 class="title-block">{{__('Office')}}</h5>
                        <div class="address-container">
                            <ul>
                                <li class="contact-info-item d-flex">
                                    {{__('Phone')}}
                                    <span class="dott">:</span>
                                    <p>{{$setting->tel}}</p>
                                </li>

                                <li class="contact-info-item d-flex over-hidden">
                                    {{__('Email')}}
                                    <span class="dott">:</span>
                                    <a class="link-hover" data-hover-text="{{$setting->email}}" href="mailto:info@sultanchap.com">{{$setting->email}}</a>
                                </li>

                                <li class="contact-info-item d-flex">
                                    <span>{{__('Address')}}</span>
                                    <span class="dott">:</span>
                                    <p>
                                {{app()->getLocale() == 'fa' ? $setting->address : $setting->address_en}}
                                    </p>
                                </li>
                                
                                @if(app()->getLocale() == 'fa')
                                              <li class="contact-info-item d-flex">
                                    <span>{{__('Online Shopping')}}</span>
                                    <span class="dott">:</span>
                                    <a style="text-transform:uppercase" href="https://shop.maxen.life">
                                shop.maxen.life
                                    </a>
                                </li>
                                
                                @endif
                            </ul>
                        </div>
                        <div class="shap-section">
                            <img src="{{asset("home/img/arr.svg")}}" alt="" />
                        </div>
                    </div>
                </div>

                <div class="container section-margin">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-box">
                                <div class="section-title text-center">
           
                                    <h2{{__('contact')}}</h2>
                                </div>
                                <form   class="form" method="POST" >

                                    @csrf
                                    <div class="messages"></div>
                                    <div class="input__wrap controls">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <div class="entry">
                                                        <label>{{__("YOUR NAME")}}</label>
                                                        <input id="form_name" type="text" name="name" placeholder="{{__("YOUR NAME")}}" required="required" data-error="نام مورد نیاز است." />
                                                    </div>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <div class="entry">
                                                        <label>{{__("YOUR EMAIL")}}</label>
                                                        <input id="form_email" type="email" name="email" placeholder="{{__("YOUR EMAIL")}}" required="required" data-error="ایمیل معتبر مورد نیاز است." />
                                                    </div>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="entry">
                                                        <label>{{__('Subject')}}</label>
                                                        <input
                                                            id="form_message"
                                                            class="form-control"
                                                            name="subject"
                                                            required="required"
                                                            type="text"

                                                        >
                                                    </div>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="entry">
                                                        <label>{{__('Whats up ?')}}</label>
                                                        <textarea
                                                            id="form_message"
                                                            class="form-control"
                                                            name="message"
                                                            placeholder="{{__('Tell us about yourself and the world')}}"
                                                            required="required"
                                                            data-error="لطفا برای ما پیام بگذارید."
                                                        ></textarea>
                                                    </div>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="text-center">
                                                    <div class="image-zoom w-auto d-inline-block" data-dsn="parallax">
                                                        <button type="submit" class="btn-form">
                                                            <span class="label">{{__('Send Message')}}</span>
                                                            <span class="icon-c"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(Session::has('success'))
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <div class="image-zoom w-auto d-inline-block alert" data-dsn="parallax">
                                                        {{ Session::get('success') }}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                        <header class="d-block d-lg-none">
                <div class="header-page background-section">
                    <div class="container h-100">
                        <div class="contenet-hero p-relative">
                           
                            <h1 class="title">
                            {{app()->getLocale() == 'fa' ? $setting->contact_1 : $setting->contact_1_en}}
                            </h1>
                            <p class="subtitle-page">
                                {{app()->getLocale() == 'fa' ? $setting->contact_2 : $setting->contact_2_en}}
                                 </p>
                        </div>
                    </div>
                </div>
            </header>

            
@endsection