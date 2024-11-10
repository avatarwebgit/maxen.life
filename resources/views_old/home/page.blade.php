@extends('home.layouts.index')

@section('title')
    {{ $page->title }}
@endsection


@section('description')

@endsection

@section('keywords')

@endsection

@section('style')
<style>
    @media screen and (max-width:992px){
        .banner-top{
            margin-top: 20px;
        }
    }
</style>
@endsection

@section('script')

@endsection

@section('content')
    <!-- Start of Main -->
    <main class="main">
        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row">
                    @if($page->banner_is_active==1)
                  
                        <div class="col-12 mt-5">
                            <div class="shop-default-banner banner-top banner d-flex align-items-center mb-5 br-xs"
                                 style="background-image: url({{ imageExist(env('BANNER_PAGES_UPLOAD_PATH'),$page->image) }}); background-size: contain;">
                            </div>
                        </div>
                    @endif
                    <div  class="col-12 mt-5">
                        <h2 style="font-size:18px">
                            {!! $page->title !!}
                        </h2>
                        <div style="background-color:#000;height:1px" class="divider"></div>
                    </div>
                    <div class="col-12 justify-content-center">
                        <hr>
                    </div>
                    <div class="col-12">
                        {!! $page->description !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->

@endsection
