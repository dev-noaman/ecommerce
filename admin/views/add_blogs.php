<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "drophut");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Define base URL to construct image paths
$BASE_URL = "http://localhost/ecommerce";

// Handle form submission for adding a new blog
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $author_name = isset($_POST['author_name']) ? $_POST['author_name'] : '';
    $created_at = date('Y-m-d H:i:s');
    $image = "";

    // Validate form fields
    if (empty($title) || empty($content) || empty($author_name)) {
        $message = "All fields are required.";
    } else {
        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
            $target_dir = realpath("../../public/images/blogs/") . '/'; // Get absolute path to /public/images/blogs
            echo "Resolved Path: " . $target_dir; // Debugging output

            // Ensure the directory exists
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); // Create the blogs directory if it doesn't exist
                echo "Directory created: " . $target_dir;
            } else {
                echo "Directory exists: " . $target_dir;
            }

            // Get the original file extension
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

            // Generate a unique name for the file
            $image = uniqid() . '.' . $file_extension; // Generate unique name with extension
            $target_file = $target_dir . $image; // Full path for the file

            // Move the uploaded file
            if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $message = "Image uploaded successfully.";
                    echo "File saved to: " . $target_file; // Debugging output
                } else {
                    $message = "Failed to move uploaded file.";
                    echo "Error: Could not save the file to " . $target_file; // Debugging output
                }
            } else {
                $message = "Failed to upload image.";
                echo "Error: File was not uploaded properly."; // Debugging output
            }
        }

        // Insert new blog into the database
        $sql = "INSERT INTO blogs (title, content, author_name, created_at, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $title, $content, $author_name, $created_at, $image); // Store image name in database

        if ($stmt->execute()) {
            $message = "Blog added successfully.";
        } else {
            $message = "Failed to add blog.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Blog</title>

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
            <h1>Add Blog</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Blog</li>
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
          <h3 class="card-title">New Blog</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
          <?php endif; ?>

          <!-- Form for adding a new blog -->
          <form action="add_blogs.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">Blog Title</label>
              <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea name="content" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
              <label for="author_name">Author Name</label>
              <input type="text" name="author_name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" name="image" class="form-control-file" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add Blog</button>
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

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
