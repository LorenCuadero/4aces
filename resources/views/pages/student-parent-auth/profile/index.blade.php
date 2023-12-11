@extends('layouts.student.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header mb-0" style="color: #1f3c88; background-color:#ffffff">
                            <div class="text-center">
                                <i class="fa-solid fa-user" style="color: #1f3c88; font-size: 50px; padding: 16px"></i>
                            </div>
                            <h3 class="profile-username text-center" style="font-size: 18px">
                                 {{ $userData['first_name'] }}
                                    @if (strcasecmp($userData['middle_name'], 'n/a') !== 0 && !is_null($userData['middle_name']))
                                        {{ $userData['middle_name'] }}
                                    @endif
                                    {{ $userData['last_name'] }}
                            </h3>
                            <p style="font-size: 13px" class="text-muted text-center mb-0">Student</p>
                        </div>
                        <div class="card-body text-left student-profile" style="font-size: 13px; padding-to">
                            <span class="text-left" style="display: none"><strong style="text-align: left"><i class="far fa-id-card mr-1"
                                        style="color: #1f3c88; background-color:#ffffff"></i> User Id</strong></span>
                            <p class="text-muted mb-0" style="display: none">
                                {{ $userData['id'] }} </p>
                            {{-- <hr class="m-2"> --}}
                            <span class="text-left"><strong style="text-align: left"><i class="fas fa-calendar mr-"
                                        style="color: #1f3c88; background-color:#ffffff"></i> Batch Year</strong></span>
                            <p class="text-muted mb-0">
                                {{ $userData['batch_year'] }} </p>
                            <hr class="m-2">
                            <span class="text-left"><strong style="text-align: left"><i class="fas fa-calendar mr-1"
                                        style="color: #1f3c88; background-color:#ffffff"></i> Date Joined</strong></span>
                            <p class="text-muted mb-0">
                                {{ $userData['joined'] }}
                            </p>
                            <hr class="m-2">
                            <span class="text-left"><strong style="text-align: left"><i class="fas fa-envelope mr-1"
                                        style="color: #1f3c88; background-color:#ffffff"></i> Email</strong></span>
                            <p class="text-muted mb-0">
                                {{ $userData['email'] }}
                            </p>
                            <hr class="m-2">
                            <span class="text-left"><strong style="text-align: left"><i class="fas fa-map-marker-alt mr-1"
                                        style="color: #1f3c88; background-color:#ffffff"></i> Address</strong></span>
                            <p class="text-muted mb-0">{{ $userData['address'] }}</p>
                            <hr class="m-2">
                            <span class="text-left"><strong style="text-align: left"><i class="fas fa-user mr-1"
                                        style="color: #1f3c88; background-color:#ffffff"></i> Parent /
                                    Guardian</strong></span>
                            <p class="text-muted mb-0">
                                <span>{{ $userData['parent_name'] }}</span>
                            </p>
                            <hr class="m-2">
                            <span class="text-left"><strong style="text-align: left"><i class="fa fa-phone mr-1"
                                        style="color: #1f3c88; background-color:#ffffff"></i> Parent Contact</strong></span>
                            <p class="text-muted mb-0">{{ $userData['parent_contact'] }}</p>
                            <hr class="m-2">
                            <span class="text-left"><strong style="text-align: left"><i class="fa fa-calendar mr-1"
                                        style="color: #1f3c88; background-color:#ffffff"></i> Birthdate</strong></span>
                            <p class="text-muted mb-0">{{ $userData['birthdate'] }}</p>
                        </div>
                    </div>

                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2"  style="background-color: #ffffff;">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#grades" data-toggle="tab">Academic</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#reports" data-toggle="tab">Disciplinary</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <br>
                                <div class="tab-pane fade show active" id="grades">
                                    <h4>CERTIFICATE IN COMPUTER TECHNOLOGY</h4>
                                    <br>
                                    <p class="text-disp"><i>Effective SY: {{ $userJoinedYearInt }} -
                                            {{ $userJoinedEffectiveYear }} </i>
                                    </p>
                                    <input type="hidden" id="user_joined_year_int" value="{{ $userJoinedYearInt }}">
                                    <input type="hidden" id="user_joined_effective_year"
                                        value=" {{ $userJoinedEffectiveYear }}">
                                    <input type="hidden" class="student_name_academic"
                                        value="{{ $userFname }} {{ $userLname }}">
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
                                    <br>
                                    <hr class="m-2">
                                    <p class="text-disp" style="font-size: 12px"><i>Note:</i> This record presents only
                                        the
                                        general
                                        point average per semester and your general weighted average. For further details,
                                        please open
                                        your <a href="https://ismis.usc.edu.ph/Account/Login?ReturnUrl=%2F"
                                            style="text-decoration: #1f3c88" title="USC-ISMIS Link">ISMIS</a> account.</p>
                                    <p class="text-disp"><b>General Weighted Average:</b>
                                        {{ number_format($totalGPA, 2) }}
                                    </p>
                                    <input type="hidden" value="{{ number_format($totalGPA, 2) }}" id="total_gpa_acad">
                                    <hr class="m-2">
                                    <span class="buttons">
                                        <button type="button" class="btn btn-default printButtonOnAcademicReports ml-1"
                                            style="background-color: #1f3c88; color: #ffff;" title="Print"><i
                                                class="fas fa-print" style="color: #ffffff"></i> Print</button></span>
                                </div>

                                <div class="tab-pane fade" id="reports">
                                    <br>
                                    <h2 style="text-align: left; color: #1f3c88">{{ $userFname }} {{ $userLname }}
                                    </h2>
                                    <p class="text-disp" style="text-align: left">Student</p>
                                    <br>
                                    <span class="p-1"></span>
                                    <div class="table-responsive p-1">
                                        <table id="disciplinary-report-table" class="table p-2">
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
                                                        <tr class="table-row p-2">
                                                            <td class="dcpl-records">Formal Verbal Warning</td>
                                                            <td>{{ $disciplinaryRecord->verbal_warning_date }}</td>
                                                            <td>{{ $disciplinaryRecord->verbal_warning_description }}</td>
                                                        </tr>
                                                        <tr class="table-row p-2">
                                                            <td class="dcpl-records">Written Warning</td>
                                                            <td>{{ $disciplinaryRecord->written_warning_date }}</td>
                                                            <td>{{ $disciplinaryRecord->written_warning_description }}</td>
                                                        </tr>
                                                        <tr class="table-row p-2">
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
                                        <br>
                                        <br>
                                        <br>
                                        <span class="buttons">
                                            <button type="button"
                                                class="btn btn-default printButtonOnDisciplinaryReports ml-1"
                                                style="background-color: #1f3c88; color: #ffff;" title="Print"><i
                                                    class="fas fa-print" style="color: #ffffff"></i> Print</button></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection
