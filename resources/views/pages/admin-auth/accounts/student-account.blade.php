@extends('layouts.admin.app')
{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3 pt-4 pb-4  custom-admin-accounts-header"
                            style="background-color: #ffff; color: #1f3c88;">
                            <h3 class="card-title"><b>Student Accounts (Total: {{ $users->total() }})</b></h3>
                            <div class="card-tools admin-accounts">
                                <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0">
                                    <div class="nav-item btn btn-sm"
                                        style="display: flex; align-items:center; height: 38px; background-color: #1f3c88; color:#fff;">
                                        <a class="nav-link align-items-center"
                                            href="{{ route('admin.createStudentAccount') }}"
                                            style="text-decoration: none; color:#fff"><i class="fas fa-user-plus"></i> Add
                                            Student</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <form method="" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3 admin-accounts-search-input">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ Request::get('name') }}" placeholder="Search Name"
                                            autocomplete="name">
                                    </div>

                                    <div class="form-group col-md-3 admin-accounts-search-input">
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ Request::get('email') }}" placeholder="Search Email"
                                            autocomplete="on">
                                    </div>

                                    <div class="form-group col-md-3 admin-accounts-search-input">
                                        <input type="date" class="form-control" id="date" name="date"
                                            value="{{ Request::get('date') }}">
                                    </div>

                                    <div class="form-group col-md-1 admin-accounts-search-input">
                                        <select class="form-control" name="entries" id="entries"
                                            onchange="this.form.submit()">
                                            <option value="10" {{ $entriesPerPage == 10 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ $entriesPerPage == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ $entriesPerPage == 50 ? 'selected' : '' }}>50</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2 admin-accounts-search-input">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ route('admin.student-accounts') }}" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                        <div class="card-body table-responsive p-0">
                            <div class="p-0">
                                <table class="table table-hover text-nowrap text-left admin-accounts-table">
                                    <thead>
                                        <tr>
                                            <th style="display:none;">ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Suffix</th>
                                            <th>Email</th>
                                            <th>Batch</th>
                                            <th>Parent's Contact</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        use Illuminate\Support\Str;
                                    @endphp
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td style="display:none;">{{ $user->id }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->suffix ?? ' ' }}</td>
                                                <td>{{ Str::limit($user->email, 30) }}</td>
                                                <td>{{ $user->batch_year }}</td>
                                                {{-- <td class="truncate">{{ $user->password }}</td> --}}
                                                <td>{{ $user->parent_contact }}</td>
                                                <td class="admin-accounts-mobile-btn">
                                                    @if ($user->status == 0)
                                                        <span class="btn badge-success rounded">Active</span>
                                                    @else
                                                        <span class="btn badge-warning rounded">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="admin-accounts-mobile-btn">
                                                    <a href="{{ route('admin.getStudentAccount', ['id' => $user->user_id]) }}"
                                                        class="btn btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding:10px; float:right;">
                                    {!! $users->appends(['entries' => $entriesPerPage])->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
