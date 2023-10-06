<!-- resources/views/otp-verification.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('OTP Verification') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('verify-otp') }}">
                            @csrf
                            <label for="otp">Enter OTP:</label>
                            <input type="text" name="otp" id="otp" required>
                            <button type="submit">Verify OTP</button>
                        </form>                                           
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
