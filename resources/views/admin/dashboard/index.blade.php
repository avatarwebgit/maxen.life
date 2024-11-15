@extends('admin.layouts.admin')

@section('script')
    <script>
            function insuranceResult() {
            $('#insuranceResult').hide();
            let end_date = $('#insurance_end_input').val();
            let start_date = $('#insurance_start_input').val();
            $.ajax({
                url:"{{ route('home.insuranceResult') }}",
                data:{
                    _token:"{{ csrf_token() }}",
                    end_date:end_date,
                    start_date:start_date,
                },
                dataType:'json',
                method:'post',
                beforeSend:function (){

                },
                success:function (msg) {
                    $('#insuranceResult').show();
                    $('#insuranceResult').html(msg[1]);
                },
            })
        }

                //excel output order
        $(`#start_insurance_date`).MdPersianDateTimePicker({
            targetTextSelector: `#insurance_start_input`,
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });

        $(`#end_insurance_date`).MdPersianDateTimePicker({
            targetTextSelector: `#insurance_end_input`,
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
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


        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels:<?php echo $date; ?>,
                datasets: [{
                    label: "بازدید",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: <?php echo $val; ?>,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{


                        time: {
                            unit: 'day'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            beginAtZero:true,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function (value, index, values) {
                                 if (Math.floor(value) === value) {
                         return value + ' نفر ';
                     }

                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function (tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel+ ':' + tooltipItem.yLabel + ' نفر' ;
                        }
                    }
                }
            }
        });
    </script>


@endsection

@section('title')
    داشبورد
@endsection

@section('content')
    <!-- Page Heading -->
    {{--    <div class="d-sm-flex align-items-center justify-content-between mb-4">--}}
    {{--        <h1 class="h3 mb-0 text-gray-800"> داشبورد </h1>--}}
    {{--                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">--}}
    {{--                    <i class="fas fa-download fa-sm text-white-50"></i>--}}
    {{--                    گزارش--}}
    {{--                </a>--}}
    {{--    </div>--}}
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card bg-primary text-white shadow">
                <a href="{{ route('admin.products.index') }}" class="text-white text-decoration-none card-body d-flex justify-content-between">
                    محصولات
                    <i class="fa fa-shopping-cart fa-2x text-gray-300"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card bg-success text-white shadow">
                <a href="{{ route('admin.categories.index') }}" class="text-white text-decoration-none card-body d-flex justify-content-between">
                    دسته‌بندی ها
                    <i class="fa fa-list-alt fa-2x text-gray-300"></i>
                </a>
            </div>
        </div>

    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Pending Requests Card Example -->
{{--        <div class="col-xl-4 col-md-6 mb-4">--}}
{{--            <div class="card border-right-warning shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">--}}
{{--                                <a href="{{ route('admin.comments.index') }}"> کامنت ها--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $comments }}</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-comments fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> بازدیدکنندگان سایت </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row mb-5">
        <div class="col-12 col-xl-2 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">آمار بازدیدکنندگان</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>امروز</span>
                        <span>{{ $today_visit_count }} نفر</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>دیروز</span>
                        <span>{{ $yesterdayVisits }} نفر</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>این ماه</span>
                        <span>{{ $this_month_Visits+$today_visit_count }} نفر</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>جمع کل</span>
                        <span>{{ $total_visit + $today_visit_count }} نفر</span>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

    </div>


@endsection
