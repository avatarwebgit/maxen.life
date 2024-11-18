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
@media (min-width:992px){
    .product-small-thumb {
    justify-content:center;
}
}

@media (max-width:992px){
    .product-section{
        border-top:none !important;
    }
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
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" integrity="sha512-rd0qOHVMOcez6pLWPVFIv7EfSdGKLt+eafXh4RO/12Fgr41hDQxfGvoi1Vy55QIVcQEujUE1LQrATCLl2Fs+ag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--}}
    <style>
    .d-block {
    display: block !important;
}

    .product-brand{
            height: auto;
    width: 120px !important;
    }
    .site-header{
        z-index:99 !important;
    }
        .product-attribute ul li span.title-attr {
max-width:250px;
width:40%;
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
             z-index: 9999999999999999;
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

            border-top:1px solid #000;
        }
        .section-attributes .product-attribute:first-of-type .header-product-attribute{
            border-top:none;
        }
        .product-attribute ul li:last-of-type{
            border-bottom: none;
        }
        .product-attribute ul li{
            padding: 10px;
            border-bottom: 1px solid #c3c3c3;
            color: #000;
        }
        .product-attribute ul li span {
            margin:0 20px;
        }
        .title-product{
            color:#000;
            padding:10px 0;
            font-size:18px;
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

        .margin-0{
            margin:0 !important;
        }
    </style>

    <style>
            .arrow-1{
        display:none !important;
    }
    .arrow-2{
        display:block !important;
    }
    .custom-arrow{
                position: absolute !important;
    left: 0 !important;
    top: 24%  !important;
    }
    .position-arrow{
        position: absolute !important;
    left: 0 !important;
    top: 4%  !important;
    }

    .custom-arrow{
        transition:all .4s ease;
    }

    @media (min-width: 768px) {
    .d-md-none {
        display: none !important;
    }
}
    </style>
        <style>
            @media (max-width:768px){

        #dsn-hero-parallax-title img{
            position:fixed !important;
        }

    .site-header{
        padding: 22px 15px !important;
    }

    }

    .text-title-1,.text-title-2,.text-title-3{
        text-align:left;
        padding-left:8%;
    }
.text-title-3{
    margin-top:3%;
}
    </style>

    @if(app()->getLocale() == 'fa')
    <style>
            .text-title-1,.text-title-2,.text-title-3{
        text-align:right !important;
           padding-left:unset !important;
           padding-right:8% !important;

    }
    </style>
    @endif
    <style>
            .text-title-1,.text-title-2,.text-title-3{
        text-align:center !important;

    }
                   .change-lang-btn-mobile {
    display: none !important;
}
@media (max-width:408px){
           .site-header .inner-header .main-logo {
    width: 120px !important;
}
}
@media (min-width:300px) and (max-width:492px){
           .text-title-2 {
    font-size: 30px !important;
}
}

            @media only screen and (min-width: 992px) {
                .classic-menu .site-header .extend-container .main-navigation ul.extend-container>li {

                    display: inline-block !important;

                }
            }


            @media (min-width: 768px) {
                .classic-menu .site-header .extend-container .main-navigation ul.extend-container>li.d-md-none {
                    display: none !important;
                }
            }
    </style>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js" integrity="sha512-Ysw1DcK1P+uYLqprEAzNQJP+J4hTx4t/3X2nbVwszao8wD+9afLjBQYjz7Uk4ADP+Er++mJoScI42ueGtQOzEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
