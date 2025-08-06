<?php
$connection = mysqli_connect("localhost", "root", "", "event_db");

if (isset($_POST['saveimage'])) {
    $eventname = $_POST['eventname'];
    $file_names = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];

    foreach ($file_names as $key => $val) {
        $filename = basename($file_names[$key]);
        $target_file = "uploads/" . $filename;

        if (move_uploaded_file($file_tmp[$key], $target_file)) {
            // Insert into images table
            $query = "INSERT INTO images (eventname, image) VALUES ('$eventname', '$filename')";
            mysqli_query($connection, $query);
        }
    }

    $_SESSION['success'] = "Images uploaded successfully!";
    header("Location: adminupload.php");
    exit();
} else {
    $_SESSION['status'] = "Something went wrong!";
    header("Location: adminupload.php");
    exit();
}
?>
