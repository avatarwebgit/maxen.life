<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('home/images/icons/favicon.png') }}">
    <!-- BOOTSTRAP -->
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.min.css') }}">--}}
    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style-rtl.min.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $setting->productCode.'-'.$order->order_number }}</title>

    <style>
        @media screen and (max-width: 568px) {
            .record{
                font-size: 9pt !important;
            }
        }
        body {
            background-color: #fff;
        }
        p{
            margin: 0 !important;
        }
        .p-0{
            padding: 0;
        }
        * {
            -webkit-print-color-adjust: exact !important; /*Chrome, Safari */
            color-adjust: exact !important; /*Firefox*/
        }

        .logoImage {
            width: 225px;
        }

        .font-size-22 {
            font-size: 22px;
        }

        .font-size-18 {
            font-size: 15px;
        }

        thead {
            background-color: #d3d3d3;
            height: 50px;

        }

        thead th {
            color: black;
            border: 1px solid #e7e7e7;
            text-align: center;
        }

        tbody td {
            border: 1px solid #e7e7e7;
            text-align: center;
        }

        .box-print {
            border: 1px solid #d3d3d3;
            margin-top: 5px;
        }

        .box {
            background-color: #d3d3d3;
            color: black;
            height: 50px;
            font-weight: bold;
            padding: 20px;
        }

        .border-box {
            border: 1px solid #000;
            height: 30px;
        }

        .table-details {
            margin-left: 11px;
        }

        .bg-field {
            background-color: #d3d3d3;
            font-weight: bold;
            color: black;
        }

        .description p {
            font-size: 12px;
        }

        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }
        .parantez{
            display: inline-block;
        }
        .table-responsive{
            overflow: scroll;
        }
    </style>
</head>
<body>


