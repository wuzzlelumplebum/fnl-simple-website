<?php
include '../../config.php';

if(isset($_GET['id'])){
    $shared_message_id = $_GET['id'];

    // First, find the corresponding message_id from shared_messages table
    $find_message_id_query = "SELECT message_id FROM shared_messages WHERE id = '$shared_message_id'";
    $find_message_id_result = mysqli_query($conn, $find_message_id_query);

    if ($find_message_id_result && mysqli_num_rows($find_message_id_result) > 0) {
        $row = mysqli_fetch_assoc($find_message_id_result);
        $message_id = $row['message_id'];

        // Delete the message from the messages table
        $delete_message_query = "DELETE FROM messages WHERE id = '$message_id'";
        $delete_message_result = mysqli_query($conn, $delete_message_query);

        // Update the message_id in the shared_messages table to 0 for every user
        $update_shared_message_query = "UPDATE shared_messages SET message_id = 0 WHERE message_id = '$message_id'";
        $update_shared_message_result = mysqli_query($conn, $update_shared_message_query);

        if($delete_message_result && $update_shared_message_result){
            echo "<script>alert('Message deleted successfully.'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Failed to delete message.'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Message not found.'); window.location.href = 'index.php';</script>";
    }
}
?>