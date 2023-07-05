<?php

include 'config.php';
session_start();
if(!isset($_SESSION['users']))//databse ko table ko nam
{
  //yedi session xaina vane login ma pathaidine
  header("Location:login.php");
}
$row = $_SESSION['users'];
$user_id = $row['user_id'];// yo important way ho uesr_id collect garne

if(isset($_POST['update_profile'])){

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($connection, "UPDATE `users` SET image = '$update_image' WHERE user_id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
      }
   }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/all.css">

</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($connection, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      } else {
         $fetch = array();
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
  

<div class="flex">
      <?php
         $select = mysqli_query($connection, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('Query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
            if($fetch['image'] == ''){
               echo '<img src="images/default-avatar.png">';
            }else{
               echo '<img src="uploaded_img/'.$fetch['image'].'">';
            }
         }
      ?>
         <div class="inputBox">
            <span>Full Name :</span>
            <input type="text" name="update_full_name" value="<?php echo ($row['full_name']); ?>"  readonly class="box">
            <span>Email :</span>
            <input type="email" name="update_email" value="<?php echo ($row['email']); ?>" readonly class="box">
            <span>Update your pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
         
      </div>
      <input type="submit" value="Update Profile" name="update_profile" class="btn">
      <a href="userdashboard.php" class="delete-btn">Go Back</a>
   </form>

</div>

</body>
</html>