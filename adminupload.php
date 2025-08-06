<?php session_start(); ?>
<?php if (isset($_SESSION['success'])): ?>
  <div class="alert alert-success text-center">
    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
  </div>
<?php endif; ?>
<?php if (isset($_SESSION['status'])): ?>
  <div class="alert alert-danger text-center">
    <?= $_SESSION['status']; unset($_SESSION['status']); ?>
  </div>
<?php endif; ?>

<?php 
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'event_db');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Image Gallery</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .formdesign {
      width: 50%;
      margin: auto;
      padding: 20px 15px;
    }
    .card-img-top {
      height: 250px;
      object-fit: cover;
    }
  </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">IOPE Gallery</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" href="../home.php">Home</a>
        <a class="nav-link" href="../event new/users.php">Explore Our Events</a>
      </div>
    </div>
  </div>
</nav>

<!-- Upload Form -->
<div class="formdesign">
  <form action="insertimage.php" method="POST" enctype="multipart/form-data">
    <div class="modal-body">
      <div class="form-group mb-3">
        <label>Event Name</label>
        <input type="text" name="eventname" class="form-control" placeholder="Enter Event Name" required>
      </div>
      <div class="form-group mb-3">
        <label>Upload Image</label>
        <input type="file" name="image[]" multiple class="form-control" required>
      </div>
    </div>
    <div class="modal-footer">
      <input type="submit" name="saveimage" class="btn btn-primary" value="Upload">
    </div>
  </form>
</div>

<!-- Image Display Section -->
<div class="container mt-5">
  <div class="row g-4">
    <?php
    $query = "SELECT * FROM images ORDER BY id DESC LIMIT 3";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
      while ($fetch = mysqli_fetch_assoc($query_run)) {
    ?>
        <div class="col-md-4">
          <div class="card h-100">
            <img src="uploads/<?php echo $fetch['image']; ?>" class="card-img-top" alt="Event Image" 
                 onerror="this.onerror=null;this.src='images/default.jpg';">
            <div class="card-body text-center">
              <h5 class="card-title"><?php echo htmlspecialchars($fetch['eventname']); ?></h5>
              <form action="deleteimage.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                <input type="hidden" name="image_id" value="<?php echo $fetch['id']; ?>">
                <input type="hidden" name="image_name" value="<?php echo $fetch['image']; ?>">
                <button type="submit" name="delete_image" class="btn btn-danger mt-2">Delete</button>
              </form>
            </div>
          </div>
        </div>
    <?php
      }
    } else {
      echo "<div class='text-center mt-4'>No images found.</div>";
    }
    ?>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.n
