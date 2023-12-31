<?php
    session_start();
    include 'config.php';
    
    if (!isset($_SESSION['users']) || !is_array($_SESSION['users'])) {
        header("Location: login.php");
        exit();
    }
    
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<script>alert('$message');</script>";
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

    // // Fetch full_name from users table and comment from ratings table where status is 1
    // $fetchDataQuery = "SELECT u.full_name, r.comment
    // FROM users u
    // INNER JOIN ratings r ON u.user_id = r.user_id
    // WHERE r.status = 1
    // AND r.vehicleid = '$vehicleid'
    // AND u.user_id = '$user_id'";

    // $fetchDataResult = $connection->query($fetchDataQuery);

    // if ($fetchDataResult->num_rows > 0) {
    // while ($row = $fetchDataResult->fetch_assoc()) {
    // $full_name = $row['full_name'];
    // $existingComment = $row['comment'];
    // // Process fetched data here
    // }
    // } else {
    // $full_name = "No Full Name Found";
    // $existingComment = "No Comment Found";
    // }

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
    <style>
        /* Styles for centering the content */
        .center-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Styles for the box containing vehicle information */
        .box {
            text-align: center;
        }

        /* Styles for the vehicle image */
        .box-img img {
            max-width: 100%;
            max-height: 350px;
            margin-top: 300px;
        }

        /* Styles for the heading */
        .heading {
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        /* Styles for the rating and comment form */
        .rating-form {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%; /* Adjust the width as per your design */
            max-width: 400px; /* Set a maximum width if needed */
        }

        .rating-form label {
            font-size: 18px;
            margin-bottom: 10px;
            display: block;
            text-align: left;
        }

        .rating-form select,
        .rating-form textarea {
            font-size: 16px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .rating-form input[type="submit"] {
            font-size: 18px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .rating-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include('includes/header.php');?>
<!-- Services -->
<section class="rate-vehicle">
        <div class="center-container">
            <div class="box">
                <div class="box-img">
                    <img src='uploaded_img/<?php echo $vehicleInfo['vehicleimages']; ?>' alt=''>
                </div>
                <h3><?php echo $vehicleInfo['vehiclename']; ?></h3>
            </div>
            <br><br>
        <div class="heading">
            <h1>Rate This Vehicle</h1>
        </div>
        <div class="rating-form">
        <form method="post" action="process_rating.php">
            <label for="rating">Rate this vehicle:</label>
            <select id="rating" name="rating">
                <option value="1">1 star</option>
                <option value="2">2 stars</option>
                <option value="3">3 stars</option>
                <option value="4">4 stars</option>
                <option value="5">5 stars</option>
            </select>
            <input type="hidden" name="vehicleid" value="<?php echo $vehicleid; ?>">
            <label for="comment">Add a comment:</label>
            <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
            <input type="submit" value="Submit Rating">
        </form>
        </div>
        </div>
    </section>


</body>
</html>

    