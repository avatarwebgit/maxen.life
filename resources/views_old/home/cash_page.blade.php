@extends('home.layouts.index')

@section('title')
    ثبت اطلاعات پرداخت
@endsection


@section('description')

@endsection

@section('keywords')

@endsection

@section('style')
    <style>
        .error_input_validate {
            font-size: 9pt;
            color: red;
        }


        input[type=file]::file-selector-button {
            margin-top: 10px;
        }
    </style>
@endsection

@section('script')

@endsection

@section('content')
    <!-- Start of Main -->
    <main class="main" style="background-color: white;padding: 20px 10px">
        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-12 justify-content-center">
                        <hr>
                    </div>
                    <div class="col-12">
                        {!! $payment->description2 !!}
                    </div>
                    <div class="col-12 mt-5">
                        <form class="row" action="{{ route('home.cash_2_submit',['order'=>$order->id]) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-12 col-md-3">
                                <label for="payment_code">شماره پیگیری</label>
                                <input class="form-control" id="payment_code" name="payment_code">
                                @error('payment_code')
                                <p class="error_input_validate">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="card_number_4digits">چهار رقم آخر کارت بانکی</label>
                                <input class="form-control" id="card_number_4digits" name="card_number_4digits">
                                @error('card_number_4digits')
                                <p class="error_input_validate">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="payment_time">ساعت پرداخت</label>
                                <input class="form-control" id="payment_time" name="payment_time"
                                       placeholder="مثال: 14:55">
                                @error('payment_time')
                                <p class="error_input_validate">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="payment_date">تاریخ پرداخت</label>
                                <input class="form-control" id="payment_date" name="payment_date"
                                       placeholder="مثال: 16 فروردین 1403">
                                @error('payment_date')
                                <p class="error_input_validate">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="payment_file">رسید پرداختی</label>
                                <input type="file" class="form-control" id="payment_file" name="payment_file">
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-blue  btn-rounded">ثبت اطلاعات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->

@endsection
