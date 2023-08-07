<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title>Booking Details</title>
  <link rel="stylesheet" href="css/customerlist.css">
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
      <a href="viewbooking.php">
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
    <?php
    // Check if user is logged in as admin
    if(!isset($_SESSION['admin'])) {
      // Redirect to login page if not logged in
      header("Location:index.php");
      exit;
    }

    // Check if the booking ID is set
    if (isset($_POST['view_booking'])) {
      // Database connection
      $connection = new mysqli("localhost", "root", "", "carrentalportal");

      // Checking connection
      if ($connection->connect_errno != 0) {
        die("<h1>404 Error Not Found</h1>");
      }

      // Fetch booking details using the provided book_id
      $book_id = $_POST['view_booking'];
      $query = "SELECT * FROM booking WHERE book_id = '$book_id'";
      $result = $connection->query($query);

      // Check if the booking exists
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <h2>Booking Details</h2>
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
          <tr>
            <td><?= $row['book_id'] ?></td>
            <td><?= $row['bookingnumber'] ?></td>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['vehicleid'] ?></td>
            <td><?= $row['fromlocation'] ?></td>
            <td><?= $row['tolocation'] ?></td>
            <td><?= $row['pickup_date'] ?></td>
            <td><?= $row['return_date'] ?></td>
            <td><?= $row['triptype'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['creationdate'] ?></td>
          </tr>
        </table>
        <br>
        <form action="confirmbooking.php" method="post" style="display: inline;">
          <input type="hidden" value="<?php echo $row['book_id'] ?>" name="confirm_booking">
          <input type="submit" value="Confirm Booking" name="confirm">
        </form>
        <form action="cancelbooking.php" method="post" style="display: inline;">
          <input type="hidden" value="<?php echo $row['book_id'] ?>" name="cancel_booking">
          <input type="submit" value="Cancel Booking" name="cancel">
        </form>
        <?php
      } else {
        echo "<p>Booking not found.</p>";
      }

      // Close the database connection
      $connection->close();
    } else {
      echo "<p>Booking ID not provided.</p>";
    }
    ?>
  </div>
</section>

<!-- Link To JS -->
<script src="js/all.js"></script>

</body>
</html>
