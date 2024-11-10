@extends('home.layouts.index')

@section('title')
    درخواست پشتیبانی
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

        li {
            list-style: none !important;
        }

        #myaccountContent {
            margin-top: 0 !important;
            text-align: right !important;
        }

        .float-right {
            float: right !important;
        }


        .show {
            display: block;
        }

        table {
            font-size: 14px;
        }

        @media screen and (max-width: 800px) {
            table {
                width: 750px;
            }
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
                                <h3>درخواست پشتیبانی</h3>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="{{ route('home.ticket.create') }}"
                                           class="btn  btn-sm btn-blue text-decoration-none text-white">ثبت تیکت
                                            جدید</a>
                                    </div>
                                </div>
                                @if(count($tickets)>0)
                                    <div class="row">
                                        <div class="col-12">
                                            <div style="overflow-y:auto !important" class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th class="text-center">ردیف</th>
                                                        <th class="text-center">عنوان</th>
                                                        <th class="text-center">وضعیت</th>
                                                        <th class="text-center">مشاهده</th>
                                                        <!--<th class="text-center">پاسخ</th>-->
                                                        <th class="text-center">شماره تیکت</th>
                                                        <th class="text-center">تاریخ</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($tickets as $key=>$ticket)
                                                        <tr>
                                                            <td class="text-center">{{ $tickets->firstItem()+$key }}</td>
                                                            <td class="text-center">{{ $ticket->title }}</td>
                                                            <td class="text-center">{{ $ticket->Status->title }}</td>
                                                            <td class="text-center">
                                                                <a style="border:none;background-color:#5c8097"
                                                                   href="{{ route('home.ticket.show',['ticket'=>$ticket->id]) }}"
                                                                   class="btn btn-sm btn-info text-white">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            </td>
                                                            <!--<td class="text-center">-->
                                                            <!--    @if($ticket->status_id==3 )-->
                                                            <!--        <a href="{{ route('home.ticket.show',['ticket'=>$ticket->id]) }}"-->
                                                            <!--           class="btn btn-sm btn-danger text-white">-->
                                                            <!--            <i class="fa fa-envelope"></i>-->
                                                            <!--        </a>-->
                                                            <!--    @else-->
                                                            <!--        --->
                                                            <!--    @endif-->
                                                            <!--</td>-->
                                                            <td class="text-center">
                                                                {{ $ticket->id }}
                                                            </td>
                                                            <td class="text-center">{{ verta($ticket->created_at)->format('d - %B - Y') }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row justify-content-center">
                                                {{ $tickets->render() }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-info text-center">
                                                تا کنون تیکتی ارسال نکرده اید
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
