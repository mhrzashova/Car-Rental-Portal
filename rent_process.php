<?php
include 'config.php';
session_start();

if (!isset($_SESSION['users'])) {
    header("Location: login.php");
}

if (isset($_POST['vehicle_id'], $_POST['pickup_date'], $_POST['return_date'])) {
    $vehicle_id = $_POST['vehicle_id'];
    $pickup_date = $_POST['pickup_date'];
    $return_date = $_POST['return_date'];
    
    // Save the rental details to the database
    // You can implement your own code to insert the rental details into the database table
    
    // Display a success message or redirect to a confirmation page
    echo "<h1>Rental Successful</h1>";
    echo "<p>Your rental has been processed successfully. Thank you!</p>";
} else {
    echo "<p>Invalid request.</p>";
}
?>
