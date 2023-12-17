<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "red_apple_academy"; 
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input from the registration form
    $new_username = $_POST['new_username'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT); // Hash the password

    // Query to insert a new user
    $sql = "INSERT INTO users (username, password) VALUES ('$new_username', '$new_password')";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        echo "<p>Account Recovery successful! You can now <a href='index.php'>log in</a>.</p>";
       
    } else {
        // Display an error message if the query fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
