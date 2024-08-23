<?php
include '../../config.php';

if($_GET['id']){
    $news_id = $_GET['id'];
    $sql = "DELETE FROM news WHERE id = '$news_id'";
    $result = mysqli_query($conn, $sql);
    
    if($result){
        echo "<script>alert('News deleted successfully.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Failed to delete news.'); window.location.href = 'index.php';</script>";
    }
}
?>