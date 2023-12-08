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
    <link rel="icon" type="image/x-icon" href="{{ asset('images/pn-logo-small.png')}}">
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
                <img src="https://i.ibb.co/rbH9RXt/pn-logo-circle.png" alt="" style="height: 100px; width: auto">
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
        });
    </script>
