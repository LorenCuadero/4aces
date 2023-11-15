$(document).ready(function () {
    var currentYear = new Date().getFullYear();
    for (var i = currentYear; i >= currentYear - 5; i--) {
        $(".yearDropdown").append(
            $("<option>", {
                value: i,
                text: i,
            })
        );
    }

    $("#email-form").submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting

        const selectedMonth = $("#monthDropdown option:selected").val();
        const selectedYear = $(".yearDropdown option:selected").val();

        // Set the hidden input values with the selected month and year
        $("#month").val(selectedMonth);
        $("#year").val(selectedYear);
        const loadingOverlay = $(".loading-spinner-overlay");

        function showLoadingSpinner() {
            loadingOverlay.show();
            $("body").css("overflow", "hidden");
        }

        showLoadingSpinner();
        // Now you can submit the form
        this.submit();
        setTimeout(() => {
            toastr.success("Email sent successfully!");
        }, 2000);
    });
});

const loadingOverlay = $(".loading-spinner-overlay");

function showLoadingSpinner() {
    loadingOverlay.show();
    $("body").css("overflow", "hidden");
}

$(document).ready(function () {
    $(".dropdown-item").click(function () {
        const selectedYear = $(this).text();

        $("#selectedBatchYear").val(selectedYear);
        const sendButton = $("#sendButton");

        if (selectedYear === "Year") {
            sendButton.removeAttr("required");
        } else {
            sendButton.attr("required", "required");
        }
    });
});

$(document).ready(function () {
    $("#selectToAddStudentCounterpart").click(function () {
        const addModal = $("#student-selection-counterpart-modal");

        addModal.modal("show");
    });
});

$(document).ready(function () {
    $("#selectToAddStudentMedicalShare").click(function () {
        const addModal = $("#student-selection-medical-share-modal");

        addModal.modal("show");
    });
});

$(document).ready(function () {
    $("#selectToAddStudentPersonalCA").click(function () {
        const addModal = $("#student-selection-personal-ca-modal");

        addModal.modal("show");
    });
});

$(document).ready(function () {
    $("#selectToAddStudentGraduationFee").click(function () {
        const addModal = $("#student-selection-graduation-fee-modal");

        addModal.modal("show");
    });
});

$(document).ready(function () {
    $(".select-student-link-counterpart").click(function (event) {
        event.preventDefault();

        const studentId = $(this).data("student-id");
        const redirectUrl = $(this).attr("href");
        const loadingOverlay = $(".loading-spinner-overlay");

        function showLoadingSpinner() {
            loadingOverlay.show();
            $("body").css("overflow", "hidden");
        }
        showLoadingSpinner();
        window.location.href = redirectUrl;
    });
});

$(document).ready(function () {
    $(".back").click(function (event) {
        event.preventDefault();

        // Specify the URL you want to navigate to
        const customUrl = "/counterpart-records";

        const loadingOverlay = $(".loading-spinner-overlay");

        function showLoadingSpinner() {
            loadingOverlay.show();
            $("body").css("overflow", "hidden");
        }

        showLoadingSpinner();

        // Navigate to the custom URL
        window.location.href = customUrl;
    });

    $(".back-medical").click(function (event) {
        event.preventDefault();

        // Specify the URL you want to navigate to
        const customUrl = "/medical-share-records";

        const loadingOverlay = $(".loading-spinner-overlay");

        function showLoadingSpinner() {
            loadingOverlay.show();
            $("body").css("overflow", "hidden");
        }

        showLoadingSpinner();

        // Navigate to the custom URL
        window.location.href = customUrl;
    });
});

$(document).ready(function () {
    $("#addStudentCounterpartRecordBtn").click(function (event) {
        $("#add-student-counterpart-modal").modal("show");
    });
});

$(document).ready(function () {
    $("#addStudentPersonalCARecordBtn").click(function (event) {
        $("#add-student-personal-ca-modal").modal("show");
    });
});

$(document).ready(function () {
    $("#addStudentGraduationFeeRecordRecordBtn").click(function (event) {
        $("#add-student-graduation-fee-modal").modal("show");
    });
});

$(document).ready(function () {
    // Handle the click event on the "View" button
    $(".view-button-counterpart").on("click", function () {
        const studentId = $(this).data("student-id");

        // Construct the URL for the route
        const finalUrl = `/counterpart-records/${studentId}`;

        const loadingOverlay = $(".loading-spinner-overlay");
        let successNotificationShown = false; // Flag to track whether the success notification has been shown

        // Function to show the loading spinner
        function showLoadingSpinner() {
            loadingOverlay.show();
            $("body").css("overflow", "hidden");
        }

        showLoadingSpinner();

        // Use setTimeout to delay the redirection
        setTimeout(function () {
            // Redirect to the intended page
            window.location.href = finalUrl;
        }, 100); // Replace 1000 with the desired delay in milliseconds
    });
});

