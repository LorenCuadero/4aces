@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88;"><b>Staff Account Information: Add Form</b></h1>
        {{-- <span>
            @if (session('success'))
                <p><span class="text-success success-display ml-2">[ {{ session('success') }} ]</span></p>
            @endif
            @if (session('error'))
                <p><span class="text-danger error-display ml-2">[ {{ session('error') }} ]</span></p>
            @endif
        </span> --}}
        <br>
        <div class="card">
            <div class="card-body" style="background-color: none; border: none;">

                @if ($errors->has('msg'))
                    {{ $errors->first('msg') }}
                @endif
                {{-- @include('pop-message') --}}
                <form id="add-admin-form" enctype="multipart/form-data" method="POST" action="{{ route('admin.storeStaffAccount') }}">
                    @csrf
                    {{-- @if (session('success'))
                        <script>
                            toastr.success('{{ session('success') }}');
                        </script>
                    @endif --}}

                    <div class="row" style="text-align: left;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name_staff">First Name</label>
                                <input type="text" class="form-control" id="first_name_staff" name="first_name"
                                    required autocomplete="on"/>
                            </div>
                            <div class="form-group">
                                <label for="middle_name_staff">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name_staff" name="middle_name"
                                     />
                            </div>
                            <div class="form-group">
                                <label for="last_name_staff">Last Name</label>
                                <input type="text" class="form-control" id="last_name_staff" name="last_name" required />
                            </div>
                            <div class="form-group">
                                <label for="email_staff">Email Address</label>
                                <input type="email" class="form-control" id="email_staff" name="email" required autocomplete="off"/>
                            </div>
                            @error('email')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="password_staff">Password</label>
                                <input type="text" class="form-control" id="password_staff" value="$t@ffP@$$w0rd" disabled/>
                            </div>
                            @error('password')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="contact_number_staff">Contact Number</label>
                                <input type="number" class="form-control" id="contact_number_staff" name="contact_number" />
                            </div>
                            @error('contact_number')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address_staff">Address</label>
                                <textarea name="address" class="form-control" id="address_staff" rows="3" required autocomplete="off"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="birthdate_staff">Birthdate</label>
                                <input type="date" max="{{now()->subYears(18)->format('Y-m-d')}}" class="form-control" id="birthdate_staff" name="birthdate" required />
                            </div>
                            @error('birthdate')
                                <div class="alert alert-danger">
                                    {{$message='You must be at least 18 years old.'}}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="gender_staff">Gender</label>
                                <select class="form-control" id="gender_staff" name="gender">
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Non-binary">Non-Binary</option>
                                    <option value="Prefer not to say">Prefer not to say</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department_staff" >Department</label>
                                <select name="department" id="department_staff" class="form-control">
                                    <option value="Education" selected>Education</option>
                                    <option value="IT Training">IT Training</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="civil_status_staff">Civil Status</label>
                                <select name="civil_status" id="civil_status_staff" class="form-control">
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widow">Widow</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
                            <div class="form-group" style="float: right;">
                                <button type="submit" class="btn btn-primary mr-2">Add</button>
                                <a href="{{ route('admin.staff-accounts') }}" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
                @include('assets.asst-loading-spinner')
            </div>
        </div>
    </section>

@endsection
