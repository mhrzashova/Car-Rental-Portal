<?php
session_start();
include 'config.php';

if (!isset($_SESSION['users']) || !is_array($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['users']['user_id'];

// Retrieve booked vehicle details for the current user
$query = "SELECT b.*, c.vehicleimages, c.vehiclename, c.priceperday FROM booking b
          INNER JOIN crud c ON b.vehicleid = c.vehicleid
          WHERE b.user_id = '$user_id'";
$result = mysqli_query($connection, $query);

// Group the bookings by vehicle (using an associative array)
$bookings_by_vehicle = array();
while ($row = mysqli_fetch_assoc($result)) {
    $vehicle_id = $row['vehicleid'];
    if (!isset($bookings_by_vehicle[$vehicle_id])) {
        $bookings_by_vehicle[$vehicle_id] = array(
            'vehicleimages' => $row['vehicleimages'],
            'vehiclename' => $row['vehiclename'],
            'priceperday' => $row['priceperday'],
            'bookings' => array(),
        );
    }
    $bookings_by_vehicle[$vehicle_id]['bookings'][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Portal</title>
    <!-- Link To CSS -->
    <link rel="stylesheet" href="css/rent.css">
    <!-- Box Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css"/> 
    <style>
    /* CSS to center the "My bookings" heading */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 16px;
        text-align: left;
      }
      
      th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
      }
      
      th {
        background-color: #f2f2f2;
      }
      
      tr:hover {
        background-color: #f2f2f2;
      }
      
      img {
        max-width: 100px;
        height: auto;
      }
      
      /* Adjustments for mobile view */
      @media (max-width: 768px) {
        table {
          font-size: 14px;
        }
      
        img {
          max-width: 80px;
        }
      }
    .my-bookings h3 {
        text-align: center;
    }
    
    /* CSS to center and enlarge the vehicle image */
    .vehicle-image-container {
        display: flex;
        justify-content: center;
    }

    .vehicle-image-container img {
        width: 70%; /* You can adjust this value to control the size of the image */
        max-width: 400px; /* Limit the maximum width of the image to 500px */
        height: auto; /* Maintain aspect ratio */
    }
    .booking-status {
    padding: 5px;
    font-weight: bold;
    }

    .booking-status .completed {
        color: green;
    }

    .booking-status .cancelled {
    color: red;
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
                    <li><img src="images/car.png"><a href="mybooking.php">My Booking</a></li>
                    <li><img src="images/log-out.png"><a href="index.php">Logout</a></li>
                </ul>
            </div>
        </div>
        </div>
    </header>

    
    <!-- Services -->
    <section class="my-bookings">
        <div class="heading">
            <span>My Bookings</span>
            <h1>My Bookings</h1>
        </div>

        <?php
        // Check if any bookings found for the user
        if (!empty($bookings_by_vehicle)) {
            foreach ($bookings_by_vehicle as $vehicle_id => $vehicle_data) {
                // Display vehicle image and name as a heading

                echo '<div class="vehicle-image-container">';
                echo '<img src="uploaded_img/' . $vehicle_data['vehicleimages'] . '" alt="Vehicle Image">';
                echo '</div>';
                // Display bookings for the current vehicle
                echo '<h3>My bookings</h3>';
                echo '<table>';
                echo '<tr>
                        <th>Vehicle Name</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Booking Status</th>
                    </tr>';

                    foreach ($vehicle_data['bookings'] as $booking) {
                        // Display booked vehicle details in the bookings table
                        echo "<tr>";
                        echo "<td>" . $booking['vehiclename'] . "</td>";
                        echo "<td>" . $booking['pickup_date'] . "</td>";
                        echo "<td>" . $booking['return_date'] . "</td>";
                        // Add a class based on the booking status (completed, cancelled, or pending)
                        $statusClass = ($booking['status'] == 1 ? 'completed' : ($booking['status'] == -1 ? 'cancelled' : 'pending'));
                        echo "<td class='booking-status'><span class='" . $statusClass . "'>" . ($booking['status'] == 1 ? 'Completed' : ($booking['status'] == -1 ? 'Cancelled' : 'Pending')) . "</span></td>";
                        echo "</tr>";
                }

                echo '</table>';

                // Display invoice details for the current vehicle
                echo '<h3>Invoice</h3>';
                echo '<table>';
                echo '<tr>
                        <th>Booking Number</th>
                        <th>Pick-up Date</th>
                        <th>Return Date</th>
                        <th>Total Days</th>
                        <th>Price per Day</th>
                        <th>Total Price</th>
                    </tr>';

                foreach ($vehicle_data['bookings'] as $booking) {
                    // Calculate total days and total price for invoice
                    $pickup_date = new DateTime($booking['pickup_date']);
                    $return_date = new DateTime($booking['return_date']);
                    $total_days = $pickup_date->diff($return_date)->format("%a");
                    $total_price = $total_days * $vehicle_data['priceperday'];

                    // Display invoice details in the invoice table
                    echo "<tr>";
                    echo "<td>" . $booking['bookingnumber'] . "</td>";
                    echo "<td>" . $booking['pickup_date'] . "</td>";
                    echo "<td>" . $booking['return_date'] . "</td>";
                    echo "<td>" . $total_days . "</td>";
                    echo "<td>Rs. " . $vehicle_data['priceperday'] . "</td>";
                    echo "<td>Rs. " . $total_price . "</td>";
                    echo "</tr>";
                }

                echo '</table>';
            }
        } else {
            // No bookings found for the user
            echo "<p>No bookings found.</p>";
        }
        ?>
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
        function validateForm() {
        const form = document.getElementById("rentForm");
        if (form.checkValidity()) {
            // If the form is valid, submit it
            form.submit();
        } else {
            // If the form is invalid, display validation messages
            form.reportValidity();
        }
    }
    </script>

</body>
</html>
