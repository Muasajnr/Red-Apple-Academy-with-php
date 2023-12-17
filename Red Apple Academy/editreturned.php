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

    // Fetch the details of the specific returned book
    $sql = "SELECT * FROM returned WHERE bookcode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bookcode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bookCode = $row['bookcode'];
        $bookName = $row['bookname'];
        $studentName = $row['studentname'];
        $studentAdmNo = $row['studentadmno'];

        // Display the edit form
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="../assets/logo.jpg" rel="icon">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
            <link rel="stylesheet" href="assets/style.css">
            <title>Edit Returned Book</title>
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
        </head>
        <body>
            
            <form action="updatereturned.php" method="post">
            <h2>Edit Returned Book</h2>
                <input type="hidden" name="bookcode" value="<?php echo $bookCode; ?>">

                <label for="bookName">Book Name:</label>
                <input type="text" name="bookName" value="<?php echo $bookName; ?>" required>

                <label for="studentName">Student Name:</label>
                <input type="text" name="studentName" value="<?php echo $studentName; ?>" required>

                <label for="studentAdmNo">Student Admission No:</label>
                <input type="text" name="studentAdmNo" value="<?php echo $studentAdmNo; ?>" required>

                <input type="submit" value="Update">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Returned book not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
