@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if ($acknowledgementReceipt == 1)
                        <span id="generateReceipt"></span>
                        <input id="receipt_true" type="hidden" value="{{ $acknowledgementReceipt }}">
                        <input id="student_name" type="hidden"
                            value="{{ $student->first_name . ' ' . $student->last_name }}">
                        <input id="student_batch_year" type="hidden" value="{{ $student->batch_year }}">
                        <input id="current_user_name" type="hidden" value="{{ Auth::user()->name }}">
                        <input id="date_of_transaction" type="hidden" value="{{ $dateOfTransaction }}">
                        <input id="amount_paid_in_words" type="hidden" value="{{ $amountPaidInWords }}">
                        <input id="category" type="hidden" value="{{ $category }}">
                        <input id="amount_paid_receipt" type="hidden" value="{{ $amountPaid }}">
                        <input id="student_id_on_pc" type="hidden" value="{{ $student->id }}">
                    @endif
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between"
                        style="background-color: #ffff;">
                        <p class="card-title mb-3 mb-md-0" style=" padding-left:0%; font-size: 17px"><b>Parents
                                Counterpart Record of:</b>
                            {{ $student->first_name }}

                            @if ($student->middle_name && $student->middle_name != 'N/A')
                                {{ ' ' . $student->middle_name }}
                            @endif

                            {{ ' ' . $student->last_name }}
                        </p>
                        <div class="d-flex flex-wrap align-items-center ml-auto">
                            <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0"
                                style="display: flex; align-items: center;">
                                <div class="nav-item btn btn-sm p-0" id="addStudentCounterpartRecordBtn"
                                    style="display: flex; align-items:center;" data-target="add-student-grd-modal"
                                    data-toggle="modal">
                                    <a href="#" class="nav-link align-items-center btn"
                                        style="color:#ffffff; background-color:#1f3c88"><i class="fa fa-plus"
                                            style="font-size: 17px"></i> Add</a>
                                </div>
                                <div class="nav-item btn btn-sm p-0 ml-1" style="display: flex; align-items:center;">
                                    <a href="{{ route('admin.counterpartRecords') }}"
                                        class="nav-link align-items-center btn"
                                        style="color:#ffffff; background-color:#1f3c88"><i
                                            class="far fa-arrow-alt-circle-left" style="font-size: 17px"></i> Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover data-table text-center">
                                <thead>
                                    <tr>
                                        <th style="background-color: #fff; color:#1f3c88;" class="vertical-text">Month</th>
                                        <th style="background-color: #fff; color:#1f3c88;" class="vertical-text">Year</th>
                                        <th style="background-color: #fff; color:#1f3c88;" class="vertical-text">Amount Due
                                        </th>
                                        <th style="background-color: #fff; color:#1f3c88;" class="vertical-text">Amount Paid
                                        </th>
                                        <th style="background-color: #fff; color:#1f3c88;" class="vertical-text">Date</th>
                                        <th style="background-color: #fff; color:#1f3c88;" class="vertical-text"></th>
                                    </tr>
                                </thead>
                                @forelse ($student_counterpart_records as $counterpart)
                                    <tr class="table-row align-middle">
                                        <td>{{ $months[$counterpart->month] }}</td>
                                        <td>{{ $counterpart->year }}</td>
                                        <td>{{ $counterpart->amount_due }}</td>
                                        <td>{{ $counterpart->amount_paid }}</td>
                                        <td>{{ $counterpart->date }}</td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; flex-direction: column; align-items: center;">
                                                <a href="#" id="edit" data-id="{{ $counterpart->id }}"
                                                    data-month="{{ $counterpart->month }}"
                                                    data-edit-url="{{ route('admin.updateCounterpart', ['id' => 'counterpart_id']) }}"
                                                    data-year="{{ $counterpart->year }}"
                                                    data-amount-due="{{ $counterpart->amount_due }}"
                                                    data-amount-paid="{{ $counterpart->amount_paid }}"
                                                    data-date="{{ $counterpart->date }}"
                                                    class="btn btn-sm edit-student-counterpart-button"
                                                    style="background-color: #1f3c88; color: #ffff; width:50%; border-radius: 20px; margin: 2px">
                                                    <i class="far fa-edit" style="font-size: 17px"></i>
                                                    Edit
                                                </a>
                                                <a href="#" data-id="{{ $counterpart->id }}"
                                                    data-delete-url="{{ route('admin.deleteCounterpart', ['id' => 'counterpart_id']) }}"
                                                    class="btn btn-sm delete-counterpart"
                                                    style="background-color: #dd3e3e; color: #ffff; width:55%; border-radius: 20px; margin: 2px;">
                                                    <i class="fas fa-trash-alt" style="font-size: 16px; border: 1px;"></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
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
    </section>
    @include('modals.admin.mdl-student-counterpart-add')
    @include('modals.admin.mdl-student-counterpart-edit')
    @include('modals.admin.mdl-delete-counterpart-confirmation')
@endsection
