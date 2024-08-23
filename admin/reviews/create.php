<?php
include '../../config.php';

if(!empty($_SESSION['id'])){
    $id = $_SESSION['id'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
} else {
    echo 
        "
        <script>
            alert('You must log in to access this page');
            window.location.href = '../../login.php';
        </script>
        ";
}

if(isset($_POST['submit'])){
    $user_id = $_POST['user_id'];
    $review = $_POST['review'];

    echo "Submitted review: ";
    print_r($review);
    echo "<br>";

    echo "Selected users: ";
    print_r($user_id);
    echo "<br>";

    // $query = "INSERT INTO reviews (review, user_id) VALUES ('$review','$user_id')";
    // $result = mysqli_query($conn, $query);

    // if($result){
    //     echo "<script>alert('Review added successfully.'); window.location.href = 'index.php';</script>";
    // } else {
    //     echo "<script>alert('Failed to add review.'); window.location.href = 'create.php';</script>";
    // }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>F&L Boutique Store</title>
</head>
<body>
    <nav class="navbar navbar navbar-expand-lg" style="background-color: orange;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">F&L</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../users/index.php">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="../products/index.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="../news/index.php">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="../reviews/index.php">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="../messages/index.php">Messages</a></li>
            </div>
            <div class="d-flex" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../../logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Add New Review</h3>
            <p class="text-muted">Complete the form below to add a new customer review</p>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;" enctype="multipart/form-data">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <select class="form-control" id="customer" name="customer" required>
                            <option value="">Select Customer</option>
                            <?php
                            $sql = "SELECT * FROM users WHERE role_id >= 2";
                            $result = $conn->query($sql);

                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    echo '<option value="'.$row['id'].'">'.$row['first_name'].' '.$row['last_name'].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" id="user_id" name="user_id">
                        <label class="form-label">Customer Review</label>
                        <textarea name="review" id="review" class="form-control" rows="5" placeholder="Customer Review" required></textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById("customer").addEventListener("change", function() {
            var userID = this.value;
            document.getElementById("user_id").value = userID;
        });
    </script>
</body>
</html>