<?php
session_start(); // Required for session messages

$connection = mysqli_connect("localhost", "root", "", "event_db");

if (isset($_POST['delete_image'])) {
    $image_id = mysqli_real_escape_string($connection, $_POST['image_id']);
    $image_name = mysqli_real_escape_string($connection, $_POST['image_name']);

    $file_path = "uploads/" . $image_name;

    // Delete the image file if it exists
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Delete the database entry
    $query = "DELETE FROM images WHERE id = '$image_id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $_SESSION['success'] = "Image deleted successfully!";
    } else {
        $_SESSION['status'] = "Failed to delete image from database.";
    }

    header("Location: adminupload.php");
    exit();
} else {
    $_SESSION['status'] = "Invalid request.";
    header("Location: adminupload.php");
    exit();
}
?>
