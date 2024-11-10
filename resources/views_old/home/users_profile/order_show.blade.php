@extends('home.layouts.index')

@section('title')
    جزئیات سفارش
@endsection

@section('script')
    <script>
        $('.mobile-menu-toggle').click(function () {
            $('.loaded').addClass('mmenu-active');
        })
        $('.mobile-menu-close').click(function () {
            $('.loaded').removeClass('mmenu-active');
        })
        $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
        $('div#categories > ul.mobile-menu > li > a > span.toggle-btn').click(function (e) {
            e.preventDefault();
            $(this).parent().next().slideToggle(300).parent().toggleClass("show");
        })
        $('#payment-online').click(function () {
            $('#payment-form').submit();
        })
        $('#mobile_menu_nav').click(function () {
            $('#icon-panel').toggleClass('negative');
            $('#icon-panel').toggleClass('positive');
            $('.negative').html('-');
            $('.positive').html('+');
        })
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/profile_panel.css') }}">

    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        td {
            font-size: 10pt;
            padding: 0;
            vertical-align: middle;
        }

        th {
            text-align: center;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 1000px !important;
                margin: 1.75rem auto;
            }
        }

        .table-row:nth-child(even) {
            background-color: #f2f2f2 !important;
        }

        .myaccount-page-wrapper input, textarea {
            border: 1px solid #000 !important;
        }


    </style>
@endsection

