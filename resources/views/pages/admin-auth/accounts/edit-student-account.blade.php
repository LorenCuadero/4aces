@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-body" style="background-color: none; border: none;">
                <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88;"><b>Student Account Information: Update Account</b>
                </h1>
                <br>
                <hr>
                @if ($errors->has('msg'))
                    {{ $errors->first('msg') }}
                @endif

                <form method="POST" action="{{ route('admin.updateStudentAccount', ['id' => $user->user_id]) }}">
                    @method('PUT')
                    @csrf
                    <div class="row" style="text-align: left;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name_student">First Name</label>
                                <input type="text" class="form-control" id="first_name_student" name="first_name"
                                    value="{{ $user->first_name }}" autocomplete="on" />
                            </div>
                            <div class="form-group">
                                <label for="middle_name_student">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name_student" name="middle_name"
                                    value="{{ $user->middle_name }}" />
                            </div>
                            <div class="form-group">
                                <label for="last_name_student">Last Name</label>
                                <input type="text" class="form-control" id="last_name_student" name="last_name"
                                    value="{{ $user->last_name }}" />
                            </div>
                            <div class="form-group">
                                <label for="suffix_student">Suffix</label>
                                <select class="form-control" id="suffix_student" name="suffix">
                                    <option value="" @if ($user->status == null || $user->status == 'None') selected @endif>Select Suffix</option>
                                    <option value="Jr." @if ($user->status == 'Jr.') selected @endif>Jr.</option>
                                    <option value="II" @if ($user->status == 'II') selected @endif>II</option>
                                    <option value="III" @if ($user->status == 'III') selected @endif>III</option>
                                    <option value="IV" @if ($user->status == 1) selected @endif>IV</option>
                                </select>
                            </div>
                            @error('suffix')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="gender_student">Gender</label>
                                <select class="form-control" id="gender_student" name="gender">
                                    <option value="{{ $user->gender }}">{{ $user->gender }}</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Non-binary">Non-Binary</option>
                                    <option value="Prefer not to say">Prefer not to say</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_student">Email Address</label>
                                <input type="email" class="form-control" id="email_student" name="email"
                                    value="{{ $user->email }}" autocomplete="on" />
                            </div>
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="contact_number_student">Contact Number</label>
                                <input type="number" class="form-control" id="contact_number_student" name="contact_number"
                                    value="{{ $user->contact_number }}" />
                            </div>
                            <div class="form-group">
                                <label for="address_student">Address</label>
                                <input name="address" class="form-control" id="address_student"
                                    value="{{ $user->address }}" autocomplete="on" />
                            </div>
                            @error('address')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="birthdate_student">Birthdate</label>
                                <input type="date" max="{{ now()->subYears(18)->format('Y-m-d') }}" class="form-control"
                                    id="birthdate_student" name="birthdate" value="{{ $user->birthdate }}" />
                            </div>
                            @error('birthdate')
                                <div class="alert alert-danger">
                                    {{ $message = 'You must be at least 18 years old.' }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="parent_name_student">Parent's / Guardian's Name</label>
                                <input type="text" class="form-control" id="parent_name_student" name="parent_name"
                                    value="{{ $user->parent_name }}" />
                            </div>
                            @error('parent_name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="parent_contact_student">Parent's / Guardian's Contact Number</label>
                                <input type="number" class="form-control" id="parent_contact_student"
                                    name="parent_contact" value="{{ $user->parent_contact }}" />
                            </div>
                            @error('parent_contact')
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
                                        <option value="{{ $year }}"
                                            {{ $user->batch_year == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
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
                                <input type="date" class="form-control" id="joined_student" name="joined"
                                    value="{{ $user->joined }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                            </div>
                            @error('batch_year')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br>
                            <div class="form-group" style="float: right">
                                <button type="submit" class="btn btn-primary mr-2">Save changes</button>
                                <button type="button" class="btn btn-danger mr-2" data-toggle="modal"
                                    data-target="#confirmDeleteModal">Delete</button>
                                <a href="{{ route('admin.accounts.student-accounts') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Modal for confirming delete action -->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                    aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this account?
                            </div>
                            <div class="modal-footer">
                                <form method="POST"
                                    action="{{ route('admin.softDeleteStudentAccount', ['id' => $user->user_id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <div class="form-group">
                                        <a href="{{ route('admin.accounts.student-accounts') }}"
                                            class="btn btn-default mr-2">Cancel</a>
                                        <!-- Delete button in the modal -->
                                        <button type="submit" class="btn btn-danger" data-toggle="modal"
                                            data-target="#confirmDeleteModal">Confirm Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @include('assets.asst-loading-spinner')
            </div>
        </div>
    </section>
@endsection
