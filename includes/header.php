<!-- Header -->
<header>
        <a href="#" class="logo"><img src="img/logo.png"></a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="userdashboard.php#home">Home</a></li>
            <li><a href="userdashboard.php#ride">Ride</a></li>
            <li><a href="userdashboard.phpservices.php">Services</a></li>
            <li><a href="userdashboard.php#about">About</a></li>
            <li><a href="userdashboard.php#reviews">Reviews</a></li>
        </ul>
        
        <div class="search">
            <input class="srch" type="search" name="" id="brand-search" placeholder="Search for cars....">
            <a href="#services"><button class="btn" >Search</button></a>
        </div>
        
        <div class="action">
            <div class="profile">
                <?php
                    $select = mysqli_query($connection, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('Query failed');
                    if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                        if($fetch['image'] == ''){
                            echo '<img src="images/avatar.png" alt="Profile Picture" width="40" height="40">';
                        }else{
                            echo '<img class="profile_pic" src="uploaded_img/'.$fetch['image'].'" alt="Profile Picture" width="40" height="40">';
                        }
                    }
                ?>
            </div>

            <div class="p">
            <h5><span>Profile</span></h5>
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <?php
                            $select = mysqli_query($connection, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('Query failed');
                            if(mysqli_num_rows($select) > 0){
                            $fetch = mysqli_fetch_assoc($select);
                            if($fetch['image'] == ''){
                            echo '<img src="images/avatar.png">';
                            }else{
                            echo '<img src="uploaded_img/'.$fetch['image'].'">';
                            }
                            }
                        ?>
                        <a href="#"><?php echo ''.$fetch['full_name'].''; ?></a>
                    </li>
                    <li><img src="images/user.png"><a href="update_profile.php">Edit Profile</a></li>
                    <!-- <li><img src="images/kyc.png"><a href="kyc.php">Update KYC</a></li> -->
                    <li><img src="images/padlock.png"><a href="password.php">Change Password</a></li>
                    <li><img src="images/car.png"><a href="mybooking.php">My Booking</a></li>
                    <li><img src="images/review.png"><a href="post_testimonial.php">Post a Testimonial</a></li>
                    <li><img src="images/reviews.png"><a href="my_testimonial.php">My Testimonial</a></li>
                    <li><img src="images/log-out.png"><a href="index.php">Logout</a></li>
                </ul>
            </div>
        </div>
        </div>
    </header>