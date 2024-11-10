@extends('admin.layouts.admin')

{{-- ===========  meta Title  =================== --}}
@section('title')
    ایجاد کاربر
@endsection
{{-- ===========  My Css Style  =================== --}}
@section('style')
    <style>
        .marginTop31 {
            margin-top: 31px;
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
    </script>
@endsection
{{-- ===========      CONTENT      =================== --}}
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <h5>ایجاد کاربر</h5>
                </div>
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <div class="col-xl-12 col-md-12 mb-1 p-4 bg-white">
                @include('admin.sections.errors')
                <div class="row">
                    <form
                        action="{{ route('admin.user.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="col-12">
                        <div class="row">
                            <div class="col-12">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-4 mb-4">
                                        <label>نام</label>
                                        <input name="first_name" class="form-control mb-2 border"
                                               value="{{ old('first_name') }}">
                                    </div>
                                    <div class="col-4 mb-4">
                                        <label>نام خانوادگی</label>
                                        <input name="last_name" class="form-control mb-2 border"
                                               value="{{ old('last_name') }}">
                                    </div>
                                    <div class="col-sm-4 mb-4">
                                        <label>وضعیت</label>
                                        <select name="is_active" class="form-control mb-2 border">
                                            <option value="0">غیر فعال
                                            </option>
                                            <option value="1" selected>فعال</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 mb-4">
                                        <label for="role">نوع کاربری</label>
                                        <select id="role" name="role" class="form-control mb-2 border">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 mb-4">
                                        <label>شماره همراه</label>
                                        <input name="cellphone" class="form-control mb-2 border"
                                               value="{{ old('cellphone') }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>ایمیل</label>
                                        <input name="email" class="form-control mb-2 border"
                                               value="{{ old('email') }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>شماره ثابت</label>
                                        <input name="tel" class="form-control mb-2 border"
                                               value="{{ old('tel') }}">
                                    </div>
                                    <div class="col-sm-4 custom-file marginTop31">**
                                        <label class="custom-file-label" for="file">عکس کاربر</label>
                                        <input onchange="changeLabel(this)" type="file" class="custom-file-input"
                                               name="avatar" id="avatar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-success float-left">ایجاد</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
