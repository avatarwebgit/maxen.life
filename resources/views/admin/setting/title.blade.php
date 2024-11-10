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
            <form action="{{ route('admin.setting.title.update') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                
                <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="fa" role="tabpanel" aria-labelledby="fa-tab">
      
                      
                             
<hr>
                 <div class="form-row">
          
                                 @if($section == 'cookie')
                         <div class="form-group col-12">
                        <label for="text">متن کوکی</label>
                        <textarea class="form-control" id="text" name="text_cookie" type="text">{{ $setting->text_cookie }}</textarea>
                    </div>
                    @endif
                    
                                      
                      @if($section == 'about')
                 <div class="form-group col-md-6">
                        <label for="name">متن 1</label>
                        <input class="form-control" id="text_1" name="text_1" type="text" value="{{ $setting->text_1 }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">متن 2</label>
                        <input class="form-control" id="text_2" name="text_2" type="text" value="{{ $setting->text_2 }}">
                    </div>
                    @endif
                    
                    @if($section == 'product')
                                  <div class="form-group col-md-6">
                        <label for="name">عنوان</label>
                        <input class="form-control" id="title_1" name="title_1" type="text" value="{{ $setting->title_1 }}">
                    </div>
                    <!--<div class="form-group col-md-6">-->
                    <!--    <label for="name">عنوان 2</label>-->
                    <!--    <input class="form-control" id="title_2" name="title_2" type="text" value="{{ $setting->title_2 }}">-->
                    <!--</div>-->
                    <!--<div class="form-group col-md-6">-->
                    <!--    <label for="name">عنوان 3</label>-->
                    <!--    <input class="form-control" id="title_3" name="title_3" type="text" value="{{ $setting->title_3 }}">-->
                    <!--</div>-->
                    
                    @endif
                    
                                 @if($section == 'news')
                            
                    <div class="form-group col-md-6">
                        <label for="name">عنوان </label>
                        <input class="form-control" id="title_4" name="title_4" type="text" value="{{ $setting->title_4 }}">
                    </div>
                            
                            @endif
                            
                            @if($section == 'home')
                            
                                    <div class="form-group col-md-12">
                        <label for="name">متن </label>
                        <textarea  class="form-control" name="description_index">{{ $setting->description_index }}</textarea>

                    </div>
                            
                            @endif
                            
                                @if($section == 'footer')
                                 <div class="form-group col-md-6">
                        <label for="name"> عنوان بخش محصولات فوتر</label>
                        <input class="form-control" id="footer_1" name="footer_1" type="text" value="{{ $setting->footer_1 }}">
                    </div>
                    
                                        <div class="form-group col-md-6">
                        <label for="name"> عنوان بخش صفحات فوتر</label>
                        <input class="form-control" id="footer_1" name="footer_3" type="text" value="{{ $setting->footer_3 }}">
                    </div>
                     <div class="form-group col-md-6">
                        <label for="name"> عنوان بخش خبرنامه فوتر</label>
                        <input class="form-control" id="footer_2" name="footer_2" type="text" value="{{ $setting->footer_2 }}">
                    </div>
                    <!-- <div class="form-group col-md-6">-->
                    <!--    <label for="name">عنوان 3</label>-->
                    <!--    <input class="form-control" id="footer_3" name="footer_3" type="text" value="{{ $setting->footer_3 }}">-->
                    <!--</div>-->
                    <!-- <div class="form-group col-md-6">-->
                    <!--    <label for="name">عنوان 4</label>-->
                    <!--    <input class="form-control" id="footer_4" name="footer_4" type="text" value="{{ $setting->footer_4 }}">-->
                    <!--</div>-->
                    <!--      <div class="form-group col-md-6">-->
                    <!--    <label for="name">عنوان سوم </label>-->
                    <!--    <input class="form-control" id="footer_4" name="footer_4" type="text" value="{{ $setting->footer_4 }}">-->
                    <!--</div>-->
                     <div class="form-group col-md-6">
                        <label for="name">کپی رایت در فوتر</label>
                        <input class="form-control" id="footer_5" name="footer_5" type="text" value="{{ $setting->footer_5 }}">
                    </div>
                          @endif
                                @if($section == 'contact')
                                        <div class="form-group col-md-6">
                        <label for="name"> عنوان</label>
                        <input class="form-control" id="contact_1" name="contact_1" type="text" value="{{ $setting->contact_1 }}">
                    </div>
                     <div class="form-group col-md-6">
                        <label for="name">متن</label>
                        <input class="form-control" id="contact_2" name="contact_2" type="text" value="{{ $setting->contact_2 }}">
                    </div>
                    <!-- <div class="form-group col-md-6">-->
                    <!--    <label for="name">عنوان 3</label>-->
                    <!--    <input class="form-control" id="contact_3" name="contact_3" type="text" value="{{ $setting->contact_3 }}">-->
                    <!--</div>-->
                    <!-- <div class="form-group col-md-6">-->
                    <!--    <label for="name">عنوان 4</label>-->
                    <!--    <input class="form-control" id="contact_4" name="contact_4" type="text" value="{{ $setting->contact_4 }}">-->
                    <!--</div>-->
    @endif
                </div>
      
      </div>
  <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
      
                                         
                                    
                <div class="form-row">

        
                    @if($section == 'cookie')
                         <div class="form-group col-12">
                        <label for="text">متن کوکی</label>
                        <textarea class="form-control" id="text" name="text_cookie_en" type="text">{{ $setting->text_cookie_en }}</textarea>
                    </div>
                    @endif
                    
                    
                             
                      @if($section == 'about')
                    <div class="form-group col-md-6">
                        <label for="name">متن انگلیسی 1</label>
                        <input class="form-control" id="text_1_en" name="text_1_en" type="text" value="{{ $setting->text_1_en }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">متن انگلیسی 2</label>
                        <input class="form-control" id="text_2_en" name="text_2_en" type="text" value="{{ $setting->text_2_en }}">
                    </div>
                    @endif
                     @if($section == 'product')
                    <!--          <div class="form-group col-md-6">-->
                    <!--    <label for="name">عنوان انگلیسی 1</label>-->
                    <!--    <input class="form-control" id="title_1_en" name="title_1_en" type="text" value="{{ $setting->title_1_en }}">-->
                    <!--</div>-->
                    <div class="form-group col-md-6">
                        <label for="name">عنوان بولد</label>
                        <input class="form-control" id="title_2_en" name="title_2_en" type="text" value="{{ $setting->title_2_en }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">عنوان ایتالیک</label>
                        <input class="form-control" id="title_3_en" name="title_3_en" type="text" value="{{ $setting->title_3_en }}">
                    </div>
                     @endif
                            @if($section == 'news')
                            
                                   <div class="form-group col-md-6">
                        <label for="name">عنوان انگلیسی </label>
                        <input class="form-control" id="title_4_en" name="title_4_en" type="text" value="{{ $setting->title_4_en }}">
                    </div>
                            @endif
                            
                            
                                                     @if($section == 'footer')
      <div class="form-group col-md-6">
                 <label for="name"> عنوان بخش محصولات فوتر</label>
                        <input class="form-control" id="footer_1_en" name="footer_1_en" type="text" value="{{ $setting->footer_1_en }}">
                    </div>
                    
                                                            <div class="form-group col-md-6">
                        <label for="name"> عنوان بخش صفحات فوتر</label>
                        <input class="form-control" id="footer_3_en" name="footer_3_en" type="text" value="{{ $setting->footer_3_en }}">
                    </div>
                    <div class="form-group col-md-6">
               <label for="name"> عنوان بخش خبرنامه فوتر</label>
                        <input class="form-control" id="footer_2_en" name="footer_2_en" type="text" value="{{ $setting->footer_2_en }}">
                    </div>
                    <!--<div class="form-group col-md-6">-->
                    <!--    <label for="name">عنوان انگلیسی 3</label>-->
                    <!--    <input class="form-control" id="footer_3_en" name="footer_3_en" type="text" value="{{ $setting->footer_3_en }}">-->
                    <!--</div>-->
                    <!--<div class="form-group col-md-6">-->
                    <!--    <label for="name">عنوان انگلیسی 4</label>-->
                    <!--    <input class="form-control" id="footer_4_en" name="footer_4_en" type="text" value="{{ $setting->footer_4_en }}">-->
                    <!--</div>-->
                    <div class="form-group col-md-6">
                        <label for="name">کپی رایت  </label>
                        <input class="form-control" id="footer_5_en" name="footer_5_en" type="text" value="{{ $setting->footer_5_en }}">
                    </div>
                          @endif
                                                          @if($section == 'contact')
        <div class="form-group col-md-6">
                        <label for="name">عنوان انگلیسی </label>
                        <input class="form-control" id="contact_1_en" name="contact_1_en" type="text" value="{{ $setting->contact_1_en }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">متن انگلیسی </label>
                        <input class="form-control" id="contact_2_en" name="contact_2_en" type="text" value="{{ $setting->contact_2_en }}">
                    </div>

    @endif
    
                                
                            @if($section == 'home')
                            
                                    <div class="form-group col-md-12">
                        <label for="name">متن </label>
                        <textarea  class="form-control" name="description_index_en">{{ $setting->description_index_en }}</textarea>

                    </div>
                            
                            @endif
                
                </div>
      
      
  </div>

</div>


          
   
      

           
          




                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
            </form>
        </div>

    </div>

@endsection
