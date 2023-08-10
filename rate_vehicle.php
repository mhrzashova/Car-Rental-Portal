<?php
    session_start();
    include 'config.php';
    
    if (!isset($_SESSION['users']) || !is_array($_SESSION['users'])) {
        header("Location: login.php");
        exit();
    }
    
    $user_id = $_SESSION['users']['user_id'];

    // Get the vehicle ID from the URL parameter
    if (isset($_GET['vehicleid'])) {
        $vehicleid = $_GET['vehicleid'];
        
        // Fetch vehicle information from the database based on vehicle ID
        $query = "SELECT * FROM `crud` WHERE vehicleid = '$vehicleid'";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            $vehicleInfo = $result->fetch_assoc();
        } else {
            // Handle vehicle not found
            echo "Vehicle not found.";
            exit();
        }
    } else {
        // Handle missing vehicle ID
        echo "Vehicle ID not provided.";
        exit();
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rating = $_POST['rating'];
        // Insert the rating into the ratings table
        $insert_query = "INSERT INTO ratings (user_id, vehicleid, rating) VALUES ('$user_id', '$vehicleid', '$rating')";
        if ($connection->query($insert_query) === TRUE) {
            // Rating inserted successfully
            // Update the average rating for the vehicle in the crud table
            $update_query = "UPDATE crud SET average_rating = (SELECT AVG(rating) FROM ratings WHERE vehicleid = '$vehicleid') WHERE vehicleid = '$vehicleid'";
            if ($connection->query($update_query) === TRUE) {
                header("Location: userdashboard.php#services"); // Redirect to the vehicle details page
                exit;
            } else {
                echo "Error updating average rating: " . $connection->error;
            }
        } else {
            echo "Error inserting rating: " . $connection->error;
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate This Vehicle</title>
    <!-- Link To CSS -->
    <link rel="stylesheet" href="css/rent.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css"/> 
</head>
<body>
<?php include('includes/header.php');?>
<!-- Services -->
<section class="rate-vehicle">
        <div class="heading">
            <span>Rate This Vehicle</span>
            <h1>Rate <?php echo $vehicleInfo['vehiclename']; ?></h1>
        </div>
        <div class="rating-form">
            <form method="POST">
                <label for="rating">Select your rating:</label>
                <select name="rating" id="rating">
                    <option value="1">1 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Star</option>
                </select>
                <button type="submit">Submit Rating</button>
            </form>
        </div>
    </section>

    <?php include('includes/footer.php');?>

</body>
</html>

    