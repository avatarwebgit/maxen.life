@extends('admin.layouts.admin')

@section('title')
    index groups
@endsection

@section('style')
    <style>
        .img-thumbnail{
            width: 50px;
            height: auto;
        }
        th{
            vertical-align: middle !important;
        }
        #overlay {
            display: none;
        }
    </style>
@endsection
@section('script')
    <script>
        function RemoveModal(id) {
            let modal = $('#remove_modal');
            modal.modal('show');
            $('#id').val(id);
        }

        function Remove() {
            let id = $('#id').val();
            let modal_alert = $('#modal_alert');
            $.ajax({
                url: "{{ route('admin.group.remove') }}",
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
                        if (msg[0] == 0) {
                            let error = msg[1];
                            let items = msg[2];
                            let row = '';
                            console.log(items);
                            $.each(items, function (i, item) {
                                row += `<div><a href="${item.link}">${item.name}</a></div>`;
                            })
                            $('#modal_text').html(error + row);
                            modal_alert.modal('show');
                        }
                        if (msg[0] == 1) {
                            let message = msg[1];
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

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">
                    لیست گروه شهر ها
                </h5>
               <div>
                   <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.group.create') }}">
                       <i class="fa fa-plus"></i>
                       افزودن گروه
                   </a>
                   <a class="btn btn-sm btn-dark" href="{{ route('admin.provinces.index') }}">
                       <i class="fa fa-arrow-alt-left"></i>
                       بازگشت
                   </a>
               </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $key => $group)
                            <tr>
                                <th>
                                    {{ $key+1 }}
                                </th>
                                <th>
                                    {{ $group->title }}
                                </th>
                                <th>
                                    <a class="btn btn-sm btn-info mr-3"
                                        href="{{ route('admin.group.edit',['group'=>$group->id]) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="RemoveModal({{ $group->id }})"
                                            class="btn btn-sm btn-danger mr-3">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="overlay">
                <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"></div>
                <br/>
                Loading...
            </div>
        </div>
    </div>

    @include('admin.provinces.group.modal')
    @include('admin.provinces.group.alertModal')

@endsection