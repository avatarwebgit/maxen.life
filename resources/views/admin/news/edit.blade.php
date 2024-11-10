@extends('admin.layouts.admin')

@section('title')
edit
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
                <h5 class="font-weight-bold">ویرایش تصویر : {{ $news->image }}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.news.update', ['news' => $news->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row justify-content-center mb-3">
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ url( env('SLIDER_IMAGES_UPLOAD_PATH').$news->image ) }}" alt="">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="primary_image"> انتخاب تصویر </label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="banner_image">
                            <label class="custom-file-label" for="banner_image"> انتخاب فایل </label>
                        </div>
                    </div>
                          <div class="form-group col-md-6">
                        <label for="primary_image"> لینک</label>
                        <div class="custom-file">
                            <input type="text" name="link" class="form-control" value="{{$news->link}}">
                       
                        </div>
                    </div>

                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
