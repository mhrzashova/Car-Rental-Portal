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
    <link rel="stylesheet" href="css/rent.css">
    <!-- Box Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css"/> 
</head>
<body>
    <?php include('includes/header.php');?>

    <!-- Services -->
    <section class="services" id="services">
        <div class="heading">
            <span>Rent</span>
            <h1>Rent The Best Car Suitable For You</h1>
        </div>

        <div class="services-container" id="vehicle-container">
        <?php
        include 'config.php';

        if (!isset($_SESSION['users']) || !is_array($_SESSION['users'])) {
            header("Location: login.php");
            exit();
        }

        $user_id = $_SESSION['users']['user_id'];

        // Step 1: Check if the vehicleid is provided in the URL
        if (isset($_GET['vehicleid'])) {
            $vehicleid = $_GET['vehicleid'];
            $pickup_date = "";
            $return_date = "";

            // Step 2: Fetch the vehicle details from the database
            $query = "SELECT * FROM crud WHERE vehicleid = $vehicleid";
            $result = mysqli_query($connection, $query);

            if ($result === false) {
                // Display the specific error message returned by the database
                die( "Error: " . mysqli_error($connection));
                // Stop the script execution to prevent further issues
            }

            // Check if a vehicle was found with the given ID
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                // Display the vehicle image, name, and price per day
                echo "<div class='box'>";
                echo "<div class='box-img'>";
                echo "<img src='uploaded_img/" . $row['vehicleimages'] . "' alt=''>";
                echo "</div>";
                $selectedPrice = $row['priceperday'];
                echo "<h3>" . $row['vehiclename'] . "</h3>";
                echo "<h2>Rs." . $row['priceperday'] . "<span>/day</span></h2>";
                echo "<h4>Brand: " . $row['brandname'] . "</h4>";
                echo "<h4>Availability: " . $row['vehicleavailability'] . "</h4>";
                echo "<h4>Mileage: " . $row['mileage'] . "<span> kmpl</span></h4>";
                echo "<h4>Seat Capacity: " . $row['seatcapacity'] . "</h4>";
                echo "</div>";
                
                $query = "SELECT * FROM booking WHERE vehicleid = $vehicleid";
                $result = mysqli_query($connection, $query);
                $ustatus=0;
                if (!empty($pickup_date) && !empty($return_date)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if (($row['pickup_date'] <= $return_date && $row['return_date'] >= $pickup_date) ||
                            ($pickup_date <= $row['return_date'] && $return_date >= $row['pickup_date'])) {
                            $ustatus = 1; // Overlapping dates, vehicle is not available
                            break; // No need to check further, exit the loop
                        }
                    }
                }

                // Check if the vehicle is available for booking
                if ($ustatus==1) {
                    echo "<p class='error-message'>The vehicle is already booked. You cannot proceed with the booking.</p>";
                } else {
                    // Vehicle is available, show the booking form
                    echo "
                        <form action='rent.php' method='POST' id='rentForm'>
                            <input type='hidden' name='vehicleid' value='$vehicleid'>
                            <div class='input-box'>
                                <span>From</span>
                                <input type='search' name='fromlocation' placeholder='Enter a location' required>
                            </div>
                            <div class='input-box'>
                                <span>To</span>
                                <input type='search' name='tolocation' placeholder='Enter a location' required>
                            </div>
                            <div class='input-box'>
                                <span>Pick-up Date</span>
                                <input type='date' name='pickup_date' min='" . date("Y-m-d") . "' required>
                            </div>
                            <div class='input-box'>
                                <span>Return Date</span>
                                <input type='date' name='return_date' min='" . date("Y-m-d") . "' required>
                            </div>
                            <div class='input-box'>
                                <label for='tripTypeSelect'>Trip Type</label>
                                <select name='triptype' id='tripTypeSelect' required>
                                    <option value='' disabled selected hidden>Select Trip Type</option>
                                    <option value='Inside Valley'>Inside Valley</option>
                                    <option value='Outside Valley'>Outside Valley</option>
                                </select>
                            </div>
                            <button type='button' class='btns' onclick='validateForm()'>Rent Now</button>
                        </form>
                    ";
                }
            } else {
                // Vehicle not found in the database, show an error message or redirect to an error page
                exit("Error: Vehicle not found.");
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $fromlocation = $_POST['fromlocation'];
            $tolocation = $_POST['tolocation'];
            $pickup_date = $_POST['pickup_date'];
            $return_date = $_POST['return_date'];
            $triptype = $_POST['triptype'];
            $bookingnumber = mt_rand(100000000, 999999999);
            $status = 0;
            // Retrieve the vehicleid from the hidden field in the form
            $vehicleid = $_POST['vehicleid'];

            // Validate pickup_date and return_date
            if (strtotime($pickup_date) >= strtotime($return_date)) {
                echo "<p class='error-message'>Return date should be after the pickup date.</p>";
                exit();
            }
            // Check vehicle availability
            $query = "SELECT * FROM booking WHERE vehicleid = $vehicleid AND user_id = $user_id AND return_date > NOW()";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                // The vehicle is already booked, and the return date is in the future
                $ustatus = 1;
            } else {
                $ustatus = 0; // Vehicle is available for booking
            }

            // Step 1: Check if the user has uploaded their license image
            $select = mysqli_query($connection, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('Query failed');
            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
                if (empty($fetch['l_image'])) {
                    // Step 2: Redirect the user to the "update_profile.php" page with a message
                    header("Location: update_profile.php?message=Please upload your license image before proceeding with the booking.");
                    exit();
                }
            }

            // Step 3: If the user has uploaded the license image, proceed with the booking process
            // Insert data into the booking table
            $check=mysqli_query($connection,"select * from booking where vehicleid='$vehicleid' and (pickup_date='$pickup_date' or return_date='$return_date')");
            if (mysqli_num_rows($check) < 1) {

            $insert_query = "INSERT INTO booking (bookingnumber, user_id, vehicleid, fromlocation, tolocation, pickup_date, return_date, triptype, status) 
                             VALUES ('$bookingnumber', '$user_id', '$vehicleid', '$fromlocation', '$tolocation', '$pickup_date', '$return_date', '$triptype', $status)";
            
                            if (mysqli_query($connection, $insert_query)) {
                                echo "<script>
                                        if (confirm('Booking Successful. Click OK to view your bookings.')) {
                                            window.location.href = 'mybooking.php';
                                        } else {
                                            window.location.href = 'userdashboard.php';
                                        }
                                    </script>";
                                exit();
                            } else {
                                // If there was an error with the database query
                                echo "<p class='error-message'>Error: " . mysqli_error($connection) . "</p>";
                            }
            }
            else
            {
                echo "<script>
                if (confirm('This vehicle is already booked for selected dates.')) {
                    window.location.href = 'userdashboard.php';
                }
                </script>";
            }
            
        }
        ?>

        </div>
        <div class="recommended-vehicles">
            <h2>Recommended Vehicles</h2>
            <?php
            $priceThreshold = 0.1; // 10% threshold
            $minPrice = $selectedPrice - ($selectedPrice * $priceThreshold);
            $maxPrice = $selectedPrice + ($selectedPrice * $priceThreshold);

            $similarVehiclesQuery = "SELECT * FROM crud WHERE priceperday >= $minPrice AND priceperday <= $maxPrice AND vehicleid != $vehicleid LIMIT 4";
            $similarVehiclesResult = mysqli_query($connection, $similarVehiclesQuery);

            while ($similarRow = mysqli_fetch_assoc($similarVehiclesResult)) {
                echo "<a href='rent.php?vehicleid=" . $similarRow['vehicleid'] . "'>";
                echo "<div class='box'>";
                echo "<div class='box-img'>";
                echo "<img src='uploaded_img/" . $similarRow['vehicleimages'] . "' alt=''>";
                echo "</div>";
                echo "<h3>" . $similarRow['vehiclename'] . "</h3>";
                echo "<h2>Rs." . $similarRow['priceperday'] . "<span>/day</span></h2>";
                echo "<h4>Brand: " . $similarRow['brandname'] . "</h4>";
                echo "<h4>Availability: " . $similarRow['vehicleavailability'] . "</h4>";
                echo "<h4>Mileage: " . $similarRow['mileage'] . "<span> kmpl</span></h4>";
                echo "<h4>Seat Capacity: " . $similarRow['seatcapacity'] . "</h4>";
                echo "</div>";
            }
            ?>
        </div>
    </section>

    <?php include('includes/footer.php');?>

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