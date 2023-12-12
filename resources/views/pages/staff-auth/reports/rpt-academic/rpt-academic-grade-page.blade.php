    @extends('layouts.staff.app')
    @section('content')
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between"
                            style="background-color: #fff; color:#1f3c88">
                            <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88;">
                                <b>Grades of:</b>
                                {{ $student->first_name }}
                                @if ($student->middle_name && $student->middle_name != 'N/A')
                                    {{ ' ' . $student->middle_name }}
                                @endif
                                {{ ' ' . $student->last_name }}
                            </h1>
                            <br>
                            <div class="d-flex flex-wrap align-items-center ml-auto">
                                <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0">
                                    <div class="nav-item btn btn-sm" id="addGradeBtn"
                                        style="display: flex; align-items:center; height: 38px; margin-left: 4px;"
                                        data-target="add-student-grd-modal" data-toggle="modal">
                                        <a class="nav-link align-items-center"
                                            style="color:#fff;height: 100%; display: flex; align-items: center;"><i
                                                class="fa fa-plus mr-1" style="font-size: 17px"></i> Add</a>
                                    </div>
                                    <div class="nav-item btn btn-sm" id="back"
                                        style="display: flex; align-items:center; height: 38px; margin-left: 4px;">
                                        <a href="{{ route('rpt.acd.index') }}" class="nav-link align-items-center"
                                            style="color:#fff;height: 100%; display: flex; align-items: center;"><i
                                                class="far fa-arrow-alt-circle-left mr-1" style="font-size: 17px"></i>
                                            Back</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <input type="hidden" value="{{ $student->id }}">
                                <table class="table table-hover data-table text-center" style="font-size: 14px">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Course
                                                Code</th>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Year and
                                                Semester</th>
                                            <th style="background-color: #fff; color:#1f3c88"class="vertical-text">Midterm
                                                Grade</th>
                                            <th style="background-color: #fff; color:#1f3c88"class="vertical-text">Final
                                                Grade</th>
                                            <th style="background-color: #fff; color:#1f3c88"class="vertical-text">Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        @forelse ($academics as $academic)
                                            <tr class="table-row">
                                                <td class="align-middle">{{ $academic->course_code }}</td>
                                                <td class="align-middle">
                                                    @if (isset($academic->year_and_sem))
                                                        @if ($academic->year_and_sem == 0)
                                                            1st year - First Semester
                                                        @endif
                                                        @if ($academic->year_and_sem == 1)
                                                            1st year - Second Semester
                                                        @endif
                                                        @if ($academic->year_and_sem == 2)
                                                            2nd year - First Semester
                                                        @endif
                                                        @if ($academic->year_and_sem == 3)
                                                            2nd year - Second Semester
                                                        @endif
                                                        @if ($academic->course_code == 4)
                                                            3RD year - First Semester
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @if ($academic->midterm_grade != null)
                                                        {{ $academic->midterm_grade }}
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @if ($academic->final_grade != null)
                                                        {{ $academic->final_grade }}
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <div
                                                        style="display: flex; align-items: center; justify-content:center;">
                                                        <a href="#" class="edit-grade-btn btn btn-sm"
                                                            data-academic-id="{{ $academic->id }}"
                                                            data-academic-course-code="{{ $academic->course_code }}"
                                                            data-year-and-sem="{{ $academic->year_and_sem }}"
                                                            data-midterm="{{ $academic->midterm_grade }}"
                                                            data-final=" {{ $academic->final_grade }} "
                                                            style="color: #1f3c88;width:50%; border-radius: 20px; margin: 2px">
                                                            <strong><i class="far fa-edit" style="font-size: 17px"></i>
                                                            Edit</strong>
                                                        </a>
                                                        <a href="#" data-id="{{ $academic->id }}"
                                                            data-student-id="{{ $student->id }}"
                                                            data-url="{{ route('rpt.acd.destroyStudentGradeReport', ['id' => 'student_id', 'academic_id' => $academic->id]) }}"
                                                            class="btn btn-sm delete-academic"
                                                            style="color: #dd3e3e; width:50%; border-radius: 20px; margin: 2px;">
                                                            <i class="fas fa-trash-alt"
                                                                style="font-size: 16px; border: 1px;"></i>
                                                            Delete
                                                        </a>
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
        </section>
        @include('modals.staff.mdl-student-acd-rpt')
        @include('modals.staff.mdl-student-acd-rpt-add')
        @include('modals.staff.mdl-delete-student-academic-confirmation')
    @endsection
