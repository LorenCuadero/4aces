<div class="modal fade" id="delete-student-confirmation-modal" tabindex="-1" role="dialog"
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
                <form id="deletion-confirmed-form-student"
                    action="{{ route('students-info.deletestudent', ['id' => 'student_id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
        @include('assets.asst-loading-spinner')
    </div>
</div>
