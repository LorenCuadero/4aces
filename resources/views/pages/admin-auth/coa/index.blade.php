@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="background-color: #ffff; color: #1f3c88">
                            <p class="card-title mb-3 mb-md-0" style="color:#1f3c88; padding-left:0%; font-size: 22px"><b>Counterpart</b>
                            </p>
                            <div class="d-flex flex-wrap align-items-center ml-auto">
                                <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0" style="display: flex; align-items: center;">
                                    <div class="nav-item btn btn-sm p-0" id="selectToAddStudentCounterpart"
                                        style="display: flex; align-items:center;">
                                        {{-- <a href="#" class="nav-link align-items-center btn"
                                            style="color:#ffffff; background-color:#1f3c88">Add Student</a> --}}
                                            <button type="submit" class="btn btn-primary ml-2 mr-2">Export
                                                Data</button>
                                            <button type="button" class="btn btn-default printButton"><i
                                                    class="fas fa-print"></i> Print</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                                                <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover data-table text-center">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #ffff; color: #1f3c88">Name</th>
                                            <th style="background-color: #ffff; color: #1f3c88">Batch Year</th>
                                            <th style="background-color: #ffff; color: #1f3c88">Counterpart Amount Due</th>
                                            <th style="background-color: #ffff; color: #1f3c88">Medical Share Amount Due
                                            </th>
                                            <th style="background-color: #ffff; color: #1f3c88">Personal Cash Advance Amount
                                                Due</th>
                                            <th style="background-color: #ffff; color: #1f3c88">Graduation Fee Amount Due
                                            </th>
                                            <th style="background-color: #ffff; color: #1f3c88">Total Balances
                                            </th>
                                            <th style="background-color: #ffff; color: #1f3c88">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        @forelse ($studentData as $data)
                                            <tr>
                                                <td>{{ $data['name'] }}</td>
                                                <td>{{ $data['batch_year'] }}</td>
                                                <td>{{ $data['counterpart_due_and_paid'] }}</td>
                                                <td>{{ $data['medical_share_due_and_paid'] }}</td>
                                                <td>{{ $data['personal_cash_advance_due_and_paid'] }}</td>
                                                <td>{{ $data['graduation_fee_due_and_paid'] }}</td>
                                                <td>{{ $data['total_balances'] }}</td>
                                                <td>
                                                    @if ( $data['total_balances'] == 0)
                                                        <span class="badge badge-success">Closed</span>
                                                    @else
                                                        <span class="badge badge-warning">Open</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- @include('modals.admin.mdl-student-counterpart-view')
    @include('modals.admin.mdl-student-selection') --}}
    @endsection
