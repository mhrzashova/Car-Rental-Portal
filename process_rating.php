<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['users']['user_id'];
    $vehicleid = $_POST['vehicleid'];
    $ratingValue = $_POST['rating'];
    $comment = $_POST['comment'];

    // Check if the user has booked the vehicle and return date has passed
    $bookingQuery = "SELECT * FROM `booking` WHERE user_id = '$user_id' AND vehicleid = '$vehicleid' AND status = 1 AND return_date < NOW()";
    $bookingResult = $connection->query($bookingQuery);

    if ($bookingResult->num_rows == 0) {
        echo "You can only rate the vehicle after your active booking and return date has been over.";
        exit();
    }

    // Check if the user has already rated this vehicle
    $checkRatingQuery = "SELECT * FROM ratings WHERE user_id = '$user_id' AND vehicleid = '$vehicleid'";
    $checkRatingResult = $connection->query($checkRatingQuery);

    if ($checkRatingResult->num_rows > 0) {
        // User has already rated the vehicle, handle accordingly
        header("Location: rate_vehicle.php?vehicleid=$vehicleid&message=You have already rated this vehicle.");
        exit();
    } else {
        // User has not rated the vehicle, proceed with inserting the rating into the ratings table
        $insertRatingQuery = "INSERT INTO ratings (user_id, vehicleid, rating_value, comment) VALUES ('$user_id', '$vehicleid', '$ratingValue', '$comment')";
        if ($connection->query($insertRatingQuery) === TRUE) {
            // Update total rating and total number of ratings in the database
            $updateQuery = "UPDATE crud SET rating = rating + $ratingValue, total_ratings = total_ratings + 1 WHERE vehicleid = $vehicleid";
            if ($connection->query($updateQuery)) {
                header("Location: rate_vehicle.php?vehicleid=$vehicleid&message=Rating submitted successfully!");
                exit();
            } else {
                header("Location: rate_vehicle.php?vehicleid=$vehicleid&message=Error updating rating.");
                exit();
            }
        } else {
            header("Location: rate_vehicle.php?vehicleid=$vehicleid&message=Error submitting rating.");
            exit();
        }
    }
}
?>
