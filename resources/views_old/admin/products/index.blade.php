@extends('admin.layouts.admin')

@section('title')
    لیست محصولات
@endsection
@section('style')
    <style>
        .img-thumbnail {
            width: 150px;
            height: auto;
        }

        th {
            vertical-align: middle !important;
        }

        #overlay {
            display: none;
        }

        .sale_img {
            position: absolute;
            width: 40px;
            height: auto;
            left: 0;
            top: 0;
        }

        .text-inherit {
            color: inherit !important;
        }
    </style>
@endsection

@section('script')
    <script>
    
        $(document).keydown(function (event) {
            if (event.keyCode == 13) {
                filter();
            }
        })
        
        $(document).ready(function () {
            //get localStorage
            let products = JSON.parse(localStorage.getItem("products"));
            let search_input = localStorage.getItem('search_input');
            let category = localStorage.getItem('category');
            let brand = localStorage.getItem('brand');
            let new_or_special_product = localStorage.getItem('new_or_special_product');
            let order_by = localStorage.getItem('order_by');
            if (products != null) {
                $('#SearchInput').val(search_input);
                $('#category option[value="' + category + '"]').prop('selected', true);
                $('#order_by option[value="' + order_by + '"]').prop('selected', true);
                $('#brand option[value="' + brand + '"]').prop('selected', true);
                $('#new_or_special_product option[value="' + new_or_special_product + '"]').prop('selected', true);
                filter();
            } else {
                $('#category option:first').prop('selected', true);
                $('#brand option:first').prop('selected', true);
                $('#new_or_special_product option:first').prop('selected', true);
                $('#order_by option:first').prop('selected', true);
            }
        });

        $('#clearFactorBtn').click(function () {
            //clear localStorage
            localStorage.removeItem('products');
            localStorage.removeItem('brand');
            localStorage.removeItem('category');
            localStorage.removeItem('search_input');
            localStorage.removeItem('new_or_special_product');
            //
            window.location.reload();
        })

        function filter() {
            let brand = $('#brand').val();
            let category = $('#category').val();
            let order_by = $('#order_by').val();
            let name = $('#SearchInput').val();
            let new_or_special_product = $('#new_or_special_product').val();
            $.ajax({
                url: "{{ route('admin.products.get') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    order_by: order_by,
                    brand: brand,
                    category: category,
                    new_or_special_product: new_or_special_product,
                },
                dataType: "json",
                type: "POST",
                beforeSend: function () {
                    $("#overlay").fadeIn();
                },
                success: function (msg) {
                    if (msg[0] == 1) {
                        //clear localStorage
                        localStorage.removeItem('products');
                        localStorage.removeItem('brand');
                        localStorage.removeItem('category');
                        localStorage.removeItem('search_input');
                        localStorage.removeItem('new_or_special_product');
                        localStorage.removeItem('order_by');
                        //save in localStorage
                        localStorage.setItem("products", JSON.stringify(msg[1]));
                        localStorage.setItem('brand', brand);
                        localStorage.setItem('category', category);
                        localStorage.setItem('search_input', name);
                        localStorage.setItem('new_or_special_product', new_or_special_product);
                        localStorage.setItem('order_by', order_by);

                        $('#insertRow').html(msg[1]);
                        $('.paginate').hide();
                        $("#overlay").fadeOut();
                    } else {
                        console.error(msg);
                    }
                },
                fail: function (error) {
                    console.log(error);
                }
            })
        }


        function RemoveModal(product_id) {
            let modal = $('#remove_modal');
            modal.modal('show');
            $('#product_id').val(product_id);
        }

        function Remove() {
            let product_id = $('#product_id').val();
            $.ajax({
                url: "{{ route('admin.products.delete') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {
                    $("#overlay").fadeIn();
                },
                success: function (msg) {
                    if (msg) {
                        if (msg[0] == 1) {
                            let message = msg[1];
                            swal({
                                title: 'باتشکر',
                                text: message,
                                icon: 'success',
                                timer: 3000,
                            })
                            let products = JSON.parse(localStorage.getItem("products"));
                            if (products != null) {
                                filter();
                            } else {
                                setTimeout(function () {
                                    window.location.reload();
                                }, 3000)
                            }
                        }
                    }
                    $("#overlay").fadeOut();

                },
                fail: function (error) {
                    console.log(error);
                    $("#overlay").fadeOut();
                }
            })
        }

        function productChangeStatus(product_id) {
            let selector = '#status_icon_' + product_id;
            $.ajax({
                url: "{{ route('admin.product.changeStatus') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {
                    $("#overlay").fadeIn();
                },
                success: function (msg) {
                    if (msg) {
                        if (msg[1] === 1) {
                            $(selector).removeClass('btn-dark');
                            $(selector).addClass('btn-success text-white');
                            $(selector).text('فعال');
                        }
                        if (msg[1] === 0) {
                            $(selector).removeClass('btn-success text-white');
                            $(selector).addClass('btn-dark');
                            $(selector).text('غیر فعال');
                        }
                    }
                    $("#overlay").fadeOut();

                },
                fail: function (error) {
                    console.log(error);
                    $("#overlay").fadeOut();
                }
            })
        }

        function specialSale(product_id) {
            let selector = '#specialSale_icon_' + product_id;
            $.ajax({
                url: "{{ route('admin.product.specialSale') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {
                    $("#overlay").fadeIn();
                },
                success: function (msg) {
                    if (msg) {
                        if (msg[1] === 1) {
                            $(selector).removeClass('btn-dark');
                            $(selector).addClass('btn-success text-white');
                            $(selector).text('فعال');
                        }
                        if (msg[1] === 0) {
                            $(selector).removeClass('btn-success text-white');
                            $(selector).addClass('btn-dark');
                            $(selector).text('غیر فعال');
                        }
                    }
                    $("#overlay").fadeOut();

                },
                fail: function (error) {
                    console.log(error);
                    $("#overlay").fadeOut();
                }
            })
        }

        function Set_as_new(product_id) {
            let selector = '#Set_as_new_icon_' + product_id;
            $.ajax({
                url: "{{ route('admin.product.Set_as_new') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {
                    $("#overlay").fadeIn();
                },
                success: function (msg) {
                    if (msg) {
                        if (msg[1] === 1) {
                            $(selector).removeClass('btn-dark');
                            $(selector).addClass('btn-success text-white');
                            $(selector).text('فعال');
                        }
                        if (msg[1] === 0) {
                            $(selector).removeClass('btn-success text-white');
                            $(selector).addClass('btn-dark');
                            $(selector).text('غیر فعال');
                        }
                    }
                    $("#overlay").fadeOut();

                },
                fail: function (error) {
                    console.log(error);
                    $("#overlay").fadeOut();
                }
            })
        }

        function priority_show_update(product_id, tag) {
            let priority_show = $(tag).val();
            $.ajax({
                url: "{{ route('admin.products.priority_show_update') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                    priority_show: priority_show,
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg) {
                        if (msg[0] == 1) {
                            $('#success_alert').show(500);
                            setTimeout(function () {
                                $('#success_alert').hide(500);
                            }, 3000);
                        }
                    }

                },
                fail: function (error) {
                    console.log(error);
                }
            })
        }

        function priority_show_active(tag) {
            let sort = $(tag).val();
            $.ajax({
                url: "{{ route('admin.setting.priority_show_active') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    sort: sort,
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg) {
                    }
                },
                fail: function (error) {
                    console.log(error);
                }
            })
        }

        function product_copy(product_id) {
            if (confirm('آیا از کپی کردن این کالا اطمینان دارید؟')) {
                $.ajax({
                    url: "{{ route('admin.product.copy') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: product_id,
                    },
                    dataType: "json",
                    type: 'POST',
                    beforeSend: function () {

                    },
                    success: function (msg) {
                        if (msg[0] == 1) {
                            swal({
                                title: 'تبریک',
                                text: 'کالا با موفقیت کپی شد',
                                icon: 'success',
                                timer: 3000,
                            });
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000)
                        }
                    },
                    fail: function (error) {
                        console.log(error);
                    }
                })
            }
        }

        function setting_modal() {
            let modal = $('#setting_modal');
            modal.modal('show');
        }

        function custom_pagination(tag) {
            let per_page = $(tag).val();
            let url = '{{ route('admin.products.pagination',['show_per_page'=>':per_page']) }}';
            url = url.replace(':per_page', per_page);
            window.location.href = url;
        }
    </script>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست محصولات ها ({{ $products->total() }})</h5>
            </div>
            <div class="row d-lg-flex justify-content-between align-items-end">
                <div class="col-md-8 col-12 d-flex align-items-center">
                    <div class="form-group">
                        <label> جست و جو : </label>
                        <div class="input-group input-group-md d-flex flex-row-reverse border-radius">
                            <input type="text" class="form-control form-control-sm"
                                   aria-label="Sizing example input"
                                   aria-describedby="inputGroup-sizing-lg" placeholder="جست و جو..."
                                   id="SearchInput" autocomplete="off">
                            <div class="input-group-prepend border-radius">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"
                                                                        aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mr-2">
                        <label> دسته بندی : </label>
                        <select id="category" class="form-control form-control-sm">
                            <option value="0">نمایش همه</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <label> برند ها : </label>
                        <div class="d-flex">
                            <select id="brand" class="form-control form-control-sm">
                                <option value="0">نمایش همه</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mr-2">
                        <label> مرتب سازی بر اساس : </label>
                        <div class="d-flex">
                            <select style="width: 200px" id="order_by" class="form-control form-control-sm">
                                <option selected value="id_desc">پیش فرض</option>
                                <option value="name_ASC">نام (حروف کوچک به بزرگ)</option>
                                <option value="name_DESC">نام (حروف بزرگ به کوچک)</option>
                                <option value="hit_ASC">hit(افزایشی)</option>
                                <option value="hit_DESC">hit(کاهشی)</option>
                                <option value="product_code-ASC">کد (افزایشی)</option>
                                <option value="product_code-DESC">کد (کاهشی)</option>
                                <option value="price_ASC"> قیمت (افزایشی)</option>
                                <option value="price_DESC">قیمت(کاهشی)</option>
                                <option value="quantity_ASC">موجودی (افزایشی)</option>
                                <option value="quantity_DESC">موجودی (کاهشی)</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group mr-2">
                        <label> جدیدترین و فروش ویژه : </label>
                        <div class="d-flex">
                            <select style="width: 200px" id="new_or_special_product"
                                    class="form-control form-control-sm">
                                <option value="0">نمایش همه</option>
                                <option value="1">محصولات جدید</option>
                                <option value="2">فروش ویژه</option>
                                  <option value="3">محصولات غیر فعال</option>
                            </select>
                            <button type="button" onclick="filter()" class="btn btn-sm btn-danger mr-3">فیلتر</button>
                            <button type="button" id="clearFactorBtn" class="btn btn-sm btn-primary mr-3">پاکسازی
                            </button>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-12">
                    <div class="d-lg-flex justify-content-end align-items-center form-group">
                        <form id="paginate_form" method="get">
                            <select onchange="custom_pagination(this)" name="show_per_page"
                                    class="form-control form-control-sm">
                                <option value="default" {{$show_per_page==1?'selected':''}}>پیش فرض</option>
                                <option value="50" {{$show_per_page==50?'selected':''}}> نمایش 50 تایی</option>
                                <option value="100" {{$show_per_page==100?'selected':''}}> نمایش 100 تایی</option>
                                <option value="200" {{$show_per_page==200?'selected':''}}> نمایش 50 تایی</option>
                                <option value="all" {{$show_per_page==0?'selected':''}}> نمایش همه</option>
                            </select>
                        </form>
                        <div class="mr-3">
                            <button onclick="setting_modal()" title="تنظیمات" class="btn btn-sm btn-info ml-3">
                                <i class="fa fa-cogs"></i>
                            </button>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.create') }}">
                                <i class="fa fa-plus"></i>
                                ایجاد محصول
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>کد کالا</th>
                        <th>hit</th>
                        <th>نام دسته بندی</th>
                        <th>نام برند</th>
                        <th>تصویر اصلی</th>
                        <th>مشخصات فنی</th>
                        <th>رنگ بندی</th>
                        <th>اقلام افزوده</th>
                        <th>ویرایش</th>
                        <th>نمایش</th>
                        <th>فروش ویژه</th>
                        <th>محصولات جدید</th>
                        <th>تعداد</th>
                        <th>اولویت نمایش</th>
                        <th>قیمت (تومان)</th>
                        <th>Copy</th>
                    </tr>
                    </thead>
                    <tbody id="insertRow">
                    @foreach ($products as $key => $product)
                        <tr>
                            <th>
                                {{ $products->firstItem() + $key }}
                            </th>
                            <th class="position-relative">
                                @if(($product->percentSalePrice!=0 && $product->DateOnSaleTo>Carbon\Carbon::now() && $product->DateOnSaleFrom<Carbon\Carbon::now()) or ($product->percentSalePrice!=0 && $product->has_discount==1))
                                    <img class="sale_img" src="{{ asset('admin/images/sale.jpg') }}">
                                @endif
                                <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                                    {{ $product->name }}
                                </a>
                            </th>
                            <th>
                                {{ $product->product_code==null ? '-' : $product->product_code }}
                            </th>
                            <th>
                                {{ $product->hit }}
                            </th>
                            <th>
                                @foreach($product->Categories as $cat)
                                    {{ $cat->name }}
                                    {{ $loop->last ? '' : '/' }}
                                @endforeach
                            </th>
                            <th>
                                {{ $product->brand_id==null ? '-' : $product->brand->name }}
                            </th>
                            <th>
                                <img class="img-thumbnail"
                                     src="{{ imageExist(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH'),$product->primary_image) }}">
                            </th>

                            <th>
                                <a title="مشخصات فنی"
                                   href="{{ route('admin.product.attributes.index',['product'=>$product->id]) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="fa fa-cog"></i>
                                </a>
                            </th>
                            <th>
                                <a title="محصولات دارای رنگ بندی"
                                   href="{{ route('admin.product.variations.attribute.edit',['product'=>$product->id]) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </th>
                            <th>
                                <a title="اقلام افزوده"
                                   href="{{ route('admin.product.options.index',['product'=>$product->id]) }}"
                                   class="btn btn-danger btn-sm">
                                    <i class="fa fa-tasks"></i>
                                </a>
                            </th>
                            <th>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        عملیات
                                    </button>
                                    <div class="dropdown-menu">

                                        <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                           class="dropdown-item text-right"> ویرایش محصول </a>

                                        <a href="{{ route('admin.products.images.edit', ['product' => $product->id]) }}"
                                           class="dropdown-item text-right"> ویرایش تصاویر </a>
                                        <a href="#" class="dropdown-item text-right text-danger"
                                           onclick="RemoveModal({{ $product->id }})">حذف محصول</a>

                                    </div>
                                </div>
                            </th>
                            <th>
                                <a title="نمایش کالا" id="status_icon_{{ $product->id }}"
                                   onclick="productChangeStatus({{ $product->id }})"
                                   class="btn btn-sm {{ $product->getRawOriginal('is_active')==1 ? 'btn-success text-white' : 'btn-dark' }}">
                                    {{ $product->is_active }}
                                </a>
                            </th>
                            <th>
                                <a title="پیشنهاد ویژه" id="specialSale_icon_{{ $product->id }}"
                                   onclick="specialSale({{ $product->id }})"
                                   class="btn btn-sm {{ $product->getRawOriginal('specialSale')==1 ? 'btn-success text-white' : 'btn-dark' }}">
                                    {{ $product->specialSale }}
                                </a>
                            </th>

                            <th>
                                <a title="نمایش در صفحه محصولات جدید" id="Set_as_new_icon_{{ $product->id }}"
                                   onclick="Set_as_new({{ $product->id }})"
                                   class="btn btn-sm {{ $product->getRawOriginal('Set_as_new')==1 ? 'btn-success text-white' : 'btn-dark' }}">
                                    {{ $product->Set_as_new }}
                                </a>
                            </th>

                            <th>
                                {{ $product->quantity }}
                            </th>
                            <th>
                                <input onchange="priority_show_update({{ $product->id }},this)" type="number"
                                       class="form-control" value="{{ $product->priority_show }}" style="width: 70px">
                            </th>
                            <th>
                                {{ number_format($product->price) }}
                            </th>
                            <th>
                                <button onclick="product_copy({{ $product->id }})" class="btn btn-secondary"
                                        type="button">
                                    <i class="fa fa-copy"></i>
                                </button>
                            </th>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row paginate mt-3">
                <div class="col-12">
                    <div class="row justify-content-center">
                        {{ $products->render() }}
                    </div>
                </div>
            </div>
            <div id="overlay">
                <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"></div>
                <br/>
                Loading...
            </div>
        </div>
    </div>
    @include('admin.products.modal')
    @include('admin.products.modal_setting')
    <div id="success_alert">
        <div class="d-flex justify-content-center align-items-center h-100">تغییرات مورد نظر با موفقیت اعمال شد</div>
    </div>
@endsection
