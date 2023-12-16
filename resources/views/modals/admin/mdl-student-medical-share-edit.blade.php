<div class="modal fade" id="edit-student-medical-share-modal" tabindex="-1" role="dialog"
    aria-labelledby="edit-student-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-student-modal-label">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="edit-form-medical" method="POST"
                    action="{{ route('admin.updateMedicalShare', ['id' => $student->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <input type="hidden" name="medical_id" id="medical_id">
                    <div class="form-group">
                        <label for="course_code">Medical Concern <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="medical_concern_ms_edit" name="medical_concern">
                    </div>
                    <div class="form-group">
                        <label for="amount_due">Total Medical Expense <span class="text-danger">*</span></label>
                        <input type="number" name="amount_due" id="amount_due_ms_edit" class="form-control"
                            step="any">
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">15% Share</label>
                        <input type="text" class="form-control" id="percent_share" readonly>
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">Total Amount Paid</label>
                        <input type="number" name="amount_paid_previous" id="amount_paid_ms_edit" class="form-control"
                            step="any">
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">Amount Paid</label>
                        <input type="number" name="amount_paid" class="form-control"
                            step="any">
                    </div>
                    <div class="form-group">
                        <label for="date">Date <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control" id="date_paid_ms_edit" rows="3"
                            placeholder="" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required />
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="send_amount_due_only_medical_edit"
                            name="send_amount_due_only_medical" value="1">
                        <label class="form-check-label" for="v">Send amount due only</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="print_acknowledegement_receipt_medical_edit"
                            name="print_acknowledegement_receipt_medical" value="1">
                        <label class="form-check-label" for="print_acknowledegement_receipt">Print acknowledgement
                            receipt</label>
                    </div>
                    <div class="form-group" style="float: right;">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <a href="#" style="text-decoration: none; color: #fff;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                        </a>
                </form>
                @include('assets.asst-loading-spinner')
            </div>
        </div>
    </div>
</div>
