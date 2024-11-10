@extends('home.layouts.index')
@section('description')
{{ $product->meta_des }}
@endsection

@section('keywords')
{{ $product->meta_key }}
@endsection
@section('meta_torob')
    <?php
    if ($product->quantity == 0) {
        $availability = 'outofstock';
    } else {
        $availability = 'instock';
    }
    if ($product->Categories()->count() > 0) {


        foreach ($product->Categories as $category) {
            if ($category->is_sale == 0) {

                $availability = '';
            }
        }
    }
    $price = product_price_for_user_normal($product->id)[0];
    $percent_sale_price = product_price_for_user_normal($product->id)[1];
    $sale_price = product_price_for_user_normal($product->id)[2];
    if ($percent_sale_price == 0) {
        $product['price'] = round($price);
        $product['old_price'] = 0;
    } else {
        $product['price'] = round($sale_price);
        $product['old_price'] = round($price);
    }
    ?>
    <meta name="product_id" content="{{ $product->id }}">
    <meta name="product_name" content="{{ $product->name }}">
    <meta name="product_price" content="{{ $product['price'] }}">
    <meta name="product_old_price" content="{{ $product['old_price'] }}">
    <meta name="availability" content="{{ $availability }}">
    <meta property="og:image"
          content="{{ imageExist(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH'),$product->primary_image) }}">
@endsection

@section('title')
    {{ $product->name }}
@endsection

@section('description')

@endsection

@section('keywords')

@endsection

@section('style')
    <style>
        .offer-title{
         margin-bottom: 5px !important;
        }
        .swal-title {
            font-size: 16px !important;
            font-weight: 400 !important;
        }

        .box-brand {
            text-align: center;
            background: #fff;
            padding: 10px;
        }

        .comment_login {
            background-color: #5c8097;
            color: white;
        }

        .title-link-wrapper-2 {
           border-bottom: 1px solid #999;
        }

        .box-category p {
            width: 100%;
            color: #000;
        }

        .box-brand img {
            width: auto !important;
            height: 100px !important;
        }

        .option_variation_radio {
            border: none;
            background: none;
            padding: 0;
            margin: 0;
        }

        @media screen and (min-width: 780px) {
            .text-title-mobile {
                text-align: right;
            }

            .mobile-flex {
                flex-wrap: wrap;
            }
        }

        input[type='radio'] {
            display: none;
        }

        .deActive {
            background-color: #CCCCCC;
        }

        .ActiveBorder {
            border: 1px solid #8d38b9;
        }

        .variationItem {
            /*width: 142px;*/
            height: auto;
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .display-none {
            display: none;
        }

        .old_price {
            font-size: 17px;
        }

        .btn-box-price {


            padding: 10px !important;
            background-color: #fff !important;
            color: black !important;
            border-color: black !important;
        }

        .discount {
            display: flex;
            width: 60px;
            height: 60px;
            border-radius: 100%;
            color: white;
            text-align: center;
            background: #054605;
            vertical-align: middle;
            justify-content: center;
            align-items: center;
        }

        .product_productInfoRightSide__04W6P > div {
            display: flex;
            flex-wrap: wrap;
        }

        .product_technical__qvJms {
            width: auto;
            /*min-height: 312px;*/
            margin-left: 2%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: baseline;
            margin-top: 30px;
        }

        .product_technical__qvJms > header {
            font-weight: 700;
            color: #666;
            font-size: 16px;
            margin-bottom: 10px !important;
        }

        .product_technical__qvJms > ul {
            width: 100%;
        }

        .product_productInfoRightSide__04W6P > div > * {
            margin-bottom: 10px;
        }

        .product_technical__qvJms > ul > li:first-of-type {
            border-top: 1px solid #eee;
        }

        /*.product_technical__qvJms-2{*/
        /*    min-height: 224px !important;*/
        /*}*/

        .product_technical__qvJms > ul > li {
            height: 57px;
            display: flex;
            border-bottom: 1px solid #eee;
        }

        .product-title {
            font-size: 2rem !important;
            text-align: justify !important;
        }

        .product_technical__qvJms > ul > li > span {
            width: 68px;
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #d3e3f2;
        }

        .label-variationItem {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            height: 100% !important;
            margin-right: -15px !important;
        }

        .product_technical__qvJms > ul > li > h3 {
            width: calc(100% - 68px);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            padding: 4px 8px 4px 0;
            font-size: 14px;
            color: #1e3b58;
            font-weight: 400;
        }

        #quantityBox {
            display: none !important;
        }

        .product-title {
            margin: 10px 0;
        }

        .arrow_icon {
            width: 20px;
            height: auto;
        }

        .variationSelected .variations {


            background-color: #6a91aa !important;
            color: #fff;
            border-color: #6a91aa !important;
        }

        .color_product {
            font-size: 17px;
        }

        .variationSelected {
            border: none !important;
        }

        .control-label {
            border-top: 1px solid #ddd !important;
            margin-top: 20px !important;
            padding-top: 20px !important;
            font-size: 19px !important;;
        }

        .product_color-2 {
            background-color: #5c8097
        }

        #ck_editor_paragraph > li {
            color: black !important;
        }

        #quantity {
            border: none !important;
            font-size: 18px;
            font-family: IRANSansfanum !important;

        }

        .product-qty-form.with-label {
            font-size: 21px;
            border: 1px solid black;
            padding: 6px;
            border-radius: 5px;
        }

        #getAllProductColors .ActiveBorder {
            background-color: #6a91aa !important;
            color: #fff;
            border-color: #6a91aa !important;
        }

        .option_variation_checkbox {
            border: none;
            padding: 0;
            background: none;
            margin: 0;
        }

        .box-category {
            margin-top: 10px;
        } 
        
        .swal-title {
            font-size: 16px !important;
            font-weight: 400 !important;
        }
              .btn-box-price{
            border-radius: 8px;
            border: 1px solid;
        }
        
     
        #addToCartBtn{
            padding:14px !important;
        }
           .info-text{
            font-weight: 800;
    font-size: 14px;
        }
    </style>
@endsection

