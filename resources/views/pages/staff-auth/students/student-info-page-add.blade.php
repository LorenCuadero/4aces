@extends('layouts.staff.app')
@section('content')
    <section class="content">
        <div class="card">
            <br>
            <div class="card-body pt-0" style="background-color: none; border: none;">
                <h1 class="card-title" style="color:#1f3c88;"><b>Student Information: Add Form</b></h1>
                <br>
                <hr>
                <form id="edit-form" enctype="multipart/form-data" method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <div class="row" style="text-align: left;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" />
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name" />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" />
                            </div>
                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <select class="form-control" id="suffix" name="suffix">
                                    <option value="">Select Suffix</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gender_student">Gender</label>
                                <select class="form-control" id="gender_student" name="gender">
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Non-binary">Non-Binary</option>
                                    <option value="Prefer not to say">Prefer not to say</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Auto-Generated"
                                    name="email" readonly />
                            </div>
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="d3f@ultP@$$w0rd"
                                    name="password" readonly />
                            </div>
                            @error('password')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="phone">Contact Number</label>
                                <input type="number" class="form-control" id="phone" name="contact_number" />
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" max="{{ now()->subYears(18)->format('Y-m-d') }}"/>
                            </div>
                            <div class="form-group">
                                <label for="batch_year">Batch Year</label>
                                <input type="number" class="form-control" id="batch_year" name="batch_year" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="parent_name">Parent's / Guardian's Name</label>
                                <input type="text" class="form-control" id="parent_name" name="parent_name" />
                            </div>
                            <div class="form-group">
                                <label for="parent_contact">Parent's / Guardian's Contact Number</label>
                                <input type="number" class="form-control" id="parent_contact" name="parent_contact" />
                            </div>
                            <div class="form-group">
                                <label for="joined">Date Joined</label>
                                <input type="date" class="form-control" id="joined" name="joined"  max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"/>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" id="address" rows="3"></textarea>
                            </div>
                            <div class="form-group" style="float: right;">
                                <button type="submit" class="btn btn-primary mr-2">Add</button>
                                <a href="{{ route('students.index') }}" class="btn btn-default"
                                    style="text-decoration: none; color: #353535;">
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
