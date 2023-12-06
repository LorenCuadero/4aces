<div class="modal fade" id="student-medical-payable-modal" tabindex="-1" role="dialog"
    aria-labelledby="student-selection-modal-label" aria-hidden="true">
    <div class="modal-dialog custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-selection-modal-label">Medical Payables</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="{{ route('admin.counterpartRecords') }}"><span aria-hidden="true">&times;</span> </a>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row" d-flex>
                        <div class="col-12" id="table">
                            <div class="card">
                                {{-- @include('assets.asst-table-headers-no-order-by') --}}
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form>
                                            <table id="selection"
                                                class="table table-bordered table-hover data-table text-center">
                                                <thead style="background-color: #ffff; color:#1f3c88;">
                                                    <tr>
                                                        <th style="background-color: #ffff; color:#1f3c88;">Medical
                                                            Concern</th>
                                                        <th style="background-color: #ffff; color:#1f3c88;">Total
                                                            Expense</th>
                                                        <th style="background-color: #ffff; color:#1f3c88;">15% Total
                                                            Share</th>
                                                        <th style="background-color: #ffff; color:#1f3c88;">Amount Due
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-body1">
                                                    @forelse ($unpaidMedicalRecords as $record)
                                                        <tr class="table-row1">
                                                            <td>{{ $record->medical_concern }}</td>
                                                            <td>₱ {{ number_format($record->total_cost, 2) }}</td>
                                                            <td>₱ {{ number_format($record->total_cost * 0.15, 2) }}
                                                            </td>
                                                            <td>₱
                                                                {{ number_format($record->total_cost * 0.15 - $record->amount_paid, 2) }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </form>
                                        @include('assets.asst-loading-spinner')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
