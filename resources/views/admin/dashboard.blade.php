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
                                            <span class="bg-success text-white avatar"><x-tabler-currency-dollar/></span>
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
                                            <span class="bg-danger text-white avatar"><x-tabler-license/></span>
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
                                                {{get_translation('total_account_balance')}}
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
                                            <span class="bg-cyan text-white avatar"><x-tabler-arrows-right/></span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{get_translation('total_lend_amount')}}
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
                <div class="col-12">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-dribbble text-white avatar"><x-tabler-arrows-left/></span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{get_translation('total_borrow_amount')}}
                                            </div>
                                            <div class="text-secondary">
                                                {{$totalBorrows}}
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
                                            <span class="bg-info text-white avatar"><x-tabler-building-bank/></span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{get_translation('number_of_bank_accounts')}}
                                            </div>
                                            <div class="text-secondary">
                                                {{$numberOfBankAccounts}}
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
                                            <span class="bg-rss text-white avatar"><x-tabler-zoom-money/></span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{get_translation('total_income_this_year')}}
                                            </div>
                                            <div class="text-secondary">
                                                {{$totalYearlyIncome}}
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
                                            <span class="bg-instagram text-white avatar"><x-tabler-exposure/></span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{get_translation('total_expense_this_year')}}
                                            </div>
                                            <div class="text-secondary">
                                                {{$totalYearlyExpense}}
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
                            <h3 class="card-title">{{get_translation('income_vs_expense_summary_current_year_in_default_currency')}}</h3>
                            <div id="chart-mentions" class="chart-lg"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-3">{{get_translation('budget_distribution_among_expense_categories_current_month')}}</p>

                                    <div class="progress progress-separated mb-3">
                                        @foreach($budgetData['distribution'] as $dist)
                                            <div
                                                class="progress-bar"
                                                role="progressbar"
                                                style="background-color: {{ $dist['color'] }}; width: {{ number_format($dist['percentage'], 2) }}%"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="bottom"
                                                title="{{ $dist['name'] }} - {{$budgetData['currencyCode']}} {{ number_format($dist['spent'], 2) }} ({{ number_format($dist['percentage'], 2) }}%)"
                                                aria-label="{{ $dist['name'] }}">
                                            </div>
                                        @endforeach

                                        @if($budgetData['freePercentage'] > 0)
                                            <div
                                                class="progress-bar bg-secondary"
                                                role="progressbar"
                                                style="width: {{ number_format($budgetData['freePercentage'], 2) }}%"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="bottom"
                                                title="Free - {{ number_format($budgetData['freeAmount'], 2) }} {{$budgetData['currencyCode']}} ({{ number_format($budgetData['freePercentage'], 2) }}%)"
                                                aria-label="Free">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        @foreach($budgetData['distribution'] as $dist)
                                            <div class="col-auto d-flex align-items-center px-2">
                                                <span class="legend me-2"
                                                      style="background-color: {{ $dist['color'] }}"></span>
                                                <span>{{ $dist['name'] }}</span>
                                                <span
                                                    class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-secondary">{{$budgetData['currencyCode']}} {{ number_format($dist['spent'], 2) }}</span>
                                            </div>
                                        @endforeach

                                        @if($budgetData['freeAmount'] > 0)
                                            <div class="col-auto d-flex align-items-center px-2">
                                                <span class="legend me-2 bg-secondary"></span>
                                                <span>Free</span>
                                                <span
                                                    class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-secondary">{{$budgetData['currencyCode']}} {{ number_format($budgetData['freeAmount'], 2) }}</span>
                                            </div>
                                        @endif
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

@section('js')
    <script>
        "use strict";
        document.addEventListener("DOMContentLoaded", function () {
            if (window.ApexCharts) {
                new ApexCharts(document.getElementById('chart-mentions'), {
                    chart: {
                        type: "bar",
                        fontFamily: 'inherit',
                        height: 240,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: true,
                            easing: 'linear',        // Faster transition
                            speed: 200,              // Fast animation
                            animateGradually: {
                                enabled: true,
                                delay: 10             // Minimal delay
                            },
                            dynamicAnimation: {
                                enabled: true,
                                speed: 200
                            }
                        },
                        stacked: true,
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '28%',
                            borderRadius: 0, // 👈 Removed rounded corners
                        }
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: [
                        {
                            name: "Income",
                            data: @json($incomeData['incomes'])
                        },
                        {
                            name: "Expense",
                            data: @json($incomeData['expenses'])
                        }
                    ],
                    tooltip: {
                        theme: 'dark',
                        marker: {
                            show: false,
                        },
                        style: {
                            fontSize: '14px',
                            fontFamily: 'inherit',
                        },
                        onDatasetHover: {
                            highlightDataSeries: true,
                        },
                        x: {
                            show: true,
                        },
                        y: {
                            formatter: function (value) {
                                return value.toFixed(2);
                            },
                        },
                        padding: {
                            top: 10,
                            right: 10,
                            bottom: 10,
                            left: 10,
                        },
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
                        categories: @json($incomeData['months']),
                        labels: {
                            padding: 0,
                            style: {
                                fontSize: '12px',
                                colors: '#6c757d'
                            }
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: 'category',
                    },
                    yaxis: {
                        labels: {
                            padding: 4,
                            formatter: function (value) {
                                return value.toFixed(2);
                            },
                            style: {
                                fontSize: '12px',
                                colors: '#6c757d'
                            }
                        },
                        title: {
                            text: ''
                        },
                        tickAmount: 5
                    },
                    colors: ['#6EC1E4', '#FF9AA2'],
                    legend: {
                        show: true,
                        position: 'top',
                        horizontalAlign: 'right',
                        labels: {
                            colors: '#6c757d',
                            useSeriesColors: false
                        }
                    },
                }).render();
            }
        });
    </script>

@endsection
