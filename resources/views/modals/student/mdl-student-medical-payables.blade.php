<div class="modal fade" id="student-medical-payable-modal" tabindex="-1" role="dialog"
    aria-labelledby="student-selection-modal-label" aria-hidden="true">
    <div class="modal-dialog custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-0" id="student-selection-modal-label">Medical Payables</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="{{ route('admin.records.counterpartRecords') }}"><span aria-hidden="true">&times;</span></a>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Bootstrap grid structure -->
                    <div class="row d-flex justify-content-center align-items-center">
                        @if ($unpaidMedicalRecords->isNotEmpty())
                            @foreach ($unpaidMedicalRecords as $record)
                                <div class="col-md-3">
                                    <div class="card mb-3 scrollable-content"
                                        style="height: 200px; overflow: auto; font-size: 13px;">
                                        <div class="card-header sticky-top"
                                            style="background-color:rgb(246, 246, 246); color: #1f3c88; height: 50px;">
                                            <p class="mb-0"><strong>{{ $record->medical_concern }}</strong></p>
                                        </div>
                                        <div class="card-body p-2 text-left">
                                            <div class="row">
                                                <div class="col-7">
                                                    <p class="mb-1" style="color: #1f3c88;">Total Expense:</p>
                                                    <p class="mb-1" style="color: #1f3c88;">15% Total Share:</p>
                                                    <p class="mb-1" style="color: #1f3c88;">Amount Due:</p>
                                                    <p class="mb-1" style="color: #1f3c88;">Date:</p>
                                                </div>
                                                <div class="col-5">
                                                    <p class="mb-1">₱ {{ number_format($record->total_cost, 2) }}</p>
                                                    <p class="mb-1">₱ {{ number_format($record->total_cost * 0.15, 2) }}
                                                    </p>
                                                    <p class="mb-1">₱
                                                        {{ number_format($record->total_cost * 0.15 - $record->amount_paid, 2) }}
                                                    </p>
                                                    <p class="mb-1">
                                                        {{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12 text-center">
                                <div class="card mb-3"
                                    style="background-color: rgb(237, 237, 237); border-radius: 10px; padding: 2%;">
                                    <p style="color: #1f3c88; font-size: 14px;" class="text-center">No records found.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
