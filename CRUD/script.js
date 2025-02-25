$(document).ready(function() {
    $("#registerForm").submit(function(e) {
        e.preventDefault(); // Prevent form submission

        let firstname = $("#firstname").val().trim();
        let lastname = $("#lastname").val().trim();
        let email = $("#email").val().trim();
        let password = $("#password").val().trim();
        let age = $("#age").val().trim();
        let error = false;

        // Clear previous error messages
        $(".error").remove();

        // Validate First Name
        if (firstname === "") {
            $("#firstname").after("<span class='error' style='color:red;'>First name is required</span>");
            error = true;
        }

        // Validate Last Name
        if (lastname === "") {
            $("#lastname").after("<span class='error' style='color:red;'>Last name is required</span>");
            error = true;
        }

        // Validate Email
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (email === "") {
            $("#email").after("<span class='error' style='color:red;'>Email is required</span>");
            error = true;
        } else if (!email.match(emailPattern)) {
            $("#email").after("<span class='error' style='color:red;'>Enter a valid email</span>");
            error = true;
        }

        // Validate Password
        if (password === "") {
            $("#password").after("<span class='error' style='color:red;'>Password is required</span>");
            error = true;
        } else if (password.length < 6) {
            $("#password").after("<span class='error' style='color:red;'>Password must be at least 6 characters</span>");
            error = true;
        }

        // Validate Age (must be 18 or above)
        if (age === "") {
            $("#age").after("<span class='error' style='color:red;'>Age is required</span>");
            error = true;
        } else if (isNaN(age) || age < 18) {
            $("#age").after("<span class='error' style='color:red;'>You must be 18 or older</span>");
            error = true;
        }

        // If no errors, send data via AJAX
        if (!error) {
            $.ajax({
                url: "register.php",
                type: "POST",
                data: { firstname, lastname, email, password, age },
                success: function(response) {
                    $("#message").html(response);
                    if (response.includes("successful")) {
                        $("#registerForm")[0].reset(); // Reset form on success
                    }
                }
            });
        }
    });
});
