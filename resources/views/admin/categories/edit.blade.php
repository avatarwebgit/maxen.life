@extends('admin.layouts.admin')
@section('script')
<script>
      CKEDITOR.replace('description', {
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
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">تنظیمات دسته بندی : {{ $category->name }}</h5>
            </div>
            <hr>

            @include('admin.sections.errors')

            <form action="{{ route('admin.categories.update',['category'=>$category->id]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $category->name }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">نام انگلیسی</label>
                        <input class="form-control" id="name" name="name_en" type="text" value="{{ $category->name_en }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">اولویت</label>
                        <input class="form-control" id="priority" name="priority" type="number"
                               value="{{ $category->priority }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">alias</label>
                        <input class="form-control" id="alias" name="alias" type="text" value="{{ $category->alias }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name">Meta Tag Keyword</label>
                        <input class="form-control" id="meta_keyword" name="meta_keyword" type="text"
                               value="{{ $category->meta_keyword }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">متن پس زمینه</label>
                        <input class="form-control" id="text" name="text" type="text" value="{{ $category->text }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="parent_id">والد</label>
                        <select class="form-control" id="parent_id" name="parent_id">
                            <option value="0">بدون والد</option>
                            @foreach ($parentCategories as $parentCategory)
                                <option value="{{ $parentCategory->id }}"
                                    {{ $category->parent_id == $parentCategory->id ? 'selected' : '' }}
                                >
                                    {{ $parentCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" {{ $category->getRawOriginal('is_active') ? 'selected' : '' }}>فعال
                            </option>
                            <option value="0" {{ $category->getRawOriginal('is_active') ? '' : 'selected' }}>غیرفعال
                            </option>
                        </select>
                    </div>
{{--                    <div class="form-group col-md-3">--}}
{{--                        <label for="is_active">واحد اندازه گیری</label>--}}
{{--                        <select class="form-control" id="measure_id" name="measure_id">--}}
{{--                            <option value="">بدون واحد اندازه گیری</option>--}}
{{--                            @foreach($measures as $measure)--}}
{{--                                <option--}}
{{--                                    {{ in_array($measure->id,$category->Measures()->pluck('id')->toArray()) ? 'selected' : '' }} value="{{ $measure->id }}">{{ $measure->title }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <!--<div class="form-group col-md-3">-->
                    <!--    <label for="primary_image">عکس شاخص</label>-->
                    <!--    <div class="custom-file">-->
                    <!--        <input type="file" name="primary_image" class="custom-file-input" id="primary_image">-->
                    <!--        <label class="custom-file-label" for="primary_image"> انتخاب فایل </label>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="form-group col-md-3">-->
                    <!--    <label for="header_image">عکس header</label>-->
                    <!--    <div class="custom-file">-->
                    <!--        <input type="file" name="header_image" class="custom-file-input" id="header_image">-->
                    <!--        <label class="custom-file-label" for="header_image"> انتخاب فایل </label>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-12">
                        <hr>
                    </div>
     

                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="banner_image"> تصویر پس زمینه (1920px * 600px) </label>
                        <div class="custom-file">
                            <input type="file" name="banner_image" class="custom-file-input" id="banner_image">
                            <label class="custom-file-label" for="banner_image"> انتخاب فایل </label>
                        </div>
                    </div>
                    @if(count($category->children)==0 and $category->parent_id!=0)
                        <div class="col-md-12">
                            <div class="alert alert-warning d-flex justify-content-between">
                                <label for="depends_on_quantity" class="m-0">در روش های ارسال این کالا به تعداد وابسته باشد ؟</label>
                                <input {{ $category->depends_on_quantity==1 ? 'checked' : '' }} type="checkbox" id="depends_on_quantity" name="depends_on_quantity" value="{{ $category->depends_on_quantity }}">
                            </div>
                        </div>
                    @endif
                    <div class="form-group col-md-12 mt-2">
                        <label for="meta_description">Meta Tag Description</label>
                        <textarea rows="4" class="form-control" id="meta_description"
                                  name="meta_description">{{ $category->meta_description }}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description"
                                  name="description">{{ $category->description }}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">توضیحات انگلیسی</label>
                        <textarea class="form-control" id="description_en"
                                  name="description_en">{{ $category->description_en }}</textarea>
                    </div>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection

