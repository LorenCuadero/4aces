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
                                <table id="example2" class="table table-hover data-table text-center" style="font-size: 14px">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Name
                                            </th>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Batch
                                                Year</th>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">GWA</th>
                                            <th style="background-color: #fff; color:#1f3c88" class="vertical-text">Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        @forelse ($students as $student)
                                            <tr class="table-row">
                                                <td class="align-middle">
                                                    {{ $student->last_name }},
                                                    {{ $student->first_name }}
                                                    @if (($student->middle_name && $student->middle_name != 'N/A') && ($student->middle_name && $student->middle_name != 'n/a'))
                                                        {{ ' ' . $student->middle_name }}
                                                    @endif
                                                </td>
                                                <td class="align-middle">Batch {{ $student->batch_year }}</td>
                                                <td class="align-middle">{{ $student->gwa }}</td>
                                                <td class="align-middle">
                                                    <a href="{{ route('rpt.acd.getStudentGradeReport', ['id' => $student->id]) }}"
                                                        class="btn btn-sm" id="grade-button"
                                                        style="color: #1f3c88;width:70%; border-radius: 20px; margin: 2px">
                                                        <strong><i class="fa-solid fa-book mr-1" style="17px"></i> Grade</strong>
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
@endsection
