<?php
session_start();
include 'config.php';

if (!isset($_SESSION['users']) || !is_array($_SESSION['users'])) {
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
        .success-message {
        text-align: center;
        margin-top: 20px;
        font-size: 18px;
        color: green;
        }

        /* Add this CSS to keep the footer at the bottom of the page */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .testimonials {
            flex: 1;
        }
        .testimonials-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
        }

        .testimonial-box {
            border: 1px solid #ccc;
            padding: 10px;
            width: 50%;
            margin-left: 280px;
            background-color: #f9f9f9;
        }

        .testimonial-content {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .testimonial-date {
            font-size: 13px;
            color: #888;
        }

        .status-box {
            width: 80px;
            padding: 5px;
            text-align: center;
            float: right;
            color: #fff;
        }

        /* Add this CSS to align the status boxes on the right side */
        @media (min-width: 768px) {
            .testimonials-container {
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    <?php include('includes/header.php');?>

    <section class="testimonials" id="testimonials">
        <div class="heading">
            <span>Testimonials</span>
            <h1>My Testimonial</h1>
        </div>

        <div class="testimonials-container">
        <?php
        // Fetch testimonials for the logged-in user
        $query = "SELECT * FROM testimonial WHERE user_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Display testimonial details in boxes
                    echo '<div class="testimonial-box">';
                    echo '<div class="testimonial-content">' . $row['testimonial'] . '</div>';
                    echo '<div class="testimonial-date">Posting Date: ' . $row['postingdate'] . '</div>';
                    

                    // Display status separately on the right side with different colors
                    echo '<div class="status-box" style="background-color: ' . ($row['status'] == 0 ? 'red' : 'green') . '">';
                    echo ($row['status'] == 0 ? 'Inactive' : 'Active');
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="no-testimonials-message">No testimonials found.</div>';
            }
        } else {
            echo '<div class="error-message">Error fetching testimonials.</div>';
        }

        $stmt->close();
        $connection->close();
        ?>
    </div>
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
