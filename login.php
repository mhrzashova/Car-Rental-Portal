<?php
if(isset($_POST['login'])) // isset is click, submit vako ho ki haina check garxa
{
    // login click gareko xa vane k kam garne define gareko
    $email =$_POST['email']; //name collect garne variable
    $password =md5($_POST['password']); //password collect garne variable
    //echo ($email." and ".$password."<br>"); //display of variable

    // Connection ko variable
    $connection = new mysqli("localhost","root","", "carrentalportal");
    // Checking Database Connection
    if($connection->connect_errno!=0)
    //0 means connected
    {
        die("Database Connectivity Error");
    }

    // comparison query using select
    //user ko table database sanga
    $sql="SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result=$connection->query($sql); //query execution
    if($result->num_rows>0) //data match vako xa vane
    {
        //echo("Success");
        session_start();
        //table ma vako data extract gareko
        $row = $result->fetch_assoc();
        //tes lai $_session ma store gareko
        $_SESSION['users']=$row;

        //redirecting to user dashboard page after login is successful with session
        header("Location:home.php"); 
      echo
        ("<script>
          alert(' Success ');
          </script>");
    }

    else
    {
        echo
        ("<script>
          alert(' Wrong Email Or Password ');
          </script>");
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="fontawesome/css/all.min.css"/>
</head>
<body>
  <div class="wrapper">
    <header>Sign In</header>
    <form action="login.php" method="post">
      <div class="field email">
        <div class="input-area">
          <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php if(isset($_POST['login'])) {echo $email;} ?>"required/>
          <!-- Yedi email rw Password wrong vayo vane input ma display hos
          type garna naparos feri vanera -->
          <i class="icon fas fa-envelope"></i>
          <i class="error error-icon fas fa-exclamation-circle"></i>
        </div>
        <div class="error error-txt">Email can't be blank</div>
      </div>
      <div class="field password">
        <div class="input-area">
          <input type="password" name="password" id="password" placeholder="Enter your password" required/>
          <i class="icon fas fa-lock"></i>
          <i class="error error-icon fas fa-exclamation-circle"></i>
          
        </div>
        <div class="error error-txt">Password can't be blank</div>
      </div>
      <!-- <a href="#">Forgot password?</a> -->
      <input type="submit" name="login" value="Login">
    </form>
    <!-- <div class="forgot-btn">
      <button type="button">Forgot Password?</button>
    </div> -->
    <label for="check">Don't have an account? </label><a href="register.php">Signup</a>
  </div>
  <!-- <div class="popup-container" id="forgot-popup">
      <div class="forgot popup">
        <form action="" method="POST">
          <h2>
            <span>RESET PASSWORD</span>
            <button type="reset" onclick="popup('forgot-popup')">X</button>
          </h2>
          <input type="email" placeholder="E-mail" name="email">
          <button type="submit" class="reset-btn" name="send-reset-link">SEND LINK</button>
        </form>
      </div>
    </div> -->

</body>
</html>