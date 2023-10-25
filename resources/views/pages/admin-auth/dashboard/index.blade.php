@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('words.SignInMessage') }}</h1>
        <h1>Admin</h1>

        <div class="dashboard">
            <h2>Dashboard</h2>
            <p>As of June 2023</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Parent's Counterpart</th>
                        <th>Received</th>
                        <th>Medical Share</th>
                        <th>Total Earned</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>₱ 58,000.00</td>
                        <td>₱ 18,500.00</td>
                        <td>₱ 76,500.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Sales</h3>
                        <a href="javascript:void(0);">View Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">$18,230.00</span>
                            <span>Sales Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i> 33.1%
                            </span>
                            <span class="text-muted">Since last month</span>
                        </p>
                    </div>

                    <div class="position-relative mb-4">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="sales-chart" height="235" style="display: block; height: 200px; width: 772px;"
                            width="910" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> This year
                        </span>
                        <span>
                            <i class="fas fa-square text-gray"></i> Last year
                        </span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Online Store Overview</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-sm btn-tool">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-tool">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-success text-xl">
                            <i class="ion ion-ios-refresh-empty"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                <i class="ion ion-android-arrow-up text-success"></i> 12%
                            </span>
                            <span class="text-muted">CONVERSION RATE</span>
                        </p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-warning text-xl">
                            <i class="ion ion-ios-cart-outline"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                            </span>
                            <span class="text-muted">SALES RATE</span>
                        </p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <p class="text-danger text-xl">
                            <i class="ion ion-ios-people-outline"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                <i class="ion ion-android-arrow-down text-danger"></i> 1%
                            </span>
                            <span class="text-muted">REGISTRATION RATE</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="students">
            <h2>Students</h2>
            <p>Year 2023</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>STATUS</th>
                        <th>Total Students Paid</th>
                        <th>Total Students Unpaid</th>
                        <th>Students with Paid MedicShare</th>
                        <th>Students with Unpaid MedicShare</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>100</td>
                        <td>75</td>
                        <td>102</td>
                        <td>50</td>
                        <td>502</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="monthly-data">
            <h2>Jan Feb Mar Jun Jul Aug Sep Oct Nov Dec</h2>
        </div>

        <div class="view-all">
            <a href="#">View All</a>
        </div>
    </div>
@endsection
