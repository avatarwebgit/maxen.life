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
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست تصویر ها ({{ $news->total() }})</h5>

                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.news.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد تصویر
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>

                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $key => $new)
                            <tr>
                                <th>
                                    {{ $news->firstItem() + $key }}
                                </th>
                                <th>
                                    <a target="_blank" href="{{ url( env('SLIDER_IMAGES_UPLOAD_PATH').$new->image ) }}">
                                        <img class="img-thumbnail" src="{{ imageExist( env('SLIDER_IMAGES_UPLOAD_PATH'),$new->image ) }}">
                                    </a>
                                </th>
                                <th class="d-flex border-none">

                                    <a title="ویرایش" class="btn btn-sm btn-info mr-3"
                                        href="{{ route('admin.news.edit', ['news' => $new->id]) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.news.destroy', ['news' => $new->id]) }}" method="POST">
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
                {{ $news->render() }}
            </div>
        </div>
    </div>
@endsection
