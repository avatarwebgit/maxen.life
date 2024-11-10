@extends('admin.layouts.admin')

@section('title')
    create slider
@endsection

@section('script')
    <script>
        // Show File Name
        $('#slider_image').change(function() {
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
        $('#image_2').change(function() {
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
       <div class="row">

      
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش اسلایدر : {{ $slider->image }}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            
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
            <form action="{{ route('admin.sliders.update' , ['slider' => $slider]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                                <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="fa" role="tabpanel" aria-labelledby="fa-tab">
                 <div  class="form-row">
             
                           <div class="form-group col-12">
                        <label for="text">عنوان</label>
                        <textarea class="form-control" id="text" name="title" type="text">{{ $slider->title }}</textarea>
                    </div>
                    
                         <div class="form-group col-12">
                        <label for="text">متن</label>
                        <textarea class="form-control" id="text" name="text" type="text">{{ $slider->text }}</textarea>
                    </div>
                </div>
                
      </div>
      
      
        <div class="tab-pane fade " id="en" role="tabpanel" aria-labelledby="en-tab">
                          <div id="en-tab" class="form-row">
                   
                           <div class="form-group col-12">
                        <label for="text">عنوان</label>
                        <textarea class="form-control" id="text" name="title_en" type="text">{{ $slider->title_en }}</textarea>
                    </div>
                    
                         <div class="form-group col-12">
                        <label for="text">متن</label>
                        <textarea class="form-control" id="text" name="text_en" type="text">{{ $slider->text_en }}</textarea>
                    </div>
                </div>
            
      </div>
      
      </div>
                <div class="row justify-content-center mb-3">
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ url( env('SLIDER_IMAGES_UPLOAD_PATH').$slider->image ) }}" alt="">
                        </div>
                    </div>
                </div>
 
     
                 
  
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="primary_image"> انتخاب تصویر </label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="slider_image">
                            <label class="custom-file-label" for="slider_image"> انتخاب فایل </label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="button_link">لینک دکمه</label>
                        <input class="form-control" id="button_link" name="button_link" type="text" value="{{ $slider->button_link }}">
                    </div>
                  
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
