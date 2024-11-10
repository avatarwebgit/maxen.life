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
            <form action="{{ route('admin.contact.update') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                
                <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="fa" role="tabpanel" aria-labelledby="fa-tab">
      
                      
                             
<hr>
                 <div class="form-row">
          

                    

                    
                                        <div class="form-group col-md-6">
                        <label for="name"> عنوان</label>
                        <input class="form-control" id="contact_1" name="contact_1" type="text" value="{{ $setting->contact_1 }}">
                    </div>
                    
                    
                     <div class="form-group col-md-6">
                        <label for="name">متن</label>
                        <input class="form-control" id="contact_2" name="contact_2" type="text" value="{{ $setting->contact_2 }}">
                    </div>
                    <div class="form-group col-md-6">
                                        <label for="name"> آدرس</label>
                        <input class="form-control" id="contact_1" name="address" type="text" value="{{ $setting->address }}">
                    </div>

                </div>
      
      </div>
  <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
      
                                         
                                    
                <div class="form-row">



                            

                                                    
        <div class="form-group col-md-6">
                        <label for="name">عنوان انگلیسی </label>
                        <input class="form-control" id="contact_1_en" name="contact_1_en" type="text" value="{{ $setting->contact_1_en }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">متن انگلیسی </label>
                        <input class="form-control" id="contact_2_en" name="contact_2_en" type="text" value="{{ $setting->contact_2_en }}">
                    </div>
                    
                                        <div class="form-group col-md-6">
                                        <label for="name"> آدرس</label>
                        <input class="form-control" id="contact_1" name="address_en" type="text" value="{{ $setting->address_en }}">
                    </div>


    

                
                </div>
      
      
  </div>

</div>


                       <hr>
                               <h1> اطلاعات تماس </h1>
                       <div class="form-row">
                                               <div class="form-group col-md-4">
                        <label for="name">پست الکترونیک</label>
                        <input class="form-control" id="email" name="email" type="email" value="{{ $setting->email }}">
                    </div>
                                        <div class="form-group col-md-4">
                        <label for="name">تلفن تماس</label>
                        <input class="form-control" id="tel" name="tel" type="text" value="{{ $setting->tel }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">تلفن تماس 2</label>
                        <input class="form-control" id="tel2" name="tel2" type="text" value="{{ $setting->tel2 }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">تلفن تماس 3</label>
                        <input class="form-control" id="tel3" name="tel3" type="text" value="{{ $setting->tel3 }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">تلفن تماس 4</label>
                        <input class="form-control" id="tel4" name="tel4" type="text" value="{{ $setting->tel4 }}">
                    </div>
                       </div>
                <h1>شبکه های اجتماعی</h1>
         
                <div class="form-row">
                     <div class="form-group col-md-4">
                        <label for="name">پیج اینستاگرام </label>
                        <input class="form-control" id="instagram" name="instagram" type="text"
                               value="{{ $setting->instagram }}">
                    </div>
                         <div class="form-group col-md-4">
                        <label for="name">linkedin  </label>
                        <input class="form-control" id="linkedin" name="linkedin" type="text"
                               value="{{ $setting->linkedin }}">
                    </div>
                    
                         <div class="form-group col-md-4">
                        <label for="name"> X (Twitter) </label>
                        <input class="form-control" id="twitter" name="twitter" type="text"
                               value="{{ $setting->twitter }}">
                    </div>
                         <div class="form-group col-md-4">
                        <label for="name">Youtube  </label>
                        <input class="form-control" id="youtube" name="youtube" type="text"
                               value="{{ $setting->youtube }}">
                    </div>
                </div>


          
   
      

           
          




                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
            </form>
        </div>

    </div>

@endsection
