@extends('admin.layouts.admin')

@section('title')
    edit city
@endsection


@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش شهر</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.city.update',['city'=>$city->id]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $city->name }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="group">انتخاب گروه</label>
                        <select class="form-control" name="group" id="group">
                            @foreach($groups as $group)
                                <option {{ $city->group_id==$group->id ? 'selected' : '' }} value="{{ $group->id }}">
                                    {{ $group->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.cities.index',['province'=>$city->province_id]) }}"
                   class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
