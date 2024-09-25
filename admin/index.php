<?php
// File: admin/index.php

session_start();
require_once 'inc/config.php';


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "admin/login.php");
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "zay-store");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to safely execute queries
function safe_query($conn, $sql) {
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }
    return $result;
}

// Fetch data from the database
$result = safe_query($conn, "SELECT COUNT(*) as order_count FROM products");
$order_count = mysqli_fetch_assoc($result)['order_count'];

$result = safe_query($conn, "SELECT AVG(rating) as avg_rating FROM products");
$avg_rating = number_format(mysqli_fetch_assoc($result)['avg_rating'], 2);

$result = safe_query($conn, "SELECT COUNT(*) as user_count FROM User WHERE role = 'user'");
$user_count = mysqli_fetch_assoc($result)['user_count'];

$result = safe_query($conn, "SELECT COUNT(*) as visitor_count FROM User");
$visitor_count = mysqli_fetch_assoc($result)['visitor_count'];

$result = safe_query($conn, "SELECT COUNT(*) as category_count FROM categories");
$category_count = mysqli_fetch_assoc($result)['category_count'];

$result = safe_query($conn, "SELECT COUNT(*) as product_count FROM products");
$product_count = mysqli_fetch_assoc($result)['product_count'];

// Fetch recent products with images
$result = safe_query($conn, "SELECT * FROM products ORDER BY id DESC LIMIT 5");
$recent_products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch recent messages
$result = safe_query($conn, "SELECT * FROM messages ORDER BY id DESC LIMIT 5");
$recent_messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zay Store | admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo BASE_URL; ?>admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="<?php echo BASE_URL; ?>admin/login.php?logout=1" class="nav-link">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'inc/slider.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $order_count; ?></h3>
                <p>Total Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo BASE_URL; ?>admin/views/manage_products.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $avg_rating; ?><sup style="font-size: 20px">%</sup></h3>
                <p>Average Rating</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo BASE_URL; ?>admin/views/manage_products.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $user_count; ?></h3>
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo BASE_URL; ?>admin/views/manage_user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $visitor_count; ?></h3>
                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo BASE_URL; ?>admin/views/manage_user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Recent Products -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-shopping-cart mr-1"></i>
                  Recent Products
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <?php foreach ($recent_products as $product): ?>
                    <li class="item">
                      <div class="product-img">
                        <?php if (!empty($product['image'])): ?>
                          <img src="<?php echo BASE_URL . 'public/images/products/' . htmlspecialchars($product['image']); ?>" alt="Product Image" class="img-size-50">
                        <?php else: ?>
                          <img src="<?php echo BASE_URL; ?>admin/dist/img/default-150x150.png" alt="Default Product Image" class="img-size-50">
                        <?php endif; ?>
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">
                          <?php echo htmlspecialchars($product['title']); ?>
                          <span class="badge badge-warning float-right">$<?php echo htmlspecialchars($product['price']); ?></span>
                        </a>
                        <span class="product-description">
                          <?php echo htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?>
                        </span>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="<?php echo BASE_URL; ?>admin/views/manage_products.php" class="uppercase">View All Products</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->

          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <!-- Recent Messages -->
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header">
                <h3 class="card-title">Recent Messages</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <?php foreach ($recent_messages as $message): ?>
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left"><?php echo htmlspecialchars($message['name']); ?></span>
                        <span class="direct-chat-timestamp float-right"><?php echo htmlspecialchars($message['created_at'] ?? date('Y-m-d H:i:s')); ?></span>
                      </div>
                      <div class="direct-chat-text">
                        <?php echo htmlspecialchars($message['content']); ?>
                      </div>
                    </div>
                    <!-- /.direct-chat-msg -->
                  <?php endforeach; ?>
                </div>
                <!--/.direct-chat-messages-->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="<?php echo BASE_URL; ?>admin/views/manage_messages.php" class="uppercase">View All Messages</a>
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo BASE_URL; ?>admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo BASE_URL; ?>admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo BASE_URL; ?>admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo BASE_URL; ?>admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo BASE_URL; ?>admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo BASE_URL; ?>admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo BASE_URL; ?>admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo BASE_URL; ?>admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo BASE_URL; ?>admin/plugins/moment/moment.min.js"></script>
<script src="<?php echo BASE_URL; ?>admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo BASE_URL; ?>admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo BASE_URL; ?>admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo BASE_URL; ?>admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_URL; ?>admin/dist/js/adminlte.js"></script>

<script src="<?php echo BASE_URL; ?>admin/dist/js/pages/admin.js"></script>
</body>
</html>