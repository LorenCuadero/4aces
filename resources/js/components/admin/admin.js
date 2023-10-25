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

$(document).ready(function() {
    $(".dropdown-item").click(function() {
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

