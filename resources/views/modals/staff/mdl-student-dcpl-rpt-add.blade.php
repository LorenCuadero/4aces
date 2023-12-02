<div class="modal fade" id="add-student-dcpl-modal" tabindex="-1" role="dialog" aria-labelledby="add-student-modal-label"
    aria-hidden="true">
    <div class="modal-dialog custom-modal-width-on-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-selection-modal-label">Warning for
                    <span class="Input first_name"></span><span class="Input last_name"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="#" data-toggle="modal" data-target="#student-selection-modal"><span
                            aria-hidden="true">&times;</span></a>
                </button>
            </div>
            <form id="new-form-dcpl" method="POST" action="{{ route('rpt.dcpl.store') }}" class="text-left">
                @csrf
                <div class="modal-body b-gray-color p-2">
                    <input class="form-control student_id_dcpl_input" type="hidden" name="student_id_dcpl"
                        value="">
                    <div class="p-4 m-1 rounded" style="background-color:rgb(255, 255, 255)">
                        <div class="form-group row">
                            <label for="verbal-warning" class="col-md-4 col-form-label">Formal Verbal Warning:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="date" id="verbal_warning_date_dcpl"
                                    name="verbal_warning_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="verbal_warning_description" class="col-md-4 col-form-label">Description:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="verbal_warning_description_dcpl" name="verbal_warning_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="written-warning" class="col-md-4 col-form-label">Written Warning:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="date" id="written_warning_date_dcpl"
                                    name="written_warning_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="written_warning_description"
                                class="col-md-4 col-form-label">Description:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="written_warning_description_dcpl" name="written_warning_description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="provisionary-warning" class="col-md-4 col-form-label">Probationary
                                Warning:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="date" id="provisionary_date_dcpl"
                                    name="provisionary_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="provisionary_description" class="col-md-4 col-form-label">Description:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="provisionary_description_dcpl" name="provisionary_description"></textarea>
                            </div>
                        </div>
                    </div>
                    @include('assets.asst-loading-spinner')
                </div>
                <div class="modal-footer d-flex float-right">
                    <button type="submit" class="btn btn-primary">Save
                        Records</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
