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
      <a href="customerlist.php">
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
    <legend>Customer's List</legend>
        <table>
            <tr>
                <th>User Id</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Phone</th>
                <th>City</th>
                <th>Address</th>
                <th>Register Date</th>
                <th>Profile Picture</th>
                <th>License</th>
            </tr>
            <?php
            // Database connection
            $connection = new mysqli("localhost", "root", "", "carrentalportal");

            // Checking connection
            if ($connection->connect_errno != 0) {
                die("<h1>404 Error Not Found</h1>");
            }

            // Fetch customers from the database
            $query = "SELECT * FROM users";
            $result = $connection->query($query);

            // Check if there are any customers
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['full_name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['birth_date'] . "</td>";
                    echo "<td>" . $row['phoneno'] . "</td>";
                    echo "<td>" . $row['city'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['register_date'] . "</td>";
                    echo "<td>" . $row['image'] . "</td>";
                    echo "<td>" . $row['l_image'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No customers found.</td></tr>";
            }

            // Close the database connection
            $connection->close();
            ?>
        </table>
      </div>
    </div>
  </section>

<!-- Link To JS -->
<script src="js/all.js"></script>

</body>
</html>

    