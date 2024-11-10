@extends('admin.layouts.admin')

@section('title')
    تعرفه های باربری
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

        function update_price(id, tag) {
            let price = $(tag).val();
            $.ajax({
                url: "{{ route('admin.truck.price_update') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
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

        function price_format(tag) {
            let price = $(tag).val();
            $(tag).val(number_format(price));
        }

        $('#clearFactorBtn').click(function () {
            //clear localStorage
            localStorage.removeItem('single_products');
            localStorage.removeItem('single_products_brand');
            localStorage.removeItem('single_products_category');
            localStorage.removeItem('single_products_search_input');
            window.location.reload();
        })

        function custom_pagination(tag) {
            let per_page = $(tag).val();
            let url = '{{ route('admin.products.single.update.pagination',['show_per_page'=>':per_page']) }}';
            url = url.replace(':per_page', per_page);
            window.location.href = url;
        }

    </script>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <h3>
                تعرفه های باربری - {{ $category->name }}
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>استان</th>
                        <th>شهر</th>
                        <th>هزینه حمل(تومان)</th>
                    </tr>
                    </thead>
                    <tbody id="insertRow">
                    @foreach($truck_prices as $key=>$item)
                    <tr>
                        <th>
                           {{ $key+1 }}
                        </th>
                        <th class="position-relative">
                           {{ province_name($item->province_id) }}
                        </th>
                        <th>
                            {{ city_name($item->city_id) }}
                        </th>
                        <th>
                            <input onkeyup="NumberFormat(this)" onchange="update_price({{ $item->id }},this)"
                                   class="form-control form-control-sm"
                                   value="{{ number_format($item->price) }}">
                        </th>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row paginate">
                <div class="col-12">
                    <div class="row justify-content-center">
{{--                        {{ $products->render() }}--}}
                    </div>
                </div>
            </div>
            <div id="overlay">
                <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"></div>
                <br/>
                Loading...
            </div>
        </div>
    </div>
    <div id="success_alert">
        <div class="d-flex justify-content-center align-items-center h-100">تغییرات مورد نظر با موفقیت اعمال شد</div>
    </div>
@endsection
