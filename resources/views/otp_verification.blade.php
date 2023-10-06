@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('One Time Password') }}</div>
                    @if (session('activated'))
                        <div class="alert alert-success" role="alert">
                            {{ session('activated') }}
                        </div>
                    @endif
                    @if (session('incorrect'))
                        <div class="alert alert-error" role="alert">
                            {{ session('incorrect') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form id="form_otp" method="POST" action="{{ route('verify_otp') }}">
                            @csrf
                            <div class="form-group">
                                <label for="">Enter OTP</label>
                                <input type="hidden" id="email" name="email" value="{{ $user->email }}">
                                <input type="number" id="otp" name="otp" class="form-control"
                                    placeholder="Enter token here">
                            </div>
                            <button type="submit" class="btn bt-primary">Submit</button>
                        </form>
                        @include('assets.asst-loading-spinner')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
