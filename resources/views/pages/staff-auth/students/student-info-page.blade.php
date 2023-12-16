@extends('layouts.staff.app')

@section('content')
    <section class="content">
        <div class="card">
            <br>
            <div class="card-body pt-0" style="background-color: none; border: none;">
                <h1 class="card-title" style="color:#1f3c88;"><b>Student Information: Edit Form</b></h1>
                <br>
                <hr>
                <form id="edit-form" enctype="multipart/form-data" method="POST"
                    action="{{ route('students-info.updateStudent', $student->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row" style="text-align: left;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    value="{{ $student->first_name }}" />
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name"
                                    value="{{ $student->middle_name }}" />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    value="{{ $student->last_name }}" />
                            </div>
                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <select class="form-control" id="suffix" name="suffix">
                                    <option value="" {{ $student->suffix ? '' : 'selected' }}>Select Suffix</option>
                                    <option value="Jr." {{ $student->suffix == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                    <option value="Sr." {{ $student->suffix == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                    <option value="II" {{ $student->suffix == 'II' ? 'selected' : '' }}>II</option>
                                    <option value="III" {{ $student->suffix == 'III' ? 'selected' : '' }}>III</option>
                                    <option value="IV" {{ $student->suffix == 'IV' ? 'selected' : '' }}>IV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gender_student">Gender <span class="text-danger">*</span></label>
                                <select class="form-control" id="gender_student" name="gender">
                                    <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>He</option>
                                    <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>She
                                    </option>
                                    <option value="Non-binary" {{ $student->gender == 'Non-binary' ? 'selected' : '' }}>
                                        Non-Binary</option>
                                    <option value="Prefer not to say"
                                        {{ $student->gender == 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" readonly
                                    value="{{ $student->email }}" />
                            </div>
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="phone">Contact Number</label>
                                <input type="number" class="form-control" id="phone" name="contact_number"
                                    value="{{ $student->contact_number }}" />
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Birthdate <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate"
                                    value="{{ $student->birthdate }}" max="{{ now()->subYears(18)->format('Y-m-d') }}"/>
                            </div>
                            <div class="form-group">
                                <label for="batch_year">Batch Year <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="batch_year" name="batch_year"
                                    value="{{ $student->batch_year }}" />
                            </div>
                            <div class="form-group">
                                <label for="joined">Date Joined <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="joined" name="joined"
                                    value="{{ $student->joined }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="parent_name">Parent's / Guardian's Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="parent_name" name="parent_name"
                                    value="{{ $student->parent_name }}" />
                            </div>
                            <div class="form-group">
                                <label for="parent_contact">Parent's / Guardian's Contact Number <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="parent_contact" name="parent_contact"
                                    value="{{ $student->parent_contact }}" />
                            </div>
                            <div class="form-group ">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <input name="address" class="form-control" id="address" value="{{ $student->address ? $student->address : '' }}">

                            </div>
                            <div class="form-group" style="float: right;">
                                <button type="submit" class="btn mr-2"
                                    style="background-color: #1f3c88; color:rgb(255, 255, 255)">Save Changes</button>
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
