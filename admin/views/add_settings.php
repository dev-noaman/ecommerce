<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "drophut");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


require_once '../inc/nav.php';
require_once '../inc/slider.php';


$message = "";

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $facebook = $_POST['facebook'];
        $twitter = $_POST['twitter'];
        $instagram = $_POST['instagram'];
        $linkedin = $_POST['linkedin'];

        $sql = "INSERT INTO settings (address, phone, email, facebook, twitter, instagram, linkedin) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $address, $phone, $email, $facebook, $twitter, $instagram, $linkedin);
        
        if ($stmt->execute()) {
            $message = "Settings added successfully.";
        } else {
            $message = "Error adding settings: " . $conn->error;
        }
        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Sitelinks</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Custom styles -->
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Sitelinks</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
          <?php endif; ?>

          <form action="add_settings.php" method="POST">
            <input type="hidden" name="action" value="add">

            <div class="form-group">
              <label for="address">Address</label>
              <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="form-group">
              <label for="facebook">Facebook</label>
              <input type="url" class="form-control" id="facebook" name="facebook">
            </div>
            
            <div class="form-group">
              <label for="twitter">Twitter</label>
              <input type="url" class="form-control" id="twitter" name="twitter">
            </div>
            
            <div class="form-group">
              <label for="instagram">Instagram</label>
              <input type="url" class="form-control" id="instagram" name="instagram">
            </div>
            
            <div class="form-group">
              <label for="linkedin">LinkedIn</label>
              <input type="url" class="form-control" id="linkedin" name="linkedin">
            </div>

            <button type="submit" class="btn btn-primary">Add Settings</button>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
  <?php require_once '../inc/footer.php';?>
  <!-- /.footer -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
