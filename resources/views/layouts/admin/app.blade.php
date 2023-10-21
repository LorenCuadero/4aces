<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @if (View::hasSection('has-vue'))
        <script>
            window.defaultLocale = "{{ config('app.locale') }}";
            window.fallbackLocale = "{{ config('app.fallback_locale') }}";
            window.languageResourceVersion = "{{ rspr::vers('app/public/lang/language-resource.json', true, true) }}";
        </script>
        <script src="{{ rspr::vers('js/vue-component.js') }}"></script>
    @endif

    @vite(['resources/css/compile.css', 'resources/js/compile.js'])
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed" data-page="{{ Route::currentRouteName() }}">
    <div class="wrapper">
        @include('layouts.admin.loading')
        @include('layouts.admin.header')
        @include('layouts.admin.aside')
        @include('modals.mdl-logout-confirmation')

        <div class="content-wrapper text-center p-3">
            @yield('content')
        </div>
        @include('layouts.admin.footer')
    </div>
    @stack('js')
</body>

</html>
