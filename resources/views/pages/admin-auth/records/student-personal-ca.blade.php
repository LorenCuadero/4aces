@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if ($successPCA == 1)
                        <script>
                            toastr.success("Personal Cash Advance record added and email sent successfully!");
                        </script>
                    @endif
                    @if ($successPCAUpdate == 1)
                        <script>
                            toastr.success("Personal Cash Advance  record updated and email sent successfully!");
                        </script>
                    @endif
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
                        <p class="card-title mb-3 mb-md-0" style=" padding-left:0%; font-size: 17px"><b>Personal Cash
                                Advance
                                Record of:</b>
                            {{ $student->first_name }}

                            @if ($student->middle_name && $student->middle_name != 'N/A')
                                {{ ' ' . $student->middle_name }}
                            @endif

                            {{ ' ' . $student->last_name }}
                        </p>
                        <div class="d-flex flex-wrap align-items-center ml-auto">
                            <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0"
                                style="display: flex; align-items: center;">
                                <div class="nav-item btn btn-sm p-0" id="addStudentPersonalCARecordBtn"
                                    style="display: flex; align-items:center;">
                                    <a href="#" class="nav-link align-items-center btn"
                                        style="color:#ffffff; background-color:#1f3c88"><i class="fa fa-plus"
                                            style="font-size: 17px"></i> Add</a>
                                </div>
                                <div class="nav-item btn btn-sm p-0 ml-1" style="display: flex; align-items:center;">
                                    <a href="{{ route('admin.records.personalCA') }}"
                                        class="nav-link align-items-center btn"
                                        style="color:#ffffff; background-color:#1f3c88"><i
                                            class="far fa-arrow-alt-circle-left" style="font-size: 17px"></i> Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <input type="hidden" value="{{ $student->id }}">
                            <table class="table table-hover data-table text-center" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th style="background-color: #fff; color:#1f3c88;"
                                            class="vertical-text align-middle">Purpose</th>
                                        <th style="background-color: #fff; color:#1f3c88;"
                                            class="vertical-text align-middle">Amount Due</th>
                                        <th style="background-color: #fff; color:#1f3c88;"
                                            class="vertical-text align-middle">Amount Paid</th>
                                        <th style="background-color: #fff; color:#1f3c88;"
                                            class="vertical-text align-middle">Date</th>
                                        <th style="background-color: #fff; color:#1f3c88;"
                                            class="vertical-text align-middle"></th>
                                    </tr>
                                </thead>
                                <tbody class="table-body" style="font-size: 14px; justify-content:center;">
                                    @forelse ($personal_ca_records as $personal_ca_record)
                                        <tr class="table-row">
                                            <td class="align-middle">{{ $personal_ca_record->purpose }}</td>
                                            <td class="align-middle">₱
                                                {{ number_format($personal_ca_record->amount_due, 2) }}</td>
                                            <td class="align-middle">₱
                                                {{ number_format($personal_ca_record->amount_paid, 2) }}</td>
                                            <td class="align-middle">{{ $personal_ca_record->date }}</td>
                                            <td class="align-middle">
                                                <div style="display: flex; align-items: center; justify-content:center;">
                                                    <a href="#" id="edit-pca"
                                                        data-id="{{ $personal_ca_record->id }}"
                                                        data-edit-url="{{ route('admin.updatePersonalCA', ['id' => 'personal_ca_id']) }}"
                                                        data-purpose="{{ $personal_ca_record->purpose }}"
                                                        data-amount-due="{{ $personal_ca_record->amount_due }}"
                                                        data-amount-paid="{{ $personal_ca_record->amount_paid }}"
                                                        data-date="{{ $personal_ca_record->date }}"
                                                        class="btn btn-sm edit-student-personal-ca-button"
                                                        style="color: #1f3c88; width:40%; border-radius: 20px; margin: 2px">
                                                        <strong><i class="far fa-edit" style="font-size: 17px"></i>
                                                            Edit</strong>

                                                    </a>
                                                    <a href="#" data-id="{{ $personal_ca_record->id }}"
                                                        data-delete-url="{{ route('admin.deletePersonalCA', ['id' => 'personal_ca_id']) }}"
                                                        class="btn btn-sm delete-personal-ca"
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
    @include('modals.admin.mdl-student-personal-ca-add')
    @include('modals.admin.mdl-student-personal-ca-edit')
    @include('modals.admin.mdl-delete-personal-confirmation')
@endsection
