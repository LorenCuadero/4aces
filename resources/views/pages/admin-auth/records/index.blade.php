@extends('layouts.common.app')

@section('content')
@section('has-vue', '')
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div>
                    <h2>{{ __('words.EmployeeManagement') }}</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-1">
                                <div>
                                    <button id="addEmployeBtn" type="button" class="btn btn-primary w-auto" data-toggle="modal" data-target="#addEmployeeModal">
                                        <span class=""><i class="fas fa-plus"></i></span> {{ __('words.Add') }}
                                    </button>
                                </div>
                            </div>
                            <table id="employee_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('words.EmployeeId') }}</th>
                                        <th class="text-center">{{ __('words.EmployeeName') }}</th>
                                        <th class="text-center">{{ __('words.JobTitles') }}</th>
                                        <th class="text-center">{{ __('words.EmployeeInfo') }}</th>
                                        <th class="text-center">{{ __('words.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->person->first_name }} {{ $employee->person->last_name }}</td>
                                        <td>
                                            <ul class="text-left">
                                                @foreach ($employee->employeeJobTitles as $employeeJobTitle)
                                                <li>{{ $employeeJobTitle->jobTitle->job_title_name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="/employees/{{ $employee->id }}/person">
                                                <button class="btn btn-link">
                                                    {{ __('words.ViewInfo') }}
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group d-flex">
                                                <a href="{{ route('employee.management.edit', ['employee' => $employee->id]) }}">
                                                    <button class="btn btn-info btn-sm mb-1 edit-button" type="button">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        {{ __('words.Edit') }}
                                                    </button>
                                                </a>&nbsp;&nbsp;
                                                <a>
                                                    <button class="btn btn-danger btn-sm delete-employee-btn" type="button" data-employee-id="{{$employee->id}}">
                                                        <i class="fas fa-trash"></i>
                                                        {{ __('words.Remove') }}
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            {{ $data->appends(['page' => $data->currentPage()])->onEachSide(1)->links('pagination::bootstrap-4') }}
            <div class="text-muted">
                {{ __('words.Showing') }} {{ $data->firstItem() }} {{ __('words.To') }} {{ $data->lastItem() }} {{ __('words.Of') }} {{ $data->total() }} {{ __('words.Entries') }}
            </div>
        </div>
    </section>
    @include('modals.common.employee-info')
    <add-employee-modal></add-employee-modal>
    @include('modals.common.delete-confirmation')
</div>
@endsection
