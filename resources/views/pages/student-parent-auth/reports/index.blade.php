@extends('layouts.student.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 style="color: #1f3c88; text-align: left;">Reports</h1><br>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="grades-tab" data-toggle="tab" href="#grades">Grades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="reports-tab" data-toggle="tab" href="#reports">Disciplinary Records</a>
                    </li>
                </ul>
                <div class="tab-content" style="padding: 3% 2%; background-color: #fff;">
                    <!-- Grades Tab Content -->
                    <div class="tab-pane fade show active" id="grades">
                        <h4>CERTIFICATE IN COMPUTER TECHNOLOGY</h4>
                        <p class="text-disp"><i>Effective SY: {{ $userJoinedYearInt }} - {{ $userJoinedEffectiveYear }} </i>
                        </p>
                        <input type="hidden" id="user_joined_year_int" value="{{ $userJoinedYearInt }}">
                        <input type="hidden" id="user_joined_effective_year" value=" {{ $userJoinedEffectiveYear }}">
                        <input type="hidden" class="student_name_academic" value="{{ $userFname }} {{ $userLname }}">
                        <p class="text-disp">{{ $userFname }} {{ $userLname }}</p>
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
                                    @isset($gradeReports)
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
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">No records found.</td>
                                        </tr>
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <p class="text-disp" style="font-size: 12px"><i>Note:</i> This record presents only the general
                            point average per semester and your general weighted average. For further details, please open
                            your <a href="https://ismis.usc.edu.ph/Account/Login?ReturnUrl=%2F"
                                style="text-decoration: #1f3c88" title="USC-ISMIS Link">ISMIS</a> account.</p>
                        <p class="text-disp"><b>General Weighted Average:</b> {{ number_format($totalGPA, 2) }}</p>
                        <input type="hidden" value="{{ number_format($totalGPA, 2) }}" id="total_gpa_acad">
                        <hr>
                        <span class="buttons">
                            <button type="button" class="btn btn-default printButtonOnAcademicReports ml-1"
                                style="background-color: #1f3c88; color: #ffff;" title="Print"><i class="fas fa-print"
                                    style="color: #ffffff"></i> Print</button>
                        </span>
                    </div>
                    <!-- Reports Tab Content -->
                    <div class="tab-pane fade" id="reports">
                        <h2 style="text-align: left; color: #1f3c88">{{ $userFname }} {{ $userLname }}</h2>
                        <p class="text-disp" style="text-align: left">Student</p>
                        <br>
                        <div class="table-responsive">
                            <table id="disciplinary-report-table" class="table">
                                <thead style="background-color: #ffffff; color: #1f3c88;">
                                    <tr>
                                        <th>Disciplinary Record Title</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($disciplinaryRecords)
                                        @forelse ($disciplinaryRecords as $disciplinaryRecord)
                                            <tr class="table-row">
                                                <td class="dcpl-records">Formal Verbal Warning</td>
                                                <td>{{ $disciplinaryRecord->verbal_warning_date }}</td>
                                                <td>{{ $disciplinaryRecord->verbal_warning_description }}</td>
                                            </tr>
                                            <tr class="table-row">
                                                <td class="dcpl-records">Written Warning</td>
                                                <td>{{ $disciplinaryRecord->written_warning_date }}</td>
                                                <td>{{ $disciplinaryRecord->written_warning_description }}</td>
                                            </tr>
                                            <tr class="table-row">
                                                <td class="dcpl-records">Probationary</td>
                                                <td>{{ $disciplinaryRecord->provisionary_description }}</td>
                                                <td>{{ $disciplinaryRecord->provisionary_date }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No records found.</td>
                                            </tr>
                                        @endforelse
                                    @endisset
                                </tbody>
                            </table>
                            <span class="buttons">
                                <button type="button" class="btn btn-default printButtonOnDisciplinaryReports ml-1"
                                    style="background-color: #1f3c88; color: #ffff;" title="Print"><i class="fas fa-print"
                                        style="color: #ffffff"></i> Print</button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
