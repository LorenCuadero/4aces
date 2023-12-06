@extends('layouts.app')
{{-- @section('content') --}}
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Please enter valid email address:</div>
                    <div class="card-body">
                        <form id="recover-send-email-form" action="{{ route('recover') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email" name="email"
                                    autocomplete="email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    @if (session('email-not-found'))
                                        <p><span class="text-danger ml-1"
                                                style="text-align: left;">{{ session('email-not-found') }} </span>
                                        </p>
                                    @endif
                                    @if (session('error-email-required'))
                                        <p><span class="text-danger ml-1"
                                                style="text-align: left;">{{ session('error-email-required') }} </span>
                                        </p>
                                    @endif
                                </div>
                                <!-- <div class="col-md-3 text-right">
                                </div> -->
                                <div class="col-md-2 d-flex" style="display: flex;">
                                    <button type="submit" class="btn btn-primary mr-3">Recover</button>
                                    <a href="{{ route('login') }}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                        @include('assets.asst-loading-spinner')
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

        <body class="hold-transition login-page custom-background">
            <div class="login-box">
            <!-- /.login-logo -->
            <div class="custom-login card">
                <div class="login custom-login card-header text-center">
                <img src="https://i.ibb.co/rbH9RXt/pn-logo-circle.png" alt="" style="height: 100px; width: auto">
                <div style="padding: 20px">
                    <div class="custom-login-h1 h1">Integrated Online<br>Mangement System</div>
                </div>
                </div>
                <div class="card-body">
                {{-- <p class="login-box-msg">Sign in to start your session</p> --}}
                    {{-- @include('_message') --}}
                <form id="recover-send-email-form" action="{{ route('recover') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email" name="email"
                                    autocomplete="email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    @if (session('email-not-found'))
                                        <p><span class="text-danger ml-1"
                                                style="text-align: left;">{{ session('email-not-found') }} </span>
                                        </p>
                                    @endif
                                    @if (session('error-email-required'))
                                        <p><span class="text-danger ml-1"
                                                style="text-align: left;">{{ session('error-email-required') }} </span>
                                        </p>
                                    @endif
                                </div>
                                <!-- <div class="col-md-3 text-right">
                                </div> -->
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary" style="width: 30%">Recover</button>
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

    </body>
{{-- @endsection --}}
