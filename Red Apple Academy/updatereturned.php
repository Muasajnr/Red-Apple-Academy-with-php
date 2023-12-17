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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["bookcode"])) {
    $bookcode = $_POST["bookcode"];
    $bookName = $_POST["bookName"];
    $studentName = $_POST["studentName"];
    $studentAdmNo = $_POST["studentAdmNo"];

    // Update the returned book details
    $sql = "UPDATE returned SET bookname = ?, studentname = ?, studentadmno = ? WHERE bookcode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $bookName, $studentName, $studentAdmNo, $bookcode); // Corrected the binding parameters

    if ($stmt->execute()) {
        header("Location: viewreturned.php");
        exit;
    } else {
        echo "Error updating returned book: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
