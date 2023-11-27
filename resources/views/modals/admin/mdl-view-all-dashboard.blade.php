<div class="modal fade" id="dashboard-modal" tabindex="-1" role="dialog" aria-labelledby="dashboard-modal-label"
    aria-hidden="true" style="padding-right: 0px">
    <div class="modal-dialog custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-selection-modal-label">Summary Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="{{ route('admin.admin-accounts') }}"><span aria-hidden="true">&times;</span> </a> </button>
            </div>
            <div class="modal-body b-gray-color">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12" id="table">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-bordered table-hover text-center">
                                            <div class="row">
                                                <input type="hidden" id="all-student-number"
                                                    value="{{ $totalNumberOfStudents }}">
                                                <div class="col-md-6" style="text-align: left">
                                                    <p class="p-2 mb-0"><b><span
                                                                id="TotalNumberOfAllStudents"></span><span
                                                                id="selected-batch-year"></span></b><span
                                                            id="total-students-per-year"></span></b>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <form id="get_totals_by_batch_year_form" class=""
                                                        action="{{ route('admin.getTotals') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" id="batch-year-form"
                                                            data-total-by-year="{{ json_encode($totalStudentsByBatchYear) }}">
                                                        <div class="form-group row">
                                                            <label for="batch_year" class="col-md-5 col-form-label"
                                                                style="text-align: right">Batch Year:</label>
                                                            <div class="col-md-7">
                                                                <select class="form-control" name="batch_year"
                                                                    id="batch_year">
                                                                    <a id="allBatch"
                                                                        href="{{ route('admin.allBatchTotalCount') }}">
                                                                        <option value="">All
                                                                            Batch Year</option>
                                                                    </a>
                                                                    @foreach ($batchYears as $batchYear)
                                                                        <option name="batch_year"
                                                                            value="{{ $batchYear }}">
                                                                            {{ $batchYear }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span id="printButtonOnModalSpan">
                                                                    <button type="button"
                                                                        class="btn btn-default printButtonOnModal float-right"><i
                                                                            class="fas fa-print"></i>
                                                                        Print</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <tbody class="table-body1" style="font-size: 12px">
                                                <tr>
                                                    <td style="text-align:left">Total No of Students with Fully Paid
                                                        Counterpart</td>
                                                    <td id="counterpartPaidStudentsCount">
                                                        {{ $counterpartPaidStudentsCount }}</td>
                                                    <td style="text-align:left">Total No of Students with Fully Paid
                                                        Personal
                                                        Cash Advance</td>
                                                    <td id="personalCashAdvancePaidStudentsCount">
                                                        {{ $personalCashAdvancePaidStudentsCount }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:left">Total No of Students with Unpaid
                                                        Counterpart</td>
                                                    <td id="counterpartUnpaidStudentsCount">
                                                        {{ $counterpartUnpaidStudentsCount }}</td>
                                                    <td style="text-align:left">Total No of Students with Unpaid
                                                        Personal Cash Advance</td>
                                                    <td id="personalCashAdvanceUnpaidStudentsCount">
                                                        {{ $personalCashAdvanceUnpaidStudentsCount }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:left">Total No of Students with Not Fully Paid
                                                        Counterpart</td>
                                                    <td id="counterpartNotFullyPaidStudentsCount">
                                                        {{ $counterpartNotFullyPaidStudentsCount }}</td>
                                                    <td style="text-align:left">Total No of Students with Not Fully
                                                        Personal Cash Advance</td>
                                                    <td id="personalCashAdvanceNotFullyPaidStudentsCount">
                                                        {{ $personalCashAdvanceNotFullyPaidStudentsCount }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:left">Total No of Students with Fully Paid
                                                        Medical
                                                        Share</td>
                                                    <td id="medicalSharePaidStudentsCount">
                                                        {{ $medicalSharePaidStudentsCount }}</td>
                                                    <td style="text-align:left">Total No of Students with Fully Paid
                                                        Graduation Fees</td>
                                                    <td id="graduationFeePaidStudentsCount">
                                                        {{ $graduationFeePaidStudentsCount }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:left">Total No of Students with Unpaid Medical
                                                        Share</td>
                                                    <td id="medicalShareUnpaidStudentsCount">
                                                        {{ $medicalShareUnpaidStudentsCount }}</td>
                                                    <td style="text-align:left">Total No of Students with Unpaid
                                                        Graduation Fees</td>
                                                    <td id="graduationFeeUnpaidStudentsCount">
                                                        {{ $graduationFeeUnpaidStudentsCount }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:left">Total No of Students with Not Fully
                                                        Medical Share</td>
                                                    <td id="medicalShareNotFullyPaidStudentsCount">
                                                        {{ $medicalShareNotFullyPaidStudentsCount }}</td>
                                                    <td style="text-align:left">Total No of Students with Not Fully
                                                        Graduation Fees</td>
                                                    <td id="graduationFeeNotFullyPaidStudentsCount">
                                                        {{ $graduationFeeNotFullyPaidStudentsCount }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
            @include('assets.asst-loading-spinner')
        </div>
    </div>
</div>
