@extends('layouts.admin.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3 pt-4 pb-4" style="background-color: #ffff; color: #1f3c88;">
                            <h1 class="card-title"><b>Users Activity Log Records</b></h1>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <div class="p-2">
                                <table id="logs-table" class="table table-hover text-nowrap data-table text-center" style="font-size: 14px;">
                                    <thead style="font-size: 14px; color:#1f3c88">
                                        <tr>
                                            <th>Log Id</th>
                                            <th>Name</th>
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
                                                <td>
                                                    @if (isset($log->user))
                                                        {{ $log->user->name }}
                                                    @else
                                                        <span>n/a</span>
                                                    @endif
                                                </td>
                                                <td>{{ $log->action }}</td>
                                                <td>{{ $log->record }}</td>
                                                <td>
                                                    @if (isset($log->student_id))
                                                        @if (isset($log->student->first_name))
                                                            {{ $log->student->first_name . ' ' . $log->student->last_name }}
                                                        @endif
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
