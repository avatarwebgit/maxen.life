@extends('home.layouts.index')

@section('title')
    آدرس ها
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('select').removeClass('nice-select');
            $('select').show();
            $('div .nice-select').remove();
        })
        $('.province-select').change(function () {
            var provinceID = $(this).val();
            if (provinceID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-province-cities-list') }}?province_id=" + provinceID,
                    success: function (res) {
                        if (res) {
                            $(".city-select").empty();
                            $(".city-select").append('<option selected value=""> انتخاب کنید</option>');

                            $.each(res, function (key, city) {
                                console.log(city);
                                $(".city-select").append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });

                        } else {
                            $(".city-select").empty();
                        }
                    }
                });
            } else {
                $(".city-select").empty();
            }
        });

        function collapseAddress() {
            $('#collapseAddAddress').slideToggle(1000);
        }

        function editAddress(address_id) {
            $('#collapse-address-' + address_id).slideToggle(1000);
        }

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


        $('#mobile_menu_nav').click(function () {
            $('#icon-panel').toggleClass('negative');
            $('#icon-panel').toggleClass('positive');
            $('.negative').html('-');
            $('.positive').html('+');
        })

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/profile_panel.css') }}">

    <style>
        li {
            list-style: none !important;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        #myaccountContent {
            margin-top: 0 !important;
            text-align: right !important;
        }

        .float-right {
            float: right !important;
        }

        .show {
            display: block;
        }

        .ht-btn {
            border: none !important;
            color: white !important;
        }

        .ht-btn:hover {
            background-color: #E8D2A6 !important;
            color: #000 !important;
        }

        address {
            font-style: normal;
        }
    </style>
@endsection

