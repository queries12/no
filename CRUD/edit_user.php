<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    echo "You must be logged in.";
    exit;
}

$userId = $_SESSION['user']['id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$age = $_POST['age'];

// Check if the new email is already taken by another user
$checkQuery = "SELECT * FROM users WHERE email='$email' AND id!=$userId";
$result = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($result) > 0) {
    echo "Email is already in use by another user.";
} else {
    // Update user details
    $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', age='$age' WHERE id=$userId";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['user']['firstname'] = $firstname;
        $_SESSION['user']['lastname'] = $lastname;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['age'] = $age;
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile.";
    }
}
?>
