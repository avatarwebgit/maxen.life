@extends('admin.layouts.admin')

{{-- ===========  meta Title  =================== --}}
@section('title')
    ایجاد صفحه
@endsection
{{-- ===========  My Css Style  =================== --}}
@section('style')
    <style>
        .modal-header .close {
            margin: -1rem;
        }

        .modal-body > p, .form-group {
            padding: 0.25rem 0.5rem;
        }

        .noneDisplay {
            display: none !important;
        }

        .redBorder {
            border: 1px solid red;
        }

    </style>
@endsection
{{-- ===========  My JavaScript  =================== --}}

@section('script')
    <script>

        // Show File Name
        $('#image').change(function () {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

    </script>
    {{--    //ckEditor--}}
    <script src="{{ asset('admin/fullCKEditor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description', {
            language: 'fa',
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
                CKEDITOR.replace('description_en', {
            language: 'en',
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
{{-- ===========      CONTENT      =================== --}}
@section('content')

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ایجاد صفحه</h5>
            </div>
            <hr>
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

            <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                                    <div class="tab-content" id="myTabContent">
        
      <div class="tab-pane fade show active" id="fa" role="tabpanel" aria-labelledby="fa-tab">
          <div class="form-row">
                 <div class="form-group col-md-3">
                        <label for="name">عنوان</label>
                        <input class="form-control" id="title" name="title" type="text" value="{{ old('title') }}">
                    </div>
                           <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description"
                                  name="description">{{ old('description') }}</textarea>
                    </div>
              
          </div>
          </div>
            <div class="tab-pane fade " id="en" role="tabpanel" aria-labelledby="en-tab">
                                 <div class="form-group col-md-3">
                        <label for="name">عنوان</label>
                        <input class="form-control" id="title_en" name="title_en" type="text" value="{{ old('title_en') }}">
                    </div>
                           <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description_en"
                                  name="description_en">{{ old('description_en') }}</textarea>
                    </div>
          </div>
          
          </div>
                <div class="form-row">
                 
                    <div class="form-group col-md-3">
                        <label for="alias">alias</label>
                        <input class="form-control" id="alias" name="alias" type="text" value="{{old('alias')}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">اولویت</label>
                        <input class="form-control" id="priority" name="priority" type="number" value="1">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت نمایش بنر بالای صفحه</label>
                        <select class="form-control" id="banner_is_active" name="banner_is_active">
                            <option value="1" selected>فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="image"> تصویر بنر </label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="image">
                            <label class="custom-file-label" for="image"> انتخاب فایل </label>
                        </div>
                    </div>
             
                    <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
                </div>
            </form>
        </div>
    </div>

@endsection
