<div class="modal fade" id="student-medical-payments-modal" tabindex="-1" role="dialog"
    aria-labelledby="student-selection-modal-label" aria-hidden="true">
    <div class="modal-dialog custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-selection-modal-label">Medical Share Payments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="{{ route('admin.records.counterpartRecords') }}"><span aria-hidden="true">&times;</span> </a>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center align-items-center">
                        @if ($paidMedicalRecords->isNotEmpty())
                            @foreach ($paidMedicalRecords as $record)
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
                                                    <p class="mb-1" style="color: #1f3c88;">Amount Paid:</p>
                                                    <p class="mb-1" style="color: #1f3c88;">Date Paid:</p>
                                                </div>
                                                <div class="col-5">
                                                    <p class="mb-1">₱ {{ number_format($record->total_cost, 2) }}</p>
                                                    <p class="mb-1">₱
                                                        {{ number_format($record->total_cost * 0.15, 2) }}
                                                    </p>
                                                    <p class="mb-1">₱ {{ number_format($record->amount_paid, 2) }}
                                                    </p>
                                                    <p class="mb-1">{{ $record->date }}</p>
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
                                    <p style="color: #1f3c88; font-size: 14px;" class="text-center">No records found.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
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
</script> --}}
