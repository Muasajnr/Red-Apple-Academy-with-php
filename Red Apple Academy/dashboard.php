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

// Query to count items in the books table****
$sql = "SELECT COUNT(*) as total_items FROM books";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    $books= $row['total_items'];
  
} else {
    // Display an error message if the query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//**** *

// Query to count items in the borrowed table****
$sql = "SELECT COUNT(*) as total_items FROM borrowed";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    $borrowed= $row['total_items'];
  
} else {
    // Display an error message if the query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//**** *

// Query to count items in the returned table****
$sql = "SELECT COUNT(*) as total_items FROM returned";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    $returned= $row['total_items'];
  
} else {
    // Display an error message if the query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//**** *

// Query to count items in the lostbooks table****
$sql = "SELECT COUNT(*) as total_items FROM lostbooks";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    $lostbooks= $row['total_items'];
  
} else {
    // Display an error message if the query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//**** *

// Close the connection
$conn->close();
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

    <div class="dashboard-content"style="height: 115vh;">
    <div class="row">


<div class="col-lg-10 e-3">
  <div class="row ">

    
    <div class="col-xxl-4 col-md-6 mb-2">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h3 class="card-title">Total Books </h3>
         
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle bg-primary-subtle  w-25 h-50 p-1 d-flex align-items-center justify-content-center  ">
            <i class="bi bi-folder-symlink-fill fs-1 text-purple"></i>  
            
              
            </div>
            <div class="ps-3">
              <h4><?php echo $books ?></h4>
              <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="col-xxl-4 col-md-6 mb-2">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h3 class="card-title">Borrowed Books </h3>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle bg-primary-subtle w-25 h-50 p-1 d-flex align-items-center justify-content-center">
                    <i class="bi bi-folder-minus text-success fs-1"></i>  
                  
                    </div>
                    <div class="ps-3">
                      <h4><?php echo $borrowed ?></h4>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h3 class="card-title">Returned Books </h3>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle  rounded-circle bg-primary-subtle  w-25 h-50 p-1 d-flex align-items-center justify-content-center">
                    <i class="bi bi-journal-arrow-down text-success fs-1"></i> 
                    
                    </div>
                    <div class="ps-3">
                    <h4><?php echo $returned ?></h4>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>


            <div class="col-xxl-4 col-md-6 mb-2">
              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h3 class="card-title">Lost Books </h3>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle bg-primary-subtle w-25 h-50 p-1 d-flex align-items-center justify-content-center">
                    <i class="bi bi-folder-x text-success fs-1"></i>  
                    
                    </div>
                    <div class="ps-3">
                    <h4><?php echo $lostbooks ?></h4>
                      <span class="text-danger small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>
            


            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                

                <div class="card-body">
                  <h3 class="card-title">All Students </h3>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle bg-primary-subtle  w-20 h-50 p-3 d-flex align-items-center justify-content-center">
                      <i class="bi bi-people text-danger fs-1"></i>
                    </div>
                    <div class="ps-3">
                      <h4>421</h4>
                      <span class="text-danger small pt-1 fw-bold">2%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>
            
    </div>
   



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>