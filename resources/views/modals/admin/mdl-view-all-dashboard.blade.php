<div class="modal fade" id="dashboard-modal" tabindex="-1" role="dialog" aria-labelledby="dashboard-modal-label"
    aria-hidden="true">
    <div class="modal-dialog custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-selection-modal-label">Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="{{ route('rpt.dcpl.index') }}"><span aria-hidden="true">&times;</span> </a> </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12" id="table">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center align-middle">
                                            <div class="row">
                                                <div class="col-md-6" style="text-align: left">
                                                    <p style="margin-bottom: 0%"><b>Total number of students:</b>
                                                        {{ $totalNumberOfStudents }}</p>
                                                    <p><b>Batch <span id="selected-batch-year"></span> total number of
                                                            students: </b><span id="total-students-per-year"></span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <form class="" action="" method="">
                                                        <input type="hidden" id="batch-year-form"
                                                            data-total-by-year="{{ json_encode($totalStudentsByBatchYear) }}">
                                                        <div class="form-group row d-flex align-items-center">
                                                            <label for="batch_year" class="col-md-5 col-form-label"
                                                                style="text-align: right">Batch Year</label>
                                                            <div class="col-md-7">
                                                                <select class="form-control" name="batch_year"
                                                                    id="batch_year">
                                                                    <option value="">Year</option>
                                                                    @foreach ($batchYears as $batchYear)
                                                                        <option value="{{ $batchYear }}">
                                                                            {{ $batchYear }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>


                                                    {{-- <form class="" action="{{ route('admin.getTotals') }}" method="POST" id="getTotalsForm">
                                                        @csrf <!-- Add CSRF token -->
                                                        <input type="hidden" id="batch-year-form" data-total-by-year="{{ json_encode($totalStudentsByBatchYear) }}">
                                                        <div class="form-group row d-flex align-items-center">
                                                            <label for="batch_year" class="col-md-5 col-form-label" style="text-align: right">Batch Year</label>
                                                            <div class="col-md-7">
                                                                <select class="form-control" name="batch_year" id="batch_year">
                                                                    <option value="">Year</option>
                                                                    @foreach ($batchYears as $batchYear)
                                                                        <option value="{{ $batchYear }}">{{ $batchYear }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form> --}}
                                                    {{-- <form class="" action="{{ route('admin.getTotals') }}"
                                                            method="POST" id="getTotalsForm">
                                                            @csrf <!-- Add CSRF token -->
                                                            <input type="hidden" id="batch-year-form"
                                                                data-total-by-year="{{ json_encode($totalStudentsByBatchYear) }}">
                                                            <input type="hidden" id="batch_year" name="batch_year">
                                                            <!-- Add the 'name' attribute for the hidden input -->
                                                            <div class="form-group row d-flex align-items-center">
                                                                <label for="batch_year" class="col-md-5 col-form-label"
                                                                    style="text-align: right">Batch Year</label>
                                                                <div class="col-md-7">
                                                                    <select class="form-control" name="selected_batch_year"
                                                                        id="selected_batch_year">
                                                                        <!-- Update the 'id' attribute -->
                                                                        <option value="">Year</option>
                                                                        @foreach ($batchYears as $batchYear)
                                                                            <option value="{{ $batchYear }}">
                                                                                {{ $batchYear }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </form> --}}
                                                </div>
                                            </div>
                                            <tbody class="table-body1">
                                                <tr data-key="counterpartPaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Paid
                                                        Counterpart</td>
                                                    <td>{{ $counterpartPaidStudentsCount }}</td>
                                                </tr>
                                                <tr data-key="counterpartUnpaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Unpaid
                                                        Counterpart</td>
                                                    <td>{{ $counterpartUnpaidStudentsCount }}</td>
                                                </tr>
                                                <tr data-key="counterpartNotFullyPaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Not Fully Paid
                                                        Counterpart</td>
                                                    <td>{{ $counterpartNotFullyPaidStudentsCount }}</td>
                                                </tr>
                                                <tr data-key="medicalSharePaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Paid Medical
                                                        Share</td>
                                                    <td>{{ $medicalSharePaidStudentsCount }}</td>
                                                </tr>
                                                <tr data-key="medicalShareUnpaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Unpaid Medical
                                                        Share</td>
                                                    <td>{{ $medicalShareUnpaidStudentsCount }}</td>
                                                </tr>
                                                <tr data-key="medicalShareNotFullyPaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Not Fully
                                                        Medical Share</td>
                                                    <td>{{ $medicalShareNotFullyPaidStudentsCount }}</td>
                                                </tr>
                                                <tr data-key="personalCashAdvancePaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Paid Personal
                                                        Cash Advance</td>
                                                    <td>{{ $personalCashAdvancePaidStudentsCount }}</td>
                                                </tr>
                                                <tr data-key="personalCashAdvanceUnpaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Unpaid
                                                        Personal Cash Advance</td>
                                                    <td>{{ $personalCashAdvanceUnpaidStudentsCount }}</td>
                                                </tr>
                                                <tr data-key="personalCashAdvanceNotFullyPaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Not Fully
                                                        Personal Cash Advance</td>
                                                    <td>{{ $personalCashAdvanceNotFullyPaidStudentsCount }}</td>
                                                </tr>
                                                <tr data-key="graduationFeePaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Paid
                                                        Graduation Fees</td>
                                                    <td>{{ $graduationFeePaidStudentsCount }}</td>
                                                </tr>
                                                <tr data-key="graduationFeeUnpaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Unpaid
                                                        Graduation Fees</td>
                                                    <td>{{ $graduationFeeUnpaidStudentsCount }}</td>
                                                </tr>
                                                <tr data-key="graduationFeeNotFullyPaidStudentsCount">
                                                    <td style="text-align:left">Total No of Students with Not Fully
                                                        Graduation Fees</td>
                                                    <td>{{ $graduationFeeNotFullyPaidStudentsCount }}</td>
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
        </div>
    </div>
</div>
