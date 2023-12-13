@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-body" style="background-color: none; border: none;">
                <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88;"><b>Student Account Information: Add Form</b></h1>
                <br>
                <hr>
                @if ($errors->has('msg'))
                    {{ $errors->first('msg') }}
                @endif

                <form id="add-student-form" enctype="multipart/form-data" method="POST"
                    action="{{ route('admin.storeStudentAccount') }}">
                    @csrf

                    <div class="row" style="text-align: left;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name_student">First Name</label>
                                <input type="text" class="form-control" id="first_name_student" name="first_name"
                                    required autocomplete="off" />
                            </div>
                            @error('first_name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="middle_name_student">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name_student" name="middle_name" />
                            </div>
                            @error('middle_name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="last_name_student">Last Name</label>
                                <input type="text" class="form-control" id="last_name_student" name="last_name"
                                    required />
                            </div>
                            @error('last_name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="suffix_student">Suffix</label>
                                <select class="form-control" id="suffix_student" name="suffix">
                                    <option value="">Select Suffix</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address_student">Address</label>
                                <textarea name="address" class="form-control" id="address_student" rows="3" required autocomplete="off"></textarea>
                            </div>
                            @error('address')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('suffix')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_student_off">Email Address</label>
                                <input type="email" class="form-control" id="email_student_off" value="Auto-Generated"
                                    disabled />
                            </div>
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="password_student">Password</label>
                                <input type="text" class="form-control" id="password_student" value="d3f@ultP@$$w0rd"
                                    disabled />
                            </div>
                            <div class="form-group">
                                <label for="contact_number_student">Contact Number</label>
                                <input type="number" class="form-control" id="contact_number_student"
                                    name="contact_number" />
                            </div>
                            @error('contact_number')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="batch_year_student">Batch Year</label>
                                <select class="form-control" id="batch_year_student"name="batch_year">
                                    @php
                                        $currentYear = now()->year;
                                        $startYear = 2013;
                                        $endYear = $currentYear + 2;
                                    @endphp

                                    @for ($year = $endYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            @error('batch_year')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="joined_student">Joined</label>
                                <input type="date" class="form-control" id="joined_student" name="joined" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required />
                            </div>
                            @error('batch_year')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthdate_student">Birthdate</label>
                                <input type="date" max="{{ now()->subYears(18)->format('Y-m-d') }}" class="form-control"
                                    id="birthdate_student" name="birthdate" required />
                            </div>
                            @error('birthdate')
                                <div class="alert alert-danger">
                                    {{ $message = 'You must be at least 18 years old.' }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="gender_student">Gender</label>
                                <select class="form-control" id="gender_student" name="gender">
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Non-binary">Non-Binary</option>
                                    <option value="Prefer not to say">Prefer not to say</option>
                                </select>
                            </div>
                            @error('gender')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="parent_name_student">Parent's / Guardian's Name</label>
                                <input type="text" class="form-control" id="parent_name_student"
                                    name="parent_name" />
                            </div>
                            @error('parent_name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="parent_contact_student">Parent's / Guardian's Contact Number</label>
                                <input type="number" class="form-control" id="parent_contact_student"
                                    name="parent_contact" />
                            </div>
                            @error('parent_contact')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br>
                            <div class="form-group" style="float: right;">
                                <button type="submit" class="btn btn-primary mr-2">Add</button>
                                <a href="{{ route('admin.accounts.student-accounts') }}" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
                @include('assets.asst-loading-spinner')
            </div>
        </div>
    </section>
@endsection
