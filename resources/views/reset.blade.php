@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Integrated Online Management System</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user-submit-reset') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Reset password</label>
                                <input type="hidden" id="email_recover" name="email" value="{{ $user_email }}">
                                <div class="input-group mb-3">
                                    <div class="input-group">
                                        <input id="password_reset" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            autocomplete="current-password">
                                        <div class="input-group-append">
                                            <button type="button" class="btn text-muted border" id="togglePasswordReset"
                                                inputmode="none">
                                                <span class="far fa-eye" id="eyeIconPasswordReset"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <input id="cpassword_reset" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="cpassword"
                                        autocomplete="current-password">
                                    <div class="input-group-append">
                                        <button type="button" class="btn text-muted border" id="toggleCPasswordReset"
                                            inputmode="none">
                                            <span class="far fa-eye" id="eyeIconCPasswordReset"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @if (isset($error))
                                <p><span class="text-danger error-display ml-1"> {{ $error }} </span></p>
                            @endif
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('login') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                        @include('assets.asst-loading-spinner')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Password toggle
            $('#togglePasswordReset').on('click', function() {
                const passwordInput = $('#password_reset');
                const eyeIcon = $('#eyeIconPasswordReset');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    eyeIcon.removeClass('far fa-eye').addClass('far fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    eyeIcon.removeClass('far fa-eye-slash').addClass('far fa-eye');
                }
            });

            // Confirm Password toggle
            $('#toggleCPasswordReset').on('click', function() {
                const cPasswordInput = $('#cpassword_reset');
                const eyeIconCPassword = $('#eyeIconCPasswordReset');

                if (cPasswordInput.attr('type') === 'password') {
                    cPasswordInput.attr('type', 'text');
                    eyeIconCPassword.removeClass('far fa-eye').addClass('far fa-eye-slash');
                } else {
                    cPasswordInput.attr('type', 'password');
                    eyeIconCPassword.removeClass('far fa-eye-slash').addClass('far fa-eye');
                }
            });
        });
    </script>
@endsection
