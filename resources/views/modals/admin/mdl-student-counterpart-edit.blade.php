<div class="modal fade" id="edit-student-counterpart-modal" tabindex="-1" role="dialog"
    aria-labelledby="add-student-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-student-modal-label">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="edit-counterpart-form" method="POST"
                    action="{{ route('admin.updateCounterpart', ['id' => 'counterpart_id']) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="counterpart_id">
                    <div class="form-group">
                        <label for="course_code">Month <span class="text-danger">*</span></label>
                        <input type="text" name="month_display" id="edit-month-display" class="form-control"
                            readonly>
                        <input type="hidden" name="month" id="edit-month-hidden">
                    </div>
                    <div class="form-group">
                        <label for="amount_due">Year <span class="text-danger">*</span></label>
                        <input type="text" id="edit-year" name="year" class="form-control yearDropdown" readonly>
                    </div>
                    <div class="form-group">
                        <label for="amount_due">Amount Due <span class="text-danger">*</span></label>
                        <input type="number" name="amount_due" id="edit-amount_due" class="form-control"
                            step="any">
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">Total Amount Paid</label>
                        <input type="number" name="amount_paid_previously" id="edit-amount_paid" class="form-control"
                            step="any">
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">Amount Paid</label>
                        <input type="number" name="amount_paid" id="edit-amount_paid" class="form-control"
                            step="any">
                    </div>
                    <div class="form-group">
                        <label for="date">Date <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control" id="edit-date" rows="3"
                            placeholder="" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required />
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="send_amount_due_only_edit_counterpart"
                            name="send_amount_due_only_edit_counterpart" value="1">
                        <label class="form-check-label" for="v">Send amount due only</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input"
                            id="print_acknowledegement_receipt_edit_counterpart"
                            name="print_acknowledegement_receipt_edit_counterpart" value="1">
                        <label class="form-check-label" for="print_acknowledegement_receipt">Print acknowledgement
                            receipt</label>
                    </div>
                    <div class="form-group" style="float: right;">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="#"
                            onclick="window.location.href = '{{ route('admin.studentPageCounterpartRecords', ['id' => $student->id]) }}'; return false;"
                            style="text-decoration: none; color: #fff;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                        </a>
                    </div>
                </form>
                @include('assets.asst-loading-spinner')
            </div>
        </div>
    </div>
</div>
