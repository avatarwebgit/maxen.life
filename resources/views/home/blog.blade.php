@extends('home.layouts.index')
@section('title')
    {{app()->getLocale() =='en' ? 'Articles' : 'مقالات'}}
@endsection
@section('style')

    <style>
    .post-content{
        width:100% !important;
    }
    @media (max-width:992px){
        .text-lg-left, .text-lg-right{
            font-size:24px !important;
        }
    }
    .news-content .post-content blockquote{
       text-align:justify; 
       font-style:normal;
    }
    .news-content .post-content blockquote{
        padding:0 !important;
    }
    .v-light:not(.no-light) .news-content .post-content blockquote{
        border-right:none;
    }
        .our-blog-classic{
            border-top: 1px solid;
    padding-top: 50px;
    }
    @media (min-width: 1200px) {
    .container {
        max-width: 86% !important;
        margin: 0 7% !important;
        padding:0;
    }
}

.site-header{
       border-bottom: 1px solid #000 !important;
}
.news-content{
    padding-top:50px;
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
                     .text-lg-left,.text-lg-right{
            font-size: 45px;
            color: #000 !important;
            align-content: center;
        }
    </style>
    <style>
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
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" integrity="sha512-rd0qOHVMOcez6pLWPVFIv7EfSdGKLt+eafXh4RO/12Fgr41hDQxfGvoi1Vy55QIVcQEujUE1LQrATCLl2Fs+ag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--}}
    <style>
            .site-header{
    padding:30px 0 !important;
    background:#fff;
    border-bottom:1px solid ;
}
    section p{
        font-size:22px;
        color:#000;
        padding:4%;
    }
    .product-brand{
            height: auto;
    width: 120px !important;
    }
        .product-attribute ul li span.title-attr {
min-width:150px;
}
        .more-img {
            width: 105px;
            border: 1px solid #ccc;
            padding: 5px 19px;
            border-radius: 12px;
            margin-bottom: 15px;
            cursor: pointer;
        }
.gallery_modal_right .active{
    opacity: 1 !important;
    display:block !important;
}
        .fade:not(.show) {
            opacity: 0;
        }
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 99999;
            display: none;
            width: 100%;
            height: 100%;
            overflow-x: hidden;

            outline: 0;
        }
        .fade {
            transition: opacity .15s linear;
        }
        .modal.fade .modal-dialog {
            transition: transform .3s ease-out;
            transform: translate(0, -50px);
        }
        .d-none {
            display: none;
        }
@media (min-width: 992px) {
    .d-lg-none {
        display: none;
    }
}
        @media (min-width:992px)
        {.modal-lg{width:900px}}

.modal-dialog {
    max-width: 500px;
    margin: 1.75rem auto;
}


.modal-dialog {
    position: relative;
    width: auto;
    margin: .5rem;
    pointer-events: none;
}
.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: .3rem;
    outline: 0;
}
.modal-header {
    display: flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1rem;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: calc(.3rem - 1px);
    border-top-right-radius: calc(.3rem - 1px);
}
.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
}
.modal-body {
    position: relative;
    flex: 1 1 auto;
    padding: 1rem;
}

.modal.show .modal-dialog {
    transform: none;
}
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
    background-color: #000;
}
.modal-backdrop.fade {
    opacity: 0;
}
.modal-backdrop.show {
    opacity: .5;
}
.modal-footer {
    display: flex;
    flex-wrap: wrap;
    flex-shrink: 0;
    align-items: center;
    justify-content: flex-end;
    padding: .75rem;
    border-top: 1px solid #dee2e6;
    border-bottom-right-radius: calc(.3rem - 1px);
    border-bottom-left-radius: calc(.3rem - 1px);
}
@media (min-width: 992px) {
    .modal-lg, .modal-xl {
        --bs-modal-width: 800px;
    }
}