<div id="element-to-print">
    <div class="container">
        <div class="row">
            <div class="box-print">
                <div class="header-box mt-2 d-flex justify-content-between">
                    <div class="col mt-2 ">
                        <p class="font-weight-bold font-size-18">
                            <span>شماره سفارش</span>
                            <span style="margin-right: -3px;font-size:16px">:</span>
                            <span>{{ $setting->productCode.'-'.$order->order_number }}</span>
                        </p>

                        <p class="font-weight-bold font-size-18">
                            <span>تاریخ ثبت</span>
                            <span style="margin-right:-3px; font-size:16px">:</span>
                            <span>
                                {{ verta($order->created_at)->format('%d %B Y') }}
                            </span>
                        </p>
                    </div>
                    <div class="col">
                        <p style="font-size:16px" class="text-center font-size-18">
                            @if($order->payment_type == 3)
                                            <span>پیش فاکتور فروش</span>
                            @else
                                              <span>فاکتور فروش</span>
                            @endif

                        </p>
                        <p class="text-center font-size-18 font-weight-bold">فروشگاه اینترنتی پروفیل سازه</p>
                        <p class="text-center">www.ProfileSaze.com</p>
                    </div>
                    <div class="col">
                        <img class="logoImage" src="{{ asset(env('LOGO_UPLOAD_PATH').$setting->image) }}">
                          @if($order->user->Role->id != 3)
                              <p class="font-weight-bold font-size-18">
                            <span>شماره تماس</span>
                            <span style="margin-right:-3px; font-size:16px">:</span>
                            <span>
                                {{ $setting->tel }}
                            </span>
                        </p>
                        @endif
                    </div>
                </div>
                <div class="body-box">
                    <div class="row">
                        <div class="container">


                            @if($order->user->Role->id == 3)
                            <div class="box d-flex justify-content-between  align-items-center text-center">
                                <p class="text-center font-weight-bold">نام فروشنده
                                    <span>:</span> <span
                                        style="font-weight: normal">کیان تجارت دیانا</span></p>
                                         <p class="text-center font-weight-bold">شناسه ملی
                                    <span>:</span> <span
                                        style="font-weight: normal"> 14008414072</span>
                                </p>
                                <p class="text-center font-weight-bold">شماره تماس<span>:</span> <span
                                        style="font-weight: normal">{{$setting->tel3}}</span></p>

                            </div>
                            @endif
                              <div class="box mt-2 d-flex justify-content-between  align-items-center text-center">
                                <p class="text-center font-weight-bold">{{$order->user->Role->id==3 ? 'نام خریدار' : 'خریدار'}}
                                    <span>:</span> <span
                                        style="font-weight: normal">{{ $order->user->Role->id==3 ? $order->user->company_name: $order->user->first_name .' '. $order->user->last_name}}</span></p>
                                           <p class="text-center font-weight-bold">{{$order->user->Role->id==3 ? 'شناسه ملی' : 'کد ملی '}}
                                    <span>:</span> <span
                                        style="font-weight: normal"> {{ $order->user->Role->id==3 ? $order->user->company_shenase_melli :$order->user->national_code  }}</span>
                                </p>
                                <p class="text-center font-weight-bold">شماره تماس <span>:</span> <span
                                        style="font-weight: normal">{{ $order->user->cellphone }}</span></p>

                            </div>
                        </div>
                        <div class="container mt-3">
                            <div class="table-responsive ">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th style="font-weight: bold">کالا<span>/</span>خدمات</th>
                                        <th>تعداد</th>
                                        <th>قیمت واحد<span style="margin-right: 5px;">(تومان)</span></th>
                                        <th>جمع بدون تخفیف<span style="margin-right: 5px;">(تومان)</span></th>
                                        <th style="font-weight: bold">تخفیف<span
                                                style="margin-right: 5px;">(تومان)</span></th>

                                        <th>جمع کل<span style="margin-right: 5px;">(تومان)</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                        $total_quantitiy=0;
                                    @endphp
                                    @foreach ($order->orderItems as $key => $item)
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
                                            <td>{{$key+=1}}</td>
                                            <td>{!! set_print_characters($item->Product->name) !!}
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

                                                @if($item->option_ids!=null)
                                                    <span>+</span>
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

                                                @endif</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>
                                                @php
                                                    $product_price=$item->discount + $item->product_price;
                                                    $product_option=0;
                                                @endphp
                                                {{ number_format($product_price+$product_option) }}
                                                @if($item->option_ids!=null)
                                                    @php
                                                        $product_option=$item->option_price;
                                                    @endphp
                                                    <br>
                                                    +
                                                    <br>
                                                    {{ number_format($product_option) }}
                                                @endif</td>
                                            <td>{{ number_format(($product_option+$product_price)*$item->quantity)   }}</td>
                                            <td>{{ number_format(($item->discount)*$item->quantity) }}</td>
                                            <td>    {{ number_format($item->subtotal) }}</td>
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
                        <div class="container mt-3">
                            <div class="row ">
                                <div class="col-12 col-md-6  description">
                                    {!! set_print_characters($order->paymentMethod->description) !!}
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="table-details">
                                            <div class="record">
                                                <div class="row ">

                                                    <div class="col-6 border-box text-center">جمع کل<span>:</span></div>
                                                    <div
                                                        class="col-6 border-box text-center">{{ number_format($order->total_amount - $order->delivery_amount - $order->tax + $order->coupon_amount ) }}
                                                          <span style="margin-right:2px">تومان</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="record">
                                                <div class="row ">
                                                    <div class="col-6 border-box text-center">مالیات <span>:</span>
                                                    </div>
                                                    <div
                                                        class="col-6 border-box text-center"> {{ number_format($order->tax) }}
                                                          <span style="margin-right:2px">تومان</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="record">
                                                <div class="row ">
                                                    <div class="col-6 border-box text-center p-0">
                                                        @if($order->DeliveryMethod->id==6 or $order->DeliveryMethod->id==7)
                                                            @if($order->address->province_id==3 or $order->address->province_id==8)
                                                                هزینه ارسال<span>:</span>
                                                            @else
                                                                هزینه حمل تا {{ $order->DeliveryMethod->name }}
                                                                <span>:</span>
                                                            @endif
                                                        @else
                                                            هزینه ارسال<span>:</span>
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="col-6 border-box text-center">{!!$order->DeliveryMethod->id!=4 ?  number_format($order->delivery_amount).' '.'  <span style="margin-right:2px">تومان</span> ': 'پس کرایه ' !!}</div>
                                                </div>
                                            </div>
                                            <div class="record">
                                                <div class="row ">
                                                    <div class="col-6 border-box text-center">کد تخفیف<span>:</span>
                                                    </div>
                                                    <div
                                                        class="col-6 border-box text-center">{!! $order->coupon_id == null ? 'استفاده نشده' : number_format($order->coupon_amount).' ' . '  <span style="margin-right:2px">تومان</span> ' !!}</div>
                                                </div>
                                            </div>
                                            <div class="record">
                                                <div class="row ">
                                                    <div class="col-6 border-box text-center">کیف پول <span>:</span>
                                                    </div>
                                                    <div
                                                        class="col-6 border-box text-center">{{$order->wallet != 0 ? number_format($order->wallet).' تومان' : 'استفاده نشده'}} </div>
                                                </div>
                                            </div>
                                            <div class="record">
                                                <div class="row ">
                                                    <div class="col-6  border-box bg-field text-center">مبلغ قابل
                                                        پرداخت<span>:</span></div>
                                                    <div
                                                        class="col-6 border-box bg-field text-center">{{ $order->wallet != 0 ? number_format($order->total_amount - $order->wallet) : number_format($order->total_amount) }}
                                                        <span style="margin-right:2px">تومان</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($order->payment_type == 7)
                                                <div class="record">
                                                    <div class="row ">
                                                        <div class="col-6 border-box bg-field text-center">
                                                            بیعانه<span>:</span></div>
                                                        <div
                                                            class="col-6 border-box bg-field text-center">{{ number_format($order->paying_amount) }}
                                                              <span style="margin-right:2px">تومان</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="record">
                                                    <div class="row ">
                                                        <div class="col-6 border-box bg-field text-center">مبلغ مانده
                                                            قابل پرداخت<span>:</span></div>
                                                        <div
                                                            class="col-6 border-box bg-field text-center">{{ number_format($order->total_amount - $order->paying_amount) }}
                                                              <span style="margin-right:2px">تومان</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                     @if($order->user->Role->id!=3)
                                    <div class="row mt-1">
                                        <div class="mohr text-center">
                                            <p class="text-center mt-3 font-weight-bold">مهر فروشنده </p>
                                            <img style="width: 150px;"
                                                 src="{{ imageExist(env('MOHR_UPLOAD_PATH'),$setting->mohr) }}">

                                        </div>
                                    </div>
                                    @else
                                    <div class="row mt-1">
                                        <div class="mohr text-center">
                                            <p class="text-center mt-3 font-weight-bold">مهر فروشنده </p>
                                            <img style="width: 150px;"
                                                 src="{{ imageExist(env('MOHR_UPLOAD_PATH'),$setting->mohr_role) }}">

                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
    <div style="padding:15px" class="d-block text-center ">
                    <button class="btn btn-primary" style="font-size:15px !important"   onclick="print_screen(this)">
                    پرینت
                </button>
          </div>
                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<script src="{{ asset('home/vendor/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap JS File -->
<script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('home/js/html2pdf.bundle.min.js') }}"></script>
<script>
    // $(document).ready(function ($) {
    //     var element = document.getElementById('element-to-print');
    //     var opt = {
    //         filename: '{{ $setting->productCode.'-'.$order->order_number }}.pdf',
    //         image: {type: 'jpeg', quality: 100},
    //         html2canvas: {
    //             scale: 1
    //         },
    //         jsPDF: {
    //             orientation: 'landscape',
    //             unit: 'mm',
    //             format: 'letter',
    //             putOnlyUsedFonts: true
    //         }
    //     };
    //     html2pdf().set(opt).from(element).toContainer().save();

    // });
   function print_screen(tag){
            $(tag).fadeOut();
 
           setTimeout(function(){
                window.print();
           },1000)
           
                 setTimeout(function(){
              $(tag).fadeIn();
           },1000)   
   
        }

</script>
<script src="{{ asset('home/js/persiannumber.js') }}"></script>
</body>
</html>
