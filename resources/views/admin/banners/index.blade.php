@extends('admin.layouts.admin')

@section('title')
    index banner
@endsection

@section('style')
    <style>
        .img-thumbnail{
            max-width: 200px;
            height: auto;
        }
        .border-none{
            border: none !important;
        }
    </style>
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست بنر ها ({{ $banners->total() }})</h5>

                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.banners.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد بنر
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
{{--                            <th>thumbnail</th>--}}
                            <th>عنوان</th>
                            <th>متن</th>
                            <th>لینک دکمه</th>
                            <th>متن دکمه</th>
                            <th>موقعیت نمایش</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $key => $banner)
                            <tr>
                                <th>
                                    {{ $banners->firstItem() + $key }}
                                </th>
                                <th>
                                    <a target="_blank" href="{{ url( env('BANNER_IMAGES_UPLOAD_PATH').$banner->image ) }}">
                                        <img class="img-thumbnail" src="{{ imageExist( env('BANNER_IMAGES_UPLOAD_PATH'),$banner->image ) }}">
                                    </a>
                                </th>
{{--                                <th>--}}
{{--                                    <a target="_blank" href="{{ url( env('BANNER_IMAGES_UPLOAD_PATH').$banner->image ) }}">--}}
{{--                                        <img class="img-thumbnail" src="{{ imageExist( env('BANNER_IMAGES_UPLOAD_PATH'),$banner->thumbnail ) }}">--}}
{{--                                    </a>--}}
{{--                                </th>--}}
                                <th>
                                    {{ $banner->title }}
                                </th>
                                <th>
                                    {{ $banner->text }}
                                </th>
                                <th>
                                    {{ $banner->button_link }}
                                </th>
                                <th>
                                    {{ $banner->button_text }}
                                </th>
                                <th>
                                    {{ $banner->position == 0 ? 'وسط صفحه': 'پایین صفحه'}}
                                </th>
                                <th class="d-flex border-none">

                                    <a title="ویرایش" class="btn btn-sm btn-info mr-3"
                                        href="{{ route('admin.banners.edit', ['banner' => $banner->id]) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.banners.destroy', ['banner' => $banner->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $banners->render() }}
            </div>
        </div>
    </div>
@endsection
