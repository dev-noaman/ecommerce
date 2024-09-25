<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "drophut");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$edit_user = null;

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        $message = "User has been deleted successfully.";
    } else {
        $message = "Error deleting user: " . $conn->error;
    }
    $stmt->close();
}

// Handle edit request (loading user data for editing)
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $edit_user = $result->fetch_assoc();
    }
    $stmt->close();
}

// Handle update request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $id = $_POST['update_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $permissions = $_POST['permissions'];
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    $sql = "UPDATE users SET username=?, email=?, role=?, permissions=?, is_active=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $username, $email, $role, $permissions, $is_active, $id);

    if ($stmt->execute()) {
        $message = "User has been updated successfully.";
        $edit_user = null; // Reset edit mode after successful update
    } else {
        $message = "Error updating user: " . $conn->error;
    }
    $stmt->close();
}

// Fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Users</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

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

  <!-- Main Sidebar Container -->
  <?php require_once('../inc/slider.php')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Manage Users</h3>
        </div>
        <div class="card-body">
          <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
          <?php endif; ?>

          <?php if ($edit_user): ?>
            <!-- Edit User Form -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="update_id" value="<?php echo $edit_user['id']; ?>">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?php echo $edit_user['username']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?php echo $edit_user['email']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="form-control" id="role" name="role" required>
                    <option value="user" <?php echo $edit_user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                    <option value="admin" <?php echo $edit_user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="permissions">Permissions</label>
                  <textarea class="form-control" id="permissions" name="permissions"><?php echo $edit_user['permissions']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="is_active">Active</label>
                  <input type="checkbox" id="is_active" name="is_active" <?php echo $edit_user['is_active'] ? 'checked' : ''; ?>>
                </div>
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
          <?php endif; ?>

          <table class="table table-bordered mt-4">
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Permissions</th>
                <th>Active</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['permissions']; ?></td>
                    <td><?php echo $row['is_active'] ? 'Yes' : 'No'; ?></td>
                    <td>
                      <a href="manage_user.php?edit_id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                      <a href="manage_user.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7">No users found</td>
                </tr>
              <?php endif; ?>
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
  <?php require_once('../inc/footer.php')?>
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
