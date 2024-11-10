@extends('home.layouts.index')

@section('title')
    سبد خرید
@endsection

@section('description')

@endsection

@section('keywords')

@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/cart.css') }}">
    <style>
        tr > td {
            text-align: center !important;
        }

        .number-input {
            border: none !important;
        }

        
        input[type=number] {
            -moz-appearance:textfield;
            }
            .order-total > label{
                    font-size: 1.6rem !important;
            }
                .cart-subtotal > label{
                    font-size: 1.6rem !important;
            }
    </style>
@endsection

@section('script')
    <script>
    function change_quantity(cart_id,type){
            let quantity = $('#quantity_'+cart_id).val();
            if (type==1) {
                quantity = parseInt(quantity) + 1;
            }else {
                quantity = parseInt(quantity) -1;
            }
            if (quantity==0){
                quantity=1;
                $('#quantity_'+cart_id).val(quantity);
            }else {
                $('#quantity_'+cart_id).val(quantity);
                updateQuantity(cart_id);
            }


        }
        
        function remove_cart(cart_id) {
            $.ajax({
                url: "{{ route('home.cart.remove') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_id: cart_id,
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {

                },
                success: function (msg) {
                    console.log(msg);
                    if (msg) {
                        if (msg[0] == 1) {
                            let message = msg[1];
                            swal({
                    
                                text: message,
                                icon: 'success',
                                timer: 5000,
                                button: false
                                 
                            })
                            setTimeout(function () {
                                window.location.reload();
                            }, 1500)
                        }
                        if (msg[0] == 0) {
                            let message = msg[1];
                            swal({
                                title: 'error',
                                text: message,
                                icon: 'error',
                             
                            })
                        }
                    }
                },
            })
        }

        function remove_carts() {
            $.ajax({
                url: "{{ route('home.carts.remove') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {

                },
                success: function (msg) {
                    console.log(msg);
                    if (msg) {
                        if (msg[0] == 1) {
                            let message = msg[1];
                            swal({
                          
                                text: message,
                                icon: 'success',
                                timer: 5000,
                                 button: false
                                
                            })
                            setTimeout(function () {
                                window.location.href = "{{ route('home.index') }}";
                            }, 1500)
                        }
                        if (msg[0] == 0) {
                            let message = msg[1];
                            swal({
                                title: 'error',
                                text: message,
                                icon: 'error',
                              
                            })
                        }
                    }
                },
            })
        }

        function updateQuantity(cart_id, tag) {
          let quantity = $('#quantity_'+cart_id).val();
            $.ajax({
                url: "{{ route('home.cart.update') }}",
                type: "POST",
                dataType: "json",
                data: {
                    quantity: quantity,
                    cart_id: cart_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response[0] === 1) {
                        window.location.href = "{{ route('home.cart') }}";
                    }
                    if (response[0] === 0) {
                        swal({
                            title: " دقت کنید",
                            text: "تعداد وارد شده بیش از موجودی کالا است",
                            icon: "error",
                        });

                        $(tag).val(response[1]);
                    }
                }
            });
        }

        function checkCart() {
            $.ajax({
                url: "{{ route('home.cart.checkCartAjax') }}",
                type: "POST",
                dataType: "json",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response[0] == 1) {
                        window.location.href = "{{ route('home.checkout') }}";
                    }
                    if (response[0] == 0) {
                        swal({
                            title: 'خطا',
                            text: response[1],
                            icon: 'error',
                              timer: 5000,
                                button: false
                        })
                        setTimeout(function () {
                            window.location.reload();
                        }, 5000)
                    }
                }
            });
        }

    </script>
@endsection

