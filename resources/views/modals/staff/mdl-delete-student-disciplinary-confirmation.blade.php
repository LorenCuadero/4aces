<div class="modal fade" id="delete-student-disciplinary-confirmation-modal" tabindex="-1" role="dialog"
    aria-labelledby="delete-counterpart-confirmation-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this student from the record?
            </div>
            <div class="modal-footer">
                <form id="deletion-confirmed-form-student-disciplinary"
                    action="{{ route('rpt.dcpl.destroy', ['id' => 'dcpl_id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="acad_id" name="academic_id">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
        @include('assets.asst-loading-spinner')
    </div>
</div>
