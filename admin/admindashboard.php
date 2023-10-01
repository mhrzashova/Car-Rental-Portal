<?php
  include 'config.php';
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
    exit();
  }
  // Fetch the total number of registered users from the 'users' table
  $query_users = "SELECT COUNT(*) AS total_users FROM users";
  $result_users = mysqli_query($connection, $query_users);
  $total_users = ($result_users) ? mysqli_fetch_assoc($result_users)['total_users'] : 0;

  // Fetch the total number of listed brands from the 'brand' table
  $query_brands = "SELECT COUNT(*) AS total_brands FROM brand";
  $result_brands = mysqli_query($connection, $query_brands);
  $total_brands = ($result_brands) ? mysqli_fetch_assoc($result_brands)['total_brands'] : 0;

  // Fetch the total number of vehicles listed from the 'crud' table
  $query_vehicles = "SELECT COUNT(*) AS total_vehicles FROM crud";
  $result_vehicles = mysqli_query($connection, $query_vehicles);
  $total_vehicles = ($result_vehicles) ? mysqli_fetch_assoc($result_vehicles)['total_vehicles'] : 0;

  // Fetch the total number of bookings from the 'booking' table
  $query_bookings = "SELECT COUNT(*) AS total_bookings FROM booking";
  $result_bookings = mysqli_query($connection, $query_bookings);
  $total_bookings = ($result_bookings) ? mysqli_fetch_assoc($result_bookings)['total_bookings'] : 0;

  // Fetch the total number of bookings from the 'booking' table
  $query_testimonials = "SELECT COUNT(*) AS total_testimonials FROM testimonial";
  $result_testimonials = mysqli_query($connection, $query_testimonials);
  $total_testimonials = ($result_testimonials) ? mysqli_fetch_assoc($result_testimonials)['total_testimonials'] : 0;

  mysqli_close($connection); // Close the database connection after fetching data
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
     <link rel="stylesheet" href="../fontawesome/css/all.min.css"/>
      <style>
         {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Style for the container holding the info boxes */
        .info-box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Style for each info box */
        .info-box {
            width: 22%;
            background-color: #f2f2f2;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        /* Style for the total number */
        .info-box .total {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        /* Style for the content */
        .info-box .content {
            font-size: 16px;
            color: #555;
            margin-top: 5px;
        }

        /* Style for the link */
        .info-box a {
            display: block;
            background-color: #0A2558;
            /* height:50px; */
            margin-left:-20px;
            margin-right:-20px;
            margin-top: 30px;
            margin-bottom: -25px;
            padding:10px;
            text-decoration: none;
            color: #fff;
            align:center;
        }
        .info-box a:hover {
          background-color: #081D45;
        }

        /* Style for the arrow icon */
        .info-box i {
            margin-left: 5px;
        }
        
      </style>
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
      <a href="admindashboard.php">
              <?php 
              //admin ko email display gareko
              echo($email);
              ?>
            </a>
      </div> -->
    </nav>
    <div class="home-content">
    <legend>Welcome To Admin Dashboard</legend>
        <div class="info-box-container">
          <!-- Display the fetched data -->
          <div class="info-box">
            <div class="total"><?php echo $total_users; ?></div>
            <div class="content">Registered Users</div> 
            <a href="customerlist.php">Full Detail <i class="fa fa-arrow-right"></i></a>
          </div>
          <div class="info-box">
            <div class="total"><?php echo $total_vehicles; ?></div>
            <div class="content">Listed Vehicles</div> 
            <a href="read.php">Full Detail <i class="fa fa-arrow-right"></i></a>
          </div>
          <div class="info-box">
            <div class="total"><?php echo $total_bookings; ?></div>
            <div class="content">Total Bookings</div> 
            <a href="newbooking.php">Full Detail <i class="fa fa-arrow-right"></i></a>
          </div>
          <div class="info-box">
            <div class="total"><?php echo $total_brands; ?></div>
            <div class="content">Listed Brands</div> 
            <a href="brandread.php">Full Detail <i class="fa fa-arrow-right"></i></a>
          </div>
          <div class="info-box">
            <div class="total"><?php echo $total_testimonials; ?></div>
            <div class="content">Testimonials</div> 
            <a href="manage_testimonial.php">Full Detail <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
    </div>
  </section>

<!-- Link To JS -->
<script src="js/all.js"></script>

</body>
</html>

    