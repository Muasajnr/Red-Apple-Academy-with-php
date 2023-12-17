<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "red_apple_academy"; 

    // Create a connection to the MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process and sanitize form data
    $bookcode = $conn->real_escape_string($_POST["bookcode"]);
    $bookname = $conn->real_escape_string($_POST["bookname"]);
    $studentname = $conn->real_escape_string($_POST["studentname"]);
    $studentadmno = $conn->real_escape_string($_POST["studentadmno"]);

    $error_message = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the entered book code and student admission number from the form
        $enteredBookCode = $_POST['bookcode'];
        $enteredStudentAdmNo = $_POST['studentadmno'];
    
        // Query to check if the book code and student admission number exist in the borrowed table
        $sql = "SELECT * FROM borrowed WHERE bookcode = '$enteredBookCode' AND studentadmno = '$enteredStudentAdmNo'";
        $result = $conn->query($sql);
    
        // Check if the query was successful
        if ($result) {
            // Check if a matching record was found
            if ($result->num_rows > 0) {
                
                    $sql = "INSERT INTO returned ( bookcode, bookname,studentname, studentadmno) VALUES ('$bookcode','$bookname', '$studentname','$studentadmno')";
                    if ($conn->query($sql) === TRUE) {
                        $successful_insert= "Data inserted successfully.";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    } else {
                        // Set the error message
                        $error_message = "No matching record found for Book code '$enteredBookCode' and Student Admission Number '$enteredStudentAdmNo'.";
                    }
        } else {
            // Display an error message if the query fails
             $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    
        

    // Close the database connection
    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/logo.jpg" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet"href="assets/style.css">
    <title>Red Apple Academy</title>
</head>
<body>
<div class="top">
    <img src="./assets/logo.jpg"style="width:250px;height:100px;margin-left:20px;">
    <h1 >Library Management System</h1>
    <form class="search-bar" style=" float:right;width:65%;margin-top:-75px;" method="post"action="">
    <input type="search" placeholder="Search Books Here" style="margin-inline:auto ; width:25%;padding:10px;border:none; float:inline;margin-top:-5px;"><button class="bi bi-search" style="padding:10px;border:none;background-color:#000;color:white;"></button>
    </form>
</div>

    <div class="menu" style="height: 100vh;">
    
        <nav class="nav">
            <ol>
            <li ><a href="dashboard.php" aria-current="index.php" ><i class="bi bi-grid-fill"> </i> Dashboard</a></li>

            </ol>
            <ol>
                <th><b><i class="bi bi-clipboard-plus"></i> Update Books</b></th>
                <li ><a href="newbook.php" >Add New Books</a></li>
              
                <li ><a href="lendbook.php" >Lend a Book</a></li>
                <li ><a href="recieveback.php" >Recieve a Book</a></li>
                <li ><a href="lostbooks.php" >Lost Book</a></li>
                
            </ol>
            <ol>
            <th ><b><i class="bi bi-file-medical-fill"></i>View All Books</b></th>
            <li ><a href="viewallbooks.php" >All Books</a></li>
                
                <li ><a href="viewborrowed.php" >Borrowed Books</a></li>
                <li ><a href="viewreturned.php" >Ruturned Books</a></li>
                <li ><a href="viewlost.php" >Lost Books</a></li>
                <li ><a href="logout.php" >Log Out <i class="bi bi-box-arrow-right"></i></a></li>
            </ol>
            
            
        </nav>
        
    </div>

    <section class="content">
        <div class="featured-content">
            
            <h1>Recieve Back a Book</h1>
            
            <form action="recieveback.php" method="post" enctype="multipart/form-data">
            <p style="color: red;"><?php echo isset($error_message) ? $error_message : ''; ?></p>

            <label>Book Code</label>
            <input type="text" name="bookcode" id="bookcode"required>
            <label>Book Name</label>
            <input type="text" name="bookname"required>
            <label>Student Name</label>
            <input type="text" name="studentname"required>
            <label>Student Adm No.</label>
            <input type="text" name="studentadmno" id="studentadmno" required>
            <input type="submit" id="btn" value="Upload">

    </form>
   
  
    
            
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>