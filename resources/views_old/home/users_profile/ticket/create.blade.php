@extends('home.layouts.index')

@section('title')
    ثبت تیکت
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/profile_panel.css') }}">

    <style>
        .active {
            color: #0B94F7;
        }

        .UserImage {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .ht-btn {
            background-color: rebeccapurple;
            color: white !important;
        }
    </style>
@endsection
@section('script')
    <script>
        $('.mobile-menu-toggle').click(function () {
            $('.loaded').addClass('mmenu-active');
        })
        $('.mobile-menu-close').click(function () {
            $('.loaded').removeClass('mmenu-active');
        })
        $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
        $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
        $('div#categories > ul.mobile-menu > li > a > span.toggle-btn').click(function (e) {
            e.preventDefault();
            $(this).parent().next().slideToggle(300).parent().toggleClass("show");
        })

        $('#mobile_menu_nav').click(function () {
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
                    <div class="tab-content" id="myaccountContent">
                        <div class="myaccount-content">
                            @if($user->first_name==null or $user->national_code==null)
                                @include('home.users_profile.complete_info')
                            @else
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 mb-1 p-4 bg-white">
                                        @include('admin.sections.errors')
                                        <div class="row">
                                            <form
                                                action="{{ route('home.ticket.store') }}"
                                                method="POST"
                                                enctype="multipart/form-data"
                                            >
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label class="text-right">عنوان</label>
                                                        <input style="border: 1px solid #a39c9c;" class="form-control"
                                                               type="text" name="title" id="title"
                                                               value="{{ old('title') }}">
                                                        <span class="focus-border"></span>
                                                    </div>

                                                    <div class="form-group col-sm-12">
                                                        <label class="text-right">توضیحات</label>
                                                        <textarea style="border: 1px solid #a39c9c;"
                                                                  class="form-control" rows="5" type="text"
                                                                  id="description"
                                                                  name="description">{{ old('description') }}</textarea>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                    <div class="col-sm-12 mt-3">
                                                        <div class="input-group mb-3">
                                                            <div class="custom-file">
                                                                <label class="custom-file-label" for="file">افزودن فایل
                                                                    ضمیمه (عکس، Word و PDF):</label>
                                                                <input type="file"
                                                                       class="form-control custom-file-input"
                                                                       name="file" id="file">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <button type="submit" class="btn btn-blue
                                                        ">ارسال
                                                        </button>
                                                        <a href="{{ route('home.ticket.index') }}" class="btn btn-gold">
                                                            بازگشت
                                                        </a>
                                                    </div>

                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




