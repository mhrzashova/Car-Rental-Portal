<?php
$validationMessage = "";

if (isset($_POST['create'])) {
    $brandname = $_POST['brandname'];

    // Database Path
    $connection = new mysqli("localhost", "root", "", "carrentalportal");

    // Checking of Connection
    if ($connection->connect_errno != 0) {
        die("<h1>404 Error Not Found</h1>");
    } else {
        // Check if the Brand already exists
        $existingBrandQuery = "SELECT * FROM `brand` WHERE brandname = '$brandname'";
        $existingBrandResult = $connection->query($existingBrandQuery);
        if ($existingBrandResult->num_rows > 0) {
            $validationMessage = "<h4 class='error-message'>Brand already exists</h4>";
        } 
    }
        $sql = "INSERT INTO `brand`(brandname) VALUES ('$brandname')";
                    if ($result = $connection->query($sql)) {
                        $validationMessage = "<h4 class='success-message'>Insertion Successful</h4>";
                    } else {
                        $validationMessage = "<h4 class='error-message'>Error</h4>";
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
      <!-- <div class="profile-details">
      <a href="createbrand.php">
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
      </div> -->
    </nav>

    <div class="home-content">
    <form action="createbrand.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
        <?php if (!empty($validationMessage)): ?>
          <div class="validation-message"><?php echo $validationMessage; ?></div>
        <?php endif; ?>
        <fieldset> 
            <legend>Insert Brand</legend>

                <label for="brandname">
                  Brand Name:- <input type="text" name="brandname" id="brandname" size="50" required>
                </label> 

                <input type="submit" value="Create" name="create">
           
        </fieldset>
        
      </form>
      <a href="brandread.php"><button>Update and Delete</button></a>
    </div>
  </section>

<!-- Link To JS -->
<script src="js/all.js"></script>

</body>
</html>