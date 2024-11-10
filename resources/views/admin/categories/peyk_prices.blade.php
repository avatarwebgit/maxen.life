@extends('admin.layouts.admin')

@section('title')
    قیمت های پیک فروشگاه برای {{ $category->name }}
@endsection
@section('style')
    <style>
        .img-thumbnail {
            width: 150px;
            height: auto;
        }

        th {
            vertical-align: middle !important;
        }

        #overlay {
            display: none;
        }

        .sale_img {
            position: absolute;
            width: 40px;
            height: auto;
            left: 0;
            top: 0;
        }

        #success_alert {
            width: 300px;
            height: 100px;
            background-color: green;
            color: white;
            position: fixed;
            bottom: 50px;
            left: 50px;
            text-align: center;
            border-radius: 5%;
            display: none;
        }

        .text-inherit {
            color: inherit !important;
        }

        input {
            text-align: center !important;
        }
    </style>
@endsection

@section('script')
    <script>

        function update_single_price(peyk_price_id, tag) {
            let price = $(tag).val();
            $.ajax({
                url: "{{ route('admin.category.peyk.price.update') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    peyk_price_id: peyk_price_id,
                    price: price,
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg) {
                        if (msg[0] == 1) {
                            $('#success_alert').show(500);
                            setTimeout(function () {
                                $('#success_alert').hide(500);
                            }, 3000);
                        }
                    }

                },
                fail: function (error) {
                    console.log(error);
                }
            })
        }

        function update_city_group_price(category_id, group_id, tag) {
            let price = $(tag).val();
            $.ajax({
                url: "{{ route('admin.category.peyk.price_group.update') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    category_id: category_id,
                    group_id: group_id,
                    price: price,
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg) {
                        if (msg[0] == 1) {
                            $('#success_alert').show(500);
                            setTimeout(function () {
                                $('#success_alert').hide(500);
                                window.location.reload();
                            }, 3000);
                        }
                    }

                },
                fail: function (error) {
                    console.log(error);
                }
            })
        }

        function price_format(tag) {
            let price = $(tag).val();
            $(tag).val(number_format(price));
        }
    </script>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">قیمت های پیک فروشگاه برای {{ $category->name }}</h5>
            </div>
            <div class="table-responsive">
                <h3 class="alert alert-warning">تغییر قیمت بر اساس گروه بندی</h3>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام گروه بندی</th>
                        <th>هزینه ارسال (تومان)</th>
                    </tr>
                    </thead>
                    <tbody id="insertRow">
                    @foreach ($groups as $key => $group)
                        <tr>
                            <th>
                                {{ $key+1 }}
                            </th>
                            <th class="position-relative">
                                {{ $group->title }}
                            </th>
                            <th>
                                <input onkeyup="NumberFormat(this)"
                                       onchange="update_city_group_price({{ $category->id }},{{ $group->id }},this)"
                                       class="form-control form-control-sm"
                                       value="0">
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <h3 class="alert alert-info">تغییر قیمت بر اساس شهر</h3>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام استان</th>
                        <th>نام شهر</th>
                        <th>گروه بندی</th>
                        <th>هزینه ارسال (تومان)</th>
                    </tr>
                    </thead>
                    <tbody id="insertRow">
                    @foreach ($peyk_prices as $key => $peyk_price)
                        <tr>
                            <th>
                                {{ $key+1 }}
                            </th>
                            <th class="position-relative">
                                {{ province_name($peyk_price->province_id) }}

                            </th>
                            <th>
                                {{ city_name($peyk_price->city_id) }}
                            </th>
                            <th>
                                {{ $peyk_price->City->Group->title }}
                            </th>
                            <th>
                                <input disabled onkeyup="NumberFormat(this)"
                                       onchange="update_single_price({{ $peyk_price->id }},this)"
                                       class="form-control form-control-sm"
                                       value="{{ number_format($peyk_price->price) }}">
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="success_alert">
        <div class="d-flex justify-content-center align-items-center h-100">تغییرات مورد نظر با موفقیت اعمال شد</div>
    </div>
@endsection
