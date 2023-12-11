@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        @include('assets.asst-table-headers-with-add-cp-records')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover data-table text-center"  style="font-size: 14px;">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #ffff; color: #1f3c88">Name</th>
                                            <th style="background-color: #ffff; color: #1f3c88">Batch Year</th>
                                            <th style="background-color: #ffff; color: #1f3c88">Total Amount Due</th>
                                            <th style="background-color: #ffff; color: #1f3c88">Total Amount Paid</th>
                                            <th style="background-color: #ffff; color: #1f3c88">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body"  style="font-size: 14px;">
                                        @forelse ($students_counterpart_records as $student)
                                            <tr>
                                                <td>
                                                    <input type="hidden" id="stud_id_{{ $student->id }}" name="stud_id"
                                                        value="{{ $student->id }}">
                                                    {{ ' ' . $student->last_name }},
                                                    {{ $student->first_name }}

                                                    @if ($student->middle_name && $student->middle_name != 'N/A')
                                                        {{ ' ' . $student->middle_name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $student->batch_year }}
                                                </td>
                                                <td>₱
                                                    @if (isset($totalAmounts[$student->id]))
                                                        {{ number_format($totalAmounts[$student->id]['amount_due'], 2) }}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>₱
                                                    @if (isset($totalAmounts[$student->id]))
                                                        {{ number_format($totalAmounts[$student->id]['amount_paid'], 2) }}
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
                                                <td>
                                                    <button class="btn btn-sm view-button-counterpart"
                                                        style="color: #1f3c88; width:80%; border-radius: 20px"
                                                        data-student-id="{{ $student->id }}"> <strong><i class="fa fa-eye"></i> View</strong></button>
                                                </td>
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
    @include('modals.admin.mdl-student-counterpart-view')
    @include('modals.admin.mdl-student-selection')
@endsection
