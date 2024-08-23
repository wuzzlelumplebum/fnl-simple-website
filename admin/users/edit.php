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
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', password='$password', role_id='$role' WHERE id = '$id'";
    // $result = mysqli_query($conn, $query);

    if(mysqli_query($conn, $query)){
        echo "<script>alert('User edited successfully.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Failed to edit user.'); window.location.href = 'edit.php';</script>";
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
            <h3>Edit User Details</h3>
            <p class="text-muted">Complete the form below to edit a user details</p>
        </div>
        <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE id = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            // roles sql
            $sql_roles = "SELECT * FROM roles";
            $role_result = mysqli_query($conn, $sql_roles);
        ?>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;" enctype="multipart/form-data">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">User First Name</label>
                        <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                        <input type="text" class="form-control" name="first_name" placeholder="User First Name" value="<?php echo $row['first_name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">User Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="User Last Name" value="<?php echo $row['last_name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">User Email</label>
                        <input type="text" class="form-control" name="email" placeholder="User Email" value="<?php echo $row['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">User Role</label>
                        <select class="form-control" name="role" required>
                            <option value="">Select User Role</option>
                            <?php
                            while($role_row = mysqli_fetch_assoc($role_result)){
                                $selected = ($role_row['id'] == $row['role_id']) ? "selected" : "";
                                echo '<option value="' . $role_row['id'] . '" ' . $selected . '>' . $role_row['role'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">User Password</label>
                        <input type="password" class="form-control" name="password" placeholder="User Password" value="<?php echo $row['password'] ?>">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>