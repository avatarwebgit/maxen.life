@extends('admin.layouts.admin')

@section('title')
   تنظیمات ارسال
@endsection

@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        // Show File Name
        $('#header_image').change(function () {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
        // Show File Name
        $('#primary_image').change(function () {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
        // Show File Name
        $('#banner_image').change(function () {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
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
                <h5 class="font-weight-bold">مدیریت ارسال - دسته بندی {{ $category->name }}</h5>
            </div>
            <hr>
            <div class="alert alert-info text-center">
                به صورت پیشفرض کالا ها را میتوان با همه روش ها ارسال کرد.
                با انتخاب کردن هر یک از موارد زیر آن روش ارسال برای دسته بندی مربوط <b class="text-danger">غیر فعال</b> میشود.
            </div>
            <hr>

            @include('admin.sections.errors')

            <form action="{{ route('admin.category.send_setting.update', ['category' => $category->id]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">
                    @foreach($delivery_methods as $item)
                        <div class="col-md-4">
                            <div class="alert alert-dark d-flex justify-content-between">
                                <label for="method_{{ $item->id }}" class="m-0">{{ $item->name }}</label>
                                <input id="method_{{ $item->id }}" @if($send_setting) {{ in_array($item->id,$send_setting) ? 'checked' : '' }}@endif type="checkbox" name="methods[]" value="{{ $item->id }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
/
@extends('admin.layouts.admin')

@section('title')
    تنظیمات ارسال
@endsection

@section('script')

@endsection
