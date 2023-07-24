<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Portal</title>
    <!-- Link To CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Box Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <style>
        #no-results-message {
            color: black;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="#" class="logo"><img src="img/logo.png"></a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#ride">Ride</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#reviews">Reviews</a></li>
        </ul>
        <div class="search">
            <input class="srch" type="search" name="" id="brand-search" placeholder="Search for cars....">
            <a href="#services"><button class="btn" >Search</button></a>
        </div>
        <div class="header-btn">
            <!-- <a href="#" class="sign-up">Sign Up</a> -->
            <a href="login.php" class="sign-in">Sign In</a>
        </div>
    </header>

    <!-- Home -->
    <section class="home" id="home">
        <div class="text">
            
            <h1><span>Looking</span> to <br>rent a car</h1>
            <p>Connecting you to the biggest brands in car rental.<br>Rent it out.</p>
        </div>

        <!-- <div class="form-container">
            <form action="">
                <div class="input-box">
                    <span>From</span>
                    <input type="search" name="" id="" placeholder="Enter a location">
                </div>
                <div class="input-box">
                    <span>To</span>
                    <input type="search" name="" id="" placeholder="Enter a location">
                </div>
                <div class="input-box">
                    <span>Pick-up Date</span>
                    <input type="date" name="" id="" min="<?php echo date("Y-m-d"); ?>">
                </div>
                <div class="input-box">
                    <span>Return Date</span>
                    <input type="date" name="" id="" min="<?php echo date("Y-m-d"); ?>">
                </div>
                <div class="input-box">
                    <span>Trip Type</span>
                    <select name="type">
                        <option hidden>Choose</option>
                        <option>Inside Valley</option>
                        <option>Outside Valley</option>
                    </select>
                </div>
                <div class="input-box">
                    <span>Brand Name</span>

                    <div class="brand">
                    <select class="selectpicker" name="brand" required>
                        <?php
                        // $connection = new mysqli("localhost", "root", "", "carrentalportal");
                        // $getBrandQuery = "SELECT brand_id, brandname FROM brand";
                        // $brandResult = $connection->query($getBrandQuery);

                        // if ($brandResult && $brandResult->num_rows > 0) {
                        //     echo "<option value='' hidden>Choose</option>"; // Move this line outside the while loop
                        //     while ($brand = $brandResult->fetch_object()) {
                        //         echo "<option value='" . $brand->brand_id . "'>" . $brand->brandname . "</option>";
                        //     }
                        // }
                        ?>
                        </select>
                    </div>
                </div>
                <input type="submit" value="Search" class="btn">
            </form>
        </div> -->

    </section>
    <!-- Ride -->
    <section class="ride" id="ride">
        <div class="heading">
            <span>How It Work</span>
            <h1>Rent With 3 Easy Steps</h1>
            <div class="ride-container">
                <div class="box">
                    <i class='bx bxs-map'></i>
                    <h2>Choose A Location</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus dolorum ullam molestias dolore nemo reiciendis ad accusantium tempora, corrupti recusandae, exercitationem rem earum expedita similique sed ipsam quia molestiae? Dolor.</p>
                </div>

                <div class="box">
                    <i class='bx bxs-calendar-check'></i>
                    <h2>Pick-Up Date</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus dolorum ullam molestias dolore nemo reiciendis ad accusantium tempora, corrupti recusandae, exercitationem rem earum expedita similique sed ipsam quia molestiae? Dolor.</p>
                </div>

                <div class="box">
                    <i class='bx bxs-calendar-star'></i>
                    <h2>Book A Car</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus dolorum ullam molestias dolore nemo reiciendis ad accusantium tempora, corrupti recusandae, exercitationem rem earum expedita similique sed ipsam quia molestiae? Dolor.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Services -->
    <section class="services" id="services">
        <div class="heading">
            <span>Best Services</span>
            <h1>Find The Best Car Suitable For You</h1>
        </div>
        <div class="services-container" id="vehicle-container">
        <p id="no-results-message" style="display: none;">No results found.</p>
            <?php
                include 'config.php';

                // Get the brand name from the search input
                $brandname = isset($_GET['brand']) ? $_GET['brand'] : '';

                // Fetch vehicles from the database based on brand name filter
                $query = "SELECT * FROM `crud`";

                // Apply brand name filter if provided
                if (!empty($brandname)) {
                    $query .= " WHERE brandname LIKE '%$brandname%'";
                }

                $result = $connection->query($query);

                // Check if there are any vehicles
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='box'>";
                        echo "<div class='box-img'>";
                        echo "<img src='uploaded_img/" . $row['vehicleimages'] . "' alt=''>";
                        echo "</div>";
                        echo "<h3>" . $row['vehiclename'] . "</h3>";
                        echo "<h2>Rs." . $row['priceperday'] . "<span>/day</span></h2>";
                        echo "<h4>Brand: " . $row['brandname'] . "</h4>";
                        echo "<h4>Availability: " . $row['vehicleavailability'] . "</h4>";
                        echo "<h4>Mileage: " . $row['mileage'] . "<span> kmpl</span></h4>";
                        echo "<h4>Seat Capacity: " . $row['seatcapacity'] . "</h4>";
                        echo "<a href='login.php' class='btn'>Rent Now</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No vehicles available.</p>";
                }

                // Close the database connection
                $connection->close();
            ?>
        </div>
    </section>
    <!-- About -->
    <section class="about" id="about">
        <div class="heading">
            <span>About Us</span>
            <h1>Best Customer Experience</h1>
        </div>
        <div class="about-container">
            <div class="about-img">
                <img src="img/car_br.png" alt="">
            </div>
            <div class="about-text">
                <span>About Us</span>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe eligendi perferendis et repellat ratione quasi facere nihil. Numquam impedit voluptatibus omnis expedita? Quaerat molestias molestiae rem sunt doloribus ipsa iure voluptatum et accusantium. Suscipit!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, modi quas necessitatibus obcaecati impedit a hic iusto rem.</p>
                <a href="#" class="btn">Learn More</a>
            </div>
        </div>
    </section>
    <!-- Reviews -->
    <section class="reviews" id="reviews">
        <div class="heading">
            <span>Reviews</span>
            <h1>What Our Customer Say</h1>
        </div>
        <div class="reviews-container">
            <div class="box">
                <div class="rev-img">
                    <img src="img/rev1.jpg" alt="">
                </div>
                <h2>Harry</h2>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i> 
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star-half' ></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Impedit, tenetur ut illum id vel alias molestias dolorum nihil.</p>
            </div>

            <div class="box">
                <div class="rev-img">
                    <img src="img/rev2.jpg" alt="">
                </div>
                <h2>Peter</h2>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i> 
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star-half' ></i>
                </div>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita explicabo ad tempore consectetur mollitia aperiam, alias qui voluptatibus.</p>
            </div>

            <div class="box">
                <div class="rev-img">
                    <img src="img/rev3.jpg" alt="">
                </div>
                <h2>Anya</h2>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i> 
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star-half' ></i>
                </div>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione commodi ab neque dicta suscipit dolorem perspiciatis dolorum quas.</p>
            </div>
        </div>
    </section>
    <!-- NewsLetter -->
    <section class="newsletter">
        <h2>Subscribe To Newsletter</h2>
        <div class="box">
            <input type="text" placeholder="Enter Your Email...">
            <a href="#" class="btn">Subscribe</a>
        </div>
    </section>
    <div class="copyright">
        <p>Copyright © 2023 - CRP | All Rights Reserved</p>
        <div class="social">
            <a href="#"><i class='bx bxl-facebook'></i></a>
            <a href="#"><i class='bx bxl-twitter'></i></a>
            <a href="#"><i class='bx bxl-instagram'></i></a>
        </div>
    </div>
    
    <!-- ScrollReveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- Link To JS -->
    <script src="js/main.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var searchInput = document.getElementById("brand-search");
        var vehicleContainer = document.getElementById("vehicle-container");
        var boxes = vehicleContainer.getElementsByClassName("box");
        var noResultsMessage = document.getElementById("no-results-message");

        searchInput.addEventListener("input", function() {
            var searchValue = searchInput.value.toLowerCase();
            var resultsFound = false;

            // Loop through all the boxes and hide/show based on brand name filter
            for (var i = 0; i < boxes.length; i++) {
                var brandname = boxes[i].querySelector("h4").textContent.toLowerCase();

                if (brandname.includes(searchValue)) {
                    boxes[i].style.display = "block";
                    resultsFound = true;
                } else {
                    boxes[i].style.display = "none";
                }
            }

            if (resultsFound) {
                noResultsMessage.style.display = "none";
            } else {
                noResultsMessage.style.display = "block";
            }
        });
        });
    </script>

</body>
</html>