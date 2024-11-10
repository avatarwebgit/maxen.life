@extends('home.layouts.index')

@section('title')
    {{ $brand->name }}
@endsection

@section('keywords')
    {{ $brand->meta_keyword }}
@endsection

@section('description')
    {{ $brand->meta_description }}
@endsection

@section('style')
    <style>
        /* .product{*/
        /*    animation: loadproduct .6s linear 1;*/

        /*}*/
        /*@keyframes loadproduct {*/
        /*from{*/
        /*    transform: scale(0);*/
        /*}*/
        /*    to{*/
        /*        transform: scale(1);*/
        /*    }*/
        /*}*/
        .category-text-mobile {
            display: none;
            margin-bottom: 0 !important;
        }

        @media screen and (max-width: 610px) {
            .category-text-mobile {
                display: inline-block;
            }


        }

        h3 > span {
            margin-right: 18px;
        }

        #load-more {
            display: none;
            width: 80px;
            height: 80px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid orange;
            border-right: 6px solid transparent;
            animation: load-more 1.5s linear infinite;
        }

        .load-more-parent {
            width: 100%;
            display: none;

            text-align: center;;
        }

        @keyframes load-more {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .bg-header-filter {
            background-color: #cbe5f1;
            margin-top: 10px !important;
            border-radius: 5px;
        }

        @media screen and (max-width: 992px) {
            .banner-title {
                font-size: 1.5rem !important;
            }

            .map-link-back {
                margin-top: 15px;
                margin-bottom: 15px;
            }

        }

        .btn-clear-filter {
            width: 100%;
            margin-top: 35px;
            color: white;
            border: none;
            border-radius: 11px;
            padding: 10px;
            background: #5c8097;
            text-align: center;
            cursor: pointer;
        }

        .active-arrow {
            transform: rotate(-90deg);
        }

        .map-link {
            font-size: 12px;
            font-weight: bold;
            color: #000000;
        }

        .map-link-img {
            width: 7px;
            height: 7px;
        }

        .widget-title-arrow i {
            left: 10px;
            position: absolute;
            transition: all .3s ease;

        }

        .btn-filter {
            margin-left: 10px;
            border-radius: 10px;
            padding: 5px 12px;
            font-size: 13px;
            border: 1px solid #5c8097;
            color: #000;
            cursor: pointer;
        }

        .btn-filter:hover {
            color: #fff;
            background-color: #5c8097;
        }

        .btn-filter-selected {
            color: #fff;
            background-color: #5c8097;
        }

        @media screen and (max-width: 800px) {
            .display-none-mobile {
                display: none !important;
            }
        }

        .modal-filter {
            background-color: rgba(0, 0, 0, .6);
            z-index: 999;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            display: none;
            right: 0;
            width: 100%;
            height: 100vh;

        }

        .modal-filter-box {
            background-color: #fff;
            position: absolute;

            top: 0;
            transition: all ease .6s;
            width: 280px;
            margin-right: 50px;
            border-radius: 4px;
            padding: 10px;
            left: 0;
            transform: translate(25%, 50%);
        }

        .box-radio {
            display: flex;

        }

        .box-radio label {
            font-size: 18px !important;
            order: 2;
            margin-right: 10px;
        }

    </style>
@endsection

@section('script')
    <script>
        $('#btn-modal-filter').click(function () {
            $('.modal-filter').fadeToggle();
        })
        $('#btn-close-modal').click(function () {
            $('.modal-filter').fadeOut();
        })
        var total = {{ $products->lastPage() }};
        var current_page = 1;
        $('.btn-clear-filter').click(function () {
            window.location.reload();
        })
        // Price slider Active
        // ----------------------------------*/
        $('#price-range').slider({
            range: true,
            step: 10000,
            min: {{ $cheapest_product }},
            max: {{ $expensive_product }},
            values: [{{ $min_price }}, {{ $max_price }}],
            slide: function (event, ui) {
                $('#price-amount').val(number_format(ui.values[1]) + ' تومان ' + ' - ' + number_format(ui.values[0]) + '  تومان ');
            }
        });
        $('#price-amount').val('{{ number_format($max_price) }}' + ' تومان ' + ' - ' +
            '{{ number_format($min_price) }}' + '  تومان ');


        function filter_products(sort_btn = null, tag = null) {
            let attribute_values = [];
            let page = 1;
            let sort = sort_btn;

            if (tag != null) {
                $('.btn-filter').removeClass('btn-filter-selected');
                $(tag).addClass('btn-filter-selected');
            }
            let price_amount = $('#price-amount').val();
            price_amount = price_amount.replaceAll(',', '');
            price_amount = price_amount.replaceAll('تومان', '');
            price_amount = price_amount.replaceAll(' ', '');
            $('#price_range_filter').val(price_amount);
            $.each($('.attr_filter_ids:checked'), function () {
                attribute_values.push($(this).val());
            });

            $.ajax({
                url: "{{ route('home.products.brand',['brand'=>$brand->alias]) }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    attribute_values: attribute_values,
                    sort: sort,
                    price_amount: price_amount,
                    page: page,
                },
                dataType: "json",
                type: 'get',
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg[0] === 1) {
                        $('#post-data').html(msg[1]);
                        total = msg[2];
                        current_page = 1;

                    }
                }
            })

            // $('#orderby').val(sort);

            // $('#filter_products').submit();
        }

        $('.open_page_description').click(function () {
            let is_open = $(this).attr('data-open');
            let button_html = '';
            if (is_open === 'no') {
                button_html = `نمایش کمتر
                    <i class="fa fa-angle-up ml-3"></i>`;
                $(this).parent().removeClass('page_description');
                $(this).parent().addClass('page_description2');
                $(this).attr('data-open', 'yes');
            } else {
                button_html = `نمایش بیشتر
                    <i class="fa fa-angle-down ml-3"></i>`;
                $(this).parent().removeClass('page_description2');
                $(this).parent().addClass('page_description');
                $(this).attr('data-open', 'no');
            }
            $(this).html(button_html);
        })

        function slideToggleChildren(attr_id, tag) {
            $('#children_attr_' + attr_id).slideToggle();
            $(tag).find('i').toggleClass('active-arrow');
        }


        $(window).scroll(function () {

            if ($(window).scrollTop() >= $('#load-more').offset().top - 900) {


                current_page++;
                loadMoreData(current_page);
            }
        });