@media (min-width: 576px) {
    .modal-dialog {
        max-width: 800px;
        margin-right: auto;
        margin-left: auto;
    }
}
.modal-dialog {
    position: relative;
    width: auto;

    pointer-events: none;
}
        .modal{
            height: fit-content !important;
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
        .product-title  h1{

            font-family: sans-serif !important;
            color: #000;
        }

        .product-details span {
            font-size: 11px;
            /* padding: 4px; */
            /* border: 1px solid; */
            color: #000;
            margin-bottom: 7px;
        }
        @media  (min-width:800px) {
            .product-details {
                padding: 0 55px;
            }
        }


        .product-description{
            font-size: 12px;
            border: 1px solid #000;
            padding: 20px;
            border-radius: 15px;
            color: #000;
        }

        /*.product-brand{*/
        /*    width:33% !important;*/

        /*}*/
        .btn-compare{
            color: #000;
            font-size: 12px;
            height:fit-content;
            border: 1px solid;
            padding: 5px 15px;
            border-radius: 11px;
        }
        .card-footer{
            margin-top:15px;
            display: flex;
            padding: 0 55px;
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
        .small-thumb-img  {
            width: 105px;
            border: 1px solid #ccc;
            padding: 5px 19px;
            border-radius: 12px;
            margin-bottom: 15px;
            cursor: pointer;
        }
        .thumbnail img{
            width:100%;
        }
        .product-section{
            border-top: 1px solid;
            padding-top: 50px;
            position:relative;
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
        .header-product-attribute p{
            padding:10px;
        }
        .product-attribute{

            border-top:2px solid #ccc;
        }
        .section-attributes .product-attribute:first-of-type .header-product-attribute{
            border-top:none;
        }
        .product-attribute ul li:last-of-type{
            border-bottom: none;
        }
        .product-attribute ul li{
            padding: 15px;
            border-bottom: 1px solid;
            color: #000;
        }
        .product-attribute ul li span {
            margin:0 20px;
        }
        .title-product{
            padding:10px 0;
            cursor: pointer;
        }
        .section-attributes{
            padding: 0 5%;
        }
        .arrow_icon {
            width: 20px;
            height: 20px;
        }


        .modal#galleryModal {
            padding-top: 0
        }

        .modal#galleryModal .modal-title {
            padding-right: 20px
        }

        .modal#galleryModal .modal-content .modal-body {
            padding: 0
        }

        .modal#galleryModal .galleryModal_content {
            position: relative
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left {
            width: 200px;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 1
        }

        @media only screen and (max-width: 480px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_left {
                width:150px
            }
        }

        @media only screen and (max-width: 414px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_left {
                width:100px
            }
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left {
            height: calc(100vh - 220px)
        }

        @media all and (orientation: landscape) and (max-height:700px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left {
                height:450px
            }
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left .tabs {
            position: relative
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left .tabs:after {
            content: '';
            display: block;
            width: 1px;
            height: 100%;
            background: #ececec;
            right: 19px;
            top: 0;
            position: absolute
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul {
            padding-right: 20px
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li {
            text-align: center;
            border-bottom: 1px solid #ececec;
            position: relative
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li:first-child {
            border-top: 1px solid #ececec
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li:last-child {
            border-bottom: 1px solid #ececec
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li:after {
            content: '';
            right: -14px;
            top: 50%;
            margin-top: -13px;
            position: absolute;
            display: none;
            z-index: 2
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li a {
            width: 100%;
            display: block;
            height: 100%;
            padding: 10px
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li a img {
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-duration: .3s;
            transition-duration: .3s;
            filter: alpha(Opacity=70);
            opacity: .7
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li.active a img {
            filter: alpha(enabled=false);
            opacity: 1
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li.active:after {
            display: block
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left .slimScrollBar,.modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left .slimScrollRail {
            display: block!important
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_right {
            width: 100%;
            padding-right: 20px;
            padding-left: 200px;
            float: right;
            position: relative;
            display: table;
            table-layout: fixed
        }

        @media only screen and (max-width: 480px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_right {
                padding-left:150px
            }
        }

        @media only screen and (max-width: 414px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_right {
                padding-left:100px
            }
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_right .gallery_modal_right {
            height: calc(100vh - 220px);
            text-align: center;
            vertical-align: middle;
            display: table-cell;
            width: 100%
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_right .gallery_modal_right video {
            width: 75%
        }
        @media all and (orientation: landscape) and (max-height:700px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_right .gallery_modal_right {
                height:450px;
                display: block
            }

            .modal#galleryModal .galleryModal_content #gallery_modal_right .gallery_modal_right img {
                height: 400px;
                margin-top: 25px
            }
        }


        .modal#galleryModal {
            padding-top: 0
        }

        .modal#galleryModal .modal-title {
            padding-right: 20px
        }

        .modal#galleryModal .modal-content .modal-body {
            padding: 0
        }

        .modal#galleryModal .galleryModal_content {
            position: relative
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left {
            width: 200px;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 1
        }

        @media only screen and (max-width: 480px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_left {
                width:150px
            }
        }

        @media only screen and (max-width: 414px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_left {
                width:100px
            }
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left {
            height: calc(100vh - 220px)
        }

        @media all and (orientation: landscape) and (max-height:700px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left {
                height:450px
            }
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left .tabs {
            position: relative
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left .tabs:after {
            content: '';
            display: block;
            width: 1px;
            height: 100%;
            background: #ececec;
            right: 19px;
            top: 0;
            position: absolute
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul {
            padding-right: 20px
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li {
            text-align: center;
            border-bottom: 1px solid #ececec;
            position: relative
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li:first-child {
            border-top: 1px solid #ececec
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li:last-child {
            border-bottom: 1px solid #ececec
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li:after {
            content: '';
            right: -14px;
            top: 50%;
            margin-top: -13px;
            position: absolute;
            display: none;
            z-index: 2
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li a {
            width: 100%;
            display: block;
            height: 100%;
            padding: 10px
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li a img {
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-duration: .3s;
            transition-duration: .3s;
            filter: alpha(Opacity=70);
            opacity: .7
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li.active a img {
            filter: alpha(enabled=false);
            opacity: 1
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left ul li.active:after {
            display: block
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left .slimScrollBar,.modal#galleryModal .galleryModal_content #gallery_modal_left .gallery_modal_left .slimScrollRail {
            display: block!important
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_right {
            width: 100%;
            padding-right: 20px;
            padding-left: 200px;
            float: right;
            position: relative;
            display: table;
            table-layout: fixed
        }

        @media only screen and (max-width: 480px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_right {
                padding-left:150px
            }
        }

        @media only screen and (max-width: 414px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_right {
                padding-left:100px
            }
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_right .gallery_modal_right {
            height: calc(100vh - 220px);
            text-align: center;
            vertical-align: middle;
            display: table-cell;
            width: 100%
        }

        .modal#galleryModal .galleryModal_content #gallery_modal_right .gallery_modal_right video {
            width: 75%
        }
        @media all and (orientation: landscape) and (max-height:700px) {
            .modal#galleryModal .galleryModal_content #gallery_modal_right .gallery_modal_right {
                height:450px;
                display: block
            }

            .modal#galleryModal .galleryModal_content #gallery_modal_right .gallery_modal_right img {
                height: 400px;
                margin-top: 25px
            }
        }
        .w-100 {
            width: 100%;
        }


        @media (max-width:768px) {

            .small-thumb-img{
                padding: 5px !important;
            }
        }

        @media (min-width: 768px) {
            .d-md-none {
                display: none;
            }
        }
        @media (min-width: 768px) {
            .d-md-block {
                display: block;
            }
        }
        @media (min-width: 992px) {
            .d-lg-flex {
                display: -ms-flexbox;
                display: flex;
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
@section('content')


    <div class="wrapper">

        <div class="container">

            <div class="news-content mt-section">
<div class="news-content-inner justify-content-start">
                                                        @if(app()->getLocale() == 'fa')
<p class=" text-lg-right text-right">
    {{$article->title}}
     </p>
@else
       <p style="margin-right:0;text-align:left" class=" text-left text-lg-left">
           
{{$article->title_en}}
           </p>

@endif
</div>
                <div class="news-content-inner w-100">

                    <div class="post-content w-100">
                        <p>
                            <a >
                                {!! app()->getLocale() == 'fa' ? $article->shortDescription : $article->shortDescription_en  !!}
                            </a>
                            <img class="w-100" src="{{ imageExist(env('ARTICLES_IMAGES_UPLOAD_PATH'),$article->image) }}" alt="" />
                        <blockquote class="wp-block-quote">
                            <p>
                          
                                   {!! app()->getLocale() == 'fa' ? $article->description : $article->description_en !!}
                             
                            </p>
                        </blockquote>


                    </div>
                </div>


            </div>
        </div>
    </div>

    <section class="contact-up next-post-up section-margin section-padding">
        <div class="container">
            <div class="c-wapp">
                <a href="{{  isset($random_blog->alias) ? route('home.article',$random_blog->alias) : ''}}" class="effect-ajax">
                                <span class="title hiring">
                                    {{__('Read more articles')}}
                                </span>
                    <span class="career">
                                    {{__('Next Post')}}
                                </span>
                </a>
            </div>
        </div>
    </section>
@endsection