$(document).ready(function () {
    $(".view-button-graduation-fee").on("click", function () {
        const studentId = $(this).data("student-id");
        const finalUrl = `/graduation-fees-records/${studentId}`;

        const loadingOverlay = $(".loading-spinner-overlay");
        let successNotificationShown = false; // Flag to track whether the success notification has been shown

        function showLoadingSpinner() {
            loadingOverlay.show();
            $("body").css("overflow", "hidden");
        }

        showLoadingSpinner();

        setTimeout(function () {
            window.location.href = finalUrl;
        }, 100);
    });
});

$(document).ready(function () {
    // Handle the click event on the "View" button
    $(".view-button-personal-ca").on("click", function () {
        const studentId = $(this).data("student-id");

        // Construct the URL for the route
        const finalUrl = `/personal-cash-advance-records/${studentId}`;

        const loadingOverlay = $(".loading-spinner-overlay");
        let successNotificationShown = false; // Flag to track whether the success notification has been shown

        // Function to show the loading spinner
        function showLoadingSpinner() {
            loadingOverlay.show();
            $("body").css("overflow", "hidden");
        }

        showLoadingSpinner();

        // Use setTimeout to delay the redirection
        setTimeout(function () {
            // Redirect to the intended page
            window.location.href = finalUrl;
        }, 100); // Replace 1000 with the desired delay in milliseconds
    });
});

