@extends('admin.layouts.admin')

@section('title')
    ارسال از طریق تعاونی اتوبوسرانی
@endsection

@section('style')
    <style>
        .close {
            margin: 0 !important;
        }

        .modal-header {
            align-items: center;
        }


        #successAlert {
            display: none;
            position: fixed;
            width: 300px;
            height: 100px;
            bottom: 20px;
            left: 20px;
            z-index: 999;
        }

        #successAlert > div {
            color: white;
            background-color: green;
        }
    </style>
@endsection

@section('script')
    <script>
        function removeItem(deliveryAmountItem) {
            $('#Item').val(deliveryAmountItem);
        }

        function changePrice(tag,method_id) {
            let price = tag.value;
            let _token = "{{ csrf_token() }}";
            let url = "{{ route('admin.delivery_method.post.update') }}";
            let data = {
                price: price,
                method_id: method_id,
                _token: _token,
            };

            jQuery.post(url, data, function (msg) {
                if (msg == 'ok') {
                    $('#successAlert').slideDown().delay(1500).slideUp();
                }
            })
        }
    </script>
@endsection

@section('content')

    <div id="successAlert" class="col-12">
        <div class="alert text-center">
            تغییرات با موفقیت اعمال شد
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">تعرفه های تعاونی اتوبوسرانی -لیست استان ها</h5>
                {{--                <div>--}}
                {{--                    <a class="btn btn-sm btn-outline-primary"--}}
                {{--                       href="{{ route('admin.delivery_method.create',['method'=>'post']) }}">--}}
                {{--                        <i class="fa fa-plus"></i>--}}
                {{--                        افزودن استان--}}
                {{--                    </a>--}}
                {{--                </div>--}}
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                    <tr>
                        <th>تعرفه همه استان ها (به جز تهران و البرز )</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>
                            <input onchange="changePrice(this,7)" class="text-center ml-3" name="price" value="{{ number_format($DeliveryMethodAmount[0]->price) }}">تومان
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>

            {{--            <div class="d-flex justify-content-center mt-5">--}}
            {{--                {{ $coupons->render() }}--}}
            {{--            </div>--}}

        </div>
    </div>
    {{--//modal--}}
    @include('admin.deliveryMethods.post.delete')
@endsection
