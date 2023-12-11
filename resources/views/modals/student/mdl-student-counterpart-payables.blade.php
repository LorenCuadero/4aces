<div class="modal fade" id="student-counterpart-payable-modal" tabindex="-1" role="dialog"
    aria-labelledby="student-selection-modal-label" aria-hidden="true">
    <div class="modal-dialog custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-0" id="student-selection-modal-label">Counterpart Payables</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Bootstrap grid structure -->
                    <div class="row">
                        @for ($month = 1; $month <= 12; $month++)
                            <div class="col-md-3">
                                <div class="card mb-3 scrollable-content"
                                    style="height: 200px; overflow: auto; font-size: 13px;">
                                    <div class="card-header sticky-top"
                                        style="background-color:rgb(246, 246, 246); color: #1f3c88; height: 50px;">
                                        <p class="mb-0"><strong>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</strong>
                                        </p>
                                    </div>
                                    <div class="card-body p-2 text-left">
                                        @foreach ($unpaidCounterpartRecords as $record)
                                            @if ($record->month == $month)
                                                <div class="row">
                                                    <div class="col-4">

                                                        <p class="mb-1" style="color: #1f3c88">Year:
                                                        </p>
                                                        <p class="mb-1" style="color: #1f3c88">
                                                            Amount:</strong></p>
                                                        <p class="mb-1" style="color: #1f3c88">Date:</strong>
                                                        </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-1">{{ $record->year }}</p>
                                                        <p class="mb-1">
                                                            ₱{{ number_format($record->amount_due - $record->amount_paid, 2) }}
                                                        </p>
                                                        <p class="mb-1">{{ $record->date }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr class="m-1">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
