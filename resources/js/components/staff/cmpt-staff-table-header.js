// Search input js

$(document).ready(function () {
    var searchInput = $("#searchInput");
    var tableBody = $("#example2");

    searchInput.on("keyup", function () {
        var searchValue = searchInput.val().toLowerCase();

        var filteredRows = tableBody.find(".table-row").filter(function () {
            return $(this).text().toLowerCase().indexOf(searchValue) > -1;
        });

        tableBody.find(".table-row").hide();
        filteredRows.show();
    });
});

$(document).ready(function () {
    $("#add-btn").click(function () {
        const addModal = $("#addModal");

        addModal.modal("show");
    });
});

// Header buttons js

$(document).ready(function () {
    var batchYearDropdown = $(".batch-year-dropdown");
    var orderByDropdown = $(".order-by-dropdown");
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

    var resetFilterBtn = $(".reset-filter-btn");

    resetFilterBtn.on("click", function () {
        batchYearDropdown.find(".nav-link").text("Year");
        orderByDropdown.find(".nav-link").text("Order By");
        tableBody.find(".table-row").show();
    });
});

// Order by js

$(document).ready(function () {
    // Define the sortTableById function
    function sortTableById(order = "asc") {
        // Get the table body element
        var tableBody = $(".table-body");

        // Get the table rows
        var rows = tableBody.find(".table-row");

        // Sort the rows based on the user id column data
        rows.sort(function (a, b) {
            var aValue = $(a).find("td:eq(0)").text();
            var bValue = $(b).find("td:eq(0)").text();
            if (order == "asc") {
                return aValue.localeCompare(bValue);
            } else {
                return bValue.localeCompare(aValue);
            }
        });

        // Empty the current table body and add the sorted rows back in
        tableBody.empty();
        rows.appendTo(tableBody);

        // Update the Order By label to show the option that was selected
        if (order == "asc") {
            $(".sort-by-user-id .nav-link").text("Ascending Order");
        } else {
            $(".sort-by-user-id .nav-link").text("Descending Order");
        }
    }

    // Attach a click event to the Order By dropdown links
    $(".sort-by-user-id .dropdown-item").on("click", function () {
        var orderType = $(this).data("type");
        if (orderType == "all") {
            sortTableById("asc"); // Sort in ascending order
        } else if (orderType == "all-other") {
            sortTableById("desc"); // Sort in descending order
        }
    });
});
