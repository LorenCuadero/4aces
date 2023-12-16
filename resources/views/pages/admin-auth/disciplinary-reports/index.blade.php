@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between"
                            style="background-color: #fff; color:#1f3c88">
                            <p class="card-title mb-3 mb-md-0" style="color:#1f3c88; padding-left:0%; font-size: 22px">
                                <b>Disciplinary Reports</b>
                            </p>
                            <div class="d-flex flex-wrap align-items-center ml-auto">
                                <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0"
                                    style="display: flex; align-items: center;">
                                    {{-- <div style="display: flex; align-items: center; height: 38px;">
                                        <input class="form-control mr-sm-1 searchInput" type="search"
                                            placeholder="Search record here" aria-label="Search"
                                            style="height: 100%; width: 200px;">
                                    </div> --}}
                                    {{-- <div class="nav-item dropdown show btn btn-sm reset-filter-btn"
                                        style="display: flex; align-items:center; height: 38px;">
                                        <a class="nav-link align-items-center"
                                            style="color:#fff;height: 100%; display: flex; align-items: center;">Reset
                                            Table</a>
                                    </div> --}}
                                    <div class="nav-item btn btn-sm p-2" id="selectToAdd"
                                        data-target="#admin-student-selection-modal" data-toggle="modal"
                                        style="display: flex; align-items:center; height: 38px; margin-left: 4px;">
                                        <a href="#" class="nav-link align-items-center p-0" style="color:#1f3c88;"><i
                                                class="fas fa-user-plus" style="font-size: 23px"></i></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover data-table text-center"
                                    style="font-size: 14px">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Students
                                            </th>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Formal
                                                Verbal Warning</th>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Written
                                                Warning</th>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">
                                                Probationary</th>
                                            <th style="background-color: #fff; color:#1f3c88;"
                                                class="vertical-text">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        @forelse ($studentsWithDisciplinaryRecords as $studentsWithRecord)
                                            <tr class="table-row">
                                                <td class="align-middle">
                                                    {{ $studentsWithRecord->student->last_name }},
                                                    {{ $studentsWithRecord->student->first_name }}
                                                    @if (
                                                        $studentsWithRecord->middle_name &&
                                                            $student->middle_name != 'N/A' &&
                                                            ($studentsWithRecord->middle_name && $student->middle_name != 'n/a'))
                                                        {{ ' ' . $studentsWithRecord->middle_name }}
                                                    @endif

                                                </td>
                                                <td class="align-middle">
                                                    <input type="date" name="verbal_warning_date"
                                                        id="verbal_warning_date_{{ $studentsWithRecord->id }}"
                                                        value="{{ $studentsWithRecord->verbal_warning_date }}"
                                                        class="form-control text-center align-middle" textarea readonly>
                                                    <input type="hidden"
                                                        value="{{ $studentsWithRecord->verbal_warning_description }}">
                                                </td>
                                                <td class="align-middle">
                                                    <input type="date" name="written_warning_date"
                                                        id="written_warning_date_{{ $studentsWithRecord->id }}"
                                                        value="{{ $studentsWithRecord->written_warning_date }}"
                                                        class="form-control text-center align-middle" textarea readonly>
                                                    <input type="hidden"
                                                        value="{{ $studentsWithRecord->written_warning_description }}">
                                                </td>
                                                <td class="align-middle">
                                                    <input type="date" name="provisionary_date"
                                                        id="provisionary_date_{{ $studentsWithRecord->id }}"
                                                        value="{{ $studentsWithRecord->provisionary_date }}"
                                                        class="form-control text-center align-middle" textarea readonly>
                                                    <input type="hidden"
                                                        value="{{ $studentsWithRecord->provisionary_description }}">
                                                </td>
                                                <td class="align-middle">
                                                    <div
                                                        style="display: flex; align-items: center; justify-content:center;">
                                                        <a href="#" id="edit-dcpl-btn" class="btn btn-sm"
                                                            style=" color:#1f3c88;" data-toggle="modal"
                                                            data-target="#edit-student-dcpl-modal"
                                                            data-student-id="{{ $studentsWithRecord->id }}"
                                                            data-student-fname="{{ $studentsWithRecord->student->first_name }}"
                                                            data-student-lname="{{ $studentsWithRecord->student->last_name }}"
                                                            data-student-url="{{ route('rpt.dcpl.update', ['id' => '__student_id__']) }}"
                                                            data-verbal-warning-date="{{ $studentsWithRecord->verbal_warning_date }}"
                                                            data-verbal-warning-desc="{{ $studentsWithRecord->verbal_warning_description }}"
                                                            data-written-warning-date="{{ $studentsWithRecord->written_warning_date }}"
                                                            data-written-warning-desc="{{ $studentsWithRecord->written_warning_description }}"
                                                            data-provisionary-warning-date="{{ $studentsWithRecord->provisionary_date }}"
                                                            data-provisionary-warning-desc="{{ $studentsWithRecord->provisionary_description }}"
                                                            data-student-route="{{ route('admin.reports.indexDisciplinaryReports') }}">
                                                            <strong><i class="far fa-edit" style="font-size: 17px"></i>
                                                                View | Edit</strong>
                                                            {{-- <strong><i class="fa fa-eye"></i>View</strong> --}}
                                                        </a>
                                                        <a href="#" data-id="{{ $studentsWithRecord->id }}"
                                                            data-url="{{ route('admin.reports.destroyForAdmin', ['id' => 'dcpl_id']) }}"
                                                            class="btn btn-sm delete-dcpl-btn"
                                                            style="color: #dd3e3e; border-radius: 20px; margin: 3px;">
                                                            <strong><i class="fas fa-trash-alt"
                                                                    style="font-size: 16px; border: 1px;"></i>
                                                                Delete</strong>
                                                        </a>
                                                        <span class="buttons">
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
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

    {{-- VIEW MODAL --}}
    <div class="modal fade" id="edit-student-dcpl-modal" tabindex="-1" role="dialog"
        aria-labelledby="add-student-modal-label" aria-hidden="true">
        <div class="modal-dialog custom-modal-width-on-modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="student-warning-modal-label">Warning for
                        <span class="Input first_name_edit"></span> <span class="Input last_name_edit"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-form-dcpl"
                    data-student-url="{{ route('admin.reports.updateForAdmin', ['id' => '__student_id__']) }}"
                    method="POST" class="text-left">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="student_id" id="student_id" value="">
                    <div class="modal-body b-gray-color p-2">
                        <div class="p-4 m-1 rounded" style="background-color:rgb(255, 255, 255)">
                            <div class="form-group row">
                                <label for="verbal-warning" class="col-md-4 col-form-label">Formal Verbal Warning:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="date" id="verbal_warning_date"
                                        name="verbal_warning_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="verbal_warning_description"
                                    class="col-md-4 col-form-label">Description:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="verbal_warning_description" name="verbal_warning_description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="written-warning" class="col-md-4 col-form-label">Written Warning:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="date" id="written_warning_date"
                                        name="written_warning_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="written_warning_description"
                                    class="col-md-4 col-form-label">Description:</label>
                                <div class="col-md-8">
                                    <textarea textarea class="form-control" id="written_warning_description" name="written_warning_description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="provisionary-warning" class="col-md-4 col-form-label">Probationary
                                    Warning:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="date" id="provisionary_date"
                                        name="provisionary_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="provisionary_description" class="col-md-4 col-form-label">Description:</label>
                                <div class="col-md-8">
                                    <textarea textarea class="form-control" id="provisionary_description" name="provisionary_description"></textarea>
                                </div>
                            </div>
                        </div>
                        @include('assets.asst-loading-spinner')
                    </div>
                    <div class="modal-footer d-flex float-right">
                        <button type="button" class="btn btn-default printButtonOnAdminDisciplinaryReports ml-1"
                            style="background-color: #1f3c88; color: #ffff;" title="Print"><i class="fas fa-print"
                                style="color: #ffffff"></i> Print
                        </button>
                        <button id="saveEdit" type="button" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            aria-label="Close">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- @include('modals.staff.mdl-student-dcpl-rpt-edit') --}}
    {{-- @include('modals.staff.mdl-student-dcpl-rpt-add') --}}
    @include('modals.admin.reports.mdl-student-dcpl-rpt-add')
    @include('modals.admin.reports.mdl-student-selection')
    @include('modals.admin.reports.mdl-delete-student-disciplinary-confirmation')
    {{-- @include('modals.staff.mdl-delete-student-disciplinary-confirmation') --}}
@endsection