function change_sort(sort_id) {
            $('#sort_input').val(sort_id)
            filter_products();
              $('.modal-filter').fadeOut();
        }
        function loadMoreData(current_page) {

            if (current_page > total) {

                // $('.load-more-parent').show() ;
            } else {
                console.log(current_page)
                console.log(total)
                let attribute_values = [];
                     if (window.matchMedia("(max-width: 800px)").matches) {
                    var sort = $('input[name="sort"]:checked').val();
             
                } else {

                    var sort = $('.btn-filter-selected').attr('data-sort');

                }
                let price_amount = $('#price-amount').val();
                price_amount = price_amount.replaceAll(',', '');
                price_amount = price_amount.replaceAll('تومان', '');
                price_amount = price_amount.replaceAll(' ', '');
                $('#price_range_filter').val(price_amount);
                $.each($('.attr_filter_ids:checked'), function () {
                    attribute_values.push($(this).val());
                });

                $.ajax(
                    {
                        url: "{{ route('home.products.brand',['brand'=>$brand->alias]) }}",
                        type: "get",
                        data: {
                            attribute_values: attribute_values,
                            sort: sort,
                            price_amount: price_amount,
                            page: current_page,
                        },
                        beforeSend: function () {
                            $('#load-more').show();
                            $('.load-more-parent').hide();
                        },
                        success: function (data) {

                            setTimeout(function () {
                                if (data[1] == "") {
                                    $('.load-more-parent').show();
                                    $('#load-more').hide();
                                } else {
                                    $("#post-data").html(data[1]);
                                    if (current_page == total) {
                                        $('.load-more-parent').show();
                                        $('#load-more').hide();
                                    }
                                }
                                $('#load-more').hide();
                            }, 1000)
                        }
                    })


            }
        }
    </script>
@endsection

