@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88;"><b>Staff Account Information: Update Account</b></h1>
        <br>
        {{-- <span>
            @if (session('success'))
                <p><span class="text-success success-display ml-2"> {{ session('success') }} </span></p>
            @endif
            @if (session('error'))
                <p><span class="text-danger error-display ml-2"> {{ session('error') }} </span></p>
            @endif
        </span> --}}
        <div class="card">
            <div class="card-body" style="background-color: none; border: none;">

                @if ($errors->has('msg'))
                    {{ $errors->first('msg') }}
                @endif

                <form method="POST" action="{{ route('admin.updateStaffAccount', ['id' => $user->user_id]) }}">
                    @method('PUT')
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
                                    value="{{ $user->first_name }}" autocomplete="on" />
                            </div>
                            <div class="form-group">
                                <label for="middle_name_staff">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name_staff" name="middle_name"
                                    value="{{ $user->middle_name }}" />
                            </div>
                            <div class="form-group">
                                <label for="last_name_staff">Last Name</label>
                                <input type="text" class="form-control" id="last_name_staff" name="last_name"
                                    value="{{ $user->last_name }}" />
                            </div>
                            <div class="form-group">
                                <label for="email_staff">Email Address</label>
                                <input type="email" class="form-control" id="email_staff" name="email"
                                    value="{{ $user->email }}" autocomplete="on" />
                            </div>
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="password_staff">Password</label>
                                <input type="text" class="form-control" id="password_staff" name="password" />
                            </div>
                            <div class="form-group">
                                <label for="contact_number_staff">Contact Number</label>
                                <input type="number" class="form-control" id="contact_number_staff" name="contact_number"
                                    value="{{ $user->contact_number }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address_staff">Address</label>
                                <input name="address" class="form-control" id="address_staff" value="{{ $user->address }}"
                                    autocomplete="on" />
                            </div>
                            <div class="form-group">
                                <label for="birthdate_staff">Birthdate</label>
                                <input type="date" max="{{ now()->subYears(18)->format('Y-m-d') }}" class="form-control"
                                    id="birthdate_staff" name="birthdate" value="{{ $user->birthdate }}" />
                            </div>
                            @error('birthdate')
                                <div class="alert alert-danger">
                                    {{ $message = 'You must be at least 18 years old.' }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="gender_staff">Gender</label>
                                <select class="form-control" id="gender_staff" name="gender">
                                    <option value="{{ $user->gender }}">{{ $user->gender }}</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Non-binary">Non-Binary</option>
                                    <option value="Prefer not to say">Prefer not to say</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department_staff">Department</label>
                                <select name="department" id="department_staff" class="form-control">
                                    <option value="{{ $user->department }}">{{ $user->department }}</option>
                                    <option value="Administrative">Administrative</option>
                                    <option value="Administrative Assistant">Administrative Assistant</option>
                                    <option value="Finance">Finance</option>
                                    <option value="HR">HR</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="civil_status_staff">Civil Status</label>
                                <select name="civil_status" id="civil_status_staff" class="form-control">
                                    <option value="{{ $user->civil_status }}">{{ $user->civil_status }}</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widow">Widow</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
                            <div class="form-group" style="float: right;">
                                <button type="submit" class="btn btn-primary mr-2">Save changes</button>
                                <a href="{{ route('admin.staff-accounts') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
                @include('assets.asst-loading-spinner')
            </div>
        </div>
    </section>
@endsection
