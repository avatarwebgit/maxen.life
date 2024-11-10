@extends('admin.layouts.admin')

@section('title')
    محصولات تکی
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

        #success_alert {
            width: 300px;
            height: 100px;
            background-color: green;
            color: white;
            position: fixed;
            bottom: 50px;
            left: 50px;
            text-align: center;
            border-radius: 5%;
            display: none;
        }

        .text-inherit {
            color: inherit !important;
        }

        input {
            text-align: center !important;
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
            let single_products = JSON.parse(localStorage.getItem("single_products"));
            let single_products_brand = localStorage.getItem('single_products_brand');
            let single_products_category = localStorage.getItem('single_products_category');
            let single_products_search_input = localStorage.getItem('single_products_search_input');
            if (single_products != null) {
                $('#SearchInput').val(single_products_search_input);
                $('#category option[value="' + single_products_category + '"]').prop('selected', true);
                $('#brand option[value="' + single_products_brand + '"]').prop('selected', true);
                filter();
            } else {
                $('#category option:first').prop('selected', true);
                $('#brand option:first').prop('selected', true);
            }
        });

        function update_single_product_quantity(product_id, tag) {
            let quantity = $(tag).val();
            $.ajax({
                url: "{{ route('admin.products.single.update.quantity') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                    quantity: quantity,
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

        function update_single_price(product_id, tag) {
            let price = $(tag).val();
            $.ajax({
                url: "{{ route('admin.products.single.update.update_single_price') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                    price: price,
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
            });
            update_percent_sale_price(product_id, $('#update_percent_sale_price_' + product_id));
        }

        function update_sale_price(product_id, tag) {
            let price = $(tag).val();
            price = price.replaceAll(',', '');
            let original_price = $('#update_single_price_' + product_id).val();
            original_price = original_price.replaceAll(',', '');
            if (parseInt(price) > parseInt(original_price)) {
                price = original_price;
                $(tag).val(price);
            }
            let percent_discount = calculatePercentDiscount(price, original_price);
            $('#update_percent_sale_price_' + product_id).val(percent_discount);
            updatePercentViaAjax(percent_discount, price, product_id)
        }

        function update_percent_sale_price(product_id, tag) {
            let percent_discount = $(tag).val();
            percent_discount = percent_discount.replaceAll(',', '');
            let original_price = $('#update_single_price_' + product_id).val();
            original_price = original_price.replaceAll(',', '');
            if (parseInt(percent_discount) < 0) {
                percent_discount = 0;
            }
            if (parseInt(percent_discount) > 100) {
                percent_discount = 100;
            }
            let Discount = calculateDiscount(percent_discount, original_price);
            $(tag).val(percent_discount);
            $('#update_sale_price_' + product_id).val(Discount);
            updatePercentViaAjax(percent_discount, Discount, product_id)
        }

        function updatePercentViaAjax(percent, discount, product_id) {
            $.ajax({
                url: "{{ route('admin.products.single.updatePercent') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                    percent: percent,
                    discount: discount,
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

        function calculateDiscount(percentDiscount, mainPrice) {
            let Discount = ((100 - percentDiscount) * mainPrice) / 100;
            return Discount;
        }

        function calculatePercentDiscount(discount, mainPrice) {
            let percentDiscount = ((mainPrice - discount) / mainPrice) * 100;
            percentDiscount = parseFloat(percentDiscount).toFixed(3);
            return percentDiscount;
        }

        function price_format(tag) {
            let price = $(tag).val();
            $(tag).val(number_format(price));
        }

        function updateActiveDiscount(product_id) {
            $.ajax({
                url: "{{ route('admin.products.single.updateActiveDiscount') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id
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

        function filter() {
            let brand = $('#brand').val();
            let category = $('#category').val();
            let name = $('#SearchInput').val();
            let sort = $('#sort').val();
            let single_products_ids =@json($single_products_ids);
            $.ajax({
                url: "{{ route('admin.products.single.search') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    brand: brand,
                    category: category,
                    single_products_ids: single_products_ids,
                    sort: sort,
                },
                dataType: "json",
                type: "POST",
                beforeSend: function () {
                    $("#overlay").fadeIn();
                },
                success: function (msg) {
                    if (msg[0] == 1) {
                        //clear localStorage
                        localStorage.removeItem('single_products');
                        localStorage.removeItem('single_products_brand');
                        localStorage.removeItem('single_products_category');
                        localStorage.removeItem('single_products_search_input');
                        //save in localStorage
                        localStorage.setItem("single_products", JSON.stringify(msg[1]));
                        localStorage.setItem('single_products_brand', brand);
                        localStorage.setItem('single_products_category', category);
                        localStorage.setItem('single_products_search_input', name);

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

        $('#clearFactorBtn').click(function () {
            //clear localStorage
            localStorage.removeItem('single_products');
            localStorage.removeItem('single_products_brand');
            localStorage.removeItem('single_products_category');
            localStorage.removeItem('single_products_search_input');
            window.location.reload();
        })

        function custom_pagination(tag) {
            let per_page = $(tag).val();
            let url = '{{ route('admin.products.single.update.pagination',['show_per_page'=>':per_page']) }}';
            url = url.replace(':per_page', per_page);
            window.location.href = url;
        }

        function change_sort() {
            $('#change_sort').submit();
        }

    </script>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست محصولات تکی ({{ $products->total() }})</h5>
            </div>
            <div class="row d-lg-flex justify-content-between align-items-center">
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
                            <button type="button" onclick="filter()" class="btn btn-sm btn-danger mr-3">فیلتر</button>
                            <button type="button" id="clearFactorBtn" class="btn btn-sm btn-primary mr-3">پاکسازی
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 d-flex justify-content-end align-items-center">
                    <form id="change_sort" method="get">
                        <label for="sort">
                            حالت نمایش
                        </label>
                        <select id="sort" onchange="change_sort()" name="sort"
                                class="form-control form-control-sm">
                            <option value="5" {{$sort==5?'selected':''}}>پرفروش ترین</option>
                            <option value="4" {{$sort==4?'selected':''}}>ارزان ترین</option>
                            <option value="3" {{$sort==3?'selected':''}}>گران ترین</option>
                            <option value="1" {{$sort==1?'selected':''}}>جدید ترین</option>
                            <option value="2" {{$sort==2?'selected':''}}>قدیمی ترین</option>
                            <option value="6" {{$sort==6?'selected':''}}>حروف الفبا</option>
                            <option value="7" {{$sort==7?'selected':''}}>موجودی</option>
                        </select>
                    </form>
                    <form id="paginate_form" method="get">
                        <label for="">
                            تعدادنمایش
                        </label>
                        <select onchange="custom_pagination(this)" name="show_per_page"
                                class="form-control form-control-sm">
                            <option value="default" {{$show_per_page==1?'selected':''}}>پیش فرض</option>
                            <option value="50" {{$show_per_page==50?'selected':''}}> نمایش 50 تایی</option>
                            <option value="100" {{$show_per_page==100?'selected':''}}> نمایش 100 تایی</option>
                            <option value="200" {{$show_per_page==200?'selected':''}}> نمایش 200 تایی</option>
                            <option value="all" {{$show_per_page==0?'selected':''}}> نمایش همه</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام دسته بندی</th>
                        <th>برند</th>
                        <th>تصویر اصلی</th>
                        <th>تعداد</th>
                        <th>قیمت(تومان)</th>
                        <th>قیمت با تخفیف</th>
                        <th>درصد تخفیف</th>
                        <th>فعال بودن تخفیف</th>
                        <th>فروش ویژه</th>
                    </tr>
                    </thead>
                    <tbody id="insertRow">
                    @include('admin.products.update.single_product_row')
                    </tbody>
                </table>
            </div>
            <div class="row paginate">
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
    <div id="success_alert">
        <div class="d-flex justify-content-center align-items-center h-100">تغییرات مورد نظر با موفقیت اعمال شد</div>
    </div>
@endsection
