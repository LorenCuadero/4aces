<div class="modal fade" id="student-medical-payments-modal" tabindex="-1" role="dialog"
    aria-labelledby="student-selection-modal-label" aria-hidden="true">
    <div class="modal-dialog custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-selection-modal-label">Medical Share Payments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="{{ route('admin.counterpartRecords') }}"><span aria-hidden="true">&times;</span> </a>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row" d-flex>
                        <div class="col-12" id="table">
                            <div class="card">
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
                                                        <th style="background-color: #ffff; color:#1f3c88;">Amount Paid
                                                        </th>
                                                        <th style="background-color: #ffff; color:#1f3c88;">Date Paid
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-body1">
                                                    @forelse ($paidMedicalRecords as $record)
                                                        <tr class="table-row1">
                                                            <td>{{ $record->medical_concern }}</td>
                                                            <td>₱ {{ number_format($record->total_cost, 2) }}</td>
                                                            <td>₱ {{ number_format($record->total_cost * 0.15, 2) }}
                                                            </td>
                                                            <td>₱
                                                                {{ number_format($record->amount_paid, 2) }}
                                                            </td>
                                                            <td>{{$record->date}}</td>
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
<script>
    // Function to handle sorting the table by year
    function toggleSortOrder() {
        // Fetch the sort link and modal ID
        var sortLink = document.getElementById('sortPaidMedical');
        var tableBody = document.querySelector('#student-medical-payments-modal .modal-body .table-body1');

        // Attach a click event listener to the sort link
        sortLink.addEventListener('click', function(event) {
            event.preventDefault();

            // Fetch the current sort order from the link's data attribute
            var currentSortOrder = sortLink.getAttribute('data-sort-order') || 'asc';

            // Toggle the sort order
            var nextSortOrder = (currentSortOrder === 'asc') ? 'desc' : 'asc';

            // Update the link's data attribute with the new sort order
            sortLink.setAttribute('data-sort-order', nextSortOrder);

            // Fetch the rows from the table body
            var rows = Array.from(tableBody.querySelectorAll('.table-row1'));

            // Sort the rows based on the year column (assuming it's the second column)
            rows.sort(function(row1, row2) {
                var year1 = parseInt(row1.children[1].innerText);
                var year2 = parseInt(row2.children[1].innerText);

                return (nextSortOrder === 'asc') ? (year1 - year2) : (year2 - year1);
            });

            // Append the sorted rows back to the table body
            rows.forEach(function(row) {
                tableBody.appendChild(row);
            });
        });
    }

    // Call the function when the document is ready
    document.addEventListener('DOMContentLoaded', function() {
        toggleSortOrder();
    });
</script>
