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
            <input class="srch" type="search" name="" placeholder="Search for cars....">
            <a href="#"><button class="btn" >Search</button></a>
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
            
            <!-- <div class="app-stores">
                <img src="img/ios.png" alt="">
                <img src="img/512x512.png" alt="">
            </div> -->
        </div>

        <div class="form-container">
            <form action="">
                <div class="input-box">
                    <span>Location</span>
                    <input type="search" name="" id="" placeholder="Search Places">
                </div>
                <div class="input-box">
                    <span>Pick-up Date</span>
                    <input type="date" name="" id="" min="<?php echo date("Y-m-d"); ?>">
                </div>
                <div class="input-box">
                    <span>Return Date</span>
                    <input type="date" name="" id="" min="<?php echo date("Y-m-d"); ?>">
                </div>
                <input type="submit" name="" id="" class="btn">
            </form>
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
            <h1>Find The Best Car Suitable For you</h1>
        </div>
        <div class="services-container">
            <div class="box">
                <div class="box-img">
                    <img src="img/car1.jpg" alt="">
                </div>
                <p>2017</p>
                <h3>Hyundai i10</h3>
                <h2>Rs.2000 <span>/day</span></h2>
                <a href="#" class="btn">Rent Now</a>
            </div>

                <div class="box">
                    <div class="box-img">
                        <img src="img/car2.jpg" alt="">
                    </div>
                    <p>2018</p>
                    <h3>Suzuki Baleno</h3>
                    <h2>Rs.2000 <span>/day</span></h2>
                    <a href="#" class="btn">Rent Now</a>
                </div>

                <div class="box">
                    <div class="box-img">
                        <img src="img/car3.jpg" alt="">
                    </div>
                    <p>2018</p>
                    <h3>Toyota Yaris L</h3>
                    <h2>Rs.2000 <span>/day</span></h2>
                    <a href="#" class="btn">Rent Now</a>
                </div>

                <div class="box">
                    <div class="box-img">
                        <img src="img/car4.jpg" alt="">
                    </div>
                    <p>2017</p>
                    <h3>Hyundai Santro</h3>
                    <h2>Rs.2000 <span>/day</span></h2>
                    <a href="#" class="btn">Rent Now</a>
                </div>

                <div class="box">
                    <div class="box-img">
                       <img src="img/car5.jpg" alt="">
                    </div>
                    <p>2018</p>
                    <h3>Maruti Suzuki Swift</h3>
                    <h2>Rs.2000 <span>/day</span></h2>
                    <a href="#" class="btn">Rent Now</a>
                </div>

                <div class="box">
                    <div class="box-img">
                        <img src="img/car6.jpg" alt="">
                    </div>
                    <p>2020</p>
                    <h3>Hyundai Creta</h3>
                    <h2>Rs.5000 <span>/day</span></h2>
                    <a href="#" class="btn">Rent Now</a>
                </div>
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
</body>
</html>