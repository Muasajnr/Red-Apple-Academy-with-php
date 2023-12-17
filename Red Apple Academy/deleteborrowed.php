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

    // Delete the borrowed book
    $sql = "DELETE FROM borrowed WHERE bookcode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bookId);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Error deleting borrowed book: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request."]);
}

$conn->close();
?>
