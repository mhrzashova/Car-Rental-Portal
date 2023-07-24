<?php
session_start();
include 'config.php';

if (!isset($_SESSION['users']) || !is_array($_SESSION['users']))
 {
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
        .footer {
            background-color: #333;
            color: #fff;
            padding: 1px;
            text-align: center;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
        }

        .social a {
            margin: 0 5px;
            color: #fff;
            font-size: 24px;
            text-decoration: none;
        }

        .social a:hover {
            color: #007bff;
        }

        /* Center the social icons in the footer */
        .social {
            display: flex;
            justify-content: center;
        }

        /* Set the footer links color and remove underlines */
        .footer a {
            color: #fff;
            text-decoration: none;
        }

        /* Style for the boxicons in the footer */
        .bx {
            color: #fff;
            font-size: 24px;
            margin-right: 5px;
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

    // Check if a vehicle was found with the given ID
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Display the vehicle image, name, and price per day
        echo "<div class='box'>";
        echo "<div class='box-img'>";
        echo "<img src='uploaded_img/" . $row['vehicleimages'] . "' alt=''>";
        echo "</div>";
        echo "<h3>" . $row['vehiclename'] . "</h3>";
        echo "<h2>Rs." . $row['priceperday'] . "<span>/day</span></h2>";
        echo "<h4>Brand: " . $row['brandname'] . "</h4>";
        echo "<h4>Availability: " . $row['vehicleavailability'] . "</h4>";
        echo "<h4>Mileage: " . $row['mileage'] . "<span> kmpl</span></h4>";
        echo "<h4>Seat Capacity: " . $row['seatcapacity'] . "</h4>";
        echo "</div>";
    } else {
        // Vehicle not found in the database, show an error message or redirect to an error page
        exit("Error: Vehicle not found.");
    }
}
        ?>

<?php
include 'config.php';

if (!isset($_SESSION['users']) || !is_array($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['users']['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fromlocation = $_POST['fromlocation'];
    $tolocation = $_POST['tolocation'];
    $pickup_date = $_POST['pickup_date'];
    $return_date = $_POST['return_date'];
    $triptype = $_POST['triptype'];
    $bookingnumber = mt_rand(100000000, 999999999);
    $status = 0;
    $email = $_POST['email']; // Retrieve the email from the hidden input field

    // Insert data into the booking table
    $insert_query = "INSERT INTO booking (bookingnumber, user_id, vehicleid, fromlocation, tolocation, pickup_date, return_date, triptype) 
                     VALUES ('$bookingnumber', '$user_id', '$vehicleid', '$fromlocation', '$tolocation', '$pickup_date', '$return_date', '$triptype')";

    if (mysqli_query($connection, $insert_query)) {
        // Booking successfully inserted into the database
        echo "Booking successful!";
        // You may add a redirect here or display a success message to the user
    } else {
        // If there was an error with the database query
        echo "Error: " . mysqli_error($connection);
        // You may redirect to an error page or display an error message to the user
    }
}
?>

    <form action="rent.php" method="POST">
    <input type="hidden" name="email" value="<?php echo $_SESSION['users']['email']; ?>">
        <div class="input-box">
            <span>From</span>
            <input type="search" name="fromlocation" placeholder="Enter a location">
        </div>
        <div class="input-box">
            <span>To</span>
            <input type="search" name="tolocation" placeholder="Enter a location">
        </div>
        <div class="input-box">
            <span>Pick-up Date</span>
            <input type="date" name="pickup_date" min="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="input-box">
            <span>Return Date</span>
            <input type="date" name="return_date" min="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="input-box">
            <span>Trip Type</span>
            <select name="triptype">
                <option hidden>Choose</option>
                <option>Inside Valley</option>
                <option>Outside Valley</option>
            </select>
        </div>
        <a href="#"><button class="btn" >Rent Now</button></a>
        <!-- <input type="submit" value="Rent Now"> -->
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
    <!-- <script src="https://unpkg.com/scrollreveal"></script> -->
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