@section('content')

    <!-- Start of Main -->
    <main class="main cart">
        <!-- Start of PageContent -->
        <div class="page-content mt-2">
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
                                                                fill="#ED303D"></path>
                                                        </svg>
                                                    </a>
                                                    <span><a href="/cart">سبد خرید</a></span></div>
                                            </div>
                                            <div class="km-step km-current ">
                                                <div class="km-step--item vp-active  ">

                                                    <svg class="svgDark" fill="none" height="17" viewBox="0 0 22 17"
                                                         width="22" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M7.965 13C7.84612 13.8343 7.43021 14.5977 6.79368 15.1499C6.15714 15.7022 5.34272 16.0063 4.5 16.0063C3.65728 16.0063 2.84286 15.7022 2.20632 15.1499C1.56979 14.5977 1.15388 13.8343 1.035 13H0V1C0 0.734784 0.105357 0.48043 0.292893 0.292893C0.48043 0.105357 0.734784 0 1 0H15C15.2652 0 15.5196 0.105357 15.7071 0.292893C15.8946 0.48043 16 0.734784 16 1V3H19L22 7.056V13H19.965C19.8461 13.8343 19.4302 14.5977 18.7937 15.1499C18.1571 15.7022 17.3427 16.0063 16.5 16.0063C15.6573 16.0063 14.8429 15.7022 14.2063 15.1499C13.5698 14.5977 13.1539 13.8343 13.035 13H7.965ZM14 2H2V10.05C2.39456 9.6472 2.8806 9.34568 3.41675 9.17112C3.9529 8.99655 4.52329 8.95411 5.07938 9.04739C5.63546 9.14068 6.16077 9.36693 6.61061 9.7069C7.06044 10.0469 7.42148 10.4905 7.663 11H13.337C13.505 10.647 13.73 10.326 14 10.05V2ZM16 8H20V7.715L17.992 5H16V8ZM16.5 14C16.898 14 17.2796 13.8419 17.561 13.5605C17.8424 13.2791 18.0005 12.8975 18.0005 12.4995C18.0005 12.1015 17.8424 11.7199 17.561 11.4385C17.2796 11.1571 16.898 10.999 16.5 10.999C16.102 10.999 15.7204 11.1571 15.439 11.4385C15.1576 11.7199 14.9995 12.1015 14.9995 12.4995C14.9995 12.8975 15.1576 13.2791 15.439 13.5605C15.7204 13.8419 16.102 14 16.5 14ZM6 12.5C6 12.303 5.9612 12.108 5.88582 11.926C5.81044 11.744 5.69995 11.5786 5.56066 11.4393C5.42137 11.3001 5.25601 11.1896 5.07403 11.1142C4.89204 11.0388 4.69698 11 4.5 11C4.30302 11 4.10796 11.0388 3.92597 11.1142C3.74399 11.1896 3.57863 11.3001 3.43934 11.4393C3.30005 11.5786 3.18956 11.744 3.11418 11.926C3.0388 12.108 3 12.303 3 12.5C3 12.8978 3.15804 13.2794 3.43934 13.5607C3.72064 13.842 4.10218 14 4.5 14C4.89782 14 5.27936 13.842 5.56066 13.5607C5.84196 13.2794 6 12.8978 6 12.5Z"
                                                            fill="#979797"></path>
                                                    </svg>
                                                    <span>ارسال</span>
                                                </div>
                                            </div>
                                            <div class="km-step">
                                                <div class="km-step--item ">
                                                    <svg class="svglight" fill="none" height="18" viewBox="0 0 20 18"
                                                         width="20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1 0H19C19.2652 0 19.5196 0.105357 19.7071 0.292893C19.8946 0.48043 20 0.734784 20 1V17C20 17.2652 19.8946 17.5196 19.7071 17.7071C19.5196 17.8946 19.2652 18 19 18H1C0.734784 18 0.48043 17.8946 0.292893 17.7071C0.105357 17.5196 0 17.2652 0 17V1C0 0.734784 0.105357 0.48043 0.292893 0.292893C0.48043 0.105357 0.734784 0 1 0ZM18 8H2V16H18V8ZM18 6V2H2V6H18ZM12 12H16V14H12V12Z"
                                                            fill="#979797"></path>
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
                    <div class="col-lg-8 pr-lg-4 mb-6  km-box-style2">
                        <div style="overflow-x: scroll" class="">
                            <table class="table table-striped position-relative">
                                <thead class="cart-thead">
                                <tr>
                                    <th><span>تصویر</span></th>
                                    <th class="min-width-200"><span>محصول</span></th>
                                    <th>اقلام افزوده</th>
                                    <th ><span>قیمت واحد</span></th>
                                    <th ><span>مالیات</span></th>
                                    <th><span>تعداد</span></th>
                                    <th><span>قیمت کل </span></th>
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
                                                <button onclick="remove_cart({{ $cart->id }})" class="btn btn-close"><i
                                                        class="fas fa-times"></i></button>
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
                                        <td >
                                            <span>
                                                @if($cart->option_ids!=null)
                                                    @if(product_price_for_user_normal($cart->product_id,$cart->product_attr_variation_id)[1]!=0)
                                                        <br>
                                                    @endif
                                                    @foreach($cart->option_ids as $option)
                                                            @if(isset(\App\Models\ProductOption::where('id',$option)->first()->VariationValue))
                                                                
                                                                <br>{{ \App\Models\ProductOption::where('id',$option)->first()->VariationValue->name }}
                                                            
                                                          @endif
                                                        
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </td>
                                        <td >
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
                                                    + {{ number_format(\App\Models\ProductOption::where('id',$option)->first()->price).' تومان ' 
                                             
                                             }}
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
                                     <div style="display: flex;justify-content: center" class="number-input">
                                                <i style="margin-left: 10px;
                                                  margin-top: 3px;

                                                
                                                cursor: pointer" onclick="change_quantity({{ $cart->id }},0)" class="fa fa-minus"></i>
                                                <input   style="width: 36px;font-family: IRANSansfanum !important;" readonly class="text-center quantity-input number-input"
                                                       id="quantity_{{  $cart->id }}" type="number"
                                                       min="{{ $cart->Product->minimum_measure_to_order }}" max="100000"
                                                       value="{{ $cart->quantity }}">
                                                <i style="margin-left: 32px;  margin-top: 3px;cursor: pointer" onclick="change_quantity({{ $cart->id }},1)" class="fa fa-plus"></i>
                                            </div>
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
                    <div class="col-lg-4 sticky-sidebar-wrapper">
                        <div class="sticky-sidebar  km-box-style2">
                            <div class="cart-summary mb-4">
                                <h3 style="    text-align: center;
    font-size: 1.8rem;font-weight:800" class="cart-title text-uppercase">خلاصه سبد خرید </h3>
                                <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                    <label  >کل سبد خرید </label>
                                    <span>{{ number_format(calculateCartPrice()['original_price']) }} تومان</span>
                                </div>
                                <hr class="divider">
                                <div class="order-total d-flex justify-content-between align-items-center">
                                    <label>تخفیف</label>
                                    <span
                                        class="ls-50">{{ number_format(calculateCartPrice()['total_sale']) }} تومان</span>
                                </div>
                                   <hr class="divider">
                                <div class="order-total d-flex justify-content-between align-items-center">
                                    <label>مالیات</label>
                                    <span
                                        class="ls-50">{{ number_format(calculateCartPrice()['tax']) }} تومان</span>
                                </div>
                             
                                
                                <hr class="divider">
                                <div class="order-total d-flex justify-content-between align-items-center">
                                    <label style="font-weight:800">جمع کل</label>
                                    <span class="ls-50">{{ number_format(calculateCartPrice()['sale_price']- session()->get('coupon.amount')) }} تومان</span>
                                </div>
                                <button onclick="checkCart()"
                                        class="btn btn-block btn-blue btn-icon-right btn-rounded  btn-checkout">
                                    تایید و ادامه
                                    <i class="w-icon-long-arrow-left"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->
@endsection
