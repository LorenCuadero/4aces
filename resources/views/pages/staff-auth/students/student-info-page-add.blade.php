@extends('layouts.staff.app')
@section('content')
    <span class="text-left">
        @if (session('success-add-student'))
            <p><span class="text-success success-display ml-2">[ {{ session('success-add-student') }} ]</span></p>
        @endif
        @if (session('error-add-student'))
            <p><span class="text-danger error-display ml-2">[ {{ session('error') }} ]</span></p>
        @endif
        @if (session('info'))
            <p><span class="text-info error-display ml-2">[ {{ session('info') }} ]</span></p>
        @endif
    </span>
    <section class="content">
        <div class="card">
            <br>
            <div class="card-body" style="background-color: none; border: none;">
                <h1 class="card-title" style="color:#1f3c88;"><b>Student Information: Add Form</b></h1>
                <br>
                <form id="edit-form" enctype="multipart/form-data" method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <div class="row" style="text-align: left;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required />
                            </div>
                            <div class="form-group">
                                <label for="second_name">Second Name</label>
                                <input type="text" class="form-control" id="second_name" name="second_name" />
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name" />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required />
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
                                <label for="phone">Contact Number</label>
                                <input type="number" class="form-control" id="phone" name="phone" />
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" required />
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="parent_name">Parent's / Guardian's Name</label>
                                <input type="text" class="form-control" id="parent_name" name="parent_name" required />
                            </div>
                            <div class="form-group">
                                <label for="parent_contact">Parent's / Guardian's Contact Number</label>
                                <input type="number" class="form-control" id="parent_contact" name="parent_contact" />
                            </div>
                            <div class="form-group">
                                <label for="batch_year">Batch Year</label>
                                <input type="number" class="form-control" id="batch_year" name="batch_year" required />
                            </div>
                            <div class="form-group">
                                <label for="joined">Date Joined</label>
                                <input type="date" class="form-control" id="joined" name="joined" required />
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" id="address" rows="3" required></textarea>
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
