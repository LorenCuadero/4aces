@extends('layouts.app')

{{-- @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <span>
                    @if (session('success'))
                        <p><span class="text-success success-display ml-2">[ {{ session('success') }} ]</span></p>
                    @endif
                    @if (session('error'))
                        <p><span class="text-danger error-display ml-2">[ {{ session('error') }} ]</span></p>
                    @endif
                </span>
                <div class="card">
                    <div class="card-header">One Time Password</div> --}}
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
        <!-- login-logo -->
        <div class="custom-login card">
            <div class="login custom-login card-header text-center">
                <img src="https://i.ibb.co/rbH9RXt/pn-logo-circle.png" alt=""
                    style="height: 100px; width: auto">
                <div style="padding: 20px">
                    <div class="custom-login-h1 h1">Integrated Online<br>Management System</div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('recover-submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <p style="text-align: center" for="">To enhance your online security, we've sent a one-time password (OTP)
                            to the email
                            address you provided. Please enter the OTP below for verification.</p>
                        <input type="hidden" id="email_recover" name="email" value="{{ $user_email }}">
                        <div class="otp-container">
                            <div style="display: flex; overflow: hidden;">
                                {{-- @for ($i = 1; $i <= 6; $i++)
                                    <input type="text" id="otp{{ $i }}" name="otp{{ $i }}"
                                        class="form-control otp-input" placeholder="0" pattern="[0-9]"
                                        inputmode="numeric" required>
                                @endfor --}}
                                <input type="number" id="otp" name="otp" class="form-control otp-input" placeholder="000000"
                                min="0" maxlength="6" pattern="{6}" title="Please enter a 6-digit OTP" required style="text-align: center">
                            </div>
                        </div>
                        @if (session('error'))
                            <p><span class="text-danger error-display">{{ session('error') }}</span></p>
                        @endif
                        @if (session('error-otp-required'))
                            <p><span class="text-danger error-display">{{ session('error-otp-required') }}</span></p>
                        @endif
                        <br>
                        <p class="text-center" id="otp-message">Did not received OTP?
                            <a id="resend_otp_link" href="#" data-email="{{ $user_email }}"
                                style="width: 30%; text-decoration:none; color:rgb(249, 252, 255)"><strong>Resend
                                    OTP</strong></a>
                        </p>
                        <p class="text-center" id="otp-message"></p>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary" style="width: 30%">Recover</button>
                        <a href="{{ route('login') }}" class="btn btn-default" style="width: 30%">Cancel</a>
                    </div>
                </form>
                @include('assets.asst-loading-spinner')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const loadingOverlay = document.querySelector(".loading-spinner-overlay");
            let successNotificationShown = false; // Flag to track whether the success notification has been shown

            // Function to show the loading spinner
            function showLoadingSpinner() {
                loadingOverlay.style.display = "block";
                document.body.style.overflow = "hidden";
            }

            // Function to hide the loading spinner
            function hideLoadingSpinner() {
                loadingOverlay.style.display = "none";
                document.body.style.overflow = "auto";
            }

            const resendLink = document.getElementById('resend_otp_link');

            if (resendLink) {
                resendLink.addEventListener('click', function(e) {
                    e.preventDefault();

                    var email = this.getAttribute('data-email');

                    showLoadingSpinner();
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '/resend-recover-otp', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                hideLoadingSpinner();
                                document.getElementById('otp-message').textContent =
                                    'OTP has been resent to your email.';
                            } else {
                                console.error('Error:', xhr.statusText);
                            }
                        }
                    };
                    xhr.send('email=' + encodeURIComponent(email) + '&_token={{ csrf_token() }}');
                });
            }
        });
    </script>
</body>
{{-- @endsection --}}
</html>
