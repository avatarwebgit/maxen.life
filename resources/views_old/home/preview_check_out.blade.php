@extends('home.layouts.index')

@section('title')
    تایید سفارش
@endsection

@section('description')

@endsection

@section('keywords')

@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/cart.css') }}">
    <style>
        .box-note {


            padding: 15px;
        }

        .box-note textarea {
            padding: 10px;
            border: 1px solid #eee;
        }

        .font-size-rem {
            font-size: 1.8rem !important;
        }

        tr > td {
            text-align: center !important;
        }

        .number-input {
            border: none !important;
        }

        .column-flex-direction-2 {
            flex-direction: column !important;
        }


        .img-thumbnail {
            width: 50px !important;
            height: auto !important;
        }

        .align-center {
            align-items: center !important;
        }

        h5 {
            margin-bottom: 0 !important;
        }

        @media screen and (max-width: 992px) {
            .align-md {
                text-align: right !important;
            }
        }

    </style>
@endsection

@section('script')
    <script>
        var elementPosition = $('.fixed-scroll').offset().top;
        var heightScroll = $('.height-scroll').height();


        $(window).scroll(function () {
            if ($(window).scrollTop() > elementPosition) {
                console.log(heightScroll);
                $('.fixed-scroll').css('position', 'sticky').css('top', 46);
                $('.fixed-scroll-2').css('position', 'sticky').css('top', heightScroll + 38);

            } else {

                $('.fixed-scroll').css('position', 'static');
            }
        });

        function WalletUsage() {
            let use_wallet = 0;
            if ($('#wallet_input').is(':checked')) {
                use_wallet = $('#wallet_input').val();
            }
            $.ajax({
                url: "{{ route('home.checkout.WalletUsage') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    use_wallet: use_wallet,
                },
                method: "post",
                dataType: "json",
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg[0] == 1) {
                        $('#summery_cart').html(msg[1]);
                    }
                }
            })
        }

        $('#paymentBtn').click(function () {
            check_limit_order();
        })

        function check_limit_order() {
            $.ajax({
                url: "{{ route('home.checkout.check_limit') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                method: "post",
                dataType: "json",
                beforeSend: function () {

                },
                success: function (msg) {
                    let status = msg['status'];
                    if (status == 0) {
                        return false;
                        swal({
                            title: 'دقت کنید',
                            icon: 'warning',
                            text: msg['message'],
                        });
                        setTimeout(function () {
                            window.location.href = msg['redirect'];
                        }, 3000);
                    }
                    if (status == 1) {
                        check_national_code();
                    }
                }
            })
        }

        function check_national_code() {
            let national_code_modal = $('#national_code_modal');
            $.ajax({
                url: "{{ route('home.checkout.check_national_code') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: "{{ $address->User->id }}",
                },
                method: "post",
                dataType: "json",
                beforeSend: function () {

                },
                success: function (msg) {
                    let status = msg['status'];
                    if (status == 0) {
                        swal({
                            title: 'دقت کنید',
                            icon: 'warning',
                            text: msg['message'],
                        });
                        setTimeout(function () {
                            window.location.href = msg['redirect'];
                        }, 3000);
                    }
                    if (status == 2) {
                        national_code_modal.modal('show');
                    }
                    if (status == 1) {
                        check_sale_for_legal();
                    }
                }
            })
        }

        function check_sale_for_legal() {
            let description = $('.order-description').val();
            $.ajax({
                url: "{{ route('home.checkout.check_sale_for_legal') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: "{{ $address->User->id }}",
                    description: description,
                },
                method: "post",
                dataType: "json",
                beforeSend: function () {

                },
                success: function (msg) {
                    let status = msg['status'];
                    if (status === 0) {
                        swal({
                            title: 'دقت کنید',
                            icon: 'warning',
                            text: msg['message'],
                            buttons: 'متوجه شدم'
                        });
                    }
                    if (status === 1) {
                        $('#payment_form').submit();
                    }
                }
            })
        }

        $(document).ready(function () {
            let use_wallet = "{{ session()->get('use_wallet') }}";
            if (use_wallet == 1) {
                WalletUsage()
            }
            change_payment_btn();
        })

        function change_payment_btn() {
            let payment = $("input[name='payment_method']:checked").val();
            $('#paymentBtn').text('پرداخت');
            if (payment == 3) {
                $('#paymentBtn').text('مشاهده پیش فاکتور');
            }
            if (payment == 9) {
                $('#paymentBtn').text('مشاهده اطلاعات پرداخت');
            }
        }

        function add_national_code() {
            let national_code = $('#national_code').val();
            $.ajax({
                url: "{{ route('home.checkout.add_national_code') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    national_code: national_code,
                    user_id: "{{ $address->User->id }}",
                },
                method: "post",
                dataType: "json",
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg[0] == 1) {
                        let national_code_modal = $('#national_code_modal');
                        national_code_modal.modal('hide');
                        swal({
                            title: 'با تشکر',
                            icon: 'success',
                            text: 'کد ملی شما با موفقیت ثبت شد',
                        });
                        $('#paymentBtn').trigger('click');

                    }
                },
                error: function (response) {
                    $.each(response.responseJSON.errors, function (i, v) {
                        let p = `<p class="input-error-validation">${v[0]}</p>`;
                        $('#national_code_error').html(p);
                    })
                }
            })
        }


    </script>
