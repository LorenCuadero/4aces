document.addEventListener("DOMContentLoaded", function () {
    // Get the toggle button and menu elements
    var toggleButton = document.getElementById("pushMenuToggle");
    var menu = document.querySelector(".main-sidebar");

    // Add click event listener to the toggle button
    toggleButton.addEventListener("click", function () {
        // Toggle the 'sidebar-collapse' class on the sidebar
        sidebar.classList.toggle("sidebar-collapse");
    });
});
