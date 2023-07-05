<?php
include("config.php");
$select = "SELECT * FROM users WHERE user_id = 2";
$result = $conn->query($select); // query execution

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "<img src='" . $row['image'] . "' alt='no path'>";
    }
}

$birth_date = "2000-01-01";
$today = date("Y-m-d");
$diff = date_diff(date_create($birth_date), date_create($today))->days;

if ($diff < 6570 || $diff > 21900) { // 6570 days = 18 years, 21900 days = 60 years
    echo 'Age must be greater than 18 and less than 60.';
} else {
    echo 'Good to go!';
}
?>
