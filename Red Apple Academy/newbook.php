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
    $bookname = $conn->real_escape_string($_POST["bookname"]);
    $bookcode = $conn->real_escape_string($_POST["bookcode"]);
   

    // Handle image upload
    if (isset($_FILES["image"])) {
        $targetDirectory = "uploads/"; // Directory where you want to store the uploaded images
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Image uploaded successfully, now insert data into the database
            $sql = "INSERT INTO books ( bookimage, bookname,bookcode) VALUES ('$targetFile', '$bookname','$bookcode')";

            if ($conn->query($sql) === TRUE) {
                $successful_insert= "Data inserted successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your image.";
        }
    } else {
        echo "No image was selected.";
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
                <li><a href="newbook.php" >Add New Books</a></li>
              
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
            
            <h1>Add New Book</h1>
            
            <form action="newbook.php" method="post" enctype="multipart/form-data">
            <label>Book Image</label>
            <input type="file" name="image" accept="image/*" required onchange="previewImage(this);">
            <img id="image-preview" src="#" alt="Image Preview" style="display: none;max-width:14%;">
            <label>Book Name</label>
            <input type="text" name="bookname"required> 
            <label>Book Code</label>
            <input type="text" name="bookcode"  required>
            <input type="submit" id="btn" value="Upload">

    </form>
   
    <script>
        function previewImage(input) {
            var preview = document.getElementById('image-preview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
    
            
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>