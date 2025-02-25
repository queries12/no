$(document).ready(function() {
    $("#loginForm").submit(function(e) {
        e.preventDefault();

        let email = $("#email").val();
        let password = $("#password").val();

        $.ajax({
            url: "login.php",
            type: "POST",
            data: { email, password },
            success: function(response) {
                if (response.includes("success")) {
                    window.location.href = "dashboard.php"; // Redirect on success
                } else {
                    $("#message").html(response);
                }
            },
            error: function() {
                $("#message").html("<p style='color:red;'>Error logging in.</p>");
            }
        });
    });
});
