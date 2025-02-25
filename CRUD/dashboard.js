$(document).ready(function() {
    $("#editButton").click(function() {
        $("#editForm").toggle();
    });

    $("#editForm").submit(function(e) {
        e.preventDefault();

        let firstname = $("#editFirstname").val();
        let lastname = $("#editLastname").val();
        let email = $("#editEmail").val();
        let age = $("#editAge").val();

        $.ajax({
            url: "edit_user.php",
            type: "POST",
            data: { firstname, lastname, email, age },
            success: function(response) {
                $("#message").html(response);
                if (response.includes("success")) {
                    $("#userName").text(firstname + " " + lastname);
                    $("#userEmail").text(email);
                    $("#userAge").text(age);
                    $("#editForm").hide();
                }
            }
        });
    });

    $("#deleteButton").click(function() {
        if (confirm("Are you sure you want to delete your account?")) {
            $.ajax({
                url: "delete_user.php",
                type: "POST",
                success: function(response) {
                    if (response.includes("success")) {
                        window.location.href = "login.html";
                    } else {
                        $("#message").html(response);
                    }
                }
            });
        }
    });
});
