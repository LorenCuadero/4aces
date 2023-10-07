@extends('layouts.student.app')

@section('content')
    <div class="container-fluid">
        <div class="" style="text-align: left">
            <h1 style="color: #1f3c88">Payment Records</h1>
            <br>
            <div style="color:#1f3c88">
                <p><b>Hello, {{ $userName }}!</b></p>
                <p>Have a nice day!</p>
            </div>
            <div class="left-content" style="text-align: left; color:rgb(255, 255, 255)">
                <div class="flex-container align-middle">
                    <div class="left-column">
                        <div class="left-content" style="background-color: #1f3c88;">
                            <p class="text-disp">Total Amount Paid</p>
                            <p class="text-disp">Counterpart: ₱ 11,500.00</p>
                            <p class="text-disp">Medical (15%): ₱ 1,000.00</p>
                            <p class="text-disp">Personal cash advance: ₱ 1,000.00</p>
                            <p class="text-disp">Graduation fee: not available</p>
                        </div>
                    </div>
                    <div class="right-column" style="text-align: center">
                        <div class="right-content">
                            <h1>Total no of Payment</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="flex-container align-middle" style="background-color: none;">
            <div class="left-column">
                <div class="left-content1" style="background-color: none;">
                    <p>PAID COUNTERPART</p>
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
                                    <span>View All</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left-column" style="background-color: none;">
                        <div class="left-content1">
                            <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                <!-- Content for "paid Counterpart" -->
                                <div class="flex-container align-middle"
                                    style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                    <div class="left-column" style="padding: 2%;">
                                        <div class="left-content1">
                                            <p style="margin: 1%">JUNE 2023</p>
                                            <p>06/30/2023</p>
                                        </div>
                                    </div>
                                    <div class="right-column" style="padding: 2%;">
                                        <div class="right-content" style="border: none">
                                            <p>₱ 500.00</p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="flex-container align-middle"
                                    style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                    <div class="left-column" style="padding: 2%;">
                                        <div class="left-content1">
                                            <p style="margin: 1%">JUNE 2023</p>
                                            <p>06/30/2023</p>
                                        </div>
                                    </div>
                                    <div class="right-column" style="padding: 2%;">
                                        <div class="right-content" style="border: none">
                                            <p>₱ 500.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column">
                <div class="right-content" style="border: none">
                    <p>PAID MEDICAL SHARE</p>
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
                                    <span>View All</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left-column" style="background-color: none;">
                        <div class="left-content1">
                            <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                <!-- Content for "paid Counterpart" -->
                                <div class="flex-container align-middle"
                                    style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                    <div class="left-column" style="padding: 2%;">
                                        <div class="left-content1">
                                            <p style="margin: 1%">JUNE 2023</p>
                                            <p>06/30/2023</p>
                                        </div>
                                    </div>
                                    <div class="right-column" style="padding: 2%;">
                                        <div class="right-content" style="border: none">
                                            <p>₱ 500.00</p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="flex-container align-middle"
                                    style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                    <div class="left-column" style="padding: 2%;">
                                        <div class="left-content1">
                                            <p style="margin: 1%">JUNE 2023</p>
                                            <p>06/30/2023</p>
                                        </div>
                                    </div>
                                    <div class="right-column" style="padding: 2%;">
                                        <div class="right-content" style="border: none">
                                            <p>₱ 500.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="left-column"> <!-- Add a new left-column -->
                <div class="left-content" style="background-color: transparent;">
                    <p>PAID PERSONAL CA</p>
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
                                    <span>View All</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left-column" style="background-color: none;">
                        <div class="left-content1">
                            <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                <!-- Content for "paid Counterpart" -->
                                <div class="flex-container align-middle"
                                    style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                    <div class="left-column" style="padding: 2%;">
                                        <div class="left-content1">
                                            <p style="margin: 1%">JUNE 2023</p>
                                            <p>06/30/2023</p>
                                        </div>
                                    </div>
                                    <div class="right-column" style="padding: 2%;">
                                        <div class="right-content" style="border: none">
                                            <p>₱ 500.00</p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="flex-container align-middle"
                                    style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                    <div class="left-column" style="padding: 2%;">
                                        <div class="left-content1">
                                            <p style="margin: 1%">JUNE 2023</p>
                                            <p>06/30/2023</p>
                                        </div>
                                    </div>
                                    <div class="right-column" style="padding: 2%;">
                                        <div class="right-content" style="border: none">
                                            <p>₱ 500.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column"> <!-- Add a new right-column -->
                <div class="right-content" style="border: none">
                    <p>PAID GRADUATION FEE</p>
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
                                    <span>View All</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left-column" style="background-color: none;">
                        <div class="left-content1">
                            <div class="scrollable-content" style="max-height: 200px; overflow: auto;">
                                <!-- Content for "paid Counterpart" -->
                                <div class="flex-container align-middle"
                                    style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                    <div class="left-column" style="padding: 2%;">
                                        <div class="left-content1">
                                            <p style="margin: 1%">JUNE 2023</p>
                                            <p>06/30/2023</p>
                                        </div>
                                    </div>
                                    <div class="right-column" style="padding: 2%;">
                                        <div class="right-content" style="border: none">
                                            <p>₱ 500.00</p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="flex-container align-middle"
                                    style="background-color: rgb(255, 255, 255); border-radius: 10px; padding: 2%;">
                                    <div class="left-column" style="padding: 2%;">
                                        <div class="left-content1">
                                            <p style="margin: 1%">JUNE 2023</p>
                                            <p>06/30/2023</p>
                                        </div>
                                    </div>
                                    <div class="right-column" style="padding: 2%;">
                                        <div class="right-content" style="border: none">
                                            <p>₱ 500.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
