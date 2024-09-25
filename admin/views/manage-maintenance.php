<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "zay-store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maintenance_mode = isset($_POST['maintenance_mode']) ? 1 : 0;

    $sql = "UPDATE settings SET maintenance_mode = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $maintenance_mode);

    if ($stmt->execute()) {
        $message = "Maintenance mode updated successfully.";
    } else {
        $message = "Error updating maintenance mode: " . $conn->error;
    }
    $stmt->close();
}

// Fetch current maintenance mode status
$sql = "SELECT maintenance_mode FROM settings WHERE id = 1";
$result = $conn->query($sql);
$settings = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Maintenance Mode</title>

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
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .maintenance-status {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .maintenance-description {
            margin-bottom: 30px;
        }
        .submit-button {
            margin-top: 20px;
        }
        .switch-container {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            margin-right: 15px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #007bff;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        .switch-label {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php require_once('../inc/nav.php')?>
  <!-- /.navbar -->

  <!-- Sidebar -->
  <?php require_once('../inc/slider.php')?>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Maintenance Mode</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Maintenance Mode</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Maintenance Mode Settings</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
          <?php endif; ?>
          
          <div class="maintenance-status">
            Current Status: 
            <?php if ($settings['maintenance_mode']): ?>
              <span class="text-danger">Maintenance Mode is ON</span>
            <?php else: ?>
              <span class="text-success">Maintenance Mode is OFF</span>
            <?php endif; ?>
          </div>

          <div class="maintenance-description">
            <p>When maintenance mode is enabled, your website will display a maintenance page to all visitors. Only administrators will be able to access the site normally.</p>
            <p>Use this feature when you need to perform updates or make changes to your website without interrupting the user experience.</p>
          </div>

          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox" id="maintenance_mode" name="maintenance_mode" <?php echo $settings['maintenance_mode'] ? 'checked' : ''; ?>>
                    <span class="slider"></span>
                </label>
                <span class="switch-label">Maintenance Mode</span>
            </div>
            <div class="submit-button">
              <button type="submit" class="btn btn-primary btn-lg">Update Maintenance Mode</button>
            </div>
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