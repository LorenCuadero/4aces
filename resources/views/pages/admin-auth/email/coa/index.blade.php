@extends('layouts.admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (session('success'))
                    <p><span class="text-success success-display ml-2">[ {{ session('success') }} ]</span></p>
                @endif
                @if (session('error'))
                    <p><span class="text-danger error-display ml-2">[ {{ session('error') }} ]</span></p>
                @endif
                <div class="col-12" id="table">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between"
                        style="color: #1f3c88; background-color:#ffffff">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-title mb-3 mb-md-0"
                                        style="color:#1f3c88; padding-left:0%; font-size: 22px"><b>Email Generator: Closing
                                            of Accounts
                                            Letter</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="send-coa-email-form" enctype="multipart/form-data" method="POST"
                                action="{{ route('admin.sendCoa') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        <div class="flex-wrap align-items-center ml-auto">
                                            <div class="row">
                                                <div class="col-md-12 text-left align-middle" style="padding-left: 2%">
                                                    <div class="d-flex align-items-center justify-content">
                                                        <div class="d-flex align-items-center mr-0">
                                                            <p class="mt-2"><b style="color:#1f3c88;">To
                                                                    Batch:
                                                                </b>
                                                            </p> <span> </span>
                                                        </div>
                                                        <div class="nav-item dropdown show btn btn-sm batch-year-dropdown selections"
                                                            style="display: flex; align-items: center; background-color: #ffff; border: 1px solid #ced4da;">
                                                            <a class="nav-link dropdown-toggle align-items-center"
                                                                data-toggle="dropdown" href="#" role="button"
                                                                aria-haspopup="true" aria-expanded="true"
                                                                style="color:#495057;height: 100%; display: flex; align-items: center; padding-left: 2%;">
                                                                {{ $selectedBatchYear ?? 'Year' }}
                                                            </a>
                                                            <div class="dropdown-menu mt-0"
                                                                style="left: 0px; right: inherit;">
                                                                @foreach ($students->pluck('batch_year')->unique() as $year)
                                                                    <a class="dropdown-item" href="#"
                                                                        data-widget="iframe-close">{{ $year }}</a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content">
                                                        <div class="align-middle">
                                                            <p class="mt-2"><b style="color:#1f3c88;">Set
                                                                    Graduation Date: </b>
                                                                <input class="selections"
                                                                    style="color:#495057; width: 120px; padding: 6px;     height: 38px;"
                                                                    type="date" id="graduation_date"
                                                                    name="graduation_date">
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content">
                                                        <div class="align-middle">
                                                            <p class="mt-1"><b
                                                                    style="color:#1f3c88;">Subject:</b> Statement of Account
                                                                for
                                                                Parents' Counterpart Balances for Graduating Alumni</p>
                                                        </div>
                                                    </div>
                                                    <p class="mt-1"><b style="color:#1f3c88;">Message
                                                            Preview:</b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 justify-content">
                                        <div class="container">
                                            <input type="hidden" id="selectedBatchYear" name="selectedBatchYear" required>
                                            <textarea class="form-control" rows="10" readonly>
Dear (Name),

I hope this email finds you well.

You will be graduating from Passerelles Numeriques Philippines Scholarship this coming (Graduation Date).

Here's your statement of account, settling your financial situation with PN:

Remaining Debt from Parent's Counterpart: 0.00 PHP
Remaining Debt from Medical Fees: 0.00 PHP
Graduation Fees at USC: 0.00 PHP
Other Remaining Debts: 0.00 PHP
Total Payable: 0.00 PHP

Thank you so much!
                                            </textarea>
                                            <br>
                                            <button class="btn btn-sm sendButton p-2"
                                                style="background-color: #1f3c88; color:#ffffff"
                                                type="submit">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
