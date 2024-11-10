@extends('admin.layouts.admin')

@section('title')
    index Contact Form
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست نظرات ({{ $items->total() }})</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $key => $item)
                        <tr>
                            <th>
                                {{ $items->firstItem() + $key }}
                            </th>
                            <th>
                                {{ $item->username }}
                            </th>
                            <th>
                                {{ $item->email }}
                            </th>
                            <th
                                class="{{ $item->getRawOriginal('approved') ? 'text-success' : 'text-danger' }}">
                                {{ $item->approved }}
                            </th>
                            <th>
                               <div class="d-flex justify-content-center">
                                   <a class="btn btn-sm btn-outline-success mb-2"
                                      href="{{ route('admin.contact.show', ['id' => $item->id]) }}">
                                       نمایش
                                   </a>

                                   <form action="{{ route('admin.contact.destroy', ['id' => $item->id]) }}" method="POST">
                                       @csrf
                                       @method('DELETE')

                                       <button class="btn btn-sm btn-outline-danger mr-3" type="submit">حذف</button>
                                   </form>
                               </div>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $items->render() }}
            </div>

        </div>

    </div>
@endsection
