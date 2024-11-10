@extends('home.layouts.index')

@section('title')
جستجو در پروفیل سازه
@endsection

@section('description')

@endsection

@section('keywords')

@endsection

@section('style')
<style>
    .page-search-title{
        border-bottom:1px solid #000;
        margin-top:28px;
        padding-bottom:20px;
        font-size:20px;
    }
</style>
@endsection

@section('script')

@endsection

@section('content')
    <main class="main">
        <!-- Start of Page Content -->
        <div class="page-content mb-10">
            <div class="container">
                <!-- Start of Shop Banner -->
                <!--<div class="shop-default-banner banner d-flex align-items-center mb-5 br-xs">-->
                    <!--@if($category_id!=0)-->
                    <!--    <div class="alert alert-info text-center w-100">-->
                    <!--        نتیجه جست و جوی <span class="font-weight-bolder">{{ $title }}</span> در برند <span class="font-weight-bolder">{{ $category_name }}</span>-->
                    <!--    </div>-->
                    <!--@else-->
                    <!--    <div class="alert alert-info text-center w-100">-->
                    <!--        نتیجه جست و جوی <span class="font-weight-bolder">{{ $title }}</span> در <span class="font-weight-bolder">همه برند ها</span>-->
                    <!--    </div>-->
                    <!--@endif-->







                <!--</div>-->
                 <h3 class="page-search-title"> نتیجه جستجو "{{$title}}" </h3>
                <!-- End of Shop Banner -->
                <div class="shop-content">
                    <!-- Start of Shop Main Content -->
                    <div class="main-content">
                        <div class="product-wrapper row">


                                    @include('home.sections.product_box',['col' => 'col-lg-3 col-md-6'])


                        </div>

                        <div class="toolbox toolbox-pagination d-flex justify-content-between">
                            <!--@if($products_count!=0)-->

                            <!--@else-->
                            <!--    <p class="showing-info mb-2 mb-sm-0">-->
                            <!--        نمایش <span>0 از {{ $products_count }}</span>محصولات-->
                            <!--    </p>-->
                            <!--@endif-->

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
