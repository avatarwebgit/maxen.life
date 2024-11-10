@extends('home.layouts.index')

@section('title')
    سفارش های من
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

        function SubmitForm(id) {
            $('#payment-form-' + id).submit();
        }

        $('#mobile_menu_nav').click(function () {
            $('#icon-panel').toggleClass('negative');
            $('#icon-panel').toggleClass('positive');
            $('.negative').html('-');
            $('.positive').html('+');
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
                                <div
                                    class="alert alert-info text-center d-flex justify-content-center align-items-center mb-3">
                                    <i class="fa fa-info-circle mr-3"></i>
                                    <span>برای ارسال تصویر پیش فاکتور وارد جزئیات سفارش مربوط شوید</span>
                                    <i class="fa fa-info-circle ml-3"></i>
                                </div>
                                <h3>سفارش های من</h3>
                                <div class="arrow-icons">
                                    <i class="fa fa-arrow-right"></i>
                                    <i class="fa fa-arrow-left"></i>
                                </div>
                                <div class="myaccount-table  text-center">
                                    @if ($orders->isEmpty())
                                        <div class="alert alert-danger">
                                            لیست سفارش های شما خالی است
                                        </div>
                                    @else
                                        <div style="overflow-y:auto !important;transform:rotate(180deg)"
                                             class="table-responsive">
                                            <table style="transform:rotate(180deg)"
                                                   class="table table-bordered table-striped">

                                                <tr>
                                                    <th> شماره سفارش</th>
                                                    <th> تاریخ</th>
                                                    <th>نوع</th>
                                                    <th>وضعیت سفارش</th>
                                                    <th>وضعیت پرداخت</th>
                                                    <th> مبلغ واریزی</th>
                                                    <th> جزئیات</th>
                                                </tr>

                                                @foreach ($orders as $order)
                                                    <tr class="table-row">
                                                        <td>{{ $setting->productCode.'-'.$order->order_number }}</td>
                                                        <td> {{ verta($order->created_at)->format('%d %B %Y') }}</td>
                                                        <td>{{ $order->paymentMethod->title }}</td>
                                                        <td>{{ $order->DeliveryMethodStatus->title }}</td>
                                                        <td>{{ $order->payment_status }}</td>
                                                        <td>
                                                            @if($order->payment_type == 3)

                                                                @if($order->DeliveryMethodStatus->id == 2 or $order->DeliveryMethodStatus->id == 4)

                                                                    {{ number_format($order->paying_amount) }}

                                                                    تومان
                                                                @else
                                                                    0
                                                                @endif
                                                            @else
                                                                {{ number_format($order->paying_amount) }}
                                                                تومان
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a title="مشاهده"
                                                               class="btn btn-sm btn-success mb-1"
                                                               href="{{ route('home.orders.users_profile.show', ['order' => $order->id]) }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a title="پرینت" target="_blank"
                                                               class="btn btn-sm btn-dark mb-1"
                                                               href="{{ route('home.orders.users_profile.print', ['order' => $order->id]) }}">
                                                                <i class="fa fa-print"></i>
                                                            </a>
                                                            @if($order->bijack)
                                                                <a title="بیجک" target="_blank"
                                                                   class="btn btn-rounded btn-blue mb-1"
                                                                   href="{{ route('home.orders.user_bijack', ['order' => $order->id]) }}">
                                                                    بارنامه
                                                                </a>
                                                            @endif

                                                            @if($order->DeliveryMethodStatus->id==1 and $order->payment_type == 3)
                                                                @php
                                                                    $payment = \App\Models\PaymentMethods::where('id' , $order->payment_type)->first();

                                                                @endphp
                                                                <a onclick="SubmitForm({{$order->id}})"
                                                                   title="پرداخت انلاین" target="_blank"
                                                                   class="btn btn-rounded btn-blue mb-1"
                                                                >
                                                                    پرداخت آنلاین
                                                                </a>

                                                                <form style="display: none"
                                                                      id="payment-form-{{$order->id}}"
                                                                      action="{{ route('home.payment') }}"
                                                                      method="POST">
                                                                    @csrf

                                                                    <input type="hidden" id="address-input"
                                                                           name="address_id"
                                                                           value="{{ $order->address->id }}">
                                                                    <input type="hidden" name="order_id"
                                                                           value="{{$order->id}}">
                                                                    <input type="hidden" name="payment_method"
                                                                           value="{{$payment->method}}">
                                                                </form>
                                                            @endif


                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
