<?php
session_start();
include 'config.php';

if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['users']['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Portal</title>
    <!-- Link To CSS -->
    <link rel="stylesheet" href="css/userdashboard.css">
    <!-- Box Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css"/>
    <style>
        #no-results-message {
            color: black;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="#" class="logo"><img src="img/logo.png"></a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="userdashboard.php">Home</a></li>
            <li><a href="userdashboard.php">Ride</a></li>
            <li><a href="userdashboard.php">Services</a></li>
            <li><a href="userdashboard.php">About</a></li>
            <li><a href="userdashboard.php">Reviews</a></li>
        </ul>
        
        <div class="search">
            <input class="srch" type="search" name="" id="brand-search" placeholder="Search for cars....">
            <a href="#services"><button class="btn" >Search</button></a>
        </div>
        
        <div class="action">
            <div class="profile">
                <?php
                    $select = mysqli_query($connection, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('Query failed');
                    if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                        if($fetch['image'] == ''){
                            echo '<img src="images/avatar.png" alt="Profile Picture" width="40" height="40">';
                        }else{
                            echo '<img class="profile_pic" src="uploaded_img/'.$fetch['image'].'" alt="Profile Picture" width="40" height="40">';
                        }
                    }
                ?>
            </div>

            <div class="p">
            <h5><span>Profile</span></h5>
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <?php
                            $select = mysqli_query($connection, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('Query failed');
                            if(mysqli_num_rows($select) > 0){
                            $fetch = mysqli_fetch_assoc($select);
                            if($fetch['image'] == ''){
                            echo '<img src="images/avatar.png">';
                            }else{
                            echo '<img src="uploaded_img/'.$fetch['image'].'">';
                            }
                            }
                        ?>
                        <a href="#"><?php echo ''.$fetch['full_name'].''; ?></a>
                    </li>
                    <li><img src="images/user.png"><a href="update_profile.php">Edit Profile</a></li>
                    <!-- <li><img src="images/kyc.png"><a href="kyc.php">Update KYC</a></li> -->
                    <li><img src="images/padlock.png"><a href="password.php">Change Password</a></li>
                    <li><img src="images/log-out.png"><a href="index.php">Logout</a></li>
                </ul>
            </div>
        </div>
        </div>
    </header>

    
    <!-- Services -->
    <section class="services" id="services">
        <div class="heading">
            <span>Rent</span>
            <h1>Rent The Best Car Suitable For You</h1>
        </div>

        <div class="services-container" id="vehicle-container">

        <?php
include 'config.php';

if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['users']['user_id'];

// Step 1: Check if the vehicleid is provided in the URL
if (isset($_GET['vehicleid'])) {
    $vehicleid = $_GET['vehicleid'];

    // Step 2: Fetch the vehicle details from the database
    $query = "SELECT * FROM crud WHERE vehicleid = $vehicleid";
    $result = mysqli_query($connection, $query);

if ($result === false) {
    // Display the specific error message returned by the database
    echo "Error: " . mysqli_error($connection);
    exit; // Stop the script execution to prevent further issues
}

        // You can access various vehicle details using $vehicle array like $vehicle['name'], $vehicle['description'], $vehicle['image'], etc.

        // Step 3: Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Step 4: Validate and sanitize form data
            $pickup_date = isset($_POST['pickup_date']) ? $_POST['pickup_date'] : '';
            $return_date = isset($_POST['return_date']) ? $_POST['return_date'] : '';
            $useremail = isset($_SESSION['users']['email']) ? $_SESSION['users']['email'] : '';
            $status = 0;

            // Additional validation if needed
            // Example: Check if pickup_date and return_date are valid dates, not in the past, etc.

            // Step 5: Insert the booking details into the "booking" table
            $bookingnumber = mt_rand(100000000, 999999999);
            $insert_query = "INSERT INTO booking(bookingnumber, useremail, vehicleid, pickup_date, return_date, status) VALUES ('$bookingnumber', '$useremail', '$vehicleid', '$pickup_date', '$return_date', '$status')";

            if (mysqli_query($connection, $insert_query)) {
                // Booking successfully added to the database
                echo "<h2>Vehicle Details</h2>";
                echo "<p>Vehicle Name: " . $vehicle['vehiclename'] . "</p>";
                echo "<p>Vehicle Description: " . $vehicle['description'] . "</p>";
                echo "<img src='path/to/vehicleimages/" . $vehicle['vehicleimages'] . "' alt='" . $vehicle['vehiclename'] . "' width='200'>";
                echo "<h1>Rental Details</h1>";
                echo "<p>Pick-up Date: " . $pickup_date . "</p>";
                echo "<p>Return Date: " . $return_date . "</p>";
                
            } else {
                // Error occurred while inserting data
                echo "Error: " . mysqli_error($connection);
            }

            // Step 6: Close the database connection
            mysqli_close($connection);
        }
    } else {
        // Vehicle not found in the database, show an error message or redirect to an error page
        exit("Error: Vehicle not found.");
    }
?>


    <form action="rent.php" method="POST">
        <label for="pickup_date">Pick-up Date:</label>
        <input type="date" name="pickup_date" required>
        
        <label for="return_date">Return Date:</label>
        <input type="date" name="return_date" required>

        <input type="submit" value="Rent Now">
    </form>
        </div>
    </section>

    
    <section class="footer">
    <div class="copyright">
        <p>Copyright © 2023 - CRP | All Rights Reserved</p>
        <div class="social">
            <a href="#"><i class='bx bxl-facebook'></i></a>
            <a href="#"><i class='bx bxl-twitter'></i></a>
            <a href="#"><i class='bx bxl-instagram'></i></a>
        </div>
    </div>
    </section>
    
    <!-- ScrollReveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- Link To JS -->
    <script src="js/main.js"></script>
    <script>
        // JavaScript code to toggle the profile menu
        document.addEventListener('DOMContentLoaded', function() {
            const profileIcon = document.querySelector('.profile');
            const menu = document.querySelector('.menu');

            profileIcon.addEventListener('click', function() {
                menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
            });
        });

        // JavaScript code for filtering the services based on search input
        document.addEventListener("DOMContentLoaded", function() {
            var searchInput = document.getElementById("brand-search");
            var vehicleContainer = document.getElementById("vehicle-container");
            var boxes = vehicleContainer.getElementsByClassName("box");
            var noResultsMessage = document.getElementById("no-results-message");

            searchInput.addEventListener("input", function() {
                var searchValue = searchInput.value.toLowerCase();
                var resultsFound = false;

                for (var i = 0; i < boxes.length; i++) {
                    var brandname = boxes[i].querySelector("h4").textContent.toLowerCase();

                    if (brandname.includes(searchValue)) {
                        boxes[i].style.display = "block";
                        resultsFound = true;
                    } else {
                        boxes[i].style.display = "none";
                    }
                }

                noResultsMessage.style.display = resultsFound ? "none" : "block";
            });
        });
    </script>

</body>
</html>