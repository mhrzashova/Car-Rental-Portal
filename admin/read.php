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
      <a href="read.php">
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
        <legend>Vehicle List</legend>
        <a href="create.php"><button>New</button></a>
        <table border='1' width="100%">
        <tr>
            <th>VehicleId</th><th>Vehicle Name</th><th>Vehicle Reg. Number</th><th>Vehicle Images<th>Vehicle Availability</th><th>Price Per Day</th><th>Mileage</th><th>Seat Capacity</th><th>Action</th> 
        </tr>
        <?php
            $connection= new mysqli("localhost","root","","carrentalportal");
            if($connection->connect_errno!=0){
                die("connection failed");
            }
            $sql="SELECT * FROM crud";
            if($result = $connection->query($sql))
            {
                while($row = $result->fetch_assoc())
            {
                echo "
                    <tr>
                    <td>".$row['vehicleid']."</td>
                    <td>".$row['vehiclename']."</td>
                    <td>".$row['vehicleno']."</td>
                    <td>".$row['vehicleimages']."</td>
                    <td>".$row['vehicleavailability']."</td> 
                    <td>".$row['priceperday']."</td> 
                    <td>".$row['mileage']."</td> 
                    <td>".$row['seatcapacity']."</td> 
                    <td>
                        <form action='update.php' method='post'>
                            <input type='hidden' value='".$row['vehicleid']."' name='vehicle_update'>
                            <input type='submit' value = 'update' name='update'>
                        </form> 

                        <form action='delete.php' method='post'>
                            <input type='hidden' value='".$row['vehicleid']."'name='vehicle_delete'>
                            <input type='submit'value = 'Delete' name='delete'>
                        </form> 

                </td>           
                </tr>
                ";
            }
        }

        ?>
    </table>
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

