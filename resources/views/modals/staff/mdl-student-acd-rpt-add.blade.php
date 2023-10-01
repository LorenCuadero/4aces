<div class="modal fade" id="add-student-grd-modal" tabindex="-1" role="dialog" aria-labelledby="add-student-modal-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-student-modal-label">Add Student Grade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="new-form" method="POST"
                    action="{{ route('rpt.acd.addStudentGradeReport', ['id' => $student->id]) }}">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <div class="form-group">
                        <label for="course_code">Course Code</label>
                        <input type="text" name="course_code" id="course_code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="first_sem_1st_year">1st Sem - 1st Year Grade</label>
                        <input type="number" name="first_sem_1st_year" id="first_sem_1st_year" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="second_sem_1st_year">2nd Sem - 1st Year Grade</label>
                        <input type="number" name="second_sem_1st_year" id="second_sem_1st_year" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="first_sem_2nd_year">1st Sem - 2nd Year Grade</label>
                        <input type="number" name="first_sem_2nd_year" id="first_sem_2nd_year" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="second_sem_2nd_year">2nd Sem - 2nd Year Grade</label>
                        <input type="number" name="second_sem_2nd_year" id="second_sem_2nd_year" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gpa">GPA</label>
                        <input type="number" name="gpa" id="gpa" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Grade</button>
                </form>
            </div>
        </div>
    </div>
</div>
