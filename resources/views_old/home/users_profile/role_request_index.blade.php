@extends('home.layouts.index')

@section('title')
    درخواست حساب کاربری حقوقی
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('home/css/profile_panel.css') }}">

    <style>
        .nice-select {
            width: 100%;
        }

        .bg-info {
            background-color: #80c2fa;
            padding: 20px;
            color: white;
        }

        .bg-danger {
            background-color: #f6a6a6;
            padding: 20px;
            color: white;
        }

        .ht-btn {
            border: none !important;
            color: white !important;
        }

        .ht-btn:hover {
            background-color: #E8D2A6 !important;
            color: #000 !important;
        }
    </style>
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
        $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
        $('div#categories > ul.mobile-menu > li > a > span.toggle-btn').click(function (e) {
            e.preventDefault();
            $(this).parent().next().slideToggle(300).parent().toggleClass("show");
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
                            $(".city-select").append('<option value="">انتخاب کنید</option>');
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
        // Show File Name
        $('#image').change(function () {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
        $('input[name="company_type"]').click(function () {
            radio_btn_checked();
        });
        $(document).ready(function () {
            radio_btn_checked();
        });

        function radio_btn_checked() {
            let company_type = $('input[name="company_type"]:checked').attr('data-company-type');
            $('.company_type').addClass('d-none');
            $('.company_type_' + company_type).removeClass('d-none');
        }

        $('#mobile_menu_nav').click(function () {
            $('#icon-panel').toggleClass('negative');
            $('#icon-panel').toggleClass('positive');
            $('.negative').html('-');
            $('.positive').html('+');
        })
    </script>
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
                                <h3>

                                    @if($user->Role->id!=3)
                                        درخواست
                                    @else
                                        ویرایش
                                    @endif
                                    حساب کاربری حقوقی </h3>
                                @if($user->role_request_status==1)
                                    <div class="alert alert-info text-center">
                                        درخواست شما در حال بررسی است
                                    </div>
                                @else
                                    @if($user->role_request_status==2)
                                        <div class="alert alert-danger text-center">
                                            متاسفانه درخواست شما برای تغییر کاربری رد شده است
                                        </div>
                                    @endif
                                    <div class="account-details-form">
                                        <form action="{{ route('home.profile.change_role') }}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="row mt-3">
                                                @error('company_type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="col-12">
                                                    <div class="single-input-item mb-2">
                                                        <label for="company_name" class="required mb-2">
                                                            نام حقوقی:
                                                        </label>
                                                        <input id="company_name" name="company_name"
                                                               class="form-control form-control-sm"
                                                               value="{{ $user->Role->id!=3 ? old('company_name') : $user->company_name }}"
                                                        >
                                                        @error('company_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="single-input-item mb-2">
                                                        <label for="company_sabt_number" class="required mb-2">
                                                            شماره ثبت:
                                                        </label>
                                                        <input
                                                            id="company_sabt_number"
                                                            name="company_sabt_number"
                                                            class="form-control form-control-sm"
                                                            type="number"
                                                            value="{{ $user->Role->id!=3 ? old('company_sabt_number') : $user->company_sabt_number }}">
                                                        @error('company_sabt_number')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="single-input-item mb-2">
                                                        <label for="company_shenase_melli" class="required mb-2">
                                                            شناسه ملی:
                                                        </label>
                                                        <input
                                                            id="company_shenase_melli"
                                                            name="company_shenase_melli"
                                                            type="number"
                                                            class="form-control form-control-sm"
                                                            value="{{ $user->Role->id!=3 ? old('company_shenase_melli') : $user->company_shenase_melli }}"
                                                        >
                                                        @error('company_shenase_melli')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label class="mb-2">
                                                        استان (دفتر مرکزی):
                                                    </label>
                                                    <select
                                                        class="form-control email s-email s-wid province-select"
                                                        name="province_id">
                                                        <option value="" selected>انتخاب کنید
                                                        </option>
                                                        @foreach ($provinces as $province)
                                                            @if($user->Role->id!=3)
                                                                <option
                                                                    value="{{ $province->id }}">{{ $province->name }}
                                                                </option>
                                                            @else
                                                                <option
                                                                    {{$user->company_province == $province->id ? 'selected' : ''}}
                                                                    value="{{ $province->id }}">{{ $province->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('province_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label class="mb-2">
                                                        شهر (دفتر مرکزی):
                                                    </label>

                                                    <select class="form-control email s-email s-wid city-select"
                                                            name="city_id">
                                                        <option value="" selected>انتخاب کنید
                                                        </option>
                                                        @if($user_province!=null)
                                                            @foreach ($user_province->Cities as $city)
                                                                @if($user->Role->id==3)
                                                                    <option
                                                                        {{ $user->company_city==$city->id ? 'selected' : '' }}
                                                                        value="{{ $city->id }}">{{ $city->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('city_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div class="single-input-item mb-2">
                                                        <label for="company_address" class="required mb-2">
                                                            آدرس:
                                                        </label>
                                                        <textarea rows="4" id="company_address" name="company_address"
                                                                  class="form-control form-control-sm">{{ $user->Role->id!=3 ? old('company_address') : $user->company_address }}</textarea>
                                                        @error('company_address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="single-input-item mb-2">
                                                        <label for="company_postalCode" class="required mb-2">
                                                            کد پستی:
                                                        </label>
                                                        <input
                                                            id="company_postalCode"
                                                            name="company_postalCode"
                                                            type="number"
                                                            class="form-control form-control-sm"
                                                            value="{{ $user->Role->id!=3 ? old('company_postalCode') : $user->company_postalCode }}">
                                                        @error('company_postalCode')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-input-item mt-3">
                                                <button type="submit" class="ht-btn btn btn-blue black-btn">
                                                    @if($user->Role->id!=3)
                                                        تکمیل
                                                    @else
                                                        ویرایش
                                                    @endif
                                                    اطلاعات
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                @endif
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
