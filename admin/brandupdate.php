<?php
$validationMessage = "";

if (isset($_POST['brand_edit'])) {
    $connection = new mysqli("localhost", "root", "", "carrentalportal");
    if ($connection->connect_errno != 0) {
        die("Connection failed");
    }

    $brandname = $_POST['brandname'];
    $brand_id = $_POST['brand_id'];

            $sql = "UPDATE `brand` SET `brandname`='$brandname' WHERE `brand_id`='$brand_id'";

            if ($result = $connection->query($sql)) {
                $validationMessage = "Updated Successfully";
            } else {
                $validationMessage = "Error updating the record: " . $connection->error;
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
          <a href="createbrand.php" class="active">
            <i class='bx bx-book-alt'></i>
            <span class="links_name">Brand</span>
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
            <span class="links_name">Registered Customer</span>
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
      <a href="brandupdate.php">
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
    
    <form action="brandupdate.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
        <?php
         $connection = new mysqli("localhost", "root", "", "carrentalportal");
        if($connection->connect_errno != 0)
        {
            die("Connection failed");
        }
        $brand_id = $_POST['brand_update'];
        $sql = "SELECT * FROM brand WHERE brand_id='$brand_id'";
        if($result = $connection->query($sql))
        {
            $row = $result->fetch_assoc();
        }
        ?>
        
        <fieldset> 
            <br> 
            <legend>Update Brand</legend>

                <label for="brandname">
                  Brand Name:- <input type="text" name="brandname" id="brandname" size="50" required>
                </label> 

                <input type="submit" value="Update" name="brand_edit">
                <input type="hidden" name="brand_id" value="<?php echo $brand_id?>">
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
 </script>

</body>
</html>