@endsection

@section('content')

    <!-- Start of Main -->
    <main class="main cart">
        <!-- Start of PageContent -->
        <div class="page-content mt-3">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 km-box-style2 mt-5">
                        <div class="card">
                            <div class="card-body d-flex justify-content-center">
                                <div class="km-cart-progress-container">
                                    <section class="km-cart-progress">
                                        <div class="vp-progress-bar">
                                            <div class="km-progress" style="width: 50%;"></div>
                                        </div>
                                        <div class="vp-container-step">
                                            <div class="km-step km-done km-active">
                                                <div class="km-step--item   vp-active vp-success">

                                                    <a href="/cart">
                                                        <svg fill="none" height="20" viewBox="0 0 18 20"
                                                             width="18" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17 20.0001H1C0.734784
                                                                20.0001 0.48043 19.8947
                                                                0.292893 19.7072C0.105357 19.5196 0
                                                                19.2653 0 19.0001V1.00006C0 0.734845
                                                                0.105357 0.480491 0.292893 0.292954C0.48043
                                                                 0.105418 0.734784 6.10352e-05 1
                                                                 6.10352e-05H17C17.2652 6.10352e-05 17.5196
                                                                 0.105418 17.7071 0.292954C17.8946 0.480491 18
                                                                  0.734845 18 1.00006V19.0001C18 19.2653 17.8946
                                                                  19.5196 17.7071 19.7072C17.5196 19.8947 17.2652
                                                                  20.0001 17 20.0001ZM16 18.0001V2.00006H2V18.0001H16ZM6
                                                                   4.00006V6.00006C6 6.79571 6.31607 7.55877 6.87868
                                                                   8.12138C7.44129 8.68399 8.20435 9.00006 9 9.00006C9.79565
                                                                   9.00006 10.5587 8.68399 11.1213 8.12138C11.6839 7.55877
                                                                    12 6.79571 12 6.00006V4.00006H14V6.00006C14 7.32614
                                                                    13.4732 8.59791 12.5355 9.53559C11.5979 10.4733 10.3261
                                                                    11.0001 9 11.0001C7.67392 11.0001 6.40215 10.4733 5.46447
                                                                    9.53559C4.52678 8.59791 4 7.32614 4 6.00006V4.00006H6Z"
                                                                fill="#3db93d"></path>
                                                        </svg>
                                                    </a>
                                                    <span><a href="/cart">سبد خرید</a></span></div>
                                            </div>
                                            <div class="km-step km-current ">
                                                <a href="{{route('home.checkout')}}">
                                                    <div class="km-step--item vp-active  ">

                                                        <svg class="svgDark" fill="none" height="17" viewBox="0 0 22 17"
                                                             width="22" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M7.965 13C7.84612 13.8343 7.43021 14.5977 6.79368 15.1499C6.15714 15.7022 5.34272 16.0063 4.5 16.0063C3.65728 16.0063 2.84286 15.7022 2.20632 15.1499C1.56979 14.5977 1.15388 13.8343 1.035 13H0V1C0 0.734784 0.105357 0.48043 0.292893 0.292893C0.48043 0.105357 0.734784 0 1 0H15C15.2652 0 15.5196 0.105357 15.7071 0.292893C15.8946 0.48043 16 0.734784 16 1V3H19L22 7.056V13H19.965C19.8461 13.8343 19.4302 14.5977 18.7937 15.1499C18.1571 15.7022 17.3427 16.0063 16.5 16.0063C15.6573 16.0063 14.8429 15.7022 14.2063 15.1499C13.5698 14.5977 13.1539 13.8343 13.035 13H7.965ZM14 2H2V10.05C2.39456 9.6472 2.8806 9.34568 3.41675 9.17112C3.9529 8.99655 4.52329 8.95411 5.07938 9.04739C5.63546 9.14068 6.16077 9.36693 6.61061 9.7069C7.06044 10.0469 7.42148 10.4905 7.663 11H13.337C13.505 10.647 13.73 10.326 14 10.05V2ZM16 8H20V7.715L17.992 5H16V8ZM16.5 14C16.898 14 17.2796 13.8419 17.561 13.5605C17.8424 13.2791 18.0005 12.8975 18.0005 12.4995C18.0005 12.1015 17.8424 11.7199 17.561 11.4385C17.2796 11.1571 16.898 10.999 16.5 10.999C16.102 10.999 15.7204 11.1571 15.439 11.4385C15.1576 11.7199 14.9995 12.1015 14.9995 12.4995C14.9995 12.8975 15.1576 13.2791 15.439 13.5605C15.7204 13.8419 16.102 14 16.5 14ZM6 12.5C6 12.303 5.9612 12.108 5.88582 11.926C5.81044 11.744 5.69995 11.5786 5.56066 11.4393C5.42137 11.3001 5.25601 11.1896 5.07403 11.1142C4.89204 11.0388 4.69698 11 4.5 11C4.30302 11 4.10796 11.0388 3.92597 11.1142C3.74399 11.1896 3.57863 11.3001 3.43934 11.4393C3.30005 11.5786 3.18956 11.744 3.11418 11.926C3.0388 12.108 3 12.303 3 12.5C3 12.8978 3.15804 13.2794 3.43934 13.5607C3.72064 13.842 4.10218 14 4.5 14C4.89782 14 5.27936 13.842 5.56066 13.5607C5.84196 13.2794 6 12.8978 6 12.5Z"
                                                                fill="#3db93d"></path>
                                                        </svg>
                                                        <span>ارسال</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="km-step">
                                                <div class="km-step--item ">
                                                    <svg class="svglight" fill="none" height="18" viewBox="0 0 20 18"
                                                         width="20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1 0H19C19.2652 0 19.5196 0.105357 19.7071 0.292893C19.8946 0.48043 20 0.734784 20 1V17C20 17.2652 19.8946 17.5196 19.7071 17.7071C19.5196 17.8946 19.2652 18 19 18H1C0.734784 18 0.48043 17.8946 0.292893 17.7071C0.105357 17.5196 0 17.2652 0 17V1C0 0.734784 0.105357 0.48043 0.292893 0.292893C0.48043 0.105357 0.734784 0 1 0ZM18 8H2V16H18V8ZM18 6V2H2V6H18ZM12 12H16V14H12V12Z"
                                                            fill="#ED303D"></path>
                                                    </svg>
                                                    <span>پرداخت</span>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row gutter-lg mb-10">
                    <div class="col-lg-8 pr-lg-4 mb-6">
                        <div class="row km-box-style2">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped position-relative">
                                        <thead class="cart-thead">
                                        <tr>
                                            <th><span>تصویر</span></th>
                                            <th class="min-width-200"><span>محصول</span></th>
                                            <th>اقلام افزوده</th>
                                            <th><span>قیمت واحد</span></th>
                                            <th><span>مالیات</span></th>
                                            <th><span>تعداد</span></th>
                                            <th><span>قیمت کل</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($carts as $cart)
                                            <tr>
                                                <td>
                                                    <div class="p-relative">
                                                        <a href="{{ route('home.product',['alias'=>$cart->Product->alias]) }}">
                                                            <figure>
                                                                <img
                                                                    src="{{ imageExist(env('PRODUCT_IMAGES_UPLOAD_PATH'),$cart->Product->primary_image) }}"
                                                                    alt="product"
                                                                    width="300" height="338">
                                                            </figure>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="min-width-200">
                                                    <a href="{{ route('home.product',['alias'=>$cart->Product->alias]) }}">
                                                        {{ $cart->Product->name }}
                                                        <br>
                                                        {{ isset($cart->AttributeValues->name) ? $cart->AttributeValues->name : '' }}
                                                        <br>
                                                        {{ isset($cart->Color->name) ? $cart->Color->name : '' }}
                                                        <br>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a>
                                                        @if($cart->option_ids!=null)
                                                            @if(product_price_for_user_normal($cart->product_id,$cart->product_attr_variation_id)[1]!=0)
                                                                <br>
                                                            @endif
                                                            @foreach($cart->option_ids as $option)
                                                                @if(isset(\App\Models\ProductOption::where('id',$option)->first()->VariationValue->name))
                                                                    <br>{{ \App\Models\ProductOption::where('id',$option)->first()->VariationValue->name }}
                                                                @endif

                                                            @endforeach
                                                        @else
                                                            -
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>
                                        <span class="amount">
                                            {{ number_format(product_price_for_user_normal($cart->product_id,$cart->product_attr_variation_id)[2]) }} تومان
                                            @if(product_price_for_user_normal($cart->product_id,$cart->product_attr_variation_id)[1]!=0)
                                                <br>
                                                <span class="input-error-validation">
                                               تخفیف {{ number_format(product_price_for_user_normal($cart->product_id,$cart->product_attr_variation_id)[1]) }}%
                                            </span>
                                            @endif
                                                <?php
                                                $option_price = 0;
                                                ?>
                                            @if($cart->option_ids!=null)

                                                @foreach($cart->option_ids as $option)
                                                    @if(isset(\App\Models\ProductOption::where('id', $option)->first()->price))

                                                            <?php
                                                            $option_price = $option_price + (\App\Models\ProductOption::where('id', $option)->first()->price);
                                                            ?>
                                                        <br>
                                                        + {{ number_format(\App\Models\ProductOption::where('id',$option)->first()->price).' تومان ' }}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span>
                                                </td>
                                                <td>
                                        <span class="amount">
                                            @if($cart->product_has_tax==1)
                                                {{ number_format(((product_price_for_user_normal($cart->product_id,$cart->product_attr_variation_id)[2])+($option_price))*0.1) }}
                                                تومان
                                            @else
                                                0
                                            @endif
                                        </span>
                                                </td>
                                                <td>
                                                    <input readonly style="font-family: IRANSansfanum !important;"
                                                           class="text-center number-input"
                                                           onchange="updateQuantity({{ $cart->id }},this)"
                                                           id="quantity_{{  $cart->id }}" type="number"
                                                           min="{{ $cart->Product->minimum_measure_to_order }}"
                                                           max="100000"
                                                           value="{{ $cart->quantity }}">
                                                </td>
                                                <td>
                                    <span class="amount">
                                         @if($cart->product_has_tax==1)
                                            {{ number_format(((product_price_for_user_normal($cart->product_id,$cart->product_attr_variation_id)[2])+($option_price))*1.1*$cart->quantity) }}
                                            تومان
                                        @else
                                            {{ number_format(((product_price_for_user_normal($cart->product_id,$cart->product_attr_variation_id)[2])+($option_price))*$cart->quantity) }}
                                            تومان
                                        @endif
                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if($amount!=0)
                            <div class="row km-box-style2">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-center">
                                        <h5 class="title coupon-title font-weight-bold text-uppercase">
                                            استفاده از کیف پول:
                                        </h5>
                                        <div class="d-flex align-center">
                                <span>
                                    موجودی: {{ number_format($amount) }} تومان
                                </span>
                                            <input id="wallet_input"
                                                   {{ session()->get('use_wallet')==1 ? 'checked' : '' }} onchange="WalletUsage()"
                                                   class="ml-3" type="checkbox" value="1"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row km-box-style2">
                            <div class="col-12">
                                <div class="card-body cart-summary-wrap bg-white">
                                    <h4 class="font-size-rem align-md font-weight-bold">مشخصات ارسال:</h4>
                                    <hr>
                                    <div class="d-md-flex column-flex-direction-2 align-md mb-1">
                                <span class="receive_information ">
                                      <span style="font-weight:bold;">تحویل گیرنده:</span>
                                            <span>{{ $address->title }}</span>
                                </span>
                                        <span class="receive_information d-block">
                                         <span style="font-weight:bold;">شماره همراه:</span>
                                            <span>{{ $address->cellphone }}</span>
                                </span>
                                    </div>
                                    <div class="d-md-flex column-flex-direction-2 align-md mb-1">
                                <span class="receive_information">
                                       <span style="font-weight:bold;">شماره تماس دوم:</span>
                                        <span>{{ $address->tel==null ? '-' : $address->tel }}</span>
                                    </span>
                                        <span class="receive_information">
                                    </span>
                                    </div>
                                    <div class="d-md-flex justify-content-between mb-1">
                                        <p style="text-align:right !important;margin-top::9px"
                                           class="receive_information align-md">
                                            <span style="font-weight:bold;">آدرس:</span>
                                            {{ province_name($address->province_id).' / '.city_name($address->city_id).' - '.$address->address }}
                                        </p>
                                    </div>

                                    <div class="d-md-flex column-flex-direction-2 align-md mb-1">
                                <span class="d-block receive_information">
                                           <span style="font-weight:bold;">روش ارسال:</span> {{ $delivery_method->name.' / '.$delivery_method->description }}
                                        </span>
                                        @if($set_time)
                                            <span class="receive_information">
                                            <span style="font-weight:bold;">
                                            زمان و تاریخ دریافت کالا:
                                            </span>
 {{ $set_time ?  $delivery_day.' / ساعت '.$delivery_time : ' ' }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body bg-white cart-summary-wrap">
                                    <div class="box-note">
                                        <h4 class="font-size-rem font-weight-bold">یادداشت های اضافه شده به سفارش:</h4>
                                        <textarea class="order-description" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="height: 1200px" class="col-lg-4">
                        <div class="row height-scroll fixed-scroll">
                            <div class="col-12">
                                <div id="summery_cart" class="sticky-sidebar km-box-style2">
                                    <div class="cart-summary mb-4">
                                        <h3 style="text-align:center"
                                            class="cart-title font-weight-bold font-size-rem text-uppercase">خلاصه سبد
                                            خرید </h3>
                                        <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                            <label class="ls-25">کل سبد خرید </label>
                                            <span>{{ number_format(summery_cart()['original_price']) }} تومان </span>
                                        </div>
                                        <hr class="divider">
                                        <div class="order-total d-flex justify-content-between align-items-center">
                                            <label>تخفیف</label>
                                            <span
                                                class="ls-50">{{ number_format(summery_cart()['total_sale']) }} تومان </span>
                                        </div>
                                        <hr class="divider">

                                        <div class="order-total d-flex justify-content-between align-items-center">
                                            <label>مالیات</label>
                                            <span
                                                class="ls-50">{{ number_format(calculateCartPrice()['tax']) }} تومان</span>
                                        </div>
                                        <hr class="divider">
                                        <div class="order-total d-flex justify-content-between align-items-center">
                                            <label>مبلغ کد تخفیف</label>
                                            <span class="ls-50">{{ number_format(summery_cart()['coupon_amount']) }} تومان </span>
                                        </div>
                                        <hr class="divider">
                                        <div class="order-total d-flex justify-content-between align-items-center">
                                            @if($delivery_method->id==6 or $delivery_method->id==7)
                                                @if($address->province_id==3 or $address->province_id==8)
                                                    <label>هزینه ارسال</label>
                                                @else
                                                    <label>هزینه حمل تا {{ $delivery_method->name }}</label>
                                                @endif
                                            @else
                                                <label>هزینه ارسال</label>
                                            @endif
                                            <span>{{ intval(summery_cart()['delivery_price'])==0 ? summery_cart()['delivery_price'] : number_format(summery_cart()['delivery_price']).' تومان ' }}</span>
                                        </div>
                                        <hr class="divider-black">
                                        <div
                                            class="order-total text-black d-flex justify-content-between align-items-center">
                                            <label>مبلغ قابل پرداخت</label>
                                            <span
                                                class="ls-50">{{ number_format(summery_cart()['payment']) }} تومان </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="cart-summary km-box-style2">
                                    <div class="cart-summary-wrap ">
                                        <form id="payment_form" action="{{ route('home.payment') }}" method="POST">
                                            @csrf
                                            <h4 class="text-center font-size-rem font-weight-bold">روش های پرداخت</h4>
                                            <hr>
                                            @foreach($PaymentMethods as $key=>$item)
                                                @unless($item->name=='Deposit' and count($limited_products_for_pay_cash)>0)
                                                    <div
                                                        class="pay-top sin-payment d-flex justify-content-between align-center mb-3">
                                                        <div class="d-flex align-center">
                                                            @if(file_exists(public_path(env('LOGO_UPLOAD_PATH').$item->image))
                             and !is_dir(public_path(env('LOGO_UPLOAD_PATH').$item->image)))
                                                                <img alt="{{ $item->title }}" class="img-thumbnail"
                                                                     src="{{ asset(env('LOGO_UPLOAD_PATH').$item->image) }}">
                                                            @else
                                                                <img alt="{{ $item->title }}" class="img-thumbnail"
                                                                     src="{{ asset('admin/images/no_image.jpg') }}">
                                                            @endif
                                                            <div>
                                                                <label style="text-align:right" for="{{ $item->id }}"><b
                                                                        class="ml-3">{{ $item->title }}</b></label>
                                                                <label for="{{ $item->id }}"
                                                                       class="ml-3">{{ $item->short_description }}</label>
                                                            </div>

                                                        </div>
                                                        <div onclick="change_payment_btn()"
                                                             class="d-flex justify-content-between align-center">
                                                            <input id="{{ $item->id }}" class="input-radio" type="radio"
                                                                   value="{{ $item->id }}"
                                                                   @if($key==0)checked="checked"
                                                                   @endif name="payment_method">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endif
                                            @endforeach
                                            <input type="hidden" id="address-input" name="address_id"
                                                   value="{{ $address->id }}">
                                        </form>
                                    </div>
                                    <div class="cart-summary-button d-flex justify-content-between">
                                        <a href="{{ route('home.checkout') }}"
                                           class="btn btn-address-2 btn-gold  btn-rounded">
                                            تغییر آدرس</a>
                                        <button id="paymentBtn" type="button" class="btn btn-blue  btn-rounded">
                                            پرداخت
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End of Main -->

@endsection
