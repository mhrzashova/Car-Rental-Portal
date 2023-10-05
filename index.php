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
        .testimonial-box {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden; /* Hide any overflow content */
            width: 400px; /* Set the desired width for the boxes */
            text-align: center;
        }
        .testimonial-box h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            white-space: nowrap; /* Prevent long names from breaking into multiple lines */
            overflow: hidden; /* Hide any overflow content */
            color: var(--main-color);
            text-overflow: ellipsis; /* Display ellipsis (...) for long names */
            text-align: center;
        }
        .testimonial-box p {
            font-size: 14px;
            color: #555;
            overflow: hidden; /* Hide any overflow content */
            text-overflow: ellipsis; /* Display ellipsis (...) for long testimonials */
        }
        .reviews-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            overflow-x: auto; /* Enable horizontal scrolling if the content overflows */
        }
        .testimonial-box {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden; /* Hide any overflow content */
        }
        .nav-buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .nav-buttons button {
            padding: 8px 16px;
            background-color: #474fa0;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .nav-buttons button:hover {
            background-color: var(--main-color);
        }

        /* Additional CSS for the Contact Us section */
        .newsletter {
            background-color: #f8f8f8;
            padding: 40px 20px;
            text-align: center;
        }

        .newsletter h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .newsletter .box {
            max-width: 400px;
            margin: 0 auto;
            font-size: 1.2rem;
            color: #555;
        }

        .newsletter .box p {
            margin: 10px 0;
        }

        /* Optional: Add media queries for responsive design */
        @media (max-width: 768px) {
            .newsletter {
                padding: 30px 10px;
            }

            .newsletter h2 {
                font-size: 1.8rem;
            }

            .newsletter .box {
                font-size: 1rem;
            }
        }
        .newsletter {
            background: linear-gradient(to top right, #fe5b3d, #ffac38);
            display: flex;
            flex-direction: column;
            align-items: center;
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

                $query .= " ORDER BY priceperday ASC";
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
                <p>Welcome to Car Rental Portal, your trusted partner in hassle-free and reliable car rentals. At Car Rental Portal , we believe in empowering your journey, whether it's a quick business trip, a family vacation, or an adventurous road trip. With a commitment to exceptional service, cutting-edge technology, and a passion for driving excellence, we are your gateway to convenient and affordable car rentals.</p>
                <p>At Car Rental Portal, our vision is to redefine the way you travel. We aim to create a seamless and enjoyable experience for every customer, ensuring that renting a car is as simple as it should be. We envision a future where mobility is not just about reaching your destination but enjoying the journey with comfort, safety, and style.</p>
                <!-- <a href="#" class="btn">Learn More</a> -->
            </div>
        </div>
    </section>
    <!-- Reviews -->
    <section class="reviews" id="reviews">
        <div class="heading">
            <span>Reviews</span>
            <h1>What Our Customer Say</h1>
        </div>
        <div class="reviews-container" id="reviews-container">
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Function to fetch testimonials using AJAX
                    function fetchTestimonials() {
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'fetch_testimonials.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/json');
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                var testimonials = JSON.parse(xhr.responseText);
                                var reviewsContainer = document.getElementById('reviews-container');
                                reviewsContainer.innerHTML = ''; // Clear existing content

                                if (testimonials.length > 0) {
                                    testimonials.forEach(function (testimonial) {
                                        var testimonialBox = document.createElement('div');
                                        testimonialBox.classList.add('testimonial-box');

                                        var fullName = document.createElement('h3');
                                        fullName.textContent = testimonial.full_name;

                                        var testimonialMessage = document.createElement('p');
                                        testimonialMessage.textContent = testimonial.testimonial;

                                        testimonialBox.appendChild(fullName);
                                        testimonialBox.appendChild(testimonialMessage);
                                        reviewsContainer.appendChild(testimonialBox);
                                    });
                                } else {
                                    var noTestimonialsMessage = document.createElement('p');
                                    noTestimonialsMessage.textContent = 'No testimonials available.';
                                    reviewsContainer.appendChild(noTestimonialsMessage);
                                }
                            }
                        };
                        xhr.send();
                    }

                    // Fetch and display testimonials when the page loads
                    fetchTestimonials();
                });
            </script>
        </div>
        <div class="nav-buttons">
            <button id="left-button">&larr;</button>
            <button id="right-button">&rarr;</button>
        </div>
        
    </section>
    <!-- NewsLetter -->
    <section class="newsletter">
    <h2>Contact Us</h2>
    <div class="box">
        <p>
            <h4>For any inquiries or assistance, feel free to reach out to us at:</h4>
        <br>
            Email: info@carrentalportal.com
       <br>
            Phone: +9779835673489
        </p>
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

        // JavaScript code for left and right navigation
        const reviewsContainer = document.querySelector(".reviews-container");
        const leftButton = document.getElementById("left-button");
        const rightButton = document.getElementById("right-button");

        // Set the initial position and the number of testimonials to display at a time
        let position = 0;
        const testimonialsPerPage = 4;

        // Function to update the display of testimonials based on the current position
        function updatePosition() {
            const testimonialBoxes = document.querySelectorAll(".testimonial-box");
            const numTestimonials = testimonialBoxes.length;
            const maxPosition = Math.ceil(numTestimonials / testimonialsPerPage) - 1;

            // Hide all testimonials
            testimonialBoxes.forEach((box) => {
            box.style.display = "none";
            });

            // Show the testimonials for the current position
            const startIdx = position * testimonialsPerPage;
            const endIdx = Math.min(startIdx + testimonialsPerPage, numTestimonials);

            for (let i = startIdx; i < endIdx; i++) {
            testimonialBoxes[i].style.display = "block";
            }
        }

        // Move the testimonials to the left
        leftButton.addEventListener("click", () => {
            if (position > 0) {
            position--;
            updatePosition();
            }
        });

        // Move the testimonials to the right
        rightButton.addEventListener("click", () => {
            const numTestimonials = document.querySelectorAll(".testimonial-box").length;
            const maxPosition = Math.ceil(numTestimonials / testimonialsPerPage) - 1;
            if (position < maxPosition) {
            position++;
            updatePosition();
            }
        });

        // Show the initial set of testimonial boxes
        updatePosition();
        });
    </script>

</body>
</html>