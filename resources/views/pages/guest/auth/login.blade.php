@extends('layouts.guest.app')
@section('bodyClass', 'pg-login login-page')
@section('content')
    <div class="main-wrapper col-md-6 col-sm-8">
        <div class="form-icon"><i class="fas fa-user-tie"></i></div>
        <div class="h4 text-white text-center pt-2 sign-in mt-4 position-relative"><span>{{ __('words.SignIn') }}</span></div>
        <form class="pt-3" action="{{ route('login') }}" method="post">
            @csrf
            @if ($errors->has('username'))
                <span class="text-danger">{{ $errors->first('username') }}</span>
            @endif
            <div class="form-group py-2">
                <div class="input-field"> <span class="far fa-user p-2"></span>
                    <input type="text" placeholder="Enter Username" id="username" name="username"
                        @if (isset($_COOKIE['username'])) value="{{ $_COOKIE['username'] }}" @endif
                        value="{{ old('username') }}" required>
                </div>
            </div>
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
            <div class="form-group py-1 pb-2">
                <div class="input-field"> <span class="fas fa-lock p-2"></span> <input type="password"
                        placeholder="Enter Password" id="password" name="password"
                        @if (isset($_COOKIE['password'])) value="{{ $_COOKIE['password'] }}" @endif required>
                    <button type="button" class="btn bg-white text-muted" id="togglePassword" inputmode="none">
                        <span class="far fa-eye"></span>
                    </button>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <div class="custom-control custom-checkbox">
                    <input id="remember" type="checkbox" name="remember" class="custom-control-input">
                    <label for="remember"
                        class="custom-control-label text-sm text-white">{{ __('words.RememberMe') }}</label>
                </div>
            </div> <button type="submit"
                class="btn btn-block text-center my-3 text-white">{{ __('words.LogInBtn') }}</button>
        </form>
    </div>
@endsection
