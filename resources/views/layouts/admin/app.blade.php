<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ config('app.name', 'IOMS') }}</title> --}}
    <title>{{ !empty($header_title) ? $header_title : '' }} IOMS</title>
    <!-- Page Icon -->
    <link rel="icon" type="image/x-icon" href="https://i.ibb.co/rbH9RXt/pn-logo-circle.png">

    <!-- Stylesheets -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/aside.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/staff.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/student.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    <!-- Inline Styles -->
    <style>
        .custom-modal-width-on-modal {
            max-width: 1000px;
            width: 100%;
        }
    </style>

    <!-- Scripts -->
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

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

        <script>
        $(document).ready(function () {
            // Handle click on pushmenu button
            $('.navbar-nav a[data-widget="pushmenu"]').on('click', function () {
                // Toggle the collapse class on the body
                $('body').toggleClass('sidebar-collapse');

                // Optional: Add a check for mobile view and toggle 'sidebar-mini' class
                if ($(window).width() < 768) {
                    $('body').toggleClass('sidebar-mini');
                }
            });
        });

        $(document).ready(function() {
            // Capture the click event on table rows with class "table-row1"
            $(".table-row1").click(function() {
                // Get the data attributes from the clicked row
                var studentId = $(this).find("td:first")
                    .text(); // Assuming the first column contains the student ID
                var route = "{{ route('admin.studentPageCounterpartRecords', ['id' => ':studentId']) }}";

                // Replace ':studentId' in the route with the actual student ID
                route = route.replace(':studentId', studentId);

                // Redirect to the desired route
                window.location.href = route;
            });

            // Handle the click event for the "Add Student" button
            $("#selectToAddStudentCounterpart").click(function() {
                const addModal = $("#student-selection-counterpart-modal");
                addModal.modal('show');
            });
        });

        $(document).ready(function() {
            // Capture the click event on table rows with class "table-row1"
            $(".table-rowGraduation").click(function() {
                // Get the data attributes from the clicked row
                var studentId = $(this).find("td:first")
                    .text(); // Assuming the first column contains the student ID
                var route = "{{ route('admin.studentGraduationFeeRecords', ['id' => ':studentId']) }}";

                // Replace ':studentId' in the route with the actual student ID
                route = route.replace(':studentId', studentId);

                // Redirect to the desired route
                window.location.href = route;
            });
        });

        $(document).ready(function() {
            // Capture the click event on table rows with class "table-row1"
            $(".table-rowMedical").click(function() {
                // Get the data attributes from the clicked row
                var studentId = $(this).find("td:first")
                    .text(); // Assuming the first column contains the student ID
                var route = "{{ route('admin.studentMedicalShareRecords', ['id' => ':studentId']) }}";

                // Replace ':studentId' in the route with the actual student ID
                route = route.replace(':studentId', studentId);

                // Redirect to the desired route
                window.location.href = route;
            });
        });

        $(document).ready(function() {
            $("#selectToAddStudentMedicalShare").click(function() {
                const addModal = $("#student-selection-medical-share-modal");

                addModal.modal("show");
            });
        });

        $(document).ready(function() {
            // Capture the click event on table rows with class "table-row1"
            $(".table-rowPersonal").click(function() {
                // Get the data attributes from the clicked row
                var studentId = $(this).find("td:first")
                    .text(); // Assuming the first column contains the student ID
                var route = "{{ route('admin.studentPersonalCARecords', ['id' => ':studentId']) }}";

                // Replace ':studentId' in the route with the actual student ID
                route = route.replace(':studentId', studentId);

                // Redirect to the desired route
                window.location.href = route;
            });
        });
    </script>

</head>

<body class="hold-transition sidebar-mini layout-fixed" data-page="{{ Route::currentRouteName() }}">
    <div class="wrapper">
        @include('layouts.admin.loading')
        @include('layouts.admin.header')
        @include('layouts.admin.aside')
        @include('modals.mdl-logout-confirmation')
        @include('assets.asst-loading-spinner')
        @include('modals.mdl-change-pass-confirmation')
        <div class="content-wrapper text-center p-3">
            {{-- <span>
                @if (session('success'))
                    <p class="text-left"><span class="text-success success-display ml-2">[ {{ session('success') }} ]</span></p>
                @endif
                @if (session('error'))
                    <p class="text-left"><span class="text-danger error-display ml-2">[ {{ session('error') }} ]</span></p>
                @endif
            </span> --}}
            <span>
                @if (session('success'))
                        <script>
                            toastr.success('{{ session('success') }}');
                        </script>
                    @endif
            <span>
                @if (session('incorrect-password'))
                    <p style="text-align: left;"><span class="text-danger error-display ml-2"
                            style="text-align: left;">[
                            {{ session('incorrect-password') }} ]</span></p>
                @endif
                @if (session('email-not-found'))
                    <p style="text-align: left;"><span class="text-danger error-display ml-2"
                            style="text-align: left;">[ {{ session('email-not-found') }} ]</span></p> @endif
            </span>
            @yield('content')
        </div>
        @include('layouts.admin.footer')
    </div>
</body>

</html>