$(document).ready(function () {
    // Access the data passed from the Blade view
    const $percentageInput = $("#percentage");

    // Counterpart
    const counterpartPercentageJanuary = $percentageInput.data(
        "counterpart-january"
    );
    const counterpartPercentageFebruary = $percentageInput.data(
        "counterpart-february"
    );
    const counterpartPercentageMarch =
        $percentageInput.data("counterpart-march");
    const counterpartPercentageApril =
        $percentageInput.data("counterpart-april");
    const counterpartPercentageMay = $percentageInput.data("counterpart-may");
    const counterpartPercentageJune = $percentageInput.data("counterpart-june");
    const counterpartPercentageJuly = $percentageInput.data("counterpart-july");
    const counterpartPercentageAugust =
        $percentageInput.data("counterpart-august");
    const counterpartPercentageSeptember = $percentageInput.data(
        "counterpart-september"
    );
    const counterpartPercentageOctober = $percentageInput.data(
        "counterpart-october"
    );
    const counterpartPercentageNovember = $percentageInput.data(
        "counterpart-november"
    );
    const counterpartPercentageDecember = $percentageInput.data(
        "counterpart-december"
    );

    // MedicalShare
    const medicalSharePercentageJanuary =
        $percentageInput.data("medical-january");
    const medicalSharePercentageFebruary =
        $percentageInput.data("medical-february");
    const medicalSharePercentageMarch = $percentageInput.data("medical-march");
    const medicalSharePercentageApril = $percentageInput.data("medical-april");
    const medicalSharePercentageMay = $percentageInput.data("medical-may");
    const medicalSharePercentageJune = $percentageInput.data("medical-june");
    const medicalSharePercentageJuly = $percentageInput.data("medical-july");
    const medicalSharePercentageAugust =
        $percentageInput.data("medical-august");
    const medicalSharePercentageSeptember =
        $percentageInput.data("medical-september");
    const medicalSharePercentageOctober =
        $percentageInput.data("medical-october");
    const medicalSharePercentageNovember =
        $percentageInput.data("medical-november");
    const medicalSharePercentageDecember =
        $percentageInput.data("medical-december");

    // PersonalCashAdvance
    const personalCashAdvancePercentageJanuary = $percentageInput.data(
        "personal-ca-january"
    );
    const personalCashAdvancePercentageFebruary = $percentageInput.data(
        "personal-ca-february"
    );
    const personalCashAdvancePercentageMarch =
        $percentageInput.data("personal-ca-march");
    const personalCashAdvancePercentageApril =
        $percentageInput.data("personal-ca-april");
    const personalCashAdvancePercentageMay =
        $percentageInput.data("personal-ca-may");
    const personalCashAdvancePercentageJune =
        $percentageInput.data("personal-ca-june");
    const personalCashAdvancePercentageJuly =
        $percentageInput.data("personal-ca-july");
    const personalCashAdvancePercentageAugust =
        $percentageInput.data("personal-ca-august");
    const personalCashAdvancePercentageSeptember = $percentageInput.data(
        "personal-ca-september"
    );
    const personalCashAdvancePercentageOctober = $percentageInput.data(
        "personal-ca-october"
    );
    const personalCashAdvancePercentageNovember = $percentageInput.data(
        "personal-ca-november"
    );
    const personalCashAdvancePercentageDecember = $percentageInput.data(
        "personal-ca-december"
    );

    // GraduationFee
    const graduationFeePercentageJanuary = $percentageInput.data(
        "graduation-fee-january"
    );
    const graduationFeePercentageFebruary = $percentageInput.data(
        "graduation-fee-february"
    );
    const graduationFeePercentageMarch = $percentageInput.data(
        "graduation-fee-march"
    );
    const graduationFeePercentageApril = $percentageInput.data(
        "graduation-fee-april"
    );
    const graduationFeePercentageMay =
        $percentageInput.data("graduation-fee-may");
    const graduationFeePercentageJune = $percentageInput.data(
        "graduation-fee-june"
    );
    const graduationFeePercentageJuly = $percentageInput.data(
        "graduation-fee-july"
    );
    const graduationFeePercentageAugust = $percentageInput.data(
        "graduation-fee-august"
    );
    const graduationFeePercentageSeptember = $percentageInput.data(
        "graduation-fee-september"
    );
    const graduationFeePercentageOctober = $percentageInput.data(
        "graduation-fee-october"
    );
    const graduationFeePercentageNovember = $percentageInput.data(
        "graduation-fee-november"
    );
    const graduationFeePercentageDecember = $percentageInput.data(
        "graduation-fee-december"
    );

    // Define your chart data and options
    const barChartData = {
        labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ],
        datasets: [
            {
                label: "Counterpart Percentage",
                backgroundColor: "rgba(60,141,188,0.9)",
                borderColor: "rgba(60,141,188,0.8)",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: [
                    counterpartPercentageJanuary,
                    counterpartPercentageFebruary,
                    counterpartPercentageMarch,
                    counterpartPercentageApril,
                    counterpartPercentageMay,
                    counterpartPercentageJune,
                    counterpartPercentageJuly,
                    counterpartPercentageAugust,
                    counterpartPercentageSeptember,
                    counterpartPercentageOctober,
                    counterpartPercentageNovember,
                    counterpartPercentageDecember,
                ],
            },
            {
                label: "Medical Percentage",
                backgroundColor: "#7EB1ED",
                borderColor: "#7EB1ED",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "#7EB1ED",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "#7EB1ED",
                data: [
                    medicalSharePercentageJanuary,
                    medicalSharePercentageFebruary,
                    medicalSharePercentageMarch,
                    medicalSharePercentageApril,
                    medicalSharePercentageMay,
                    medicalSharePercentageJune,
                    medicalSharePercentageJuly,
                    medicalSharePercentageAugust,
                    medicalSharePercentageSeptember,
                    medicalSharePercentageOctober,
                    medicalSharePercentageNovember,
                    medicalSharePercentageDecember,
                ],
            },
            {
                label: "Personal CA Percentage",
                backgroundColor: "#1F3C88",
                borderColor: "#1F3C88",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "#1F3C88",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "#1F3C88",
                data: [
                    personalCashAdvancePercentageJanuary,
                    personalCashAdvancePercentageFebruary,
                    personalCashAdvancePercentageMarch,
                    personalCashAdvancePercentageApril,
                    personalCashAdvancePercentageMay,
                    personalCashAdvancePercentageJune,
                    personalCashAdvancePercentageJuly,
                    personalCashAdvancePercentageAugust,
                    personalCashAdvancePercentageSeptember,
                    personalCashAdvancePercentageOctober,
                    personalCashAdvancePercentageNovember,
                    personalCashAdvancePercentageDecember,
                ],
            },
            {
                label: "Graduation Fee Percentage",
                backgroundColor: "#FFB13D",
                borderColor: "#FFB13D",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "#FFB13D",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "#FFB13D",
                data: [
                    graduationFeePercentageJanuary,
                    graduationFeePercentageFebruary,
                    graduationFeePercentageMarch,
                    graduationFeePercentageApril,
                    graduationFeePercentageMay,
                    graduationFeePercentageJune,
                    graduationFeePercentageJuly,
                    graduationFeePercentageAugust,
                    graduationFeePercentageSeptember,
                    graduationFeePercentageOctober,
                    graduationFeePercentageNovember,
                    graduationFeePercentageDecember,
                ],
            },
        ],
    };

    const barChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: true,
        },
        scales: {
            xAxes: [
                {
                    gridLines: {
                        display: true,
                    },
                },
            ],
            yAxes: [
                {
                    gridLines: {
                        display: true,
                    },
                },
            ],
        },
    };

    // Create the bar chart using the data and options
    const barChartCanvas = $("#barChart")[0].getContext("2d");
    new Chart(barChartCanvas, {
        type: "bar",
        data: barChartData,
        options: barChartOptions,
    });
});