@section('content')
    <!-- Start of Main -->
    <main class="main">
        <div class="page-content mb-10">
            <div class="container-fluid">
                <div class="shop-default-banner banner d-flex align-items-center mb-5 br-xs"
                     style="background-image: url({{ asset('home/images/banner2.jpg') }}); background-color: #FFC74E;padding: 78px;">
                    <div class="banner-content">
                        <h3 class="banner-title text-white size-font text-uppercase font-weight-bolder ls-normal">
                            {{ $brand->name }}
                        </h3>
                    </div>
                </div>
                <nav class="toolbox sticky-toolbox sticky-content fix-top ">
                    <div class="map-link-back">
                        <a class="map-link" href="{{route('home.index')}}">صفحه اصلی</a>


                        <img class="map-link-img" src="{{asset('home/images/arrow_rtl.png')}}"> <a
                            class="map-link">{{$brand->name}}</a>
                    </div>
                    <div class="toolbox-left ">
                        <div class="d-block d-lg-none ">
                            <a style="    padding: 0.93em 1.98em !important;" class="btn btn-blue left-sidebar-toggle
                                        btn-icon-left ">
                                جستجوی پیشرفته


                                <span>فیلتر ها </span>
                            </a>

                            <a id="btn-modal-filter" class="btn  btn-blue mt-5 mb-5">
                                مرتب سازی

                                <i class="fa fa-arrow-alt-circle-up"></i>

                            </a>
                        </div>

                        <div style="margin-right: 16%"
                             class="d-flex align-center justify-content-start display-none-mobile">

                            <span class="mr-3"> ترتیب نمایش:</span>
                           <div class="d-flex justify-content-between ">
                                <a data-sort="0" onclick="filter_products(0,this)"
                                   class=" btn-filter {{ $sort == 0 ? 'btn-filter-selected' : '' }} ">پیش فرض</a>
                                <a data-sort="5" onclick="filter_products(5,this)" class=" btn-filter ">پر فروش ترین</a>
                                <a data-sort="4" onclick="filter_products(4,this)" class=" btn-filter ">ارزان ترین</a>
                                <a data-sort="3" onclick="filter_products(3,this)" class=" btn-filter ">گران ترین</a>
                                <a data-sort="1" onclick="filter_products(1,this)" class=" btn-filter ">جدید ترین</a>
                                <a data-sort="2" onclick="filter_products(2,this)" class=" btn-filter ">قدیمی ترین</a>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- Start of Shop Content -->
                <div class="shop-content row gutter-lg d-flex justify-content-end">
                    <!-- Start of Sidebar, Shop Sidebar -->
                    <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed fixed-top sidebar">
                        <div class="sidebar-overlay"></div>
                        <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                        <div class="sidebar-content scrollable">
                            <div class="d-none common-sidebar-widget">
                                <h3 class="widget-title text-center bg-header-filter">
                                    <span>محدوده قیمت</span>
                                </h3>
                                <div class="sidebar-price">
                                    <div id="price-range" class="mb-20"></div>
                                    <button onclick="filter_products()" type="button"
                                            class="ht-btn black-btn small-btn">
                                        فیلتر
                                    </button>
                                    <input type="text" id="price-amount" class="price-amount" readonly="">
                                    <input type="hidden" id="min-price">
                                    <input type="hidden" id="max-price">
                                </div>
                            </div>
                            <!-- Single Sidebar End  -->
                            <!-- End of Collapsible Widget -->

                            <!-- Start of Collapsible Widget -->
                            <form id="filter_products" method="get">
                                <input type="hidden" name="price_range_filter" id="price_range_filter">
                                <input type="hidden" name="orderby" id="orderby" value="{{ $sort }}">
                                <!-- End of Collapsible Widget -->
                                <!-- Start of Collapsible Widget -->
                                {{--                                //فیلتر مربوط به رنگ--}}
                                <div>
                                    <div class="widget">
                                        @foreach($attributes as $attribute)
                                            <h3 onclick="slideToggleChildren({{ $attribute->id }},this)"
                                                class="widget-title widget-title-arrow text-center bg-header-filter">
                                                <span>{{ $attribute->name }}</span>
                                                <i class="fas fas fa-angle-left"></i>
                                            </h3>
                                            <ul id="children_attr_{{ $attribute->id }}"
                                                class="widget-body filter-items item-check" style="display: none">
                                                @foreach($attribute->AttributeValues()->orderby('priority_show','asc')->whereIn('id',$all_attribute_value_exists_ids)->get() as $attrValue)
                                                    <li>
                                                        <input autocomplete="off" id="attr_filter_{{ $attrValue->id }}"
                                                               onclick="filter_products()"
                                                               type="checkbox" name="attr_filter_ids[]"
                                                               class="attr_filter_ids"
                                                               value="{{ $attrValue->id }}">
                                                        <label
                                                            for="attr_filter_{{ $attrValue->id }}">{{ $attrValue->name }}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </form>
                            <div class="btn-clear-filter btn-rounded" type="button">
                                پاکسازی فیلتر
                            </div>
                        </div>

                    </aside>
                    <!-- End of Shop Sidebar -->

                    <!-- Start of Main Content -->
                    <div class="main-content">
                        <div id="post-data" class="product-wrapper row cols-xl-4 cols-lg-4 cols-md-4 cols-1">
                            @include('home.sections.product_box')
                        </div>

                        <div class="text-center d-flex justify-content-center mt-3 mb-3  pt--20">
                            <div id="load-more" style="cursor: pointer"
                                 class="axil-btn btn-bg-lighter btn-load-more"></div>
                        </div>
                        <div class="text-center  pt--20 mt-3 mb-3 load-more-parent">
                            محصول دیگری وجود ندارد
                        </div>

                        @if($brand->description!=null)
                            <div style="text-align:justify" class="page_description">
                                {!! $brand->description !!}
                            </div>
                        @endif
                    </div>
                    <!-- End of Main Content -->
                </div>
                <!-- End of Shop Content -->
            </div>
        </div>
    </main>
    <!-- End of Main -->
@endsection
