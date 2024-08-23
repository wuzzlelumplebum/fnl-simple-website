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
$sql = "SELECT p.id, p.code, p.name, p.price, p.quantity, p.image_path, c.category, s.status 
FROM products p
INNER JOIN categories c ON p.category_id = c.id
INNER JOIN status s ON p.status_id = s.id WHERE p.id = '$id'";
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
        <!-- <a href="create.php" class="btn btn-success mb-3">Add Product</a> -->
        <div class="row ">
            <div class="col-6">
                <img src="../../assets/img/products/<?php echo $row['image_path']; ?>" alt="" width="100%">
            </div>
            <div class="col-6">
                <h2><?php echo $row['name']; ?></h1> <br>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold; font-size: 25px;">Product Code</label>
                    <p><?php echo $row['code']; ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold; font-size: 25px;">Product Category</label>
                    <p><?php echo $row['category']; ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold; font-size: 25px;">Product Price</label>
                    <p>RM <?php echo $row['price']; ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold; font-size: 25px;">Product Quantity</label>
                    <p><?php echo $row['quantity']; ?> pcs</p>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold; font-size: 25px;">Product Status: </label>
                    <p><?php echo $row['status']; ?></p>
                </div>
                <div class="mb-3">
                    <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-success" style="margin-top: 10px">Edit</a>
                    <a href="index.php" class="btn btn-danger" style="margin-top: 10px">Back</a>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align: center; padding: 15%;">
        <p style="font-size: 50px; font-weight: bold;">Welcome to Admin Page</p>
        <p style="font-size: 50px; font-weight: bold;" id="greet"></p>
        <a href="../logout.php">Log Out</a>
    </div>
</body>
</html>