<?php
session_start();

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'event_db');

if (isset($_POST['saveevent'])) {

    $name = mysqli_real_escape_string($connection, $_POST['event_name']);
    $date = mysqli_real_escape_string($connection, $_POST['event_date']);
    $category = mysqli_real_escape_string($connection, $_POST['event_category']);
    $department = mysqli_real_escape_string($connection, $_POST['department']);
    $description = mysqli_real_escape_string($connection, $_POST['event_desc']);
    $image_name = $_FILES["event_image"]["name"];
    $image_tmp = $_FILES["event_image"]["tmp_name"];
    $upload_path = "uploads/" . $image_name;

    if (file_exists($upload_path)) {
        $_SESSION['status'] = "Image already exists: " . $image_name;
        header('Location: events.php');
        exit();
    } else {
        $query = "INSERT INTO events (`category`, `event_name`, `department`, `event_desc`, `event_image`, `event_date`) 
                  VALUES ('$category', '$name', '$department', '$description', '$image_name', '$date')";
        
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($image_tmp, $upload_path);
            $_SESSION['success'] = "Event Added Successfully!";
        } else {
            $_SESSION['status'] = "Event Not Added. DB Error.";
        }
        header('Location: events.php');
        exit();
    }
}
?>
