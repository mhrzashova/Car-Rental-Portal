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

    /* New CSS for the updated layout */
    .my-bookings .vehicle-card {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
    }

    .my-bookings .vehicle-card h3 {
        text-align: center;
        margin-top: 10px;
    }

    .my-bookings .vehicle-bookings {
        margin-top: 20px;
    }

    .my-bookings .vehicle-bookings table {
        width: 100%;
        border-collapse: collapse;
        font-size: 16px;
        text-align: left;
        margin-top: 10px;
    }

    .my-bookings .vehicle-bookings th,
    .my-bookings .vehicle-bookings td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .my-bookings .vehicle-bookings th {
        background-color: #f2f2f2;
    }

    .my-bookings .vehicle-bookings tr:hover {
        background-color: #f2f2f2;
    }

    .my-bookings .invoice-details {
        margin-top: 20px;
    }

    .my-bookings .invoice-details table {
        width: 100%;
        border-collapse: collapse;
        font-size: 16px;
        text-align: left;
        margin-top: 10px;
    }

    .my-bookings .invoice-details th,
    .my-bookings .invoice-details td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .my-bookings .invoice-details th {
        background-color: #f2f2f2;
    }

    .my-bookings .invoice-details tr:hover {
        background-color: #f2f2f2;
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
    <?php include('includes/header.php');?>

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
                // Display vehicle card
                echo '<div class="vehicle-card">';
                echo '<div class="vehicle-image-container">';
                echo '<img src="uploaded_img/' . $vehicle_data['vehicleimages'] . '" alt="Vehicle Image">';
                echo '</div>';
                // Display vehicle name as a heading
                echo '<h3>' . $vehicle_data['vehiclename'] . '</h3>';
                // Display bookings for the current vehicle
                echo '<div class="vehicle-bookings">';
                echo '<h4>My bookings</h4>';
                echo '<table>';
                echo '<tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Booking Status</th>
                    </tr>';

                foreach ($vehicle_data['bookings'] as $booking) {
                    // Display booked vehicle details in the bookings table
                    echo "<tr>";
                    echo "<td>" . $booking['pickup_date'] . "</td>";
                    echo "<td>" . $booking['return_date'] . "</td>";
                    // Add a class based on the booking status (completed, cancelled, or pending)
                    $statusClass = ($booking['status'] == 1 ? 'completed' : ($booking['status'] == -1 ? 'cancelled' : 'pending'));
                    echo "<td class='booking-status'><span class='" . $statusClass . "'>" . ($booking['status'] == 1 ? 'Completed' : ($booking['status'] == -1 ? 'Cancelled' : 'Pending')) . "</span></td>";
                    echo "</tr>";
                }

                echo '</table>';
                echo '</div>'; // Close vehicle-bookings container

                // Display invoice details for the current vehicle
                echo '<div class="invoice-details">';
                echo '<h4>Invoice</h4>';
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
                echo '</div>'; // Close invoice-details container

                echo '</div>'; // Close vehicle-card
            }
        } else {
            // No bookings found for the user
            echo "<p>No bookings found.</p>";
        }
        ?>
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