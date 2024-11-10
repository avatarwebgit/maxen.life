@extends('admin.layouts.admin')

{{-- ===========  meta Title  =================== --}}
@section('title')
    ایجاد مقاله
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
        $('#productCategorySelect').selectpicker({
            'title': 'انتخاب دسته بندی'
        });
        // Show File Name
        $('#primary_image').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

    </script>
    {{--    //ckEditor--}}
    <script src="{{ asset('admin/fullCKEditor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'description' ,{
            language: 'fa',
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        
        
                CKEDITOR.replace( 'description_en' ,{
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
                <h5 class="font-weight-bold">ایجاد مقاله</h5>
            </div>
            <hr>

            @include('admin.sections.errors')
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
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="tab-content" id="myTabContent">
        
      <div class="tab-pane fade show active" id="fa" role="tabpanel" aria-labelledby="fa-tab">
          <div class="form-row">
            <div class="form-group col-md-4">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}">
                    </div>
                   <div class="form-group col-md-12">
                        <label for="shortDescription">توضیحات کوتاه</label>
                        <textarea class="form-control" id="shortDescription" name="shortDescription" type="text" value="{{ old('shortDescription') }}"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description"
                                  name="description">{{ old('description') }}</textarea>
                    </div>
                    
              
          </div>
          </div>
            <div class="tab-pane fade " id="en" role="tabpanel" aria-labelledby="en-tab">
         <div class="form-group col-md-4">
                        <label for="name">نام</label>
                        <input class="form-control" id="title_en" name="title_en" type="text" value="{{ old('title_en') }}">
                    </div>
                <div class="form-group col-md-12">
                        <label for="shortDescription">توضیحات کوتاه</label>
                        <textarea class="form-control" id="shortDescription_en" name="shortDescription_en" type="text" value="{{ old('shortDescription_en') }}"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description_en"
                                  name="description_en">{{ old('description_en') }}</textarea>
                    </div>
          </div>
          
          </div>
                <div class="form-row">
           
                    <div class="form-group col-md-4">
                        <label for="name">alias</label>
                        <input class="form-control" id="alias" name="alias" type="text" value="{{ old('alias') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">دسته‌بندی</label>
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="primary_image"> انتخاب تصویر اصلی </label>
                        <div class="custom-file">
                            <input type="file" name="primary_image" class="custom-file-input" id="primary_image">
                            <label class="custom-file-label" for="primary_image"> انتخاب فایل </label>
                        </div>
                    </div>
    
                               <div class="form-group col-md-3">
                        <label for="meta_keyword">Meta key</label>
                        <input class="form-control" id="meta_keyword" name="meta_keyword" type="text" value="{{ old('meta_keyword') }}">
                    </div>
                         <div class="form-group col-md-3">
                        <label for="meta_des">Meta Description</label>
                        <input class="form-control" id="meta_des" name="meta_des" type="text" value="{{ old('meta_des') }}">
                    </div>
                    <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
