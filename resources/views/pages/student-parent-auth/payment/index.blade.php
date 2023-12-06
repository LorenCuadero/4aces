@extends('layouts.student.app')

@section('content')
    <div class="container-fluid">
        <div class="" style="text-align: left">
            <h1 style="color: #1f3c88" class="mb-0">Payment Records</h1>
            <br>
            <div style="color:#1f3c88" class="mt-0">
                <p style="color: #1f3c88;" class="mt-0">
                    Hello, {{ $userName }}!
                    Your current total payment is:
                    <span style="font-size: 24px"><b>₱ {{ number_format($totalPayments, 2) }}</b></span>
                </p>

            </div>
            <div class="row text-dash" style="color: #1f3c88;">
                <div class="col-12 col-sm-10 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon elevation-1">
                            <i class="fa-solid fa-hand-holding-hand"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Counterpart</span>
                            <span class="info-box-number"> ₱ {{ number_format($totalCounterpartPayment, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-10 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon elevation-1">
                            <i class="fa-solid fa-stethoscope"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Medical Share</span>
                            <span class="info-box-number"> ₱ {{ number_format($totalMedicalPayment, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-10 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon elevation-1">
                            <i class="fa-solid fa-money-bill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Personal Cash Advance</span>
                            <span class="info-box-number"> ₱ {{ number_format($totalPersonalCashAdvancePayment, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-10 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon elevation-1">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Graduation Fees</span>
                            <span class="info-box-number"> ₱ {{ number_format($totalGraduationFeePayment, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="flex-container align-middle" style="background-color: none;">
            <div class="right-column">
                <div class="right-content" style="border: none">
                    <p style="color: #1f3c88;">PAID COUNTERPART</p>
                    <div class="flex-container d-flex"
                        style="font-size: 13px; display: flex; align-items: center; text-align: center;">
                        <div class="left-column" style="display: flex; align-items: center;">
                            <div class="left-content1">
                                <div class="arrow">
                                    <span><i class="fas fa-arrow-down"></i> <i class="fas fa-arrow-up"></i> Latest to
                                        Oldest</span>
                                </div>
                            </div>
                        </div>
                        <div class="right-column1" style="display: flex; align-items: center; text-align:center">
                            <div class="right-content1">
                                <div class="arrow" style="text-align: center">
                                    <span><a href="#" data-target="#student-counterpart-payments-modal"
                                            data-toggle="modal">View All</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left-column" style="background-color: none;">
                        <div class="left-content1">
                            <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                <!-- Content for "paid Counterpart" -->
                                @if (count($paidCounterpartRecords) > 0)
                                    @foreach ($paidCounterpartRecords as $record)
                                        <div class="flex-container align-middle"
                                            style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                            <div class="left-column" style="padding: 2%;">
                                                <div class="left-content1" style="font-size: 12px">
                                                    <p style="margin: 1%">
                                                        {{ date('F', mktime(0, 0, 0, $record->month, 1)) }}
                                                        <span>({{ $record->year }})</span>
                                                    </p>
                                                    <p style="color: #1f3c88;">{{ $record->date }}</p>
                                                </div>
                                            </div>
                                            <div class="left-column" style="padding: 2%;">
                                                <div class="right-content" style="border: none">
                                                    <p style="color: #1f3c88;">₱ {{ number_format($record->amount_paid, 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                @else
                                   <div class="flex-container align-middle text-center pl-3 pt-3"
                                        style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                        <p style="color: #1f3c88; font-size:12px" class="text-center">No paid counterpart records found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column">
                <div class="right-content" style="border: none">
                    <p style="color: #1f3c88;">PAID MEDICAL SHARE</p>
                    <div class="flex-container"
                        style="font-size: 13px; display: flex; align-items: center; text-align: center;">
                        <div class="left-column" style="display: flex; align-items: center;">
                            <div class="left-content1">
                                <div class="arrow">
                                    <span><i class="fas fa-arrow-down"></i> <i class="fas fa-arrow-up"></i> Latest to
                                        Oldest</span>
                                </div>
                            </div>
                        </div>
                        <div class="right-column1" style="display: flex; align-items: center; text-align:center">
                            <div class="right-content1">
                                <div class="arrow" style="text-align: center">
                                    <span><a href="#" data-target="#student-medical-payments-modal"
                                            data-toggle="modal">View All</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left-column" style="background-color: none;">
                        <div class="left-content1">
                            <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                <!-- Content for "paid Counterpart" -->
                                @if (count($paidMedicalRecords) > 0)
                                    @foreach ($paidMedicalRecords as $record)
                                        <div class="flex-container align-middle"
                                            style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                            <div class="left-column" style="padding: 2%;">
                                                <div class="left-content1" style="font-size: 12px">
                                                    <p style="margin: 1%">
                                                        {{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="left-column" style="padding: 2%;">
                                                <div class="right-content" style="border: none">
                                                    <p style="color: #1f3c88;">₱ {{ number_format($record->amount_paid, 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                @else
                                    <div class="flex-container align-middle text-center pl-3 pt-3"
                                        style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                        <p style="color: #1f3c88;  font-size:12px" class="text-center">No paid medical share records found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column">
                <div class="right-content" style="border: none">
                    <p style="color: #1f3c88;">PAID PERSONAL CA</p>
                    <div class="flex-container"
                        style="font-size: 13px; display: flex; align-items: center; text-align: center;">
                        <div class="left-column" style="display: flex; align-items: center;">
                            <div class="left-content1">
                                <div class="arrow">
                                    <span><i class="fas fa-arrow-down"></i> <i class="fas fa-arrow-up"></i> Latest to
                                        Oldest</span>
                                </div>
                            </div>
                        </div>
                        <div class="right-column1" style="display: flex; align-items: center; text-align:center">
                            <div class="right-content1">
                                <div class="arrow" style="text-align: center">
                                    <span><a href="#" data-target="#student-personal-ca-payments-modal"
                                            data-toggle="modal">View All</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left-column" style="background-color: none;">
                        <div class="left-content1">
                            <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                <!-- Content for "paid Counterpart" -->
                                @if (count($paidPersonalCARecords) > 0)
                                    @foreach ($paidPersonalCARecords as $record)
                                        <div class="flex-container align-middle"
                                            style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                            <div class="left-column" style="padding: 2%;">
                                                <div class="left-content1" style="font-size: 12px">
                                                    <p style="margin: 1%">
                                                        {{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="left-column" style="padding: 2%;">
                                                <div class="right-content" style="border: none">
                                                    <p style="color: #1f3c88;">₱ {{ number_format($record->amount_paid, 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                @else
                                    <div class="flex-container align-middle text-center pl-3 pt-3"
                                        style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                        <p style="color: #1f3c88;  font-size:12px" class="text-center">No paid personal cash advance records found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column">
                <div class="right-content" style="border: none">
                    <p style="color: #1f3c88;">PAID GRADUATION FEE</p>
                    <div class="flex-container"
                        style="font-size: 13px; display: flex; align-items: center; text-align: center;">
                        <div class="left-column" style="display: flex; align-items: center;">
                            <div class="left-content1">
                                <div class="arrow">
                                    <span><i class="fas fa-arrow-down"></i> <i class="fas fa-arrow-up"></i> Latest to
                                        Oldest</span>
                                </div>
                            </div>
                        </div>
                        <div class="right-column1" style="display: flex; align-items: center; text-align:center">
                            <div class="right-content1">
                                <div class="arrow" style="text-align: center">
                                    <span><a href="#" data-target="#student-graduation-fee-payments-modal"
                                            data-toggle="modal">View All</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left-column" style="background-color: none;">
                        <div class="left-content1">
                            <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                <!-- Content for "paid Counterpart" -->
                                @if (count($paidGraduationFeeRecords) > 0)
                                    @foreach ($paidGraduationFeeRecords as $record)
                                        <div class="flex-container align-middle"
                                            style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                            <div class="left-column" style="padding: 2%;">
                                                <div class="left-content1" style="font-size: 12px">
                                                    <p style="margin: 1%">
                                                        {{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="left-column" style="padding: 2%;">
                                                <div class="right-content" style="border: none">
                                                    <p style="color: #1f3c88;">₱ {{ number_format($record->amount_paid, 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                @else
                                    <div class="flex-container align-middle text-center pl-3 pt-3"
                                        style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                        <p style="color: #1f3c88; font-size:12px" class="text-center">No paid graduation fee records found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    @include('modals.student.mdl-student-counterpart-payments')
    @include('modals.student.mdl-student-medical-payments')
    @include('modals.student.mdl-student-graduation-fee-payments')
    @include('modals.student.mdl-student-personal-ca-payments')
@endsection
