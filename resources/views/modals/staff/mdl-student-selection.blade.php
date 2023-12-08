<div class="modal fade" id="student-selection-modal" tabindex="-1" role="dialog"
    aria-labelledby="student-selection-modal-label" aria-hidden="true">
    <div class="modal-dialog custom-modal-width-on-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-selection-modal-label">Select Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="{{ route('rpt.dcpl.index') }}"><span aria-hidden="true">&times;</span></a>
                </button>
            </div>
            <div class="modal-body b-gray-color pb-0">
                <div class="container-fluid">
                    <div class="row d-flex">
                        <div class="col-12" id="table">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive" style="overflow: hidden;">
                                        <form>
                                            <table id="selection"
                                                class="table table-bordered table-hover data-table text-center"
                                                style="overflow: hidden;">
                                                <thead>
                                                    <tr>
                                                        <th style="background-color: #ffff; color: #1f3c88"
                                                            class="vertical-text">User Id</th>
                                                        <th style="background-color: #ffff; color: #1f3c88"
                                                            class="vertical-text">Name</th>
                                                        <th style="background-color: #ffff; color: #1f3c88"
                                                            class="vertical-text">Batch Year</th>
                                                        <th style="background-color: #ffff; color: #1f3c88"
                                                            class="vertical-text">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-body1">
                                                    @forelse ($students as $student)
                                                        <tr class="table-row1">
                                                            <td>{{ $student->id }}</td>
                                                            <td>{{ $student->first_name }}

                                                                @if ($student->middle_name && $student->middle_name != 'N/A')
                                                                    {{ ' ' . $student->middle_name }}
                                                                @endif

                                                                {{ ' ' . $student->last_name }}
                                                            </td>
                                                            <td>Batch {{ $student->batch_year }}</td>
                                                            <td> <a href="{{ route('rpt.dcpl.showDisciplinaryRecordsForStudent', ['id', $student->id]) }}"
                                                                    data-toggle="modal"
                                                                    data-target="#add-student-dcpl-modal"
                                                                    data-student-id="{{ $student->id }}"
                                                                    data-student-fname="{{ $student->first_name }}"
                                                                    data-student-lname="{{ $student->last_name }}"
                                                                    class="select-student-link">Select</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center align-items-center">
            </div>
            @include('assets.asst-loading-spinner')
        </div>
    </div>
</div>
