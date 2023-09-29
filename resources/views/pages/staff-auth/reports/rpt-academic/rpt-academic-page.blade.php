@extends('layouts.staff.app')
@push('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88; padding: 2%; padding-left:0%"><b>Academic
                        Reports</b>
                    </h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        <div class="d-flex flex-wrap align-items-center ml-auto">
                            <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0"
                                style="display: flex; align-items: center;">
                                <div style="display: flex; align-items: center; height: 38px;">
                                    <input id="searchInput" class="form-control mr-sm-1" type="search"
                                        placeholder="Search record here" aria-label="Search"
                                        style="height: 100%; width: 200px;">
                                </div>
                                <div class="nav-item dropdown show btn btn-sm" id="batch-year-dropdown"
                                    style="display: flex; align-items:center; height: 38px;">
                                    <a class="nav-link dropdown-toggle align-items-center" data-toggle="dropdown"
                                        href="#" role="button" aria-haspopup="true" aria-expanded="true"
                                        style="color:#fff;height: 100%; display: flex; align-items: center;">Batch
                                        Year</a>
                                    <div class="dropdown-menu mt-0" style="left: 0px; right: inherit;">
                                        <a class="dropdown-item" href="#" data-widget="iframe-close"
                                            data-type="all">Batch 2025</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close"
                                            data-type="all-other">Batch 2024</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close">Batch
                                            2023</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close">Batch
                                            2022</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close">Batch
                                            2021</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close">Batch
                                            2020</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close">Batch
                                            2019</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close">Batch
                                            2018</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close">Batch
                                            2017</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close">Batch
                                            2016</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close">Batch
                                            2015</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close">Batch
                                            2014</a>
                                    </div>
                                </div>
                                <div class="nav-item dropdown show btn btn-sm" id="batch-year-dropdown"
                                    style="display: flex; align-items:center; height: 38px; margin-left: 4px;">
                                    <a class="nav-link dropdown-toggle align-items-center" data-toggle="dropdown"
                                        href="#" role="button" aria-haspopup="true" aria-expanded="true"
                                        style="color:#fff;height: 100%; display: flex; align-items: center;">Order
                                        By</a>
                                    <div class="dropdown-menu mt-0" style="left: 0px; right: inherit;">
                                        <a class="dropdown-item" href="#" data-widget="iframe-close"
                                            data-type="all">Ascending Order</a>
                                        <a class="dropdown-item" href="#" data-widget="iframe-close"
                                            data-type="all-other">Descending Order</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="vertical-text">User Id</th>
                                        <th class="vertical-text">Name</th>
                                        <th class="vertical-text">Batch Year</th>
                                        <th class="vertical-text">GPA</th>
                                        <th class="vertical-text">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->batch_year }}</td>
                                            <td>{{ $student->gpa }}</td>
                                            <td>
                                                <a href="" id="grade-button" class="btn btn-success btn-sm"
                                                    data-toggle="modal" data-student-id="{{ $student->id }}"
                                                    data-target="#editModal">
                                                    GRADE
                                                </a>
                                                {{-- <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form> --}}
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
    {{-- <cmpt-staff-add></cmpt-staff-add>
<cmpt-staff-edit></cmpt-staff-edit>
@include('pages.staff-auth.students.stds-frm-dtls-page') --}}
@endsection
