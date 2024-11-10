@extends('admin.layouts.admin')

{{-- ===========  meta Title  =================== --}}
@section('title')
    تیکت ها
@endsection
{{-- ===========  My Css Style  =================== --}}
@section('style')
    <style>

    </style>
@endsection
{{-- ===========  My JavaScript  =================== --}}

@section('script')
    <script>
        function RemoveModal(id) {
            let modal = $('#remove_modal');
            modal.modal('show');
            $('#id').val(id);
        }
        function RemoveOrder() {
            let id = $('#id').val();
            $.ajax({
                url: "{{ route('admin.ticket.remove') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg) {
                        let message = msg[1];
                        if (msg[0] == 0) {
                            swal({
                                title: 'ERROR',
                                text: message,
                                icon: 'error',
                                buttons: 'ok',
                            })
                        }
                        if (msg[0] == 1) {

                            swal({
                                title: 'باتشکر',
                                text: message,
                                icon: 'success',
                                timer: 3000,
                            })
                            window.location.reload();
                        }
                    }
                },
            })
        }
    </script>
@endsection
{{-- ===========      CONTENT      =================== --}}
@section('content')
    <div id="remove_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        با حذف این مورد تمامی مکالمات شما پاک خواهد شد
                    </div>
                    <p>آیا از حذف این تیکت اطمینان دارید ؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">نه!</button>
                    <button onclick="RemoveOrder()" type="button" class="btn btn-success" data-dismiss="modal">حذف کن
                    </button>

                    <input id="id" type="hidden" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row d-sm-flex align-items-center justify-content-between mb-4">
                <div class="col-md-6">
                    لیست تیکت ها
                    
                </div>
                   <div class="col-md-6 text-left">
                   <a href="{{route('admin.ticket.new')}}" class="btn btn-primary">ایجاد تیکت</a>
                    
                </div>
                <hr>
            </div>

             <hr>
            @if(count($tickets)>0)
                <div class="row">
                    <div class="col-12">
                        <form
                            id="groupDelete"
                            action="#"
                            method="POST">
                            @method('delete')
                            @csrf
                            <table class="table table-bordered text-center table-striped">
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>کاربر</th>
                                    <th>عنوان</th>
                                    <th>وضعیت</th>
                                    <th>مشاهده</th>
                                    <th>شماره تیکت</th>
                                    <th>تاریخ</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $key=>$item)
                               
                                    <tr>
                                        <td>
                                            {{ $tickets->firstItem()+$key }}
                                        </td>
                                        <td>
                                            <a href="{{ isset($item->User->user_id) ? route('admin.user.edit',['user'=> $item->User->user_id]) : ''}}">
                                                {{ (isset($item->User->first_name) ? $item->User->first_name : ' ') . ' '. ( isset($item->User->last_name)  ? $item->User->last_name : ' ') }}
                                            </a>
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            {{ $item->Status->title }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.ticket.show',['id'=>$item->id]) }}"
                                               class="btn btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">{{ $item->id }}</td>
                                        <td class="text-center">{{ verta($item->created_at)->format('d - %B - Y') }}</td>
                                        <td class="text-center">
                                            <button title="حذف" type="button" onclick="RemoveModal({{ $item->id }})"
                                                    class="btn btn-sm btn-danger mb-1"
                                                    href=""><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row justify-content-center">
                            {{ $tickets->render() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="row d-sm-flex align-items-center justify-content-between mt-4 noneDisplay">
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            تیکتی برای نمایش موجود نیست
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
