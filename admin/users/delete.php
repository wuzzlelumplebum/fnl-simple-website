<?php
include '../../config.php';

if($_GET['id']){
    $user_id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    
    if($result){
        echo "<script>alert('User deleted successfully.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Failed to delete user.'); window.location.href = 'index.php';</script>";
    }
}
?>