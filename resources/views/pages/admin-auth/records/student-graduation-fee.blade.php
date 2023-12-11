@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if ($acknowledgementReceipt == 1)
                        <span class="generateReceipt"></span>
                        <input class="receipt_true" type="hidden" value="{{ $acknowledgementReceipt }}">
                        <input class="student_name" type="hidden"
                            value="{{ $student->first_name . ' ' . $student->last_name }}">
                        <input class="student_batch_year" type="hidden" value="{{ $student->batch_year }}">
                        <input class="current_user_name" type="hidden" value="{{ Auth::user()->name }}">
                        <input class="date_of_transaction" type="hidden" value="{{ $dateOfTransaction }}">
                        <input class="amount_paid_in_words" type="hidden" value="{{ $amountPaidInWords }}">
                        <input class="category" type="hidden" value="{{ $category }}">
                        <input class="amount_paid_receipt" type="hidden" value="{{ $amountPaid }}">
                        <input class="student_id_on_pc" type="hidden" value="{{ $student->id }}">
                    @endif
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between"
                        style="background-color: #ffff;">
                        <p class="card-title mb-3 mb-md-0" style=" padding-left:0%; font-size: 17px"><b>Graduation Fee
                                Record
                                of:</b>
                            {{ $student->first_name }}

                            @if ($student->middle_name && $student->middle_name != 'N/A')
                                {{ ' ' . $student->middle_name }}
                            @endif

                            {{ ' ' . $student->last_name }}
                        </p>
                        <div class="d-flex flex-wrap align-items-center ml-auto">
                            <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0"
                                style="display: flex; align-items: center;">
                                <div class="nav-item btn btn-sm p-0" id="addStudentGraduationFeeRecordRecordBtn"
                                    style="display: flex; align-items:center;">
                                    <a href="#" class="nav-link align-items-center btn"
                                        style="color:#ffffff; background-color:#1f3c88"><i class="fa fa-plus"
                                            style="font-size: 17px"></i> Add</a>
                                </div>
                                <div class="nav-item btn btn-sm p-0 ml-1" style="display: flex; align-items:center;">
                                    <a href="{{ route('admin.graduationFees') }}" class="nav-link align-items-center btn"
                                        style="color:#ffffff; background-color:#1f3c88"><i
                                            class="far fa-arrow-alt-circle-left" style="font-size: 17px"></i> Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <input type="hidden" value="{{ $student->id }}">
                            <table class="table table-bordered table-hover data-table text-center" style="font-size: 14px;">
                                <thead style="background-color: #fff; color:#1f3c88;">
                                    <tr>
                                        <th class="vertical-text" style="background-color: #fff; color:#1f3c88;">Amount Due
                                        </th>
                                        <th class="vertical-text" style="background-color: #fff; color:#1f3c88;">Amount Paid
                                        </th>
                                        <th class="vertical-text" style="background-color: #fff; color:#1f3c88;">Date</th>
                                        <th class="vertical-text" style="background-color: #fff; color:#1f3c88;"></th>
                                    </tr>
                                </thead>
                                <tbody class="table-body" style="font-size: 14px;">
                                    @forelse ($graduation_fee_records as $graduation_fee_record)
                                        <tr class="table-row">
                                            <td class="align-middle">₱
                                                {{ number_format($graduation_fee_record->amount_due, 2) }}</td>
                                            <td class="align-middle">₱
                                                {{ number_format($graduation_fee_record->amount_paid, 2) }}</td>
                                            <td class="align-middle">{{ $graduation_fee_record->date }}</td>
                                            <td class="align-middle">
                                                <div style="display: flex; align-items: center; justify-content:center;">
                                                    <a href="#" id="edit-gf"
                                                        data-id="{{ $graduation_fee_record->id }}"
                                                        data-edit-url="{{ route('admin.updateGraduationFee', ['id' => 'graduation_fee_id']) }}"
                                                        data-purpose="{{ $graduation_fee_record->purpose }}"
                                                        data-amount-due="{{ $graduation_fee_record->amount_due }}"
                                                        data-amount-paid="{{ $graduation_fee_record->amount_paid }}"
                                                        data-date="{{ $graduation_fee_record->date }}"
                                                        class="btn btn-sm edit-student-graduation-fee-button"
                                                        style="color: #1f3c88; width:40%; border-radius: 20px; margin: 2px;">
                                                        <strong><i class="far fa-edit" style="font-size: 17px"></i>
                                                            Edit</strong>
                                                    </a>
                                                    <a href="#" data-id="{{ $graduation_fee_record->id }}"
                                                        class="btn btn-sm delete-graduation-fee"
                                                        data-delete-url="{{ route('admin.deleteGraduationFee', ['id' => 'grad_id']) }}"
                                                        style="color: #dd3e3e; width:40%; border-radius: 20px; margin: 2px;">
                                                        <strong><i class="fas fa-trash-alt"
                                                                style="font-size: 16px; border: 1px;"></i>
                                                            Delete</strong>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="align-middle"></td>
                                            <td class="align-middle"></td>
                                            <td class="align-middle"></td>
                                            <td class="align-middle"></td>
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
    @include('modals.admin.mdl-student-gf-add')
    @include('modals.admin.mdl-student-graduation-fee-edit')
    @include('modals.admin.mdl-delete-graduation-confirmation')
@endsection
