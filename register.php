<?php
//register button click gare paxi k kam garne
if(isset($_POST['register'])) // isset is click, submit vako ho ki haina check garxa
{
    //Variable declare gareko for collecting input fields from form
    $full_name=$_POST['full_name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $birth_date=$_POST['birth_date'];
    $gender=$_POST['gender'];
    $city=$_POST['city'];
    $address = $_POST['address'];
    // md5 encryption for password
    $password = md5($_POST['password']);
    $cpassword =md5($_POST['confirm']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;
    
    //Database ko Path
    $connection = new mysqli("localhost","root","", "carrentalportal");// Checking Database Connection
    $select ="SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";

    $result = mysqli_query($connection, $select);

    if(mysqli_num_rows($result) > 0 ){
      $message[] = 'user already exist'; 
    }else{
      if($password != $cpassword){
         $message[] = 'confirm password not matched!';
      }
      elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($connection, "INSERT INTO `users`(full_name ,email, password, gender, birth_date, phoneno, city, address, image) 
         VALUES('$full_name','$email','$password','$gender','$birth_date', '$phone', '$city', '$address', '$image_folder')");

         if($insert){
          move_uploaded_file($image_tmp_name, $image_folder);
          $message[] = 'registered successfully!';
          header('location:login.php');
       }else{
          $message[] = 'registration failed!';
       }
    }
 }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--<title>Registration Form in HTML CSS</title>-->
    <!---Custom CSS File--->
    <link rel="stylesheet" href="css/register.css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css"/>

  <!-- JS Start -->
  <script>
     document.addEventListener("DOMContentLoaded", function() {
  var password = document.querySelector('input[name="password"]');
  var confirm = document.querySelector('input[name="confirm"]');
  var form = document.querySelector("form");

  form.addEventListener("submit", function(event) {
    if (password.value !== confirm.value) {
      event.preventDefault();
      showError("Password and confirm password do not match");
    }

    var birthDateInput = document.querySelector('input[name="birth_date"]');
    var birthDate = new Date(birthDateInput.value);
    var today = new Date();
    var diff = Math.floor((today - birthDate) / (1000 * 60 * 60 * 24));

    if (diff < 6570 || diff > 21900) { // 6570 days = 18 years, 21900 days = 60 years
      event.preventDefault();
      showError("Age must be greater than 18 and less than 60!");
    }
  });

  function showError(message) {
    var errorContainer = document.createElement("div");
    errorContainer.classList.add("error-message");
    errorContainer.textContent = message;

    var existingError = document.querySelector(".error-message");
    if (existingError) {
      existingError.remove();
    }

    form.appendChild(errorContainer);
  }
});

  </script>
  </head>
  <body>
    <section class="container">
      <header> Sign Up</header>
      <form action="register.php" method="post" class="form" autocomplete="off" enctype="multipart/form-data">
        <div class="input-box">
          <label>Full Name</label>
          <input type="text" placeholder="Enter full name" name="full_name" pattern="^[A-Za-z\s]+$" value="<?php if(isset($_POST['register'])) {echo $full_name;} ?>" required />
        </div>

        <div class="input-box">
          <label>Email Address</label>
          <input type="email" placeholder="Enter email address" name="email" required />
        </div>

        <div class="column">
          <div class="input-box">
            <label>Phone Number</label>
            <input type="text" placeholder="Enter phone number" pattern="^\d{10}$" name="phone" required />
          </div>
          <div class="input-box">
            <label>Birth Date</label>
            <input type="date" placeholder="Enter birth date" max="<?php echo(date("Y-m-d"));?>" name="birth_date" value="<?php if(isset($_POST['register'])) {echo $birth_date;} ?>" required />
          </div>
        </div>
        <div class="gender-box">
          <h3>Gender</h3>
          <div class="gender-option">
            <div class="gender">
              <input type="radio" id="check-male" name="gender" value="male" checked />
              <label for="check-male">male</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-female" name="gender" value="female"/>
              <label for="check-female">Female</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-other" name="gender" />
              <label for="check-other">prefer not to say</label>
            </div>
          </div>
        </div>
        <div class="input-box address">
          <label>Address</label>
          <div class="column">
            <div class="select-box">
              <select name="city">
              <<option hidden>City</option>
                <option>Kathmandu</option>
                <option>Bhaktapur</option>
                <option>Lalitpur</option>
              </select>
            </div>
            <input type="text" name="address" placeholder="Enter your address" required />
          </div>
          </div>
          <div class="input-box">
          <label>Password</label>
          <div class="column">
            <input type="password" name="password" pattern="^.{10,}$" placeholder="Enter Your Password" required />
            <input type="password" name="confirm" pattern="^.{10,}$" placeholder="Confirm Password" required />
            <div class="error-message" id="password-error"></div>
            <!-- password match vayena vane js use garera msg dinxa ki password
            re comfirm password match vako xaina
            yesle garda page reload hudaina, user le feri form bharnu pardaina -->
          </div>
          <br>
          <label>Choose profile picture</label>
          <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" required>
        </div>
        <button type="submit" name="register">Submit</button>

      </form>
      <br>
      <div class="signin-box">
        <label for="check">Already have an account? <a href="login.php"> Signin </a> </label>
      </div>
    </section>
    
  </body>
</html>