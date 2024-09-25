<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "zay-store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $category_name = $_POST['category_name'];
                $sql = "INSERT INTO categories (name) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $category_name);
                if ($stmt->execute()) {
                    $message = "Category added successfully.";
                } else {
                    $message = "Error adding category: " . $conn->error;
                }
                $stmt->close();
                break;
            case 'edit':
                $category_id = $_POST['category_id'];
                $category_name = $_POST['category_name'];
                $sql = "UPDATE categories SET name = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $category_name, $category_id);
                if ($stmt->execute()) {
                    $message = "Category updated successfully.";
                } else {
                    $message = "Error updating category: " . $conn->error;
                }
                $stmt->close();
                break;
            case 'delete':
                $category_id = $_POST['category_id'];
                $sql = "DELETE FROM categories WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $category_id);
                if ($stmt->execute()) {
                    $message = "Category deleted successfully.";
                } else {
                    $message = "Error deleting category: " . $conn->error;
                }
                $stmt->close();
                break;
        }
    }
}

// Fetch all categories
$sql = "SELECT id, name, image FROM categories";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Category</title>

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
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
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
            <h1>Manage Category</h1>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Category</li>
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
          <h3 class="card-title">Category List</h3>

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
                <th style="width: 10%">ID</th>
                <th style="width: 25%">Name</th>
                <th style="width: 25%">Image</th>
                <th style="width: 20%">Edit</th>
                <th style="width: 20%">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td>
                    <?php if ($row['image']): ?>
                      <img src="../../public/images/categories/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="img-thumbnail" style="max-width: 100px;">
                    <?php else: ?>
                      No image
                    <?php endif; ?>
                  </td>
                  <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?php echo $row['id']; ?>">
                      <i class="fas fa-edit"></i> Edit
                    </button>
                  </td>
                  <td>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="category_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">
                        <i class="fas fa-trash"></i> Delete
                      </button>
                    </form>
                  </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel<?php echo $row['id']; ?>">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="modal-body">
                          <input type="hidden" name="action" value="edit">
                          <input type="hidden" name="category_id" value="<?php echo $row['id']; ?>">
                          <div class="form-group">
                            <label for="edit_category_name<?php echo $row['id']; ?>">Category Name</label>
                            <input type="text" class="form-control" id="edit_category_name<?php echo $row['id']; ?>" name="category_name" value="<?php echo $row['name']; ?>" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
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

  <!-- Footer -->
  <!-- Add your footer code here -->

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
<!-- Footer -->
<?php require_once '../inc/footer.php';?>
<!-- Footer -->