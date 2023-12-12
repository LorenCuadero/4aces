@extends('layouts.app')
{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="Passerelles Numeriques Philippines Integration Online Management System." />
    <meta name="robots">

    <title>{{ !empty($header_title) ? $header_title : '' }} IOMS</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/pn-logo-small.png') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
</head> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="Passerelles Numeriques Philippines Integration Online Management System." />
    <meta name="robots">

    <title>{{ !empty($header_title) ? $header_title : '' }} IOMS</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/pn-logo-small.png') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
</head>

<body class="hold-transition login-page custom-background">
    <div class="login-box">
            <div class="custom-login card">
                <div class="login custom-login card-header text-center">
                    <img src="https://i.ibb.co/rbH9RXt/pn-logo-circle.png" alt=""
                        style="height: 100px; width: auto">
                    <div style="padding: 20px">
                        <div class="custom-login-h1 h1">Integrated Online<br>Management System</div>
                    </div>
                </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('confirm-changes') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Reset password</label>
                                <input type="hidden" id="email_recover" name="email" value="{{ $user_email }}">
                                <div class="input-group mb-3">
                                    <div class="input-group">
                                        <input id="password_reset" type="password" class="form-control" name="password"
                                            autocomplete="current-password">
                                        <div class="input-group-append">
                                            <button type="button" class="btn text-muted border"
                                                id="togglePasswordResetOnAuth" inputmode="none">
                                                <span class="far fa-eye" id="eyeIconPasswordResetOnAuth"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <input id="cpassword_reset" type="password" name="cpassword" class="form-control"
                                        autocomplete="current-password">
                                    <div class="input-group-append">
                                        <button type="button" class="btn text-muted border" id="toggleCPasswordResetOnAuth"
                                            inputmode="none">
                                            <span class="far fa-eye" id="eyeIconCPasswordResetOnAuth"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @if (isset($error))
                                <p><span class="text-danger error-display ml-1"> {{ $error }} </span></p>
                            @endif
                            <div class="text-center form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="keep_logged_in"
                                    name="keep_logged_in" value="1">
                                <label class="form-check-label" for="keep_logged_in">Keep me logged in</label>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary" style="width: 30%">Submit</button>
                                <a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-default" style="width: 30%">Cancel</a>
                            </div>

                        </form>
                        @include('assets.asst-loading-spinner')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Password toggle
            $('#togglePasswordResetOnAuth').on('click', function() {
                const passwordInput = $('#password_reset');
                const eyeIcon = $('#eyeIconPasswordResetOnAuth');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    eyeIcon.removeClass('far fa-eye').addClass('far fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    eyeIcon.removeClass('far fa-eye-slash').addClass('far fa-eye');
                }
            });

            // Confirm Password toggle
            $('#toggleCPasswordResetOnAuth').on('click', function() {
                const cPasswordInput = $('#cpassword_reset');
                const eyeIconCPassword = $('#eyeIconCPasswordResetOnAuth');

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
</body>
</html>
