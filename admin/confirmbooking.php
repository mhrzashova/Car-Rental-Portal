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
      <a href="confirmbooking.php">
     
      <?php
              if(isset($_POST['confirm'])){
                $confirm_booking=$_POST['confirm_booking'];
                
                $connection = new mysqli("localhost", "root", "", "carrentalportal");
                if ($connection->connect_errno != 0) {
                  die("<h1>404 Error Not Found</h1>");
                  }
                  $query = "update booking set status='1' WHERE book_id='$confirm_booking'";
                  $result = $connection->query($query);
                  if($result)
                  {
                    echo "
                    <script>alert('Confirmed Successfully.');</script>
                    ";
                  }
              }
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
    <legend>Confirmed Booking</legend>
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
            if (isset($_POST['confirm_booking'])) {
            $connection = new mysqli("localhost", "root", "", "carrentalportal");

            // Checking connection
            if ($connection->connect_errno != 0) {
                die("<h1>404 Error Not Found</h1>");
            }

           // Fetch booking details using the provided book_id
            $book_id = $_POST['confirm_booking'];
            $query = "SELECT * FROM booking WHERE status = '1'";
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
                        <form action='bookingdetails.php' method='post'>
                            <input type='hidden' value='".$row['book_id']."' name='viewconfirm_booking'>
                            <input type='submit' value = 'View' name='view'>
                        </form> 
                </td>           
                </tr>
                ";
                }
            } else {
                echo "<tr><td colspan='3'>No confirmed booking found.</td></tr>";
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

    