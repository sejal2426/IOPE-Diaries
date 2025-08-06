<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'event_db');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IOPE Diaries</title>
    <link rel="stylesheet" href="home.css">
    <script src="https://kit.fontawesome.com/de1910d810.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">

    <style>
        .white-text {
            color: white;
        }
.image-card img {
    height: 300px;             /* Fix all images to same height */
    width: 100%;               /* Full width of card */
    object-fit: cover;         /* Crop image to fit box without stretching */
    border-radius: 10px;       /* Rounded corners (optional) */
}

.image-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    border-radius: 5px;
    overflow: hidden;
}

.image-card:hover {
    background-color: #f0f8ff; /* Light blue */
    transform: scale(1.02);
    transition: all 0.3s ease;
}


.card-body {
    padding: 10px;
    background-color: #fff;
}

.card-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 0;
}

    </style>
</head>
<body>

    <!-- Header -->
    <section class="header">
        <video autoplay loop muted plays-inline class="back-video">
            <source src="images/vid5.mp4" type="video/mp4">
        </video>
        <nav>
            <a href="#"><img src="images/logo.png" alt="Logo"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="crs.php">Course</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <div class="content">
            <h1>IOPE Diaries</h1>
            <a href="event new/users.php">Explore our Events</a>
        </div>
    </section>
<!-- image upload latest -->
   <div class="container">
    <section class="campus">
        <div class="event">
            <h1>Latest Events</h1>
         <p>Explore our most recent event highlights, where moments are captured and memories are made — stay connected with the latest happenings on campus.</p>

            <div class="container py-5">
                <div class="row mt-4">
                    <?php 
                    $connection = mysqli_connect("localhost", "root", "", "event_db");

                    $query = "SELECT * FROM images ORDER BY id DESC LIMIT 3";
                    $query_run = mysqli_query($connection, $query);

                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $image_name = htmlspecialchars($row['eventname']);
                            $image_file = htmlspecialchars($row['image']);
                            $image_path = "ImageUpload/uploads/$image_file";
                    ?>
                    <div class="col-md-4 mt-4">
                        <div class="card image-card">
                            <img src="<?php echo $image_path; ?>" 
                                 alt="Admin Upload" 
                                 class="card-img-top image-hover"
                                 onerror="this.onerror=null;this.src='images/default.jpg';">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $image_name; ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo "<p class='text-center'>No uploads found.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>



    <!-- Campus Section -->
    <div class="container">
        <section class="campus">
            <h1>Our Global Campus</h1>
            <p>The place where all the memories created in IOPE, Lonere are stored.</p>
            <div class="row">
                <div class="campus-col">
                    <img src="images/campus1.jpg" alt="Workout Area">
                    <div class="layer"><h3>Workout Area</h3></div>
                </div>
                <div class="campus-col">
                    <img src="images/campus2.jpg" alt="DBATU Campus">
                    <div class="layer"><h3>DBATU Campus</h3></div>
                </div>
                <div class="campus-col">
                    <img src="images/campus3.jpg" alt="Main Entrance">
                    <div class="layer"><h3>Main Entrance</h3></div>
                </div>
            </div>
        </section>
    </div>

    <!-- About Developers -->
    <div class="abt">
        <h1>Click Here To Know<br> About Our Developers</h1>
        <a href="abt.php" class="hero-btn">Click Here</a>
    </div>

    <!-- Footer -->
    <section class="footer">
        <h4>About Us</h4>
        <p>This website provides you with the photos of events conducted in IOPE, Lonere.</p>
        <div class="icons">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
            <i class="fa fa-instagram"></i>
            <i class="fa fa-linkedin"></i>
        </div>
        <p>Made with <i class="fa fa-heart-o"></i> by Team Codeholics</p>
    </section>

    <!-- Menu Toggle JS -->
    <script>
        var navLinks = document.getElementById("navLinks");
        function showMenu(){
            navLinks.style.right = "0";
        }
        function hideMenu(){
            navLinks.style.right = "-200px";
        }
    </script>
</body>
</html>
