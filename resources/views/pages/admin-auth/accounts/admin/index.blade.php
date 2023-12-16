@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-body" style="background-color: none; border: none;">
                <h1 class="card-title" style="color:#1f3c88;"><b>Admin Account Information: Add Form</b></h1>
                <br>
                <hr>
                @if ($errors->has('msg'))
                    {{ $errors->first('msg') }}
                @endif

                <form id="add-admin-form" enctype="multipart/form-data" method="POST"
                    action="{{ route('admin.storeAdminAccount') }}">
                    @csrf
                    <div class="row" style="text-align: left;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name_admin">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name_admin" name="first_name" required
                                    autocomplete="off" />
                            </div>
                            <div class="form-group">
                                <label for="middle_name_admin">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name_admin" name="middle_name" />
                            </div>
                            <div class="form-group">
                                <label for="last_name_admin">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name_admin" name="last_name" required />
                            </div>
                            <div class="form-group">
                                <label for="email_admin">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email_admin" name="email" required
                                    autocomplete="off" />
                            </div>
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password_admin">Password <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="password_admin" name="password" required />
                            </div>
                            <div class="form-group">
                                <label for="contact_number_admin">Contact Number</label>
                                <input type="number" class="form-control" id="contact_number_admin"
                                    name="contact_number" />
                            </div>
                            <div class="form-group">
                                <label for="department_admin">Department <span class="text-danger">*</span></label>
                                <select name="department" id="department_admin" class="form-control">
                                    <option value="Administrative" selected>Administrative</option>
                                    <option value="Administrative Assistant">Administrative Assistant</option>
                                    <option value="Finance">Finance</option>
                                    <option value="HR">HR</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="civil_status_admin">Civil Status <span class="text-danger">*</span></label>
                                <select name="civil_status" id="civil_status_admin" class="form-control">
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widow">Widow</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthdate_admin">Birthdate <span class="text-danger">*</span></label>
                                <input type="date" max="{{ now()->subYears(18)->format('Y-m-d') }}" class="form-control"
                                    id="birthdate_admin" name="birthdate" required />
                            </div>
                            @error('birthdate')
                                <div class="alert alert-danger">
                                    {{ $message = 'You must be at least 18 years old.' }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="gender_admin">Gender <span class="text-danger">*</span></label>
                                <select class="form-control" id="gender_admin" name="gender">
                                    <option value="Male" selected>He</option>
                                    <option value="Female">She</option>
                                    <option value="Non-binary">Non-Binary</option>
                                    <option value="Prefer not to say">Prefer not to say</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address_admin">Address <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" id="address_admin" rows="3" required autocomplete="off"></textarea>
                            </div>

                            <div class="form-group" style="float: right;">
                                <button type="submit" class="btn btn-primary mr-2">Add</button>
                                <a href="{{ route('admin.accounts.admin-accounts') }}" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
