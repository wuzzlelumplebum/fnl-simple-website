<?php
include '../../config.php';

if($_GET['id']){
    $review_id = $_GET['id'];
    $sql = "DELETE FROM reviews WHERE id = '$review_id'";
    $result = mysqli_query($conn, $sql);
    
    if($result){
        echo "<script>alert('Review deleted successfully.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Failed to delete review.'); window.location.href = 'index.php';</script>";
    }
}
?>