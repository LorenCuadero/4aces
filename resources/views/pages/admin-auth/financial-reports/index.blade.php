@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <span>
                    @if (session('error'))
                        <p><span class="text-danger error-display ml-2">[ {{ session('error') }} ]</span></p>
                    @endif
                </span>
                <div class="col-12" id="table">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between"
                            style="background-color: #ffff; color: #1f3c88">
                            <p class="card-title mb-3 mb-md-0" style="color:#1f3c88; padding-left:0%; font-size: 22px">
                                <b>Finance Reports</b>
                            </p>
                            <div class="d-flex flex-wrap align-items-center ml-auto">
                                <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0"
                                    style="display: flex; align-items: center;" id="date-form"
                                    action="{{ route('admin.reports.viewFinancialReportByDateFromAndTo') }}" method="POST">
                                    @csrf
                                    <div class="nav-item btn btn-sm p-0" style="display: flex; align-items:center;">
                                        <input type="date" class="form-control rounded p-2 filters" id="date-from"
                                            name="dateFrom" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                                    </div>
                                    <div class="nav-item btn btn-sm p-0 m-2" style="display: flex; align-items:center;">
                                        <p class="mb-0 text-to filters">to</p>
                                    </div>
                                    <div class="nav-item btn btn-sm p-0" style="display: flex; align-items:center; ">
                                        <input type="date" id="date-to" class="form-control rounded filters"
                                            name="dateTo" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                                    </div>
                                    <div class="nav-item btn btn-sm p-0" style="display: flex; align-items:center;">
                                        <input type="hidden" id="all-student-number-financial report"
                                            value="{{ $totalNumberOfStudents }}">
                                        <div class="col-md-6" style="text-align: left">
                                            <div class="form-group row text-left">
                                                <div class="col-md-7">
                                                    <select class="form-control" name="batchYear" id="batch_year">
                                                        <a id="allBatch"
                                                            href="{{ route('admin.reports.financialReports') }}">
                                                            <option value="">All
                                                                Batch Year</option>
                                                        </a>
                                                        @foreach ($batchYears as $batchYear)
                                                            <option name="batchYear" value="{{ $batchYear }}">
                                                                {{ $batchYear }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" id="filter-submit" class="btn ml-1 filters"
                                        style="background-color: #1f3c88; color:#ffff" title="Filter"><i
                                            class='fas fa-filter' style='font-size:20px; color:#ffff'></i> Filter </button>
                                    <a href="{{ route('admin.reports.financialReports') }}"
                                        class="btn reset-filter filters ml-1"
                                        style="background-color: #1f3c88; color:#ffffff" title="Reset Filter"><i
                                            class="fa fa-refresh" style="font-size:20px; color:#ffffff"></i> Reset</a>
                                    <div class="dropdown ml-1">
                                        <button class="btn btn-default dropdown-toggle" type="button"
                                            id="printDropdownButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="background-color: #1f3c88; color: #ffff;">
                                            <i class="fas fa-print" style="color: #ffffff"></i> Print
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="printDropdownButton">
                                            <a class="dropdown-item" href="#" id="printButtonOnFinancial">Print Summary</a>
                                            <a class="dropdown-item" href="#" id="printPayableSummary">Print Payables
                                                Summary</a>
                                            <a class="dropdown-item" href="#" id="printPaymentSummary">Print Payments
                                                Summary</a>
                                        </div>
                                    </div>

                                </form>
                                {{-- printButtonOnFinancial --}}
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <div class="card-body" id="printableArea">
                                <div class="table-responsive">
                                    <div class="m-2 mb-4">
                                        <h5 class="mb-0">Summary of Payments and Payables</h5>
                                        @if (isset($batchYearSelected))
                                            <span id="selected-batch-year-reports">Batch {{ $batchYearSelected }}</span>
                                        @endif
                                        @if (isset($allBatchYear))
                                            <span id="all-batch-year-reports">{{ $allBatchYear }}</span>
                                        @endif
                                        <br>
                                        @if (isset($dateFrom) && isset($dateTo))
                                            <span id="dates-from-text-when-set">{{ $dateFrom }}</span> - <span
                                                id="dates-to-text-when-set">{{ $dateTo }}</span>
                                        @endif
                                        @if (isset($startFromDate) && isset($endToDate))
                                            <span id="dates-started">{{ $startFromDate }}</span> - <span
                                                id="date-current">{{ $endToDate }}</span>
                                        @endif
                                    </div>
                                    <div class="table-responsive">
                                        <div class="custom-table-container">
                                            <table id="example2" class="table table-hover text-left rounded"
                                                style="width:90%">
                                                <thead>
                                                    <tr>
                                                        <th style="background-color: #ffff; color: #1f3c88; ">
                                                            Name of Records
                                                        </th>
                                                        <th style="background-color: #ffff; color: #1f3c88; ">
                                                            Payments
                                                        </th>
                                                        <th style="background-color: #ffff; color: #1f3c88; ">
                                                            Payables
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-body">
                                                    <tr>
                                                        <td style="">Parent's Counterpart</td>
                                                        <td id="counterTotal" style="">₱
                                                            {{ number_format($counterpartTotal, 2) }}</td>
                                                        <td>₱ {{ number_format($counterpartTotalPayable, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="">Medical Share</td>
                                                        <td id="medicalTotal" style="">₱
                                                            {{ number_format($medicalShareTotal, 2) }}</td>
                                                        <td>₱ {{ number_format($medicalShareTotalPayable, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="">Graduation Fees</td>
                                                        <td id="graduationTotal" style="">₱
                                                            {{ number_format($graduationFeeTotal, 2) }}
                                                        </td>
                                                        <td>₱ {{ number_format($graduationFeeTotalPayable, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="">Personal Cash Advance</td>
                                                        <td id="personalCashTotal" style="">₱
                                                            {{ number_format($personalCashAdvanceTotal, 2) }}</td>
                                                        <td>₱ {{ number_format($personalCashAdvanceTotalPayable, 2) }}</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th style="background-color: #ffff; color: #1f3c88; ">
                                                            Total</th>
                                                        <th style="background-color: #ffff; color: #1f3c88; "
                                                            id="totalFinance">₱
                                                            {{ number_format($total, 2) }}</th>
                                                        <th style="background-color: #ffff; color: #1f3c88; ">₱
                                                            {{ number_format($totalPayable, 2) }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
