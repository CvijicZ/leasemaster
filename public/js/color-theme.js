$(document).ready(function () {
    // Load the theme from the cookie
    const currentTheme = document.documentElement.getAttribute("data-theme");
    if (currentTheme === "dark") {
        $("#theme-switch").prop("checked", true);
    }

    // Check if the theme cookie exists
    const themeCookie = document.cookie.split('; ').find(row => row.startsWith('theme='));

    if(!themeCookie){
        $("#themeGuide").removeClass('d-none');
    }

    $(document).on('click', '.dismiss-guide', function () {
        $('#themeGuide').addClass('d-none');
    });

    $(document).on('click', '#themeDropdown', function () {
        $('#themeGuide').addClass('d-none');
    });
 

    // Toggle theme on switch
    $("#theme-switch").on("change", function () {
        const newTheme = $(this).is(":checked") ? "dark" : "light";
        $("html").attr("data-theme", newTheme); // Change html attribute

        document.cookie = `theme=${newTheme}; path=/; max-age=${60 * 60 * 24 * 365}`; // Set cookie to store user's preference
    });

  
});

$.getCookie = function(name) {
    const cookies = document.cookie.split("; ");
    for (let i = 0; i < cookies.length; i++) {
        const [key, value] = cookies[i].split("=");
        if (key === name) {
            return decodeURIComponent(value);
        }
    }
    return null;
};