//  $(document).on('click', function(event) {
//      console.log(!$(event.target).closest('.modal, .modal-backdrop').length);
//         if (!$(event.target).closest('.modal, .modal-backdrop').length) {
//             $('.modal').fadeOut();
//             $('.modal-backdrop').fadeOut();
//         }
//     });
        function open_tab_group(tag, attr_group_id) {
            $('#attr_group_table_' + attr_group_id).slideToggle(500);
            $(tag).find('.left_icon').toggleClass('d-none');
            $(tag).find('.down_icon').toggleClass('d-none');
            $(tag).find('.custom-arrow').toggleClass('position-arrow');
              $('.arrow-1').toggleClass('d-block');
              $('.arrow-2').toggleClass('d-lg-none');
              $('.arrow-2.d-lg-none').fadeOut();
              $('.arrow-1.d-block').fadeIn();
        }
        $('.small-thumb-img  ').click(function (){
            $('.thumbnail').find('img').attr('src',$(this).find('img').attr('src'));
        })

        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'vertical',

            breakpoints: {
                // when window width is >= 320px
                320: {
                    direction: 'horizontal',
                    slidesPerView: 3,
                },
                // when window width is >= 480px
                480: {
                    direction: 'horizontal',
                    slidesPerView: 3,
                },
                // when window width is >= 640px
                640: {
                    direction: 'horizontal',
                    slidesPerView: 3,
                },

                765:{
                    direction: 'horizontal',
                },

                810:{
                    direction: 'horizontal',
                },
                996:{
                    direction: 'vertical',
                }
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });


        $(document).ready(function () {
            $('input').prop('checked', false);
            $('.product_color').find('input').prop('checked', false);
            let product_colors = {{ count($product_colors) }};
            let product_variation = {{ count($product_attr_variations_categories) }};
            if (product_colors == 1) {
                $("input[name='product_color']").trigger('click');
            }
            if (product_variation == 1) {
                $("input[name='product_attr_variation_categories']").trigger('click');
            }
        })






        function checkActiveItem(elm) {
            $(".modal_left_pic").removeClass("active");
            $(".modal_right_pic").removeClass("active");
            $(elm).addClass("active");
            $(".modal_right_pic img").attr("src", $(elm).find('img').attr('src'));
            $(".modal_right_pic ").addClass('active');

        }

        function checkActiveSelectItem(elm) {
            $("#galleryModal").modal('show');
            $(".modal_left_pic").removeClass("active");
            $(".modal_right_pic").removeClass("active");

            if (elm){
                $(".modal_right_pic img").attr("src", $(elm).attr('src'));
                $(".modal_right_pic ").addClass('active');
            }else {
                $(".modal_right_pic ").addClass('active');
            }



        }

    </script>
@endsection

@section('modal')
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <strong class="modal-title">{{$product->name}}</strong>
                    <div class="galleryModal_content">
                        <div id="gallery_modal_left">
                            <div class="gallery_modal_left">
                                <div class="tabs">
                                    <div class="slimScrollDiv"
                                         style="position: relative; overflow: hidden; width: 100%; height: 430px;">
                                        <ul class="list-unstyled tab-small-show"
                                            style="overflow-y: scroll; width: 100%; height: 430px;overflow-x: hidden">

                                            @foreach($AllProductImages as $key => $image)
                                                <li class="modal_left_pic  modal_left_pic_1 active" data-id="1"
                                                    onclick="checkActiveItem(this)">
                                                    <a class="lg_item_tab1" href="javascript:void(0);">
                                                        <img src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$image) }}"
                                                             alt="{{$product->name}}">
                                                    </a>
                                                </li>

                                            @endforeach


                                        </ul>
                                        <div class="slimScrollBar"
                                             style="background: rgb(183, 183, 183); width: 6px; position: absolute; top: 0px; opacity: 1; display: block; border-radius: 4px; z-index: 99; left: 10px;"></div>
                                        <div class="slimScrollRail"
                                             style="width: 6px; height: 100%; position: absolute; top: 0px; display: block; border-radius: 4px; background: rgb(229, 229, 229); opacity: 1; z-index: 90; left: 10px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="gallery_modal_right">
                            <div class="gallery_modal_right">
                                <div class="tab-content tab-big-show">

                                    <div class="tab-pane fade in  posr modal_right_pic  active"
                                         >

                                        <div class="zoom-wrapper"
                                             style="overflow: hidden; position: relative;">
                                            <div  class="my_panzoom panzoom10001"

                                                 style="transform: none; transform-origin: 50% 50%; cursor: move;">
                                                <img src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$product->primary_image) }}"
                                                     alt="{{$product->name}}" title="{{$product->name}}"
                                                     width="" height="">
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="modal-close" data-dismiss="modal" aria-label="Close"></a>
        </div>
    </div>
