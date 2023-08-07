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
      <div class="profile-details">
      <a href="brandread.php">
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
        <legend>Brand List</legend>
        <a href="createbrand.php"><button>New</button></a>
        <table border='1' width="100%">
        <tr>
            <th>BrandId</th><th>Brand Name</th><th>Action</th>
        </tr>
        <?php
            $connection= new mysqli("localhost","root","","carrentalportal");
            if($connection->connect_errno!=0){
                die("connection failed");
            }
            $sql="SELECT * FROM brand";
            if($result = $connection->query($sql))
            {
                while($row = $result->fetch_assoc())
            {
                echo "
                    <tr>
                    <td>".$row['brand_id']."</td>
                    <td>".$row['brandname']."</td> 
                    <td>
                        <form action='brandupdate.php' method='post'>
                            <input type='hidden' value='".$row['brand_id']."' name='brand_update'>
                            <input type='submit' value = 'update' name='update'>
                        </form> 

                        <form action='branddelete.php' method='post'>
                            <input type='hidden' value='".$row['brand_id']."'name='brand_delete'>
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

<!-- Link To JS -->
<script src="js/all.js"></script>

</body>
</html>

