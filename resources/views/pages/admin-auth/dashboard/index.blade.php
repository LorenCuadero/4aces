@extends('layouts.admin.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="dashboard">
                <h2 class="text-left" style="color: #1f3c88;">Dashboard</h2>
                <p class="text-left" style="color: #1f3c88;">As of June 2023</p>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-12 col-sm-10 col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon elevation-1"><i class="fas fa-cog" style="color: #1f3c88"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Received</span>
                                        <span class="info-box-number">
                                            10
                                            <small>%</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-10 col-md-4">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon elevation-1"><i
                                            class="fas fa-thumbs-up" style="color: #1f3c88"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Payable</span>
                                        <span class="info-box-number">41,410</span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix hidden-md-up"></div>
                            <div class="col-12 col-sm-10 col-md-4">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon elevation-1"><i
                                            class="fas fa-shopping-cart" style="color: #1f3c88"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total</span>
                                        <span class="info-box-number">760</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header border-0" style="background-color: #ffff;">
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
                                    <canvas id="sales-chart" height="235"
                                        style="display: block; height: 200px; width: 641px;" width="756"
                                        class="chartjs-render-monitor"></canvas>
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
                    </div>
                    <div class="col-lg-3 align-items-center align-middle text-left" style="padding-left: 5vh">
                        <div class="col-md-14">
                            <div class="table-responsive">
                                <h4 style="color: #1f3c88;">Analytics</h4>
                                <p>Percentage of accumulated amount</p>
                                <table class="table" style="border: none">
                                    <tr  style="border: none">
                                        <td style="border: none padding: 0%;"><b style="color: #1f3c88;">STATUS</b></td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; padding: 0vh">Total Students Paid</td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; padding: 0vh">502</td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; padding: 0vh">Total Students Unpaid</td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; padding: 0vh">502</td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; padding: 0vh">Students with Paid MedicShare</td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; padding: 0vh">20</td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; padding: 0vh">Students with Unpaid MedicShare</td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; padding: 0vh">20</td>
                                    </tr>
                                </table>
                            </div>
                            <p>View All</p>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
