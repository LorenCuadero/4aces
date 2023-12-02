<div class="modal fade" id="edit-admin-account-modal" tabindex="-1" role="dialog"
    aria-labelledby="edit-admin-account-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-admin-account-modal-label">Edit Admin Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="edit-admin-account-form" method="POST"
                    action="{{ route('admin.updateAdminAccount', ['id' => 'user_id']) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="counterpart_id">

                    <div class="row">
                        <!-- Admin Information - First Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_first_name">First Name</label>
                                <input type="text" name="admin_first_name" id="edit-admin-first-name"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="admin_middle_name">Middle Name</label>
                                <input type="text" name="admin_middle_name" id="edit-admin-middle-name"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="admin_last_name">Last Name</label>
                                <input type="text" name="admin_last_name" id="edit-admin-last-name"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="admin_department">Department</label>
                                <input type="text" name="admin_department" id="edit-admin-department"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="admin_contact_number">Contact number</label>
                                <input type="text" name="admin_contact_number" id="edit-admin-contact-number"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="admin_gender">Gender</label>
                                <select name="admin_gender" id="edit-admin-gender" class="form-control" required>
                                    <option value="female">Female</option>
                                    <option value="male">Male</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        </div>

                        <!-- User Information - Second Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_address">Address</label>
                                <input type="text" name="admin_address" id="edit-admin-address" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="admin_civil_status">Civil Status</label>
                                <input type="text" name="admin_civil_status" id="edit-admin-civil-status"
                                    class="form-control" required>
                            </div>

                            <!-- User Information -->
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" name="user_email" id="edit-user-email" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label><br>
                                <button type="button" class="btn btn-primary edit-password-button" data-toggle="modal"
                                    data-target="#edit-password-modal" data-user-id="{{ $user->id }}">
                                    Edit Password
                                </button>
                            </div>
                            <div class="form-group">
                                <label for="user_otp">OTP</label>
                                <input type="text" name="user_otp" id="edit-user-otp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="user_role">Role</label>
                                <input type="text" name="user_role" id="edit-user-role" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <!-- Form Buttons -->
                    <div class="form-group" style="float: right;">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                    </div>
                </form>
                @include('assets.asst-loading-spinner')
            </div>
        </div>
    </div>
</div>

<!-- Add this to your modal -->
<div class="modal fade" id="edit-password-modal" tabindex="-1" role="dialog"
    aria-labelledby="edit-password-modal-label" aria-hidden="true">
    <div class="modal-dialog w-100" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-password-modal-label">Edit Password</h5>
                <button type="button" class="close close-pass" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="edit-password-form" method="POST" action="#">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="counterpart_id">
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="edit-new-password" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_new_password">Confirm New Password</label>
                        <input type="password" name="confirm_new_password" id="edit-confirm-new-password"
                            class="form-control" required>
                    </div>
                    <div class="form-group" style="float: right;">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
