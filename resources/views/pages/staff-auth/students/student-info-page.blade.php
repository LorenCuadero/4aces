@extends('layouts.staff.app')

@push('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush

@section('content')
    <section class="content">
        <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88;"><b>Student Information</b></h1>
        <br>
        <div class="card">
            <div class="card-body" style="background-color: none; border: none;">
                <form id="frmTest" enctype="multipart/form-data" style="background-color: none; border: none;">
                    <input type="hidden" id="id" name="id" />
                    <div class="row" style="text-align: left;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required />
                            </div>
                            <div class="form-group">
                                <label for="parent_name">Parent's / Guardian's Name</label>
                                <input type="text" class="form-control" id="parent_name" name="parent_name" required />
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" required />
                            </div>
                            <div class="form-group">
                                <label for="parent_contact">Parent's / Guardian's Contact Number</label>
                                <input type="text" class="form-control" id="parent_contact" name="parent_contact"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required />
                            </div>
                            <div class="form-group">
                                <label for="batch_year">Batch Year</label>
                                <input type="number" class="form-control" id="batch_year" name="batch_year" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="joined">Date Joined</label>
                                <input type="text" class="form-control" id="joined" name="joined" required />
                            </div>
                            <div class="form-group">
                                <label for="phone">Contact Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" required />
                            </div>
                            <div class="form-group">
                                <label for="payable_status">Payable Status</label>
                                <select name="payable_status" class="form-control" id="payable_status" required>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" required />
                            </div>
                            <div class="form-group">
                                <label for="account_status">Account Status</label>
                                <select name="account_status" class="form-control" id="account_status" required>
                                    <option value="active">Active</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" id="address" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('words.SaveChanges') }}</button>
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ __('words.Close') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
