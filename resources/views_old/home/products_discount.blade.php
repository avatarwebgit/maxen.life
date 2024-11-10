@extends('home.layouts.index')

@section('title')
تخفیف ویژه
@endsection

@section('description')

@endsection

@section('keywords')

@endsection

@section('style')
    <style>
    .map-link {
    font-size: 12px;
    font-weight: bold;
    color: #000000;
}
         .product{
            animation: loadproduct .6s linear 1;

        }
        @keyframes loadproduct {
        from{
            transform: scale(0);
        }
            to{
                transform: scale(1);
            }
        }
           .shop-default-banner{
        margin-top: 20px !important;    height: 270px!important;
    }
    
    
    @media screen and (max-width:800px){
         .shop-default-banner{
            height: 174px!important;
    }
             .shop-default-banner img{
            height: 193px!important;
    }
    }
        #load-more {
            display: none;
            width: 80px;
            height: 80px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid orange;
            border-right:  6px solid transparent;
            animation: load-more 1.5s linear infinite;
        }
        .load-more-parent{
            width: 100%;
            display: none;

            text-align: center;
        ;
        }
        @keyframes load-more {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section('script')
    <script>
        var total={{ $products->lastPage() }};

        var current_page=1;
        $(window).scroll(function() {

            if($(window).scrollTop()  >= $('#load-more').offset().top - 100) {


                current_page++;
                loadMoreData(current_page);
            }
        });
        function loadMoreData(current_page) {

            if(current_page > total){

                // $('.load-more-parent').show() ;
            }else {
                console.log(current_page)
                console.log(total)

                $.ajax(
                    {
                        url: "{{ route('home.products.discount') }}",
                        type: "get",
                        data: {
                            page: current_page,
                        },
                        beforeSend:function (){
                            $('#load-more').show();
                            $('.load-more-parent').hide();
                        },
                        success: function (data) {

                            setTimeout(function (){
                                if (data[1] == "") {
                                    $('.load-more-parent').show();
                                    $('#load-more').hide();
                                } else {
                                    $("#post-data").append(data[1]);
                                    if(current_page == total){
                                        $('.load-more-parent').show() ;
                                        $('#load-more').hide();
                                    }
                                }
                                $('#load-more').hide();
                            },1000)
                        }
                    })


            }
        }
    </script>
@endsection

@section('content')
    <main class="main">
        <!-- Start of Page Content -->
        <div class="page-content mb-10">
            <div class="container">
                <!-- Start of Shop Banner -->
                   @php
                $setting = \App\Models\Setting::first();
                @endphp
               <div class="shop-default-banner banner d-flex align-items-center mb-5 br-xs"
                     style="margin-top: 20px;    height: 270px;">

                    <img  src="{{ imageExist(env('BANNER_PAGES_UPLOAD_PATH'),$setting->special_discount_banner) }}">

                </div>
                
                       <div class="map-link-back mb-5">

                    <a class="map-link" href="{{route('home.index')}}">صفحه اصلی</a>


                    <img class="map-link-img" src="{{asset('home/images/arrow_rtl.png')}}"> <a class="map-link" >تخفیف ویژه</a>
                </div>
                <!-- End of Shop Banner -->
                <div class="shop-content">
                    <!-- Start of Shop Main Content -->
                    <div class="main-content">
                        <div id="post-data" class="product-wrapper row">


                                    @include('home.sections.product_box',['col' =>'col-lg-3 col-md-6'])


                        </div>
                        <div class="text-center d-flex justify-content-center mt-3 mb-3  pt--20">
                            <div id="load-more" style="cursor: pointer" class="axil-btn btn-bg-lighter btn-load-more"></div>
                        </div>
                        <div class="text-center  pt--20 mt-3 mb-3 load-more-parent">
                            محصول دیگری وجود ندارد
                        </div>

                    </div>
                    <!-- End of Shop Main Content -->
                </div>
                <!-- End of Shop Content -->

            </div>
        </div>
        <!-- End of Page Content -->
    </main>
@endsection
