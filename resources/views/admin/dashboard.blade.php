@extends('layout.master')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar"><x-tabler-currency-dollar/></span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{get_translation('income_this_month')}}
                                            </div>
                                            <div class="text-secondary">
                                                {{$totalMonthlyIncome}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
					<span class="bg-green text-white avatar">
                        <x-tabler-license/>
                    </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{get_translation('expense_this_month')}}
                                            </div>
                                            <div class="text-secondary">
                                                {{$totalMonthlyExpense}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-x text-white avatar"><x-tabler-moneybag/></span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                Total Account Balance
                                            </div>
                                            <div class="text-secondary">
                                                {{$totalAccountBalances}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-facebook text-white avatar"><x-tabler-minus/></span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                Total Lend Amount
                                            </div>
                                            <div class="text-secondary">
                                                {{$totalLends}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Incomes vs Expense Summary - Last 6 Months</h3>
                            <div id="chart-mentions" class="chart-lg"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
                                        chart: {
                                            type: "bar",
                                            fontFamily: 'inherit',
                                            height: 240,
                                            parentHeightOffset: 0,
                                            toolbar: {
                                                show: false,
                                            },
                                            animations: {
                                                enabled: false
                                            },
                                            stacked: true,
                                        },
                                        plotOptions: {
                                            bar: {
                                                columnWidth: '50%',
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false,
                                        },
                                        fill: {
                                            opacity: 1,
                                        },
                                        series: [{
                                            name: "Web",
                                            data: [1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 2, 12, 5, 8, 22, 6, 8, 6, 4, 1, 8, 24, 29, 51, 40, 47, 23, 26, 50, 26, 41, 22, 46, 47, 81, 46, 6]
                                        }, {
                                            name: "Social",
                                            data: [2, 5, 4, 3, 3, 1, 4, 7, 5, 1, 2, 5, 3, 2, 6, 7, 7, 1, 5, 5, 2, 12, 4, 6, 18, 3, 5, 2, 13, 15, 20, 47, 18, 15, 11, 10, 0]
                                        }, {
                                            name: "Other",
                                            data: [2, 9, 1, 7, 8, 3, 6, 5, 5, 4, 6, 4, 1, 9, 3, 6, 7, 5, 2, 8, 4, 9, 1, 2, 6, 7, 5, 1, 8, 3, 2, 3, 4, 9, 7, 1, 6]
                                        }],
                                        tooltip: {
                                            theme: 'dark'
                                        },
                                        grid: {
                                            padding: {
                                                top: -20,
                                                right: 0,
                                                left: -4,
                                                bottom: -4
                                            },
                                            strokeDashArray: 4,
                                            xaxis: {
                                                lines: {
                                                    show: true
                                                }
                                            },
                                        },
                                        xaxis: {
                                            labels: {
                                                padding: 0,
                                            },
                                            tooltip: {
                                                enabled: false
                                            },
                                            axisBorder: {
                                                show: false,
                                            },
                                            type: 'datetime',
                                        },
                                        yaxis: {
                                            labels: {
                                                padding: 4
                                            },
                                        },
                                        labels: [
                                            '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19', '2020-07-20', '2020-07-21', '2020-07-22', '2020-07-23', '2020-07-24', '2020-07-25', '2020-07-26'
                                        ],
                                        colors: [tabler.getColor("primary"), tabler.getColor("primary", 0.8), tabler.getColor("green", 0.8)],
                                        legend: {
                                            show: false,
                                        },
                                    })).render();
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-3">Budget distributed among categories</p>
                                    <div class="progress progress-separated mb-3">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 44%"
                                             aria-label="Regular"></div>
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 19%"
                                             aria-label="System"></div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 9%"
                                             aria-label="Shared"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto d-flex align-items-center pe-2">
                                            <span class="legend me-2 bg-primary"></span>
                                            <span>Regular</span>
                                            <span
                                                class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-secondary">915MB</span>
                                        </div>
                                        <div class="col-auto d-flex align-items-center px-2">
                                            <span class="legend me-2 bg-info"></span>
                                            <span>System</span>
                                            <span
                                                class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-secondary">415MB</span>
                                        </div>
                                        <div class="col-auto d-flex align-items-center px-2">
                                            <span class="legend me-2 bg-success"></span>
                                            <span>Shared</span>
                                            <span
                                                class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-secondary">201MB</span>
                                        </div>
                                        <div class="col-auto d-flex align-items-center ps-2">
                                            <span class="legend me-2"></span>
                                            <span>Free</span>
                                            <span
                                                class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-secondary">612MB</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
