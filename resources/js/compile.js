import "./bootstrap";
import "./compile-vue.js";
import "./components/staff/cmpt-staff-table-header.js";

$(document).ready(function () {
    $("#add-btn").click(function () {
        const addModal = $("#addModal");

        addModal.modal("show");
    });
});

$(document).ready(function () {
    var batchYearDropdown = $("#batch-year-dropdown");
    var orderByDropdown = $("#order-by-dropdown");
    var tableBody = $(".table-body");

    batchYearDropdown.find(".dropdown-item").on("click", function () {
        var selectedBatchYear = $(this).text().trim();

        batchYearDropdown.find(".nav-link").text(selectedBatchYear);

        if (selectedBatchYear === "Year") {
            tableBody.find(".table-row").show();
        } else {
            tableBody.find(".table-row").hide();
            tableBody
                .find('.table-row:contains("' + selectedBatchYear + '")')
                .show();
        }
    });
});

$(document).ready(function () {
    $("#add-btn").click(function () {
        const addModal = $("#addModal");

        addModal.modal("show");
    });
});

$(document).ready(function () {
    $("#grade-button").click(function () {
        const addModal = $("#student-acd-rpt-modal");

        addModal.modal("show");
    });
});

$(document).ready(function () {
    // Add a click event handler to the "Edit" buttons
    $(".edit-grade-btn").on("click", function () {
        var modal = $("#student-acd-rpt-modal");

        // Get the data attributes
        var courseId = $(this).data("academic-id");
        var courseCode = $(this).data("academic-course_code");
        var firstSem1stYear = $(this).data("academic-first_sem_1st_year");
        var secondSem1stYear = $(this).data("academic-second_sem_1st_year");
        var firstSem2ndYear = $(this).data("academic-first_sem_2nd_year");
        var secondSem2ndYear = $(this).data("academic-second_sem_2nd_year");
        var gpa = $(this).data("academic-gpa");

        // Populate the modal fields with the data attributes
        modal.find("#id").val(courseId);
        modal.find("#course_code").val(courseCode);
        modal.find("#first_sem_1st_year").val(firstSem1stYear);
        modal.find("#second_sem_1st_year").val(secondSem1stYear);
        modal.find("#first_sem_2nd_year").val(firstSem2ndYear);
        modal.find("#second_sem_2nd_year").val(secondSem2ndYear);
        modal.find("#gpa").val(gpa);

        modal.modal("show");
    });
});

$(document).ready(function () {
    $("#addGradeBtn").click(function () {
        const addModal = $("#add-student-grd-modal");

        addModal.modal("show");
    });
});

$(document).ready(function () {
    $("#edt-dcpl-btn").click(function () {
        const addModal = $("#student-dcpl-rpt-edit-modal");

        addModal.modal("show");
    });
});

$(document).ready(function () {
    $("#addDiscplinaryBtn").click(function () {
        const addModal = $("#student-selection-modal");

        addModal.modal("show");
    });
});

$(document).ready(function () {
    $("#selectToAdd").click(function () {
        const addModal = $("#student-selection-modal");

        addModal.modal("show");
    });
});

$(document).ready(function () {
    $("#addSelectButton").click(function () {
        $("#student-selection-modal").modal("show");
    });
});

$(document).ready(function () {
    $(".selectedToAdd").click(function () {
        const addModal = $("#add-student-dcpl-modal");
        addModal.modal("show");
    });
});

$(document).ready(function () {
    $("#add-student-dcpl-modal").on("show.bs.modal", function (event) {
        var link = $(event.relatedTarget); // Get the link that triggered the modal
        var studentId = link.data("student-id"); // Get the data-student-id value

        // Set the value of the hidden input field
        $("#student_id").val(studentId);
    });
});

$(document).ready(function () {
    $(".select-student-link").on("click", function (event) {
        event.preventDefault();

        $("#student-selection-modal").modal("hide");
    });
});

$(document).ready(function () {
    $("#closeButton").on("click", function (event) {
        event.preventDefault();

        $("#add-student-dcpl-modal").modal("hide");
    });
});

$(document).ready(function () {
    $('#edit-student-dcpl-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var studentId = button.data('student-id');
        var verbalWarningDate = button.data('verbal-warning-date');
        var verbalWarningDesc = button.data('verbal-warning-description');
        var writtenWarningDate = button.data('written-warning-date');
        var writtenWarningDesc = button.data('written-warning-description');
        var provisionaryDate = button.data('provisionary-date');
        var provisionaryDesc = button.data('provisionary-description');

        $('#verbal_warning_date').val(verbalWarningDate);
        $('#verbal_warning_description').val(verbalWarningDesc);

        $('#written_warning_date').val(writtenWarningDate);
        $('#written_warning_description').val(writtenWarningDesc);

        $('#provisionary_date').val(provisionaryDate);
        $('#provisionary_description').val(provisionaryDesc);
    });
});
