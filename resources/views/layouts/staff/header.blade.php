<nav class="main-header navbar navbar-expand navbar-light" style="border: none; border-radius: 5px">
    <ul class="navbar-nav" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
        <li class="nav-item dropdown user-menu" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="https://thumbs.dreamstime.com/b/icon-profile-circle-not-shadow-color-dark-blue-icon-profile-circle-not-shadow-color-dark-blue-background-194699290.jpg"
                    class="user-image img-circle elevation-2" alt="User Image">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
                    <img src="https://uploads-ssl.webflow.com/618858d8887e82559e959825/6219fed92de7e6b72f4db7af_profile%20pic.jpg"
                        class="img-circle elevation-2" alt="User Image" style="margin-top: 5%"><br>
                    <p class="text-center" style="font-size: 12px">
                        {{ \Auth::user()->name }}
                        <br>
                        <span class="email">
                            <span>{{ \Auth::user()->email }}</span>
                        </span>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer text-center" style="border-radius: 5px; display: inline-block; width: 100%;">
                    {{-- <div class="mb-2">
                        <a href="#" class="btn btn-default btn-flat" style="border-radius: 5px; width: 100%;"
                            data-toggle="modal" data-target="#settingsModal"><i class="fa-solid fa-gear"></i>
                            Settings</a>
                    </div> --}}
                    <div class="mb-2">
                        <a href="#" class="btn btn-default btn-flat change-pass"
                            style="border-radius: 5px; width: 100%;"><i class="fa-solid fa-lock"></i> Change
                            Password</a>
                    </div>
                    <div>
                        <a href="#" class="btn btn-default btn-flat logout-link"
                            style="border-radius: 5px; width: 100%;"><i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<!-- Settings -->
{{-- <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settingsModalLabel">Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="studentDetailsForm" action="{{ route('staff.updateReceiveOTP') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body"> --}}
                    {{-- <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Edit Information</h1>
                    </div>

                    <div class="form-group">
                        <label for="parentName">Parent's Name</label>
                        <input type="text" id="parentName" name="parentName" class="form-control"
                            value="{{ Auth::user()->student->parent_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="parentContact">Parent's Contact</label>
                        <input type="number" id="parentContact" name="parentContact" class="form-control"
                            value="{{ Auth::user()->student->parent_contact }}" required>
                    </div> --}}

                    {{-- <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">OTP Settings</h1>
                    </div>
                    <label for="receiveOTP">Receive OTP every login?</label>
                    <select id="receiveOTP" name="receiveOTP" class="form-control">
                        <option value="1" {{ Auth::user()->receive_otp ? 'selected' : '' }}>Allow</option>
                        <option value="0" {{ !Auth::user()->receive_otp ? 'selected' : '' }}>Disallow</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveSettingsBtn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}
