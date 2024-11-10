@extends('home.layouts.index')

@section('title')
    مجله پروفیل سازه
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
    <!-- Start of Main -->
    <main class="main">
        <!-- Start of Page Header -->
  
        <!-- End of Page Header -->

        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                                          <div  class="col-12 mt-5">
                        <h2 style="font-size:18px">
                           مجله پروفیل سازه
                        </h2>
                        <div style="background-color:#000;height:1px" class="divider"></div>
                    </div>
                <div class="row cols-lg-3 cols-md-2 mb-2">
                    @foreach($articles as $article)
                    <div class="grid-item fashion mt-3">
                        <article class="post post-mask overlay-zoom br-sm">
                            <figure class="post-media">
                                <a href="{{ route('home.article',['alias'=>$article->alias]) }}">
                                    <img src="{{ imageExist(env('ARTICLES_IMAGES_THUMBNAIL_UPLOAD_PATH'),$article->image)}}" width="600"
                                         height="420" alt="blog">
                                </a>
                            </figure>
                            <div class="post-details">
                                <div class="post-details-visible">
                                    <h4 class="post-title text-white">
                                        <a href="{{ route('home.article',['alias'=>$article->alias]) }}">{{ $article->title }}</a>
                                    </h4>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                {{ $articles->render() }}
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->
@endsection
