@extends('layouts.staff.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="table">
                    <div class="card">
                        @include('assets.asst-table-headers')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover data-table text-center">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #fff; color:#1f3c88"  class="vertical-text">User Id</th>
                                            <th style="background-color: #fff; color:#1f3c88"  class="vertical-text">Name</th>
                                            <th style="background-color: #fff; color:#1f3c88"  class="vertical-text">Batch Year</th>
                                            <th style="background-color: #fff; color:#1f3c88"  class="vertical-text">GWA</th>
                                            <th style="background-color: #fff; color:#1f3c88"  class="vertical-text">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        @forelse ($students as $student)
                                            <tr class="table-row">
                                                <td>{{ $student->id }}</td>
                                                <td>{{ $student->first_name }}

                                                    @if ($student->middle_name && $student->middle_name != 'N/A')
                                                        {{ ' ' . $student->middle_name }}
                                                    @endif

                                                    {{ ' ' . $student->last_name }}
                                                </td>
                                                <td>Batch {{ $student->batch_year }}</td>
                                                <td>{{ $student->gwa }}</td>
                                                <td>
                                                    <a href="{{ route('rpt.acd.getStudentGradeReport', ['id' => $student->id]) }}"
                                                        class="btn btn-sm" id="grade-button"
                                                        style="background-color: #1f3c88; color: #ffff; width:50%; border-radius: 20px; margin: 2px">
                                                        <i class="fa-solid fa-book mr-1" style="17px"></i> Grade
                                                    </a>
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
    </section>
    {{-- <cmpt-student-acd-rpt></cmpt-student-acd-rpt> --}}
@endsection
