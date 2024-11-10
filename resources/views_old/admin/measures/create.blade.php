@extends('admin.layouts.admin')

@section('title')
    create brands
@endsection

@section('script')

@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">واحد اندازه گیری جدید</h5>
            </div>
            <hr>
            <form action="{{ route('admin.measures.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="title">عنوان</label>
                        <input class="form-control" id="title" name="title" type="text" value="{{ old('title') }}" >
                        @error('title')
                        <p class="validate-error">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
