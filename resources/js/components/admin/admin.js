$(document).ready(function () {
    var currentYear = new Date().getFullYear();
    for (var i = currentYear; i >= currentYear - 5; i--) {
        $("#yearDropdown").append(
            $("<option>", {
                value: i,
                text: i,
            })
        );
    }

    $("#monthDropdown, #yearDropdown").change(function () {
        const selectedMonth = $("#monthDropdown option:selected").text();
        const selectedYear = $("#yearDropdown option:selected").text();

        $("#year").val(selectedYear);
        $("#month").val(selectedMonth);
    });
});

$(document).ready(function () {
    $(".dropdown-item").click(function () {
        var selectedYear = $(this).text();

        $("#selectedBatchYear").val(selectedYear);
        var sendButton = $("#sendButton");

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

        var studentId = $(this).data("student-id");
        var redirectUrl = $(this).attr("href");
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
    $("#example2").on("click", "tr", function () {
        // Get the data from the clicked row
        var studentName = $(this).find("td:eq(0)").text();
        var batchYear = $(this).find("td:eq(1)").text();
        var totalAmountDue = $(this).find("td:eq(2)").text();
        var totalAmountPaid = $(this).find("td:eq(3)").text();
        var status = $(this).find("td:eq(4)").text();

        // Construct the HTML for student details
        var studentDetailsHtml = `
            <p><strong>Name:</strong> ${studentName}</p>
            <p><strong>Batch Year:</strong> ${batchYear}</p>
            <p><strong>Total Amount Due:</strong> ${totalAmountDue}</p>
            <p><strong>Total Amount Paid:</strong> ${totalAmountPaid}</p>
            <p><strong>Status:</strong> ${status}</p>
        `;

        // Set the HTML in the modal body
        $("#studentDetails").html(studentDetailsHtml);

        // Show the modal
        $("#studentModal").modal("show");
    });
});

// your-external-script.js
$(document).ready(function () {
    // Access the data passed from the Blade view
    var counterpartPercentage = counterpartPercentage;
    var medicalSharePercentage = medicalSharePercentage;
    var personalCAPercentage = personalCashAdvancePercentage;
    var graduationFeePercentage = graduationFeePercentage;

    // Define your chart data and options
    var barChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [
            {
                label: 'Counterpart Percentage',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [counterpartPercentage, 59, 80, 81, 56, 55, 40, 12, 12, 0, 45, 63] // Use your data here
            },
            {
                label: 'Medical Percentage',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: '#1f3c88',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [graduationFeePercentage, 59, 80, 81, 56, 55, 40, 12, 12, 0, 45, 63] // Use your data here
            },
            {
                label: 'Personal CA Percentage',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: '#7EB1ED',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [counterpartPercentage, 59, 80, 81, 56, 55, 40, 12, 12, 0, 45, 63] // Use your data here
            },
            {
                label: 'Graduation Fee Percentage',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: '#FFB13D',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [graduationFeePercentage, 59, 80, 81, 56, 55, 40, 12, 12, 0, 45, 63] // Use your data here
            },
        ]
    };

    var barChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false,
                }
            }]
        }
    };

    // Create the combined chart using the data and options
    var combinedChartCanvas = $('#combinedChart')[0].getContext('2d');
    new Chart(combinedChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    });
});