@endsection
@section('content')


    <div class="wrapper">

        <section class="product-section section-margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 order-lg-1 order-2">
                        <div class="product-title text-center">
                            <h4 class="text-title-1" style="font-weight:500">{{app()->getLocale() == 'fa' ? $product->name : $product->name_en}}


                            </h4>
                            <h1 class="text-title-2" style="font-weight:800">{{app()->getLocale() == 'fa' ? $product->title_1 : $product->title_1_en}}</h1>
                            <h2 class="text-title-3" style="font-weight:500">{{app()->getLocale() == 'fa' ? $product->title_2 : $product->title_2_en}}</h2>
                        </div>
                        <div class="product-details">

                            <span>{{__('Main features')}}</span>
                            <div class="product-description">
{!!app()->getLocale() == 'fa' ? $product->shortDescription :  $product->shortDescription_en!!}                            </div>

                        </div>
                        <div class="card-footer dir-rtl">

                            <a onclick="AddToCompareList(event,{{ $product->id }})" class="btn-compare">
                                {{__('Compare')}}
                            </a>
                                                                    @foreach($product->attributes as $item)
                                                                        @if($item->attribute_id == 2 or $item->attribute_id == 46)

                                                                        @if($item->attributeValues($item->value,$item->attribute_id)->image != null)
                                                                                                                                                <img class="product-brand" src="{{imageExist(env('ATTR_UPLOAD_PATH'),$item->attributeValues($item->value,$item->attribute_id)->image)}}">

                                                                        @endif
                                                                        @endif
                                                                    @endforeach



                        </div>


                    </div>
                    <div class="col-lg-6 order-lg-2 order-1">
                        <div class="row">

                            <div class="col-lg-9 ">
                                <div class="single-product-thumbnail-wrap zoom-gallery">

                                    <div class="thumbnail">

                                        <img  data-id="0" onclick="checkActiveSelectItem(this)"
                                            src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$product->primary_image) }}"
                                            alt="">

                                    </div>



                                </div>
                            </div>
                            <div class="col-lg-2 d-none d-md-block swiper">
                                <div class="product-small-thumb small-thumb-wrapper swiper-wrapper justify-content-md-between justify-content-lg-normal small-thumb-style-two">
                                    @foreach($AllProductImages as $key => $image)
                                        @if($image!=null and $key+1 != 5)
                                    <div class="small-thumb-img  ">
                                        <img data-id="{{$key+1}}"  onclick="checkActiveSelectItem(this)"
                                            src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$image) }}"
                                        >
                                    </div>
                                        @endif
                                    @endforeach
                                        @if(count($AllProductImages)>= 5)
                                        <div class="more-img">
                                            <img  onclick="checkActiveSelectItem(false)"
                                                 src="{{asset('home/img/more.png')}}"
                                            >

                                        </div>
                                        @endif


                                </div>
                            </div>

                            <div class="col-lg-12 d-block d-md-none swiper">
                                <div class="product-small-thumb small-thumb-wrapper  justify-content-md-between justify-content-lg-normal small-thumb-style-two">
                            <div class="row p-4">
                                @foreach($AllProductImages as $key => $image)
                                    @if($image!=null and $key+1 <= 3)
                                        <div class="small-thumb-img w-100 col-3 ">
                                            <img class="w-100" data-id="{{$key+1}}"  onclick="checkActiveSelectItem(this)"
                                                 src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$image) }}"
                                            >
                                        </div>
                                    @endif
                                @endforeach
                                @if(count($AllProductImages)>3)
                                    <div class="more-img col-3">
                                        <img onclick="checkActiveSelectItem(false)"
                                             src="{{asset('home/img/more.png')}}"
                                        >

                                    </div>
                                @endif
                            </div>


                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 d-none  col-lg-1 order-3 d-lg-flex justify-content-center align-items-start flex-lg-column">

                        <div class="mb-2 w-100 d-flex justify-content-center align-items-center">
                            <a href="{{$setting->support_link}}" class="d-flex flex-column text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="55" height="73.755" viewBox="0 0 82.545 73.755">
                                    <path id="Path_1357" data-name="Path 1357" d="M69.482,34.077a33.577,33.577,0,1,0-67.154,0" transform="translate(5.508)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1358" data-name="Path 1358" d="M12.3,44.054A33.577,33.577,0,0,0,45.881,10.477" transform="translate(29.109 23.603)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1359" data-name="Path 1359" d="M21.833,24.387a5.6,5.6,0,1,0-5.6,5.6A5.6,5.6,0,0,0,21.833,24.387Z" transform="translate(25.177 43.27)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <line id="Line_57" data-name="Line 57" x2="15.109" transform="translate(0 34.078)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <line id="Line_58" data-name="Line 58" x2="15.109" transform="translate(67.436 34.078)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1360" data-name="Path 1360" d="M46.545,25.036A20.146,20.146,0,1,0,26.4,45.183,20.147,20.147,0,0,0,46.545,25.036Z" transform="translate(14.793 10.381)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                </svg>

                                <span class="text-dark mt-1 text-center" >SUPPORT</span>
                            </a>
                        </div>
                        <div class="mb-2 w-100 d-flex justify-content-center align-items-center">
                            <a href="{{$setting->login_link}}" class="d-flex flex-column text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="58.176" viewBox="0 0 68.155 58.176">
                                    <path id="Path_1361" data-name="Path 1361" d="M29.351,55.243,19.344,45.237,9.2,55.378" transform="translate(14.576 -16.229)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1362" data-name="Path 1362" d="M59.607,46.6A33.579,33.579,0,0,0,12.119,94.09" transform="translate(-1.787 -36.267)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1363" data-name="Path 1363" d="M19.317,87.177a33.58,33.58,0,0,0,0-47.488" transform="translate(38.503 -29.354)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                    <path id="Path_1364" data-name="Path 1364" d="M46.5,61.3A20.146,20.146,0,1,0,26.355,81.45,20.147,20.147,0,0,0,46.5,61.3Z" transform="translate(7.497 -25.886)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="1"/>
                                </svg>


                                <span class="text-dark mt-1 text-center">LOG IN</span>
                            </a>
                        </div>


                    </div>

                </div>
                <div class="row mt-5">

                    <div class="container-fluid section-attributes">

                        <div class="col-12 ">
                            <p style="font-size:18px;color:#000">{{__('Technical specifications')}}</p>
                        </div>
                        @if(count($product_attributes)>0)
                            @foreach($attribute_Groups as $key=>$attribute_Group)
                        <div style="padding-left:0" onclick="open_tab_group(this,{{ $attribute_Group->id }})" class="col-12 margin-0 row product-attribute">

                            <div style="padding-right:0" class="col-12 d-flex d-lg-block justify-content-between align-items-start col-lg-2">

                                <p class="title-product">               {{ app()->getLocale() == 'fa' ? $attribute_Group->name :$attribute_Group->name_en }}</p>
                                <div class=" d-flex d-lg-none ">
                                    <img class="arrow_icon left_icon {{ $key==0 ? 'd-none' : '' }}"
                                         src="{{ asset('home/img/left.png') }}">
                                    <img class="arrow_icon down_icon {{ $key==0 ? '' : 'd-none' }}"
                                         src="{{ asset('home/img/down.png') }}">
                                </div>

                            </div>
                            <div style="padding-left:0" id="attr_group_table_{{ $attribute_Group->id }}" class="col-12 col-lg-10 attr_children {{ $key==0 ? '' : 'd-none' }}">
                                <ul>
                                    @foreach($product_attributes as  $key_2 => $product_attribute)
                                        @if($product_attribute->attribute->group_id==$attribute_Group->id)
                                    <li class="d-flex">
                                        <span class="title-attr">{{ app()->getLocale() == 'fa' ? $product_attribute->attribute->name :  $product_attribute->attribute->name_en}}</span>
                                        <span>       @php
                                                $attribute_values=$product_attribute->attributeValues($product_attribute->value,$product_attribute->attribute_id);
                                            @endphp
                                            @if($attribute_values==null)
                                                {{  $product_attribute->value  }}
                                            @else
                                                {{ app()->getLocale() == 'fa' ? $attribute_values->name : $attribute_values->name_en }}
                                            @endif</span>


                                    </li>



                                        @endif
                                    @endforeach

                                </ul>


                            </div>
                                                                                                                                            <div style="margin-right:auto;top:{{$key==0 ? '10% !important' : ''}}" class=" d-none {{$key==0 ? 'position-arrow' : ''}}  custom-arrow d-lg-flex justify-content-center align-items-center">
                                <img class="arrow_icon left_icon {{ $key==0 ? 'd-none' : '' }}"
                                     src="{{ asset('home/img/left.png') }}">
                                <img class="arrow_icon down_icon {{ $key==0 ? '' : 'd-none' }}"
                                     src="{{ asset('home/img/down.png') }}">
                            </div>


                        </div>


                            @endforeach
                            @endif


                    </div>

                </div>
            </div>
        </section>
        <section class="brand-client section-margin">
            <img class="mb-3" src="{{asset('home/img/description-image.png')}}">

            <div class="container-fluid mt-5">
                <div class="row-custom row">
                    <div class="col-12">

{!! app()->getLocale() == 'fa' ? $product->description : $product->description_en !!}

                    </div>
                </div>
            </div>




        </section>


    </div>


@endsection
