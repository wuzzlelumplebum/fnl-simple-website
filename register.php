<?php
require 'config.php';

if(isset($_POST['signUp'])){
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Set the default role
    $default_role = '3';  // This will be stored in the database

    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmail);

    if($result->num_rows>0){
        echo 
        "
        <script>
            alert('Email Already Registered!');
            window.location.href = 'login.php';
        </script>
        ";
    }
    else{
        // session_start();
        $addUser = "INSERT INTO users (first_name, last_name, email, password, role_id) VALUES ('$firstName','$lastName','$email','$password','$default_role')";

        if($conn->query($addUser) == TRUE){
            echo 
            "
            <script>
                alert('Signed Up Successfully');
                window.location.href = 'login.php';
            </script>
            ";
        }
        else{
            echo "Error: ".$conn->error;
        }
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
    <div class="container" id="signup">
        <h1 class="form-title">Sign Up</h1>
        <form action="register.php" method="post">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fname" id="fname" placeholder="First Name" required>
                <label for="fname">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                <label for="lname">Last Name</label>
            </div>
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
            <div class="input-group">
                <input type="hidden" name="role" value="3">
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
            <p class="or">
                or
            </p>
            <div class="links">
                <p>Already Have Account? <a href="login.php">Sign In</a></p>
            </div>
        </form>
    </div>
</body>
</html>