$(document).ready(function () {
    const currentYearData = new Date().getFullYear();
    $("#currentYear").text("Year " + currentYearData);
});

$(document).ready(function () {
    var currentYear = new Date().getFullYear();
    for (var i = currentYear; i >= currentYear - 14; i--) {
        $("#yearDropdownAnalytics").append(
            $("<option>", {
                id: "year",
                name: "year",
                value: i,
                text: i,
            })
        );
    }

    $("#yearDropdownAnalytics").change(function () {
        const selectedYearAnalytics = $(
            "#yearDropdownAnalytics option:selected"
        ).text();

        $("#year_analytics").val(selectedYearAnalytics);
    });

    const monthlyForm = $("#monthly-form");
    const yearSelections = $("#yearDropdownAnalytics");

    yearSelections.on("change", function () {
        monthlyForm.submit(function (e) {
            e.preventDefault();

            showLoadingSpinner();

            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: $(this).serialize(),

                success: function (response) {
                    if (!successNotificationShown) {
                        successNotificationShown = true;
                    }

                    changeCanvasValues(response);

                    loadingOverlay.reload();
                },
                error: function (error) {
                    hideLoadingSpinner();
                },
            });
        });
    });

    function changeCanvasValues(response) {
        // Counterpart
        var counterpartPercentageJanuary = response.counterpartPaidCountJanuary;
        var counterpartPercentageFebruary =
            response.counterpartPaidCountFebruary;
        var counterpartPercentageMarch = response.counterpartPaidCountMarch;
        var counterpartPercentageApril = response.counterpartPaidCountApril;
        var counterpartPercentageMay = response.counterpartPaidCountMay;
        var counterpartPercentageJune = response.counterpartPaidCountJune;
        var counterpartPercentageJuly = response.counterpartPaidCountJuly;
        var counterpartPercentageAugust = response.counterpartPaidCountAugust;
        var counterpartPercentageSeptember =
            response.counterpartPaidCountSeptember;
        var counterpartPercentageOctober = response.counterpartPaidCountOctober;
        var counterpartPercentageNovember =
            response.counterpartPaidCountNovember;
        var counterpartPercentageDecember =
            response.counterpartPaidCountDecember;

        // MedicalShare
        var medicalSharePercentageJanuary =
            response.medicalSharePaidCountJanuary;
        var medicalSharePercentageFebruary =
            response.medicalSharePaidCountFebruary;
        var medicalSharePercentageMarch = response.medicalSharePaidCountMarch;
        var medicalSharePercentageApril = response.medicalSharePaidCountApril;
        var medicalSharePercentageMay = response.medicalSharePaidCountMay;
        var medicalSharePercentageJune = response.medicalSharePaidCountJune;
        var medicalSharePercentageJuly = response.medicalSharePaidCountJuly;
        var medicalSharePercentageAugust = response.medicalSharePaidCountAugust;
        var medicalSharePercentageSeptember =
            response.medicalSharePaidCountSeptember;
        var medicalSharePercentageOctober =
            response.medicalSharePaidCountOctober;
        var medicalSharePercentageNovember =
            response.medicalSharePaidCountNovember;
        var medicalSharePercentageDecember =
            response.medicalSharePaidCountDecember;

        // PersonalCashAdvance
        var personalCashAdvancePercentageJanuary =
            response.personalCashAdvancePaidCountJanuary;
        var personalCashAdvancePercentageFebruary =
            response.personalCashAdvancePaidCountFebruary;
        var personalCashAdvancePercentageMarch =
            response.personalCashAdvancePaidCountMarch;
        var personalCashAdvancePercentageApril =
            response.personalCashAdvancePaidCountApril;
        var personalCashAdvancePercentageMay =
            response.personalCashAdvancePaidCountMay;
        var personalCashAdvancePercentageJune =
            response.personalCashAdvancePaidCountJune;
        var personalCashAdvancePercentageJuly =
            response.personalCashAdvancePaidCountJuly;
        var personalCashAdvancePercentageAugust =
            response.personalCashAdvancePaidCountAugust;
        var personalCashAdvancePercentageSeptember =
            response.personalCashAdvancePaidCountSeptember;
        var personalCashAdvancePercentageOctober =
            response.personalCashAdvancePaidCountOctober;
        var personalCashAdvancePercentageNovember =
            response.personalCashAdvancePaidCountNovember;
        var personalCashAdvancePercentageDecember =
            response.personalCashAdvancePaidCountDecember;

        // GraduationFee
        var graduationFeePercentageJanuary =
            response.graduationFeePaidCountJanuary;
        var graduationFeePercentageFebruary =
            response.graduationFeePaidCountFebruary;
        var graduationFeePercentageMarch = response.graduationFeePaidCountMarch;
        var graduationFeePercentageApril = response.graduationFeePaidCountApril;
        var graduationFeePercentageMay = response.graduationFeePaidCountMay;
        var graduationFeePercentageJune = response.graduationFeePaidCountJune;
        var graduationFeePercentageJuly = response.graduationFeePaidCountJuly;
        var graduationFeePercentageAugust =
            response.graduationFeePaidCountAugust;
        var graduationFeePercentageSeptember =
            response.graduationFeePaidCountSeptember;
        var graduationFeePercentageOctober =
            response.graduationFeePaidCountOctober;
        var graduationFeePercentageNovember =
            response.graduationFeePaidCountNovember;
        var graduationFeePercentageDecember =
            response.graduationFeePaidCountDecember;

        // Define your chart data and options
        const barChartData = {
            labels: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ],
            datasets: [
                {
                    label: "Counterpart Percentage",
                    backgroundColor: "rgba(60,141,188,0.9)",
                    borderColor: "rgba(60,141,188,0.8)",
                    pointRadius: false,
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [
                        counterpartPercentageJanuary,
                        counterpartPercentageFebruary,
                        counterpartPercentageMarch,
                        counterpartPercentageApril,
                        counterpartPercentageMay,
                        counterpartPercentageJune,
                        counterpartPercentageJuly,
                        counterpartPercentageAugust,
                        counterpartPercentageSeptember,
                        counterpartPercentageOctober,
                        counterpartPercentageNovember,
                        counterpartPercentageDecember,
                    ],
                },
                {
                    label: "Medical Percentage",
                    backgroundColor: "#7EB1ED",
                    borderColor: "#7EB1ED",
                    pointRadius: false,
                    pointColor: "#3b8bba",
                    pointStrokeColor: "#7EB1ED",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "#7EB1ED",
                    data: [
                        medicalSharePercentageJanuary,
                        medicalSharePercentageFebruary,
                        medicalSharePercentageMarch,
                        medicalSharePercentageApril,
                        medicalSharePercentageMay,
                        medicalSharePercentageJune,
                        medicalSharePercentageJuly,
                        medicalSharePercentageAugust,
                        medicalSharePercentageSeptember,
                        medicalSharePercentageOctober,
                        medicalSharePercentageNovember,
                        medicalSharePercentageDecember,
                    ],
                },
                {
                    label: "Personal CA Percentage",
                    backgroundColor: "#1F3C88",
                    borderColor: "#1F3C88",
                    pointRadius: false,
                    pointColor: "#3b8bba",
                    pointStrokeColor: "#1F3C88",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "#1F3C88",
                    data: [
                        personalCashAdvancePercentageJanuary,
                        personalCashAdvancePercentageFebruary,
                        personalCashAdvancePercentageMarch,
                        personalCashAdvancePercentageApril,
                        personalCashAdvancePercentageMay,
                        personalCashAdvancePercentageJune,
                        personalCashAdvancePercentageJuly,
                        personalCashAdvancePercentageAugust,
                        personalCashAdvancePercentageSeptember,
                        personalCashAdvancePercentageOctober,
                        personalCashAdvancePercentageNovember,
                        personalCashAdvancePercentageDecember,
                    ],
                },
                {
                    label: "Graduation Fee Percentage",
                    backgroundColor: "#FFB13D",
                    borderColor: "#FFB13D",
                    pointRadius: false,
                    pointColor: "#3b8bba",
                    pointStrokeColor: "#FFB13D",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "#FFB13D",
                    data: [
                        graduationFeePercentageJanuary,
                        graduationFeePercentageFebruary,
                        graduationFeePercentageMarch,
                        graduationFeePercentageApril,
                        graduationFeePercentageMay,
                        graduationFeePercentageJune,
                        graduationFeePercentageJuly,
                        graduationFeePercentageAugust,
                        graduationFeePercentageSeptember,
                        graduationFeePercentageOctober,
                        graduationFeePercentageNovember,
                        graduationFeePercentageDecember,
                    ],
                },
            ],
        };

        const barChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true,
            },
            scales: {
                xAxes: [
                    {
                        gridLines: {
                            display: true,
                        },
                    },
                ],
                yAxes: [
                    {
                        gridLines: {
                            display: true,
                        },
                    },
                ],
            },
        };

        // Create the bar chart using the data and options
        const barChartCanvas = $("#barChart")[0].getContext("2d");
        new Chart(barChartCanvas, {
            type: "bar",
            data: barChartData,
            options: barChartOptions,
        });
    }
});

