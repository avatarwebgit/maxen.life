@extends('admin.layouts.admin')

@section('title')
    edit products
@endsection

@section('style')
    <style>
        .img-thumbnail {
            width: 300px !important;
            height: auto;
        }
    </style>
@endsection
@section('script')
    <script>
        $('#categorySelect').selectpicker({
            'title': 'انتخاب دسته بندی'
        });
        $('#functionalTypesSelect').selectpicker({
            'title': 'انتخاب براساس عملکرد'
        });
        $('#categoryOfferSelect').selectpicker({
            'title': 'دسته بندی های پیشنهادی'
        });
        $('#BrandSelect').selectpicker({
            'title': 'برند های مرتبط'
        });
        $('#OfferBrandSelect').selectpicker({
            'title': 'برند های پیشنهادی'
        });
        $('#productColors').selectpicker({
            'title': 'رنگ بندی های مرتبط'
        });
        $('#selectProvince').selectpicker({
            'title': 'لیست استان ها'
        });

        $(`#variationDateOnSaleFrom`).MdPersianDateTimePicker({
            targetTextSelector: `#variationInputDateOnSaleFrom`,
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });

        $(`#variationDateOnSaleTo`).MdPersianDateTimePicker({
            targetTextSelector: `#variationInputDateOnSaleTo`,
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });

        //calculate Discount
        $('#sale_price').keyup(function () {
            let mainPrice = $('#price').val();
            mainPrice = mainPrice.replaceAll(',', '', mainPrice);
            let discount = $(this).val();
            if (parseInt(discount) > parseInt(mainPrice)) {
                alert('قیمت پس از تخفیف باید کمتر از قیمت اصلی باشد');
                $('#sale_price').val(number_format(mainPrice));
                $('#percent_sale_price').val(0);
            } else {
                let percentDiscount = calculatePercentDiscount(discount, mainPrice);
                $('#percent_sale_price').val(percentDiscount);
            }
        })
        $('#percent_sale_price').keyup(function () {
            let percentDiscount = $(this).val();
            let mainPrice = $('#price').val();
            mainPrice = mainPrice.replaceAll(',', '', mainPrice);
            if (parseInt(mainPrice) < 0) {
                alert('ابتدا برای کالا قیمت اصلی را وارد کنید');
            } else {
                if (percentDiscount > 100) {
                    $('#percent_sale_price').val(100);
                    percentDiscount = 100;
                }
                if (percentDiscount < 0) {
                    $('#percent_sale_price').val(0);
                    percentDiscount = 0;
                }
                let Discount = calculateDiscount(percentDiscount, mainPrice);
                $('#sale_price').val(Discount);
            }
        })

        $('#price').keyup(function () {
            let price = $(this).val();
            $('#sale_price').val(price);
            $('#percent_sale_price').val(0);
        })

        //
        function calculateDiscount(percentDiscount, mainPrice) {
            let Discount = ((100 - percentDiscount) * mainPrice) / 100;
            return Discount;
        }

        function calculatePercentDiscount(discount, mainPrice) {
            let percentDiscount = ((mainPrice - discount) / mainPrice) * 100;
            return percentDiscount;
        }


        $("#showOnIndex").change(function () {
            if (this.checked) {
                let variationInputDateOnSaleFromVal = $('#variationInputDateOnSaleFrom').val();
                let variationInputDateOnSaleToVal = $('#variationInputDateOnSaleTo').val();
                if (variationInputDateOnSaleFromVal === "" || variationInputDateOnSaleToVal == "") {
                    alert('برای نمایش در بخش شمارش معکوس ابتدا بایستی زمان شروع و پایان تخفیف را وارد نمایید');
                    $("#showOnIndex").prop('checked', false);
                }
            }
        });

        function searchProduct() {
            let keyWord = $('#productSearchInput').val();
            let product_id = "{{ $product->id }}";
            if (keyWord.length < 4) {
                alert('وارد کردن حداقل 4 کاراکتر الزامی است')
            } else {
                $.ajax({
                    url: "{{ route('admin.products.search') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        keyword: keyWord,
                        product_id: product_id
                    },
                    beforeSend: function () {
                        let progressBar = `<div style="width: 100%;" class="progress mt-3">
  <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
</div>`;
                        $('#productRelatedRow').html(progressBar);
                    },
                    success: function (msg) {
                        if(msg){
                            if (msg[1]===0){
                                let Alert = `<div class="alert alert-primary text-center w-100" role="alert">
  محصولی یافت نشد!
</div>`;
                                $('#productRelatedRow').html(Alert);
                            }else {
                                let products = msg[2];
                                if (products) {
                                    let row = "";
                                    $.each(products, function (index, product) {
                                        row += creatRelatedProduct(product);
                                        $('#productRelatedRow').html(row);
                                    })
                                }
                            }
                        }

                    },
                    error: function () {
                        console.log("something went wrong");
                    },
                });
            }
        }

        function creatRelatedProduct(product) {
            let id = product.id;
            let name = product.name;
            let env = '{{ asset(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH')) }}';
            let image = product.primary_image;
            let html = '<div id="' + id + '" class="col-6 col-md-2 text-center"><div>' +
                '<img class="img-thumbnail mb-3" src="' + env + '/' + image + '">' +
                '<span">' + name + '</span>' +
                '<button onclick="addToRelated(' + id + ')" class="btn btn-sm btn-outline-dark mr-2" type="button">افزودن</button>' +
                '</div></div>';
            return html;
        }

        function addToRelated(id) {
            $.ajax({
                url: "{{ route('admin.product.ajax') }}",
                type: "POST",
                dataType: "json",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function (product) {
                    if (product) {
                        let id = product.id;
                        let name = product.name;
                        let env = '{{ asset(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH')) }}';
                        let image = product.primary_image;
                        let html = '<div id="' + id + '" class="col-6 col-md-2 text-center"><div>' +
                            '<img class="img-thumbnail mb-3" src="' + env + '/' + image + '">' +
                            '<span">' + name + '</span>' +
                            '<input type="hidden" name="relatedProduct[]" value="' + id + '">' +
                            '<button onclick="deleteFromRelated(this,' + id + ')" class="btn btn-sm btn-outline-danger mr-2" type="button">حذف</button>' +
                            '</div></div>';
                        $('#relatedSelected').append(html);
                    }
                },
                error: function () {
                    console.log("something went wrong");
                },
            });
        }

        function deleteFromRelated(tag, id) {
            $(tag).parents('#' + id).remove();
        }

        function clearSearchBox() {
            $('#productRelatedRow').html('');
        }

        function NumberFormat(tag) {
            let price = $(tag).val();
            $(tag).val(number_format(price));
        }

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
        //remove style
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
                <h5 class="font-weight-bold">ویرایش محصول {{ $product->name }}</h5>
                <div>
                    <button id="save" class="btn btn-sm btn-success">به‌روزرسانی</button>
                    <button id="saveClose" class="btn btn-sm btn-success">به‌روزرسانی و بستن</button>
                    <a href="{{ $pre_url }}" class="btn btn-sm btn-dark">بازگشت</a>
                </div>
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
            <div class="d-flex justify-content-center mb-3">
                <img class="img-thumbnail"
                     src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$product->primary_image) }}"
                     alt="{{ $product->name }}">
            </div>
            <hr>
            @include('admin.sections.errors')

            <form id="productForm" action="{{ route('admin.products.update', ['product' => $product->id]) }}"
                  method="POST">
                <input type="hidden" name="previous_rout" value="{{ url()->previous() }}">
                @csrf
                @method('put')
                <input type="hidden" name="close" id="close" value="">
                
                
                    <div class="tab-content" id="myTabContent">
        
      <div class="tab-pane fade show active" id="fa" role="tabpanel" aria-labelledby="fa-tab">
                     <div class="form-row">

                                       <div class="form-group col-md-3">
                        <label for="name">عنوان 1</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $product->name }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name"> عنوان 2</label>
                        <input class="form-control" id="name" name="title_1" type="text" value="{{ $product->title_1 }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="name"> عنوان 3</label>
                        <input class="form-control" id="name" name="title_2" type="text" value="{{  $product->title_2  }}">
                    </div>
                    
        
                    
                    
                       <div class="form-group col-md-12">
                        <label for="shortDescription">توضیحات مختصر</label>
                        <textarea class="form-control" id="shortDescription"
                                  name="shortDescription">{!! $product->shortDescription !!}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description" name="description"
                                  rows="4">{!! $product->description !!}</textarea>
                    </div>
                    
                                <div class="form-group col-md-6">
                        <label for="name">Meta Description</label>
                     <input class="form-control" id="meta_des" name="meta_des" type="text" value="{{ $product->meta_des }}">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Meta Keyword</label>
                        <input class="form-control" id="meta_key" name="meta_key" type="text" value="{{ $product->meta_key }}">
                    </div>
                         </div>
