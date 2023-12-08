<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'IOMS') }}</title> --}}
    <title>{{ !empty($header_title) ? $header_title : '' }} IOMS</title>
    <link rel="icon" type="image/x-icon" href="https://i.ibb.co/rbH9RXt/pn-logo-circle.png" loading="lazy">
    <meta name="description" content="Passerelles Numeriques Philippines Integration Online Management System." />
    <link rel="canonical" href="https://pnphioms.online/login" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins">

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte/plugins/toastr/toastr.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('../public/imports/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../public/imports/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../public/imports/toastr.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/aside.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/staff.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/student.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script defer src="{{ asset('assets/js/compile.js') }}" defer></script>
    <script defer src="{{ asset('assets/js/components/admin/admin.js') }}" defer></script>
    <script defer src="{{ asset('assets/js/components/staff/cmpt-staff-table-header.js') }}" defer></script>
    <script defer src="{{ asset('assets/js/components/student/cmpt-student-reports.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte/dist/css/adminlte.min.css" defer>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js" defer>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte/plugins/toastr/toastr.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/js/all.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte/plugins/chart.js/Chart.min.js" defer></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
</head>


<body>
    <div id="app">
        @include('assets.asst-loading-spinner')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
