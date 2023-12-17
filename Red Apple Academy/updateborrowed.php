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
    $bookName = $_POST["bookname"];
    $studentName = $_POST["studentname"];
    $studentAdmNo = $_POST["studentadmno"];

    // Update the borrowed book details
    $sql = "UPDATE borrowed SET bookcode = ?, bookname = ?, studentname = ?, studentadmno = ? WHERE bookcode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $bookcode, $bookName, $studentName, $studentAdmNo, $bookcode);

    if ($stmt->execute()) {
        header("Location: viewborrowed.php");
        exit;
    } else {
        echo "Error updating borrowed book: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
