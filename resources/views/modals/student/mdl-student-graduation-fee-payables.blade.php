<div class="modal fade" id="student-graduation-fee-payable-modal" tabindex="-1" role="dialog"
    aria-labelledby="student-selection-modal-label" aria-hidden="true">
    <div class="modal-dialog custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-selection-modal-label">Graduation Fee Payables</h5>
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
                                                        <th style="background-color: #ffff; color:#1f3c88;">Date
                                                        <th style="background-color: #ffff; color:#1f3c88;">Amount Due
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-body1">
                                                    @forelse ($unpaidGraduationFeeRecords as $record)
                                                        <tr class="table-row1">
                                                            <td>{{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}
                                                            </td>
                                                            <td>₱
                                                                {{ number_format($record->amount_due - $record->amount_paid, 2) }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
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