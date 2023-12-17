<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "red_apple_academy";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $bookcode = $_POST["bookcode"];
    $bookname = $_POST["bookname"];
    $studentname = $_POST["studentname"];
    $studentadmno = $_POST["studentadmno"];
    $bookprice = $_POST["bookprice"];

    // Prepare and execute the update query
    $sql = "UPDATE lostbooks SET 
            bookname = ?,
            studentname = ?,
            studentadmno = ?,
            bookprice = ?
            WHERE bookcode = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $bookname, $studentname, $studentadmno, $bookprice, $bookcode);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        // Update successful
        header("Location: viewlost.php");
        exit();
    } else {
        // Handle error
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

