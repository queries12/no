<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    echo "You must be logged in.";
    exit;
}

$userId = $_SESSION['user']['id'];
$query = "DELETE FROM users WHERE id=$userId";

if (mysqli_query($conn, $query)) {
    session_destroy();
    echo "success";
} else {
    echo "Error deleting account.";
}
?>
