@extends('admin.layouts.admin')

@section('title')
    تنظیمات ( {{ $payment->title }} )
@endsection

@section('script')
    {{--    //ckEditor--}}
    <script src="{{ asset('admin/fullCKEditor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'description' ,{
            language: 'fa',
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'description2' ,{
            language: 'fa',
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">
                    تنظیمات ( {{ $payment->title }} )
                </h5>
            </div>


        </div>

    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="text-center">
                <img class="img-thumbnail" src="">

            </div>
            @include('admin.sections.errors')
            <form action="{{ route('admin.paymentMethods.edit',['payment'=>$payment->id]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                {{--                واریز به حساب--}}
                @if($payment->id==3)
                 <div class="form-group col-md-4">
                        <label for="name">درگاه برای پرداخت</label>
                        <select class="form-control" name="payment">
                            <option {{$payment->method == 4 ? 'selected' : ' '}} value="4">درگاه ملت</option>
                            <option {{$payment->method == 6 ? 'selected' : ' '}} value="6">درگاه پاسارگاد</option>
                        </select>
                    </div>
                    @include('admin.setting.payment.cash')
                @elseif($payment->id==7)
                 <div class="form-group col-md-4">
                        <label for="name">درگاه برای پرداخت</label>
                        <select class="form-control" name="payment">
                            <option {{$payment->method == 4 ? 'selected' : ' '}} value="4">درگاه ملت</option>
                            <option {{$payment->method == 6 ? 'selected' : ' '}} value="6">درگاه پاسارگاد</option>
                        </select>
                    </div>
                    @include('admin.setting.payment.deposit')
                @else
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="name">merchantCode</label>
                            <input class="form-control" id="merchantID" name="merchantID" type="text"
                                   value="{{ $payment->merchantID }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">کد ترمینال</label>
                            <input class="form-control" id="terminalId" name="terminalId" type="text"
                                   value="{{ $payment->terminalId }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">نام کاربری</label>
                            <input class="form-control" id="userName" name="userName" type="text"
                                   value="{{ $payment->userName }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">رمز عبور</label>
                            <input class="form-control" id="userPassword" name="userPassword" type="text"
                                   value="{{ $payment->userPassword }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">نماد</label>
                            <input class="form-control" id="image" name="image" type="file">
                        </div>
                    </div>
                @endif
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="title">عنوان :</label>
                        <input class="form-control" id="title" name="title" value="{{ $payment->title }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="priority">اولویت نمایش</label>
                        <input class="form-control" id="priority" name="priority" type="number" value="{{ $payment->priority }}">
                    </div>
                    <div class="form-group col-12">
                        <label for="short_description">توضیحات کوتاه</label>
                        <textarea class="form-control" id="short_description" name="short_description">{{ $payment->short_description }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="description">توضیحات مندرج در فاکتور</label>
                        <textarea class="form-control" id="description" name="description">{{ $payment->description }}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="description2">توضیحات </label>
                        <textarea class="form-control" id="description2" name="description2">{{ $payment->description2 }}</textarea>
                    </div>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.paymentMethods') }}" class="btn btn-outline-dark mt-5" type="button">بازگشت</a>
            </form>
        </div>
    </div>

@endsection
