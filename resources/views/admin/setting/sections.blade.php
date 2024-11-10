@extends('admin.layouts.admin')

@section('title')
   تنظیمات sections
@endsection

@section('style')
    <style>
        .img-thumbnail {
            max-width: 200px;
            height: auto;
        }

        p {
            padding: 10px;
        }
    </style>
@endsection

@section('script')

@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">تنظیمات section</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.sections.update') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">section-1 :</label>
                        <label>
                            <select name="{{ $sections[0]->id }}" class="form-control form-control-sm">
                                @foreach($categories as $cat)
                                    <option {{ $sections[0]->category_id==$cat->id ? 'selected' : '' }} style="font-size: 13pt;font-weight: bold"
                                            value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        <?php
                                        $children = \App\Models\Category::where('parent_id', $cat->id)->get();
                                        ?>
                                    @foreach($children as $child)
                                        <option {{ $sections[0]->category_id==$child->id ? 'selected' : '' }} value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">section-2 :</label>
                        <label>
                            <select name="{{ $sections[1]->id }}" class="form-control form-control-sm">
                                @foreach($categories as $cat)
                                    <option {{ $sections[1]->category_id==$cat->id ? 'selected' : '' }} style="font-size: 13pt;font-weight: bold"
                                            value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        <?php
                                        $children = \App\Models\Category::where('parent_id', $cat->id)->get();
                                        ?>
                                    @foreach($children as $child)
                                        <option {{ $sections[1]->category_id==$child->id ? 'selected' : '' }} value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">section-3 :</label>
                        <label>
                            <select name="{{ $sections[2]->id }}" class="form-control form-control-sm">
                                @foreach($categories as $cat)
                                    <option {{ $sections[2]->category_id==$cat->id ? 'selected' : '' }} style="font-size: 13pt;font-weight: bold"
                                            value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        <?php
                                        $children = \App\Models\Category::where('parent_id', $cat->id)->get();
                                        ?>
                                    @foreach($children as $child)
                                        <option {{ $sections[2]->category_id==$child->id ? 'selected' : '' }} value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
            </form>
        </div>

    </div>

@endsection
