<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 400px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        input { width: 100%; padding: 8px; margin: 5px 0; }
        button { padding: 10px; margin-top: 5px; cursor: pointer; }
        .edit { background: blue; color: white; }
        .delete { background: red; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <span id="userName"><?php echo $user['firstname'] . " " . $user['lastname']; ?></span>!</h2>
        <p>Email: <span id="userEmail"><?php echo $user['email']; ?></span></p>
        <p>Age: <span id="userAge"><?php echo $user['age']; ?></span></p>
        
        <!-- Edit Form -->
        <form id="editForm" style="display:none;">
            <input type="text" id="editFirstname" value="<?php echo $user['firstname']; ?>" required>
            <input type="text" id="editLastname" value="<?php echo $user['lastname']; ?>" required>
            <input type="email" id="editEmail" value="<?php echo $user['email']; ?>" required>
            <input type="number" id="editAge" value="<?php echo $user['age']; ?>" required min="18">
            <button type="submit" class="edit">Save Changes</button>
        </form>

        <button id="editButton" class="edit">Edit</button>
        <button id="deleteButton" class="delete">Delete Account</button>
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
        <div id="message"></div>
    </div>

    <script src="dashboard.js"></script>
</body>
</html>
