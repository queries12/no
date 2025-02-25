<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $age = intval($_POST['age']);

    // Basic Validation
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($age)) {
        echo "<p style='color:red;'>All fields are required!</p>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Invalid email format!</p>";
        exit;
    }

    if (strlen($password) < 6) {
        echo "<p style='color:red;'>Password must be at least 6 characters!</p>";
        exit;
    }

    if ($age < 18) {
        echo "<p style='color:red;'>You must be 18 years or older to register.</p>";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if email exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "<p style='color:red;'>Email already registered!</p>";
        exit;
    }

    // Insert User
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, age) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $firstname, $lastname, $email, $hashedPassword, $age);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Registration successful!</p>";
    } else {
        echo "<p style='color:red;'>Error registering user.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
