@extends('layouts.app')

@section('content')
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
                    <div class="card-header">One Time Password</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('recover-submit') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <p for="">To enhance your online security, we've sent a one-time password (OTP)
                                    to the email
                                    address you provided. Please enter the OTP below for verification.</p>
                                <input type="hidden" id="email_recover" name="email" value="{{ $user_email }}">
                                <div class="otp-container">
                                    <div style="display: flex; overflow: hidden;">
                                        @for ($i = 1; $i <= 6; $i++)
                                            <input type="text" id="otp{{ $i }}" name="otp{{ $i }}"
                                                class="form-control otp-input" placeholder="0" pattern="[0-9]"
                                                inputmode="numeric" required>
                                        @endfor
                                    </div>
                                </div>
                                @if (session('error'))
                                    <p><span class="text-danger error-display">{{ session('error') }}</span></p>
                                @endif
                            </div>
                            <div class="float-right"><button type="submit" class="btn btn-primary">Recover</button>
                                <a href="{{ route('login') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                        @include('assets.asst-loading-spinner')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .otp-container {
            display: flex;
            justify-content: space-between;
            width: 60%;
            /* Adjust the width as needed */
            margin: auto;
        }

        .otp-input {
            width: 4em;
            /* Adjust the width of each input field */
        }
    </style>

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
@endsection
