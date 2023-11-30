@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3 pt-4 pb-4" style="background-color: #ffff; color: #1f3c88;">
                            <h1 class="card-title"><b>Admin Accounts (Total: {{$users->total()}})</b></h1>
                            <div class="card-tools">
                                <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0">
                                    <div class="nav-item btn btn-sm"
                                        style="display: flex; align-items:center; height: 38px; background-color: #1f3c88; color:#fff;"
                                        data-target="add-student-grd-modal" data-toggle="modal">
                                        <a class="nav-link align-items-center"
                                            href="{{ route('admin.createAdminAccount') }}"
                                            style="text-decoration: none; color:#fff">Add</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <form method="" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ Request::get('name') }}" placeholder="Search Name" autocomplete="name">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control" id="email" name="email" value="{{ Request::get('email') }}" placeholder="Search Email" autocomplete="on">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <input type="date" class="form-control" id="date" name="date" value="{{ Request::get('date') }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ route('admin.admin-accounts')}}" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                        <div class="card-body table-responsive p-0">
                            <div class="p-2">
                                <table class="table table-hover text-nowrap text-left">
                                    <thead>
                                        <tr>
                                            <th style="display:none;">ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Email Verified At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td style="display:none;">{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->department }}</td>
                                                {{-- <td class="truncate">{{ $user->password }}</td> --}}
                                                <td>{{ $user->email_verified_at }}</td>
                                                <td>
                                                    @if ($user->email_verified_at != null)
                                                        <span class="btn badge-success rounded">Active</span>
                                                    @else
                                                        <span class="btn badge-warning rounded">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.getAdminAccount', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
                                                    <a href="{{ route('admin.deleteAdminAccount', ['id' => $user->id]) }}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding:10px; float:right;">
                                    {!! $users->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
