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

    // Get user input from the login form
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Query to check if the user exists
    $sql = "SELECT * FROM users WHERE username = '$input_username'";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Check if a matching user was found
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($input_password, $row['password'])) {
                // Password is correct, start a session and store username
                $_SESSION['username'] = $input_username;
                header("Location: index.php"); // Redirect to the main page
            } else {
                echo "<p>Incorrect password. Please try again.</p>";
                include "login_form.php";
            }
        } else {
            echo "<p>Username not found. Please try again.</p>";
            include "login_form.php";
        }
    } else {
        // Display an error message if the query fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
