<?php
$validationMessage = "";

if(isset($_POST['create']))
{
    $vehiclename = $_POST['vehiclename'];
    $vehicleno = $_POST['vehicleno'];
    $vehicleavailability = $_POST['vehicleavailability'];
    $priceperday = $_POST['priceperday'];
    $mileage = $_POST['mileage'];
    $seatcapacity = $_POST['seatcapacity'];

    // Database Path
    $connection = new mysqli("localhost","root","","carrentalportal");

    // Checking of Connection
    if($connection->connect_errno != 0)
    {
        die("<h1>404 Error Not Found</h1>");
    }
    else
    {
        // Check if the vehicle already exists
        $existingVehicleQuery = "SELECT * FROM `crud` WHERE vehicleno = '$vehicleno'";
        $existingVehicleResult = $connection->query($existingVehicleQuery);
        if ($existingVehicleResult->num_rows > 0) {
            $validationMessage = "<h4 class='error-message'>Vehicle already exists</h4>";
        } else {
            // Upload the image
            $targetDirectory = "C:/xampp/htdocs/carrentalportal/uploaded_img/";
            $targetFile = $targetDirectory . basename($_FILES["vehicleimages"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
            if (move_uploaded_file($_FILES["vehicleimages"]["tmp_name"], $targetFile)) {
                $vehicleimages = basename($_FILES["vehicleimages"]["name"]);

                $sql = "INSERT INTO `crud`(vehiclename, vehicleno, vehicleimages, vehicleavailability, priceperday, mileage, seatcapacity) VALUES ('$vehiclename','$vehicleno','$vehicleimages','$vehicleavailability','$priceperday','$mileage','$seatcapacity')";
                if($result = $connection->query($sql))
                {
                    $validationMessage = "<h4 class='success-message'>Insertion Successful</h4>";
                }
                else
                {
                    $validationMessage = "Error";
                }
            } else {
                $validationMessage = "<h4 class='error-message'>Failed to upload the image</h4>";
            }
        }
    }
    // Close the connection
    $connection->close();
}
?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admindashboard.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Car Rental Portal</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="admindashboard.php" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="create.php">
            <i class='bx bx-car'></i>
            <span class="links_name">Vehicles</span>
          </a>
        </li>
        <li>
          <a href="customerlist.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Customer's List</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Analytics</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Stock</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Total order</span>
          </a>
        </li>
        <li class="log_out">
          <a href="index.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
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
      <a href="create.php">
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
      <form action="create.php" method="POST" enctype="multipart/form-data">
        <?php if (!empty($validationMessage)): ?>
          <div class="validation-message"><?php echo $validationMessage; ?></div>
        <?php endif; ?>
        <fieldset> 
            <legend>Insert Vehicle Details</legend>

                <label for="vehiclename">
                  Vehicles Name:- <input type="text" name="vehiclename" id="vehiclename" size="50" required>
                </label> 

                <label for="vehicleno">
                  Vehicle Reg. Number:- <input type="text" name="vehicleno"  pattern="^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9\s]+$" id="vehicleno" size="50" required>
                </label>

                <label for="vi">Vehicle Image:-</label> 
                   <input type="file" name="vehicleimages" accept="image/jpg, image/jpeg, image/png" required>
                <br> <br>

                <label for="vehicleavailability">
                  Availability:-
                    <select name="vehicleavailability">
                      <option hidden>Choose</option>
                      <option>Available</option>
                      <option>Booked</option>
                    </select>
                  </label>

                <label for="priceperday">
                  Price Per Day:- <input type="text" name="priceperday" pattern="^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9\s]+$" id="priceperday" size="50" required>
                </label>

                <label for="mileage">
                  Mileage:- <input type="text" name="mileage" pattern="^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9\s]+$" id="mileage" size="50" required>
                </label>

                <label for="seatcapacity">
                  Seat Capacity:- <input type="number" name="seatcapacity" id="seatcapacity" size="50" required>
                </label>

                <input type="submit" value="Create" name="create">
           
        </fieldset>
        
      </form>
      <a href="read.php"><button>Update and Delete</button></a>
    </div>
  </section>

  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

</body>
</html>