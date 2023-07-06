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



if(isset($_POST['password']))
{

    $old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

   $udateQuery="SELECT * FROM users WHERE user_id='$user_id' AND password='$old_password'";
   if($result=$connection->query($udateQuery))
   {
    if(($new_password!=$old_password)&&($new_password==$confirm_password))
    {
        mysqli_query($connection, "UPDATE `users` SET password = '$confirm_password' WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'password updated successfully!';
        session_destroy();
        header("Location:login.php");
    }
    else{
        $message[] = 'Check Credentials!';
    }
   }
   else{
    echo("Error");
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change password</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/all.css">
</head>
<body>

<div class="update-profile">
    <form action="password.php" method="post">
            <?php if(isset($message))
            {
                foreach($message as $message)
                {
                echo '<div class="message">'.$message.'</div>';
                } 
            }
            ?>
        <div class="flex">
        <div class="inputBox">
            <span>old password :</span>
            <input type="password" name="old_password"  placeholder="Enter new password" pattern="^.{8,}$" class="box" required>
            <span>new password :</span>
            <input type="password" name="new_password" placeholder="Enter new password"  pattern="^.{8,}$" class="box"  required>
            <span>confirm password :</span>
            <input type="password" name="confirm_password" placeholder="confirm new password" pattern="^.{8,}$" class="box"  required>
        </div>
        </div>
        <input type="submit" value="Change Password" name="password" class="btn">
        <a href="userdashboard.php" class="delete-btn">Go Back</a>
    </form>
</div>

</body>
</html>