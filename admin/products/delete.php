<?php
include '../../config.php';

if($_GET['id']){
    $product_id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $sql);
    
    if($result){
        echo "<script>alert('Product deleted successfully.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Failed to delete product.'); window.location.href = 'index.php';</script>";
    }
}
?>