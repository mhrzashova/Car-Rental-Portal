<?php
session_start();
include 'config.php';

if (!isset($_SESSION['users']) || !is_array($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['users']['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user_id and testimonial fields are set and not empty
    if (
        isset($_POST['user_id']) && !empty($_POST['user_id']) &&
        isset($_POST['testimonial']) && !empty($_POST['testimonial'])
    ) {
        // Sanitize the data to prevent SQL injection
        $user_id = $_POST['user_id'];
        $testimonial = htmlspecialchars($_POST['testimonial']);
        $status = '0'; // Set the status to 'pending' initially, you can update it later based on your needs

        // Prepare and execute the SQL query to insert the testimonial into the database
        $stmt = $connection->prepare("INSERT INTO testimonial (user_id, testimonial, status) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $testimonial, $status);
        

        if ($stmt->execute()) {
            echo "<script>
                    if (confirm('Testimonial posted successfully. Click OK to view your testimonial.')) {
                        window.location.href = 'my_testimonial.php';
                    } else {
                        window.location.href = 'userdashboard.php';
                    }
                </script>";
            exit();
        } else {
            // Error occurred while inserting the testimonial
            $_SESSION['testimonial_error'] = "Error: " . $stmt->error;
            header('Location: post_testimonial.php'); // Redirect to my_testimonial.php with an error message
            exit;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Required fields are missing
        $_SESSION['testimonial_error'] = "Please fill all the required fields.";
        header('Location: my_testimonial.php'); // Redirect to my_testimonial.php with an error message
        exit;
    }
}
?>
<?php

include 'config.php';

// Check if the testimonial submission was successful
if (isset($_SESSION['testimonial_success']) && $_SESSION['testimonial_success']) {
    echo "Testimonial posted successfully!";
    unset($_SESSION['testimonial_success']); // Clear the success flag in session
} elseif (isset($_SESSION['testimonial_error'])) {
    echo $_SESSION['testimonial_error'];
    unset($_SESSION['testimonial_error']); // Clear the error message in session
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
        
    </style>
</head>
<body>
    <?php include('includes/header.php');?>

    <section class="testimonials" id="testimonials">
        <div class="heading">
            <span>Testimonials</span>
            <h1>Post Your Testimonial</h1>
        </div>

        <div class="testimonial-form">
            <form action="post_testimonial.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <div class="input-box">
                    <span>Testimonial Message</span>
                    <textarea name="testimonial" rows="4" required></textarea>
                </div>
                <button type="submit" class="btns">Submit Testimonial</button>
            </form>
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
