<?php
$validationMessage = "";

if (isset($_POST['create'])) {
    $vehiclename = $_POST['vehiclename'];
    $brandname = $_POST['brand'];
    $vehicleno = $_POST['vehicleno'];
    $vehicleavailability = $_POST['vehicleavailability'];
    $priceperday = $_POST['priceperday'];
    $mileage = $_POST['mileage'];
    $seatcapacity = $_POST['seatcapacity'];

    // Database Connection
    $connection = new mysqli("localhost", "root", "", "carrentalportal");

    // Checking Connection
    if ($connection->connect_errno != 0) {
        die("<h1>404 Error Not Found</h1>");
    } else {
        // Check if the vehicle already exists
        $existingVehicleQuery = "SELECT * FROM `crud` WHERE vehicleno = '$vehicleno'";
        $existingVehicleResult = $connection->query($existingVehicleQuery);
        if ($existingVehicleResult->num_rows > 0) {
            $validationMessage = "<h4 class='error-message'>Vehicle already exists</h4>";
        } else {
            // Upload the image
            $targetDirectory = "C:/xampp/htdocs/carrentalportal/uploaded_img/";
            $targetFile = $targetDirectory . basename($_FILES["vehicleimages"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Validate the image
            $validImageTypes = array('jpg', 'jpeg', 'png');
            if (!in_array($imageFileType, $validImageTypes)) {
                $validationMessage = "<h4 class='error-message'>Invalid image format. Only JPG, JPEG, and PNG files are allowed.</h4>";
            } elseif ($_FILES["vehicleimages"]["size"] > 2000000) {
                $validationMessage = "<h4 class='error-message'>File size is too large. Maximum allowed size is 2MB.</h4>";
            } else {
                if (move_uploaded_file($_FILES["vehicleimages"]["tmp_name"], $targetFile)) {
                    $vehicleimages = basename($_FILES["vehicleimages"]["name"]);

                    // Retrieve brand information
                    $brand_id = $_POST['brand'];
                    $getBrandQuery = "SELECT brandname FROM brand WHERE brand_id = '$brand_id'";
                    $brandResult = $connection->query($getBrandQuery);

                    if ($brandResult && $brandResult->num_rows > 0) {
                        $brand = $brandResult->fetch_object();
                        $brandname = $brand->brandname;
                    } else {
                        // Handle the case when the brand information is not found
                        $brandname = 'Unknown Brand';
                    }

                    $sql = "INSERT INTO `crud`(vehiclename, brandname, vehicleno, vehicleimages, vehicleavailability, priceperday, mileage, seatcapacity) VALUES ('$vehiclename','$brandname','$vehicleno','$vehicleimages','$vehicleavailability','$priceperday','$mileage','$seatcapacity')";
                    if ($result = $connection->query($sql)) {
                        $validationMessage = "<h4 class='success-message'>Insertion Successful</h4>";
                    } else {
                        $validationMessage = "<h4 class='error-message'>Error</h4>";
                    }
                } else {
                    $validationMessage = "<h4 class='error-message'>Failed to upload the image</h4>";
                }
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
    <form action="create.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
        <?php if (!empty($validationMessage)): ?>
          <div class="validation-message"><?php echo $validationMessage; ?></div>
        <?php endif; ?>
        <fieldset> 
            <legend>Insert Vehicle Details</legend>

                <label for="vehiclename">
                  Vehicles Name:- <input type="text" name="vehiclename" id="vehiclename" size="50" required>
                </label> 

                <label for="brand">Select Brand:</label>
                <div class="brand">
                  <select class="selectpicker" name="brand" required>
                    <?php
                      // Retrieve brand information
                      $connection = new mysqli("localhost", "root", "", "carrentalportal");
                      $getBrandQuery = "SELECT brand_id, brandname FROM brand";
                      $brandResult = $connection->query($getBrandQuery);

                      if ($brandResult && $brandResult->num_rows > 0) {
                          echo "<option value='' hidden>Choose</option>"; // Move this line outside the while loop
                          while ($brand = $brandResult->fetch_object()) {
                              echo "<option value='" . $brand->brand_id . "'>" . $brand->brandname . "</option>";
                          }
                      }
                    ?>
                  </select>
                </div>


                <label for="vehicleno">
                  Vehicle Reg. Number:- <input type="text" name="vehicleno"  pattern="^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9\s]+$" id="vehicleno" size="50" required>
                </label>
                
                <label for="vehicleimages">Vehicle Image:</label> 
                  <div class="image-upload-box">
                    <input type="file" name="vehicleimages" accept="image/jpg, image/jpeg, image/png" required>
                  </div>

                  <label for="vehicleavailability">
                    Availability:-
                    <select select name="vehicleavailability" id="vehicleavailability">
                      <option value="" hidden>Choose</option>
                      <option value="Available">Available</option>
                      <option value="Booked">Booked</option>
                    </select>
                  </label>

                <label for="priceperday">
                  Price Per Day:- <input type="number" name="priceperday" id="priceperday" size="50" required>
                </label>

                <label for="mileage">
                  Mileage:- <input type="number" name="mileage"  id="mileage" size="50" required>
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

<!-- Link To JS -->
<script src="js/all.js"></script>

</body>
</html>