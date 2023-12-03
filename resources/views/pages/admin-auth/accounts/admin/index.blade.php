@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88;"><b>Admin Account Information: Add Form</b></h1>
        <span>
            @if (session('success'))
                <p><span class="text-success success-display ml-2">[ {{ session('success') }} ]</span></p>
            @endif
            @if (session('error'))
                <p><span class="text-danger error-display ml-2">[ {{ session('error') }} ]</span></p>
            @endif
        </span>
        <br>
        <div class="card">
            <div class="card-body" style="background-color: none; border: none;">

                @if ($errors->has('msg'))
                    {{ $errors->first('msg') }}
                @endif
                @include('pop-message')
                <form id="add-admin-form" enctype="multipart/form-data" method="POST" action="{{ route('admin.storeAdminAccount') }}">
                    @csrf
                    @if (session('success'))
                        <script>
                            toastr.success('{{ session('success') }}');
                        </script>
                    @endif

                    <div class="row" style="text-align: left;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name_admin" name="first_name"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name_admin" name="middle_name"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name_admin" name="last_name" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email_admin" name="email" required />
                            </div>
                            @error('email')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="phone">Password</label>
                                <input type="text" class="form-control" id="password_admin" name="password" />
                            </div>
                            <div class="form-group">
                                <label for="parent_contact">Contact Number</label>
                                <input type="number" class="form-control" id="contact_number_admin" name="contact_number" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" id="address_admin" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" max="{{now()->subYears(18)->format('Y-m-d')}}" class="form-control" id="birthdate_admin" name="birthdate" required />
                            </div>
                            @error('birthdate')
                                <div class="alert alert-danger">
                                    {{$message='You must be at least 18 years old.'}}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender_admin" name="gender">
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Non-binary">Non-Binary</option>
                                    <option value="Prefer not to say">Prefer not to say</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department" >Department</label>
                                <select name="department" id="department_admin" class="form-control">
                                    <option value="Administrative" selected>Administrative</option>
                                    <option value="Administrative Assistant">Administrative Assistant</option>
                                    <option value="Finance">Finance</option>
                                    <option value="HR">HR</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="civil_status">Civil Status</label>
                                <select name="civil_status" id="civil_status_admin" class="form-control">
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widow">Widow</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" id="address_admin" rows="3" required></textarea>
                            </div>
                            <div class="form-group" style="float: right;">
                                <button type="submit" class="btn btn-primary mr-2">Add</button>
                                <a href="{{ route('admin.admin-accounts') }}" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
                @include('assets.asst-loading-spinner')
            </div>
        </div>
    </section>

@endsection
