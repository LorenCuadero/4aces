@extends('layouts.staff.app')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <h1 class="card-title mb-3 mb-md-0" style="color:#1f3c88; padding: 2%; padding-left:0%"><b>Students List</b>
                    </h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex flex-wrap align-items-center ml-auto">
                                <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0">
                                    <input id="searchInput" class="form-control mr-sm-1" type="search"
                                        placeholder="Search record here" aria-label="Search">
                                    <a id="add-btn" class="btn btn-primary btn-sm" href="#" data-toggle="modal"
                                        data-target="#addModal" alt="Add person"
                                        style="margin: 0%;
                                        padding: 5.5px 6px;
                                        font-size: 16px;">
                                        <i class="fas fa-user-plus"></i>Add </a>
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
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- @include('modals.staff.mdl-staff-edit') --}}
@endsection
