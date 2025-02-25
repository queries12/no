<?php
require 'db.php';

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$age = $_POST['age'];

// Check if email already exists
$checkQuery = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($result) > 0) {
    echo "Email is already registered. Please use a different email.";
} else {
    // Insert user into database
    $query = "INSERT INTO users (firstname, lastname, email, password, age) VALUES ('$firstname', '$lastname', '$email', '$password', '$age')";
    
    if (mysqli_query($conn, $query)) {
        echo "Registration successful!";
    } else {
        echo "Error registering user.";
    }
}
?>