</div>

      <div class="tab-pane fade " id="en" role="tabpanel" aria-labelledby="en-tab">
                     <div class="form-row">
                            <div class="form-group col-md-3">
                        <label for="name">عنوان انگلیسی 1 </label>
                        <input class="form-control" id="name_en" name="name_en" type="text" value="{{ $product->name_en }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="name"> عنوان انگلیسی 2</label>
                        <input class="form-control" id="name_en" name="title_1_en" type="text" value="{{ $product->title_1_en }}">
                    </div>


                    <div class="form-group col-md-3">
                        <label for="name"> عنوان انگلیسی 3</label>
                        <input class="form-control" id="name_en" name="title_2_en" type="text" value="{{  $product->title_2_en  }}">
                    </div>
                    
                         <div class="form-group col-md-12">
                        <label for="shortDescription">توضیحات مختصر</label>
                        <textarea class="form-control" id="shortDescription_en"
                                  name="shortDescription_en">{!! $product->shortDescription_en !!}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description_en">توضیحات</label>
                        <textarea class="form-control" id="description_en" name="description_en"
                                  rows="4">{!! $product->description_en !!}</textarea>
                    </div>
                    
                                <div class="form-group col-md-6">
                        <label for="name">Meta Description</label>
                        <input class="form-control" id="meta_des_en" name="meta_des_en" type="text" value="{{ $product->meta_des_en }}">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Meta Keyword</label>
                        <input class="form-control" id="meta_key_en" name="meta_key_en" type="text" value="{{ $product->meta_key_en }}">
                    </div>
                         </div>
</div>
    </div>
                         
                <div class="form-row">
                  
                 


                    <div class="form-group col-md-3">
                        <label for="name">alias</label>
                        <input class="form-control" id="alias" name="alias" type="text" value="{{ $product->alias }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="category_id">دسته بندی  های اصلی:</label>
                        <select id="categorySelect" name="category_id[]" class="form-control" data-live-search="true"
                                multiple>
                            @foreach ($categories as $category)
                                <option
                                    {{ in_array($product->id,$category->Products()->pluck('id')->toArray()) ? 'selected' : '' }} value="{{ $category->id }}">
                                    {{ isset($category->parent->name) ? $category->parent->name : $category->name }}
                                    {{ isset($category->parent->name) ? '/'.$category->name : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" {{ $product->getRawOriginal('is_active')==1 ? 'selected' : '' }}>فعال
                            </option>
                            <option value="0" {{ $product->getRawOriginal('is_active')==0 ? 'selected' : '' }}>غیرفعال
                            </option>
                        </select>
                    </div>
                 
               
            
                </div>





                <div id="productRelatedRow" class="row mt-2">

                </div>

            </form>
        </div>
    </div>
@endsection
