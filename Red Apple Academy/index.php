<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>

<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    echo "<p>Welcome, {$_SESSION['username']}! You are already logged in.</p>";
    echo "<p><a href='logout.php'>Logout</a></p>";
    header("location:dashboard.php");
} else {
    // Display the login form if not logged in
    include "login_form.php";
}
?>

</body>
</html>
