<?php

include 'config.php';
session_start();
if(!isset($_SESSION['users']))//databse ko table ko nam
{
  //yedi session xaina vane login ma pathaidine
  header("Location:login.php");
}
$row = $_SESSION['users'];
$user_id = $row['user_id'];



if (isset($_GET['logout'])) {
   session_destroy();
   header('Location: login.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

    <!-- Custom CSS file link  -->
    <link rel="stylesheet" href="css/all.css">

</head>
<body>
   
<div class="container">

   <div class="profile">
   
      <?php
         $select = mysqli_query($connection, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('Query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
            if($fetch['image'] == ''){
               echo '<img src="images/default-avatar.png">';
            }else{
               //echo '<img src="'.$fetch['image'].'">';
               echo '<img src="uploaded_img/'.$fetch['image'].'">';
            }
            echo '<h3>'.$fetch['full_name'].'</h3>';
         }
      ?>
      <!-- <label><h5>User Created!</h5></label> -->
      <a href="userdashboard.php" class="btn">Edit Profile</a>
      <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">Logout</a>
      <p>New <a href="login.php">Login</a> or <a href="register.php">Register</a></p>
   </div>

</div>

</body>
</html>
