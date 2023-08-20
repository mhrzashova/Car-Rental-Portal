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

    <style>
        /* Style for Recommended Vehicles (Left Side) */
.recommended-vehicles {
    float: left;
    width: 30%;
    padding: 20px;
}

.recommended-vehicles h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

.recommended-vehicles ul {
    list-style: none;
    padding: 0;
}

.recommended-vehicles li {
    margin-bottom: 10px;
}

.recommended-vehicles img {
    width: 80px;
    height: auto;
    margin-right: 10px;
}

/* Style for Vehicle Listings (Right Side) */
.services {
    float: right;
    width: 70%;
}

.services-container {
    display: flex;
    flex-direction: column;
}

.box {
    /* Your existing box styling */
    margin-bottom: 20px;
}

/* Adjust the media query as needed for responsiveness */
@media (max-width: 768px) {
    .recommended-vehicles,
    .services {
        float: none;
        width: 100%;
    }

    .recommended-vehicles img {
        width: 60px;
        margin-right: 5px;
    }
}

    </style>
</head>
<body>
    <?php include('includes/header.php');?>
    <aside class="recommended-vehicles">
        <h2>Recently Added Cars</h2>
        <ul>
            <?php
                include 'config.php';

                $recentlyAddedQuery = "SELECT * FROM `crud` ORDER BY creationdate DESC LIMIT 4";
                $recentlyAddedResult = $connection->query($recentlyAddedQuery);

                if ($recentlyAddedResult->num_rows > 0) {
                    while ($row = $recentlyAddedResult->fetch_assoc()) {
                        echo "<li><a href='rent.php?vehicleid=" . $row['vehicleid'] . "'>";
                        echo "<img src='uploaded_img/" . $row['vehicleimages'] . "' alt=''>";
                        echo $row['vehiclename'] . " <br>Rs." . $row['priceperday'] . "/day";
                        echo "</a></li>";
                    }
                }

                $connection->close();
            ?>
        </ul>
    </aside>

    <section class="services" id="services">
        <div class="heading">
            <span>Car Services</span>
            <h1>Find The Best Car Suitable For You</h1>
        </div>
        <div class="services-container" id="vehicle-container">
        <p id="no-results-message" style="display: none;">No results found.</p>
            <?php
                include 'config.php';

                // Get the brand name from the search input
                $brandname = isset($_GET['brand']) ? $_GET['brand'] : '';

                // Fetch vehicles from the database based on brand name filter
                $query = "SELECT * FROM `crud`";

                // Apply brand name filter if provided
                if (!empty($brandname)) {
                    $query .= " WHERE brandname LIKE '%$brandname%'";
                }

                $query .= " ORDER BY priceperday ASC";
                $result = $connection->query($query);
                

                // Check if there are any vehicles
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $vehicleid=$row['vehicleid'];
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
                        echo "<a href='rent.php?vehicleid=$vehicleid' class='btn'>Rent Now</a>";
                        // echo "<br>";
                        // echo "<a href='rate_vehicle.php?vehicleid=$vehicleid' class='btn'>Rate This Vehicle</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No vehicles available.</p>";
                }

                // Close the database connection
                $connection->close();
            ?>
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

