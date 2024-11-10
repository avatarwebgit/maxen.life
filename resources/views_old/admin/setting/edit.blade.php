@extends('admin.layouts.admin')

@section('title')
    Edit Store Info
@endsection

@section('style')
    <style>
        .img-thumbnail {
            max-width: 200px;
            height: auto;
        }

        p {
            padding: 10px;
        }
    </style>
@endsection

@section('script')
    <script>
        // Show File Name
        $('#image').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
        // Show File Name
        $('#special_page_banner').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
        // Show File Name
        $('#newest_page_banner').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">اطلاعات فروشگاه</h5>
            </div>
            <hr>
            <div class="text-center">
                <img class="img-thumbnail" src="{{ asset(env('LOGO_UPLOAD_PATH').$setting->image) }}">
                <p>
                    {{ $setting->name }}
                </p>
            </div>
            @include('admin.sections.errors')
            <form action="{{ route('admin.setting.update',['setting'=>1]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">نام فروشنده</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $setting->name }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">پست الکترونیک</label>
                        <input class="form-control" id="email" name="email" type="email" value="{{ $setting->email }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">آدرس</label>
                        <input class="form-control" id="address" name="address" type="text"
                               value="{{ $setting->address }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">تلفن تماس</label>
                        <input class="form-control" id="tel" name="tel" type="text" value="{{ $setting->tel }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">تلفن تماس 2</label>
                        <input class="form-control" id="tel2" name="tel2" type="text" value="{{ $setting->tel2 }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">تلفن تماس 3</label>
                        <input class="form-control" id="tel3" name="tel3" type="text" value="{{ $setting->tel3 }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">تلفن تماس 4</label>
                        <input class="form-control" id="tel4" name="tel4" type="text" value="{{ $setting->tel4 }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">شماره همراه</label>
                        <input class="form-control" id="cellphone" name="cellphone" type="text"
                               value="{{ $setting->cellphone }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">پشتیبانی واتساپ</label>
                        <input class="form-control" id="whatsapp" name="whatsapp" type="text"
                               value="{{ $setting->whatsapp }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">ساعت کار فروشگاه</label>
                        <input class="form-control" id="workTime" name="workTime" type="text"
                               value="{{ $setting->workTime }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">کد اقتصادی</label>
                        <input class="form-control" id="EconomicCode" name="EconomicCode" type="text"
                               value="{{ $setting->EconomicCode }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">شماره همراه جهت دریافت ثبت سفارش </label>
                        <input class="form-control" id="delivery_order_numbers" name="delivery_order_numbers"
                               type="text" value="{{ $setting->delivery_order_numbers }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">شماره ثبت شرکت </label>
                        <input class="form-control" id="shomare_sabt" name="shomare_sabt" type="text"
                               value="{{ $setting->shomare_sabt }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">کد پستی </label>
                        <input class="form-control" id="postalCode" name="postalCode" type="text"
                               value="{{ $setting->postalCode }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">پیشوند کد کالا </label>
                        <input class="form-control" id="productCode" name="productCode" type="text"
                               value="{{ $setting->productCode }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">پیج اینستاگرام </label>
                        <input class="form-control" id="instagram" name="instagram" type="text"
                               value="{{ $setting->instagram }}">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="name">پیام بالای صفحه</label>
                        <input class="form-control" id="message" name="message" type="text"
                               value="{{ $setting->message }}">
                    </div>
                       <div class="form-group col-md-8">
                        <label for="footer_about">متن فوتر</label>
                        <input class="form-control" id="footer_about" name="footer_about" type="text"
                               value="{{ $setting->footer_about }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="is_active_text_pish_factor">نمایش متن راهنما پیش فاکتور</label>
                        <select class="form-control" id="is_active_text_pish_factor" name="is_active_text_pish_factor">
                            <option {{$setting->is_active_text_pish_factor == 1 ? 'selected' : ''}} value="1" >فعال</option>
                            <option {{$setting->is_active_text_pish_factor == 0 ? 'selected' : ''}} value="0">غیرفعال</option>
                        </select>
                    </div>
                     <div class="form-group col-md-8">
                        <label for="name">متن راهنما</label>
                        <input class="form-control" id="text_pish_factor" name="text_pish_factor" type="text"
                               value="{{ $setting->text_pish_factor }}">
                    </div>
                    
                      <div class="form-group col-md-4">
                        <label for="name">Meta Description </label>
                        <input class="form-control" id="meta_des" name="meta_des" type="text"
                               value="{{ $setting->meta_des }}">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="name">Meta Keyword</label>
                        <input class="form-control" id="meta_key" name="meta_key" type="text"
                               value="{{ $setting->meta_key }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">لوگو شرکت </label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">انتخاب کنید</label>
                            </div>
                        </div>
                        @error('image')
                        <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">بنر صفحه محصولات ویژه</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="special_page_banner" name="special_page_banner">
                                <label class="custom-file-label" for="special_page_banner">انتخاب کنید</label>
                            </div>
                        </div>
                        @error('special_page_banner')
                        <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">بنر صفحه تخفیف ویژه</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="special_discount_banner" name="special_discount_banner">
                                <label class="custom-file-label" for="special_discount_banner">انتخاب کنید</label>
                            </div>
                        </div>
                        @error('special_page_banner')
                        <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">بنر صفحه محصولات جدید</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="newest_page_banner" name="newest_page_banner">
                                <label class="custom-file-label" for="newest_page_banner">انتخاب کنید</label>
                            </div>
                        </div>
                        @error('newest_page_banner')
                        <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">مهر و امضاء فاکتور حقیقی:</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="mohr" name="mohr">
                                <label class="custom-file-label" for="mohr">انتخاب کنید</label>
                            </div>
                        </div>
                        @error('mohr')
                        <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>
                    
                         <div class="form-group col-md-6">
                        <label for="name">مهر و امضاء فاکتور حقوقی:</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="mohr_role" name="mohr_role">
                                <label class="custom-file-label" for="mohr">انتخاب کنید</label>
                            </div>
                        </div>
                        @error('mohr_role')
                        <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
            </form>
        </div>

    </div>

@endsection
