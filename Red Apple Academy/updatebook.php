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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $bookId = $_POST["id"];
    $bookName = $_POST["bookName"];
    $bookCode = $_POST["bookCode"];

    // Update the book details
    $sql = "UPDATE books SET bookname = ?, bookcode = ? WHERE bookimage = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $bookName, $bookCode, $bookId);

    if ($stmt->execute()) {
        header("Location: viewallbooks.php");
        exit;
    } else {
        echo "Error updating book: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
