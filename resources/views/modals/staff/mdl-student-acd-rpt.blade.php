<div class="modal fade" id="student-acd-rpt-modal" tabindex="-1" role="dialog"
    aria-labelledby="student-acd-rpt-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-student-modal-label">Edit Student Grade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="new-form-edit" method="POST"
                    action="{{ route('rpt.acd.updateStudentGradeReport', ['id' => $student->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-id-student-grade" name="academic_id">
                    <div class="form-group" style="text-align: left">
                        <label for="course_code">Course Code</label>
                        <input type="text" class="form-control" id="course_code_edit" name="course_code" required
                            value="" />
                    </div>
                    <div class="form-group text-left">
                        <label for="year_and_sem_edit text-left">Year and Semester</label>
                        <select name="year_and_sem" id="year_and_sem_edit" class="form-control mr-1">
                            <option value="" selected>Select Year and Semester</option>
                            <option value="0">First Semester - 1st Year</option>
                            <option value="1">Second Semester - 1st Year</option>
                            <option value="2">First Semester - 2nd Year</option>
                            <option value="3">Second Semester - 2nd Year</option>
                            <option value="4">First Semester - 3rd Year</option>
                        </select>
                    </div>
                    <div class="form-group" style="text-align: left">
                        <label for="midterm_edit">Midterm Grade</label>
                        <input type="number" class="form-control" id="midterm_edit" name="midterm" min="0"
                            step="0.01" />
                    </div>
                    <div class="form-group" style="text-align: left">
                        <label for="final_edit">Final Grade</label>
                        <input type="number" class="form-control" id="final_edit" name="final" min="0"
                             step="0.01" />
                    </div>
                    <div class="form-group" style="text-align: left; float:right;">
                        <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                        <a href="#"
                            onclick="window.location.href = '{{ route('rpt.acd.getStudentGradeReport', ['id' => $student->id]) }}'; return false;"
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
