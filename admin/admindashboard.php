<?php
  session_start();
  // session lai check gareko with $_SESSION variable
  if(!isset($_SESSION['admin']))
  {
    //yedi session xaina vane login ma pathaidine
    header("<Location:index.php");
  }
  //yedi session xa vane
  $row = $_SESSION['admin'];
  // email lai store gareko user ko database bata
  $email = $row['email'];
  //logout ko main functionality
  if(isset($_POST['logout']))  //isset le click vako xa ki nai check garxa
  {
    //user ko data session bata hataideu
    session_destroy();

    //ani back to login page
    header("Location:index.php");
  }
?>


<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
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
      <a href="admindashboard.php">
              <?php 
              //admin ko email display gareko
              echo($email);
              ?>
            </a>
      </div>
    </nav>
    <div class="home-content">
        <main class="main">
          <h1>Welcome To Admin Dashboard</h1>
        </main>
      </div>
    </div>
  </section>

<!-- Link To JS -->
<script src="js/all.js"></script>

</body>
</html>

    