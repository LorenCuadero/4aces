@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('One Time Password') }}</div>
                    <div class="card-body">
                        <form id="verify_otp" method="POST" action="{{ route('verify_otp') }}">
                            @csrf
                            <div class="form-group">
                                <p>To enhance your online security, we have sent a one-time password (OTP) to the email
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
                                <button type="submit" class="btn btn-primary">Verify</button>
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
            /* Adjust the width as needed */
        }

        .otp-input {
            width: 100%;
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
