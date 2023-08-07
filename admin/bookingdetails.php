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
      <a href="bookingdetails.php">
     
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
        // Database connection
        $connection = new mysqli("localhost", "root", "", "carrentalportal");

        // Checking connection
        if ($connection->connect_errno != 0) {
            die("<h1>404 Error Not Found</h1>");
        }

        if (isset($_POST['viewconfirm_booking']) || isset($_POST['viewcancel_booking'])) {
          $book_id = isset($_POST['viewconfirm_booking']) ? $_POST['viewconfirm_booking'] : $_POST['viewcancel_booking'];

            // Fetch booking details using the provided book_id
            $query = "SELECT * FROM booking WHERE book_id = '$book_id'";
            $result = $connection->query($query);

            if ($result->num_rows > 0) {
                $bookingData = $result->fetch_assoc();

                // Calculate the total number of days
                $pickupDate = strtotime($bookingData['pickup_date']);
                $returnDate = strtotime($bookingData['return_date']);
                $totalDays = floor(($returnDate - $pickupDate) / (60 * 60 * 24));

                // Get user details
                $userId = $bookingData['user_id'];
                $userQuery = "SELECT * FROM users WHERE user_id = '$userId'";
                $userResult = $connection->query($userQuery);
                $userData = $userResult->fetch_assoc();

                // Get vehicle details
                $vehicleId = $bookingData['vehicleid'];
                $vehicleQuery = "SELECT * FROM crud WHERE vehicleid = '$vehicleId'";
                $vehicleResult = $connection->query($vehicleQuery);
                $vehicleData = $vehicleResult->fetch_assoc();

                /// Check if vehicle details are fetched successfully
            if ($vehicleResult->num_rows > 0) {
              $vehicleName = $vehicleData['vehiclename'];
              $brandName = $vehicleData['brandname'];
              $pricePerDay = $vehicleData['priceperday'];
          } else {
              $vehicleName = 'N/A';
              $brandName = 'N/A';
              $pricePerDay = 0;
          }

          $totalPrice = $totalDays * $pricePerDay;
          ?>
          <h2>Customer Details</h2>
            <table>
                <tr>
                    <th>Booking Number</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                </tr>
                <tr>
                    <td><?php echo $bookingData['bookingnumber']; ?></td>
                    <td><?php echo $userData['full_name']; ?></td>
                    <td><?php echo $userData['email']; ?></td>
                    <td><?php echo $userData['phoneno']; ?></td>
                </tr>
            </table>
            <br>
            <h2>Booking Details</h2>
            <table>
                <tr>
                    <th>Vehicle Name</th>
                    <th>Vehicle Brand</th>
                    <th>Booking Date</th>
                    <th>From Location</th>
                    <th>To Location</th>
                    <th>Pickup Date</th>
                    <th>Return Date</th>
                    <th>Price Per Day</th>
                    <th>Total Days</th>
                    <th>Total Price</th>
                    <th>Booking Status</th>
                </tr>
                <tr>
                    <td><?php echo $vehicleName; ?></td>
                    <td><?php echo $brandName; ?></td>
                    <td><?php echo $bookingData['creationdate']; ?></td>
                    <td><?php echo $bookingData['fromlocation']; ?></td>
                    <td><?php echo $bookingData['tolocation']; ?></td>
                    <td><?php echo $bookingData['pickup_date']; ?></td>
                    <td><?php echo $bookingData['return_date']; ?></td>
                    <td><?php echo $pricePerDay; ?></td>
                    <td><?php echo $totalDays; ?></td>
                    <td><?php echo $totalPrice; ?></td>
                    <td><?php echo ($bookingData['status'] == '1') ? 'Confirmed' : (($bookingData['status'] == '-1') ? 'Cancelled' : 'Unknown'); ?></td>
                </tr>
            </table>

            

            <?php
            } else {
                echo "<p>No booking details found.</p>";
            }
        } 
        // Close the database connection
        $connection->close();
        ?>
           <div class="print-button-container">
          <button onclick="printHomeContent()">Print Details</button>
        </div>
    </div>
    </section>
 
  <!-- JavaScript code for printing -->
  <script>
    function printHomeContent() {
      // Store the current content of the body
      var originalContent = document.body.innerHTML;

      // Temporarily remove all content from the body except the home-content div
      var homeContent = document.querySelector(".home-content").outerHTML;
      document.body.innerHTML = homeContent;

      // Print the content of the home-content section
      window.print();

      // Restore the original content of the body
      document.body.innerHTML = originalContent;
    }
  </script>

<!-- Link To JS -->
<script src="js/all.js"></script>

</body>
</html>