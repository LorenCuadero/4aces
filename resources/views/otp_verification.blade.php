@extends('layouts.app')

@include('assets.asst-loading-spinner')

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
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* For Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="custom-login card">
            <div class="login custom-login card-header text-center">
                <img src="https://i.ibb.co/rbH9RXt/pn-logo-circle.png" alt=""
                    style="height: 100px; width: auto">
                <div style="padding: 20px">
                    <div class="custom-login-h1 h1">Integrated Online<br>Management System</div>
                </div>
            </div>
            <div class="card-body">
                <form id="verify_otp" method="POST" action="{{ route('verify_otp') }}">
                    @csrf
                    <div class="form-group">
                        <p style="text-align: center">To enhance your online security, we have sent a one-time password
                            (OTP) to the email
                            address you provided. Please enter the OTP below for verification.</p>
                        <input type="hidden" id="email" name="email" value="{{ $user_email }}">

                        <div class="otp-container row justify-content-center">
                            <!-- Use individual input fields for each digit of the OTP -->
                            @for ($i = 1; $i <= 6; $i++)
                                <div class="col-2">
                                    <input type="number" id="otp{{ $i }}" name="otp{{ $i }}"
                                        class="form-control otp-input" placeholder="0" min="0" max="9"
                                        maxlength="1" required>
                                </div>
                            @endfor
                        </div>

                        @if ($errors->any())
                            <p><span class="text-danger error-display"> {{ $errors->first() }}</span></p>
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
                        <button type="submit" class="btn btn-primary" style="width: 30%">Verify</button>
                        <a href="{{ route('login') }}" class="btn btn-default" style="width: 30%">Cancel</a>
                    </div>
                </form>
                @include('assets.asst-loading-spinner')
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const otpInputs = document.querySelectorAll('.otp-input');

            otpInputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    const inputValue = e.target.value;

                    if (inputValue.length === 1 && index < otpInputs.length - 1) {
                        // Move focus to the next input
                        otpInputs[index + 1].focus();
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && inputValue.length === 0 && index > 0) {
                        // Move focus to the previous input on backspace
                        otpInputs[index - 1].focus();
                    }
                });
            });

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
                    xhr.open('POST', '/resend-otp', true);
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
