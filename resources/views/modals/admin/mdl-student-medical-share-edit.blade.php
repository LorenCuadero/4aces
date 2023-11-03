<div class="modal fade" id="edit-student-medical-share-modal" tabindex="-1" role="dialog"
    aria-labelledby="edit-student-medical-share-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-student-modal-label">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: left">
                {{-- <form id="edit-counterpart-form" method="POST"
                action="{{ route('admin.updateCounterpart', ['id' => 'counterpart_id']) }}">
                @csrf
                    @method('PUT')
                    <input type="hidden" name="counterpart_id">
                    <div class="form-group">
                        <label for="course_code">Month</label>
                        <select name="month" id="edit-month" class="form-control" readonly>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount_due">Year</label>
                        <select id="edit-year" name="year" class="form-control yearDropdown" readonly></select>
                    </div>
                    <div class="form-group">
                        <label for="amount_due">Amount Due</label>
                        <input type="number" name="amount_due" id="edit-amount_due" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">Amount Paid</label>
                        <input type="number" name="amount_paid" id="edit-amount_paid" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" class="form-control" id="edit-date" rows="3"
                            placeholder="" required />
                    </div>
                    <div class="form-group" style="float: right;">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="#"
                            onclick="window.location.href = '{{ route('rpt.acd.getStudentGradeReport', ['id' => $student->id]) }}'; return false;"
                            style="text-decoration: none; color: #fff;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                        </a>
                    </div>
                </form> --}}
                @include('assets.asst-loading-spinner')
            </div>
        </div>
    </div>
</div>