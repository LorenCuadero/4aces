@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        @include('assets.asst-table-headers-with-add-ms-records')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover data-table text-center">
                                    <thead style="background-color: #ffff; color: #1f3c88">
                                        <tr>
                                            <th>Name</th>
                                            <th>Medical Concern</th>
                                            <th>Amount Due</th>
                                            <th>15% share</th>
                                            <th>Amount Paid
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <td></td>
                                        <td></td>
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
    @include('modals.admin.mdl-student-selection-for-medical')
@endsection
