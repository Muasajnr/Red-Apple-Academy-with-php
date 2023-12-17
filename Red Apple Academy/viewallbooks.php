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

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

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

    <div class="viewfeatured">
        <h3>All Books</h3>
    <?php
// Fetch data from the database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>


    <table>
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Code</th>
            
            
        </tr>
        <?php
        $count=1;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo '<td>' . $count . '</td>';
                echo "<td><img src='" . $row["bookimage"] . "' alt='Car Image' style='max-width: 100px;'></td>";
                echo "<td>" . $row["bookname"] . "</td>";
                echo "<td>" . $row["bookcode"] . "</td>";
                echo "<td>
                        <a href='editbook.php?id={$row['bookimage']}' style='color: blue; text-decoration: underline;'>Edit</a> | 
                        <a href='#' class='delete-link' data-id='{$row['bookimage']}' style='color: blue; text-decoration: underline;'>Delete</a>
                    </td>";

               
                echo "</tr>";
                $count++;
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        ?>
    </table>

<?php
// Close the database connection
$conn->close();
?>
    </div>
   

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> 

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Attach a click event listener to all delete links
        document.querySelectorAll('.delete-link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();

                // Confirm before deletion
                if (confirm('Are you sure you want to delete this book?')) {
                    // Get the book ID from the data attribute
                    var bookId = link.getAttribute('data-id');

                    // Make an Ajax request to deletebook.php
                    fetch('deletebook.php?id=' + bookId, {
                        method: 'GET',
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response
                        if (data.success) {
                            // Reload the page or update the UI as needed
                            window.location.reload();
                        } else {
                            alert('Error deleting book: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An unexpected error occurred.');
                    });
                }
            });
        });
    });
</script>

</body>
    </html>