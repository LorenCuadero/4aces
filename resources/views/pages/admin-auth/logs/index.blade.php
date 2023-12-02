@extends('layouts.admin.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3 pt-4 pb-4" style="background-color: #ffff; color: #1f3c88;">
                            <h1 class="card-title"><b>Users Activity Log Records</b></h1>
                            <div class="card-tools">
                                <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0"
                                    style="display: flex; align-items: center;">
                                    <div class="nav-item btn btn-sm p-0" style="display: flex; align-items:center;">
                                        <button type="button" class="btn btn-default printButtonOnLogs"><i
                                                class="fas fa-print"></i> Print</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <div class="p-2">
                                <table id="logs-table" class="table table-hover text-nowrap data-table text-center">
                                    <thead style="font-size: 14px;">
                                        <tr>
                                            <th>Log Id</th>
                                            <th>User Id</th>
                                            <th>Action</th>
                                            <th>Category</th>
                                            <th>Affected Student</th>
                                            <th>Affected Staff</th>
                                            <th>Batch Year</th>
                                            <th>When</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($logs as $log)
                                            <tr>
                                                <td>{{ $log->id }}</td>
                                                <td>{{ $log->user_id }}</td>
                                                <td>{{ $log->action }}</td>
                                                <td>{{ $log->record }}</td>
                                                <td>
                                                    @if (isset($log->student_id))
                                                        {{ $log->student->first_name . ' ' . $log->student->last_name }}
                                                    @else
                                                        <span>n/a</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($log->staff_id))
                                                        {{ $log->staff_id }}
                                                    @else
                                                        <span>n/a</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($log->year))
                                                        {{ $log->year }}
                                                    @else
                                                        <span>n/a</span>
                                                    @endif
                                                </td>
                                                <td>{{ $log->created_at }}</td>
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
@endsection
