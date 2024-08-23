<?php
include "config.php";
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
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#menu">Products</a></li>
                    <li><a href="#testimonials">Feedback</a></li>
                    <li><a href="#events">News</a></li>
                    <li><a href="#chefs">Career</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <?php
                    if(!empty($_SESSION['id'])){
                        $id = $_SESSION['id'];
                        $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
                        $row = mysqli_fetch_assoc($result);

                        if($row['role_id'] <= 2){
                            echo '<li class="dropdown"><a href="#"><span>'.$row['first_name'].' '.$row['last_name'].'</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>';
                            echo '<ul>';
                            echo '<li class="dropdown"><a href="#"><span>Messages</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>';
                            echo '<ul>';
                            // Fetch messages shared with the current user
                            $messages_query = "SELECT m.message
                                                FROM shared_messages sm
                                                INNER JOIN messages m ON sm.message_id = m.id
                                                WHERE sm.user_id = '$id'";
                            $messages_result = mysqli_query($conn, $messages_query);
                            if(mysqli_num_rows($messages_result) > 0) {
                                while($message_row = mysqli_fetch_assoc($messages_result)) {
                                echo '<li><a href="#">'.$message_row['message'].'</a></li>';
                                }
                            } else {
                                echo '<li><a href="#">No Messages</a></li>';
                            }
                            echo '</ul>';
                            echo '</li>';
                            echo '<li><a href="review.php">Leave a Review</a></li>';
                            echo '<li><a href="logout.php">Log Out</a></li>';
                            echo '</ul>';
                            echo '</li>';
                        } else {
                            echo '<li class="dropdown"><a href="#"><span>'.$row['first_name'].' '.$row['last_name'].'</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>';
                            echo '<ul>';
                            echo '<li><a href="review.php">Leave a Review</a></li>';
                            echo '<li><a href="login.php">Log Out</a></li>';
                            echo '</ul>';
                            echo '</li>';
                        }
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

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center section-bg">
        <div class="container">
            <div class="row justify-content-between gy-5">
                <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
                    <h2 data-aos="fade-up">Get Your Desired<br>Favourite Outfit</h2>
                    <p data-aos="fade-up" data-aos-delay="100">Sed autem laudantium dolores. Voluptatem itaque ea consequatur eveniet. Eum quas beatae cumque eum quaerat.</p>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
                    <img src="assets/img/background.jpg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Section -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>About Us</h2>
                    <p>Learn More <span>About Us</span></p>
                </div>

                <div class="row gy-4">
                    <div class="col-lg-7 position-relative about-img" style="background-image: url(assets/img/about-razin.jpg) ;" data-aos="fade-up" data-aos-delay="150"></div>
                    <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
                        <div class="content ps-0 ps-lg-5">
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                            </ul>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
                            </p>

                            <div class="position-relative mt-4">
                                <img src="assets/img/background_shirt.png" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us section-bg">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="why-box">
                            <h3>Why Choose F&L Boutique Store?</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                                Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus optio ad corporis.
                            </p>
                        </div>
                    </div>
                    <!-- End Why Box -->

                    <div class="col-lg-8 d-flex align-items-center">
                        <div class="row gy-4">
                            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                    <!-- <i class="bi bi-clipboard-data"></i> -->
                                    <h4>Best Quality</h4>
                                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                                </div>
                            </div>
                            <!-- End Icon Box -->

                            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                    <!-- <i class="bi bi-gem"></i> -->
                                    <h4>Affordable Price</h4>
                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                                </div>
                            </div>
                            <!-- End Icon Box -->

                            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                    <!-- <i class="bi bi-inboxes"></i> -->
                                    <h4>Best Services</h4>
                                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                                </div>
                            </div>
                            <!-- End Icon Box -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Why Us Section -->

        <!-- ======= Menu Section ======= -->
        <section id="menu" class="menu">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Our Products</h2>
                    <p>Check Our <span>F&L Products</span></p>
                </div>
                <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <?php
                    if(!empty($_SESSION['id'])){
                        $id = $_SESSION['id'];
                        $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
                        $row = mysqli_fetch_assoc($result);

                        if($row['role_id'] == 2){
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">';
                            echo '<h4>Upcoming Design</h4>';
                            echo '</a>';
                            echo '</li>';
                        } else {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">';
                            echo '<h4>Latest Design</h4>';
                            echo '</a>';
                            echo '</li>';
                        }
                    } else {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">';
                        echo '<h4>Latest Design</h4>';
                        echo '</a>';
                        echo '</li>';
                    }
                    ?>
                    <!-- End tab nav item -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
                            <h4>T-Shirt</h4>
                        </a>
                        <!-- End tab nav item -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-lunch">
                            <h4>Pants</h4>
                        </a>
                    </li>
                    <!-- End tab nav item -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-dinner">
                            <h4>Cap</h4>
                        </a>
                    </li>
                <!-- End tab nav item -->
                </ul>

                <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                    <div class="tab-pane fade active show" id="menu-starters">
                        <div class="tab-header text-center">
                            <?php
                            if(!empty($_SESSION['id'])){
                                $id = $_SESSION['id'];
                                $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
                                $row = mysqli_fetch_assoc($result);
                                
                                if($row['role_id'] == 2){
                                    echo '<p>Products</p>';
                                    echo '<h3>Upcoming Design</h3>';
                                } else {
                                    echo '<p>Products</p>';
                                    echo '<h3>Latest Design</h3>';
                                }
                            } else {
                                echo '<p>Products</p>';
                                echo '<h3>Latest Design</h3>';
                            }
                            ?>
                        </div>
                        <div class="row gy-5">
                            <?php
                            if(!empty($_SESSION['id'])){
                                $id = $_SESSION['id'];
                                $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
                                $row = mysqli_fetch_assoc($result);
                                
                                if($row['role_id'] == 2){
                                    $sql = "SELECT * FROM products WHERE status_id = 1 ORDER BY status_id ASC";
                                    $result = mysqli_query($conn, $sql);
    
                                    if(mysqli_num_rows($result) > 0){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $regPrice = $row['price'];
                                            $discount = 10;
                                            $dcPrice = $regPrice - ($regPrice * ($discount / 100));
                                    ?>
                                        <div class="col-lg-4 menu-item">
                                            <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                            <h4><?php echo $row['name']; ?></h4>
                                            <p class="ingredients">
                                                <?php echo $row['quantity']; ?> pcs
                                            </p>
                                            <p class="price" style="text-decoration: line-through;">
                                                RM <?php echo $row['price']; ?>
                                            </p>
                                            <p class="price">
                                                RM <?php echo $dcPrice; ?>
                                            </p>
                                        </div>
                                        <!-- Menu Item -->
                                        <?php
                                        }
                                    } else {
                                        // If there are no products in the database
                                        echo "<p>No products found.</p>";
                                    }
                                } else {
                                    $sql = "SELECT * FROM products WHERE status_id = 2";
                                    $result = mysqli_query($conn, $sql);

                                    if(mysqli_num_rows($result) > 0){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <div class="col-lg-4 menu-item">
                                            <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                            <h4><?php echo $row['name']; ?></h4>
                                            <p class="ingredients">
                                                <?php echo $row['quantity']; ?> pcs
                                            </p>
                                            <p class="price">
                                                RM <?php echo $row['price']; ?>
                                            </p>
                                        </div>
                                        <!-- Menu Item -->
                                        <?php
                                        }
                                    } else {
                                        // If there are no products in the database
                                        echo "<p>No products found.</p>";
                                    }
                                }
                            } else {
                                $sql = "SELECT * FROM products WHERE status_id = 2";
                                $result = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($result) > 0){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <div class="col-lg-4 menu-item">
                                        <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                        <h4><?php echo $row['name']; ?></h4>
                                        <p class="ingredients">
                                            <?php echo $row['quantity']; ?> pcs
                                        </p>
                                        <p class="price">
                                            RM <?php echo $row['price']; ?>
                                        </p>
                                    </div>
                                    <!-- Menu Item -->
                                    <?php
                                    }
                                } else {
                                    // If there are no products in the database
                                    echo "<p>No products found.</p>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!-- End Upcoming Products Content -->

                    <div class="tab-pane fade" id="menu-breakfast">
                        <div class="tab-header text-center">
                            <p>Products</p>
                            <h3>T-Shirt</h3>
                        </div>
                        <div class="row gy-5">
                            <?php
                            if(!empty($_SESSION['id'])){
                                $id = $_SESSION['id'];
                                $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
                                $row = mysqli_fetch_assoc($result);
                                
                                if($row['role_id'] == 2){
                                    $sql = "SELECT * FROM products WHERE category_id = 1 ORDER BY status_id ASC";
                                    $result = mysqli_query($conn, $sql);
    
                                    if(mysqli_num_rows($result) > 0){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $regPrice = $row['price'];
                                            $discount = 10;
                                            $dcPrice = $regPrice - ($regPrice * ($discount / 100));
                                    ?>
                                        <div class="col-lg-4 menu-item">
                                            <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                            <h4><?php echo $row['name']; ?></h4>
                                            <p class="ingredients">
                                                <?php echo $row['quantity']; ?> pcs
                                            </p>
                                            <p class="price" style="text-decoration: line-through;">
                                                RM <?php echo $row['price']; ?>
                                            </p>
                                            <p class="price">
                                                RM <?php echo $dcPrice; ?>
                                            </p>
                                        </div>
                                        <!-- Menu Item -->
                                        <?php
                                        }
                                    } else {
                                        // If there are no products in the database
                                        echo "<p>No products found.</p>";
                                    }
                                } else {
                                    $sql = "SELECT * FROM products WHERE status_id = 2 AND category_id = 1";
                                    $result = mysqli_query($conn, $sql);

                                    if(mysqli_num_rows($result) > 0){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <div class="col-lg-4 menu-item">
                                            <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                            <h4><?php echo $row['name']; ?></h4>
                                            <p class="ingredients">
                                                <?php echo $row['quantity']; ?> pcs
                                            </p>
                                            <p class="price">
                                                RM <?php echo $row['price']; ?>
                                            </p>
                                        </div>
                                        <!-- Menu Item -->
                                        <?php
                                        }
                                    } else {
                                        // If there are no products in the database
                                        echo "<p>No products found.</p>";
                                    }
                                }
                            } else {
                                $sql = "SELECT * FROM products WHERE status_id = 2 AND category_id = 1";
                                $result = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($result) > 0){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <div class="col-lg-4 menu-item">
                                        <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                        <h4><?php echo $row['name']; ?></h4>
                                        <p class="ingredients">
                                            <?php echo $row['quantity']; ?> pcs
                                        </p>
                                        <p class="price">
                                            RM <?php echo $row['price']; ?>
                                        </p>
                                    </div>
                                    <!-- Menu Item -->
                                    <?php
                                    }
                                } else {
                                    // If there are no products in the database
                                    echo "<p>No products found.</p>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!-- End T-Shirt Product Content -->

                    <div class="tab-pane fade" id="menu-lunch">
                        <div class="tab-header text-center">
                            <p>Products</p>
                            <h3>Pants</h3>
                        </div>
                        <div class="row gy-5">
                            <?php
                            if(!empty($_SESSION['id'])){
                                $id = $_SESSION['id'];
                                $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
                                $row = mysqli_fetch_assoc($result);
                                
                                if($row['role_id'] == 2){
                                    $sql = "SELECT * FROM products WHERE category_id = 2 ORDER BY status_id ASC";
                                    $result = mysqli_query($conn, $sql);
    
                                    if(mysqli_num_rows($result) > 0){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $regPrice = $row['price'];
                                            $discount = 10;
                                            $dcPrice = $regPrice - ($regPrice * ($discount / 100));
                                    ?>
                                        <div class="col-lg-4 menu-item">
                                            <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                            <h4><?php echo $row['name']; ?></h4>
                                            <p class="ingredients">
                                                <?php echo $row['quantity']; ?> pcs
                                            </p>
                                            <p class="price" style="text-decoration: line-through;">
                                                RM <?php echo $row['price']; ?>
                                            </p>
                                            <p class="price">
                                                RM <?php echo $dcPrice; ?>
                                            </p>
                                        </div>
                                        <!-- Menu Item -->
                                        <?php
                                        }
                                    } else {
                                        // If there are no products in the database
                                        echo "<p>No products found.</p>";
                                    }
                                } else {
                                    $sql = "SELECT * FROM products WHERE status_id = 2 AND category_id = 2";
                                    $result = mysqli_query($conn, $sql);

                                    if(mysqli_num_rows($result) > 0){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <div class="col-lg-4 menu-item">
                                            <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                            <h4><?php echo $row['name']; ?></h4>
                                            <p class="ingredients">
                                                <?php echo $row['quantity']; ?> pcs
                                            </p>
                                            <p class="price">
                                                RM <?php echo $row['price']; ?>
                                            </p>
                                        </div>
                                        <!-- Menu Item -->
                                        <?php
                                        }
                                    } else {
                                        // If there are no products in the database
                                        echo "<p>No products found.</p>";
                                    }
                                }
                            } else {
                                $sql = "SELECT * FROM products WHERE status_id = 2 AND category_id = 2";
                                $result = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($result) > 0){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <div class="col-lg-4 menu-item">
                                        <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                        <h4><?php echo $row['name']; ?></h4>
                                        <p class="ingredients">
                                            <?php echo $row['quantity']; ?> pcs
                                        </p>
                                        <p class="price">
                                            RM <?php echo $row['price']; ?>
                                        </p>
                                    </div>
                                    <!-- Menu Item -->
                                    <?php
                                    }
                                } else {
                                    // If there are no products in the database
                                    echo "<p>No products found.</p>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!-- End Pants Product Content -->

                    <div class="tab-pane fade" id="menu-dinner">
                        <div class="tab-header text-center">
                            <p>Products</p>
                            <h3>Cap</h3>
                        </div>
                        <div class="row gy-5">
                            <?php
                            if(!empty($_SESSION['id'])){
                                $id = $_SESSION['id'];
                                $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
                                $row = mysqli_fetch_assoc($result);
                                
                                if($row['role_id'] == 2){
                                    $sql = "SELECT * FROM products WHERE category_id = 3 ORDER BY status_id ASC";
                                    $result = mysqli_query($conn, $sql);
    
                                    if(mysqli_num_rows($result) > 0){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $regPrice = $row['price'];
                                            $discount = 10;
                                            $dcPrice = $regPrice - ($regPrice * ($discount / 100));
                                    ?>
                                        <div class="col-lg-4 menu-item">
                                            <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                            <h4><?php echo $row['name']; ?></h4>
                                            <p class="ingredients">
                                                <?php echo $row['quantity']; ?> pcs
                                            </p>
                                            <p class="price" style="text-decoration: line-through;">
                                                RM <?php echo $row['price']; ?>
                                            </p>
                                            <p class="price">
                                                RM <?php echo $dcPrice; ?>
                                            </p>
                                        </div>
                                        <!-- Menu Item -->
                                        <?php
                                        }
                                    } else {
                                        // If there are no products in the database
                                        echo "<p>No products found.</p>";
                                    }
                                } else {
                                    $sql = "SELECT * FROM products WHERE status_id = 2 AND category_id = 3";
                                    $result = mysqli_query($conn, $sql);

                                    if(mysqli_num_rows($result) > 0){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <div class="col-lg-4 menu-item">
                                            <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                            <h4><?php echo $row['name']; ?></h4>
                                            <p class="ingredients">
                                                <?php echo $row['quantity']; ?> pcs
                                            </p>
                                            <p class="price">
                                                RM <?php echo $row['price']; ?>
                                            </p>
                                        </div>
                                        <!-- Menu Item -->
                                        <?php
                                        }
                                    } else {
                                        // If there are no products in the database
                                        echo "<p>No products found.</p>";
                                    }
                                }
                            } else {
                                $sql = "SELECT * FROM products WHERE status_id = 2 AND category_id = 3";
                                $result = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($result) > 0){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <div class="col-lg-4 menu-item">
                                        <a href="assets/img/products/<?php echo $row['image_path']; ?>" class="glightbox"><img src="assets/img/products/<?php echo $row['image_path']; ?>" class="menu-img img-fluid" alt=""></a>
                                        <h4><?php echo $row['name']; ?></h4>
                                        <p class="ingredients">
                                            <?php echo $row['quantity']; ?> pcs
                                        </p>
                                        <p class="price">
                                            RM <?php echo $row['price']; ?>
                                        </p>
                                    </div>
                                    <!-- Menu Item -->
                                    <?php
                                    }
                                } else {
                                    // If there are no products in the database
                                    echo "<p>No products found.</p>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!-- End Cap Products Content -->
                </div>
            </div>
        </section>
        <!-- End Menu Section -->

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Customer Feedback</h2>
                    <p>What Are They <span>Saying About Us</span></p>
                </div>

                <div class="slides-1 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        <?php
                        $sql = "SELECT r.id, r.review, r.user_id, u.first_name, u.last_name, u.id
                        FROM reviews r
                        INNER JOIN users u ON r.user_id = u.id";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<div class="swiper-slide">';
                                echo '<div class="testimonial-item">';
                                echo '<div class="row gy-4 justify-content-center">';
                                echo '<div class="col-lg-6">';
                                echo '<div class="testimonial-content">';
                                echo '<p>';
                                echo '<i class="bi bi-quote quote-icon-left"></i>';
                                echo $row['review'];
                                echo '<i class="bi bi-quote quote-icon-right"></i>';
                                echo '</p>';
                                echo '<h3>'. $row['first_name'] .' '. $row['last_name'] .'</h3>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "No testimonials found.";
                        }
                        ?>
                    </div>
                    <!-- End testimonial item -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <!-- End Testimonials Section -->

        <!-- ======= News Section ======= -->
        <section id="events" class="events">
            <div class="container-fluid" data-aos="fade-up">

                <div class="section-header">
                    <h2>News</h2>
                    <p>F&L <span>Important</span> Activities & Moments</p>
                </div>

                <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        <?php
                        $sql = "SELECT * FROM news ORDER BY date DESC";
                        $result = mysqli_query($conn, $sql);
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $formattedDate = date("d M Y", strtotime($row['date']));
                                ?>
                                <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(assets/img/news/<?php echo $row['image_path']; ?>)">
                                    <h3><?php echo $row['title']; ?></h3>
                                    <div class="price align-self-start"><?php echo $formattedDate; ?></div>
                                    <p class="description"><?php echo $row['description']; ?></p>
                                </div>
                                <!-- End Event item -->
                                <?php
                            }
                        } else {
                            echo "<p>No news found.</p>";
                        }
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <!-- End Events Section -->

        <!-- ======= Career Section ======= -->
        <section id="chefs" class="chefs section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Career</h2>
                    <p>Want to Grow Your Career? <span>Reach Us</span></p>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-7 position-relative about-img mt-4" style="background-image: url(assets/img/career2.jpg) ;" data-aos="fade-up" data-aos-delay="150"></div>
                    <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
                        <div class="content ps-0 ps-lg-5">
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                            </ul>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
                            </p>

                            <div class="position-relative mt-4">
                                <img src="assets/img/career-razin.jpg" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Career Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Contact Us</h2>
                    <p>Got any Questions? <span>Contact Us</span></p>
                </div>
                
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="info-item  d-flex align-items-center">
                            <i class="icon bi bi-map flex-shrink-0"></i>
                            <div>
                                <h3>Our Address</h3>
                                <p>Jalan Boling Padang 13/62, Seksyen 13, 40100</p>
                                <p>Shah Alam, Selangor, Malaysia</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center">
                            <i class="icon bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Us</h3>
                                <p>razinzuhairi@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item  d-flex align-items-center">
                            <i class="icon bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>+60 11 2363 5979</p>
                            </div>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item  d-flex align-items-center">
                            <i class="icon bi bi-share flex-shrink-0"></i>
                            <div>
                                <h3>Opening Hours</h3>
                                <div>
                                    <strong>Mon-Sat:</strong> 10AM - 22PM;
                                    <strong>Sunday:</strong> Closed
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Info Item -->
                </div>
            </div>
        </section>
        <!-- End Contact Section -->
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