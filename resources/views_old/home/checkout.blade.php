@extends('home.layouts.index')

@section('title')
    انتخاب آدرس
@endsection

@section('description')
@endsection

@section('keywords')
@endsection

@section('script')
    <script>
        var elementPosition = $('.fixed-scroll').offset().top;



        $(window).scroll(function(){
            if($(window).scrollTop() > elementPosition){

                $('.fixed-scroll').css('position','sticky').css('top',60);


            } else {

                $('.fixed-scroll').css('position','static');
            }
        });
        $(document).ready(function () {
            $('#alopeyk_location').val('');
            $('#dayNameInput').val('');
            $('#send_time_select').val('');
            $('select').removeClass('nice-select');
            $('select').show();
            $('div .nice-select').remove();
            // add delivery price to payment box
            add_price_to_payment_box();
            let address_id = $('.km-address-style.km-active').data('id');
            checkout_calculate_delivery(address_id);
        })
        $('#address-select').change(function () {
            $('#address-input').val($(this).val());
        });
        $('.province-select').change(function () {
            var provinceID = $(this).val();
            if (provinceID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-province-cities-list') }}?province_id=" + provinceID,
                    success: function (res) {
                        if (res) {
                            $(".city-select").empty();
                            $('.city-select').append('<option selected value="' + 0 + '">' +
                                'انتخاب کنید' + '</option>')
                            $.each(res, function (key, city) {
                                $(".city-select").append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });
                            $(".city-select .list").show();
                        } else {
                            $(".city-select").empty();
                        }
                    }
                });
            } else {
                $(".city-select").empty();
            }
        });
        $('#createNewAddress').click(function () {
            $('#collapseAddAddress').slideToggle();

            setTimeout(function () {
                window.location.href = '#collapseAddAddress';
                window.scrollTo(0, 600);
            }, 200)

        })
       function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
  return true;
}

        function add_price_to_payment_box() {
            let delivery_method_selected = $('#selectDeliveryItems').find('.km-active');
            let price = delivery_method_selected.find('.priceIn').text();
           
            let send_method = delivery_method_selected.find('.priceIn').find('.send_method').val();
            price = price.replaceAll(',', '');
             
            price = price.replaceAll(' ', '');
          
            price = price.replaceAll('تومان', '');
                // console.log(price);
            if (price == 0) {
                $('#calculate_delivery_price').text(delivery_method_selected.find('.priceIn').text());
                price = 0;
            } else {
               
                $('#calculate_delivery_price').text(number_format(parseInt(price)) + ' تومان ');
            }
            let total_payment = {{ calculateCartPrice()['sale_price']- session()->get('coupon.amount') }};
            total_payment = parseInt(total_payment) + parseInt(price);
           
            $('#total_payment').text(number_format(total_payment) + ' تومان ');
        }

        function selectAddress(tag, address_id) {
            $('.km-address-style').removeClass('km-active');
            $(tag).addClass('km-active');
            $('#address_selected_id').val(address_id);
            checkout_calculate_delivery(address_id);
        }

        function checkout_calculate_delivery(address_id) {
            $('#delivery_method_selected_id').val('');
            $.ajax({
                url: "{{ route('home.checkout_calculate_delivery') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    address_id: address_id,
                },
                type: "POST",
                dataType: "json",
                success: function (msg) {
                    if (msg) {
                        if (msg[0] === 1) {
                            $('#selectDeliveryItems').html(msg[1]);
                            $('#delivery_method_selected_id').html(msg[2]);
                            if (msg[3]) {
                                $('#delivery_time').removeClass('d-none');


                            } else {
                                $('#delivery_time').addClass('d-none');
                            }
                            $('#calculate_delivery_price').text('انتخاب روش ارسال الزامی است');
                        }
                        if (msg[0] === 0) {
                            $('#selectDeliveryItems').html(msg[1]);
                            $('#calculate_delivery_price').html('<p style="font-size: 9pt;margin: 0" class="text-danger">امکان ارسال وجود ندارد</p>');
                        }
                    }
                }
            })
        }

        function selectDeliveryMethod(tag, delivery_selected_id) {
            $('.km-delivery-type-style').removeClass('km-active');
            $(tag).addClass('km-active');
            $('#delivery_method_selected_id').val(delivery_selected_id);
            if (delivery_selected_id == 3) {
                $('#MapModal').modal('show');
                //show Map
                var map_token = '{{ \App\Models\AlopeykConfig::first()->neshan_token }}';
                setTimeout(function () {
                    var location = $('[name="alopeyk_location"]').val();
                    if (location.length > 0) {
                        var center = [location.split('-')[0], location.split('-')[1]];
                    } else {
                        var center = [35.699739, 51.338097];
                    }
                    var map = new L.Map('map', {
                        key: map_token,
                        maptype: 'dreamy',
                        poi: true,
                        traffic: false,
                        center: center,
                        zoom: 14
                    });
                    var marker;
                    if (location.length > 0) {
                        location = location.split('-');
                        console.log(location);
                        marker = new L.Marker([location[0], location[1]]).addTo(map); // set
                    }
                    map.on('click', function (e) {
                        if (marker) { // check
                            map.removeLayer(marker); // remove
                        }
                        marker = new L.Marker([e.latlng.lat, e.latlng.lng]).addTo(map); // set
                        $('[name="alopeyk_location"]').val(e.latlng.lat + '-' + e.latlng.lng);
                        console.log(marker.getLatLng());
                    });
                }, 1000);
            }
            $.ajax({
                url: "{{ route('home.select_delivery_method') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    delivery_selected_id: delivery_selected_id,
                },
                type: "POST",
                dataType: "json",
                success: function (msg) {
                    if (msg) {
                        if (msg[0] == 1) {
                            if (msg[1]) {
                                $('#delivery_time').removeClass('d-none');

                                window.location.href = '#delivery_time';

                            } else {
                                $('#delivery_time').addClass('d-none');
                            }
                        }
                    }
                }
            })
            add_price_to_payment_box();
        }

        function getAlopeykPrice() {
            let alopeyk_location = $('#alopeyk_location').val();
            $.ajax({
                url: "{{ route('home.calculateAloPeykPrice') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    alopeyk_location: alopeyk_location,
                },
                type: "POST",
                dataType: "json",
                success: function (msg) {
                    if (msg) {
                        if (msg[0] == 0) {
                            swal({
                                title: 'دقت کنید',
                                text: msg[1],
                                icon: 'warning',
                                timer: 3000,
                            })
                        }
                        if (msg[0] == 1) {
                            if (msg[1]) {
                                $('#MapModal').modal('hide');
                                $('.alopeyk_price').text(msg[1]);
                            } else {
                                $('#delivery_time').addClass('d-none');
                            }
                            add_price_to_payment_box();
                        }
                    }
                }
            })
        }

        function selectDayName(tag, day) {
            $('.km-item').removeClass('km-active');
            $(tag).addClass('km-active');
            $('#dayNameInput').val(day);
        }

        function selectSendTime(tag, time) {
            $('.hours').removeClass('km-active');
            $(tag).addClass('km-active');
            $('#send_time_select').val(time);
        }

        function submitCheckOut(e, tag) {
            e.preventDefault();
            let address_id = $('#address_selected_id').val();
            let delivery_method_selected_id = $('#delivery_method_selected_id').val();
            let dayNameInput = $('#dayNameInput').val();
            let send_time_select = $('#send_time_select').val();
            let alopeyk_location = $('#alopeyk_location').val();
            $.ajax({
                url: "{{ route('home.checkoutSaveStep1') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    address_id: address_id,
                    delivery_method_selected_id: delivery_method_selected_id,
                    dayNameInput: dayNameInput,
                    send_time_select: send_time_select,
                    alopeyk_location: alopeyk_location,
                },
                type: "POST",
                dataType: "json",
                success: function (msg) {
                    if (msg) {
                        if (msg[0] == 0) {
                            swal({
                             
                                text: msg[1],
                                icon: 'warning',
                                timer: 5000,
                                buttons:false,
                            })
                        }
                        if (msg[0] == 1) {
                            swal({
                                text: msg[1],
                                icon: 'success',
                                timer: 5000,
                                buttons:false,
                            })
                            setTimeout(function () {
                                location.href = "{{ route('home.checkout.preview') }}"
                            }, 1500)
                        }
                        if (msg[0] == 2) {
                            swal({
                                text: msg[1],
                                icon: 'warning',
                                timer: 3000,
                            });
                            $('#MapModal').modal('show');
                        }
                        if (msg[0] == 3) {
                            $('#modal_address').text(msg[1]);
                            $('#modal_address_id').val(address_id);
                            $('#PostalCodeModal').modal('show');
                        }
                    }
                }
            })
        }

        function AddPostalCodeToAddress() {
            $('#error_postalCode').hide();
            let address_id = $('#modal_address_id').val();
            let modal_postalCode = $('#modal_postalCode').val();
            $.ajax({
                url: "{{ route('home.AddPostalCodeToAddress') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    address_id: address_id,
                    modal_postalCode: modal_postalCode,
                },
                type: "POST",
                dataType: "json",
                success: function (msg) {
                    if (msg[0] === 0) {
                        $('#error_postalCode').show();
                        $('#error_postalCode').text(msg[1]);
                    }
                    if (msg[0] === 1) {
                        $('#PostalCodeModal').modal('hide');
                        swal({
                            text: msg[1],
                            icon: 'success',
                            timer: 1500,
                        })
                        setTimeout(function () {
                            location.href = "{{ route('home.checkout.preview') }}"
                        }, 1500)
                    }
                }
            })
        }
       $('.mobile-menu-toggle').click(function(){
        $('.loaded').addClass('mmenu-active');
    })
    $('.mobile-menu-close').click(function(){
        $('.loaded').removeClass('mmenu-active');
    })
       $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
          $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
          
   $('div#categories > ul.mobile-menu > li > a > span.toggle-btn').click(function(e){
        e.preventDefault();
       $('div#categories > ul.mobile-menu > li > a').next().slideToggle(300).parent().toggleClass("show");
       })
    </script>
