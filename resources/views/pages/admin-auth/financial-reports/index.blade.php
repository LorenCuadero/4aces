@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between"
                            style="background-color: #ffff; color: #1f3c88">
                            <p class="card-title mb-3 mb-md-0" style="color:#1f3c88; padding-left:0%; font-size: 22px">
                                <b>Financial Reports</b>
                            </p>
                            <div class="d-flex flex-wrap align-items-center ml-auto">
                                <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0"
                                    style="display: flex; align-items: center;" id="date-form" action="{{ route('admin.viewFinancialReportByDateFromAndTo') }}" method="POST">
                                    <div class="nav-item btn btn-sm p-0" style="display: flex; align-items:center;">
                                        <input type="date" class="form-control rounded p-2" id="date-from"
                                            name="date-from">
                                    </div>
                                    <div class="nav-item btn btn-sm p-0 m-3" style="display: flex; align-items:center;">
                                        <p class="mb-0">to</p>
                                    </div>
                                    <div class="nav-item btn btn-sm p-0" style="display: flex; align-items:center;">
                                        <input type="date" id="date-to" class="form-control rounded p-2"
                                            name="date-to">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #ffff; color: #1f3c88">Income</th>
                                            <th style="background-color: #ffff; color: #1f3c88">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <tr>
                                            <td>Parent's Counterpart</td>
                                            <td>{{ $counterpartTotal }}</td>
                                        </tr>
                                        <tr>
                                            <td>Medical Share</td>
                                            <td>{{ $medicalShareTotal }}</td>
                                        </tr>
                                        <tr>
                                            <td>Graduation Fees</td>
                                            <td>{{ $graduationFeeTotal }}</td>
                                        </tr>
                                        <tr>
                                            <td>Personal Cash Advance</td>
                                            <td>{{ $personalCashAdvanceTotal }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="background-color: #ffff; color: #1f3c88">Total Income</th>
                                            <th style="background-color: #ffff; color: #1f3c88">{{ $total }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
