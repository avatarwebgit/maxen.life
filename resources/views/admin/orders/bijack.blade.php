@extends('admin.layouts.admin')

@section('title')
    bijack
@endsection

@section('style')
    <style>


        table {
            width: 100%;
            text-align: center;
            border: 1px solid #CCCCCC;
            border-collapse: collapse;
        }

        .head {
            background-color: #EEEEEE;
        }

        td {
            padding: 2%;
        }

        tr {
            border: 1px solid #CCCCCC;
        }

        .info {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info > div {
            width: 100%;
            height: auto;
            display: inline-block;
        }

        .p20 {
            padding: 20px;
        }

        .mt10 {
            margin-top: 10px;
        }

        .logoImage {
            width: 50%;
            max-width: 150px;
            height: auto;
            max-height: 70%;
        }

        .text-center {
            text-align: center;
        }

        .customerInfo {
            text-align: center;
            background-color: #EEEEEE;
            padding: 2%;
            border: 1px solid #CCCCCC;
        }

        .sellerInfo {
            display: flex;
            justify-content: space-around;
            margin: 10px 0;
        }

        #shopInformation {
            display: flex;
        }

        #shopLogo {
            width: 30%;
            text-align: center;
        }

        #shopInfo {
            border-right: 1px solid #CCCCCC;
            padding: 10px;
            width: 70%;
        }

        #shopInfo > p{
            padding: 3px;
        }

        #shopInfo > div {
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        p {
            margin: 0;
        }

        .line {
            width: 80%;
            height: 1px;
            background-color: black;
            margin: 10px auto;
        }


        #customerInformation{
            width: 100%;
            border: 1px solid #eee;
        }
        #customerInformation > div {
            display: flex;
            justify-content: space-between;
        }
        #customerInformation p{
            padding: 3px;
        }
        .img-thumbnail{
            width: 50px !important;
            height: auto;
        }
        table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        thead { display:table-header-group }
        tfoot { display:table-footer-group }

    </style>

@endsection

@section('script')
    <script>

        $(`#variationDateOnSaleFrom`).MdPersianDateTimePicker({
            targetTextSelector: `#variationInputDateOnSaleFrom`,
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });

    </script>
@endsection

@section('style')
    <style>
        .product-thumbnail {
            width: 150px !important;
            height: auto;
        }
    </style>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="row">
                <div class="col-12 'col-md-6' ">
                    <div class="mb-4 text-center text-md-right">
                        <h5 class="font-weight-bold">بارنامه</h5>
                    </div>
                </div>


            </div>
            <hr>

            <div class="row">
                <div class="col-md-12">



                    <form method="post" action="{{route('admin.bijack.update',['bijack' => $order_bijack->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-3 mb-2">
                                <label>نام تحویل گیرنده:</label>
                                <input name="name" class="form-control" type="text" value="{{ $order_bijack->name }}"
                                >
                                @error('name')
                                <p class="input-error-validation">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label>شماره بارنامه:</label>
                                <input name="barname" class="form-control" type="text" value="{{ $order_bijack->barname }}"
                                >
                                @error('barname')
                                <p class="input-error-validation">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-2 col-md-3">
                                <label> تاریخ : </label>
                                <div class="input-group">
                                    <div class="input-group-prepend order-2">
                                                    <span class="input-group-text" id="variationDateOnSaleFrom">
                                                        <i class="fas fa-clock"></i>
                                                    </span>
                                    </div>

                                    <input type="text" class="form-control" id="variationInputDateOnSaleFrom"
                                           name="date"
                                           value="{{ $order_bijack->date == null ? null : verta($order_bijack->date)->format('Y-m-d') }}">
                                </div>
                                @error('date')
                                <p class="input-error-validation">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label>نام باربری مبداء:</label>
                                <input name="origin" class="form-control" type="text" value="{{ $order_bijack->origin }}"
                                >
                                @error('origin')
                                <p class="input-error-validation">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label>شماره باربری مبداء:</label>
                                <input name="phone_origin" class="form-control" type="text" value="{{ $order_bijack->phone_origin }}"
                                >
                                @error('phone_origin')
                                <p class="input-error-validation">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label>نام باربری مقصد:</label>
                                <input name="destination" class="form-control" type="text" value="{{ $order_bijack->Destination }}"
                                >
                                @error('destination')
                                <p class="input-error-validation">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label>شماره باربری مقصد:</label>
                                <input name="phone_destination"  class="form-control"  type="text" value="{{ $order_bijack->phone_Destination }}"
                                >
                                @error('phone_destination')
                                <p class="input-error-validation">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-12 mb-2">
                                    <button type="submit"
                                            class="btn btn-sm btn-success mt-3">
                                        ثبت
                                    </button>
                                    <a class="btn btn-sm btn-secondery btn-info mt-3" href="{{ route('admin.orders.show', ['order' => $order_bijack->order_id]) }}"> 
                                    بازگشت
                                    </a>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
