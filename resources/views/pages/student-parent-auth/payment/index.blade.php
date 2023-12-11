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
                <div class="right-content rounded"
                    style="border: none; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    border-radius: 0.25rem;
    background-color: #fff;">
                    <p style="color: #1f3c88;"><strong>Paid Counterpart</strong></p>
                    <div class="d-sm-none mb-2"> <!-- Show only on mobile view -->
                        <div id="carouselExample" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @if (count($paidCounterpartRecords) > 0)
                                    @foreach ($paidCounterpartRecords as $key => $record)
                                        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}"
                                            style="height: 100px !important; ">
                                            <!-- Content for "paid Counterpart" -->
                                            <div class="flex-container align-middle p-0"
                                                style="background-color: #1f3c88; border-radius: 10px; padding: 15px!important; height: 100px !important;">
                                                <div class="left-column"
                                                    style="margin:auto !important; display: flex; align-items: center; justify-content: center; height: 100%;">
                                                    <div class="left-content1 text-center" style="padding: 0 !important">
                                                        <p style="color:aliceblue;  " class="mb-0">
                                                            {{ date('F', mktime(0, 0, 0, $record->month, 1)) }}
                                                            <span>({{ $record->year }})</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="left-column"
                                                    style="margin:auto !important; display: flex; align-items: center; justify-content: center; height: 100%;">
                                                    <div class="right-content" style="border: none;padding: 0 !important">
                                                        <p style="color: #ffff;" class="mb-0">
                                                            ₱{{ number_format($record->amount_paid, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="flex-container align-middle text-center pl-3 pt-3"
                                        style="background-color: #1f3c88; border-radius: 10px;  padding: 15px!important">
                                        <p style="color: #1f3c88; font-size:13px; padding-left:20%" class="text-center">No
                                            records
                                            found.</p>
                                    </div>
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev"
                                style="color: #1f3c88; margin: 0% !important; padding: 0% important">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only"><i class="fa-solid fa-chevron-left"></i></span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next"
                                style="color: #1f3c88; margin: 0% !important">
                                <span class="carousel-control-next-icon" aria-hidden="true" style=""></span>
                                <span class="sr-only" style="color: #1f3c88 !important;"><i
                                        class="fa-solid fa-chevron-right"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-sm-block"> <!-- Show only on non-mobile view -->
                        <div class="left-column" style="background-color: none;">
                            <div class="left-content1 text-center">
                                <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                    <!-- Content for "paid Counterpart" -->
                                    @if (count($paidCounterpartRecords) > 0)
                                        @foreach ($paidCounterpartRecords as $record)
                                            <div class="flex-container align-middle p-0"
                                                style="background-color: rgb(237, 237, 237); border-radius: 10px; padding: 2%;">
                                                <div class="left-column" style="width: 70%">
                                                    <div class="left-content1 text-center" style="font-size: 12px">
                                                        <p style="margin: 1%" class="mb-0">
                                                            {{ date('F', mktime(0, 0, 0, $record->month, 1)) }}
                                                            <span>({{ $record->year }})</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="left-column" style="padding: 2%; width: 30%">
                                                    <div class="right-content" style="border: none">
                                                        <p style="color: #1f3c88;" class="mb-2 mt-2">
                                                            ₱{{ number_format($record->amount_paid, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
                                    @else
                                        <div class="flex-container align-middle text-center pl-3 pt-3"
                                            style="background-color: rgb(237, 237, 237); border-radius: 10px; padding: 2%;">
                                            <p style="color: #1f3c88; font-size:10px;;  padding-left:30%"
                                                class="text-center">No records
                                                found.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                        <div>
                            <div class="arrow">
                                <span><a href="#" class="btn btn-default" style="color: #1f3c88;  font-size:13px;"
                                        data-target="#student-counterpart-payments-modal" data-toggle="modal">View
                                        All</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column">
                <div class="right-content rounded"
                    style="border: none; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    border-radius: 0.25rem;
    background-color: #fff;">
                    <p style="color: #1f3c88;"><strong>Paid Medical Share</strong></p>
                    <div class="d-sm-none mb-2"> <!-- Show only on mobile view -->
                        <div id="carouselExample" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @if (count($paidMedicalRecords) > 0)
                                    @foreach ($paidMedicalRecords as $key => $record)
                                        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}"
                                            style="height: 100px !important; ">
                                            <!-- Content for "paid Counterpart" -->
                                            <div class="flex-container align-middle p-0"
                                                style="background-color: #1f3c88; border-radius: 10px; padding: 15px!important; height: 100px !important;">
                                                <div class="left-column"
                                                    style="margin:auto !important; display: flex; align-items: center; justify-content: center; height: 100%;">
                                                    <div class="left-content1 text-center" style="padding: 0 !important">
                                                        <p style="color:rgb(237, 237, 237); " class="mb-0">
                                                            {{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="left-column"
                                                    style="margin:auto !important; display: flex; align-items: center; justify-content: center; height: 100%;">
                                                    <div class="right-content" style="border: none;padding: 0 !important">
                                                        <p style="color: #ffff;" class="mb-0">
                                                            ₱{{ number_format($record->amount_paid, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="flex-container align-middle text-center pl-3 pt-3"
                                        style="background-color: #1f3c88; border-radius: 10px;  padding: 15px!important">
                                        <p style="color: #1f3c88; font-size:13px" class="text-center">No records found.
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev"
                                style="color: #1f3c88; margin: 0% !important; padding: 0% important">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only"><i class="fa-solid fa-chevron-left"
                                        style="color: #1f3c88"></i></span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next"
                                style="color: #1f3c88; margin: 0% !important">
                                <span class="carousel-control-next-icon" aria-hidden="true" style=""></span>
                                <span class="sr-only" style="color: #1f3c88 !important;"><i
                                        class="fa-solid fa-chevron-right"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-sm-block"> <!-- Show only on non-mobile view -->
                        <div class="left-column" style="background-color: none;">
                            <div class="left-content1 text-center">
                                <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                    <!-- Content for "paid Counterpart" -->
                                    @if (count($paidMedicalRecords) > 0)
                                        @foreach ($paidMedicalRecords as $record)
                                            <div class="flex-container align-middle p-0"
                                                style="background-color: rgb(237, 237, 237); border-radius: 10px; padding: 2%;">
                                                <div class="left-column" style="width: 70%">
                                                    <div class="left-content1 text-center" style="font-size: 12px">
                                                        <p style="margin: 1%" class="mb-0">
                                                            {{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="left-column" style="padding: 2%; width: 30%">
                                                    <div class="right-content" style="border: none">
                                                        <p style="color: #1f3c88;" class="mb-2 mt-2">
                                                            ₱{{ number_format($record->amount_paid, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
                                    @else
                                        <div class="flex-container align-middle text-center pl-3 pt-3"
                                            style="background-color: rgb(237, 237, 237); border-radius: 10px; padding: 2%;">
                                            <p style="color: #1f3c88; font-size:10px;  padding-left:30%"
                                                class="text-center">No records
                                                found.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                        <div>
                            <div class="arrow">
                                <span><a href="#" class="btn btn-default" style="color: #1f3c88; font-size:13px;"
                                        data-target="#student-medical-payments-modal" data-toggle="modal">View
                                        All</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column">
                <div class="right-content rounded"
                    style=";border: none; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    border-radius: 0.25rem;
    background-color: #fff;">
                    <p style="color: #1f3c88;"><strong>Paid Personal Cash Advance</strong></p>
                    <div class="d-sm-none mb-2"> <!-- Show only on mobile view -->
                        <div id="carouselExample" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @if (count($paidPersonalCARecords) > 0)
                                    @foreach ($paidPersonalCARecords as $key => $record)
                                        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}"
                                            style="height: 100px !important; ">
                                            <!-- Content for "paid Counterpart" -->
                                            <div class="flex-container align-middle p-0"
                                                style="background-color: #1f3c88; border-radius: 10px; padding: 15px!important; height: 100px !important;">
                                                <div class="left-column"
                                                    style="margin:auto !important; display: flex; align-items: center; justify-content: center; height: 100%;">
                                                    <div class="left-content1 text-center" style="padding: 0 !important">
                                                        <p style="color:aliceblue;  " class="mb-0">
                                                            {{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="left-column"
                                                    style="margin:auto !important; display: flex; align-items: center; justify-content: center; height: 100%;">
                                                    <div class="right-content" style="border: none;padding: 0 !important">
                                                        <p style="color: #ffff;" class="mb-0">
                                                            ₱{{ number_format($record->amount_paid, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="flex-container align-middle text-center pl-3 pt-3"
                                        style="background-color: #1f3c88; border-radius: 10px;  padding: 15px!important">
                                        <p style="color: #1f3c88; font-size:13px" class="text-center">No records found.
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev"
                                style="color: #1f3c88; margin: 0% !important; padding: 0% important">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only"><i class="fa-solid fa-chevron-left"></i></span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next"
                                style="color: #1f3c88; margin: 0% !important">
                                <span class="carousel-control-next-icon" aria-hidden="true" style=""></span>
                                <span class="sr-only" style="color: #1f3c88 !important;"><i
                                        class="fa-solid fa-chevron-right"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-sm-block"> <!-- Show only on non-mobile view -->
                        <div class="left-column" style="background-color: none;">
                            <div class="left-content1 text-center">
                                <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                    <!-- Content for "paid Counterpart" -->
                                    @if (count($paidPersonalCARecords) > 0)
                                        @foreach ($paidPersonalCARecords as $record)
                                            <div class="flex-container align-middle p-0"
                                                style="background-color: rgb(237, 237, 237); border-radius: 10px; padding: 2%;">
                                                <div class="left-column" style="width: 70%">
                                                    <div class="left-content1 text-center" style="font-size: 12px">
                                                        <p style="margin: 1%" class="mb-0">
                                                            {{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="left-column" style="padding: 2%; width: 30%">
                                                    <div class="right-content" style="border: none">
                                                        <p style="color: #1f3c88;" class="mb-2 mt-2">
                                                            ₱{{ number_format($record->amount_paid, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
                                    @else
                                        <div class="flex-container align-middle text-center pl-3 pt-3"
                                            style="background-color: rgb(237, 237, 237); border-radius: 10px; padding: 2%;">
                                            <p style="color: #1f3c88; font-size:10px;  padding-left:30%"
                                                class="text-center">No records
                                                found.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                        <div>
                            <div class="arrow">
                                <span><a href="#" class="btn btn-default" style="color: #1f3c88; font-size:13px;"
                                        data-target="#student-personal-ca-payments-modal" data-toggle="modal">View
                                        All</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column">
                <div class="right-content rounded"
                    style="border: none; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    border-radius: 0.25rem;
    background-color: #fff;">
                    <p style="color: #1f3c88;"><strong>Paid Graduation Fee</strong></p>
                    <div class="d-sm-none mb-2"> <!-- Show only on mobile view -->
                        <div id="carouselExample" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @if (count($paidGraduationFeeRecords) > 0)
                                    @foreach ($paidGraduationFeeRecords as $key => $record)
                                        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}"
                                            style="height: 100px !important; ">
                                            <!-- Content for "paid Counterpart" -->
                                            <div class="flex-container align-middle p-0"
                                                style="background-color: #1f3c88; border-radius: 10px; padding: 15px!important; height: 100px !important;">
                                                <div class="left-column"
                                                    style="margin:auto !important; display: flex; align-items: center; justify-content: center; height: 100%;">
                                                    <div class="left-content1 text-center" style="padding: 0 !important">
                                                        <p style="color:aliceblue;  " class="mb-0">
                                                            {{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="left-column"
                                                    style="margin:auto !important; display: flex; align-items: center; justify-content: center; height: 100%;">
                                                    <div class="right-content" style="border: none;padding: 0 !important">
                                                        <p style="color: #ffff;" class="mb-0">
                                                            ₱{{ number_format($record->amount_paid, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="flex-container align-middle text-center pl-3 pt-3"
                                        style="background-color: #1f3c88; border-radius: 10px;  padding: 15px!important">
                                        <p style="color: #1f3c88; font-size:13px" class="text-center">No records found.
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev"
                                style="color: #1f3c88; margin: 0% !important; padding: 0% important">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only"><i class="fa-solid fa-chevron-left"></i></span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next"
                                style="color: #1f3c88; margin: 0% !important">
                                <span class="carousel-control-next-icon" aria-hidden="true" style=""></span>
                                <span class="sr-only" style="color: #1f3c88 !important;"><i
                                        class="fa-solid fa-chevron-right"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-sm-block"> <!-- Show only on non-mobile view -->
                        <div class="left-column" style="background-color: none;">
                            <div class="left-content1 text-center">
                                <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                    <!-- Content for "paid Counterpart" -->
                                    @if (count($paidGraduationFeeRecords) > 0)
                                        @foreach ($paidGraduationFeeRecords as $record)
                                            <div class="flex-container align-middle p-0"
                                                style="background-color: rgb(237, 237, 237); border-radius: 10px; padding: 2%;">
                                                <div class="left-column" style="width: 70%">
                                                    <div class="left-content1 text-center" style="font-size: 12px">
                                                        <p style="margin: 1%" class="mb-0">
                                                            {{ \Carbon\Carbon::parse($record->date)->format('F d, Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="left-column" style="padding: 2%; width: 30%">
                                                    <div class="right-content" style="border: none">
                                                        <p style="color: #1f3c88;" class="mb-2 mt-2">
                                                            ₱{{ number_format($record->amount_paid, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
                                    @else
                                        <div class="flex-container align-middle text-center pl-3 pt-3"
                                            style="background-color: rgb(237, 237, 237); border-radius: 10px; padding: 2%;">
                                            <p style="color: #1f3c88; font-size:10px;  padding-left:30%"
                                                class="text-center">No records
                                                found.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                        <div>
                            <div class="arrow">
                                <span><a href="#" class="btn btn-default" style="color: #1f3c88; font-size:13px;"
                                        data-target="#student-graduation-fee-payments-modal" data-toggle="modal">View
                                        All</a></span>
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
