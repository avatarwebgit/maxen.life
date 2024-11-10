@extends('admin.layouts.admin')

{{-- ===========  meta Title  =================== --}}
@section('title')
    لیست  منو ها
@endsection
{{-- ===========  My Css Style  =================== --}}
@section('style')
    <style>
        .img-profile{
            max-width: 150px;
            height: auto;
        }
        td{
            vertical-align: middle !important;
        }
        .img-profile{
            width: 200px;
            height: auto;
        }
    </style>
@endsection
{{-- ===========  My JavaScript  =================== --}}
@section('script')
    <script>

    </script>
@endsection

{{-- ===========      CONTENT      =================== --}}


@section('content')
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <h1> مدیریت منو ها</h1>
    <a class="btn btn-primary mt-3 mb-3" href="{{ route('admin.menus.create') }}">ساخت منو</a>
    <hr>

    
     <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام</th>
                        <th>alias</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                       @foreach ($menus as $key=>$menu)
                        <tr>
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                             {{ $menu->name }}
                            </td>
                            <td>
                           {{ $menu->alias }}
                            </td>



                            <td>
                                <a  class="btn btn-sm btn-primary"
                                    aria-haspopup="true" aria-expanded="false" href="{{ route('admin.menus.edit', $menu->id) }}">
                                    <i class="fa fa-pen"></i>
                                </a>

                           <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">حذف</button>
                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection


