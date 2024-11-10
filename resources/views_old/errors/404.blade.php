
@extends('home.layouts.index')

@section('title')
    EROR 404 | این صفحه یافت نشد
@endsection

@section('description')

@endsection

@section('keywords')

@endsection


@section('content')
    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg_image--3">
        <div class="container">
            <div class="row">
                <div class="col">
{{--
                    <div class="page-banner text-center">
                        <h2>404</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="{{ route('home.index') }}">خانه</a></li>
                            <li>404</li>
                        </ul>
                    </div>
--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!-- 404 Error Section Start -->
    <div class="404-error-section section sb-border pt-65 pt-lg-45 pt-md-45 pt-sm-40 pt-xs-35 pb-100 pb-lg-80 pb-md-70 pb-sm-40 pb-xs-35">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-wrapper text-center">
                        <div class="error-text" style="padding: 10% 0px;">
                            <h1>404</h1>
                            <h2 style="font-size: 16px;">صفحه مورد نظر شما وجود ندارد یا حذف شده است!</h2>
                            <p></p>
                        </div>
                        <div class="error-button">
                            <a style="font-weight: bold; font-family: ShFont;" href="{{ route('home.index') }}">بازگشت به صفحه اصلی</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 404 Error Section End -->
@endsection
