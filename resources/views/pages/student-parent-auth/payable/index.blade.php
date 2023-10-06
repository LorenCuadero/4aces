@extends('layouts.student.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('words.SignInMessage') }}</h1>
        <h1>Welcome {{ $userName }}</h1>
    </div>
@endsection
