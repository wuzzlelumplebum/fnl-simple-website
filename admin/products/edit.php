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
    $id = $_POST['id'];
    $pname = $_POST['name'];
    $pcode = $_POST['code'];
    $pcategory = $_POST['category'];
    $pprice = $_POST['price'];
    $pquantity = $_POST['quantity'];
    $pstatus = $_POST['status'];
    $filename = $_FILES['file']['name'];
    $tmpname = $_FILES['file']['tmp_name'];

    $newfilename = uniqid() . "-" . $filename;

    move_uploaded_file($tmpname, '../../assets/img/products/' . $newfilename);

    $query = "UPDATE products SET name='$pname', code='$pcode', category_id='$pcategory', price='$pprice', quantity='$pquantity', status_id='$pstatus', image_path='$newfilename' WHERE id = '$id'";
    // $result = mysqli_query($conn, $query);

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Product edited successfully.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Failed to edit product.'); window.location.href = 'edit.php';</script>";
    }
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
    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit Product Details</h3>
            <p class="text-muted">Complete the form below to edit a product details</p>
        </div>
        <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE id = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            // categories sql
            $sql_categories = "SELECT * FROM categories";
            $cat_result = mysqli_query($conn, $sql_categories);

            // status sql
            $sql_status = "SELECT * FROM status";
            $stat_result = mysqli_query($conn, $sql_status);
        ?>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;" enctype="multipart/form-data">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Product Code</label>
                        <input type="text" id="code" class="form-control" name="code" placeholder="Product Code" value="<?php echo $row['code'] ?>" readonly>
                        <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Product Name" value="<?php echo $row['name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Select Product Category</option>
                            <?php
                            while($cat_row = mysqli_fetch_assoc($cat_result)){
                                $selected = ($cat_row['id'] == $row['category_id']) ? "selected" : "";
                                echo '<option value="' . $cat_row['id'] . '" ' . $selected . '>' . $cat_row['category'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Product Price" value="<?php echo $row['price'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Product Quantity" value="<?php echo $row['quantity'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Status: </label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Select Product Status</option>
                            <?php
                            while($stat_row = mysqli_fetch_assoc($stat_result)){
                                $selected = ($stat_row['id'] == $row['status_id']) ? "selected" : "";
                                echo '<option value="' . $stat_row['id'] . '" ' . $selected . '>' . $stat_row['status'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" class="form-control" name="file" required>
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
        $(document).ready(function() {
        $('#category').change(function() {
            var category = $(this).val();
            
            // Set a default code based on the category
            var productCode = '';
            
            switch(category) {
                case '1':
                    productCode = 'TS-' + new Date().getTime();  // Example: using timestamp for uniqueness
                    break;
                case '2':
                    productCode = 'PS-' + new Date().getTime();
                    break;
                case '3':
                    productCode = 'CS-' + new Date().getTime();
                    break;
                default:
                    productCode = '';  // If no category is selected
                }
                
                $('#code').val(productCode);  // Set the product code
            });
        });
    </script>
</body>
</html>