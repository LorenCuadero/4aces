<div class="modal fade" id="student-selection-personal-ca-modal" tabindex="-1" role="dialog"
    aria-labelledby="student-selection-modal-label" aria-hidden="true">
    <div class="modal-dialog custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-selection-modal-label">Select Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
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
                                                class="table table-bordered table-hover data-table text-center" style="width: 100%; font-size: 14px">
                                                <thead style="background-color: #ffff; color:#1f3c88;">
                                                    <tr>
                                                        <th style="background-color: #ffff; color:#1f3c88; display:none">User Id</th>
                                                        <th style="background-color: #ffff; color:#1f3c88;">Name</th>
                                                        <th style="background-color: #ffff; color:#1f3c88;">Batch Year </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-body1">
                                                    @forelse ($studentsWithoutPCA as $student)
                                                        <tr class="table-rowPersonal">
                                                            <td hidden>{{ $student->id }}</td>
                                                            <td>
                                                                {{ $student->last_name}}, {{ $student->first_name}}
                                                                @if ($student->middle_name && $student->middle_name != 'N/A')
                                                                    {{ ' ' . $student->middle_name }}
                                                                @endif

                                                            </td>
                                                            <td>Batch {{ $student->batch_year }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td style="display:none"></td>
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
