    @extends('layouts.admin.app')
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
                                    <div class="nav-item btn btn-sm viewSummaryAcad"
                                        style="display: flex; align-items:center; height: 38px; margin-left: 4px;"
                                        data-target="add-student-grd-modal" data-toggle="modal">
                                        <a {{-- href="{{ route('admin.reports.getStudentGradeReport', ['id' => $student->id]) }}" --}} class="nav-link align-items-center"
                                            style="color:#fff;height: 100%; display: flex; align-items: center;"><i
                                                class="fa fa-eye mr-1" style="font-size: 17px"></i> Print Summary</a>
                                    </div>
                                    <div class="nav-item btn btn-sm" id="addGradeBtn"
                                        style="display: flex; align-items:center; height: 38px; margin-left: 4px;"
                                        data-target="add-student-grd-modal" data-toggle="modal">
                                        <a {{-- href="{{ route('admin.reports.getStudentGradeReport', ['id' => $student->id]) }}" --}} class="nav-link align-items-center"
                                            style="color:#fff;height: 100%; display: flex; align-items: center;"><i
                                                class="fa fa-plus mr-1" style="font-size: 17px"></i> Add</a>
                                    </div>
                                    <div class="nav-item btn btn-sm" id="back"
                                        style="display: flex; align-items:center; height: 38px; margin-left: 4px;">
                                        <a href="{{ route('admin.reports.academicReports') }}"
                                            class="nav-link align-items-center"
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
                                                <input type="hidden" id="gwa_hidden_input" value="{{ $student->gwa }}">
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
                                                            data-url="{{ route('admin.reports.destroyStudentGradeReport', ['id' => 'student_id', 'academic_id' => $academic->id]) }}"
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

                            <div class="tab-pane" style="display: none" id="grades-{{ $student->id }}">
                                <h4>CERTIFICATE IN COMPUTER TECHNOLOGY</h4>
                                <p class="text-disp"><i>Effective SY: {{ $student->joined }} -
                                        {{ \Carbon\Carbon::parse($student->joined)->addYears(2)->format('Y') }} </i>
                                </p>
                                <input type="hidden" id="user_joined_year_int" value="{{ $student->joined }}">
                                <input type="hidden" id="user_joined_effective_year"
                                    value=" {{ \Carbon\Carbon::parse($student->joined)->addYears(2)->format('Y') }} ">
                                <input type="hidden" class="student_name_academic"
                                    value="{{ $student->first_name }} {{ $student->last_name }}">
                                <p class="text-disp">{{ $student->first_name }} {{ $student->last_name }}</p>
                                <br>
                                <p class="text-disp"><b>General Point Average Per Semester</b></p>
                                <br>
                                <div class="table-responsive" style="overflow-x: auto;">
                                    <table id="academic-table-report" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>First Semester - 1st Year</th>
                                                <th>Second Semester - 1st Year</th>
                                                <th>First Semester - 2nd Year</th>
                                                <th>Second Semester - 2nd Year</th>
                                                <th>Third Semester - 1st Year</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                // Fetch grade reports directly for the current student
                                                $gradeReports = \App\Models\Academic::where('student_id', $student->id)->get();
                                                $overallGPA = $gradeReports->isNotEmpty() ? $gradeReports->avg('gpa') : null;
                                            @endphp

                                            @if ($gradeReports->isNotEmpty())
                                                <tr class="table-row">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <td>
                                                            @php
                                                                // Find the GPA for the current semester
                                                                $semesterGPA = $gradeReports->where('year_and_sem', $i)->sum('gpa');
                                                                // Calculate the average GPA for the current semester
                                                                $averageGPA = $semesterGPA > 0 ? $semesterGPA / $gradeReports->where('year_and_sem', $i)->count() : 0;
                                                            @endphp

                                                            {{ number_format($averageGPA, 2) }}
                                                        </td>
                                                    @endfor
                                                </tr>
                                                <!-- Set the overall GWA as the value of the hidden input using a class -->
                                                <script>
                                                    var overallGPA = {!! json_encode($overallGPA, JSON_HEX_TAG) !!};
                                                    document.getElementById('gwa_hidden_input').value = overallGPA !== null ? overallGPA.toFixed(2) : 'default_value';
                                                </script>
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">No records found.</td>
                                                    <!-- Set a default value for the hidden input when no records found -->
                                                    <script>
                                                        document.getElementById('gwa_hidden_input').value = 'default_value';
                                                    </script>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <p class="text-disp" style="font-size: 12px"><i>Note:</i>
                                    This record presents only the general
                                    point average per semester and your general weighted average. For further details,
                                    please open
                                    your <a href="https://ismis.usc.edu.ph/Account/Login?ReturnUrl=%2F"
                                        style="text-decoration: #1f3c88" title="USC-ISMIS Link">ISMIS</a> account.</p>
                                {{-- <p class="text-disp"><b>General Weighted Average:</b> {{ $student->gwa }}</p> --}}
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('modals.admin.reports.mdl-student-academic-report')
        @include('modals.admin.reports.mdl-student-add-academic-report')
        @include('modals.staff.mdl-delete-student-academic-confirmation')
    @endsection
