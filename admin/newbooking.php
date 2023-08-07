<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/customerlist.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <?php include('includes/header.php');?>
  
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard"></span>
      </div>
      <div class="profile-details">
      <a href="newbooking.php">
      <?php 
              session_start();
              if(!isset($_SESSION['admin']))//databse ko table ko nam
              {
                //yedi session xaina vane login ma pathaidine
                header("Location:index.php");
              }
              $row = $_SESSION['admin'];
              $adminid = $row['adminid'];
              echo ($row['email']); 
              ?>
            </a>
      </div>
    </nav>
    <div class="home-content">
    <legend>Booking List</legend>
        <table>
            <tr>
                <th>Book Id</th>
                <th>Booking Number</th>
                <th>User Id</th>
                <th>Vehicle Id</th>
                <th>From Location</th>
                <th>To Location</th>
                <th>Pickup Date</th>
                <th>Return Date</th>
                <th>Trip Type</th>
                <th>Status</th>
                <th>Creation Date</th>
                <th>Action</th>
            </tr>
            <?php
            // Database connection
            $connection = new mysqli("localhost", "root", "", "carrentalportal");

            // Checking connection
            if ($connection->connect_errno != 0) {
                die("<h1>404 Error Not Found</h1>");
            }

            // Fetch customers from the database
            $query = "SELECT * FROM booking where status='0'";
            $result = $connection->query($query);

            // Check if there are any customers
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>".$row['book_id']."</td>
                    <td>".$row['bookingnumber']."</td>
                    <td>".$row['user_id']."</td>
                    <td>".$row['vehicleid']."</td>
                    <td>".$row['fromlocation']."</td>
                    <td>".$row['tolocation']."</td> 
                    <td>".$row['pickup_date']."</td> 
                    <td>".$row['return_date']."</td> 
                    <td>".$row['triptype']."</td> 
                    <td>".$row['status']."</td>
                    <td>".$row['creationdate']."</td>
                    <td>
                        <form action='viewbooking.php' method='post'>
                            <input type='hidden' value='".$row['book_id']."' name='view_booking'>
                            <input type='submit' value = 'View' name='view'>
                        </form> 
                </td>           
                </tr>
                ";
                }
            } else {
                echo "<tr><td colspan='3'>No booking found.</td></tr>";
            }

            // Close the database connection
            $connection->close();
            ?>
        </table>
      </div>
    </div>
  </section>

<!-- Link To JS -->
<script src="js/all.js"></script>

</body>
</html>

    