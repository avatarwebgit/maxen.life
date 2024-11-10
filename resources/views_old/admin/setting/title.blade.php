@extends('admin.layouts.admin')

@section('title')
    Edit Title
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
        $('#favicon').change(function() {
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
      
  
            @include('admin.sections.errors')
            <form action="{{ route('admin.setting.title.update') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <p class="col-md-12">عنوان های فوتر</p
                    >
                    <hr>
                    <div class="form-group col-md-6">
                        <label for="name">عنوان 1</label>
                        <input class="form-control" id="footer_1" name="footer_1" type="text" value="{{ $setting->footer_1 }}">
                    </div>
                     <div class="form-group col-md-6">
                        <label for="name">عنوان 2</label>
                        <input class="form-control" id="footer_2" name="footer_2" type="text" value="{{ $setting->footer_2 }}">
                    </div>
                     <div class="form-group col-md-6">
                        <label for="name">عنوان 3</label>
                        <input class="form-control" id="footer_3" name="footer_3" type="text" value="{{ $setting->footer_3 }}">
                    </div>
                     <div class="form-group col-md-6">
                        <label for="name">عنوان 4</label>
                        <input class="form-control" id="footer_4" name="footer_4" type="text" value="{{ $setting->footer_4 }}">
                    </div>
                     <div class="form-group col-md-6">
                        <label for="name">عنوان 5</label>
                        <input class="form-control" id="footer_5" name="footer_5" type="text" value="{{ $setting->footer_5 }}">
                    </div>
                    
                            <p class="col-md-12">عنوان های تماس با ما
                            </p>
                            <hr>
                    <div class="form-group col-md-6">
                        <label for="name">عنوان 1</label>
                        <input class="form-control" id="contact_1" name="contact_1" type="text" value="{{ $setting->contact_1 }}">
                    </div>
                     <div class="form-group col-md-6">
                        <label for="name">عنوان 2</label>
                        <input class="form-control" id="contact_2" name="contact_2" type="text" value="{{ $setting->contact_2 }}">
                    </div>
                     <div class="form-group col-md-6">
                        <label for="name">عنوان 3</label>
                        <input class="form-control" id="contact_3" name="contact_3" type="text" value="{{ $setting->contact_3 }}">
                    </div>
                     <div class="form-group col-md-6">
                        <label for="name">عنوان 4</label>
                        <input class="form-control" id="contact_4" name="contact_4" type="text" value="{{ $setting->contact_4 }}">
                    </div>
               
       
          
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
            </form>
        </div>

    </div>

@endsection
