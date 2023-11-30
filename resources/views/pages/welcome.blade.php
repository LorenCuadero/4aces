@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Integrated Online Management System</div>
                    <div class="card-body">
                        <form id="login-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('Email Address') }}</label>
                                <div class="input-group mb-3">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus>
                                    <div class="input-group-append">
                                        <button type="button" class="btn text-muted border" id=""
                                            inputmode="none">
                                            <span class="far fa-envelope"></span>
                                        </button>
                                    </div>
                                </div>
                                @if (session('email-not-found'))
                                    <p class="mt-1"><span
                                            class="text-danger error-display">{{ session('email-not-found') }}</span></p>
                                @endif
                                @if (session('error-email-required'))
                                    <p class="mt-1"><span
                                            class="text-danger error-display">{{ session('error-email-required') }}</span>
                                    </p>
                                @endif
                                @if (session('error-email-no-found'))
                                    <p class="mt-1"><span
                                            class="text-danger error-display">{{ session('error-email-no-found') }}</span>
                                    </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password">
                                    <div class="input-group-append">
                                        <button type="button" class="btn text-muted border" id="togglePassword"
                                            inputmode="none">
                                            <span class="far fa-eye"></span>
                                        </button>
                                    </div>
                                </div>

                                @if (session('incorrect-password'))
                                    <p class="mt-1"><span
                                            class="text-danger error-display">{{ session('incorrect-password') }}</span>
                                    </p>
                                @endif
                                @if (session('error-email-no-found'))
                                    <p class="mt-1"><span class="text-danger error-display">
                                            {{ session('error-email-no-found') }}
                                        </span>
                                    </p>
                                @endif
                                @if (session('error-password-required'))
                                    <p class="mt-1"><span class="text-danger error-display">
                                            {{ session('error-password-required') }}
                                        </span>
                                    </p>
                                @endif
                                @if (session('error-incorrect-password'))
                                    <p class="mt-1"><span class="text-danger error-display">
                                            {{ session('error-incorrect-password') }}
                                        </span>
                                    </p>
                                @endif
                                @if (session('error-all-required'))
                                    <p class="mt-1"><span class="text-danger error-display">
                                            {{ session('error-all-required') }}
                                        </span>
                                    </p>
                                @endif
                                @if (session('success'))
                                    <p class="mt-1"><span class="text-success error-display">
                                            {{ session('success') }}
                                        </span>
                                    </p>
                                @endif
                            </div>
                            <div class="align-middle">
                                <a href="{{ route('forgot_password') }}" class="mt-3">Forgot Password?</a>
                                <button type="submit" class="btn btn-primary float-right">
                                    Login
                                </button>
                            </div>
                        </form>
                        @include('assets.asst-loading-spinner')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
