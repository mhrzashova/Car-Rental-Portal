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
            position: fixed;
            top: 40px; /* Adjust the top position according to your layout */
            left: 10px; /* Adjust the left position according to your layout */
            width: 250px; /* Set a fixed width for the section */
            padding: 20px;
            background: #c3c0c0;
            background: #fff;
            border-right: 1px solid #e1e1e1;
            padding-top: 56px;
            z-index: 1; /* Ensure it appears above other elements */
        }

        .recommended-vehicles h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .recommended-vehicles ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .recommended-vehicles li {
        }

        .recommended-vehicles img {
            width: 90px;
            height: auto;
            margin-right: 10px;
        }

        /* Style for Vehicle Listings (Right Side) */
        .services {
            padding-left: 80px;
            margin-left: 270px; /* Adjust the margin to leave space for the fixed section */
            width: calc(70% - 270px); Adjust the width accordingly
            margin-top: 70px; /* Adjust the top margin to avoid overlap with the fixed section */
            width: calc(100% - 270px);
        }

        .services-container {
            /* display: flex; */
            display: block;
            margin-top: 80px;
        }

        .services-container h1 {
            margin-bottom: 28px;
        }

        .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .box {
            /* Your existing box styling */
            /* margin-bottom: 20px; */
            padding-bottom: 16px;
        }

        .box h3 {
            margin: 12px 0;
        }

        .services-container .box-container .box .btn {
            margin: 16px 0;
        }

        .services-container .box-container .box .rating-container {
            flex-direction: column;
            gap: 8px;
        }

        .services-container .box-container .box .rating-container .btn {
            margin: 0;
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
        .rating-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px; /* Adjust margin as needed */
        }

        .rating-container .btn {
            margin-left: 10px; /* Adjust margin between rating and button */
        }

        .rating-container span {
            font-weight: bold; /* Make the average rating bold */
        }


    </style>

</head>
<body>
    <?php include('includes/header.php');?>
    
    <section class="services" id="services">
    <div class="recommended-vehicles">
            <h2>Recently Added Cars</h2>
            <ul>
                <?php
                // Fetch recently added vehicles
                $recentQuery = "SELECT * FROM `crud` ORDER BY creationdate DESC LIMIT 5";
                $recentResult = $connection->query($recentQuery);

                if ($recentResult) {
                    if ($recentResult->num_rows > 0) {
                        while ($recentRow = $recentResult->fetch_assoc()) {
                            //echo "<a href='rent.php?vehicleid=" . $recentRow['vehicleid'] . "'>";
                            echo "<li>";
                            echo "<img src='uploaded_img/" . $recentRow['vehicleimages'] . "' alt=''>";
                            echo "<h4>" . $recentRow['vehiclename'] . "</h4>";
                            echo "</li>";
                        }
                    } else {
                        echo "<p>No recently added cars found.</p>";
                    }
                } else {
                    // Handle the query error
                    echo "Error: " . $connection->error;
                }
                ?>
            </ul>
        </div>
        
        <div class="services-container" id="vehicle-container">
        <p id="no-results-message" style="display: none;">No results found.</p>
        <h1>Find The Best Car Suitable For You</h1>
        <div class="box-container">
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
                        // Inside your while loop for displaying vehicles
                        echo "<br>";
                        echo "<div class='rating-container'>";
                        $averageRating = $row['total_ratings'] > 0 ? $row['rating'] / $row['total_ratings'] : 0;
                        echo "<span>Average Rating: " . number_format($averageRating, 1) . "</span>";
                        echo "<a href='rate_vehicle.php?vehicleid=$vehicleid' class='btn'>Rate This Vehicle</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No vehicles available.</p>";
                }

                // Close the database connection
                $connection->close();
            ?>
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

