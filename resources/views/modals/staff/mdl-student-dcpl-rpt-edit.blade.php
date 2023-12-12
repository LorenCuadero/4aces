<div class="modal fade" id="edit-student-dcpl-modal" tabindex="-1" role="dialog" aria-labelledby="add-student-modal-label"
    aria-hidden="true">
    <div class="modal-dialog custom-modal-width-on-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-warning-modal-label">Warning for
                    <span class="Input first_name_edit"></span><span class="Input last_name_edit"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-form-dcpl" data-student-url="{{ route('rpt.dcpl.update', ['id' => '__student_id__']) }}"
                method="POST" class="text-left">
                @csrf
                @method('PUT')
                <input type="hidden" name="student_id" id="student_id" value="">
                <div class="modal-body b-gray-color p-2">
                    <div class="p-4 m-1 rounded" style="background-color:rgb(255, 255, 255)">
                        <div class="form-group row">
                            <label for="verbal-warning" class="col-md-4 col-form-label">Formal Verbal Warning:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="date" id="verbal_warning_date"
                                    name="verbal_warning_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="verbal_warning_description" class="col-md-4 col-form-label">Description:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="verbal_warning_description" name="verbal_warning_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="written-warning" class="col-md-4 col-form-label">Written Warning:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="date" id="written_warning_date"
                                    name="written_warning_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="written_warning_description"
                                class="col-md-4 col-form-label">Description:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="written_warning_description" name="written_warning_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="provisionary-warning" class="col-md-4 col-form-label">Probationary
                                Warning:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="date" id="provisionary_date"
                                    name="provisionary_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="provisionary_description" class="col-md-4 col-form-label">Description:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="provisionary_description" name="provisionary_description"></textarea>
                            </div>
                        </div>
                    </div>
                    @include('assets.asst-loading-spinner')
                </div>
                <div class="modal-footer d-flex float-right">
                    <button id="saveEdit" type="button" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
