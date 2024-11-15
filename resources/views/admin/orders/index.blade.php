@extends('admin.layouts.admin')

@section('title')
    index orders
@endsection

@section('style')
    <style>
        .input-error-validation {
            color: red;
            font-size: 9pt;
            display: none;
        }

        #NotFound {
            display: none;
        }

        #overlay {
            display: none;
            text-align: center;
        }

        .align-center {
            align-items: center !important
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .error_message {
            font-size: 9pt;
            color: red;
            position: absolute;
            top: 40px;
            right: 0;
        }

        .form-group {
            margin-bottom: 0 !important;
        }
    </style>

@endsection

@section('script')
    <script>
        $('#report_order_btn').click(function () {
            $('#start_date_error').hide();
            $('#end_date_error').hide();
        })
        //get pagination
        var todayPagination = null;
        var thisWeekPagination = null;
        var thisMonthPagination = null;
        var lastMonthPagination = null;
        var order_start = null;
        var order_end = null;

        function pagination(totalPages, currentPage) {
            var pagelist = "";
            if (totalPages > 1) {
                currentPage = parseInt(currentPage);
                pagelist += `<ul style="list-style: none" class="pagination_ajax justify-content-center d-flex">`;
                const prevClass = currentPage == 1 ? " disabled" : "";
                pagelist += `<li class="page-item${prevClass}"><a class="page-link" data-page="${currentPage - 1}" href="#"><</a></li>`;
                for (let p = 1; p <= totalPages; p++) {
                    const activeClass = currentPage == p ? " active" : "";
                    pagelist += `<li class="page-item${activeClass}"><a class="page-link" href="#" data-page="${p}">${p}</a></li>`;
                }
                const nextClass = currentPage == totalPages ? " disabled" : "";
                pagelist += `<li class="page-item${nextClass}"><a class="page-link" data-page="${currentPage + 1}" href="#">></a></li>`;
                pagelist += `</ul>`;
            }
            $("#pagination").html(pagelist);
        }

        // pagination
        $(document).on("click", "ul.pagination_ajax li a", function (e) {
            e.preventDefault();
            var $this = $(this);
            const pagenum = $this.data("page");
            $("#currentPage").val(pagenum);
            getOrderReport(todayPagination, thisWeekPagination, thisMonthPagination, lastMonthPagination, 'paginate');
        });

        //calculateIndexRow
        function calculateIndexRow(pageNo, row_per_page, key) {
            if (pageNo > 1) {
                pageNo = pageNo;
            } else {
                pageNo = 1;
            }
            return ((pageNo - 1) * (row_per_page)) + (key + 1);
        }

        function getOrderReport(today = null, thisWeek = null, thisMonth = null, lastMonth = null, paginate = null) {
            let currentPage = $('#currentPage').val();
            todayPagination = today;
            thisWeekPagination = thisWeek;
            thisMonthPagination = thisMonth;
            lastMonthPagination = lastMonth;
            if (paginate == null) {
                order_start = $('#order_start_input').val();
                order_end = $('#order_end_input').val();
            }
            if (order_start == '' && today == null && thisWeek == null && thisMonth == null && lastMonth == null && paginate == null) {
                $('#start_date_error').show()
            } else if (order_end == '' && today == null && thisWeek == null && thisMonth == null && lastMonth == null && paginate == null) {
                $('#end_date_error').show()
            } else {
                $.ajax({
                    url: "{{ route('admin.orders.get') }}",
                    data: {
                        order_start: order_start,
                        order_end: order_end,
                        today: today,
                        thisWeek: thisWeek,
                        thisMonth: thisMonth,
                        lastMonth: lastMonth,
                        page: currentPage,
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    type: "POST",
                    beforeSend: function () {
                        $("#overlay").fadeIn();
                    },
                    success: function (msg) {
                        if (msg) {
                            $("#Auto_paginate").html('');
                            if (msg[0] = 'ok') {
                                let row;
                                let orders = msg[1];
                                let massage = msg[4];
                                if (orders.length == 0) {
                                    $('#totalSale').text(massage);
                                    $('#totalSale').show();
                                    $('#orderReports').hide();
                                    $("#pagination").html('');

                                } else {
                                    $('#NotFound').hide();
                                    $('#orderReports').show();
                                    $('#orders').html(orders);
                                    let totalRows = msg[2];
                                    let row_per_page = msg[3];
                                    let massage = msg[4];
                                    let totalPages = Math.ceil(totalRows / row_per_page);
                                    const currentPage = $('#currentPage').val();
                                    pagination(totalPages, currentPage);

                                    $('#totalSale').text(massage);
                                    $('#totalSale').show();
                                }
                                $('#filter_order_modal').modal('hide');
                                $('#order_start_input').val('');
                                $('#order_end_input').val('');

                            }
                        }
                        $("#overlay").fadeOut();
                    },
                    fail: function (error) {
                        console.log(error);
                        $("#overlay").fadeOut();
                    }
                })
            }
        }

        function getOrderReportWithStatus(status,type) {
            let currentPage = $('#currentPage').val();
            $.ajax({
                url: "{{ route('admin.orders.get_with_status') }}",
                data: {
                    page: currentPage,
                    status: status,
                    type: type,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                type: "POST",
                beforeSend: function () {
                    $("#overlay").fadeIn();
                },
                success: function (msg) {
                    if (msg) {
                        $("#Auto_paginate").html('');
                        if (msg[0] = 'ok') {
                            let row;
                            let orders = msg[1];
                            let massage = msg[4];
                            if (orders.length == 0) {
                                $('#totalSale').text(massage);
                                $('#totalSale').show();
                                $('#orderReports').hide();
                                $("#pagination").html('');

                            } else {
                                $('#NotFound').hide();
                                $('#orderReports').show();
                                $('#orders').html(orders);
                                let totalRows = msg[2];
                                let row_per_page = msg[3];
                                let massage = msg[4];
                                let totalPages = Math.ceil(totalRows / row_per_page);
                                const currentPage = $('#currentPage').val();
                                pagination(totalPages, currentPage);

                                $('#totalSale').text(massage);
                                $('#totalSale').show();
                            }
                            $('#filter_order_modal').modal('hide');
                            $('#order_start_input').val('');
                            $('#order_end_input').val('');

                        }
                    }
                    $("#overlay").fadeOut();
                },
                fail: function (error) {
                    console.log(error);
                    $("#overlay").fadeOut();
                }
            })
        }

        function createTableRow(order, key) {
            let pageNo = $('#currentPage').val();
            let row_per_page = 100;
            let indexRow = calculateIndexRow(pageNo, row_per_page, key);
            let url = "{{ route('admin.orders.show',":id") }}";
            url = url.replace(':id', order.id);
            let printUrl = "{{ route('admin.orders.print', ":printUrl_id") }}";
            printUrl = printUrl.replace(':printUrl_id', order.id);
            let printPeykUrl = "{{ route('admin.orders.print_peyk', ":printPeykUrl_id") }}";
            printPeykUrl = printPeykUrl.replace(':printPeykUrl_id', order.id);
            let html = `<tr>
                            <th>${indexRow}</th>
                            <th>${order.user.name}</th>
                            <th>${number_format(order.wallet)}</th>
                            <th>${number_format(order.paying_amount)}</th>
                            <th>${number_format(order.total_amount)}</th>
                            <th>${order.payment_type}</th>
                            <th>${order.payment_status}</th>
                            <th>${order.date}</th>
                            <th>${order.delivery_status}</th>
                            <th>${order.order_number}</th>
                            <th>${order.status}</th>
                            <th>
                                  <a class="btn btn-sm btn-success"
                                   href="${url}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a target="_blank" class="btn btn-sm btn-dark"
                                   href="${printUrl}">
                                    <i class="fa fa-print"></i>
                                </a>
                                <a target="_blank" class="btn btn-sm btn-dark"
                                   href="${printPeykUrl}">
                                    <i class="fa fa-motorcycle"></i>
                                </a>
                            </th>
                        </tr>`;
            return html;
        }

        //excel output order
        $(`#order_start_excel`).MdPersianDateTimePicker({
            targetTextSelector: `#order_start_input_excel`,
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });

        $(`#order_end_excel`).MdPersianDateTimePicker({
            targetTextSelector: `#order_end_input_excel`,
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });
        //
        $(`#order_start`).MdPersianDateTimePicker({
            targetTextSelector: `#order_start_input`,
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });

        $(`#order_end`).MdPersianDateTimePicker({
            targetTextSelector: `#order_end_input`,
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });

        function number_format(number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        function changeOrderStatus(tag, order_id,deliveryMethod_id) {
            let delivery_status = $(tag).val();
            $.ajax({
                url: "{{ route('admin.orders.update_delivery_status') }}",
                data: {
                    delivery_status: delivery_status,
                    _token: "{{ csrf_token() }}",
                    order_id: order_id,
                    deliveryMethod_id: deliveryMethod_id,
                },
                dataType: 'json',
                type: 'POST',
                beforeSend: function () {

                },
                success: function (msg) {
                    if (msg) {
                        if (msg[0] == 'ok') {
                            swal({
                                title: 'با تشکر',
                                text: 'وضعیت سفارش با موفقیت تغییر یافت',
                                icon: 'success',
                                timer: 3000,
                            })
                        }else {
                            swal({
                                title: 'SMS',
                                text: msg[1],
                                icon: 'error',
                                buttons: 'ok',
                            })
                        }
                    }
                },
                fail: function () {

                },
                error: function () {

                }
            })
        }

        function active_sms(order_id) {
            let selector = '#active_sms_icon_' + order_id;
            $.ajax({
                url: "{{ route('admin.order.active_sms') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: order_id,
                },
                dataType: "json",
                type: 'POST',
                beforeSend: function () {
                    $("#overlay").fadeIn();
                },
                success: function (msg) {
                    if (msg) {
                        if (msg[1] === 1) {
                            $(selector).removeClass('btn-dark');
                            $(selector).addClass('btn-success text-white');
                            $(selector).text('فعال');
                        }
                        if (msg[1] === 0) {
                            $(selector).removeClass('btn-success text-white');
                            $(selector).addClass('btn-dark');
                            $(selector).text('غیر فعال');
                        }
                    }
                    $("#overlay").fadeOut();

                },
                fail: function (error) {
                    console.log(error);
                    $("#overlay").fadeOut();
                }
            })
        }

        function RemoveModal(order_id) {
            let modal = $('#remove_modal');
            modal.modal('show');
            $('#order_id').val(order_id);
        }

        function RemoveOrder() {
            let order_id = $('#order_id').val();
            $.ajax({
                url: "{{ route('admin.order.remove') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: order_id,
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

     function custom_pagination(tag) {
            let per_page = $(tag).val();
            let payment_methods = $('#payment-methods').val();
            let url = '{{ route('admin.orders.pagination',['payment_methods'=>':payment-methods','show_per_page'=>':per_page']) }}';
            url = url.replace(':per_page', per_page);
            url = url.replace(':payment-methods', payment_methods);
            window.location.href = url;
        }

        function custom_methods(tag) {
            let per_page = $('#custom_pagination').val();
            let payment_methods = $(tag).val();
            let url = '{{ route('admin.orders.pagination',['payment_methods'=>':payment-methods','show_per_page'=>':per_page']) }}';
            url = url.replace(':payment-methods', payment_methods);
            url = url.replace(':per_page', per_page);
            window.location.href = url;
        }
        
        function SearchOrder(e, tag) {
            if (e.keyCode == 13) {
                let keyWord = $(tag).val();
                $.ajax({
                    url: "{{ route('admin.orders.searchKeyWord') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        'keyWord': keyWord,
                    },
                    dataType: "json",
                    method: "post",
                    beforeSend: function () {
                        $("#overlay").fadeIn();
                    },
                    success: function (msg) {
                        if (msg) {
                            $("#Auto_paginate").html('');
                            if (msg[0] = 'ok') {
                                let row;
                                let orders = msg[1];
                                let massage = msg[4];
                                if (orders.length == 0) {
                                    $('#totalSale').text(massage);
                                    $('#totalSale').show();
                                    $('#orderReports').hide();
                                    $("#pagination").html('');

                                } else {
                                    $('#NotFound').hide();
                                    $('#orderReports').show();
                                    $('#orders').html(orders);
                                    let totalRows = msg[2];
                                    let row_per_page = msg[3];
                                    let massage = msg[4];
                                    let totalPages = Math.ceil(totalRows / row_per_page);
                                    const currentPage = $('#currentPage').val();
                                    pagination(totalPages, currentPage);

                                    $('#totalSale').text(massage);
                                    $('#totalSale').show();
                                }
                                $('#filter_order_modal').modal('hide');
                                $('#order_start_input').val('');
                                $('#order_end_input').val('');

                            }
                        }
                        $("#overlay").fadeOut();
                    },
                })
            }
        }

    </script>
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary text-center">
                        <div class="text-center">
                            تعداد کل سفارشات : {{ $all_orders }}
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="w-50 text-success">سفارشات موفق : {{ $orders->total() }}</div>
                            <div onclick="getOrderReportWithStatus(null,0)" class="w-50 text-danger cursor-pointer">سفارشات ناموفق : {{ count($failed_orders) }}</div>
                        </div>
                    </div>
                </div>
                @foreach($order_status as $item)
                    <div class="col-lg-4 mb-4 cursor-pointer">
                        <div onclick="getOrderReportWithStatus({{ $item->id }},null)"
                             class="card bg-info text-white shadow-lg">
                            <a class="text-white text-decoration-none card-body d-flex justify-content-between">
                                {{ $item->title }} :
                                <span>
                                    {{ $item->count }}
                                </span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-8 col-12 d-flex align-items-center">
                    <h5 class="font-weight-bold mb-3 mb-md-0">سفارشات موفق :</h5>
                </div>
                <div class="col-md-4 col-12 d-flex justify-content-end align-items-center">
                    <div class="ml-2">
                        <select onchange="custom_pagination(this)" name="show_per_page"
                                class="form-control form-control-sm">
                            <option value="default" {{$show_per_page==1?'selected':''}}>پیش فرض</option>
                            <option value="50" {{$show_per_page==50?'selected':''}}> نمایش 50 تایی</option>
                            <option value="100" {{$show_per_page==100?'selected':''}}> نمایش 100 تایی</option>
                            <option value="200" {{$show_per_page==200?'selected':''}}> نمایش 200 تایی</option>
                            <option value="all" {{$show_per_page==0?'selected':''}}> نمایش همه</option>
                        </select>
                    </div>
                              <p style="margin-top:17px" class="d-inline-block mx-2">نوع پرداخت:</p>
                    <div class="ml-2">
                        @php
                            $methods = \App\Models\PaymentMethods::all();
                        @endphp

                        <select id="payment-methods" onchange="custom_methods(this)" name="payment-methods"
                                class="form-control form-control-sm">

                            <option value="0" {{$payment_methods ==0?'selected':''}}> نمایش همه</option>
                            @foreach($methods as $method)
                            <option {{$payment_methods ==$method->id?'selected':''}} value="{{$method->id}}" > {{$method->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-4">
                    <div
                        class="d-flex align-center flex-column text-center flex-md-row justify-content-md-between mt-4 mb-4">
                        <div>

                            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-warning">
                                همه
                                <i class="fa fa-download"></i>
                            </a>
                            <button onclick="getOrderReport(null,null,null,'lastMonth')"
                                    class="btn btn-sm btn-outline-success">
                                ماه قبل
                                <i class="fa fa-download"></i>
                            </button>
                            <button onclick="getOrderReport(null,null,'thisMonth')"
                                    class="btn btn-sm btn-outline-secondary">
                                این ماه
                                <i class="fa fa-download"></i>
                            </button>
                            <button onclick="getOrderReport(null,'thisWeek')" class="btn btn-sm btn-outline-primary">
                                این هفته
                                <i class="fa fa-download"></i>
                            </button>
                            <button onclick="getOrderReport('today')" class="btn btn-sm btn-outline-danger">
                                امروز
                                <i class="fa fa-download"></i>
                            </button>
                            <button id="report_order_btn" class="btn btn-sm btn-outline-dark" data-toggle="modal"
                                    data-target="#filter_order_modal">
                                گزارش
                                <i class="fa fa-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div
                        class="d-flex align-center flex-column text-center flex-md-row justify-content-md-between mt-4 mb-4">
                        <input onkeyup="SearchOrder(event,this)" class="form-control form-control-sm"
                               placeholder="جست و جو بر اساس نام کاربر یا شماره سفارش یا شماره موبایل">
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <form action="{{ route('admin.orders.excel') }}" method="post"
                          class="d-flex align-center flex-column text-center justify-content-end flex-md-row mt-4 mb-4">
                        @csrf
                        <div class="form-group ml-3">
                            <div class="input-group">
                                <div class="input-group-prepend order-2">
                                                    <span class="input-group-text" id="order_start_excel">
                                                        <i class="fas fa-clock"></i>
                                                    </span>
                                </div>
                                <input placeholder="تاریخ شروع" type="text"
                                       class="form-control form-control-sm" id="order_start_input_excel"
                                       name="date_on_sale_from_excel"
                                       value="">
                            </div>
                            @error('date_on_sale_from_excel')
                            <p style="color: red;font-size: 9pt">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group ml-3">
                            <div class="input-group">
                                <div class="input-group-prepend order-2">
                                                    <span class="input-group-text" id="order_end_excel">
                                                        <i class="fas fa-clock"></i>
                                                    </span>
                                </div>
                                <input placeholder="تاریخ پایان" type="text"
                                       class="form-control form-control-sm" id="order_end_input_excel"
                                       name="date_to_sale_from_excel"
                                       value="">
                            </div>
                            @error('date_to_sale_from_excel')
                            <p style="color: red;font-size: 9pt">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-danger btn-sm">EXCEL</button>
                    </form>
                </div>
                <div class="col-12">
                    <div id="NotFound" class="text-center alert alert-danger">
                        برای این تاریخ سفارشی یافت نشد
                    </div>
                    <div id="totalSale" class="alert alert-info text-center">
                        مقدار کل فروش برابر با {{ number_format($total_sale) }} تومان میباشد
                    </div>
                </div>
            </div>
            <div id="orderReports" class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                    <tr class="bg-dark text-white">
                        <th>#</th>
                        <th>نام کاربر</th>
                        <th>کیف پول (تومان)</th>
                        <th>قابل پرداخت (تومان)</th>
                        <th>کل (تومان)</th>
                        <th>نوع پرداخت</th>
                        <th>وضعیت تراکنش</th>
                        <th>تاریخ</th>
                        <th>SMS</th>
                        <th>وضعیت سفارش</th>
                        <th>شماره سفارش</th>
                        <th>شیوه‌ی ارسال</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="orders">
                    @foreach ($orders as $key => $order)
                        <tr>
                            <th>
                                {{ $orders->firstItem() + $key }}
                            </th>
                            <th>
                                <a href="{{ route('admin.user.edit',['user'=>$order->user->id]) }}">
                                    {{ $order->user->first_name == null ? $order->user->cellphone : $order->user->first_name.' '.$order->user->last_name }}
                                </a>
                            </th>
                            <th>
                                {{ number_format($order->wallet) }}
                            </th>
                            <th>
                                {{ number_format($order->paying_amount) }}
                            </th>
                            <th>
                                {{ number_format($order->total_amount) }}
                            </th>
                            <th>
                                {{ $order->paymentMethod->title }}
                                @if($order->paymentMethod->id==3 and $order->image!=null)
                                    <a target="_blank" href="{{ imageExist(env('ORDER_IMAGE_UPLOAD_PATH'),$order->image) }}">
                                        <i class="fa fa-paperclip"></i>
                                    </a>
                                @endif
                            </th>
                            <th>
                                {{ $order->payment_status }}
                            </th>
                            <th>
                                {{ verta($order->created_at)->format('%d %B ,Y') }}
                            </th>
                            <th>
                                <a title="ارسال پیامک تغییر وضعیت" id="active_sms_icon_{{ $order->id }}"
                                   onclick="active_sms({{ $order->id }})"
                                   class="btn btn-sm {{ $order->getRawOriginal('active_sms')==1 ? 'btn-success text-white' : 'btn-dark' }}">
                                    {{ $order->active_sms }}
                                </a>
                            </th>
                            <th>
                                <select onchange="changeOrderStatus(this,{{ $order->id }},{{ $order->paymentMethod->id }})"
                                        class="form-control form-control-sm">
                                         @foreach($order_status as $item)
                                        @if($item->id == 7 and $order->payment_type != 3)
                                            @break
                                        @endif
                                        <option
                                            {{ $order->delivery_status==$item->id ? 'selected' : ' ' }} value="{{ $item->id }}">
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </th>
                            <th>
                                {{ $setting->productCode.'-'.$order->order_number }}
                            </th>
                            <th>
                                {{ $order->DeliveryMethod->name }}
                                @if($order->getRawOriginal('delivery_method')==3 and  $order->getRawOriginal('payment_status')==1)
                                    <a target="_blank" class="btn btn-sm btn-dark"
                                       href="{{ route('admin.orders.print', ['order' => $order->id]) }}">
                                        درخواست الوپیک
                                    </a>
                                @endif
                            </th>
                            <th>
                                <a title="جزئیات" class="btn btn-sm btn-success mb-1"
                                   href="{{ route('admin.orders.show', ['order' => $order->id]) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a title="پرینت" target="_blank" class="btn btn-sm btn-dark mb-1"
                                   href="{{ route('admin.orders.print', ['order' => $order->id]) }}">
                                    <i class="fa fa-print"></i>
                                </a>
                                <a title="پرینت پیک" target="_blank" class="btn btn-sm btn-warning mb-1"
                                   href="{{ route('admin.orders.print_peyk', ['order' => $order->id]) }}">
                                    <i class="fa fa-motorcycle"></i>
                                </a>
                                <button title="حذف" type="button" onclick="RemoveModal({{ $order->id }})"
                                        class="btn btn-sm btn-danger mb-1"
                                        href=""><i class="fa fa-trash"></i></button>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div id="Auto_paginate" class="d-flex justify-content-center mt-5">
                {{ $orders->render() }}
            </div>
            <nav>
                <ul id="pagination" class="pagination justify-content-center">
                </ul>
            </nav>
            <input type="hidden" name="currentPage" id="currentPage" value="1">
            <div id="overlay">
                <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"></div>
                <br/>
                Loading...
            </div>
        </div>
    </div>

    {{--    //filter_modal--}}
    @include('admin.orders.modal')
    @include('admin.orders.filter_order_modal')
@endsection
