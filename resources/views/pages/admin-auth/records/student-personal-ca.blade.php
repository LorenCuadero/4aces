@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between"
                        style="background-color: #ffff;">
                        <p class="card-title mb-3 mb-md-0" style=" padding-left:0%; font-size: 17px"><b>Personal Cash Advance
                                Record of:</b>
                            {{ $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name }}
                        </p>
                        <div class="d-flex flex-wrap align-items-center ml-auto">
                            <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0"
                                style="display: flex; align-items: center;">
                                <div class="nav-item btn btn-sm p-0" id="addStudentPersonalCARecordBtn"
                                    style="display: flex; align-items:center;">
                                    <a href="#" class="nav-link align-items-center btn"
                                        style="color:#ffffff; background-color:#1f3c88"><i class="fa fa-plus" style="font-size: 17px"></i> Add</a>
                                </div>
                                <div class="nav-item btn btn-sm p-0 ml-1" style="display: flex; align-items:center;">
                                    <a href="{{ route('admin.personalCA') }}" class="nav-link align-items-center btn"
                                        style="color:#ffffff; background-color:#1f3c88"><i class="far fa-arrow-alt-circle-left" style="font-size: 17px"></i> Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <input type="hidden" value="{{ $student->id }}">
                            <table class="table table-bordered table-hover data-table text-center">
                                <thead>
                                    <tr>
                                        <th style="background-color: #fff; color:#1f3c88;" class="vertical-text">Purpose
                                        </th>
                                        <th style="background-color: #fff; color:#1f3c88;" class="vertical-text">Amount Due
                                        </th>
                                        <th style="background-color: #fff; color:#1f3c88;" class="vertical-text">Amount Paid
                                        </th>
                                        <th style="background-color: #fff; color:#1f3c88;" class="vertical-text">Date</th>
                                        <th style="background-color: #fff; color:#1f3c88;" class="vertical-text"></th>
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
                                                <a href="#" id="edit-pca" data-id="{{ $personal_ca_record->id }}"
                                                    data-edit-url="{{ route('admin.updatePersonalCA', ['id' => 'personal_ca_id']) }}"
                                                    data-purpose="{{ $personal_ca_record->purpose }}"
                                                    data-amount-due="{{ $personal_ca_record->amount_due }}"
                                                    data-amount-paid="{{ $personal_ca_record->amount_paid }}"
                                                    data-date="{{ $personal_ca_record->date }}"
                                                    class="btn btn-sm edit-student-personal-ca-button"
                                                    style="background-color: #1f3c88; color: #ffff; width:50%; border-radius: 20px; margin: 2px">
                                                    <i class="far fa-edit" style="font-size: 17px"></i>
                                                    Edit
                                                </a>
                                                <a href="#" data-id="{{ $personal_ca_record->id }}"
                                                    data-delete-url="{{ route('admin.deletePersonalCA', ['id' => 'personal_ca_id']) }}"
                                                    class="btn btn-sm delete-personal-ca"
                                                    style="background-color: #dd3e3e; color: #ffff; width:50%; border-radius: 20px; margin: 2px;">
                                                    <i class="fas fa-trash-alt" style="font-size: 16px; border: 1px;"></i>
                                                    Delete
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
    @include('modals.admin.mdl-student-personal-ca-edit')
    @include('modals.admin.mdl-delete-personal-confirmation')
@endsection
