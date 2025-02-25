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
                                                    
                <h1>اطلاعات فروشگاه  </h1>
                   <hr>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">نام فروشنده</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $setting->name }}">
                    </div>





                    <div class="form-group col-md-4">
                        <label for="name">کد اقتصادی</label>
                        <input class="form-control" id="EconomicCode" name="EconomicCode" type="text"
                               value="{{ $setting->EconomicCode }}">
                    </div>
                    <!--<div class="form-group col-md-4">-->
                    <!--    <label for="name">شماره همراه جهت دریافت ثبت سفارش </label>-->
                    <!--    <input class="form-control" id="delivery_order_numbers" name="delivery_order_numbers"-->
                    <!--           type="text" value="{{ $setting->delivery_order_numbers }}">-->
                    <!--</div>-->
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
                    <!--<div class="form-group col-md-4">-->
                    <!--    <label for="name">پیشوند کد کالا </label>-->
                    <!--    <input class="form-control" id="productCode" name="productCode" type="text"-->
                    <!--           value="{{ $setting->productCode }}">-->
                    <!--</div>-->
                   
     


                    <!--<div class="form-group col-md-8">-->
                    <!--    <label for="footer_about">متن فوتر</label>-->
                    <!--    <input class="form-control" id="footer_about" name="footer_about" type="text"-->
                    <!--           value="{{ $setting->footer_about }}">-->
                    <!--</div>-->



                    
                    

                </div>

                             <hr>
                <h1> اطلاعات نمایشی سایت </h1>
                
                <div class="form-row">
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
                        <label for="name"> favicon </label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="favicon">
                                <label class="custom-file-label" for="image">انتخاب کنید</label>
                            </div>
                        </div>
                        @error('image')
                        <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>
                                   <div class="form-group col-md-4">
                        <label for="name">لینکه آیکون  info  صفحه اصلی   </label>
                        <input class="form-control" id="info_link" name="info_link" type="text"
                               value="{{ $setting->info_link }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">لینکه آیکون  سوال  صفحه اصلی   </label>
                        <input class="form-control" id="question_link" name="question_link" type="text"
                               value="{{ $setting->question_link }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">لینکه آیکون  لاگین  صفحه اصلی   </label>
                        <input class="form-control" id="info_link" name="login_link" type="text"
                               value="{{ $setting->login_link }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">لینکه آیکون  ساپورت  صفحه اصلی   </label>
                        <input class="form-control" id="question_link" name="support_link" type="text"
                               value="{{ $setting->support_link }}">
                    </div>
                    
                    

 
                <div class="form-group col-md-4">
                    <label for="name">پیج اینستاگرام </label>
                    <input class="form-control" id="instagram" name="instagram" type="text"
                           value="{{ $setting->instagram }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="aparat">آپارات  </label>
                    <input class="form-control" id="aparat" name="aparat" type="text"
                           value="{{ $setting->aparat }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="name">یوتیوب</label>
                    <input class="form-control" id="youtube" name="youtube" type="text"
                           value="{{ $setting->youtube }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="name"> لینکدین </label>
                    <input class="form-control" id="linkedin" name="linkedin" type="text"
                           value="{{ $setting->linkedin }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="name">توئیتر  </label>
                    <input class="form-control" id="twitter" name="twitter" type="text"
                           value="{{ $setting->twitter }}">
                </div>

                                                              <div class="form-group col-md-6">
                        <label for="name">Meta Description </label>
                        <input class="form-control" id="meta_des" name="meta_des" type="text"
                               value="{{ $setting->meta_des }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Meta Keyword</label>
                        <input class="form-control" id="meta_key" name="meta_key" type="text"
                               value="{{ $setting->meta_key }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">زبان پیش فرض سایت  </label>

                        <select name="base_lang" class="form-control">
                            <option {{$setting->base_lang == 'en' ? 'selected' : ''}} value="en">انگلیسی</option>
                            <option {{$setting->base_lang == 'en' ? 'selected' : ''}} value="fa">فارسی</option>
                        </select>


                    </div>

                </div>
                


                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
            </form>
        </div>

    </div>

@endsection
