<?php
include ('config.php');

if(!empty($_SESSION['id'])){
    $id = $_SESSION['id'];
    $result = mysqli_query($conn, "SELECT u.first_name, u.last_name, u.role_id, r.role
    FROM users u 
    INNER JOIN roles r ON u.role_id = r.id
    WHERE u.id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    echo 
        "
        <script>
            alert('You must log in to access this page');
            window.location.href = 'login.php';
        </script>
        ";
}

if(isset($_POST['submit'])){
    $user_id = $_POST['user_id'];
    $review = $_POST['review'];

    $query = "INSERT INTO reviews (review, user_id) VALUES ('$review','$user_id')";
    $result = mysqli_query($conn, $query);

    if($result){
        echo "<script>alert('Review added successfully.'); window.location.href = 'index.php';</script>";
    } else {
        echo '<script>alert("Failed to add review."); window.location.href = "error.php";</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>F&L Boutique Store</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>F&L<span>.</span></h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.php#hero">Home</a></li>
                    <li><a href="index.php#about">About</a></li>
                    <li><a href="index.php#menu">Products</a></li>
                    <li><a href="index.php#testimonials">Feedback</a></li>
                    <li><a href="index.php#events">News</a></li>
                    <li><a href="index.php#chefs">Career</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                    <?php
                    if(!empty($_SESSION['id'])){
                        $id = $_SESSION['id'];
                        $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
                        $row = mysqli_fetch_assoc($result);

                        echo '<li class="dropdown"><a href="#"><span>'.$row['first_name'].' '.$row['last_name'].'</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>';
                        echo '<ul>';
                        echo '<li><a href="review.php">Leave a Review</a></li>';
                        echo '<li><a href="logout.php">Log Out</a></li>';
                        echo '</ul>';
                        echo '</li>';
                    } else {
                        echo '<li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>';
                        echo '<ul>';
                        echo '<li><a href="review.php">Leave a Review</a></li>';
                        echo '<li><a href="login.php">Log In</a></li>';
                        echo '</ul>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Leave a Review</h2>
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>Leave a Review</li>
                    </ol>
                </div>

            </div>
        </div>
        <!-- End Breadcrumbs -->
        
        <!-- ======= Leave a Review Section ======= -->
        <section id="book-a-table" class="book-a-table">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Leave A Review</h2>
                    <p>Leave <span>Your Review</span> For Us</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <form action="" method="post" data-aos="fade-up" data-aos-delay="100" enctype="multipart/form-data" class="bg-light p-4">
                            <?php
                            if(!empty($_SESSION['id'])){
                                $id = $_SESSION['id'];
                                $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
                                $row = mysqli_fetch_assoc($result);
                            } else {
                                echo "<script>alert('You must log in to access this page'); window.location.href = 'login.php';</script>";
                            }
                            ?>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Your First Name" data-rule="minlen:2" data-msg="Please enter at least 2 characters" value="<?php echo $row['first_name']; ?>" disabled>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Your Last Name" data-rule="minlen:2" data-msg="Please enter at least 2 characters" value="<?php echo $row['last_name']; ?>" disabled>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" value="<?php echo $row['email']; ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="review" rows="5" placeholder="Review" required></textarea>
                            </div>
                            <div class="text-center mt-4"><button type="submit" name="submit" class="btn btn-danger">Leave a Review</button></div>
                        </form>
                    </div>
                    <!-- End Review Form -->
                </div>
            </div>
        </section>
        <!-- End Leave a Review Section -->
    </main>
    <!-- End #main -->

  <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div>
                        <h4>Address</h4>
                        <p>
                        Jalan Boling Padang 13/62, Seksyen 13, 40100 <br>
                        Shah Alam, Selangor, Malaysia<br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Contact Us</h4>
                        <p>
                        <strong>Phone:</strong> +60 11 2363 5979<br>
                        <strong>Email:</strong> razinzuhairi@gmail.com<br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Opening Hours</h4>
                        <p>
                        <strong>Mon-Sat: 10AM</strong> - 22PM<br>
                        Sunday: Closed
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Follow Us</h4>
                    <div class="social-links d-flex">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/razinnnnnnnn_?igsh=MWJtMmZsbndlN3VxNw%3D%3D&utm_source=qr" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Fashion & Lifestyle</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://www.instagram.com/razinnnnnnnn_?igsh=MWJtMmZsbndlN3VxNw%3D%3D&utm_source=qr">Razin Zuhairi</a>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>