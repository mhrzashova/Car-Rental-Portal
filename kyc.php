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

if(isset($_POST['update_kyc'])){
   
   $update_l_image = $_FILES['update_l_image']['name'];
   $update_l_image_size = $_FILES['update_l_image']['size'];
   $update_l_image_tmp_name = $_FILES['update_l_image']['tmp_name'];
   $update_l_image_folder = 'uploaded_img/'.$update_l_image;
   $allowed_width = 350;
   $allowed_height = 350;


   if (!empty($update_l_image)) {
      list($width, $height) = getimagesize($update_l_image_tmp_name);
   
      if ($width > $allowed_width || $height > $allowed_height) {
         $message[] = 'Image dimensions exceed the maximum allowed size (350px x 350px).';
      } elseif ($update_l_image_size > 2000000) {
         $message[] = 'Image file size is too large (maximum allowed: 2MB).';
      } else {
            $l_image_update_query = mysqli_query($connection, "UPDATE `users` SET l_image = '$update_l_image' WHERE user_id = '$user_id'") or die('Query failed');
            if ($l_image_update_query) {
               move_uploaded_file($update_l_image_tmp_name, $update_l_image_folder);
            }
            $message[] = 'License Updated  successfully!';
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
   <link rel="stylesheet" href="css/update_profile.css">

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
         if($fetch['l_image'] == ''){
            echo '<img src="images/license.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['l_image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <h5><span>Image dimensions exceed the maximum allowed size (350px x 350px) and (maximum allowed: 2MB).</span></h5>
         <div class="inputBox">
            <span>Full Name :</span>
            <input type="text" name="update_full_name" value="<?php echo ($row['full_name']); ?>" readonly class="box">
            <span>Email :</span>
            <input type="email" name="update_email" value="<?php echo ($row['email']); ?>" readonly class="box">
            <span>Upload license photo :</span>
            <input type="file" name="update_l_image" accept="image/jpg, image/jpeg, image/png" class="box" required/>

         </div>
         
      </div>
      <input type="submit" value="Update KYC" name="update_kyc" class="btn">
      <a href="userdashboard.php" class="delete-btn">Go To Dashboard</a>
   </form>

</div>

</body>
</html>