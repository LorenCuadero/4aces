<div class="modal fade" id="edit-student-graduation-fee-modal" tabindex="-1" role="dialog"
    aria-labelledby="edit-student-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-student-modal-label">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="edit-graduation-fee-form" method="POST"
                    action="{{ route('admin.updateGraduationFee', ['id' => 'graduation_fee_id']) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="student_id">
                    <div class="form-group">
                        <label for="amount_due">Amount Due</label>
                        <input type="number" name="amount_due" id="edit_amount_due_gf" class="form-control"
                            step="any">
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">Total Amount Paid</label>
                        <input type="number" name="amount_paid_previous" id="edit_amount_paid_gf" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">Amount Paid</label>
                        <input type="number" name="amount_paid" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" class="form-control" id="edit_date_gf" rows="3"
                            placeholder="" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required />
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="send_amount_due_only" value="1">
                        <label class="form-check-label" for="v">Send amount due only</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="print_acknowledegement_receipt"
                            value="1">
                        <label class="form-check-label" for="print_acknowledegement_receipt">Print acknowledgement
                            receipt</label>
                    </div>
                    <div class="form-group" style="float: right;">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
                @include('assets.asst-loading-spinner')
            </div>
        </div>
    </div>
</div>
