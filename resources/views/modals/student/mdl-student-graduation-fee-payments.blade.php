<div class="modal fade" id="student-graduation-fee-payments-modal" tabindex="-1" role="dialog"
    aria-labelledby="student-selection-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document"> <!-- Set a maximum width to avoid too wide modals -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-0" id="student-selection-modal-label">Graduation Fee Payments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="{{ route('admin.counterpartRecords') }}"><span aria-hidden="true">&times;</span></a>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Bootstrap grid structure -->
                    <div class="row d-flex justify-content-center align-items-center">
                        @foreach ($paidGraduationFeeRecords as $record)
                            <div class="col-md-6">
                                <div class="card mb-3 scrollable-content"
                                    style="height: 100px; overflow: auto; font-size: 13px;">
                                    <div class="card-header sticky-top"
                                        style="background-color: rgb(246, 246, 246); color: #1f3c88; height: 50px;">
                                        <p class="mb-0">
                                            <strong>{{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}</strong>
                                        </p>
                                    </div>
                                    <div class="card-body p-2">
                                        <div class="row">
                                            <div class="col-6 text-right">
                                                <p class="mb-1" style="color: #1f3c88;">Amount Paid:</p>
                                            </div>
                                            <div class="col-5 text-left">
                                                <p class="mb-1">₱{{ number_format($record->amount_paid, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
