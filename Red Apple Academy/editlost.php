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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["bookcode"])) {
    $bookcode = $_GET["bookcode"];

    // Fetch the lost book data based on bookcode
    $sql = "SELECT * FROM lostbooks WHERE bookcode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bookcode);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    $stmt->close();
} else {
    // Redirect to the viewlost.php page if bookcode is not provided
    header("Location: viewlost.php");
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/logo.jpg" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
        crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <title>Edit Lost Book</title>
</head>

<body>
   
    <style>
        body {
            background-color: #7cebe552; 
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 380px; 
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff; 
            color: #fff;
            cursor: pointer;
        }
    </style>
    <div class="viewfeatured">
        
        <form method="post" action="updatelost.php">
        <h3>Edit Lost Book</h3>
            <div class="mb-3">
                <label for="bookcode" class="form-label">Book Code</label>
                <input type="text" class="form-control" id="bookcode" name="bookcode" value="<?php echo $book['bookcode']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="bookname" class="form-label">Book Name</label>
                <input type="text" class="form-control" id="bookname" name="bookname" value="<?php echo $book['bookname']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="studentname" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo $book['studentname']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="studentadmno" class="form-label">Student Admission Number</label>
                <input type="text" class="form-control" id="studentadmno" name="studentadmno" value="<?php echo $book['studentadmno']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="bookprice" class="form-label">Book Price</label>
                <input type="text" class="form-control" id="bookprice" name="bookprice" value="<?php echo $book['bookprice']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Lost Book</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>