$(document).ready(function () {
    const currentDate = new Date();

    // Define an array of month names
    const monthNames = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    // Get the current month and year
    const currentMonth = monthNames[currentDate.getMonth()];
    const currentYearDash = new Date().getFullYear();

    $("#currentMonthYear").text(currentMonth + " " + currentYearDash);
});

$(document).ready(function () {
    $(".sendButton").click(function (event) {
        event.preventDefault();

        const form = $("#send-coa-email-form");
        const loadingOverlay = $(".loading-spinner-overlay");

        function showLoadingSpinner() {
            loadingOverlay.show();
            $("body").css("overflow", "hidden");
        }
        showLoadingSpinner();
        setTimeout(function () {
            $("body").css("overflow", "auto");
            form.submit();
            toastr.success("Email sent successfully!");
        }, 5000);
    });
});

$(document).ready(function () {
    $(".edit-student-counterpart-button").click(function () {
        const editModal = $("#edit-student-counterpart-modal");
        const month = $(this).data("month");
        const year = $(this).data("year");
        const amountDue = $(this).data("amount-due");
        const amountPaid = $(this).data("amount-paid");
        const date = $(this).data("date");
        const id = $(this).data("id");
        const editUrl = $(this).data("edit-url");

        // Set the values in the modal fields
        editModal.find("#edit-month").val(month);
        editModal.find("#edit-year").val(year);
        editModal.find("#edit-amount_due").val(amountDue);
        editModal.find("#edit-amount_paid").val(amountPaid);
        editModal.find("#edit-date").val(date);
        $("#edit-counterpart-form").attr(
            "action",
            editUrl.replace("counterpart_id", id)
        );

        editModal.modal("show");
    });
});

