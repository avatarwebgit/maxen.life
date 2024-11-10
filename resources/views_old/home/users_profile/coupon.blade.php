@extends('home.layouts.index')

@section('title')
    کد تخفیف
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
        $('div#categories > ul.mobile-menu > li > a').click(function (e) {
            e.preventDefault();
            $(this).next().slideToggle(300).parent().toggleClass("show");
        })
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/profile_panel.css') }}">

    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        td {
            font-size: 10pt;
            padding: 0;
            vertical-align: middle;
        }

        th {
            text-align: center;
        }

        .arrow-icons {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 1000px !important;
                margin: 1.75rem auto;
            }

            .arrow-icons {
                display: none;
            }
        }


        .table-row:nth-child(even) {
            background-color: #f2f2f2 !important;
        }

    </style>
@endsection

@section('content')

    <!--<div class="page-banner-section section bg_image--3">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col">-->

    <!--<div class="page-banner text-center">-->
    <!--    <ul class="page-breadcrumb">-->
    <!--        <li><a href="{{ route('home.index') }}">خانه</a></li>-->
    <!--        <li>پروفایل کاربری</li>-->
    <!--    </ul>-->
    <!--</div>-->

    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->

    <!-- my account wrapper start -->
    <div class="my-account-wrapper">
        <div class="container card">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row text-right" style="direction: rtl;">
                            <div class="col-lg-3 col-md-4">
                                @include('home.sections.profile_sidebar')
                            </div>
                            <!-- My Account Tab Menu End -->
                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <div class="myaccount-content">
                                        @if($user->first_name==null or $user->national_code==null)
                                            @include('home.users_profile.complete_info')
                                        @else
                                            <h3>کد تخفیف </h3>
                                            <div class="arrow-icons">
                                                <i class="fa fa-arrow-right"></i>
                                                <i class="fa fa-arrow-left"></i>
                                            </div>
                                            <div class="myaccount-table  text-center">
                                                @if ($coupons == null)
                                                    <div class="alert alert-danger">
                                                        لیست کد های تخفیف شما خالی می باشد
                                                    </div>
                                                @else
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped">

                                                            <tr>
                                                                <th>کد</th>
                                                                <th>نوع</th>
                                                                <th>مقدار</th>

                                                                <th>دفعات قابل استفاده</th>
                                                                <th>تاریخ ایجاد</th>

                                                                <th>تاریخ انقضا</th>


                                                                <th> وضعیت</th>
                                                            </tr>

                                                            @foreach ($coupons as $coupon)

                                                                <tr class="table-row">
                                                                    <td>{{ $coupon->code }}</td>
                                                                    <td>{{ $coupon->type }}</td>

                                                                    <td>{{ $coupon->type == 'مبلغی' ? $coupon->amount .' تومان' : $coupon->percentage }}</td>
                                                                    <td>{{ $coupon->times }}</td>
                                                                    <td>{{ verta($coupon->created_at)->format('Y-m-d') }}</td>
                                                                    <td>{{ verta($coupon->expired_at)->format('Y-m-d') }}</td>

                                                                    @if($coupon->expired_at < \Carbon\Carbon::now())
                                                                        <td><span
                                                                                class="text-danger">منقضی شده</span>
                                                                        </td>
                                                                    @else
                                                                        <td><span
                                                                                class="text-success">فعال</span>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->

@endsection
