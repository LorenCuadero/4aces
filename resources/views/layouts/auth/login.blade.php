@extends('layouts.app')

    

<body class="hold-transition login-page custom-background">
    <div class="login-box">
    <!-- login-logo -->
    <div class="custom-login card">
        <div class="login custom-login card-header text-center">
        <img src="https://i.ibb.co/rbH9RXt/pn-logo-circle.png" alt="" style="height: 100px; width: auto">
        <div style="padding: 20px">
            <div class="custom-login-h1 h1">Integrated Online<br>Management System</div>
        </div>
        </div>
        <div class="card-body">
            {{-- @include('_message') --}}
        <form id="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    {{-- <label for="email">{{ __('Email Address') }}</label> --}}
                    <div class="input-group mb-3">
                        <input placeholder="EMAIL" id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <button type="button" class="btn text-muted border" id=""
                                inputmode="none">
                                <span class="far fa-envelope" style="color: white"></span>
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
                    {{-- <label for="password">{{ __('Password') }}</label> --}}
                    <div class="input-group">
                        <input placeholder="PASSWORD" id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            autocomplete="current-password">
                        <div class="input-group-append">
                            <button type="button" class="btn text-muted border" id="togglePassword"
                                inputmode="none">
                                <span class="far fa-eye" style="color: white"></span>
                            </button>
                        </div>
                    </div>

                    @if (session('incorrect-password'))
                        <p class="mt-1"><span
                                class="text-danger error-display">{{ session('incorrect-password') }}</span>
                        </p>
                    @endif
                    {{-- @if (session('error-email-no-found'))
                        <p class="mt-1"><span class="text-danger error-display">
                                {{ session('error-email-no-found') }}
                            </span>
                        </p>
                    @endif --}}
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
                    @if (session('success-changed'))
                        <p class="mt-1"><span
                                class="text-success error-display">{{ session('success-changed') }}</span></p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary form-control custom-login-btn">
                        LOGIN
                </button>
                <div class="forgot-password">
                    <a href="{{ route('forgot_password') }}" class="mt-3">Forgot Password?</a>
                </div>
            </form>
            @include('assets.asst-loading-spinner')
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

