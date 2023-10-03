@extends('layouts.staff.app')
@section('content')
    <section class="content">
        <div class="row mb-3">
            <div class="col-md-12">
                <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88;">
                    <b>{{ $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name }}</b>
                </h1>
                <br>
                <span class="text-muted" style="float: left">Student</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex flex-wrap align-items-center ml-auto">
                            <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0">
                                <div class="nav-item btn btn-sm" id="addGradeBtn"
                                    style="display: flex; align-items:center; height: 38px; margin-left: 4px;"
                                    data-target="add-student-grd-modal" data-toggle="modal">
                                    <a class="nav-link align-items-center"
                                        style="color:#fff;height: 100%; display: flex; align-items: center;">Add</a>
                                </div>
                                <div class="nav-item btn btn-sm" id="back"
                                    style="display: flex; align-items:center; height: 38px; margin-left: 4px;">
                                    <a href="{{ route('rpt.acd.index') }}" class="nav-link align-items-center"
                                        style="color:#fff;height: 100%; display: flex; align-items: center;">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <input type="hidden" value="{{ $student->id }}">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="vertical-text">Course Code</th>
                                        <th class="vertical-text">1st Sem - 1st Year</th>
                                        <th class="vertical-text">2nd Sem - 1st Year</th>
                                        <th class="vertical-text">1st Sem - 2nd Year</th>
                                        <th class="vertical-text">2nd Sem - 2nd Year</th>
                                        <th class="vertical-text">GPA</th>
                                        <th class="vertical-text">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="table-body">
                                    @forelse ($academics as $academic)
                                        <tr class="table-row">
                                            <td>{{ $academic->course_code }}</td>
                                            <td>{{ $academic->first_sem_1st_year }}</td>
                                            <td>{{ $academic->second_sem_1st_year }}</td>
                                            <td>{{ $academic->first_sem_2nd_year }}</td>
                                            <td>{{ $academic->second_sem_2nd_year }}</td>
                                            <td>{{ $academic->gpa }}</td>
                                            <td>
                                                <a href="#" class="edit-grade-btn btn btn-sm" 
                                                data-academic-id="{{ $academic->id }}"
                                                data-academic-course_code="{{ $academic->course_code }}"
                                                data-academic-first_sem_1st_year="{{ $academic->first_sem_1st_year }}"
                                                data-academic-second_sem_1st_year="{{ $academic->second_sem_1st_year }}"
                                                data-academic-first_sem_2nd_year="{{ $academic->first_sem_2nd_year }}"
                                                data-academic-second_sem_2nd_year="{{ $academic->second_sem_2nd_year }}"
                                                data-academic-gpa="{{ $academic->gpa }}">EDIT</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center">No records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('modals.staff.mdl-student-acd-rpt')
    @include('modals.staff.mdl-student-acd-rpt-add')
    {{-- <cmpt-student-acd-rpt></cmpt-student-acd-rpt> --}}
@endsection