@section('script')
    <script>
        function comment_login2(product_id) {
            $.ajax({
                url: "{{route('comment_login')}}",
                type: "POST",
                dataType: "json",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                },
                success: function (msg) {
                    if (msg[1] == 'login') {
                        window.location.href = msg[2];
                    }
                },
                error: function (msg) {
                    console.log('yyyy');
                },
            });
        }

        $(document).ready(function () {
            $('input').prop('checked', false);
            $('.product_color').find('input').prop('checked', false);
            let product_colors = {{ count($product_colors) }};
            let product_variation = {{ count($product_attr_variations_categories) }};
            if (product_colors == 1) {
                $("input[name='product_color']").trigger('click');
            }
            if (product_variation == 1) {
                $("input[name='product_attr_variation_categories']").trigger('click');
            }
        })

        function change_quantity(type) {
            let quantity = $('#quantity').val();
            if (type == 1) {
                quantity = parseInt(quantity) + 1;
            } else {
                quantity = parseInt(quantity) - 1;
            }
            if (quantity == 0) {
                quantity = 1;
                $('#quantity').val(quantity);
            } else {
                $('#quantity').val(quantity);
            }


        }

        function getProductColors(attr_value, product_id, tag) {
            $('.colors').removeClass('ActiveBorder');
            $('.variations').removeClass('deActive');
            $(tag).parents('span').addClass('ActiveBorder');
            let color_id = null;
            if ($("input[name='product_color']").is(':checked')) {
                color_id = $("input[name='product_color']:checked").val();
            }
            $.ajax({
                url: "{{ route('home.getProductColors') }}",
                data: {
                    attr_value: attr_value,
                    product_id: product_id,
                    color_id: color_id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                method: "post",
                success: function (msg) {
                    if (msg[0] == 1) {
                        let array = msg[1];
                        $("input[name='product_color']").attr('disabled', false);
                        $.each(array, function (color_id, quantity) {
                            if (quantity == 0) {
                                $('#product_color_' + color_id).parents('label').remove();
                                // $('#product_color_' + color_id).attr('disabled', true);
                                // $('#product_color_' + color_id).parents('span').addClass('deActive');
                                // $('#product_color_' + color_id).removeAttr('onclick');
                            }
                            if (quantity != 0) {
                                $('#product_color_' + color_id).attr('disabled', false);
                                $('#product_color_' + color_id).attr('onclick', 'getAttributeVariation(' + color_id + ',' + product_id + ',this)');

                            }
                        })
                        if (msg[2] != false) {
                            $('#priceBox').html(msg[2]);
                            $('#quantityBox').html(msg[3]);
                            extraPrice();
                        }
                    }
                }
            })
        }

        function getAttributeVariation(color_id, product_id, tag) {
            $('.variations').removeClass('ActiveBorder');
            $('.colors').removeClass('deActive');
            $(tag).parents('span').addClass('ActiveBorder');
            let attr_value = null;
            if ($("input[name='product_attr_variation_categories']").is(':checked')) {
                attr_value = $("input[name='product_attr_variation_categories']:checked").val();
            }
            $.ajax({
                url: "{{ route('home.getAttributeVariation') }}",
                data: {
                    attr_value: attr_value,
                    color_id: color_id,
                    product_id: product_id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                method: "post",
                success: function (msg) {
                    if (msg[0] == 1) {
                        let array = msg[1];
                        let image = msg[4];
                        $("input[name='product_attr_variation_categories']").attr('disabled', false);
                        $.each(array, function (attr_value, quantity) {
                            if (quantity == 0) {
                                $('#product_attr_variation_categories_' + attr_value).parents('label').remove();
                                // $('#product_attr_variation_categories_' + attr_value).attr('disabled', true);
                                // $('#product_attr_variation_categories_' + attr_value).parents('span').addClass('deActive');
                                // $('#product_attr_variation_categories_' + attr_value).next('label').removeAttr('onclick');
                            }
                            if (quantity != 0) {
                                $('#product_attr_variation_categories_' + attr_value).attr('disabled', false);
                                $('#product_attr_variation_categories_' + attr_value).next('label').attr('onclick', 'getProductColors(' + attr_value + ',' + product_id + ',this)');
                            }
                        })
                        if (image != null) {
                            $('.swiper-slide-active').find('.product-image').find('img').attr('src', image);
                        }
                        if (msg[2] != false) {
                            $('#priceBox').html(msg[2]);
                            $('#quantityBox').html(msg[3]);
                            extraPrice();
                        }
                    }
                }
            })
        }

        $('.btn-filter-clear').click(function () {
            window.location.reload();
            // getAllProductVariations();
            // getAllProductColors();
            // let alert_message = `<div class="alert alert-danger text-center">انتخاب رنگ و مدل الزامی است</div>`;
            // $('#priceBox').html(alert_message);
            // $('#quantityBox').html('');
        })

        function getAllProductVariations() {
            $.ajax({
                url: "{{ route('home.getAllProductVariations') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: "{{ $product->id }}",
                },
                dataType: "json",
                method: "post",
                success: function (msg) {
                    $('#product_attr_variations_categories').html('');
                    if (msg[0] == 1) {
                        $('#product_attr_variations_categories').html(msg[1]);
                    }
                }
            })
        }

        function getAllProductColors() {
            $.ajax({
                url: "{{ route('home.getAllProductColors') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: "{{ $product->id }}",
                },
                dataType: "json",
                method: "post",
                success: function (msg) {
                    $('#getAllProductColors').html('');
                    if (msg[0] == 1) {
                        $('#getAllProductColors').html(msg[1]);
                    }
                }
            })
        }

        function check_product_variation_selected() {
            let product_variation = {{ count($product_attr_variations_categories) }};
            let product_colors = {{ count($product_colors) }};
            let add_to_cart_continue = 1;
            let color_id = null;
            let variation_id = null;
            if (product_colors > 0) {
                if ($("input[name='product_color']").is(':checked')) {
                    color_id = $("input[name='product_color']:checked").val();
                } else {
                    let message = 'انتخاب رنگ الزامی است';
                    swal({
                        title: 'دقت کنید',
                        text: message,
                        icon: 'warning',
                        timer: 5000,
                        buttons: false,
                    });
                    add_to_cart_continue = 0;
                }
            }
            if (product_variation > 0) {
                if ($("input[name='product_attr_variation_categories']").is(':checked')) {
                    variation_id = $("input[name='product_attr_variation_categories']:checked").val();
                } else {
                    let message = 'انتخاب مدل الزامی است';
                    swal({
                        title: 'دقت کنید',
                        text: message,
                        icon: 'warning',
                        timer: 3000,
                    });
                    add_to_cart_continue = 0;
                }
            }
            return [add_to_cart_continue, color_id, variation_id];
        }

        function check_product_option_selected() {
            <?php
            $option_group = [];
            foreach ($product_options_attributes as $product_options_attribute) {
                $attribute = \App\Models\Attribute::where('id', $product_options_attribute)->first();
                $option_group[$product_options_attribute] = $attribute;
            }
            ?>
            let option_group =@json($option_group);
            let add_to_cart_continue = 1;
            $.each(option_group, function (i, val) {
                if (val.limit_select == 1) {
                    let value = $('#option_group_' + i).val();
                    if (value == '') {
                        let message = 'انتخاب ' + val.name + ' الزامی است';
                        swal({
                            title: 'دقت کنید',
                            text: message,
                            icon: 'warning',
                            timer: 5000,
                            buttons: false,
                        });
                        add_to_cart_continue = 0;
                    }
                }
            })
            return add_to_cart_continue;
        }

        function extraPrice(product_options_attribute, tag, attribute) {
            if (attribute == 1) {
                $('.option_variation_radio').removeClass('variationSelected');
                $(tag).parent().addClass('variationSelected');
            }
            if (attribute == 0) {
                $('.option_variation_checkbox').removeClass('variationSelected');
                if ($('input[value="' + $(tag).val() + '"]').prop('checked') == true) {
                    $('input[name="attrs_' + product_options_attribute + '"]').prop('checked', false);
                    $('input[value="' + $(tag).val() + '"]').prop('checked', true);
                } else {
                    $('input[name="attrs_' + product_options_attribute + '"]').prop('checked', false);
                }


            }
            $('#option_group_' + product_options_attribute).val(product_options_attribute);
            var attr = [];
            $.each($("input[data-id='extra_option']:checked"), function () {
                attr.push($(this).val());
                $(this).parent().addClass('variationSelected');
            });

            $('#product_option').val(attr);
            $.ajax({
                url: "{{ route('home.variation.getPrice') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    attr_ids: attr,
                },
                dataType: 'json',
                method: 'post',
                success: function (msg) {
                    if (msg[0] == 1) {
                        //add price
                        let product_price = $('.product_final_price').val();
                        let previous_product_price = $('.previous_product_price').val();
                        let attr_price = msg[1];
                        let final_price = parseInt(attr_price) + parseInt(product_price);
                        let previous_product_final_price = parseInt(attr_price) + parseInt(previous_product_price);

                        $('.product_final_price_span').text(number_format(final_price));
                        $('.previous_product_price_span').text(number_format(previous_product_final_price));
                        //add span
                        let titles = msg[2];
                        let titles_span = '';
                        $.each(titles, function (i, title) {
                            titles_span = titles_span + `<span class="variationItem" style="font-size: 9pt">${title}</span>`;
                        });
                        // $('.extra_attr').html(titles_span);
                    }
                }
            })
        }

        $('#addToCartBtn').click(function () {
            //check color and variation selected
            check_product_variation_selected();
            //check product_option selected
            check_product_option_selected();
            if (check_product_option_selected() == 1 & check_product_variation_selected()[0] == 1) {
                var option_ids = [];
                $.each($("input[data-id='extra_option']:checked"), function () {
                    option_ids.push($(this).val());
                });
                let product_id = "{{ $product->id }}";
                let product_has_option = {{ count($product_options) }};
                let quantity = $('#quantity').val();
                let variation_id = check_product_variation_selected()[2];
                let color_id = check_product_variation_selected()[1];
                let product_has_variation = {{ count($product_attr_variations_categories) }};
                let product_has_color = {{ count($product_colors) }};
                let is_single_page = 1;
                AddToCart(product_id, quantity, is_single_page, product_has_variation, variation_id, product_has_color, color_id, product_has_option, option_ids);
            }
        })

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        function open_tab_group(tag, attr_group_id) {
            $('#attr_group_table_' + attr_group_id).slideToggle(500);
            $(tag).find('.left_icon').toggleClass('d-none');
            $(tag).find('.down_icon').toggleClass('d-none');
        }
    </script>
