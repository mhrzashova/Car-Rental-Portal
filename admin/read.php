<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admindashboard.css">
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
      <a href="read.php">
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
        <legend>Vehicle List</legend>
        <a href="create.php"><button>New</button></a>
        <table border='1' width="100%">
        <tr>
            <th>VehicleId</th><th>Vehicle Name</th><th>Brand Name</th><th>Vehicle Reg. Number</th><th>Vehicle Images<th>Vehicle Availability</th><th>Price Per Day</th><th>Mileage</th><th>Seat Capacity</th><th>Action</th> 
        </tr>
        <?php
            $connection= new mysqli("localhost","root","","carrentalportal");
            if($connection->connect_errno!=0){
                die("connection failed");
            }
            $sql="SELECT * FROM crud";
            if($result = $connection->query($sql))
            {
                while($row = $result->fetch_assoc())
            {
              $vehicleId = $row['vehicleid'];
              $vehicleavailability = "Available"; // Default availability

              // Fetch booking records for the current vehicle
              $bookingSql = "SELECT * FROM booking WHERE vehicleid = $vehicleId";
              if ($bookingResult = $connection->query($bookingSql)) {
                  while ($bookingRow = $bookingResult->fetch_assoc()) {
                      $pickupDate = strtotime($bookingRow['pickup_date']);
                      $returnDate = strtotime($bookingRow['return_date']);
                      $currentDate = time();

                      if ($currentDate >= $pickupDate && $currentDate <= $returnDate) {
                          // If current date falls within booking range, set availability to "Booked"
                          $vehicleavailability = "Booked";
                          break; // No need to check further, as it's already booked
                      }
                  }
              }
              // Update the vehicleavailability column in the database
              $updateAvailabilityQuery = "UPDATE crud SET vehicleavailability = '$vehicleavailability' WHERE vehicleid = $vehicleId";
              $connection->query($updateAvailabilityQuery);

                echo "
                    <tr>
                    <td>".$row['vehicleid']."</td>
                    <td>".$row['vehiclename']."</td>
                    <td>".$row['brandname']."</td>
                    <td>".$row['vehicleno']."</td>
                    <td>".$row['vehicleimages']."</td>
                    <td>$vehicleavailability</td> 
                    <td>".$row['priceperday']."</td> 
                    <td>".$row['mileage']."</td> 
                    <td>".$row['seatcapacity']."</td> 
                    <td>
                        <form action='update.php' method='post'>
                            <input type='hidden' value='".$row['vehicleid']."' name='vehicle_update'>
                            <input type='submit' value = 'update' name='update'>
                        </form> 

                        <form action='delete.php' method='post'>
                            <input type='hidden' value='".$row['vehicleid']."'name='vehicle_delete'>
                            <input type='submit'value = 'Delete' name='delete'>
                        </form> 

                </td>           
                </tr>
                ";
            }
        }

        ?>
    </table>
    </div>
  </section>

  <!-- Link To JS -->
<script src="js/all.js"></script>

</body>
</html>

