<?php
require 'config.php';

if(isset($_POST['signIn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){
        if($password == $row['password']){
            $_SESSION['signIn'] = true;
            $_SESSION['id'] = $row['id'];

            if($row['role_id'] == 1){
                echo 
                "
                <script>
                    alert('Successfully Signed In');
                    window.location.href = 'admin/index.php';
                </script>
                ";
            } else if($row['role_id'] == 2){
                echo 
                "
                <script>
                    alert('Successfully Signed In');
                    window.location.href = 'index.php';
                </script>
                ";
            } else if($row['role_id'] == 3){
                echo 
                "
                <script>
                    alert('Successfully Signed In');
                    window.location.href = 'index.php';
                </script>
                ";
            }
        } else {
            echo 
            "
            <script>
                alert('User Credentials Wrong');
                window.location.href = 'login.php';
            </script>
            ";
        }
    } else {
        echo 
        "
        <script>
            alert('User not Registered');
            window.location.href = 'login.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>F&L Boutique Store</title>
</head>
<body>
    <div class="container" id="signin">
        <h1 class="form-title">Sign In</h1>
        <form action="login.php" method="post">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="email">Password</label>
            </div>
            <!-- <input type="checkbox" onclick="myFunction()">Show Password -->
            <input type="submit" class="btn" value="Sign In" name="signIn">
            <p class="or">
                or
            </p>
        </form>
        <div class="links">
            <p>Don't Have Account yet? <a href="register.php">Sign Up</a></p>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>