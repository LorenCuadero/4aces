<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IOMS') }}</title>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/aside.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/staff.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/student.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    <script defer src="{{ asset('assets/js/compile.js') }}"></script>
    <script defer src="{{ asset('assets/js/components/admin/admin.js') }}"></script>
    <script defer src="{{ asset('assets/js/components/staff/cmpt-staff-table-header.js') }}"></script>
    <script defer src="{{ asset('assets/js/components/student/cmpt-student-reports.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte/plugins/toastr/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte/plugins/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // Handle click on pushmenu button
            $('.navbar-nav a[data-widget="pushmenu"]').on('click', function () {
                // Log a message to the console to check if the click event is triggered
                console.log('Pushmenu button clicked');

                // Toggle the collapse class on the body
                $('body').toggleClass('sidebar-collapse');

                // Optional: Log the classes on the body element to check their state
                console.log('Body classes:', $('body').attr('class'));

                // Optional: Add a check for mobile view and log a message
                if ($(window).width() < 768) {
                    console.log('Mobile view detected');
                    // Toggle 'sidebar-mini' class
                    $('body').toggleClass('sidebar-mini');
                }
            });
        });
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed" data-page="{{ Route::currentRouteName() }}">
    <div class="wrapper">
        @include('layouts.staff.loading')
        @include('layouts.staff.header')
        @include('layouts.staff.aside')
        @include('modals.mdl-logout-confirmation')
        @include('modals.mdl-change-pass-confirmation')
        <div class="content-wrapper text-center p-3">
            <span>
                @if (session('incorrect-password'))
                    <p style="text-align: left;"><span class="text-danger error-display ml-2"
                            style="text-align: left;">[
                            {{ session('incorrect-password') }} ]</span></p>
                @endif
                @if (session('email-not-found'))
                    <p style="text-align: left;"><span class="text-danger error-display ml-2"
                            style="text-align: left;">[ {{ session('email-not-found') }} ]</span></p> @endif
                                            @if (session('success'))
                    <p class="text-left"><span class="text-success success-display ml-2">[ {{ session('success') }} ]</span></p>
                @endif
                @if (session('error'))
                    <p class="text-left"><span class="text-danger error-display ml-2">[ {{ session('error') }} ]</span></p> @endif
            </span>
            @yield('content')
        </div>
        @include('layouts.staff.footer')
    </div>
</body>

</html>
