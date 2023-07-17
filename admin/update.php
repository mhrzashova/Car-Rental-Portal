<?php
$validationMessage = "";

if (isset($_POST['vehicle_edit'])) {
    $connection = new mysqli("localhost", "root", "", "carrentalportal");
    if ($connection->connect_errno != 0) {
        die("Connection failed");
    }

    $vehiclename = $_POST['vehiclename'];
    $vehicleno = $_POST['vehicleno'];
    $vehicleavailability = $_POST['vehicleavailability'];
    $priceperday = $_POST['priceperday'];
    $mileage = $_POST['mileage'];
    $seatcapacity = $_POST['seatcapacity'];
    $vehicleid = $_POST['vehicleid'];

    // Handle uploaded image
    $targetDirectory = "C:/xampp/htdocs/carrentalportal/uploaded_img/";
    $imageFileType = strtolower(pathinfo($_FILES["vehicleimages"]["name"], PATHINFO_EXTENSION));
    $imageFileName = $_FILES["vehicleimages"]["name"]; // Use the original image name

    $uploadOk = 1;

    // Check file size
    if ($_FILES["vehicleimages"]["size"] > 2000000) {
        $validationMessage = "File size is too large. Maximum allowed size is 2MB.";
        $uploadOk = 0;
    }

    // Allow only specific file formats
    $validImageTypes = array('jpg', 'jpeg', 'png');
    if (!in_array($imageFileType, $validImageTypes)) {
        $validationMessage = "Invalid image format. Only JPG, JPEG, and PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $validationMessage = "Sorry, there was an error uploading your file.";
    } else {
        // Upload the file
        if (move_uploaded_file($_FILES["vehicleimages"]["tmp_name"], $targetDirectory . $imageFileName)) {
            // Update the database with the new image name
            $vehicleimages = $imageFileName;
            $sql = "UPDATE `crud` SET `vehiclename`='$vehiclename', `vehicleno`='$vehicleno', `vehicleimages`='$vehicleimages', `vehicleavailability`='$vehicleavailability', `priceperday`='$priceperday', `mileage`='$mileage', `seatcapacity`='$seatcapacity' WHERE `vehicleid`='$vehicleid'";

            if ($result = $connection->query($sql)) {
                $validationMessage = "Updated Successfully";
            } else {
                $validationMessage = "Error updating the record: " . $connection->error;
            }
        } else {
            $validationMessage = "Sorry, there was an error uploading your file.";
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
    <?php if (!empty($validationMessage)): ?>
        <div class="validation-message"><?php echo $validationMessage; ?></div>
    <?php endif; ?>
    <?php
    if(isset($_POST['update']))
    {
        ?>
    
    <form action="update.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
        <?php
         $connection = new mysqli("localhost", "root", "", "carrentalportal");
        if($connection->connect_errno != 0)
        {
            die("Connection failed");
        }
        $vehicleid = $_POST['vehicle_update'];
        $sql = "SELECT * FROM crud WHERE vehicleid='$vehicleid'";
        if($result = $connection->query($sql))
        {
            $row = $result->fetch_assoc();
        }
        ?>
        
        <fieldset> 
            <br> 
            <legend>Update Vehicle Details</legend>

                <label for="vehiclename">
                  Vehicles Name:- <input type="text" name="vehiclename" id="vehiclename" size="50" value="<?php echo $row['vehiclename']?>" required>
                </label> 

                <label for="vehicleno">
                  Vehicle Reg. Number:- <input type="text" name="vehicleno"  pattern="^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9\s]+$" id="vehicleno" size="50" value="<?php echo $row['vehicleno']?>" required>
                </label>

                <label for="vehicleimages">Vehicle Image:</label> 
                  <div class="image-upload-box">
                    <input type="file" name="vehicleimages" accept="image/jpg, image/jpeg, image/png" required>
                  </div>

                  <label for="vehicleavailability">
                        Availability:-
                        <select name="vehicleavailability" id="vehicleavailability">
                            <option value="" hidden>Choose</option>
                            <option value="Available" <?php if ($row['vehicleavailability'] === 'Available') echo 'selected'; ?>>
                                Available
                            </option>
                            <option value="Booked" <?php if ($row['vehicleavailability'] === 'Booked') echo 'selected'; ?>>
                                Booked
                            </option>
                        </select>
                    </label>

                  <label for="priceperday">
                  Price Per Day:- <input type="number" name="priceperday" id="priceperday" size="50" value="<?php echo $row['priceperday']?>" required>
                </label>

                <label for="mileage">
                  Mileage:- <input type="number" name="mileage" id="mileage" size="50" value="<?php echo $row['mileage']?>" required>
                </label>

                <label for="seatcapacity">
                  Seat Capacity:- <input type="number" name="seatcapacity" id="seatcapacity" size="50" value="<?php echo $row['seatcapacity']?>" required>
                </label>

                <input type="submit" value="Update" name="vehicle_edit">
                <input type="hidden" name="vehicleid" value="<?php echo $vehicleid?>">
                <br> <br>
           
        </fieldset>
    </form>
    <?php
    }
    ?>
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

function validateForm() {
    var vehicleAvailability = document.getElementById("vehicleavailability").value;
    if (vehicleAvailability === "") {
      alert("Please select the availability.");
      return false;
    }
  }
 </script>

</body>
</html>