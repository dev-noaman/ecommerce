<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "drophut");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Define base URL to construct image paths
$BASE_URL = "http://localhost/ecommerce";

// Handle form submissions for blog actions (if any)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        // Handle delete action
        if ($_POST['action'] == 'delete_blog') {
            $blogId = $_POST['blog_id'];
            $sql = "DELETE FROM blogs WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $blogId);

            if ($stmt->execute()) {
                $message = "Blog deleted successfully.";
            } else {
                $message = "Failed to delete blog.";
            }
        }
        
        // Handle fetch blog details action
        if ($_POST['action'] == 'fetch_blog') {
            $blogId = $_POST['blog_id'];
            $sql = "SELECT * FROM blogs WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $blogId);
            $stmt->execute();
            $result = $stmt->get_result();
            $blog = $result->fetch_assoc();
            
            if ($blog) {
                echo "<h5>" . htmlspecialchars($blog['title']) . "</h5>";
                echo "<p><strong>Author:</strong> " . htmlspecialchars($blog['author_name']) . "</p>";
                echo "<p><strong>Content:</strong><br>" . nl2br(htmlspecialchars($blog['content'])) . "</p>";
                echo "<p><strong>Created At:</strong> " . date('Y-m-d H:i:s', strtotime($blog['created_at'])) . "</p>";
                if ($blog['image']) {
                    echo "<p><strong>Image:</strong><br><img src='" . $BASE_URL . "/public/images/blogs/" . htmlspecialchars($blog['image']) . "' alt='Blog Image' style='width: 100%;'></p>";
                }
            } else {
                echo "Blog not found.";
            }
            exit; // Stop further script execution as this is an AJAX response
        }
    }
}

// Fetch all blogs
$sql = "SELECT b.id, b.title, b.author_name, b.created_at, b.image
        FROM blogs b
        ORDER BY b.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Blogs</title>

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
        .table th {
            background-color: #f8f9fa;
        }
        .table td, .table th {
            text-align: center;
            vertical-align: middle;
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
            <h1>Manage Blogs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Blogs</li>
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
          <h3 class="card-title">Blog List</h3>

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
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Created At</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['author_name']; ?></td>
                  <td><?php echo date('Y-m-d H:i:s', strtotime($row['created_at'])); ?></td>
                  <td>
                    <?php if ($row['image']): ?>
                      <img src="<?php echo $BASE_URL; ?>/public/images/blogs/<?php echo $row['image']; ?>" alt="Blog Image" style="width: 50px; height: 50px;">
                    <?php else: ?>
                      No image
                    <?php endif; ?>
                  </td>
                  <td>
                    <form method="POST" style="display: inline-block;">
                      <input type="hidden" name="action" value="delete_blog">
                      <input type="hidden" name="blog_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#blogModal" onclick="showBlogDetails(<?php echo $row['id']; ?>)">Details</button>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal -->
  <div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="blogModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="blogModalLabel">Blog Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal-body">
          <!-- Blog details will be loaded here via AJAX -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

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
<script>
function showBlogDetails(blogId) {
  $.ajax({
    url: '', // Point to the current file
    method: 'POST', // Use POST for form submission
    data: { action: 'fetch_blog', blog_id: blogId },
    success: function(response) {
      $('#modal-body').html(response); // Load the response (blog details) into the modal body
    }
  });
}
</script>
</body>
</html>