@endsection

@section('style')
    <style>
      input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
            textarea {
  resize: none !important;
}
        .border-error{
            border-color:red;
        }
        .show {
            display: block;
        }
        .font-size-rem{
            font-size:1.8rem !important;
        }
        

        @media screen and (max-width: 768px) {
            .km-title_mobile {
                right: -70px;
                position: relative;
            }
            /*.km-title-right{*/
            /*    text-align:right !important;*/
            /*}*/
            .text-span-right{
                text-align:right;
                width:100%;
                display:block;
            }
            .km-delivery-type-style .price .title{
                width: 47% !important;
    padding-right: 17px;
            }
            .km-delivery-type-style .price{
                justify-content:normal !important;
                margin-right:0 !important;
            }

            .cart-title {
                text-align: right !important;
            }
            .title-right-mobile{
                text-align:right !important;
            }

            .price {
                display: flex;
                justify-content: space-around;
                margin-top: 15px;
            }

            .price .title {
                margin-top: 10px;
            }
            .km-img{
                width:30% !important;
                margin:0 !important;
            }
            .km-content{
                width:110% !important;
                text-align:center !important;
            }
        }


        .alert_delivery_price {
            display: none;
        }

        #delivery_price {
            display: none;
        }

        .m-0 {
            margin: 0 !important;
        }

        .km-title-style-theme-2 {
            margin-top: -24px !important;
            margin-bottom: -29px !important;
        }

        .cursor-pointer {
            cursor: pointer !important;
        }

        .btn-code-style {
            background-color: #6a91aa !important;
            color: #fff !important;
            border: 0 !important;
        }

        .nice-select {
            width: 100%;
        }

        .deActive {
            background-color: #e6e6e6;
        }

        #collapseAddAddress {
            display: none;
        }

        .w-50 {
            width: 50% !important;
        }

        .bg-border-0 {
            background-color: #6a91aa !important;
            color: #fff !important;
            border: 0 !important;
        }

        .cart-title-2 {
            text-align: center !important;
            font-size: 2.2rem !important;
            font-weight: bold !important;
        }
        .km-delivery-time-tab > div{
            border: 1px solid #6a91aa ;
            border-radius: 5px;
            margin: 2px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('home/css/checkout.css') }}">
