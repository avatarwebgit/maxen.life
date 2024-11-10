@extends('home.layouts.index')

@section('title')
    کیف پول

@endsection

@section('script')
    <script>
        function showDetail(order_id) {
            let modal = $('#ordersDetails-' + order_id);
            modal.modal('show');
        }

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
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/profile_panel.css') }}">

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none !important;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield !important;
        }

        .img-thumbnail {
            width: 40px !important;
            height: auto !important;
            margin-right: 10px;
        }

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

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 1000px !important;
                margin: 1.75rem auto;
            }
        }

        @media (max-width: 800px) {
            .table-md {
                width: 800px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="my-account-wrapper main">
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

                                        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
                                            <div class="row">
                                                <div class="col-12 mb-5">
                                                    <p style="font-weight:bold;">موجودی کیف
                                                        پول: {{ number_format($wallet->amount) }}
                                                        تومان</p>
                                                </div>
                                                <div class="col-12">
                                                    <form method="post"
                                                          action="{{ route('home.payment.charge_wallet') }}">
                                                        @csrf
                                                        <div class="position-relative text-right mb-4">
                                                            <label class="d-block text-right">
                                                                مبلغ (تومان)
                                                                <input
                                                                    onkeypress="return isNumberKey(event)"
                                                                    type="number"
                                                                    min="1000"
                                                                    step="500"
                                                                    name="amount"
                                                                    class="form-control form-control-sm mt-2"
                                                                    placeholder="مقدار دلخواه خود را وارد نمایید">
                                                            </label>
                                                            <div class="d-flex align-center justify-content-start mt-4">
                                                                @foreach($PaymentMethods as $item)
                                                                    @if($item->id != 7)

                                                                        <input id="{{ $item->name }}"
                                                                               class="input-radio mr-2 ml-2"
                                                                               type="radio"
                                                                               value="{{ $item->name }}"
                                                                               checked="checked"
                                                                               name="payment_method">
                                                                        @if(file_exists(public_path(env('LOGO_UPLOAD_PATH').$item->image))
                         and !is_dir(public_path(env('LOGO_UPLOAD_PATH').$item->image)))
                                                                            <img class="img-thumbnail"
                                                                                 src="{{ asset(env('LOGO_UPLOAD_PATH').$item->image) }}">
                                                                        @else
                                                                            <img class="img-thumbnail"
                                                                                 src="{{ asset('admin/images/no_image.jpg') }}">
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <div class="input-button">
                                                                <button style="background-color:#5c8097;color:#fff"
                                                                        type="submit"
                                                                        class="btn btn-blue mt-3 btn-primary">افزایش
                                                                    اعتبار
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-md text-center">

                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>مبلغ (تومان)</th>
                                                        <th>تغییرات (تومان)</th>
                                                        <th>نوع</th>
                                                        <th>تاریخ</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($wallet_history as $key => $item)
                                                        <tr>
                                                            <th>
                                                                {{ $wallet_history->firstItem() + $key }}
                                                            </th>
                                                            <th>
                                                                {{ number_format($item->previous_amount) }}
                                                            </th>
                                                            <th class="d-flex justify-content-center">
                                <span style="width: 200px;display: block">
                                    {{ number_format($item->amount) }}
                                </span>
                                                                @if($item->increase_type==1)
                                                                    <i class="text-success fa fa-arrow-up"></i>
                                                                @else
                                                                    <i class="text-danger fa fa-arrow-down"></i>
                                                                @endif
                                                            </th>
                                                            <th>
                                                                {{ $item->Type->description }}
                                                            </th>
                                                            <th>
                                                                {{ verta($item->created_at)->format('Y-m-d H:i') }}
                                                            </th>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="d-flex justify-content-center mt-5">
                                                {{ $wallet_history->render() }}
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
