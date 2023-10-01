<?php
   include 'config.php';

    if(isset($_POST['vehicleid'])) {
        $vehicleid = $_POST['vehicleid'];
        error_log("Received Vehicle ID: " . $vehicleid);


        // Fetch comments and user names from the ratings and users table where status is set to 1 and vehicleid matches
        $query = "SELECT ratings.comment, users.full_name 
                  FROM `ratings` 
                  INNER JOIN `users` ON ratings.user_id = users.user_id 
                  WHERE ratings.vehicleid = '$vehicleid' AND ratings.status = 1";
        $result = $connection->query($query);

        error_log("SQL Query: " . $query);
        $result = $connection->query($query);
        if (!$result) {
            die("Error: " . $connection->error); // Handle the error appropriately
        }

        if ($result->num_rows > 0) {
            echo "<h2>Comments:</h2>";
            while($row = $result->fetch_assoc()) {
                echo "<p><strong>{$row['full_name']}:</strong> {$row['comment']}</p>";
            }
        } else {
            echo "<p>No comments available.</p>";
        }
    } else {
        echo "<p>Invalid request.</p>";
    }

?>

