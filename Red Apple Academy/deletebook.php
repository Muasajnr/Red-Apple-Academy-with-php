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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $bookId = $_GET["id"];

    // Delete the book
    $sql = "DELETE FROM books WHERE bookimage = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bookId);
    
    $response = array();

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = "Error deleting book: " . $stmt->error;
    }

    $stmt->close();

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request.";

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>
