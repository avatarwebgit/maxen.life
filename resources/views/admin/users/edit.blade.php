@extends('admin.layouts.admin')

{{-- ===========  meta Title  =================== --}}
@section('title')
    اطلاعات کاربر
@endsection
{{-- ===========  My Css Style  =================== --}}
@section('style')
    <style>
        #profile {
            width: 100%;
            height: auto;
            border: 1px solid #cccccc;
            border-radius: 50%;
        }

        .bg-light-gray {
            background-color: #f6f5f5;
        }
    </style>
@endsection
{{-- ===========  My JavaScript  =================== --}}

@section('script')
    <script>
        function changeLabel(tag) {
            //get the file name
            var fileName = tag.value;
            if (fileName.length > 0) {
                //replace the "Choose a file" label
                $('.custom-file-label').html(fileName);
            } else {
                $('.custom-file-label').html('فایلی را انتخاب نکرده اید');
            }

        }

        function submitForm(close) {
            $('#close').val(close);
            $('#user_form_info').submit();
        }
    </script>
@endsection
{{-- ===========      CONTENT      =================== --}}
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <h5>{{ $user->first_name.' '.$user->last_name.' - '.  (isset($user->Role->display_name) ? $user->Role->display_name : '-')  }}</h5>
                    <div>
                        <a title="کیف پول" href="{{ route('admin.wallet.index',['user'=>$user->id]) }}"
                           class="btn btn-sm btn-primary">
                            <i class="fa fa-wallet"></i>
                        </a>
                        <a title="بازگشت" href="{{ route('admin.user.index') }}"
                           class="btn btn-sm btn-secondary">
                            <i class=" fa fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <div class="col-xl-12 col-md-12 mb-1 p-4 bg-white">
                @include('admin.sections.errors')
                <form id="user_form_info"
                      action="{{ route('admin.user.update',['user'=>$user->id]) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    <input type="hidden" id="close" name="close" value="0">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3">
                            <label>نام</label>
                            <input name="first_name" class="form-control mb-2 border"
                                   value="{{ $user->first_name }}">
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>نام خانودگی</label>
                            <input name="last_name" class="form-control mb-2 border"
                                   value="{{ $user->last_name }}">
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>کد ملی</label>
                            <input name="national_code" class="form-control mb-2 border"
                                   value="{{ $user->national_code }}">
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>وضعیت</label>
                            <select name="is_active" class="form-control mb-2 border">
                                <option value="1" {{ $user->is_active==1 ? 'selected' : ''  }}>فعال</option>
                                <option value="0" {{ $user->is_active==0 ? 'selected' : ''  }}>غیر فعال
                                </option>
                            </select>
                        </div>
                        @auth
                            <?php
                            $user_login = auth()->user();
                            ?>
                            @if($user_login->super_admin==1)
                                <div class="col-sm-4 mb-4">
                                    <label>نوع کاربری</label>
                                    <select name="role" class="form-control mb-2 border">
                                        @foreach($roles as $role)
                                            <option
                                                value="{{ $role->id }}" {{ $user->role==$role->id ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        @endauth
                        <div class="col-sm-4 mb-3">
                            <label>شماره همراه</label>
                            <input name="cellphone" class="form-control mb-2 border"
                                   value="{{ $user->cellphone }}">
                        </div>
                        <div class="col-sm-4">
                            <label>شماره ثابت</label>
                            <input name="tel" class="form-control mb-2 border"
                                   value="{{ $user->tel }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" onclick="submitForm(1)"
                                    class="btn btn-danger btn-sm float-left mr-2">ویرایش و بستن
                            </button>
                            <button type="button" onclick="submitForm(0)" id="edit"
                                    class="btn btn-info btn-sm float-left">ویرایش
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card mt-3">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="p-3">تغییر رمز</h5>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-xl-12 col-md-12 mb-1 p-4 bg-white">
                        <form
                            action="{{ route('admin.user.change_password',['user'=>$user->id]) }}"
                            method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12 mb-3">
                                    <label for="password">رمزعبور</label>
                                    <input name="password" id="password" class="form-control mb-2 border">
                                    @error('password')
                                    <p class="input-error-validation">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="password_confirmation">تکرار رمز</label>
                                    <input name="password_confirmation" id="password_confirmation"
                                           class="form-control mb-2 border">
                                    @error('password_confirmation')
                                    <p class="input-error-validation">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit"
                                            class="btn btn-info btn-sm float-left mr-2">save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mt-3 mb-3">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="p-3">آدرس های کاربر:</h5>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-xl-12 col-md-12 mb-1 p-1">
                        @foreach($user->Addresses as $address)
                            <div class="bg-light-gray p-3 mb-2">
                                <div style="padding: 10px !important"
                                     class=" m-1  mb-3 ">
                                    <div class="d-flex">
                                        <div class="w-50">
                                            <div class="title">گیرنده: {{ $address->title }}</div>
                                            <div class="title2"></div>
                                        </div>
                                        <div class="w-50">
                                            <div class="title">کد ملی: {{ $address->User->national_code }}</div>
                                            <div class="title2"></div>
                                        </div>
                                    </div>
                                    <div class="w-50">
                                        <div class="km-title">
                                            شماره تماس : {{ $address->cellphone }}
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="w-50">
                                        <div class="title">
                                            استان / شهر
                                            : {{ province_name($address->province_id).' / '.city_name($address->city_id) }}
                                        </div>
                                    </div>
                                    <div class="w-50">
                                        <div class="title">
                                            شماره تلفن ضروری : {{ province_name($address->tel) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="km-details after-clear">
                                    <div class="km-title">
                                        <div class="firstTitle">
                                            <div class="title">
                                                آدرس :
                                            </div>
                                            <div class="title2 address">
                                                {{ $address->address }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="p-3">اطلاعات حقوقی</h5>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-xl-12 col-md-12 mb-1 p-4 bg-white">
                        <div class="row mt-3">
                            <div class="col-12 col-md-6">
                                <div class="single-input-item mb-2">
                                    <label for="company_name" class="required">
                                        نام موسسه/شرکت *
                                    </label>
                                    <input disabled id="company_name" name="company_name"
                                           class="form-control form-control-sm"
                                           value="{{ $user->company_name }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="single-input-item mb-2">
                                    <label for="company_sabt_number" class="required">
                                        شماره ثبت شرکت *
                                    </label>
                                    <input disabled id="company_sabt_number" name="company_sabt_number"
                                           class="form-control form-control-sm"
                                           value="{{ $user->company_sabt_number }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="single-input-item mb-2">
                                    <label for="company_shenase_melli" class="required">
                                        شناسه ملی شرکت *
                                    </label>
                                    <input disabled id="company_shenase_melli" name="company_shenase_melli"
                                           class="form-control form-control-sm"
                                           value="{{ $user->company_shenase_melli }}"
                                    >

                                </div>
                            </div>
                            <div class="tax-select col-md-6 mb-3">
                                <label class="mb-2">
                                    استان (دفتر مرکزی):
                                </label>
                                <input disabled class="form-control form-control-sm email s-email s-wid province-select" value="{{ province_name($user->company_province) }}">
                            </div>
                            <div class="tax-select col-md-6 mb-3">
                                <label class="mb-2">
                                    شهر (دفتر مرکزی):
                                </label>
                                <input disabled class="form-control form-control-sm email s-email s-wid city-select" value="{{ city_name($user->company_city) }}">
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="single-input-item mb-2">
                                    <label for="company_postalCode" class="required">
                                        کد پستی شرکت *
                                    </label>
                                    <input disabled id="company_postalCode" name="company_postalCode"
                                           class="form-control form-control-sm"
                                           value="{{ $user->company_postalCode }}">

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-input-item mb-2">
                                    <label for="company_address" class="required">
                                        آدرس شرکت *
                                    </label>
                                    <textarea disabled rows="4" id="company_address" name="company_address"
                                              class="form-control form-control-sm">{{ $user->company_address }}</textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
