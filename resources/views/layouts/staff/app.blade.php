<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/compile.css', 'resources/js/compile.js'])
    </head>

<body class="hold-transition sidebar-mini layout-fixed" data-page="{{ Route::currentRouteName() }}">
    <div class="wrapper">
        @include('layouts.staff.loading')
        @include('layouts.staff.header')
        @include('layouts.staff.aside')
        @include('modals.mdl-logout-confirmation')

        <div class="content-wrapper text-center p-3">
            @yield('content')
        </div>
        @include('layouts.staff.footer')
    </div>
</body>

</html>
