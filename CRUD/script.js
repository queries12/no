$(document).ready(function() {
    $("#registerForm").submit(function(e) {
        e.preventDefault();

        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let email = $("#email").val();
        let password = $("#password").val();
        let age = $("#age").val();

        $.ajax({
            url: "register.php",
            type: "POST",
            data: { firstname, lastname, email, password, age },
            success: function(response) {
                $("#message").html(response);
                $("#registerForm")[0].reset();
            },
            error: function() {
                $("#message").html("<p style='color:red;'>Error submitting form.</p>");
            }
        });
    });
});
