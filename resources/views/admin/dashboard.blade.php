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
                                                Income This Month
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
                                                Expenses this month
                                            </div>
                                            <div class="text-secondary">
                                                32 shipped
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
                                                21 today
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
                            <h3 class="card-title">Incomes vs Expense Summary</h3>
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

                <div class="col-lg-6">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-3">Using Storage <strong>6854.45 MB </strong>of 8 GB</p>
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
                        <div class="col-12">
                            <div class="card" style="height: 28rem">
                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                    <div class="divide-y">
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="avatar avatar-1">JL</span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Jeffie Lewzey</strong> commented on your <strong>"I'm
                                                            not a witch."</strong> post.
                                                    </div>
                                                    <div class="text-secondary">24 hours ago</div>
                                                </div>
                                                <div class="col-auto align-self-center">
                                                    <div class="badge bg-primary"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/002m.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        It's <strong>Mallory Hulme</strong>'s birthday. Wish him
                                                        well!
                                                    </div>
                                                    <div class="text-secondary">now</div>
                                                </div>
                                                <div class="col-auto align-self-center">
                                                    <div class="badge bg-primary"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/003m.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Dunn Slane</strong> posted <strong>"Well, what do
                                                            you want?"</strong>.
                                                    </div>
                                                    <div class="text-secondary">now</div>
                                                </div>
                                                <div class="col-auto align-self-center">
                                                    <div class="badge bg-primary"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/000f.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Emmy Levet</strong> created a new project <strong>Morning
                                                            alarm clock</strong>.
                                                    </div>
                                                    <div class="text-secondary">4 days ago</div>
                                                </div>
                                                <div class="col-auto align-self-center">
                                                    <div class="badge bg-primary"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/001f.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Maryjo Lebarree</strong> liked your photo.
                                                    </div>
                                                    <div class="text-secondary">now</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="avatar avatar-1">EP</span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Egan Poetz</strong> registered new client as
                                                        <strong>Trilia</strong>.
                                                    </div>
                                                    <div class="text-secondary">24 hours ago</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/002f.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Kellie Skingley</strong> closed a new deal on
                                                        project <strong>Pen Pineapple Apple Pen</strong>.
                                                    </div>
                                                    <div class="text-secondary">2 days ago</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/003f.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Christabel Charlwood</strong> created a new project
                                                        for <strong>Wikibox</strong>.
                                                    </div>
                                                    <div class="text-secondary">4 days ago</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="avatar avatar-1">HS</span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Haskel Shelper</strong> change status of <strong>Tabler
                                                            Icons</strong> from <strong>open</strong> to
                                                        <strong>closed</strong>.
                                                    </div>
                                                    <div class="text-secondary">now</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/006m.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Lorry Mion</strong> liked <strong>Tabler UI
                                                            Kit</strong>.
                                                    </div>
                                                    <div class="text-secondary">now</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/004f.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Leesa Beaty</strong> posted new video.
                                                    </div>
                                                    <div class="text-secondary">2 days ago</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/007m.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Perren Keemar</strong> and 3 others followed you.
                                                    </div>
                                                    <div class="text-secondary">now</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="avatar avatar-1">SA</span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Sunny Airey</strong> upload 3 new photos to category
                                                        <strong>Inspirations</strong>.
                                                    </div>
                                                    <div class="text-secondary">2 days ago</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/009m.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Geoffry Flaunders</strong> made a
                                                        <strong>$10</strong> donation.
                                                    </div>
                                                    <div class="text-secondary">2 days ago</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/010m.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Thatcher Keel</strong> created a profile.
                                                    </div>
                                                    <div class="text-secondary">3 days ago</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/005f.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Dyann Escala</strong> hosted the event <strong>Tabler
                                                            UI Birthday</strong>.
                                                    </div>
                                                    <div class="text-secondary">4 days ago</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                        <span class="avatar avatar-1"
                                                              style="background-image: url(./static/avatars/006f.jpg)"></span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Avivah Mugleston</strong> mentioned you on <strong>Best
                                                            of 2020</strong>.
                                                    </div>
                                                    <div class="text-secondary">now</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="avatar avatar-1">AA</span>
                                                </div>
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <strong>Arlie Armstead</strong> sent a Review Request to
                                                        <strong>Amanda Blake</strong>.
                                                    </div>
                                                    <div class="text-secondary">2 days ago</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="card-title">Earning activity</div>
                        </div>
                        <div class="position-relative">
                            <div class="position-absolute top-0 left-0 px-3 mt-1 w-75">
                                <div class="row">
                                    <div class="col">
                                        <div>This Month's Earning: {{$totalMonthlyIncome}}</div>
                                        <div class="text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-inline text-green icon-3">
                                                <path d="M3 17l6 -6l4 4l8 -8"/>
                                                <path d="M14 7l7 0l0 7"/>
                                            </svg>
                                            +5% more than yesterday
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="chart-development-activity"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    window.ApexCharts && (new ApexCharts(document.getElementById('chart-development-activity'), {
                                        chart: {
                                            type: "area",
                                            fontFamily: 'inherit',
                                            height: 192,
                                            sparkline: {
                                                enabled: true
                                            },
                                            animations: {
                                                enabled: false
                                            },
                                        },
                                        dataLabels: {
                                            enabled: false,
                                        },
                                        fill: {
                                            opacity: .16,
                                            type: 'solid'
                                        },
                                        stroke: {
                                            width: 2,
                                            lineCap: "round",
                                            curve: "smooth",
                                        },
                                        series: [{
                                            name: "Purchases",
                                            data: [3, 5, 4, 6, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 8, 4, 14, 30, 17, 19, 15, 14, 25, 32, 40, 55, 60, 48, 52, 70]
                                        }],
                                        tooltip: {
                                            theme: 'dark'
                                        },
                                        grid: {
                                            strokeDashArray: 4,
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
                                            '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                                        ],
                                        colors: [tabler.getColor("primary")],
                                        legend: {
                                            show: false,
                                        },
                                        point: {
                                            show: false
                                        },
                                    })).render();
                                });
                            </script>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Commit</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="w-1">
                                            <span class="avatar avatar-sm"
                                                  style="background-image: url(./static/avatars/000m.jpg)"></span>
                                    </td>
                                    <td class="td-truncate">
                                        <div class="text-truncate">
                                            Fix dart Sass compatibility (#29755)
                                        </div>
                                    </td>
                                    <td class="text-nowrap text-secondary">28 Nov 2019</td>
                                </tr>
                                <tr>
                                    <td class="w-1">
                                        <span class="avatar avatar-sm">JL</span>
                                    </td>
                                    <td class="td-truncate">
                                        <div class="text-truncate">
                                            Change deprecated html tags to text decoration classes (#29604)
                                        </div>
                                    </td>
                                    <td class="text-nowrap text-secondary">27 Nov 2019</td>
                                </tr>
                                <tr>
                                    <td class="w-1">
                                            <span class="avatar avatar-sm"
                                                  style="background-image: url(./static/avatars/002m.jpg)"></span>
                                    </td>
                                    <td class="td-truncate">
                                        <div class="text-truncate">
                                            justify-content:between ⇒ justify-content:space-between (#29734)
                                        </div>
                                    </td>
                                    <td class="text-nowrap text-secondary">26 Nov 2019</td>
                                </tr>
                                <tr>
                                    <td class="w-1">
                                            <span class="avatar avatar-sm"
                                                  style="background-image: url(./static/avatars/003m.jpg)"></span>
                                    </td>
                                    <td class="td-truncate">
                                        <div class="text-truncate">
                                            Update change-version.js (#29736)
                                        </div>
                                    </td>
                                    <td class="text-nowrap text-secondary">26 Nov 2019</td>
                                </tr>
                                <tr>
                                    <td class="w-1">
                                            <span class="avatar avatar-sm"
                                                  style="background-image: url(./static/avatars/000f.jpg)"></span>
                                    </td>
                                    <td class="td-truncate">
                                        <div class="text-truncate">
                                            Regenerate package-lock.json (#29730)
                                        </div>
                                    </td>
                                    <td class="text-nowrap text-secondary">25 Nov 2019</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-md sticky-top">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/ghost -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon icon-1">
                                    <path
                                        d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7"/>
                                    <path d="M10 10l.01 0"/>
                                    <path d="M14 10l.01 0"/>
                                    <path d="M10 14a3.5 3.5 0 0 0 4 0"/>
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Social Media Traffic</h3>
                        </div>
                        <table class="table card-table table-vcenter">
                            <thead>
                            <tr>
                                <th>Network</th>
                                <th colspan="2">Visitors</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Instagram</td>
                                <td>3,550</td>
                                <td class="w-50">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-primary" style="width: 71%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Twitter</td>
                                <td>1,798</td>
                                <td class="w-50">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-primary" style="width: 35.96%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Facebook</td>
                                <td>1,245</td>
                                <td class="w-50">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-primary" style="width: 24.9%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>TikTok</td>
                                <td>986</td>
                                <td class="w-50">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-primary" style="width: 19.72%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Pinterest</td>
                                <td>854</td>
                                <td class="w-50">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-primary"
                                             style="width: 17.080000000000002%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>VK</td>
                                <td>650</td>
                                <td class="w-50">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-primary" style="width: 13%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Pinterest</td>
                                <td>420</td>
                                <td class="w-50">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-primary" style="width: 8.4%"></div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tasks</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter">
                                <tr>
                                    <td class="w-1 pe-0">
                                        <input type="checkbox" class="form-check-input m-0 align-middle"
                                               aria-label="Select task" checked>
                                    </td>
                                    <td class="w-100">
                                        <a href="#" class="text-reset">Extend the data model.</a>
                                    </td>
                                    <td class="text-nowrap text-secondary">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"/>
                                            <path d="M16 3v4"/>
                                            <path d="M8 3v4"/>
                                            <path d="M4 11h16"/>
                                            <path d="M11 15h1"/>
                                            <path d="M12 15v3"/>
                                        </svg>
                                        December 11, 2024
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/check -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M5 12l5 5l10 -10"/>
                                            </svg>
                                            2/7
                                        </a>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/message -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M8 9h8"/>
                                                <path d="M8 13h6"/>
                                                <path
                                                    d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"/>
                                            </svg>
                                            3</a>
                                    </td>
                                    <td>
                                            <span class="avatar avatar-sm"
                                                  style="background-image: url(./static/avatars/000m.jpg)"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-1 pe-0">
                                        <input type="checkbox" class="form-check-input m-0 align-middle"
                                               aria-label="Select task">
                                    </td>
                                    <td class="w-100">
                                        <a href="#" class="text-reset">Verify the event flow.</a>
                                    </td>
                                    <td class="text-nowrap text-secondary">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"/>
                                            <path d="M16 3v4"/>
                                            <path d="M8 3v4"/>
                                            <path d="M4 11h16"/>
                                            <path d="M11 15h1"/>
                                            <path d="M12 15v3"/>
                                        </svg>
                                        October 20, 2024
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/check -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M5 12l5 5l10 -10"/>
                                            </svg>
                                            0/5
                                        </a>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/message -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M8 9h8"/>
                                                <path d="M8 13h6"/>
                                                <path
                                                    d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"/>
                                            </svg>
                                            0</a>
                                    </td>
                                    <td>
                                        <span class="avatar avatar-sm">JL</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-1 pe-0">
                                        <input type="checkbox" class="form-check-input m-0 align-middle"
                                               aria-label="Select task">
                                    </td>
                                    <td class="w-100">
                                        <a href="#" class="text-reset">Database backup and maintenance</a>
                                    </td>
                                    <td class="text-nowrap text-secondary">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"/>
                                            <path d="M16 3v4"/>
                                            <path d="M8 3v4"/>
                                            <path d="M4 11h16"/>
                                            <path d="M11 15h1"/>
                                            <path d="M12 15v3"/>
                                        </svg>
                                        October 20, 2024
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/check -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M5 12l5 5l10 -10"/>
                                            </svg>
                                            0/5
                                        </a>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/message -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M8 9h8"/>
                                                <path d="M8 13h6"/>
                                                <path
                                                    d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"/>
                                            </svg>
                                            0</a>
                                    </td>
                                    <td>
                                            <span class="avatar avatar-sm"
                                                  style="background-image: url(./static/avatars/002m.jpg)"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-1 pe-0">
                                        <input type="checkbox" class="form-check-input m-0 align-middle"
                                               aria-label="Select task" checked>
                                    </td>
                                    <td class="w-100">
                                        <a href="#" class="text-reset">Identify the implementation team.</a>
                                    </td>
                                    <td class="text-nowrap text-secondary">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"/>
                                            <path d="M16 3v4"/>
                                            <path d="M8 3v4"/>
                                            <path d="M4 11h16"/>
                                            <path d="M11 15h1"/>
                                            <path d="M12 15v3"/>
                                        </svg>
                                        January 14, 2025
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/check -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M5 12l5 5l10 -10"/>
                                            </svg>
                                            6/10
                                        </a>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/message -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M8 9h8"/>
                                                <path d="M8 13h6"/>
                                                <path
                                                    d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"/>
                                            </svg>
                                            12</a>
                                    </td>
                                    <td>
                                            <span class="avatar avatar-sm"
                                                  style="background-image: url(./static/avatars/003m.jpg)"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-1 pe-0">
                                        <input type="checkbox" class="form-check-input m-0 align-middle"
                                               aria-label="Select task">
                                    </td>
                                    <td class="w-100">
                                        <a href="#" class="text-reset">Define users and workflow</a>
                                    </td>
                                    <td class="text-nowrap text-secondary">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"/>
                                            <path d="M16 3v4"/>
                                            <path d="M8 3v4"/>
                                            <path d="M4 11h16"/>
                                            <path d="M11 15h1"/>
                                            <path d="M12 15v3"/>
                                        </svg>
                                        October 20, 2024
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/check -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M5 12l5 5l10 -10"/>
                                            </svg>
                                            0/5
                                        </a>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/message -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M8 9h8"/>
                                                <path d="M8 13h6"/>
                                                <path
                                                    d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"/>
                                            </svg>
                                            0</a>
                                    </td>
                                    <td>
                                            <span class="avatar avatar-sm"
                                                  style="background-image: url(./static/avatars/000f.jpg)"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-1 pe-0">
                                        <input type="checkbox" class="form-check-input m-0 align-middle"
                                               aria-label="Select task" checked>
                                    </td>
                                    <td class="w-100">
                                        <a href="#" class="text-reset">Check Pull Requests</a>
                                    </td>
                                    <td class="text-nowrap text-secondary">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"/>
                                            <path d="M16 3v4"/>
                                            <path d="M8 3v4"/>
                                            <path d="M4 11h16"/>
                                            <path d="M11 15h1"/>
                                            <path d="M12 15v3"/>
                                        </svg>
                                        January 16, 2025
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/check -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M5 12l5 5l10 -10"/>
                                            </svg>
                                            2/9
                                        </a>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-secondary">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/message -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-1">
                                                <path d="M8 9h8"/>
                                                <path d="M8 13h6"/>
                                                <path
                                                    d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"/>
                                            </svg>
                                            3</a>
                                    </td>
                                    <td>
                                            <span class="avatar avatar-sm"
                                                  style="background-image: url(./static/avatars/001f.jpg)"></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