@endsection

@section('content')

    @auth
        <section class="p-5">
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
                                                <div class="km-step--item vp-active  ">

                                                    <svg class="svgDark" fill="none" height="17" viewBox="0 0 22 17"
                                                         width="22" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M7.965 13C7.84612 13.8343 7.43021 14.5977 6.79368 15.1499C6.15714 15.7022 5.34272 16.0063 4.5 16.0063C3.65728 16.0063 2.84286 15.7022 2.20632 15.1499C1.56979 14.5977 1.15388 13.8343 1.035 13H0V1C0 0.734784 0.105357 0.48043 0.292893 0.292893C0.48043 0.105357 0.734784 0 1 0H15C15.2652 0 15.5196 0.105357 15.7071 0.292893C15.8946 0.48043 16 0.734784 16 1V3H19L22 7.056V13H19.965C19.8461 13.8343 19.4302 14.5977 18.7937 15.1499C18.1571 15.7022 17.3427 16.0063 16.5 16.0063C15.6573 16.0063 14.8429 15.7022 14.2063 15.1499C13.5698 14.5977 13.1539 13.8343 13.035 13H7.965ZM14 2H2V10.05C2.39456 9.6472 2.8806 9.34568 3.41675 9.17112C3.9529 8.99655 4.52329 8.95411 5.07938 9.04739C5.63546 9.14068 6.16077 9.36693 6.61061 9.7069C7.06044 10.0469 7.42148 10.4905 7.663 11H13.337C13.505 10.647 13.73 10.326 14 10.05V2ZM16 8H20V7.715L17.992 5H16V8ZM16.5 14C16.898 14 17.2796 13.8419 17.561 13.5605C17.8424 13.2791 18.0005 12.8975 18.0005 12.4995C18.0005 12.1015 17.8424 11.7199 17.561 11.4385C17.2796 11.1571 16.898 10.999 16.5 10.999C16.102 10.999 15.7204 11.1571 15.439 11.4385C15.1576 11.7199 14.9995 12.1015 14.9995 12.4995C14.9995 12.8975 15.1576 13.2791 15.439 13.5605C15.7204 13.8419 16.102 14 16.5 14ZM6 12.5C6 12.303 5.9612 12.108 5.88582 11.926C5.81044 11.744 5.69995 11.5786 5.56066 11.4393C5.42137 11.3001 5.25601 11.1896 5.07403 11.1142C4.89204 11.0388 4.69698 11 4.5 11C4.30302 11 4.10796 11.0388 3.92597 11.1142C3.74399 11.1896 3.57863 11.3001 3.43934 11.4393C3.30005 11.5786 3.18956 11.744 3.11418 11.926C3.0388 12.108 3 12.303 3 12.5C3 12.8978 3.15804 13.2794 3.43934 13.5607C3.72064 13.842 4.10218 14 4.5 14C4.89782 14 5.27936 13.842 5.56066 13.5607C5.84196 13.2794 6 12.8978 6 12.5Z"
                                                            fill="#ED303D"></path>
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
                <div class="row my-3">
                    <div class="col-12">
                        <div class="km-title-style-theme km-title-style-theme-2">
                            <h1 class="km-title font-size-rem km-title_mobile"> انتخاب آدرس تحویل سفارش:</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="justDesktop">
                                    <div class="km-box-style2 after-clear mb-3">
                                        @foreach($addresses as $key=>$address)
                                            <div style="padding: 10px !important"
                                                 onclick="selectAddress(this,{{ $address->id }})"
                                                 data-id="{{ $address->id }}"
                                                 class="km-address-style m-1 {{ $key==0 ? 'km-active' : '' }} mb-3">
                                                <!--@if($key==0)-->
                                                <!--    <div class="km-active-btn km-btn km-theme-3 defaultActive">پیش فرض-->
                                                <!--    </div>-->
                                                <!--@endif-->
                                                <div class="row">
                                                       <div class="title-right-mobile col-12  mb-3">
                                                        <span>خریدار:</span>
                                                        <span>{{ $address->User->first_name.' '. $address->User->last_name }}</span>
                                                    </div>
                                                 
                                                    <div class="title-right-mobile col-12 col-md-6 mb-3">
                                                        <span>کد ملی:</span>
                                                        <span>{{ $address->User->national_code }}</span>
                                                    </div>

                                                    <div class="title-right-mobile col-12 col-md-6 mb-3">
                                                            <span>
                                                        شماره همراه:
                                                            </span>
                                                        <span>{{ $address->cellphone }}</span>
                                                    </div>
                                                    <div class="title-right-mobile col-12 col-md-6 mb-3">
                                                        <span>نام و نام خانوادگی تحویل گیرنده:</span>
                                                        <span>{{ $address->title }}</span>
                                                    </div>
                                                    <div class="title-right-mobile col-12 col-md-6 mb-3">
                                                        <span>
                                                شماره تماس دوم:
                                                        </span>
                                                        <span>
                                                           {{ province_name($address->tel) }}
                                                       </span>
                                                    </div>
                                                    <div class="title-right-mobile col-12 mb-3">
                                                        <span>
                                                            استان / شهر:
                                                        </span>
                                                        <span>
                                                            {{ province_name($address->province_id).' / '.city_name($address->city_id) }}
                                                        </span>
                                                    </div>
                                                    <div class="title-right-mobile col-12 mb-3">
                                                        <span>
                                                            آدرس:
                                                        </span>
                                                        <span>
                                                          {{ $address->address }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <input id="address_selected_id" type="hidden" name="address_selected_id"
                                           value="{{ $address_id }}">
                                    <div style=" min-height: 0;" class="km-address-style-add km-address-style m-1 my-3">
                                        <button  id="createNewAddress"
                                                 class="btn btn-default btn-sm" type="submit">
                                            <i class="fa fa-plus"></i>
                                            ایجاد آدرس جدید
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="km-box-style2 d-flex flex-wrap after-clear m-1 mb-3">
                                    <div id="collapseAddAddress" class="collapse collapse-address-create-content"
                                         style="{{ count($errors->addressStore) > 0 ? 'display:block' : '' }}">

                                        <form action="{{ route('home.addresses.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                @if($user->first_name==null)
                                                    <div class="tax-select title-right-mobile col-lg-6 col-md-6 mb-3">
                                                        <label class="mb-2">
                                                            نام:
                                                        </label>
                                                        <input class="form-control {{$errors->has('first_name') ? 'border-error': ''}}" type="text" name="first_name"
                                                               value="{{ old('first_name') }}">
                                                        @error('first_name', 'addressStore')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                        @enderror
                                                    </div>
                                                @endif
                                                @if($user->last_name==null)
                                                    <div class="tax-select title-right-mobile col-lg-6 col-md-6 mb-3">
                                                        <label class="mb-2" for="last_name">
                                                            نام خانوادگی:
                                                        </label>
                                                        <input id="last_name" class="form-control {{$errors->has('last_name') ? 'border-error': ''}}" type="text"
                                                               name="last_name"
                                                               value="{{ old('last_name') }}">
                                                        @error('last_name', 'addressStore')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                        @enderror
                                                    </div>
                                                @endif
                                                            @php
                                                    $orders = \App\Models\Order::where('user_id' , $user->id)->get();
                                                    
                                                    @endphp
                                                @if($user->national_code==null or $orders == null)
                                                    <div class="tax-select title-right-mobile col-lg-6 col-md-6 mb-3">
                                                        <label class="mb-2" for="national_code">
                                                            کد ملی:
                                                        </label>
                                                        <input id="national_code" class="form-control {{$errors->has('national_code') ? 'border-error': ''}} " type="text"
                                                               name="national_code"
                                                               value="{{ old('national_code') }}">
                                                        @error('national_code', 'addressStore')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                        @enderror
                                                    </div>
                                                @endif
                                                <div class="tax-select title-right-mobile col-lg-6 col-md-6 mb-3">
                                                    <label class="mb-2">
                          نام و نام خانوادگی تحویل گیرنده:
                                                    </label>
                                                    <input class="form-control {{$errors->has('title') ? 'border-error': ''}}" type="text" name="title"
                                                           value="{{ old('title') }}">
                                                    @error('title', 'addressStore')
                                                    <p class="input-error-validation">
                                                        <strong>فیلد نام و نام خانوادگی الزامی است</strong>
                                                    </p>
                                                    @enderror
                                                </div>
                                              
                                                <div class="tax-select title-right-mobile col-lg-6 col-md-6 mb-3">
                                                    <label class="mb-2">
                                                        شماره تماس دوم:
                                                    </label>
                                                    <input onkeypress="return isNumberKey(event)" class="form-control {{$errors->has('tel') ? 'border-error': ''}}" type="number" name="tel"
                                                           value="{{ old('tel') }}">
                                                    @error('tel', 'addressStore')
                                                    <p class="input-error-validation">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="tax-select title-right-mobile col-lg-6 col-md-6 mb-3">
                                                    <label class="mb-2">
                                                        استان:
                                                    </label>
                                                    <select class="form-control {{$errors->has('province_id') ? 'border-error': ''}} email s-email s-wid province-select"
                                                            name="province_id">
                                                        <option value="" selected>انتخاب کنید
                                                        </option>
                                                        @foreach ($provinces as $province)
                                                            <option
                                                                value="{{ $province->id }}">{{ $province->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('province_id', 'addressStore')
                                                    <p class="input-error-validation">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                    @enderror
                                                </div>

                                                <div class="tax-select title-right-mobile col-lg-6 col-md-6 mb-3">
                                                    <label class="mb-2">
                                                        شهر:
                                                    </label>
                                                    <select class="form-control {{ $errors->has('city_id') ? 'border-error': ''}} email s-email s-wid city-select"
                                                            name="city_id">

                                                        <option value="" selected>انتخاب کنید
                                                        </option>
                                                    </select>
                                                    @error('city_id', 'addressStore')

                                                    <p class="input-error-validation">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="tax-select title-right-mobile col-md-12">
                                                    <label class="mb-2">
                                                        نشانی:
                                                    </label>
                                                    <textarea rows="8" class="form-control {{$errors->has('address') or $errors->has('addressStore') ? 'border-error': ''}}" type="text"
                                                              name="address">{{ old('address') }}</textarea>
                                                    @error('address', 'addressStore')
                                                    <p class="input-error-validation">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class=" col-lg-12 col-md-12 mt-3">
                                                    <button class="btn btn-blue btn-outline btn-rounded mt-2"
                                                            type="submit"> ثبت آدرس
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if($address_id!=null)
                                <div class="col-12">
                                    <div class="km-box-style2  after-clear">
                                        <div style="padding-bottom:0" class="kmAddressListContainer"
                                             id="kmAddressListContainer">
                                            <div class="km-title-style-new">
                                                <h3 class="km-title font-size-rem km-title_mobile">انتخاب شیوه ارسال:</h3>
                                            </div>
                                            <div class="km-delivery-type-list">
                                                <input id="delivery_method_selected_id" name="shippingoption"
                                                       type="hidden"
                                                       value="">
                                                <div id="selectDeliveryItems"
                                                     class="d-flex flex-wrap flex-x-spaceBetween">
                                                    @foreach($deliveryMethod as $key=>$item)
                                                            <?php
                                                            if ($item->exist_service == true) {
                                                                $onclick = 'onclick="selectDeliveryMethod(this,' . $item->id . ')"';
                                                            } else {
                                                                $onclick = '';
                                                            }
                                                            ?>
                                                        <div <?php echo $onclick ?> class="d-md-flex justify-content-between km-delivery-type-style {{ $item->exist_service==true ? '' : 'deActive' }}">
                                                            <input checked="" class="km-value-control none km-active"
                                                                   type="radio" value="">
                                                            <div class="d-md-flex flex-y-center">
                                                                <div class="km-img">
                                                                    <img alt="پیک موتوری"
                                                                         src="{{ imageExist(env('DELIVERY_METHOD_ICON'),$item->image) }}">
                                                                </div>
                                                                <div class="km-content">
                                                                    <div class="km-title km-title-right">{{ $item->name }}</div>
                                                                    <div class="km-description">
                                                                        {{ $item->description }}
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="price">
                                                                <div class="title">هزینه:</div>
                                                                <div
                                                                    class="priceIn {{ $item->id==3 ? 'alopeyk_price' : '' }}">
                                                                    <input type="hidden" class="send_method"
                                                                           value="{{  $item->id }}">
                                                                    {{$item->delivery_price }}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                </div>
                                                <br><br>
                                            </div>
                                        </div>
                                        <div id="delivery_time"
                                             class="km-delivery-time-container d-none"
                                             style="">
                                            <div class="km-title-style-theme">
                                                <h1 class="km-title font-size-rem delivery-title">انتخاب زمان تحویل:</h1>
                                            </div>
                                            <div class="km-delivery-time km-box-style2">
                                                <span class="text-span-right">انتخاب روز:</span>
                                                <div class="km-delivery-time-tab">
                                                    @foreach($date as $item)
                                                        @if(!in_array(verta($item)->format('l'),$holidaysName))
                                                            <div
                                                                onclick="selectDayName(this,'{{ verta($item)->format('l d F') }}')"
                                                                data-val="{{ $item }}"
                                                                class="km-item {{ in_array(verta($item)->format('l'),$holidaysName)  ? '' : 'text-success' }}">
                                                                <div
                                                                    class="km-day-name">{{ verta($item)->format('l d F') }}</div>
                                                            </div>
                                                        @else
                                                            <div data-val="{{ $item }}"
                                                                 class="km-item {{ in_array(verta($item)->format('l'),$holidaysName)  ? '' : 'text-success' }}">
                                                                <div
                                                                    class="km-day-name">{{ verta($item)->format('l d F') }}</div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    <input type="hidden" id="dayNameInput">
                                                </div>
                                                <div class="km-delivery-time-contents">
                                                    <div class="km-item km-active" km-id="0">
                                                        <div class="km-cart-detail-select mt-5">
                                                            <div>
                                                                <span class="text-span-right">انتخاب ساعت:</span>
                                                            </div>

                                                            @foreach($sent_times as $key=>$item)
                                                                <div onclick="selectSendTime(this,'{{ $item }}')"
                                                                     data-val="{{ $item }}"
                                                                     class="km-detail hours">
                                                                    <div
                                                                        class="pretty p-icon p-smooth p-round p-bigger">
                                                                        <input type="radio" name="shippingDate"
                                                                               checked=""
                                                                               value="1400/12/09 12:00" 1400="" 12=""
                                                                               09="">
                                                                        <div class="state p-success-o ">
                                                                            <i class="icon fal "></i>
                                                                            <label>ساعت {{ $item }}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <input type="hidden" id="send_time_select"
                                                                   value="{{ $item }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-group col-12">

                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div style="height: 1000px" class="col-12 col-lg-4">
                        <div class="row fixed-scroll">
                            <div class="col-12 mb-20 km-box-style2">
                                <div class="cart-summary">
                                    <form class="coupon" action="{{ route('home.coupons.check') }}" method="post">
                                        @csrf
                                        <h5 style="font-size:1.8rem"
                                            class="title font-size-rem coupon-title font-weight-bold text-uppercase">
                                            کد تخفیف:
                                        </h5>
                                        <input type="text" class="form-control mb-4" name="couponCode"
                                               placeholder="کد تخفیف را وارد کنید..."/>
                                        @error('couponCode')
                                        <p class="input-error-validation">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                        @enderror
                                        <button class="btn btn-code-style btn-blue btn-outline btn-rounded">اعمال کد
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12  km-box-style2">
                                <div>
                                    <div class="cart-summary mb-4">
                                        <h3 style="font-size:1.8rem !important" class="cart-title font-size-rem cart-title-2 text-uppercase">خلاصه سبد خرید </h3>
                                        <div class=" d-flex align-items-center justify-content-between">
                                            <label>کل سبد خرید </label>
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
                                            <label>مبلغ کد تخفیف</label>
                                            <span
                                                class="ls-50">{{ number_format( session()->get('coupon.amount') ) }} تومان</span>
                                        </div>
                                        <hr class="divider">
                                        <div class="order-total d-flex justify-content-between align-items-center">
                                            <label>هزینه ارسال</label>
                                            <span id="calculate_delivery_price" class="ls-50">-</span>
                                        </div>
                                        <hr class="divider">
                                        <div class="order-total d-flex justify-content-between align-items-center">
                                            <label style="font-weight:bold;color:#000">جمع کل</label>
                                            <span style="font-weight:bold;color:#000" id="total_payment" class="ls-50">{{ number_format(calculateCartPrice()['sale_price']- session()->get('coupon.amount')) }} تومان</span>
                                        </div>
                                        <a href="{{ route('home.cart') }}"
                                           class=" btn btn-gold  btn-rounded mt-2">سبد خرید</a>
                                        <a onclick="submitCheckOut(event,this)"
                                           class="bg-border-0 btn btn-blue  btn-rounded mt-2">تایید و ادامه
                                            <i class="w-icon-long-arrow-left"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <!-- START SECTION SHOP DETAIL -->
        <section class="p-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 mb-4 mb-md-0 DefaultLogin">
                        <div class="heading_s2">
                            <h3 class="text-center">ورود</h3>
                        </div>
                        <form method="post" class="login_form" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <a href="{{ route('provider.login',['provider'=>'google']) }}"
                                   class="ht-btn black-btn w-100 my-3">ورود
                                    با حساب گوگل</a>
                                <button type="button" class="ht-btn black-btn w-100 loginWithSMS">ورود پیامکی</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-12 col-xl-5 col-12 SMSLoginBox">
                        <div class="contact-form-wrapper">
                            <!-- Start Contact Form -->
                            <div class="axil-contact-form contact-form-style-1 text-right">
                                <div>
                                    <a href="{{ route('home.index') }}"><img
                                            src="{{ asset
                                            ('/home/images/Login/Login2.png')}}"
                                            alt=""></a>
                                </div>
                                <form id="loginOTPForm">
                                    @csrf
                                    <div class="form-group">
                                        <input
                                            class="form-control"
                                            id="cellphoneInput"
                                            type="text"
                                            placeholder="شماره همراه خود را وارد کنید">
                                        <span class="focus-border"></span>

                                        <div id="cellphoneInputError" class="input-error-validation">
                                            <strong id="cellphoneInputErrorText"></strong>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="ht-btn black-btn w-100 my-3">
                                            <span class="button-text">ورود / ثبت نام با شماره همراه</span>
                                        </button>
                                    </div>
                                    <a href="{{ route('provider.login',['provider'=>'google']) }}"
                                       class="ht-btn black-btn w-100">ورود
                                        / ثبت نام با حساب گوگل</a>
                                </form>
                                <form id="checkOTPForm">
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-control"
                                               id="checkOTPInput"
                                               type="text"
                                               placeholder="رمز یکبار مصرف">
                                        <span class="focus-border"></span>

                                        <div id="checkOTPInputError" class="input-error-validation">
                                            <strong id="checkOTPInputErrorText"></strong>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="ht-btn black-btn w-100 my-3">
                                            <span class="button-text">ورود</span>
                                        </button>
                                        <button id="resendOTPButton" type="submit"
                                                class="ht-btn black-btn w-100 my-3">
                                            <span class="button-text">ارسال مجدد</span>
                                        </button>
                                        <div class="d-flex justify-content-between p-3 align-content-center">
                                            <span id="resendCodeDiv">ارسال مجدد کد </span>
                                            <span id="resendOTPTime"></span>
                                        </div>
                                    </div>
                                </form>
                                {{--                                    {!! app('captcha')->render(); !!}--}}
                            </div>
                            <!-- End Contact Form -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION SHOP DETAIL -->
    @endauth

    <!-- Modal -->
    <div class="modal fade" id="MapModal" tabindex="-1" aria-labelledby="MapModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="MapModalLabel">آدرس تحویل کالا را با دقت انتخاب نمایید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="map"
                         style="width: 100%; height: 450px; background: rgb(244, 243, 239) none repeat scroll 0% 0%; border: 2px solid rgb(170, 170, 170); position: relative;"
                         class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom"
                         tabindex="0"></div>
                    <input id="alopeyk_location" type="hidden" class="inputbox wide" name="alopeyk_location"
                           value=""/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <button onclick="getAlopeykPrice()" type="button" class="btn btn-primary">ذخیره</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="PostalCodeModal" tabindex="-1" aria-labelledby="PostalCodeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger text-center">در روش ارسال با پست پیشتاز وارد کردن کد پستی الزامی
                        است
                    </div>
                    <p id="modal_address"></p>
                    <label class="mb-2">کد پستی:</label>
                    <input class="form-control form-control-sm" id="modal_postalCode" value="">
                    <input type="hidden" id="modal_address_id" value="">
                    <span class="input-error-validation" id="error_postalCode"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <button onclick="AddPostalCodeToAddress()" type="button" class="btn btn-primary">ذخیره</button>
                </div>
            </div>
        </div>
    </div>

@endsection
