@extends('layouts.admin.app')
@section('content')
    <section class="content     ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between custom-admin-accounts-header"
                            style="background-color: #ffff; color: #1f3c88;">
                            <h3 class="card-title mb-3 mb-md-0"><b>Admin Accounts (Total: {{ $users->total() }})</b></h3>
                            <div class="d-flex flex-wrap align-items-center ml-auto">
                                <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0"
                                    style="display: flex; align-items: center;">
                                    <div class="nav-item btn btn-sm p-0" style="display: flex; align-items:center;">
                                        <a href="{{ route('admin.createAdminAccount') }}"
                                            class="nav-link align-items-center btn p-0"
                                            style="color:#1f3c88; text-decoration: none;">
                                            <i class="fas fa-user-plus" style="font-size: 23px"></i>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <form method="" action="">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="form-group col-md-3 admin-accounts-search-input">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ Request::get('name') }}" placeholder="Search Name"
                                            autocomplete="name">
                                    </div>

                                    <div class="form-group col-md-3 admin-accounts-search-input">
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ Request::get('email') }}" placeholder="Search Email"
                                            autocomplete="on">
                                    </div>

                                    <div class="form-group col-md-3 admin-accounts-search-input">
                                        <input type="date" class="form-control" id="date" name="date"
                                            value="{{ Request::get('date') }}">
                                    </div>

                                    <div class="form-group col-md-1 admin-accounts-search-input">
                                        <select class="form-control" name="entries" id="entries"
                                            onchange="this.form.submit()">
                                            <option value="10" {{ $entriesPerPage == 10 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ $entriesPerPage == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ $entriesPerPage == 50 ? 'selected' : '' }}>50</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2 admin-accounts-search-input">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ route('admin.admin-accounts') }}" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                        <div class="card-body table-responsive p-1" style="font-size: 14px;">
                            <div class="p-0">
                                <table class="table table-hover text-nowrap text-left admin-accounts-table">
                                    <thead style="color:#1f3c88">
                                        <tr>
                                            <th style="display:none;">ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Email Verified At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        use Illuminate\Support\Str;
                                    @endphp
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td style="display:none;">{{ $user->id }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ Str::limit($user->email, 30) }}</td>
                                                <td>{{ $user->department }}</td>
                                                {{-- <td class="truncate">{{ $user->password }}</td> --}}
                                                <td>{{ $user->email_verified_at }}</td>
                                                <td class="admin-accounts-mobile-btn">
                                                    @if ($user->status == 0)
                                                        <strong><span class="text-success"
                                                                style="padding: 5px; font-size: 13px">Active</span></strong>
                                                    @else
                                                        <strong><span class="text-warning"
                                                                style="padding: 5px; font-size: 13px">Inactive</span></strong>
                                                    @endif
                                                </td>
                                                <td class="admin-accounts-mobile-btn">
                                                    <a href="{{ route('admin.getAdminAccount', ['id' => $user->user_id]) }}"
                                                        class="btn btn-sm view-button-counterpart"
                                                        style="color: #1f3c88; border-radius: 20px">
                                                        <strong><i class="fa fa-eye"></i> View</strong></a>

                                                    {{-- <button class="btn btn-sm view-button-counterpart"
                                                        style="background-color: #1f3c88; color: #ffff; width:70%; border-radius: 20px"><i class="far fa-address-card"
                                                            style="font-size: 15px;"></i> View</button> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding:10px; float:right;">
                                    {{-- {!! $users->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                                    {!! $users->appends(['entries' => $entriesPerPage])->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- @include('modals.admin.accounts.mdl-admin-account-edit') --}}

    <script>
        $(document).ready(function() {
            // Handle click event on "Edit" button
            $('.edit-admin-account-button').on('click', function() {
                // Get the data attributes from the clicked button
                var userId = $(this).data('user-id');
                var name = $(this).data('user-name');
                var email = $(this).data('user-email');
                var password = $(this).data('user-password');
                var emailVerifiedAt = $(this).data('user-email-verified-at');
                var otp = $(this).data('user-otp');

                // Populate the modal fields with the data
                $('#edit-admin-account-form input[name="counterpart_id"]').val(userId);
                $('#edit-admin-account-form input[name="admin_first_name"]').val(name);
                $('#edit-admin-account-form input[name="user_email"]').val(email);
                $('#edit-admin-account-form input[name="user_password"]').val(password);
                $('#edit-admin-account-form input[name="admin_email_verified_at"]').val(emailVerifiedAt);
                $('#edit-admin-account-form input[name="user_otp"]').val(otp);

                // Trigger modal opening
                $('#edit-admin-account-modal').modal('show');
            });
        });

        $('.edit-admin-account-button').on('click', function() {
            // Get the data attributes from the clicked button
            var userId = $(this).data('user-id');
            var name = $(this).data('user-name');
            var email = $(this).data('user-email');

            // Populate the modal fields with the data
            $('#edit-admin-account-form input[name="counterpart_id"]').val(userId);
            $('#edit-admin-account-form input[name="admin_first_name"]').val(name);
            $('#edit-admin-account-form input[name="user_email"]').val(email);

            // Trigger modal opening
            $('#edit-admin-account-modal').modal('show');
        });

        // Handle click event on "Edit Password" button
        $('.edit-password-button').on('click', function() {
            var userId = $(this).data('user-id');

            // Populate the password modal with user ID
            $('#edit-password-form input[name="counterpart_id"]').val(userId);

            // Trigger password modal opening
            $('#edit-admin-account-modal').modal('hide');
            setTimeout(() => {
                $('#edit-password-modal').modal('show');
            }, 2000);
        });

        // $('.close-pass').on('click', function() {
        //     $('#edit-password-modal').modal('hide');
        //     setTimeout(() => {
        //         $('#edit-admin-account-modal').modal('show');
        //     });
        // });
    </script>
@endsection
