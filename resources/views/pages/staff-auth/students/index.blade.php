@extends('layouts.staff.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        @include('assets.asst-table-headers-with-add')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-hover data-table text-center" style="font-size: 14px">
                                    <thead>
                                        <tr>
                                            {{-- <th style="background-color: #fff; color:#1f3c88" class="vertical-text">User Id
                                            </th> --}}
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Name
                                            </th>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Batch
                                                Year</th>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Joined
                                            </th>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        @forelse ($students as $student)
                                            <tr class="table-row">
                                                {{-- <td class="align-middle">{{ $student->id }}</td> --}}
                                                <td class="align-middle">
                                                    {{ ' ' . $student->last_name }},
                                                    {{ $student->first_name }}
                                                    @if ($student->middle_name != null && $student->middle_name != 'N/A')
                                                        {{ ' ' . $student->middle_name }}
                                                    @endif
                                                </td>
                                                <td class="align-middle">Batch {{ $student->batch_year }}</td>
                                                <td class="align-middle">{{ $student->joined }}</td>
                                                <td class="align-middle">
                                                    <div
                                                        style="display: flex; align-items: center; justify-content:center;">
                                                        <a href="{{ route('students-info.getStudentInfo', ['id' => $student->id]) }}"
                                                            id="edt-btn-students"
                                                            class="btn btn-sm edit-student-counterpart-button"
                                                            style="color: #1f3c88; width:40%; border-radius: 20px; margin: 2px"
                                                            data-student-id="{{ $student->id }}"
                                                            data-student-first-name="{{ $student->first_name }}"
                                                            data-student-middle-name="{{ $student->middle_name }}"
                                                            data-student-last-name="{{ $student->last_name }}"
                                                            data-student-email="{{ $student->email }}"
                                                            data-student-contact-number="{{ $student->phone }}"
                                                            data-student-birthdate="{{ $student->birthdate }}"
                                                            data-student-address="{{ $student->address }}"
                                                            data-student-guardian-name="{{ $student->parent_name }}"
                                                            data-student-guardian-contact="{{ $student->parent_contact }}"
                                                            data-student-batch-year="{{ $student->batch_year }}"
                                                            data-student-date-joined="{{ $student->date_joined }}"
                                                            data-student-url="{{ route('students-info.getStudentInfo', ['id' => $student->id]) }}">
                                                            <strong><i class="far fa-edit" style="font-size: 17px"></i>
                                                                Edit</strong>
                                                        </a>
                                                        {{-- <a href="{{ route('students-info.deletestudent', ['id' => $student->id]) }}"
                                                        class="btn btn-sm mr-1"
                                                        style="background-color:#1f3c88; color:#fff; width:40%;">
                                                        <i class="far fa-edit" style="font-size: 17px"></i>
                                                        Delete
                                                    </a> --}}
                                                        <a href="#" class="btn btn-sm delete-student"
                                                            data-id="{{ $student->id }}"
                                                            data-url="{{ route('students-info.deletestudent', ['id' => $student->id]) }}"
                                                            style="color: #dd3e3e; width:40%; border-radius: 20px; margin: 2px;">
                                                            <strong><i class="fas fa-trash-alt"
                                                                    style="font-size: 16px; border: 1px;"></i>
                                                                Delete</strong>
                                                        </a>
                                                    </div>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center">No records found.</td>
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
    @include('modals.staff.mdl-delete-student-confirmation')
@endsection
