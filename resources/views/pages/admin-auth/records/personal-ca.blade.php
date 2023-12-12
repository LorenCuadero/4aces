@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        @include('assets.asst-table-headers-with-add-pca-records')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-hover data-table text-center"  style="font-size: 14px;">
                                    <thead style="background-color: #ffff; color: #1f3c88">
                                        <tr>
                                            <th>Name</th>
                                            <th>Batch Year</th>
                                            <th>Total Amount Due</th>
                                            <th>Total Amount Paid</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body"  style="font-size: 14px;">
                                        @forelse ($student_pca_records as $student)
                                            <tr>
                                                <td class="align-middle">
                                                    {{ ' ' . $student->last_name }},
                                                    {{ $student->first_name }}
                                                    @if ($student->middle_name && $student->middle_name != 'N/A')
                                                        {{ ' ' . $student->middle_name }}
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    {{ $student->batch_year }}
                                                </td>
                                                <td class="align-middle">₱
                                                    @if (isset($totalAmounts[$student->id]))
                                                        {{ number_format($totalAmounts[$student->id]['amount_due'], 2) }}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td class="align-middle">₱
                                                    @if (isset($totalAmounts[$student->id]))
                                                        {{ number_format($totalAmounts[$student->id]['amount_paid'], 2) }}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td class="align-middle">
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
                                                <td class="align-middle">
                                                    <button class="btn btn-sm view-button-personal-ca"
                                                        style="color: #1f3c88; width:70%; border-radius: 20px"
                                                        data-student-id="{{ $student->id }}"> <strong><i class="fa fa-eye"></i> View</strong></button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="align-middle"></td>
                                                <td class="align-middle"></td>
                                                <td class="align-middle"></td>
                                                <td class="align-middle"></td>
                                                <td class="align-middle"></td>
                                                <td class="align-middle"></td>
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
    @include('modals.admin.mdl-student-selection-for-personal-ca')
@endsection