@endsection

@section('content')

    <main class="main">

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav container">
            <ul class="product-nav list-style-none">
                @if($previous_product!=null)
                    <li class="product-nav-prev">
                        <a href="{{ route('home.product',['alias'=>$previous_product->alias]) }}">
                            <i class="w-icon-angle-right"></i>
                        </a>
                        <span class="product-nav-popup">
                            <img
                                src="{{ imageExist(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH'),$previous_product->primary_image) }}"
                                alt="Product"
                                width="110"
                                height="110"/>
                            <span class="product-name">{{ $previous_product->name }}</span>
                        </span>
                    </li>
                @endif
                @if($next_product!=null)
                    <li class="product-nav-next"><a href="{{ route('home.product',['alias'=>$next_product->alias]) }}">
                            <i class="w-icon-angle-left"></i>
                        </a>
                        <span class="product-nav-popup">
                            <img
                                src="{{ imageExist(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH'),$next_product->primary_image) }}"
                                alt="Product"
                                width="110"
                                height="110"/>
                            <span class="product-name">{{ $next_product->name }}</span>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="product product-single row">
                   @if(product_price_for_user_normal($product->id)[2]>200000000)
                        <div class="col-12">
                            <div class="alert alert-info text-center mb-2 price_alert">
                           برای خرید محصولات بیش از 200 میلیون تومان لازم است موجودی کیف پول خود را افزایش دهید
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6 mb-6">
                        <div class="product-gallery product-gallery-sticky product-gallery-vertical">
                            <div class="swiper-container product-single-swiper swiper-theme nav-inner"
                                 data-swiper-options="{
                                    'navigation': {
                                        'nextEl': '.swiper-button-next',
                                        'prevEl': '.swiper-button-prev'
                                    }
                                }">
                                <div class="swiper-wrapper row cols-1 gutter-no">
                                    <div class="swiper-slide product">
                                        <div class="product-label">
                                            @if($product->label>0)
                                                <span class="custom_label"
                                                      style="background-color: {{ $product->Label->color }}">{{ $product->Label->name }}</span>
                                            @endif
                                        </div>
                                        <figure class="product-image">
                                            <img
                                                src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$product->primary_image) }}"
                                                data-zoom-image="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$product->primary_image) }}"
                                                alt="{{ $product->name }}" width="800" height="900">
                                        </figure>
                                    </div>
                                    @if($product_image_2!=null)
                                    <div class="swiper-slide">
                                        <figure class="product-image">
                                            <img
                                                src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),  $product_image_2) }}"
                                                data-zoom-image="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),  $product_image_2) }}"
                                                alt="{{ $product->name }}" width="800" height="900">
                                        </figure>
                                    </div>
                                    @endif
                                    @foreach($AllProductImages as $image)
                                        @if($image!=null)
                                            <div class="swiper-slide">
                                                <figure class="product-image">
                                                    <img
                                                        src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$image) }}"
                                                        data-zoom-image="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$image) }}"
                                                        alt="{{ $product->name }}" width="800" height="900">
                                                </figure>
                                            </div>
                                        @endif
                                    @endforeach
                                    <!--@if(count($product_attr_Variation_Images)>0)-->
                                    <!--    @foreach($product_attr_Variation_Images as $image)-->
                                    <!--        <div class="swiper-slide">-->
                                    <!--            <figure class="product-image">-->
                                    <!--                <img-->
                                    <!--                    src="{{ imageExist(env('PRODUCT_VARIATION_COLOR_UPLOAD_PATH'),$image->image) }}"-->
                                    <!--                    data-zoom-image="{{ imageExist(env('PRODUCT_VARIATION_COLOR_UPLOAD_PATH'),$image->image) }}"-->
                                    <!--                    alt="{{ $product->name }}" width="800" height="900">-->
                                    <!--            </figure>-->
                                    <!--        </div>-->
                                    <!--    @endforeach-->
                                    <!--@endif-->
                                </div>
                                <button class="swiper-button-next"></button>
                                <button class="swiper-button-prev"></button>
                                <a style="right:0" href="#" class="product-gallery-btn product-image-full"><i
                                        class="w-icon-zoom"></i></a>
                            </div>
                            <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                                    'navigation': {
                                        'nextEl': '.swiper-button-next',
                                        'prevEl': '.swiper-button-prev'
                                    },
                                    'breakpoints': {
                                        '992': {
                                            'direction': 'vertical',
                                            'slidesPerView': 'auto'
                                        }
                                    }
                                }">
                                <div class="product-thumbs swiper-wrapper row cols-lg-1 cols-4 gutter-sm">
                                    <div class="product-thumb swiper-slide">
                                        <img
                                            src="{{ imageExist(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH'),$product->primary_image) }}"
                                            alt="Product Thumb"
                                            width="800" height="900">
                                    </div>
                                    @if($product_image_2!=null)
                                    <div class="product-thumb swiper-slide">
                                        <img
                                            src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$product_image_2) }}"
                                            alt="Product Thumb"
                                            width="800" height="900">
                                    </div>
                                    @endif
                                    @foreach($AllProductImages as $image)
                                        @if($image!=null)
                                            <div class="product-thumb swiper-slide">
                                                <img
                                                    src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$image) }}"
                                                    alt="Product Thumb"
                                                    width="800" height="900">
                                            </div>
                                        @endif
                                    @endforeach
                                    <!--@if(count($product_attr_Variation_Images)>0)-->
                                    <!--    @foreach($product_attr_Variation_Images as $image)-->
                                    <!--        <div class="product-thumb swiper-slide">-->
                                    <!--            <img-->
                                    <!--                src="{{ imageExist(env('PRODUCT_VARIATION_COLOR_UPLOAD_PATH'),$image->image) }}"-->
                                    <!--                alt="Product Thumb"-->
                                    <!--                width="800" height="900">-->
                                    <!--        </div>-->
                                    <!--    @endforeach-->
                                    <!--@endif-->
                                </div>
                                <button class="swiper-button-prev"></button>
                                <button class="swiper-button-next"></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 mb-md-6">
                        <div class="product-details">
                            <h1 class="product-title">
                                {{ $product->name }}
                            </h1>
                            <div class="product-bm-wrapper">
                                @if(isset($product->Brands))
                                    @foreach($product->Brands as $brand)

                                        <figure class="brand">
                                            <img src="{{ imageExist(env('BRAND_UPLOAD_PATH'),$brand->image) }}"
                                                 alt="Brand" width="105"
                                                 height="48"/>

                                            <p class="text-center">{{$brand->name}}</p>
                                        </figure>
                                    @endforeach
                                @endif
                                <div class="product-meta">
                                    <div class="product-categories">
                                        دسته بندی:
                                        <span class="product-category">
                                            @foreach($product->Categories as $key=>$category)
                                                <a href="{{ route('home.product_categories',['category'=>$category->alias]) }}">{{ $category->name }}</a>
                                                {{ $loop->last ? '' : '/' }}
                                            @endforeach
                                        </span>
                                    </div>
                                    @if($product->product_code!=null)
                                        <div class="product-sku">
                                            کد: <span>{{  $product->product_code }}</span>
                                        </div>
                                    @endif
                                    <!--<div class="ratings-container comment-rating mt-3">-->
                                    <!--    <div-->
                                    <!--        class="{{ ceil($product->rates->where('product_id',$product->id)->avg('rate'))==0 ? 'emptyStar' : '' }}"-->
                                    <!--        data-rating-stars="5"-->
                                    <!--        data-rating-readonly="true"-->
                                    <!--        data-rating-value="{{ ceil($product->rates->where('product_id',$product->id)->avg('rate')) }}">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                            @php
                                $i=0;
                            @endphp
                            @foreach($product_attributes_original as $product_attribute)
                                @if($product_attribute->is_active==1)
                                    @php
                                        $i=1;
                                    @endphp
                                @endif
                            @endforeach
                            @if($i==1)
                                <div class="product_technical__qvJms product_technical__qvJms-2">

                                    <ul>
                                        <hr style="margin:6px 0 !important">
                                        @foreach($product_attributes_original as $product_attribute)
                                            @if($product_attribute->is_active==1)
                                                <li style="border-bottom:none;border-top:none"
                                                    class="order_summary_pdp">
                                                    <span>
                                                        <img class="img-thumbnail"
                                                             src="{{ imageExist(env('ATTR_UPLOAD_PATH'),$product_attribute->attribute->image) }}">
                                                    </span>
                                                    <h3>
                                                        <span>
                                                            <span>{{ $product_attribute->attribute->name }}:</span>
                                                            @php
                                                                $attribute_values=$product_attribute->attributeValues($product_attribute->value,$product_attribute->attribute_id);
                                                            @endphp
                                                            @if($attribute_values==null)
                                                                {{ $product_attribute->value }}
                                                            @else
                                                                {{ $attribute_values->name }}
                                                            @endif
                                                        </span>
                                                    </h3>
                                                </li>
                                            @endif
                                        @endforeach
                                        <hr style="margin:6px 0 !important">
                                    </ul>
                                </div>
                            @endif
                            @if(count($product->ProductColor)>0)
                                <div class="color_product mt-3 mb-3">
                                    <h4>رنگ بندی:</h4>
                                    <div id="getAllProductColors" class="flex-wrap d-flex"
                                         style="margin: 10px 0 !important;">
                                        @php
                                            $color=$product->attributes()->where('attribute_id',13)->first()->value;
                                            $val=\App\Models\AttributeValues::where('id',$color)->first();
                                        @endphp
                                        <label>
                                            <a href="{{ route('home.product',['alias'=>$product->alias]) }}">
                                    <span class="product_color product_color-2 variations text-white">

                                        {{ $val->name }}
                                    </span>
                                            </a>
                                        </label>
                                        @foreach($product->ProductColor as $product_color)
                                            @php
                                                $color=$product_color->attributes()->where('attribute_id',13)->first()->value;
                                                $val=\App\Models\AttributeValues::where('id',$color)->first();
                                            @endphp

                                            <label>
                                                <a href="{{ route('home.product',['alias'=>$product_color->alias]) }}">
                                    <span class="product_color variations variations2">

                                        {{ $val->name }}
                                    </span>
                                                </a>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(count($product_colors)>0)
                                <h4>رنگ بندی:</h4>
                                <div id="getAllProductColors"
                                     class="flex-wrap {{ $product_colors[0]->Color->id==346 ? 'd-none' : 'd-flex' }}"
                                     style="margin: 10px 0 !important;">

                                    @foreach($product_colors as $product_color)
                                        <label for="product_color_{{ $product_color->Color->id }}">
                                    <span class="product_color variations">

                                     <input
                                         onclick="getAttributeVariation({{ $product_color->Color->id }},{{ $product->id }},this)"
                                         type="radio" name="product_color"
                                         id="product_color_{{ $product_color->Color->id }}"
                                         value="{{ $product_color->Color->id }}"
                                     >
                                    {{ $product_color->Color->name }}
                                    </span>
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                            @if(count($product_options)>0)
                                <div class="mb-5">
                                    @foreach($product_options_attributes as $product_options_attribute)
                                        <div class="control-label mb-3"
                                        >{{ \App\Models\Attribute::where('id',$product_options_attribute)->first()->name }}:</div>
                                        <ul class="mb-3 d-flex flex-wrap">
                                                <?php
                                                $i = 0;
                                                ?>
                                            @foreach($product_options as $key=>$product_option)
                                                @if($product_options_attribute==$product_option->attribute_id)
                                                        <?php
                                                        $i++;
                                                        $attribute = \App\Models\Attribute::where('id', $product_options_attribute)->first()->limit_select;
                                                        if ($attribute == 1) {
                                                            $class = 'option_variation_radio';
                                                        } else {
                                                            $class = 'option_variation_checkbox';
                                                        }
                                                        ?>
                                                    <span class="variationItem {{ $class }}">
                                                                <input style="display:none"
                                                                       onclick="extraPrice({{ $product_options_attribute }},this,{{ $attribute }})"
                                                                       data-id="extra_option"
                                                                       id="attr_{{ $product_option->id }}"
                                                                       name="attrs_{{ $product_options_attribute }}"
                                                                       type="{{ $attribute==1 ? 'radio' : 'checkbox'  }}"
                                                                       value="{{ $product_option->id }}"
{{--                                                                {{ ($attribute==1 and $i==1) ? 'checked' : '' }}--}}
                                                                >
                                                        <input type="hidden"
                                                               id="option_group_{{ $product_options_attribute }}"
                                                               value="@if($attribute==1 and $i==1)@else{{ $product_options_attribute }}@endif"
                                                        >
                                                                <label class="product_color variations"

                                                                       for="attr_{{ $product_option->id }}">{{ $product_option->VariationValue->name }}</label>
                                                       </span>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </div>
                            @endif
                            <div class="product-short-desc lh-2">
                                {!! $product->shortDescription !!}
                            </div>
                              @if($product->quantity>0)
                            @if(product_price_for_user_normal($product->id)[1]!=0)
                                <div class="old_price d-flex justify-content-between align-items-center">
                                    <span>
                                         <del>
                                        {{ number_format(product_price_for_user_normal($product->id)[0]) }}
                                    </del>
                                    تومان
                                    </span>
                                    <span style="width: 50px;
    height: 50px;"
                                          class="discount">{{ number_format(product_price_for_user_normal($product->id)[1]).' % ' }}</span>
                                </div>
                            @endif