$(document).ready(function () {
    $(".edit-student-personal-ca-button").click(function () {
        const editModal = $("#edit-student-personal-ca-modal");
        const purpose = $(this).data("purpose");
        const amountDue = $(this).data("amount-due");
        const amountPaid = $(this).data("amount-paid");
        const date = $(this).data("date");
        const id = $(this).data("id");
        const editUrl = $(this).data("edit-url");

        editModal.find("#edit_purpose").val(purpose);
        editModal.find("#edit_amount_due").val(amountDue);
        editModal.find("#edit_amount_paid").val(amountPaid);
        editModal.find("#edit_date").val(date);
        $("#edit-personal-ca-form").attr(
            "action",
            editUrl.replace("personal_ca_id", id)
        );
        editModal.modal("show");
    });
});

$(document).ready(function () {
    $(".edit-student-medical-share-button").click(function () {
        const editModal = $("#edit-student-medical-share-modal");
        // const amountDue = $(this).data("total-cost");
        // const amountPaid = $(this).data("amount-paid");
        // const date = $(this).data("date");
        // const id = $(this).data("id");
        // const editUrl = $(this).data("edit-url");

        // editModal.find("#edit_amount_due").val(amountDue);
        // editModal.find("#edit_amount_paid").val(amountPaid);
        // editModal.find("#edit_date").val(date);
        // $("#edit-medical-share-form").attr(
        //     "action",
        //     editUrl.replace("medical_share_id", id)
        // );
        editModal.modal("show");
    });
});