@section('content')

    @if($order->payment_type == 3)
        @php
            $payment = \App\Models\PaymentMethods::where('id' , $order->payment_type)->first();

        @endphp
        <form style="display: none" id="payment-form" action="{{ route('home.payment') }}" method="POST">
            @csrf


            <input type="hidden" id="address-input" name="address_id"
                   value="{{ $order->address->id }}">
            <input type="hidden" name="order_id" value="{{$order->id}}">
            <input type="hidden" name="payment_method" value="{{$payment->method}}">
        </form>
    @endif
    <div class="my-account-wrapper main">
        <div class="container card">
            <div class="row card-body">
                <div class="col-lg-3 col-md-4">
                    @include('home.sections.profile_sidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="myaccountContent">
                        <div class="myaccount-content">
                            @if($user->first_name==null or $user->national_code==null)
                                @include('home.users_profile.complete_info')
                            @else
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
                                        <div class="row">
                                            <div style="    margin-right: auto;
    margin-left: auto;"
                                                 class="col-12 {{ $order->DeliveryMethod->id==1?'col-md-4':'col-md-6' }}">
                                                <div class="mb-4 text-center text-md-right">
                                                    <h5 style="font-size:17px" class="font-weight-bold">شماره
                                                        سفارش: {{ $setting->productCode.'-'.$order->order_number }}</h5>
                                                </div>
                                            </div>
                                            @if($order->DeliveryMethod->id==1)
                                                <form class="col-12 col-md-4 d-flex align-items-center"
                                                      action="{{ route('admin.order.TrackingCodeUpdate',['order'=>$order->id]) }}"
                                                      method="post">
                                                    @csrf
                                                    <input class="form-control form-control-sm"
                                                           name="TrackingCode" value=""
                                                           placeholder="کد رهگیری مرسله پستی">
                                                    @if($errors->has('TrackingCode'))
                                                        <div
                                                            class="error">{{ $errors->first('TrackingCode') }}</div>
                                                    @endif
                                                    <button type="submit"
                                                            class="btn btn-sm btn-dark mr-3">
                                                        ثبت
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <hr>
                                        {{--                                        //error--}}
                                        <div class="row">
                                            <div class="col-12">
                                                @if($order->paymentMethod->id==3)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            @if($order->DeliveryMethodStatus->id==1)

                                                                @if($order->image==null)
                                                                    <form
                                                                        action="{{ route('home.orders.order_image',['order'=>$order->id]) }}"
                                                                        method="post"
                                                                        enctype="multipart/form-data"
                                                                    >
                                                                        @csrf
                                                                        <div class="alert alert-info">
                                                                            <div style="font-size: 17px !important;"
                                                                                 class="text-center text-center font-size-lg">
                                                                                تصویر رسید پرداختی خود را آپلود
                                                                                نمایید
                                                                            </div>
                                                                            <hr>
                                                                            <div class="">
                                                                                <div>
                                                                                    <input type="file"
                                                                                           name="image">
                                                                                    @error('image')
                                                                                    <p class="input-error-validation">
                                                                                        {{ $message }}
                                                                                    </p>
                                                                                    @endif
                                                                                </div>
                                                                                <button
                                                                                    class="btn btn-blue mt-3">
                                                                                    ارسال
                                                                                </button>

                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                @else
                                                                    <div class="alert alert-info">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center">
                                                                            <span>مشاهده رسید واریزی</span>
                                                                            <a target="_blank"
                                                                               href="{{ imageExist(env('ORDER_IMAGE_UPLOAD_PATH'),$order->image) }}"
                                                                               class="btn btn-blue">
                                                                                مشاهده
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label> تاریخ ثبت:</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ verta($order->created_at) }}" disabled>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>وضعیت سفارش:</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ $order->DeliveryMethodStatus->title }}"
                                                               disabled>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>مبلغ کل (تومان):</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ number_format($order->total_amount) }}"
                                                               disabled>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>مبلغ کد تخفیف (تومان):</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ number_format($order->coupon_amount) }}"
                                                               disabled>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label> کیف پول (تومان):</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ number_format($order->wallet) }}"
                                                               disabled>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>            @if($order->DeliveryMethod->id==6 or $order->DeliveryMethod->id==7)
                                                                @if($order->address->province_id==3 or $order->address->province_id==8)
                                                                    هزینه ارسال:
                                                                @else
                                                                    هزینه حمل تا {{ $order->DeliveryMethod->name }}:
                                                                @endif
                                                            @else
                                                                هزینه ارسال:
                                                            @endif</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ number_format($order->delivery_amount) }}"
                                                               disabled>
                                                    </div>
                                                    @if($order->paymentMethod->id==3)
                                                        @if($order->DeliveryMethodStatus->id==1)
                                                            <div class="form-group col-md-3">
                                                                <label>مبلغ قابل پرداخت (تومان):</label>
                                                                <input class="form-control" type="text"
                                                                       value="{{ number_format($order->paying_amount) }}"
                                                                       disabled>
                                                            </div>
                                                        @elseif($order->DeliveryMethodStatus->id==2)
                                                            <div class="form-group col-md-3">
                                                                <label>مبلغ پرداختی (تومان):</label>
                                                                <input class="form-control" type="text"
                                                                       value="{{ number_format($order->paying_amount) }}"
                                                                       disabled>
                                                            </div>
                                                        @else
                                                            <div class="form-group col-md-3">
                                                                <label>مبلغ قابل پرداخت (تومان):</label>
                                                                <input class="form-control" type="text"
                                                                       value="{{ number_format($order->paying_amount) }}"
                                                                       disabled>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="form-group col-md-3">
                                                            <label>مبلغ پرداختی (تومان):</label>
                                                            <input class="form-control" type="text"
                                                                   value="{{ number_format($order->paying_amount) }}"
                                                                   disabled>
                                                        </div>
                                                    @endif

                                                    <div class="form-group col-md-3">
                                                        <label>مانده (تومان):</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ number_format($order->deposit) }}"
                                                               disabled>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>نوع پرداخت:</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ $order->paymentMethod->title }}"
                                                               disabled>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label> وضعیت پرداخت:</label>
                                                        <input class="form-control" type="text"
                                                               value=" {{ $order->payment_status }}"
                                                               disabled>
                                                    </div>
                                                    <div class="form-group col-md-3 mb-2">
                                                        <label>روش ارسال:</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ $order->DeliveryMethod->name }}"
                                                               disabled>
                                                    </div>


                                                    @php
                                                        $time = explode('-',$order->delivery_date);

                                                    @endphp

                                                    <div class="form-group col-md-3 mb-2">
                                                        <label>زمان دریافت کالا:</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ count($time) > 1 ? $time[1].' ' .$time[2].'  '.$order->delivery_time : ' ' }}"
                                                               disabled>
                                                    </div>
                                                    @php

                                                        $address = \App\Models\UserAddress::where('id',$order->address_id)->first();

                                                    @endphp
                                                    <div class="form-group col-md-3">
                                                        <label>تحویل گیرنده:</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ $address->title == null ? 'کاربر' :$address->title }}"
                                                               disabled>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>شماره همراه:</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ $address->cellphone }}" disabled>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>شماره تماس دوم:</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ $address->tel }}" disabled>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>کد تخفیف:</label>
                                                        <input class="form-control" type="text"
                                                               value="{{ $order->coupon_id == null ? 'استفاده نشده' : $order->coupon->code }}"
                                                               disabled>
                                                    </div>


                                                    @if($order->DeliveryMethod->id==1)
                                                        <div class="form-group col-md-3 mb-2">
                                                            <label>کد رهگیری :</label>
                                                            <input class="form-control" type="text"
                                                                   value="{{ $order->TrackingCode }}"
                                                                   disabled>
                                                        </div>
                                                    @endif
                                                    <div class="form-group col-md-12">
                                                        <label>آدرس:</label>
                                                        <textarea class="form-control"
                                                                  disabled>{{ province_name($order->address->province_id).' / '.city_name($order->address->city_id).' - '.$order->address->address }}</textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>توضیحات سفارش:</label>
                                                        <textarea class="form-control"
                                                                  disabled>{{ $order->description != null ? $order->description : ' ' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        //enderror--}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr>
                                                <div class="table-responsive">
                                                    <table style="width:800px"
                                                           class="table table-bordered table-striped text-center">
                                                        <thead style="background-color:#6a91aa" class=" text-white">
                                                        <tr>
                                                            <th class="product-name"><span>تصویر</span></th>
                                                            <th class="product-name"><span>عنوان</span></th>
                                                            <th class="product-name"><span>اقلام افزوده</span>
                                                            </th>
                                                            <th class="product-quantity"><span>تعداد</span></th>
                                                            <!--<th class="product-price"><span>قیمت واحد</span></th>-->
                                                            <!--<th class="product-price"><span>مالیات</span></th>-->

                                                            <!--<th class="product-subtotal"><span>جمع</span></th>-->
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php
                                                            $i=1;
                                                            $total_quantitiy=0;
                                                        @endphp
                                                        @foreach ($order->orderItems as $item)
                                                                <?php
                                                                $product_attr_variation = \App\Models\ProductAttrVariation::where('product_id', $item->product_id)
                                                                    ->where('attr_value', $item->variation_id)
                                                                    ->where('color_attr_value', $item->color_id)
                                                                    ->first();
                                                                if ($product_attr_variation != null) {
                                                                    $product_attr_variation_id = $product_attr_variation->id;
                                                                    $item['product_attr_variation_id'] = $product_attr_variation_id;
                                                                }
                                                                ?>
                                                            <tr>
                                                                <td class="product-thumbnail">
                                                                    <div class="p-relative">
                                                                        <a href="{{ route('home.product',['alias'=>$item->Product->alias]) }}">
                                                                            <figure>
                                                                                <img class="img-thumbnail"
                                                                                     src="{{ imageExist(env('PRODUCT_IMAGES_THUMBNAIL_UPLOAD_PATH'),$item->Product->primary_image) }}"
                                                                                     alt="product">
                                                                            </figure>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <td class="product-name">
                                                                    <a href="{{ route('home.product',['alias'=>$item->Product->alias]) }}">
                                                                        {{ $item->Product->name }}
                                                                        <br>
                                                                        <br>
                                                                        @if(isset($item->AttributeValues->id) and  $item->AttributeValues->id!=217)
                                                                            <br>
                                                                            {{ $item->AttributeValues->name ?? '' }}
                                                                        @endif
                                                                        @if(isset($item->Color->id) and  $item->Color->id!=346)
                                                                            <br>
                                                                            {{ $item->Color->name ??'' }}
                                                                            <br>
                                                                        @endif
                                                                    </a>
                                                                </td>
                                                                <td class="product-name">
                                                                    <a>
                                                                        @if($item->option_ids!=null)
                                                                            @if(product_price($item->product_id,$item->product_attr_variation_id)[1]!=0)
                                                                                <br>
                                                                            @endif
                                                                            @foreach(json_decode($item->option_ids) as $option)
                                                                                @php
                                                                                    $product_option=\App\Models\ProductOption::where('id',$option)->withTrashed()->first();
                                                                                @endphp
                                                                                @if(isset($product_option->VariationValue->name))
                                                                                    <br>{{ $product_option->VariationValue->name }}
                                                                                @else
                                                                                    مشکل در نمایش ویژگی
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    {{ $item->quantity }}
                                                                </td>

                                                                <!--                         <td class="product-price">-->
                                                                <!--<span class="amount">-->
                                                                <!--    {{ number_format($item->product_price) }} تومان-->
                                                                <!--    @if($item->option_ids!=null)-->
                                                                <!--        {{ $item->option_price }}-->
                                                                <!--    @endif-->
                                                                <!--</span>-->
                                                                <!--                         </td>-->
                                                                <!--                         <td>-->
                                                                <!--     <span class="amount">-->
                                                                <!--                {{ number_format($item->tax) }}تومان-->
                                                                <!--     </span>-->
                                                                <!--                         </td>-->

                                                                <!--                         <td class="product-subtotal">-->
                                                                <!--                                -->
                                                                <!--                                {{ $total_tax = ($item->tax) * ($item->quantity)}}-->
                                                                <!--                                 -->
                                                                <!--                             <span class="amount">-->
                                                                <!--                {{ number_format($item->subtotal+$total_tax) }}-->
                                                                <!--      تومان </span>-->
                                                                <!--                         </td>-->
                                                            </tr>
                                                                <?php
                                                                $i++;
                                                                $total_quantitiy = $total_quantitiy + $item->quantity;
                                                                ?>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                {!! $order->paymentMethod->description !!}
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div style="justify-content: space-around;" class="d-flex">
                                                <a href="{{ route('home.orders.users_profile.index') }}"
                                                   class="btn btn-gold mt-5">بازگشت</a>
                                                @if($order->DeliveryMethodStatus->id==1 and $order->payment_type == 3)
                                                    <button id="payment-online"
                                                            class="btn btn-sm btn-blue mt-5">
                                                        پرداخت آنلاین
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
