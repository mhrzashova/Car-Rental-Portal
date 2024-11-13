<?php
session_start();
include 'config.php';

if (isset($_GET['st']) && $_GET['st'] === 'Completed') {
    // Payment was successful, display a thank-you message and redirect to login
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Thank You</title>
        <link rel='stylesheet' href='css/style.css'> <!-- Optional: Link to CSS for styling -->
    </head>
    <body>
        <div class='thank-you-message'>
            <h1>Thank You for Your Payment!</h1>
            <p>Your transaction has been completed successfully. You’ll be redirected to the login page shortly.</p>
            <p>If you're not redirected, <a href='userdashboard.php'>click here</a>.</p>
        </div>
        <script>
            // Redirect to login.php after a short delay (3 seconds)
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 3000);
        </script>
    </body>
    </html>
    ";
    exit();
} else {
    // Handle unsuccessful payments or show an error message
    echo "
    <h1>Thank You for Your Payment!</h1>
    <p>Your transaction has been completed successfully.</p>
    <a href='userdashboard.php'>Return to User Dashboard</a>
    ";
}
?>
