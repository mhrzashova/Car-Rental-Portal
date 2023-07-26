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
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
      <a href="customerlist.php">
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
    <legend>Cancelled Booking</legend>
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
            </tr>
            <?php
            if (isset($_POST['view_booking'])) {
            // Database connection
            $connection = new mysqli("localhost", "root", "", "carrentalportal");

            // Checking connection
            if ($connection->connect_errno != 0) {
                die("<h1>404 Error Not Found</h1>");
            }

            // Fetch booking details using the provided book_id
            $book_id = $_POST['cancel_booking'];
            $query = "SELECT * FROM booking WHERE book_id = '$book_id'";
            $result = $connection->query($query);

            // Check if there are any customers
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['bookingnumber'] . "</td>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['vehicleid'] . "</td>";
                    echo "<td>" . $row['fromlocation'] . "</td>";
                    echo "<td>" . $row['tolocation'] . "</td>";
                    echo "<td>" . $row['pickup_date'] . "</td>";
                    echo "<td>" . $row['return_date'] . "</td>";
                    echo "<td>" . $row['triptype'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['creationdate'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No cancelled vehicle found.</td></tr>";
            }

            // Close the database connection
            $connection->close();
        }
            ?>
        </table>
      </div>
    </div>
  </section>

<!-- Link To JS -->
<script src="js/all.js"></script>

</body>
</html>

    