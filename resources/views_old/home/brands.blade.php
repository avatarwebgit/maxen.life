@extends('home.layouts.index')

@section('title')
برندهای تجاری
@endsection

@section('description')

@endsection

@section('keywords')

@endsection

@section('style')

@endsection

@section('script')

@endsection

@section('content')
    <main class="main">
        <!-- Start of Page Content -->
        <div class="page-content mb-10">
            <div class="container">
                <div class="shop-content">
                    <!-- Start of Shop Main Content -->
                    <div class="main-content">
                        <div class="product-wrapper row cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                            @foreach($brands as $brand)
                                <div class="col-lg-3 mt-4">
                                    <div class="product product-list flex-column br-xs mb-0 justify-content-center">
                                        <figure style="margin-left: 0px !important;" class="product-media">
                                            <a href="{{ route('home.products.brand',['brand'=>$brand->alias]) }}">
                                                <img src="{{ imageExist(env('BRAND_UPLOAD_PATH'),$brand->image) }}" alt="Product"
                                                     width="315"
                                                     height="355">
                                            </a>
                                        </figure>
                                           <a href="{{ route('home.products.brand',['brand'=>$brand->alias]) }}" style="font-size:18px" >{{$brand->name}}</a>
                                    </div>
                                 
                                </div>
                            @endforeach
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
