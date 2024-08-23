<?php
include "config.php";

if(isset($_POST['submit'])){
  $user_id = $_POST['user_id'];
  $review = $_POST['review'];

  $query = "INSERT INTO reviews (review, user_id) VALUES ('$review','$user_id')";
  $result = mysqli_query($conn, $query);

  if($result){
      echo "<script>alert('Review added successfully.'); window.location.href = 'index.php';</script>";
  } else {
      echo "<script>alert('Failed to add review.'); window.location.href = 'review.php';</script>";
  }
}
?>