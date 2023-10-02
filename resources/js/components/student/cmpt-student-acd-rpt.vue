<template>
    <div class="modal fade" id="student-acd-rpt-modal" tabindex="-1" role="dialog"
        aria-labelledby="student-acd-rpt-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88;"><b>Student Information</b></h1>
                    <br>
                    <div class="card">
                        <div class="card-body" style="background-color: none; border: none;">
                            <form id="edit-form" enctype="multipart/form-data" method="POST" action="">
                                <input type="hidden" id="id" name="id" />
                                <div class="row" style="text-align: left;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                value="" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="middle_name">Middle Name</label>
                                            <input type="text" class="form-control" id="middle_name" name="middle_name"
                                                value="" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value=""
                                                required />
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email" value=""
                                                required />
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Contact Number</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value=""
                                                required />
                                        </div>
                                        <div class="form-group">
                                            <label for="birthdate">Birthdate</label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate" value=""
                                                required />
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea name="address" class="form-control" id="address" rows="3"
                                                required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group" style="float: right;">
                                        <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                                        <a href="{{ route('students-info.index') }}"
                                            onclick="window.location.href = '{{ route('students.index') }}'; return false;"
                                            style="text-decoration: none; color: #fff;">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Back
                                            </button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