@endif
                            <div id="priceBox">
                                <div class="single-product-price">
                                    <div style="height: 54px;" class="btn btn-box-price btn-block btn-primary">
                                        <p class="price new-price m-0">
                                            @if(product_price_for_user_normal($product->id)[2]==0 or $product->quantity==0)
                                                <span class="product_final_price_span">اتمام موجودی</span>
                                            @else
                                                <span>قیمت:<span style="font-weight:800;margin-right: 8px;"
                                                                 class="product_final_price_span">{{ number_format(product_price_for_user_normal($product->id)[2]) }}</span> تومان</span>
                                                <input class="product_final_price" type="hidden"
                                                       value="{{ product_price_for_user_normal($product->id)[2] }}">
                                            @endif
                                        </p>
                                    </div>
                                    <input type="hidden" id="" value="">
                                </div>
                            </div>


                            <div id="quantityBox">
                                <p class="regular-price oldPrice">
                                    <span>تعداد موجود در انبار :<span>{{ $product->quantity }}</span> عدد </span>
                                </p>
                            </div>
                            @if(!$is_sale)
                                <div
                                    class="fix-bottom product-sticky-content sticky-content alert alert-info text-center my-3">
                                    متاسفانه در حال حاضر امکان فروش این کالا وجود ندارد
                                </div>
                            @else
                                @auth
                                        <?php
                                        $user = auth()->user();
                                        ?>
                                    @if($user->getRawOriginal('role')==3 and $product->sale_for_legal==0)
                                        <div
                                            class="fix-bottom product-sticky-content sticky-content alert alert-info text-center my-3">
                                            خرید این کالا فقط برای کاربران حقیقی امکان‌پذیر است
                                        </div>
                                    @else
                                        <div class="fix-bottom product-sticky-content sticky-content">
                                            <div class="product-form container mt-3">
                                                {{--                                                <div class="product-qty-form with-label">--}}
                                                {{--                                                    <label>تعداد:</label>--}}
                                                {{--                                                    <input id="quantity" class="form-control" type="number"--}}
                                                {{--                                                           min="{{ $product->minimum_measure_to_order }}"--}}
                                                {{--                                                           value="{{ $product->minimum_measure_to_order }}">--}}
                                                {{--                                                </div>--}}
                                                <div style="max-width:181px !important;"
                                                     class="product-qty-form with-label">
                                                    <label>تعداد:</label>
                                                    <i style="margin-left: 10px;cursor: pointer;   font-size: 14px;"
                                                       onclick="change_quantity(0)" class="fa fa-minus"></i>
                                                    <input style="width: 36px" readonly
                                                           class="text-center quantity-input number-input"
                                                           id="quantity"
                                                           min="{{ $product->minimum_measure_to_order }}" max="100000"
                                                           value="{{ $product->minimum_measure_to_order }}">
                                                    <i style="margin-left: 49px;cursor: pointer ;  font-size: 14px;"
                                                       onclick="change_quantity(1)" class="fa fa-plus"></i>
                                                </div>

                                                @if($product->quantity==0 or product_price_for_user_normal($product->id)[2]==0)
                                                    <button onclick="informMe({{ $product->id }})"
                                                            title="موجود شد به من اطلاع بده"
                                                            type="button" class="btn btn-primary btn-cart">
                                                        <i class="fas fa-bell"></i>
                                                        <span>موجود شد به من اطلاع بده</span>
                                                    </button>
                                                @else
                                                    <button id="addToCartBtn" class="btn btn-blue btn-cart">
                                                        <i class="w-icon-cart"></i>
                                                        <span>افزودن به سبد خرید</span>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="fix-bottom product-sticky-content sticky-content">
                                        <div class="product-form container mt-3">
                                            {{--                                            <div class="product-qty-form with-label">--}}
                                            {{--                                                <label>تعداد:</label>--}}
                                            {{--                                                <input id="quantity" class="form-control" type="number"--}}
                                            {{--                                                       min="{{ $product->minimum_measure_to_order }}"--}}
                                            {{--                                                       value="{{ $product->minimum_measure_to_order }}">--}}
                                            {{--                                            </div>--}}
                                            <div style="max-width:181px !important;"
                                                 class="product-qty-form with-label">
                                                <label>تعداد:</label>
                                                <i style="margin-left: 10px;cursor: pointer  ;  font-size: 14px;"
                                                   onclick="change_quantity(0)" class="fa fa-minus"></i>
                                                <input style="width: 36px" readonly
                                                       class="text-center quantity-input number-input"
                                                       id="quantity"
                                                       min="{{ $product->minimum_measure_to_order }}" max="100000"
                                                       value="{{ $product->minimum_measure_to_order }}">
                                                <i style="margin-left: 49px;cursor: pointer;    font-size: 14px;"
                                                   onclick="change_quantity(1)" class="fa fa-plus"></i>
                                            </div>
                                            @if($product->quantity==0 or product_price_for_user_normal($product->id)[2]==0)
                                                <button onclick="informMe({{ $product->id }})"
                                                        title="موجود شد به من اطلاع بده"
                                                        type="button" class="btn btn-primary btn-cart">
                                                    <i class="fas fa-bell"></i>
                                                    <span>موجود شد به من اطلاع بده</span>
                                                </button>
                                            @else
                                                <button id="addToCartBtn" class="btn btn-primary btn-cart">
                                                    <i class="w-icon-cart"></i>
                                                    <span>افزودن به سبد خرید  </span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endauth
                            @endif

                        @php
                            
                            $setting = \App\Models\Setting::first();
                            @endphp
                            
                            @if($setting->is_active_text_pish_factor)
                            <div style="padding-right: 0px !important;padding-left:10px !important" class="container">
                                <div class="row">
                                    <div class="col-sm-12 col-md-10 mt-2">
                                        <p class=" text-right info-text fw-800">
                                             {{$setting->text_pish_factor}}
                                        </p>
                                    </div>
                                    <div class="col-sm-12 text-center col-md-2">
                                        <a style="border-radius:10px" class="btn cursor-pointer border-1" href="https://profilesaze.com/page/Factor">
                                            راهنما
                                        </a>
                                    </div>
                                </div>
                            </div>
                           @endif

                            @if(count($product_attr_variations_categories)>1 and count($product_colors)>1)
                                <div class="d-flex flex-wrap" style="margin: 10px 0 !important;">
                                    <button class="btn btn-primary btn-filter-clear">
                                        <span>پاکسازی فیلتر</span>
                                    </button>
                                </div>
                            @endif
                            @if(count($product_attr_variations_categories)>0)
                                <div id="product_attr_variations_categories"
                                     class="{{ $product_attr_variations_categories[0]->AttributeValue->id==217 ? 'd-none' : 'd-flex' }} flex-wrap"
                                     style="margin: 10px 0 !important;">
                                    @foreach($product_attr_variations_categories as $item)
                                        <label for="product_attr_variation_categories_{{ $item->AttributeValue->id }}">
                                    <span class="product_color colors">
                                     <input onclick="getProductColors({{ $item->attr_value }},{{ $product->id }},this)"
                                            type="radio" name="product_attr_variation_categories"
                                            id="product_attr_variation_categories_{{ $item->attr_value }}"
                                            value="{{ $item->attr_value }}">

                                        {{ $item->AttributeValue->name }}
                                    </span>
                                        </label>
                                    @endforeach
                                </div>
                            @endif

                            {{--                            //colors--}}


                            <div class="social-links-wrapper">
                                {{--
                                <div class="social-links">
                                    <div class="social-icons social-no-color border-thin">
                                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                        <a href="#" class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                        <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                        <a href="#" class="social-icon social-youtube fab fa-linkedin-in"></a>
                                    </div>
                                </div>
                                --}}
                                <span class="divider d-xs-show"></span>
                                <div class="product-link-wrapper d-flex">
                                    @auth
                                        @if ($product->checkUserWishlist(auth()->id()))
                                            <a title="حذف از علاقه مندیها"
                                               class="btn-product-icon btn-wishlist w-icon-heart-full"
                                               onclick="RemoveFromWishList(this,event,{{ $product->id }})"
                                               href="#">
                                            </a>
                                        @else
                                            <a title="افزودن به لیست علاقه مندی ها"
                                               class="btn-product-icon btn-wishlist w-icon-heart"
                                               onclick="AddToWishList(this,event,{{ $product->id }})">
                                            </a>
                                        @endif
                                    @else
                                        <a title="افزودن به لیست علاقه مندی ها"
                                           class="btn-product-icon btn-wishlist w-icon-heart"
                                           onclick="AddToWishList(this,event,{{ $product->id }})">
                                        </a>
                                    @endauth
                                    @if($product->quantity==0)
                                        <button type="button" onclick="informMe({{ $product->id }})"
                                                class="btn-product-icon fas fa-bell"
                                                title="موجود شد به من اطلاع بده"></button>
                                    @endif
                                    <a onclick="AddToCompareList(event,{{ $product->id }})"
                                       class="btn-product-icon w-icon-compare"
                                       title="افزودن به لیست مقایسه"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab tab-nav-boxed tab-nav-underline product-tabs mt-3">
                    <ul class="nav nav-tabs" role="tablist">
                        @if(count($product_attributes)>0)
                            <li class="nav-item">
                                <a style="font-size: 1.6rem;" href="#product_attributes"
                                   class="nav-link {{ count($errors) > 0 ? '' : 'active' }}">
                                    مشخصات فنی
                                </a>
                            </li>
                        @endif
                        @if($product->description!=null)
                            <li class="nav-item">
                                <a style="font-size: 1.6rem;" href="#product-tab-description"
                                   class="nav-link @unless(count($product_attributes)>0) 'active' @endif ">اطلاعات
                                    بیشتر</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a style="font-size: 1.6rem;" href="#product-tab-reviews"
                               class="nav-link {{ count($errors) > 0 ? 'active' : '' }}">
                                دیدگاه شما
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        @if(count($product_attributes)>0)
                            <div class="tab-pane {{ count($errors) > 0 ? '' : 'active' }}" id="product_attributes">
                                @foreach($attribute_Groups as $key=>$attribute_Group)
                                    <div class="mb-2">
                                        <div onclick="open_tab_group(this,{{ $attribute_Group->id }})"
                                             class="bg-light-gray p-2 attr_group_tab"
                                             style="font-weight: bold !important; font-size: 15px; border: 1px solid #ddd;">
                                            <img class="arrow_icon left_icon {{ $key==0 ? 'd-none' : '' }}"
                                                 src="{{ asset('home/images/left.png') }}">
                                            <img class="arrow_icon down_icon {{ $key==0 ? '' : 'd-none' }}"
                                                 src="{{ asset('home/images/down.png') }}">
                                            {{ $attribute_Group->name }}
                                        </div>
                                        <div id="attr_group_table_{{ $attribute_Group->id }}"
                                             class="table table-bordered {{ $key==0 ? '' : 'display-none' }} attr_children">
                                            @foreach($product_attributes as $product_attribute)
                                                @if($product_attribute->attribute->group_id==$attribute_Group->id)
                                                    <div class="mt-2 d-flex">
                                                        <span
                                                            class="bg-light-gray w-30 ml-5 p-2">{{ $product_attribute->attribute->name }}</span>
                                                        <span class="bg-light-gray w-70 p-2">
                                                            @php
                                                                $attribute_values=$product_attribute->attributeValues($product_attribute->value,$product_attribute->attribute_id);
                                                            @endphp
                                                            @if($attribute_values==null)
                                                                {{ $product_attribute->value }}
                                                            @else
                                                                {{ $attribute_values->name }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                @if(count($attribute_without_group)>0)
                                    <div onclick="open_tab_group(this,'without_group')"
                                         class="bg-light-gray p-2 mb-2 attr_group_tab"
                                         style="font-weight: bold !important; font-size: 15px; border: 1px solid #ddd;">
                                        <img class="arrow_icon left_icon d-none"
                                             src="{{ asset('home/images/left.png') }}">
                                        <img class="arrow_icon down_icon" src="{{ asset('home/images/down.png') }}">
                                        سایر مشخصات فنی
                                    </div>
                                    <div id="attr_group_table_without_group"
                                         class="table table-bordered {{ count($attribute_Groups)==0 ? '' : 'display-none' }} attr_children">
                                        @foreach($attribute_without_group as $product_attribute)
                                            <div class="my-1 d-flex">
                                                <span
                                                    class="bg-light-gray w-30 ml-5 p-2">{{ $product_attribute->attribute->name }}</span>
                                                <span class="bg-light-gray w-70 p-2">
                                                            @php
                                                                $attribute_values=$product_attribute->attributeValues($product_attribute->value,$product_attribute->attribute_id);
                                                            @endphp
                                                    @if($attribute_values==null)
                                                        {{ $product_attribute->value }}
                                                    @else
                                                        {{ $attribute_values->name }}
                                                    @endif
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if($product->description!=null)
                            <div
                                class="tab-pane {{ count($product_attributes)>0 ? '' : 'active' }}"
                                id="product-tab-description">
                                <div class="row mb-4">
                                    <div id="ck_editor_paragraph" style="color:black" class="col-12">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="tab-pane {{ count($errors) > 0 ? 'active' : '' }}" id="product-tab-reviews">
                            @auth

                                <div class="review_form field_form" id="comments">
                                    <!--<div class="col-12 mb-2">-->
                                    <!--    <span>امتیاز</span>-->
                                    <!--    <div-->
                                    <!--        class="{{ ceil($product->rates->where('product_id',$product->id)->avg('rate'))==0 ? 'emptyStar' : '' }}"-->
                                    <!--        id="dataReadonlyReview"-->
                                    <!--        data-rating-stars="5"-->
                                    <!--        data-rating-value=""-->
                                    <!--        data-rating-input="#rateInput">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <form action="{{ route('home.comments.store',['product'=>$product->id]) }}"
                                          method="post">
                                        @csrf
                                        <input type="hidden" name="rate" id="rateInput" value="">
                                        <div class="form-group col-12">
                                                    <textarea required="required" placeholder="متن پیام*"
                                                              class="form-control" name="text" rows="4"></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <button type="submit" class="btn btn-blue comment_login" name="submit"
                                                    value="Submit">ارسال
                                            </button>
                                        </div>
                                    </form>
                                    @include('home.sections.errors')

                                </div>

                            @else
                                <div class="review_form field_form">
                                    <div class="col-12">
                                        <div class="alert alert-danger text-center">
                                            برای ثبت نظر خود در خصوص این محصول لطفا ابتدا <span
                                                onclick="comment_login2({{$product->id}})"
                                                class="btn btn-blue">وارد</span>
                                            شوید
                                        </div>
                                    </div>
                                </div>
                            @endauth

                            <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                @if(!$product->approvedComments()->get()->isEmpty())
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="show-all">
                                            <ul class="comments list-style-none">
                                                @foreach($product->approvedComments()->get() as $comment)
                                                    <li class="comment">
                                                        <div class="comment-body">
                                                            <!--<figure class="comment-avatar">-->
                                                            <!--    <img-->
                                                            <!--        src="{{ imageExist(env('USER_IMAGES_UPLOAD_PATH'),$comment->User->avatar) }}"-->
                                                            <!--        alt="Commenter Avatar" width="90" height="90">-->
                                                            <!--</figure>-->
                                                            <!--<p>{{$comment}}</p>-->
                                                            <div class="comment-content">
                                                                <h4 class="comment-author">
                                                                    <a href="#">{{ $comment->User->first_name . ' ' .  $comment->User->last_name}}</a>
                                                                    <span
                                                                        class="comment-date">{{ verta($comment->created_at)->format('d - m - Y') }}</span>
                                                                </h4>
                                                                <!--<div class="ratings-container comment-rating">-->
                                                                <!--    <div-->
                                                                <!--        class="{{ ceil($product->rates->where('product_id',$product->id)->where('user_id',$comment->User->id)->avg('rate'))==0 ? 'emptyStar' : '' }}"-->
                                                                <!--        data-rating-stars="5"-->
                                                                <!--        data-rating-readonly="true"-->
                                                                <!--        data-rating-value="{{ ceil($product->rates->where('product_id',$product->id)->where('user_id',$comment->User->id)->avg('rate')) }}">-->
                                                                <!--    </div>-->
                                                                <!--</div>-->
                                                                <p>
                                                                    {{ $comment->text }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($related_products))
                    <section class="vendor-product-section">
                        <div class="title-link-wrapper mb-4">
                            <h4 class="title text-left">محصولات مرتبط</h4>
                        </div>
                        <div class="swiper-container swiper-theme" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 4
                                },
                                '992': {
                                    'slidesPerView': 4
                                }
                            }
                        }">
                            <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">
                                @php
                                    $products=$related_products;
                                @endphp
                                @include('home.sections.product_box')
                            </div>
                        </div>
                    </section>
                @endif

                @if(count($offerCategories)>0)
                    <section class="vendor-product-section mt-3">
                        <div class="title-link-wrapper title-link-wrapper-2 mb-4">
                            <h5 style="font-size: 14px;" class="offer-title text-title-mobile d-block text-right">دسته بندی های
                                پیشنهادی</h5>
                        </div>
                        <!--        <div class="swiper-container swiper-theme brands-wrapper mb-9 appear-animate"-->
                        <!--             data-swiper-options="{-->
                        <!--    'spaceBetween': 0,-->
                        <!--    'slidesPerView': 2,-->
                        <!--    'breakpoints': {-->
                        <!--        '576': {-->
                        <!--            'slidesPerView': 4-->
                        <!--        },-->
                        <!--        '768': {-->
                        <!--            'slidesPerView': 4-->
                        <!--        },-->
                        <!--        '992': {-->
                        <!--            'slidesPerView': 4-->
                        <!--        },-->
                        <!--        '1200': {-->
                        <!--            'slidesPerView': 4-->
                        <!--        }-->
                        <!--    }-->
                        <!--}">-->
                        <!--            <div  class="swiper-wrapper row gutter-no cols-xl-4 cols-lg-4 cols-md-4 cols-sm-4 cols-4">-->
                        <!--                @foreach($offerCategories as $category)-->
                        <!--                    <div class="swiper-slide">-->
                        <!--                        <figure style="margin-right: 15px;background-color: #fff;">-->
                        <!--                            <a href="{{ route('home.product_categories',['category'=>$category->alias]) }}">-->
                        <!--                                <img-->
                        <!--                                    src="{{ imageExist(env('CATEGORY_IMAGES_UPLOAD_PATH'),$category->image) }}"-->
                        <!--                                    alt="{{ $category->title }}"-->
                        <!--                                    width="290"-->
                        <!--                                    height="100"/>-->
                        <!--                            </a>-->
                        <!--                            <p style="bottom: 6px;position: absolute;font-weight: 300;" class="text-center text-title-mobile">{{$category->name}}</p>-->
                        <!--                        </figure>-->
                        <!--                    </div>-->
                        <!--                @endforeach-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!-- End of Brands Wrapper -->

                        <div class="container">
                            <div class="row">
                                @foreach($offerCategories as $category)
                                    <div class="col-6 col-md-3">
                                        <div style="position:relative;" class="box-category position-relative">
                                            <a class="offerCategories" href="{{ route('home.product_categories',['category'=>$category->alias]) }}">
                                                <img
                                                    src="{{ imageExist(env('CATEGORY_IMAGES_UPLOAD_PATH'),$category->image) }}"
                                                    alt="{{ $category->title }}"
                                                    width="290"
                                                    height="100"/>
                                                <p style="bottom: -8px;position: absolute;font-weight: 300;" class="text-center position-absolute text-title-mobile">{{$category->name}}</p>
                                            </a>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

                @if(count($offerBrands)>0)
                    <section class="vendor-product-section mt-3">
                        <div class="title-link-wrapper title-link-wrapper-2 mb-4">
                            <h5 style="font-size: 14px;" class="offer-title text-title-mobile d-block text-right">برند های
                                پیشنهادی</h5>
                        </div>
                        <div class="container">
                            <div class="row">
                                @foreach($offerBrands as $brand)
                                    <div class="col-6 col-md-3">
                                        <div class="box-category box-brand p-relative">
                                            <a href="{{ route('home.products.brand',['brand'=>$brand->alias]) }}">
                                                <img src="{{ imageExist(env('BRAND_UPLOAD_PATH'),$brand->image) }}"
                                                     alt="{{ $category->title }}"
                                                     width="290"
                                                     height="100"/>
                                                <p style="font-wight:300" class="text-center mt-3">{{$brand->name}}</p>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
@endsection
