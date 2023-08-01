<?php
// Database connection
$connection = new mysqli("localhost", "root", "", "carrentalportal");

// Checking connection
if ($connection->connect_errno != 0) {
    die("<h1>404 Error Not Found</h1>");
}

// Fetch testimonials with corresponding user information from the database
$query = "SELECT t.*, u.full_name, u.email FROM testimonial t
          INNER JOIN users u ON t.user_id = u.user_id
          WHERE t.status = '1'
          ORDER BY t.postingdate DESC"; // Fetch only active testimonials

$result = $connection->query($query);

// Check if there are any testimonials
if ($result->num_rows > 0) {
    $testimonials = array();
    while ($row = $result->fetch_assoc()) {
        $testimonial = array(
            'full_name' => $row['full_name'],
            'testimonial' => $row['testimonial']
        );
        array_push($testimonials, $testimonial);
    }
    echo json_encode($testimonials);
} else {
    echo json_encode(array());
}

// Close the database connection
$connection->close();
?>