$(document).ready(function () {
    $(".edit-student-graduation-fee-button").click(function () {
        const editModal = $("#edit-student-graduation-fee-modal");
        const amountDue = $(this).data("amount-due");
        const amountPaid = $(this).data("amount-paid");
        const date = $(this).data("date");
        const id = $(this).data("id");
        const editUrl = $(this).data("edit-url");

        editModal.find("#edit_amount_due_gf").val(amountDue);
        editModal.find("#edit_amount_paid_gf").val(amountPaid);
        editModal.find("#edit_date_gf").val(date);
        $("#edit-graduation-fee-form").attr(
            "action",
            editUrl.replace("graduation_fee_id", id)
        );
        editModal.modal("show");
    });
});

$(document).ready(function () {
    $(".delete-counterpart").click(function () {
        const deleteId = $(this).data("id");
        const deleteModal = $("#delete-counterpart-confirmation-modal");
        const deletionUrl = $(this).data("delete-url");

        $("#deletion-confirmed-form").attr(
            "action",
            deletionUrl.replace("counterpart_id", deleteId)
        );

        deleteModal.modal("show");
    });
});

$(document).ready(function () {
    $(".delete-personal-ca").click(function () {
        const deleteId = $(this).data("id");
        const deleteModal = $("#delete-personal-confirmation-modal");
        const deletionUrl = $(this).data("delete-url");

        $("#deletion-confirmed-form-personal").attr(
            "action",
            deletionUrl.replace("personal_ca_id", deleteId)
        );

        deleteModal.modal("show");
    });
});

$(document).ready(function () {
    $("#deletion-confirmed-form").submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        var loadingOverlay1 = $(".loading-spinner-overlay");
        let successNotificationShown = false; // Flag to track whether the success notification has been shown

        // Function to show the loading spinner
        function showLoadingSpinner() {
            loadingOverlay1.show();
            $("body").css("overflow", "hidden");
        }

        // Function to hide the loading spinner
        function hideLoadingSpinner() {
            loadingOverlay1.hide();
            $("body").css("overflow", "auto");
        }

        // Show the loading spinner when the form is submitted
        showLoadingSpinner();

        // Perform an AJAX form submission
        $.ajax({
            url: $(this).attr("action"), // Use the form's action attribute as the URL
            type: $(this).attr("method"), // Use the form's method attribute as the HTTP method
            data: $(this).serialize(), // Serialize the form data

            success: function (response) {
                // Display a success Toastr notification
                toastr.success("Successfully removed data!");

                // Optionally, you can add code to update the page without a full reload
                location.reload();
            },
            error: function (error) {
                // Hide the loading spinner when there's an error
                hideLoadingSpinner();

                toastr.error(
                    "An error occurred while removing data, please try again."
                );
            },
        });
    });
});

// Medical View Button
$(document).ready(function () {
    // Handle the click event on the "View" button
    $(".view-button-medical").on("click", function () {
        const studentId = $(this).data("student-id");

        // Construct the URL for the route
        const finalUrl = `/medical-share-records/${studentId}`;

        const loadingOverlay = $(".loading-spinner-overlay");
        let successNotificationShown = false; // Flag to track whether the success notification has been shown

        // Function to show the loading spinner
        function showLoadingSpinner() {
            loadingOverlay.show();
            $("body").css("overflow", "hidden");
        }

        showLoadingSpinner();

        // Use setTimeout to delay the redirection
        setTimeout(function () {
            // Redirect to the intended page
            window.location.href = finalUrl;
        }, 100); // Replace 1000 with the desired delay in milliseconds
    });
});

$(document).ready(function () {
    $(".view-all").click(function () {
        const viewModalDash = $("#dashboard-modal");
        viewModalDash.modal("show");
    });
});

