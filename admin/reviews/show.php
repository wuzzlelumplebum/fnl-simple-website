<?php
require ('../../config.php');

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

$id = $_GET['id'];
$sql = "SELECT r.id AS review_id, r.review, r.user_id, u.id, u.first_name, u.last_name, u.email
        FROM reviews r
        INNER JOIN users u ON r.user_id = u.id WHERE r.id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
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
                </ul>
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
    <div class="container d-flex justify-content-center">
        <div class="row">
            <h2 style="margin-top: 15px; text-align: center;">Customer Review Details</h2>
            <dl class="row">
                <dt class="col-sm-3">Review ID</dt>
                <dd class="col-sm-9"><?php echo $row['review_id']; ?></dd>
                <dt class="col-sm-3">Customer First Name</dt>
                <dd class="col-sm-9"><?php echo $row['first_name']; ?></dd>
                <dt class="col-sm-3">Customer Last Name</dt>
                <dd class="col-sm-9"><?php echo $row['last_name']; ?></dd>
                <dt class="col-sm-3">Customer Email</dt>
                <dd class="col-sm-9"><?php echo $row['email']; ?></dd>
                <dt class="col-sm-3">Customer Review</dt>
                <dd class="col-sm-9"><?php echo $row['review']; ?></dd>
            </dl>
            <div class="col-6">
                <div class="mb-3">
                    <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-success" style="margin-top: 10px">Edit</a>
                    <a href="index.php" class="btn btn-danger" style="margin-top: 10px">Back</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>