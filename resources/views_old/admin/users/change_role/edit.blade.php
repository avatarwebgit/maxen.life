@extends('admin.layouts.admin')

{{-- ===========  meta Title  =================== --}}
@section('title')
    مشاهده درخواست کابر
@endsection
{{-- ===========  My Css Style  =================== --}}
@section('style')
    <style>
        .profile {
            width: 100%;
            height: auto;
            border: 1px solid #cccccc;
            border-radius: 50%;
        }
    </style>
@endsection
{{-- ===========  My JavaScript  =================== --}}

@section('script')
    <script>
        function Confirm(user_id) {
            let role = $('#role').val();
            if (confirm('آیا از تغییر سطح کاربری این کاربر اطمینان دارید؟')) {
                $.ajax({
                    url: "{{ route('admin.user.change_role.confirm') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: user_id,
                        role: role,
                    },
                    dataType: "json",
                    type: 'POST',
                    beforeSend: function () {
                        $("#overlay").fadeIn();
                    },
                    success: function (msg) {
                        if (msg) {
                            if (msg[0] == 1) {
                                swal({
                                    title: 'با تشکر',
                                    text: 'سطح کاربری کاربر مورد نظر با موفقیت تغییر پیدا کرد',
                                    icon: 'success',
                                    buttons: 'متوجه شدم',
                                })
                                window.location.href = "{{ route('admin.user.change_role.index') }}";
                            }
                            if (msg[0] == 0) {
                                swal({
                                    title: 'خطا',
                                    text: msg[1],
                                    icon: 'error',
                                    buttons: 'ok',
                                })
                            }
                        }
                        $("#overlay").fadeOut();
                    },
                    fail: function (error) {
                        console.log(error);
                        $("#overlay").fadeOut();
                    }
                })
            }
        }

        function Deny(user_id) {
            if (confirm('آیا از رد درخواست این کاربر اطمینان دارید؟')) {
                $.ajax({
                    url: "{{ route('admin.user.change_role.deny') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: user_id,
                    },
                    dataType: "json",
                    type: 'POST',
                    beforeSend: function () {
                        $("#overlay").fadeIn();
                    },
                    success: function (msg) {
                        if (msg) {
                            if (msg[0] == 1) {
                                swal({
                                    title: 'با تشکر',
                                    text: 'درخواست کاربر مورد نظر رد شد',
                                    icon: 'success',
                                    buttons: 'متوجه شدم',
                                })
                                window.location.href = "{{ route('admin.user.change_role.index') }}";
                            }
                            if (msg[0] == 0) {
                                swal({
                                    title: 'خطا',
                                    text: msg[1],
                                    icon: 'error',
                                    buttons: 'ok',
                                })
                            }
                        }
                        $("#overlay").fadeOut();

                    },
                    fail: function (error) {
                        console.log(error);
                        $("#overlay").fadeOut();
                    }
                })
            }
        }

    </script>
@endsection
{{-- ===========      CONTENT      =================== --}}
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <h5>{{ $user->name.' - '.$user->Role->display_name }}</h5>
                    <div>
                        <button onclick="Deny({{ $user->id }})" title="رد درخواست کاربر" type="button"
                                class="btn btn-danger btn-sm">
                            رد
                        </button>
                        <a title="بازگشت به لیست درخواست ها" href="{{ route('admin.user.change_role.index') }}"
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
                <div class="row">
                    <div class="col-2">
                        <img class="profile" src="{{ imageExist(env('USER_IMAGES_UPLOAD_PATH'),$user->avatar) }}">
                    </div>
                    <div class="col-10">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3">
                                        <label>نام و نام خانودگی</label>
                                        <input disabled class="form-control mb-2 border"
                                               value="{{ $user->first_name.' '.$user->last_name }}">
                                    </div>
                                    <div class="col-sm-4 mb-4">
                                        <label>نوع کاربری</label>
                                        <input disabled class="form-control mb-2 border"
                                               value="{{ $user->Role->display_name }}">
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <label>شماره همراه</label>
                                        <input disabled class="form-control mb-2 border"
                                               value="{{ $user->cellphone }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>ایمیل</label>
                                        <input disabled class="form-control mb-2 border"
                                               value="{{ $user->email }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>شماره ثابت</label>
                                        <input disabled class="form-control mb-2 border"
                                               value="{{ $user->tel }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-md-4 mb-3">
                        <div class="single-input-item mb-2">
                            <label for="company_name" class="required mb-2">
                                نام حقوقی:
                            </label>
                            <input disabled
                                   class="form-control form-control-sm"
                                   value="{{ $user->company_name  }}"
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <div class="single-input-item mb-2">
                            <label for="company_sabt_number" class="required mb-2">
                                شماره ثبت:
                            </label>
                            <input disabled class="form-control form-control-sm"
                                   value="{{ $user->company_sabt_number }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <div class="single-input-item mb-2">
                            <label for="company_shenase_melli" class="required mb-2">
                                شناسه ملی:
                            </label>
                            <input disabled
                                   class="form-control form-control-sm"
                                   value="{{ $user->company_shenase_melli }}"
                            >

                        </div>
                    </div>
                    <div class="tax-select col-md-4 mb-3">
                        <label class="mb-2">
                            استان (دفتر مرکزی):
                        </label>
                        <input disabled class="form-control email s-email s-wid province-select" value="{{ province_name($user->company_province) }}">
                    </div>
                    <div class="tax-select col-md-4 mb-3">
                        <label class="mb-2">
                            شهر (دفتر مرکزی):
                        </label>
                        <input disabled class="form-control email s-email s-wid city-select" value="{{ city_name($user->company_city) }}">
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <div class="single-input-item mb-2">
                            <label for="company_postalCode" class="required mb-2">
                                کد پستی:
                            </label>
                            <input disabled
                                   class="form-control form-control-sm"
                                   value="{{ $user->company_postalCode  }}">

                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="single-input-item mb-2">
                            <label for="company_address" class="required mb-2">
                                آدرس:
                            </label>
                            <textarea disabled rows="4"
                                      class="form-control form-control-sm">{{ $user->company_address }}</textarea>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="button" onclick="Confirm({{ $user->id }})"
                                class="btn btn-success btn-sm float-left">تایید درخواست
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
