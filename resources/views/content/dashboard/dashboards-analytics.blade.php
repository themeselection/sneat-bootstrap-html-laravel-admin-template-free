@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
@vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
@vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
<div class="row">
    <div class="col-xxl-8 mb-6 order-0">
        <div class="card">
            <div class="d-flex align-items-start row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-3">Congratulations John! 🎉</h5>
                        <p class="mb-6">You have done 72% more sales today.<br />Check your new badge in your profile.</p>

                        <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-6">
                        <img src="{{ asset('assets/img/illustrations/man-with-laptop.png') }}" height="175" alt="View Badge User" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-lg-12 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-1">Profit</p>
                        <h4 class="card-title mb-3">$12,628</h4>
                        <small class="text-success fw-medium"><i class="icon-base bx bx-up-arrow-alt"></i> +72.80%</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="wallet info" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-1">Sales</p>
                        <h4 class="card-title mb-3">$4,679</h4>
                        <small class="text-success fw-medium"><i class="icon-base bx bx-up-arrow-alt"></i> +28.42%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Revenue -->
    <div class="col-12 col-xxl-8 order-2 order-md-3 order-xxl-2 mb-6 total-revenue">
        <div class="card">
            <div class="row row-bordered g-0">
                <div class="col-lg-8">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Total Revenue</h5>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="totalRevenue" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-base bx bx-dots-vertical-rounded icon-lg text-body-secondary"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalRevenue">
                                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                    <div id="totalRevenueChart" class="px-3"></div>
                </div>
                <div class="col-lg-4">
                    <div class="card-body px-xl-9 py-12 d-flex align-items-center flex-column">
                        <div class="text-center mb-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary">
                                    <script>
                                    document.write(new Date().getFullYear() - 1);
                                    </script>
                                </button>
                                <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">2021</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">2020</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">2019</a></li>
                                </ul>
                            </div>
                        </div>

                        <div id="growthChart"></div>
                        <div class="text-center fw-medium my-6">62% Company Growth</div>

                        <div class="d-flex gap-11 justify-content-between">
                            <div class="d-flex">
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded-2 bg-label-primary"><i class="icon-base bx bx-dollar icon-lg text-primary"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>
                                        <script>
                                        document.write(new Date().getFullYear() - 1);
                                        </script>
                                    </small>
                                    <h6 class="mb-0">$32.5k</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded-2 bg-label-info"><i class="icon-base bx bx-wallet icon-lg text-info"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>
                                        <script>
                                        document.write(new Date().getFullYear() - 2);
                                        </script>
                                    </small>
                                    <h6 class="mb-0">$41.2k</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Total Revenue -->
    <div class="col-12 col-md-8 col-lg-12 col-xxl-4 order-3 order-md-2 profile-report">
        <div class="row">
            <div class="col-6 mb-6 payments">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-1">Payments</p>
                        <h4 class="card-title mb-3">$2,456</h4>
                        <small class="text-danger fw-medium"><i class="icon-base bx bx-down-arrow-alt"></i> -14.82%</small>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-6 transactions">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-1">Transactions</p>
                        <h4 class="card-title mb-3">$14,857</h4>
                        <small class="text-success fw-medium"><i class="icon-base bx bx-up-arrow-alt"></i> +28.14%</small>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-6 profile-report">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-sm-row flex-column gap-10 flex-wrap">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title mb-6">
                                    <h5 class="text-nowrap mb-1">Profile Report</h5>
                                    <span class="badge bg-label-warning">YEAR 2022</span>
                                </div>
                                <div class="mt-sm-auto">
                                    <span class="text-success text-nowrap fw-medium"><i class="icon-base bx bx-up-arrow-alt"></i> 68.2%</span>
                                    <h4 class="mb-0">$84,686k</h4>
                                </div>
                            </div>
                            <div id="profileReportChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Order Statistics -->
    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title mb-0">
                    <h5 class="mb-1 me-2">Order Statistics</h5>
                    <p class="card-subtitle">42.82k Total Sales</p>
                </div>
                <div class="dropdown">
                    <button class="btn text-body-secondary p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-base bx bx-dots-vertical-rounded icon-lg"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                        <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-6">
                    <div class="d-flex flex-column align-items-center gap-1">
                        <h3 class="mb-1">8,258</h3>
                        <small>Total Orders</small>
                    </div>
                    <div id="orderStatisticsChart"></div>
                </div>
                <ul class="p-0 m-0">
                    <li class="d-flex align-items-center mb-5">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"><i class="icon-base bx bx-mobile-alt"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Electronic</h6>
                                <small>Mobile, Earbuds, TV</small>
                            </div>
                            <div class="user-progress">
                                <h6 class="mb-0">82.5k</h6>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex align-items-center mb-5">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-success"><i class="icon-base bx bx-closet"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Fashion</h6>
                                <small>T-shirt, Jeans, Shoes</small>
                            </div>
                            <div class="user-progress">
                                <h6 class="mb-0">23.8k</h6>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex align-items-center mb-5">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info"><i class="icon-base bx bx-home-alt"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Decor</h6>
                                <small>Fine Art, Dining</small>
                            </div>
                            <div class="user-progress">
                                <h6 class="mb-0">849k</h6>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-secondary"><i class="icon-base bx bx-football"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Sports</h6>
                                <small>Football, Cricket Kit</small>
                            </div>
                            <div class="user-progress">
                                <h6 class="mb-0">99</h6>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--/ Order Statistics -->

    <!-- Expense Overview -->
    <div class="col-md-6 col-lg-4 order-1 mb-6">
        <div class="card h-100">
            <div class="card-header nav-align-top">
                <ul class="nav nav-pills flex-wrap row-gap-2" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tabs-line-card-income" aria-controls="navs-tabs-line-card-income" aria-selected="true">Income</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab">Expenses</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab">Profit</button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                        <div class="d-flex mb-6">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ asset('assets/img/icons/unicons/wallet.png') }}" alt="User" />
                            </div>
                            <div>
                                <p class="mb-0">Total Balance</p>
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 me-1">$459.10</h6>
                                    <small class="text-success fw-medium">
                                        <i class="icon-base bx bx-chevron-up icon-lg"></i>
                                        42.9%
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div id="incomeChart"></div>
                        <div class="d-flex align-items-center justify-content-center mt-6 gap-3">
                            <div class="flex-shrink-0">
                                <div id="expensesOfWeek"></div>
                            </div>
                            <div>
                                <h6 class="mb-0">Income this week</h6>
                                <small>$39k less than last week</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Expense Overview -->

    <!-- Transactions -->
    <div class="col-md-6 col-lg-4 order-2 mb-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Transactions</h5>
                <div class="dropdown">
                    <button class="btn text-body-secondary p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-base bx bx-dots-vertical-rounded icon-lg"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                        <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                        <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                        <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4">
                <ul class="p-0 m-0">
                    <li class="d-flex align-items-center mb-6">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('assets/img/icons/unicons/paypal.png') }}" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="d-block">Paypal</small>
                                <h6 class="fw-normal mb-0">Send money</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-2">
                                <h6 class="fw-normal mb-0">+82.6</h6>
                                <span class="text-body-secondary">USD</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex align-items-center mb-6">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('assets/img/icons/unicons/wallet.png') }}" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="d-block">Wallet</small>
                                <h6 class="fw-normal mb-0">Mac'D</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-2">
                                <h6 class="fw-normal mb-0">+270.69</h6>
                                <span class="text-body-secondary">USD</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex align-items-center mb-6">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('assets/img/icons/unicons/chart.png') }}" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="d-block">Transfer</small>
                                <h6 class="fw-normal mb-0">Refund</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-2">
                                <h6 class="fw-normal mb-0">+637.91</h6>
                                <span class="text-body-secondary">USD</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex align-items-center mb-6">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('assets/img/icons/unicons/cc-primary.png') }}" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="d-block">Credit Card</small>
                                <h6 class="fw-normal mb-0">Ordered Food</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-2">
                                <h6 class="fw-normal mb-0">-838.71</h6>
                                <span class="text-body-secondary">USD</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex align-items-center mb-6">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('assets/img/icons/unicons/wallet.png') }}" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="d-block">Wallet</small>
                                <h6 class="fw-normal mb-0">Starbucks</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-2">
                                <h6 class="fw-normal mb-0">+203.33</h6>
                                <span class="text-body-secondary">USD</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('assets/img/icons/unicons/cc-warning.png') }}" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="d-block">Mastercard</small>
                                <h6 class="fw-normal mb-0">Ordered Food</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-2">
                                <h6 class="fw-normal mb-0">-92.45</h6>
                                <span class="text-body-secondary">USD</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--/ Transactions -->
</div>
@endsection
