@extends('layouts.admin.app')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3 pt-4 pb-4" style="background-color: #ffff; color: #1f3c88;">
                            <h1 class="card-title"><b>Admin Accounts</b></h1>
                            <div class="card-tools">
                                <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0">
                                    <div class="nav-item btn btn-sm"
                                        style="display: flex; align-items:center; height: 38px; background-color: #1f3c88; color:#fff;"
                                        data-target="add-student-grd-modal" data-toggle="modal">
                                        <a class="nav-link align-items-center"
                                            href="{{ route('admin.createAdminAccount') }}"
                                            style="text-decoration: none; color:#fff">Add</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <div class="p-2">
                                <table class="table table-hover text-nowrap data-table text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Email Verified At</th>
                                            <th>OTP</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td class="truncate">{{ $user->password }}</td>
                                                <td>{{ $user->email_verified_at }}</td>
                                                <td>{{ $user->otp }}</td>
                                                <td>
                                                    @if ($user->otp != null)
                                                        <span class="btn badge-success rounded">Active</span>
                                                    @else
                                                        <span class="btn badge-warning rounded">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary edit-admin-account-button"
                                                        data-user-id="{{ $user->id }}"
                                                        data-user-name="{{ $user->name }}"
                                                        data-user-email="{{ $user->email }}"
                                                        data-user-password="{{ $user->password }}"
                                                        data-user-email-verified-at="{{ $user->email_verified_at }}"
                                                        data-user-otp="{{ $user->otp }}">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('modals.admin.accounts.mdl-admin-account-edit')

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
