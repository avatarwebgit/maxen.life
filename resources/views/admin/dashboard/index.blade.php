@extends('admin.layouts.admin')

@section('style')
    <style>
        /* 5 باکس در یک ردیف روی نمایشگر خیلی بزرگ */
        @media (min-width: 1400px) {
            .stats-row > [class*="col-"] {
                width: 20% !important;
                flex: 0 0 20% !important;
            }
        }

        /* عنوان‌ها */
        .stats-title {
            display: block; /* حتماً بلوکی باشد */
            clear: both; /* همیشه بالای باکس‌ها قرار بگیرد */
            font-size: 1.35rem;
            font-weight: 800;
            color: #2d2d2d;
            margin: 1rem 0 1.1rem;
            text-align: right;
            position: relative;
        }

        .stats-title::after {
            content: "";
            position: absolute;
            bottom: -6px;
            right: 0;
            width: 56px;
            height: 3px;
            background: linear-gradient(90deg, #4e73df, #36b9cc);
            border-radius: 3px;
        }

        /* کارت‌ها */
        .stat-card {
            border: none;
            border-radius: .85rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .06);
            transition: transform .15s ease, box-shadow .2s ease;
            min-height: 125px;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, .12);
        }

        .stat-card .card-body {
            padding: 1rem 1.2rem;
            text-align: center;
        }

        /* آیکون‌ها */
        .stat-card i {
            font-size: 1.5rem !important;
            margin-bottom: .5rem !important;
            color: #fff !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, .3);
        }

        /* اعداد و کپشن‌ها */
        .stat-card h3 {
            font-size: 1.65rem;
            font-weight: 800;
            margin-bottom: .25rem;
            color: #fff;
            line-height: 1.3;
            letter-spacing: .2px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, .25);
        }

        .stat-card p {
            font-size: 1.05rem;
            font-weight: 600;
            color: #fff;
            line-height: 1.5;
            text-shadow: 0 1px 2px rgba(0, 0, 0, .25);
            margin: 0;
        }

        /* رنگ‌ها */
        .stat-card.bg-info {
            background: linear-gradient(135deg, #00bfe8, #2f7bff);
        }

        .stat-card.bg-success {
            background: linear-gradient(135deg, #00a87a, #8ad133);
        }

        .stat-card.bg-primary {
            background: linear-gradient(135deg, #5b40d6, #2b76ff);
        }

        .stat-card.bg-danger {
            background: linear-gradient(135deg, #ff4b55, #ff7b44);
        }

        .stat-card.bg-warning {
            background: linear-gradient(135deg, #ffb739, #ffd449);
        }

        .stat-card.bg-warning h3,
        .stat-card.bg-warning p,
        .stat-card.bg-warning i {
            color: #2a1f00 !important;
            text-shadow: none;
        }

        /* فاصله‌ها */
        .stats-row {
            display: flex;
            justify-content: center; /* وسط‌چین افقی */
            align-items: center; /* وسط‌چین عمودی */
            flex-wrap: wrap; /* ریسپانسیو */
            gap: 12px;
            margin-bottom: 1.6rem;
        }

        /* موبایل */
        @media (max-width: 576px) {
            .stat-card {
                min-height: 115px;
            }

            .stat-card h3 {
                font-size: 1.4rem;
            }

            .stat-card p {
                font-size: .95rem;
            }
        }
    </style>
@endsection

@section('script')
    <script>
        const chartData = {
            dates: @json($chartDates),
            values: @json($chartValues)
        };

        const ctx = document.getElementById("visitChart");
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.dates,
                    datasets: [{
                        label: "بازدید",
                        data: chartData.values,
                        borderColor: "rgba(78, 115, 223, 1)",
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        lineTension: 0.3,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [{
                            gridLines: {display: false},
                            ticks: {maxTicksLimit: 7}
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: value => Number.isInteger(value) ? `${value} نفر` : null
                            },
                            gridLines: {color: "rgb(234, 236, 244)", borderDash: [2]}
                        }]
                    },
                    legend: {display: false},
                    tooltips: {
                        backgroundColor: "#fff",
                        titleFontColor: '#6e707e',
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        callbacks: {
                            label: (item) => `بازدید: ${item.yLabel} نفر`
                        }
                    }
                }
            });
        }
    </script>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid">
        <div class="post d-flex flex-column-fluid">
            <div class="container-fluid">

                <!-- عنوان و باکس‌ها -->
                <span class="stats-title">آمار کلی</span>
                <div class="row g-5 stats-row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-info text-white stat-card">
                            <div class="card-body">
                                <i class="fas fa-eye"></i>
                                <h3>{{ number_format($todayVisits) }}</h3>
                                <p>بازدید امروز</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white stat-card">
                            <div class="card-body">
                                <i class="fas fa-calendar-day"></i>
                                <h3>{{ number_format($yesterdayVisits) }}</h3>
                                <p>بازدید دیروز</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning stat-card">
                            <div class="card-body">
                                <i class="fas fa-calendar-alt"></i>
                                <h3>{{ number_format($monthVisits) }}</h3>
                                <p>بازدید این ماه</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white stat-card">
                            <div class="card-body">
                                <i class="fas fa-chart-line"></i>
                                <h3>{{ number_format($totalVisits) }}</h3>
                                <p>مجموع بازدیدها</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- نمودار -->
                <span class="stats-title">نمودار 30 روز اخیر</span>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div style="height: 300px;">
                                    <canvas id="visitChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.container-xxl -->
        </div><!-- /.post -->
    </div><!-- /.content -->
@endsection
