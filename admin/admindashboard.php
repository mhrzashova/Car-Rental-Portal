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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebar Menu for Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admindashboard.css" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="../fontawesome/css/all.min.css"/>
  </head>
  <body>
    <nav class="sidebar">
      <a href="#" class="logo">Car Rental Portal</a>

      <div class="menu-content">
        <ul class="menu-items">
          <!-- <div class="menu-title"><h3>Welcome Admin</h3></div> -->

          <li class="item">
            <a href="admindashboard.php">
              <?php 
              //admin ko email display gareko
              echo($email);
              ?>
            </a>
          </li>

          <li class="item">
            <div class="submenu-item">
              <span>First submenu</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>

            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                Your submenu title
              </div>
              <li class="item">
                <a href="#">First sublink</a>
              </li>
              <li class="item">
                <a href="#">First sublink</a>
              </li>
              <li class="item">
                <a href="#">First sublink</a>
              </li>
            </ul>
          </li>
          <li class="item">
            <div class="submenu-item">
              <span>Second submenu</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>

            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                Your submenu title
              </div>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
            </ul>
          </li>

          <li class="item">
            <a href="#">Your second link</a>
          </li>

          <li class="item">
            <form action="admindashboard.php" method="post">
              <input type="submit" value="Logout" name="logout">
            </form>
          </li>
        </ul>
      </div>
    </nav>

    <nav class="navbar">
      <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav>

    <main class="main">
      <h2>Welcome To Admin Dashboard</h2>
    </main>

    <script src="../js/admindashboard.js"></script>
  </body>
</html>