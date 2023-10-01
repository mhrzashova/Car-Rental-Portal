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
  <?php include('includes/header.php');?>
  
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard"></span>
      </div>
      <!-- <div class="profile-details">
      <a href="manage_rating.php">
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
    <legend>Ratings</legend>
      <table>
        <tr>
            <th>Rating Id</th>
            <th>User Id</th>
            <th>Customers Name</th>
            <th>Email</th>
            <th>Rating Value</th>
            <th>Comment</th>
            <th>Posting Date</th>
            <th>Action</th>
        </tr>
        <?php
        if (isset($_GET['rating_id']) && isset($_GET['action'])) {
          $rating_id = $_GET['rating_id'];
          $action = $_GET['action'];
      
          // Database connection
          $connection = new mysqli("localhost", "root", "", "carrentalportal");
      
          // Checking connection
          if ($connection->connect_errno != 0) {
              die("<h1>404 Error Not Found</h1>");
          }
      
          // Update the status based on the action received
          if ($action === 'inactive') {
              $status = 1; // Set the status to 1 (active)
          } elseif ($action === 'active') {
              $status = 0; // Set the status to 0 (inactive)
          }
      
          // Use prepared statements for security
          $query = "UPDATE ratings SET status=? WHERE rating_id=?";
          $stmt = $connection->prepare($query);
      
          if ($stmt) {
              // Bind parameters and execute the update query
              $stmt->bind_param("ii", $status, $rating_id);
              $result = $stmt->execute();
      
              if ($result) {
                  // Status updated successfully, you may choose to redirect or show a success message
                  echo "<script>alert('Status updated successfully.');</script>";
              } else {
                  // Error occurred while updating status, you may choose to show an error message
                  echo "<script>alert('Error updating status.');</script>";
              }
      
              $stmt->close();
          } else {
              // Error occurred while preparing the statement, you may choose to show an error message
              echo "<script>alert('Error preparing statement.');</script>";
          }
      
          // Close the database connection
          $connection->close();
      }
      
      $connection = new mysqli("localhost", "root", "", "carrentalportal");

      // Checking connection
      if ($connection->connect_errno != 0) {
          die("<h1>404 Error Not Found</h1>");
      }
      
      // Fetch all testimonials with corresponding user information from the database
      $query = "SELECT r.*, u.full_name, u.email FROM ratings r
                INNER JOIN users u ON r.user_id = u.user_id";
      $result = $connection->query($query);
      
      // Check if there are any testimonials
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>".$row['rating_id']."</td>
                      <td>".$row['user_id']."</td>
                      <td>".$row['full_name']."</td>
                      <td>".$row['email']."</td>
                      <td>".$row['rating_value']."</td> 
                      <td>".$row['comment']."</td>
                      <td>".$row['postingdate']."</td>
                      <td>";
      
              if ($row['status'] == '0') {
                  echo "<a href='manage_rating.php?rating_id=" . htmlentities($row['rating_id']) . "&action=read' onclick=\"return confirm('Do you really want to UnRead')\">Read</a>";
              } else {
                  echo "<a href='manage_rating.php?rating_id=" . htmlentities($row['rating_id']) . "&action=unread' onclick=\"return confirm('Do you really want to Read')\">UnRead</a>";
              }
      
              echo "</td></tr>";
          }
      } else {
          echo "<tr><td colspan='7'>No testimonial found.</td></tr>";
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

    