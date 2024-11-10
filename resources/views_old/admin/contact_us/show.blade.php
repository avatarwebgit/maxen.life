@extends('admin.layouts.admin')

@section('title')
    show comments
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">پیام ارسالی </h5>
            </div>
            <hr>

            <div class="row">
                <div class="form-group col-md-3">
                    <label>نام کاربر</label>
                    <input class="form-control" type="text" value="{{ $comment->username }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>وضعیت</label>
                    <input class="form-control" type="text" value="{{ $comment->approved }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>تاریخ</label>
                    <input class="form-control" type="text" value="{{ verta($comment->created_at) }}" disabled>
                </div>
                <div class="form-group col-md-12">
                    <label>متن</label>
                    <textarea rows="10" class="form-control" disabled>{{ $comment->message }}</textarea>
                </div>

            </div>

            <a href="{{ route('admin.contact.index') }}" class="btn btn-dark mt-5">بازگشت</a>
        </div>

    </div>

@endsection
