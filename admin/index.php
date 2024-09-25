<?php
// File: admin/index.php

session_start();
require_once 'inc/config.php';

require_once 'inc/slider.php';


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "admin/login.php");
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "drophut");

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
// Assuming the 'products' table exists
$result = safe_query($conn, "SELECT COUNT(*) as product_count FROM products");
$product_count = mysqli_fetch_assoc($result)['product_count'];

// User count by role
$result = safe_query($conn, "SELECT COUNT(*) as user_count FROM users WHERE role = 'user'");
$user_count = mysqli_fetch_assoc($result)['user_count'];

// Total user count (all users)
$result = safe_query($conn, "SELECT COUNT(*) as total_user_count FROM users");
$total_user_count = mysqli_fetch_assoc($result)['total_user_count'];

// Category count from categories table
$result = safe_query($conn, "SELECT COUNT(*) as category_count FROM categories");
$category_count = mysqli_fetch_assoc($result)['category_count'];

// Fetch recent products with images
$result = safe_query($conn, "SELECT * FROM products ORDER BY id DESC LIMIT 5");
$recent_products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch recent blogs instead of messages, since we have a blogs table
$result = safe_query($conn, "SELECT * FROM blogs ORDER BY id DESC LIMIT 5");
$recent_blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>admin/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="<?php echo BASE_URL; ?>admin/login.php?logout=1" class="nav-link">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $product_count; ?></h3>
                <p>Total Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo BASE_URL; ?>admin/views/manage_products.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



          <div class="col-lg-3 col-6">
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

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $total_user_count; ?></h3>
                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo BASE_URL; ?>admin/views/manage_user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Recent Products -->
        <div class="row">
          <section class="col-lg-7 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-shopping-cart mr-1"></i>
                  Recent Products
                </h3>
              </div>
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
        <?php echo isset($product['title']) && !is_null($product['title']) ? htmlspecialchars($product['title']) : 'No Title'; ?>
        <span class="badge badge-warning float-right">$<?php echo isset($product['price']) ? htmlspecialchars($product['price']) : 'N/A'; ?></span>
      </a>
      <span class="product-description">
        <?php echo isset($product['description']) && !is_null($product['description']) ? htmlspecialchars(substr($product['description'], 0, 100)) . '...' : 'No description available'; ?>
      </span>
    </div>
  </li>
<?php endforeach; ?>

                </ul>
              </div>
              <div class="card-footer text-center">
                <a href="<?php echo BASE_URL; ?>admin/views/manage_products.php" class="uppercase">View All Products</a>
              </div>
            </div>
          </section>

          <!-- Recent Blogs -->
          <section class="col-lg-5 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-blog mr-1"></i>
                  Recent Blogs
                </h3>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <?php foreach ($recent_blogs as $blog): ?>
                    <li class="list-group-item">
                      <strong><?php echo htmlspecialchars($blog['title']); ?></strong><br>
                      <span><?php echo htmlspecialchars(substr($blog['content'], 0, 100)) . '...'; ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <div class="card-footer text-center">
                <a href="<?php echo BASE_URL; ?>admin/views/manage_blogs.php" class="uppercase">View All Blogs</a>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 Drophut Store.</strong>
    All rights reserved.
  </footer>
</div>

<!-- Scripts -->
<script src="<?php echo BASE_URL; ?>admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo BASE_URL; ?>admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>admin/dist/js/adminlte.js"></script>
</body>
</html>
