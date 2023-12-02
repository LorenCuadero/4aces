@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        @include('assets.asst-table-headers-with-add-ms-records')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover data-table text-center">
                                    <thead style="background-color: #ffff; color: #1f3c88">
                                        <tr>
                                            <th>Name</th>
                                            <th>Batch Year</th>
                                            <th>Total Share Due</th>
                                            <th>Total Share Paid</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        @forelse ($student_ms_records as $student)
                                            <tr>
                                                <td>
                                                    {{ $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name }}
                                                </td>
                                                <td>
                                                    {{ $student->batch_year }}
                                                </td>
                                                <td>
                                                    @if (isset($totalAmounts[$student->id]))
                                                        {{ $totalAmounts[$student->id]['amount_due'] }}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($totalAmounts[$student->id]))
                                                        {{ $totalAmounts[$student->id]['amount_paid'] }}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $totalDue = isset($totalAmounts[$student->id]) ? $totalAmounts[$student->id]['amount_due'] : 0;
                                                        $totalPaid = isset($totalAmounts[$student->id]) ? $totalAmounts[$student->id]['amount_paid'] : 0;

                                                        if ($totalPaid == 0) {
                                                            $status = 'Unpaid';
                                                        } elseif ($totalPaid < $totalDue) {
                                                            $status = 'Not Fully Paid';
                                                        } else {
                                                            $status = 'Fully Paid';
                                                        }
                                                    @endphp
                                                    {{ $status }}
                                                </td>
                                                <td><button class="btn btn-sm view-button-medical"
                                                        style="background-color: #1f3c88; color: #ffff; width:70%; border-radius: 20px"
                                                        data-student-id="{{ $student->id }}"><i class="far fa-address-card"
                                                            style="font-size: 15px;"></i> View</button></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('modals.admin.mdl-student-selection-for-medical')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
    </script>
@endsection
