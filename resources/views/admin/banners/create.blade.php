@extends('admin.layouts.admin')

@section('title')
    create Banner
@endsection

@section('script')
<script>
    // Show File Name
    $('#banner_image').change(function() {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
    // Show File Name
    $('#thumbnail').change(function() {
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
                <h5 class="font-weight-bold">ایجاد بنر</h5>
            </div>
            <hr>
                    <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
  <div class="col-12 d-flex justify-content-between align-items-center">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="fa-tab" data-toggle="tab" data-target="#fa" type="button" role="tab" aria-controls="fa" aria-selected="true">فارسی</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="en-tab" data-toggle="tab" data-target="#en" type="button" role="tab" aria-controls="en" aria-selected="false">انگلیسی</button>
  </li>

</ul>

      
                </div>
                
                
            @include('admin.sections.errors')
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group col-12">
                         <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="fa" role="tabpanel" aria-labelledby="fa-tab">
      <div class="form-row">
                  <div class="form-group col-md-6">
                        <label for="title">عنوان</label>
                        <input class="form-control" id="title" name="title" type="text" value="{{ old('title') }}">
                    </div>
                             <div class="form-group col-md-6">
                        <label for="button_link">متن دکمه<span class="mr-3" style="font-size: 9pt;color: red">(در صورتی که متن دکمه را وارد نکنید لینک دکمه فعال نمیگردد)</span></label>
                        <input class="form-control" id="button_text" name="button_text" type="text" value="{{ old('button_text') }}">
                    </div>
                           <div class="form-group col-12">
                        <label for="text">متن</label>
                        <textarea class="form-control" id="text" name="text" type="text">{{ old('text') }}</textarea>
                    </div>
                    </div>
                    
      </div>
      
        <div class="tab-pane fade " id="en" role="tabpanel" aria-labelledby="en-tab">
            <div class="form-row">
                  <div class="form-group col-md-6">
                        <label for="title">عنوان انگلیسی</label>
                        <input class="form-control" id="title" name="title_en" type="text" value="{{ old('title_en') }}">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="button_link"> متن دکمه انگلیسی<span class="mr-3" style="font-size: 9pt;color: red">(در صورتی که متن دکمه را وارد نکنید لینک دکمه فعال نمیگردد)</span></label>
                        <input class="form-control" id="button_text_en" name="button_text_en" type="text" value="{{ old('button_text_en') }}">
                    </div>
                           <div class="form-group col-12">
                        <label for="text">متن</label>
                        <textarea class="form-control" id="text" name="text_en" type="text">{{ old('text_en') }}</textarea>
                    </div>
                    </div>
      </div>
      
      </div>
                    </div>
                                                                   
                    <div class="form-group col-md-6">
                        <label for="primary_image">انتخاب تصویر</label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="banner_image">
                            <label class="custom-file-label" for="banner_image"> انتخاب فایل </label>
                        </div>
                    </div>
{{--                    <div class="form-group col-md-6">--}}
{{--                        <label for="thumbnail">image thumbnail<span class="mr-3" style="font-size: 9pt;color: red">(ابعاد پیشنهادی :1800*900 پیکسل)</span></label>--}}
{{--                        <div class="custom-file">--}}
{{--                            <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail">--}}
{{--                            <label class="custom-file-label" for="thumbnail"> انتخاب فایل </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
        
        
           
                    <div class="form-group col-md-6">
                        <label for="button_link">لینک دکمه</label>
                        <input class="form-control" id="button_link" name="button_link" type="text" value="{{ old('button_link') }}">
                    </div>
             
                     
                    <div class="form-group col-md-6">
                        <label for="button_link">موقعیت بنر </label>
                    <select name="position" class="form-control">
                        <option  value="0">وسط صفحه</option>
                                 <option  value="1">پایین صفحه</option>
                    </select>
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
