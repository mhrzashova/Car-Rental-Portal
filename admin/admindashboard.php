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
          <a href="#" id="bookingsMenu">
            <i class='bx bx-book-alt'></i>
            <span class="links_name">Bookings</span>
            <i class='bx bxs-chevron-down arrow'></i>
          </a>
          <ul class="sub-menu" id="bookingsSubMenu">
            <li>
              <a href="#">
                <span class="links_name">New</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="links_name">Confirmed</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="links_name">Cancelled</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sub-menu-item" id="analyticsItem">
          <a href="#">
            <i class='bx bx-pie-chart-alt-2'></i>
            <span class="links_name">Analytics</span>
          </a>
        </li>
        <li class="sub-menu-item" id="stockItem">
          <a href="#">
            <i class='bx bx-coin-stack'></i>
            <span class="links_name">Stock</span>
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

    