$(document).ready(function () {
    // Load the theme from the cookie
    const currentTheme = document.documentElement.getAttribute("data-theme");
    if (currentTheme === "dark") {
        $("#theme-switch").prop("checked", true);
    }

    // Toggle theme on switch
    $("#theme-switch").on("change", function () {
        const newTheme = $(this).is(":checked") ? "dark" : "light";
        $("html").attr("data-theme", newTheme); // Change html attribute

        document.cookie = `theme=${newTheme}; path=/; max-age=${60 * 60 * 24 * 365}`; // Set cookie to store user's preference
    });
});