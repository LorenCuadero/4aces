@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                        <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88;">
                            <b>Personal Record of:</b>
                            {{ $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name }}
                        </h1>
                        <br>
                        <div class="d-flex flex-wrap align-items-center ml-auto">
                            <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0">
                                <div class="nav-item btn btn-sm" id="addStudentPersonalCARecordBtn"
                                    style="display: flex; align-items:center; height: 38px; margin-left: 4px;"
                                    data-target="add-student-grd-modal" data-toggle="modal">
                                    <a class="nav-link align-items-center"
                                        style="color:#fff;height: 100%; display: flex; align-items: center;">Add</a>
                                </div>
                                <div class="nav-item btn btn-sm" id="back"
                                    style="display: flex; align-items:center; height: 38px; margin-left: 4px;">
                                    <a href="{{ route('admin.personalCA') }}" class="nav-link align-items-center"
                                        style="color:#fff;height: 100%; display: flex; align-items: center;">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <input type="hidden" value="{{ $student->id }}">
                            <table class="table table-bordered table-hover data-table text-center">
                                <thead style="background-color: #fff; color:#1f3c88;">
                                    <tr>
                                        <th class="vertical-text">Purpose</th>
                                        <th class="vertical-text">Amount Due</th>
                                        <th class="vertical-text">Amount Paid</th>
                                        <th class="vertical-text">Date</th>
                                        <th class="vertical-text"></th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @forelse ($personal_ca_records as $personal_ca_record)
                                        <tr class="table-row">
                                            <td>{{ $personal_ca_record->purpose }}</td>
                                            <td>{{ $personal_ca_record->amount_due }}</td>
                                            <td>{{ $personal_ca_record->amount_paid }}</td>
                                            <td>{{ $personal_ca_record->date }}</td>
                                            <td>
                                                <a href="{{ route('admin.storeCounterpart', ['id' => $student->id]) }}"
                                                    id="grade-button" class="btn btn-sm">
                                                    Edit
                                                </a>
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
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('modals.admin.mdl-student-personal-ca-add')
@endsection