$(document).ready(function () {
    const batchYearSelect = $("#batch_year");
    const selectedBatchYearElement = $("#selected-batch-year");
    const totalStudentsPerYearElement = $("#total-students-per-year");
    const totalNumberOfStudentsPerBatch = $("#batch-year-form");
    const totalByYear = totalNumberOfStudentsPerBatch.data("total-by-year");
    const formYear = $("#get_totals_by_batch_year_form");
    const allBatch = $("#allBatch");
    let successNotificationShown = false;

    // Function to update the modal content with totals
    function updateModalContent(response) {
        // Update the modal content with data from the response
        $("#counterpartPaidStudentsCount").text(response.totalPaidCounterpart);
        $("#counterpartUnpaidStudentsCount").text(
            response.totalUnpaidCounterpart
        );
        $("#counterpartNotFullyPaidStudentsCount").text(
            response.totalNotFullyPaidCounterpart
        );
        $("#medicalSharePaidStudentsCount").text(
            response.totalPaidMedicalShare
        );
        $("#medicalShareUnpaidStudentsCount").text(
            response.totalUnpaidMedicalShare
        );
        $("#medicalShareNotFullyPaidStudentsCount").text(
            response.totalNotFullyPaidMedicalShare
        );
        $("#personalCashAdvancePaidStudentsCount").text(
            response.totalPaidPersonalCashAdvance
        );
        $("#personalCashAdvanceUnpaidStudentsCount").text(
            response.totalUnpaidPersonalCashAdvance
        );
        $("#personalCashAdvanceNotFullyPaidStudentsCount").text(
            response.totalNotFullyPaidPersonalCashAdvance
        );
        $("#graduationFeePaidStudentsCount").text(
            response.totalPaidGraduationFees
        );
        $("#graduationFeeUnpaidStudentsCount").text(
            response.totalUnpaidGraduationFees
        );
        $("#graduationFeeNotFullyPaidStudentsCount").text(
            response.totalNotFullyPaidGraduationFees
        );

        // Show the modal
        $("#dashboard-modal").modal("show");
    }

    function updateModalContentWhenAllBatch(response) {
        // Update the modal content with data from the response
        $("#counterpartPaidStudentsCount").text(
            response.counterpartPaidStudentsCount
        );
        $("#counterpartUnpaidStudentsCount").text(
            response.counterpartUnpaidStudentsCount
        );
        $("#counterpartNotFullyPaidStudentsCount").text(
            response.counterpartNotFullyPaidStudentsCount
        );
        $("#medicalSharePaidStudentsCount").text(
            response.medicalSharePaidStudentsCount
        );
        $("#medicalShareUnpaidStudentsCount").text(
            response.medicalShareUnpaidStudentsCount
        );
        $("#medicalShareNotFullyPaidStudentsCount").text(
            response.medicalShareNotFullyPaidStudentsCount
        );
        $("#personalCashAdvancePaidStudentsCount").text(
            response.personalCashAdvancePaidStudentsCount
        );
        $("#personalCashAdvanceUnpaidStudentsCount").text(
            response.personalCashAdvanceUnpaidStudentsCount
        );
        $("#personalCashAdvanceNotFullyPaidStudentsCount").text(
            response.personalCashAdvanceNotFullyPaidStudentsCount
        );
        $("#graduationFeePaidStudentsCount").text(
            response.graduationFeePaidStudentsCount
        );
        $("#graduationFeeUnpaidStudentsCount").text(
            response.graduationFeeUnpaidStudentsCount
        );
        $("#graduationFeeNotFullyPaidStudentsCount").text(
            response.graduationFeeNotFullyPaidStudentsCount
        );
    }

    function showLoadingSpinner() {
        const loadingOverlay = $(".loading-spinner-overlay");
        loadingOverlay.show();
        $("body").css("overflow", "hidden");
    }

    function hideLoadingSpinner() {
        const loadingOverlay = $(".loading-spinner-overlay");
        loadingOverlay.hide();
        $("body").css("overflow", "auto");
    }

    batchYearSelect.on("change", function () {
        selectedBatchYearElement.show();
        const selectedYear = batchYearSelect.val();
        selectedBatchYearElement.text(
            "Batch " + selectedYear + " total number of students: "
        );

        if (selectedYear in totalByYear) {
            totalStudentsPerYearElement.text(totalByYear[selectedYear]);
            formYear.submit();
            $("#total-students-per-year").show();
        } else {
            selectedBatchYearElement.text("");
            selectedBatchYearElement.hide();
            $("#total-students-per-year").hide();

            if (allBatch) {
                showLoadingSpinner();
                $.ajax({
                    url: "/allBatchTotalCount",
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        updateModalContentWhenAllBatch(response);
                        hideLoadingSpinner();
                    },
                    error: function (error) {
                        hideLoadingSpinner();
                    },
                });
                return;
            }
        }
    });

    formYear.submit(function (e) {
        e.preventDefault();

        showLoadingSpinner();

        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serialize(),

            success: function (response) {
                if (!successNotificationShown) {
                    successNotificationShown = true;
                }

                // Update the modal with data
                updateModalContent(response);

                hideLoadingSpinner();
            },
            error: function (error) {
                hideLoadingSpinner();
                // Handle errors if needed
            },
        });
    });
});

// $(document).ready(function () {
//     $(function () {
//         $("#example1")
//             .DataTable({
//                 responsive: true,
//                 lengthChange: false,
//                 autoWidth: false,
//                 buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
//             })
//             .buttons()
//             .container()
//             .appendTo("#example1_wrapper .col-md-6:eq(0)");
//     });
// });
