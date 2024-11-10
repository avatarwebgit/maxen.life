@extends('home.layouts.index')

@section('title')
    جزئیات تیکت
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/profile_panel.css') }}">

    <style>
        #form {
            display: none;
        }

        .active {
            color: #0B94F7;
        }

        .UserImage {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .CustomBG {
            background-color: #d2ecff !important;
        }

        .float-left {
            float: left !important;
        }
        .file-upload{
                border: 1px solid;
    padding: 20px;
    border-radius: 25px;

        }
    </style>
@endsection

@section('script')
    <script>

        $('#button').click(function () {
            console.log('oko');
            $('#form').slideDown();
        });

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


        function showForm() {
            console.log('ok');
            $('.form').show();
        }
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
                                    <div class="hr"></div>
                                </div>
                                <div class="row">
                                    <form
                                        action="{{ route('home.ticket.store') }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                        class="col-12"
                                    >
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <input disabled class="form-control mb-2 border"
                                                       value="{{ $ticket->title }}" placeholder="عنوان">
                                            </div>
                                            <div class="col-sm-12">
                                                            <textarea disabled
                                                                      class="form-control mb-2 border">{!! $ticket->description !!}</textarea>
                                            </div>
                                            @if($ticket->file!=null)
                                                <div class="col-sm-12 text-right">
                                                    <a class="btn btn-blue btn-danger text-decoration-none text-white"
                                                       target="_blank"
                                                       href="{{ url(env('UPLOAD_FILE_Ticket').$ticket->file) }}">
                                                        فایل ضمیمه
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="col-sm-12">
                                                <div class="hr"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row mt-3">
                                    @foreach($conversation as $item)
                                        <div style="height:145px" class="col-sm-12 mb-3">
                                            <label>{{ $item->user_id=='admin' ? 'پشتیبان سایت:' : $item->User->first_name . ' ' . $item->User->last_name.':' }}
                                                </label>
                                            <label
                                                class="float-left">{{ verta($item->created_at)->format('d - %B - Y') }}</label>

                                            <div style="height:88%"  disabled
                                                      class="form-control mb-2 border {{ $item->user_id=='admin' ? 'CustomBG' : '' }}"
                                                      rows="10"
                                            >{!! $item->description !!}</div>
                                        </div>
                                        @if($item->file!=null)
                                            <div class="col-sm-12 text-right">
                                                <a style="color:#000 !important" class="btn btn-danger text-decoration-none text-white"
                                                   target="_blank"
                                                   href="{{ url(env('UPLOAD_FILE_Ticket').$item->file) }}">
                                                    فایل ضمیمه
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                        @endif
                                        <div class="col-sm-12">
                                            <div class="hr"></div>
                                        </div>
                                    @endforeach
                                    <div class="col-sm-12 mb-3 mt-4">
                                        <button type="button" id="button" class="btn  btn-blue float-left">
                                            پاسخ
                                            <i class="fa fa-reply"></i>
                                        </button>
                                        <a href="{{ route('home.ticket.index') }}"
                                           class="btn  btn-gold text-decoration-none text-white">بازگشت</a>
                                    </div>
                                    <form
                                        id="form"
                                        class="col-12 text-right form"
                                        action="{{ route('home.ticket.replay') }}"
                                        method="post"
                                        enctype="multipart/form-data"
                                    >
                                        @csrf
                                        پاسخ خود را ارسال نمایید:
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                            <textarea name="description" rows="10"
                                                                      class="form-control mb-2 border"></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                                <p>
                                                    افزودن فایل ضمیمه (عکس، Word و PDF):
                                                </p>
                                                <input class="mt-2 file-upload" type="file" name="file">
                                            </div>
                                            <input name="ticket_id" type="hidden" value="{{ $ticket->id }}">
                                            <div class="col-sm-12 mt-2">
                                                <button type="submit" class="btn btn-blue  float-left">
                                                    ارسال
                                                </button>

                                            </div>
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



