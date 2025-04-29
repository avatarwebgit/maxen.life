@extends('admin.layouts.admin')

@section('title')
    create products
@endsection

@section('script')
    <script>
        $('#brandSelect').selectpicker({
            'title': 'انتخاب برند'
        });
        $('#tagSelect').selectpicker({
            'title': 'انتخاب تگ'
        });

        $('#BrandSelect').selectpicker({
            'title': 'برند های مرتبط'
        });

        // Show File Name
        $('#primary_image').change(function () {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#images').change(function () {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#categorySelect').selectpicker({
            'title': 'انتخاب دسته بندی'
        });
        $('#functionalTypesSelect').selectpicker({
            'title': 'انتخاب براساس عملکرد'
        });



        $('#saveClose').click(function () {
            $('#close').val('saveClose');
            $('form').submit();
        });

        $('#save').click(function () {
            $('#close').val('save');
            $('form').submit();
        });

    </script>
    {{--    //ckEditor--}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
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
        //remove style in text copied to editor
        CKEDITOR.on('instanceReady', function (ev) {
            ev.editor.on('paste', function (evt) {
                if (evt.data.type == 'html') {
                    evt.data.dataValue = evt.data.dataValue.replace(/ style=".*?"/g, '');
                }
            }, null, null, 9);
        });
    </script>
    <script src="{{ asset('admin/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            language: 'fa',
            selector: '#shortDescription'
        });

                tinymce.init({
            language: 'en',
            selector: '#shortDescription_en'
        });
    </script>
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right d-flex justify-content-between">
                <h5 class="font-weight-bold">ایجاد محصول</h5>
                <div>
                    <button id="save" class="btn btn-sm btn-success">save</button>
                    <button id="saveClose" class="btn btn-sm btn-success">save and close</button>
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark">بازگشت</a>
                </div>
            </div>
            <hr>

              <div class="col-12 d-flex justify-content-between align-items-center">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="fa-tab" data-toggle="tab" data-target="#fa" type="button" role="tab" aria-controls="fa" aria-selected="true">فارسی


    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="en-tab" data-toggle="tab" data-target="#en" type="button" role="tab" aria-controls="en" aria-selected="false">انگلیسی</button>
  </li>

</ul>


                </div>

            @include('admin.sections.errors')

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf


    <div class="tab-content" id="myTabContent">

      <div class="tab-pane fade show active" id="fa" role="tabpanel" aria-labelledby="fa-tab">
                     <div class="form-row">


                    <div class="form-group col-md-3">
                        <label for="name"> عنوان 1</label>
                        <input class="form-control" id="name" name="title_1" type="text" value="{{ old('title_1') }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="name"> عنوان 2</label>
                        <input class="form-control" id="name" name="title_2" type="text" value="{{ old('title_2') }}">
                    </div>

                         <label for="name">لینک ar</label>
                         <input class="form-control" id="name" name="ar" type="text" value="{{ old('ar')  }}">
                     </div>

                                                     <div class="form-group col-md-3">
                        <label for="name">نام *</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}">
                    </div>


                           <div class="form-group col-md-12">
                        <label for="shortDescription">توضیحات مختصر</label>
                        <textarea class="form-control" id="shortDescription"
                                  name="shortDescription">{{ old('shortDescription') }}</textarea>
                    </div>



                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description"
                                  name="description">{{ old('description') }}</textarea>
                    </div>
                             <div class="form-group col-md-6">
                        <label for="name">Meta Description</label>
                        <input class="form-control" id="meta_des" name="meta_des" type="text" value="{{ old('meta_des') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Meta Keyword</label>
                        <input class="form-control" id="meta_key" name="meta_key" type="text" value="{{ old('meta_key') }}">
                    </div>
                      </div>
      </div>

        <div class="tab-pane fade " id="en" role="tabpanel" aria-labelledby="en-tab">
              <div class="form-row">
                   <div class="form-group col-md-3">
                        <label for="name">نام انگلیسی *</label>
                        <input class="form-control" id="name" name="name_en" type="text" value="{{ old('name_en') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name"> عنوان انگلیسی 1</label>
                        <input class="form-control" id="name" name="title_1_en" type="text" value="{{ old('title_1_en') }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="name"> عنوان انگلیسی 2</label>
                        <input class="form-control" id="name" name="title_2_en" type="text" value="{{ old('title_2_en') }}">
                    </div>


                      <div class="form-group col-md-12">
                        <label for="shortDescription">توضیحات مختصر انگلیسی</label>
                        <textarea class="form-control" id="shortDescription_en"
                                  name="shortDescription_en">{{ old('shortDescription_en') }}</textarea>
                    </div>



                    <div class="form-group col-md-12">
                        <label for="description">توضیحات انگلیسی </label>
                        <textarea class="form-control" id="description_en"
                                  name="description_en">{{ old('description_en') }}</textarea>
                    </div>

                                              <div class="form-group col-md-6">
                        <label for="name">Meta Description</label>
                        <input class="form-control" id="meta_des_en" name="meta_des_en" type="text" value="">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Meta Keyword</label>
                        <input class="form-control" id="meta_key_en" name="meta_key_en" type="text" value="">
                    </div>
              </div>
      </div>

    </div>
                <div class="form-row">



                    <div class="form-group col-md-3">
                        <label for="name">alias</label>
                        <input class="form-control" id="alias" name="alias" type="text" value="{{ old('alias') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="category_id">دسته بندی</label>
                        <select id="categorySelect" name="category_id[]" class="form-control" data-live-search="true" multiple>
                            @foreach ($categories as $category)
                                <option
                                    {{ old('category_id')==$category->id ? 'selected' : ' ' }} value="{{ $category->id }}">
                                    {{ isset($category->parent->name) ? $category->parent->name : $category->name }}
                                    {{ isset($category->parent->name) ? '/'.$category->name : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت نمایش</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" selected>فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>











                    <div class="col-md-12">
                        <hr>
                        <p>تصاویر محصول : </p>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="primary_image"> انتخاب تصویر اصلی </label>
                        <div class="custom-file">
                            <input type="file" name="primary_image" class="custom-file-input" id="primary_image">
                            <label class="custom-file-label" for="primary_image"> انتخاب فایل </label>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="images"> انتخاب تصاویر </label>
                        <div class="custom-file">
                            <input type="file" name="images[]" multiple class="custom-file-input" id="images">
                            <label class="custom-file-label" for="images"> انتخاب فایل ها </label>
                        </div>
                    </div>

                </div>
                <input type="hidden" name="close" id="close" value="">
            </form>
        </div>

    </div>

@endsection
