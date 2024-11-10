@extends('home.layouts.index')

@section('title')
    {{ $article->title }}
@endsection
@section('style')
    <style>
        .page-content {
            background: white !important;
        }

        .py-50 {
            padding: 50px 0 !important;
        }

    </style>
@endsection

@section('script')

@endsection
@section('description')
    {{ $article->meta_des }}
@endsection

@section('keywords')
    {{ $article->meta_keyword }}
@endsection
@section('content')

    <!-- Start of Main -->
    <main class="main">
        <!-- Start of Page Header -->

        <!-- End of Page Header -->

        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container card-body py-50">
                <div class="col-12 mt-5">
                    <h2 style="font-size:18px">
                        {{$article->title}}
                    </h2>
                    <div style="background-color:#000;height:1px" class="divider"></div>
                </div>
                <div class="row gutter-lg mb-10">
                    <div class="col-12">
                        <article class="post post-classic overlay-zoom mb-4">
                            <div class="post-details">
                                <div class="post-content">
                                    <p>
                                        {{ $article->shortDescription }}
                                    </p>
                                </div>
                            </div>

                            {!! $article->description !!}
                        </article>
                    </div>
                    <!-- End Post Navigation -->
                </div>
            </div>
            @if(count($article->ProductCategories)>0)
                <div class="container">
                    <!--<h2 class="title justify-content-center ls-normal mb-4 mt-10 pt-1 appear-animate">بخش های محبوب-->
                    <!--</h2>-->
                    <div class="tab tab-nav-boxed tab-nav-outline appear-animate">
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            @foreach($article->ProductCategories as $key=>$category)
                                <li class="nav-item mr-2 mb-2">
                                    <a class="nav-link {{ $key==0 ? 'active' : '' }} br-sm font-size-md ls-normal"
                                       href="#tab1-{{ $category->id }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- End of Tab -->
                    <div class="tab-content product-wrapper appear-animate">
                        @foreach($article->ProductCategories as $key=>$category)
                            <!-- End of Tab Pane -->
                            <div class="tab-pane {{ $key==0 ? 'active' : '' }} pt-4" id="tab1-{{ $category->id }}">
                                <div class="product-wrap row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                                    @php
                                        $products=$category->Products()->where('price','>',0)->where('quantity','>',0)->inRandomOrder()->take(10)->get();
                                    @endphp
                                    @include('home.sections.product_box')
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- End of Tab Content -->
                </div>
            @endif
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->

@endsection
