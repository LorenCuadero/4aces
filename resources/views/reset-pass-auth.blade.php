@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Integrated Online Management System</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('confirm-changes') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Reset password</label>
                                <input type="hidden" id="email_recover" name="email" value="{{ $user_email }}">
                                <div class="input-group mb-3">
                                    <div class="input-group">
                                        <input id="password_reset" type="password" class="form-control" name="password"
                                            autocomplete="current-password">
                                        <div class="input-group-append">
                                            <button type="button" class="btn text-muted border" id="togglePasswordReset"
                                                inputmode="none">
                                                <span class="far fa-eye" id="eyeIconPasswordReset"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <input id="cpassword_reset" type="password" name="cpassword" class="form-control"
                                        autocomplete="current-password">
                                    <div class="input-group-append">
                                        <button type="button" class="btn text-muted border" id="toggleCPasswordReset"
                                            inputmode="none">
                                            <span class="far fa-eye" id="eyeIconCPasswordReset"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @if (isset($error))
                                <p><span class="text-danger error-display ml-1"> {{ $error }} </span></p>
                            @endif
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="javascript:void(0);" onclick="window.history.back();"
                                    class="btn btn-default float-right">Cancel</a>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="keep_logged_in" name="keep_logged_in"
                                    value="1">
                                <label class="form-check-label" for="keep_logged_in">Keep me logged in</label>
                            </div>
                        </form>
                        @include('assets.asst-loading-spinner')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
