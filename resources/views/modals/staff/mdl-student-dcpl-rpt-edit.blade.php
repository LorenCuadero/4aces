<div class="modal fade" id="edit-student-dcpl-modal" tabindex="-1" role="dialog" aria-labelledby="add-student-modal-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-warning-modal-label">Warning for</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body align-middle" style="text-align: left">
              <div class="form-group">
                <div class="row d-flex justify-content-between">
                  <div class="col-md-3">
                    <label for="verbal-warning">Formal Verbal Warning:</label>
                    <br>
                    <input type="date" id="verbal_warning_date" name="verbal_warning_date">
                  </div>
                  <div class="col-md-8">
                    <label for="written-warning">Description:</label>
                    <textarea class="form-control" id="verbal_warning_description" name="verbal_warning_description"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row d-flex justify-content-between">
                  <div class="col-md-3">
                    <label for="written-warning">Written Warning:</label>
                    <br>
                    <input type="date" id="written_warning_date" name="written_warning_date">
                  </div>
                  <div class="col-md-8">
                    <label for="written-warning">Description:</label>
                    <textarea class="form-control" id="written_warning_description" name="written_warning_description"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row d-flex justify-content-between">
                  <div class="col-md-3">
                    <label for="provisionary-warning">Provisionary Warning:</label>
                    <br>
                    <input type="date" id="provisionary_date" name="provisionary_date">
                  </div>
                  <div class="col-md-8">
                    <label for="written-warning">Description:</label>
                    <textarea class="form-control" id="provisionary_description" name="provisionary_description"></textarea>
                  </div>
                </div>
              </div>
            
              <div class="form-group" style="text-align: center; margin-top: 10px; float:right;">
                <button type="button" class="btn btn-success">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
              </div>
            </div>
        </div>
    </div>
</div>
