@extends('home.layouts.index')

@section('title')
    صفحه ای پروفایل
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/profile_panel.css') }}">

@endsection

@section('script')
    <script>
        // Show File Name
        $('#profile_image').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
        $('.mobile-menu-toggle').click(function(){
        $('.loaded').addClass('mmenu-active');
    })
    $('.mobile-menu-close').click(function(){
        $('.loaded').removeClass('mmenu-active');
    })
       $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
   $('div#categories > ul.mobile-menu > li > a > span.toggle-btn').click(function(e){
        e.preventDefault();
          $(this).parent().next().slideToggle(300).parent().toggleClass("show");})


                $('#mobile_menu_nav').click(function(){
            $('#icon-panel').toggleClass('negative');
             $('#icon-panel').toggleClass('positive');
            $('.negative').html('-');
             $('.positive').html('+');
        })
    </script>
@endsection

@section('content')


    <div class="my-account-wrapper main">
        <div class="container card">
            <div class="row card-body">
                <div class="col-lg-3 col-md-4">
                    @include('home.sections.profile_sidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    @include('home.sections.errors')
                    <div class="tab-content" id="myaccountContent">
                        <div class="myaccount-content">
                            @if($user->first_name==null or $user->national_code==null)
                                @include('home.users_profile.complete_info')
                            @else
                                <div class="alert alert-info text-center">
                                    نظر کلی خود را در مورد عملکرد تیم افراسنتر وارد نمایید.این نظر در صفحه اصلی سایت نمایش داده خواهد شد
                                </div>
                                <div class="account-details-form">
                                    <form action="{{ route('home.comment_index.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-lg-4">
                                                <div class="single-input-item">
                                                    <label for="first-name" class="required">
                                                        عنوان
                                                    </label>
                                                    <input name="title"  value="{{ old('title') }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="single-input-item">
                                                    <label for="first-name" class="required my-1">
                                                        توضیحات
                                                    </label>
                                                    <textarea class="form-control" name="description"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="single-input-item">
                                            <button type="submit" class="ht-btn black-btn mt-3"> ثبت </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