@section('content')
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
                                <h3> آدرس ها </h3>
                                @foreach ($addresses as $address)
                                    <div>
                                        <address class="row my-3">
                                            <div class="col-lg-4 col-12">
                                                <div class="mt-2">
                                                    <span class="font-weight-bold">نام خریدار:</span>

                                                    <span> {{ auth()->user()->first_name.' '. auth()->user()->last_name }}</span>
                                                </div>
                                                <div class="mt-2">
                                                    <span class="font-weight-bold">شماره همراه:</span>

                                                    <span>{{ $address->cellphone }}</span>
                                                </div>
                                                <div class="mt-2">
                                                    <span class="font-weight-bold">استان / شهر:</span>

                                                    <span>{{ province_name($address->province_id).'/'.city_name($address->city_id) }}</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-5 col-12">
                                                <div class="mt-2">
                                                    <span
                                                        class="font-weight-bold">نام و نام خانوادگی تحویل گیرنده:</span>

                                                    <span> {{ $address->title }}</span>
                                                </div>

                                                <div class="mt-2">
                                                    <span class="font-weight-bold">شماره تماس دوم:</span>

                                                    <span>{{ $address->tel==null ? '-' : $address->tel }}</span>
                                                </div>

                                            </div>

                                            <div class="col-12">
                                                <div class="mt-2">
                                                    <span class="font-weight-bold">نشانی:</span>

                                                    <span> {{ $address->address }}</span>
                                                </div>
                                            </div>
                                        </address>
                                        @if(!($address->Order()->count() > 0))
                                            <div class="d-flex justify-content-between">
                                                <button onclick="editAddress({{ $address->id }})"
                                                        class="btn btn-blue " type="button"> ویرایش آدرس
                                                </button>
                                                <a href="{{ route('home.addresses.delete', ['address' => $address->id]) }}"
                                                   class=" btn btn-gold " type="button">
                                                    <i class="fa fa-trash"></i>
                                                    حذف
                                                </a>
                                            </div>
                                        @endif
                                        <div id="collapse-address-{{ $address->id }}"
                                             class="collapse collapse-address-create-content mt-3"
                                             style=" {{ count($errors->addressUpdate) > 0 && $errors->addressUpdate->first('address_id') == $address->id ? 'display:block' : 'display: none' }}">
                                            <form
                                                action="{{ route('home.addresses.update', ['address' => $address->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="tax-select col-lg-6 col-md-6">
                                                        <label>
                                                            نام و نام خانوادگی تحویل گیرنده:
                                                        </label>
                                                        <input class="form-control" type="text" name="title"
                                                               value="{{ $address->title }}">
                                                        @error('title', 'addressUpdate')
                                                        <p class="input-error-validation">
                                                            <strong>
                                                                فیلد نام و نام خانوادگی الزامی است
                                                            </strong>
                                                        </p>
                                                        @enderror
                                                    </div>
                                                    <div class="tax-select col-lg-6 col-md-6">
                                                        <label>
                                                            شماره تماس دوم:
                                                        </label>
                                                        <input onkeypress="return isNumberKey(event)"
                                                               class="form-control" type="number" name="tel"
                                                               value="{{ $address->tel }}">
                                                        @error('tel', 'addressUpdate')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                        @enderror
                                                    </div>

                                                    <div class="tax-select col-lg-6 col-md-6">
                                                        <label>
                                                            استان:
                                                        </label>
                                                        <select
                                                            class="form-control email s-email s-wid province-select"
                                                            name="province_id">
                                                            @foreach ($provinces as $province)
                                                                <option value="{{ $province->id }}"
                                                                    {{ $province->id == $address->province_id ? 'selected' : '' }}>
                                                                    {{ $province->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('province_id', 'addressUpdate')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                        @enderror
                                                    </div>
                                                    <div class="tax-select col-lg-6 col-md-6">
                                                        <label>
                                                            شهر:
                                                        </label>
                                                        <select
                                                            class="form-control email s-email s-wid city-select"
                                                            name="city_id">
                                                            <option value="{{ $address->city_id }}"
                                                                    selected>
                                                                {{ city_name($address->city_id) }}
                                                            </option>
                                                        </select>
                                                        @error('city_id', 'addressUpdate')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                        @enderror
                                                    </div>


                                                    <div class="tax-select col-lg-12 col-md-12">
                                                        <label>
                                                            نشانی:
                                                        </label>
                                                        <textarea class="form-control" type="text"
                                                                  name="address"
                                                        >{{ $address->address }}</textarea>
                                                        @error('address', 'addressUpdate')
                                                        <p class="input-error-validation">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                        @enderror
                                                    </div>
                                                    <div class=" col-lg-12 col-md-12">
                                                        <button class="btn btn-blue  mt-2 mb-2" type="submit">
                                                            ثبت
                                                            تغییرات
                                                        </button>
                                                    </div>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                    <hr>
                                @endforeach
                                <button onclick="collapseAddress()" data-toggle="collapse"
                                        data-target="#collapseAddAddress"
                                        class="collapse-address-create  btn btn-blue  mt-3" type="submit">
                                    ایجاد آدرس
                                    جدید
                                </button>
                                <div id="collapseAddAddress"
                                     class="collapse collapse-address-create-content mt-3"
                                     style="{{ count($errors->addressStore) > 0 ? 'display:block' : 'display:none' }}">
                                    <form action="{{ route('home.addresses.store') }}" method="POST">
                                        @csrf
                                        <div class="row">

                                            <div class="tax-select col-lg-6 col-md-6">
                                                <label>
                                                    نام و نام خانوادگی تحویل گیرنده:
                                                </label>
                                                <input class="form-control" type="text" name="title"
                                                       value="{{ old('title') }}">
                                                @error('title', 'addressStore')
                                                <p class="input-error-validation">
                                                    <strong>
                                                        فیلد نام و نام خانوادگی الزامی است
                                                    </strong>
                                                </p>
                                                @enderror
                                            </div>
                                            <div class="tax-select col-lg-6 col-md-6">
                                                <label>
                                                    شماره تماس دوم:
                                                </label>
                                                <input onkeypress="return isNumberKey(event)"
                                                       class="form-control"
                                                       type="number" name="tel"
                                                       value="{{ old('tel') }}">
                                                @error('tel', 'addressStore')
                                                <p class="input-error-validation">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                                @enderror
                                            </div>

                                            <div class="tax-select col-lg-6 col-md-6">
                                                <label>
                                                    استان:
                                                </label>
                                                <select
                                                    class="form-control email s-email s-wid province-select"
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
                                            <div class="tax-select col-lg-6 col-md-6">
                                                <label>
                                                    شهر:
                                                </label>
                                                <select class="form-control email s-email s-wid city-select"
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


                                            <div class="tax-select col-md-12">
                                                <label>
                                                    نشانی:
                                                </label>
                                                <textarea class="form-control" type="text"
                                                          name="address">{{ old('address') }}</textarea>
                                                @error('address', 'addressStore')
                                                <p class="input-error-validation">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                                @enderror
                                            </div>


                                            <div class=" col-lg-12 col-md-12">
                                                <button class=" btn btn-blue  mt-3" type="submit"> ثبت
                                                    آدرس
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
