<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "drophut");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Function to add a new product
function addProduct($conn, $name, $subtitle, $price, $price_after_sale, $rating, $description, $review, $styles, $properties, $image) {
    $sql = "INSERT INTO products (name, subtitle, price, price_after_sale, rating, description, review, styles, properties, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiidsssss", $name, $subtitle, $price, $price_after_sale, $rating, $description, $review, $styles, $properties, $image);
    return $stmt->execute();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $subtitle = $_POST['subtitle'];
    $price = $_POST['price'];
    $price_after_sale = $_POST['price_after_sale'];
    $rating = $_POST['rating'];
    $description = $_POST['description'];
    $review = $_POST['review'];
    $styles = $_POST['styles'];
    $properties = $_POST['properties'];

    // Image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_folder = "../../public/images/products/" . $image;
        
        // Move the uploaded file to the destination folder
        if (move_uploaded_file($image_tmp, $image_folder)) {
            if (addProduct($conn, $name, $subtitle, $price, $price_after_sale, $rating, $description, $review, $styles, $properties, $image)) {
                $message = "Product added successfully.";
            } else {
                $message = "Error adding product.";
            }
        } else {
            $message = "Error uploading image.";
        }
    } else {
        $message = "Image file is required.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Product</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-info"><?php echo $message; ?></div>
                    <?php endif; ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="price_after_sale">Price After Sale</label>
                            <input type="number" step="0.01" class="form-control" id="price_after_sale" name="price_after_sale">
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <input type="number" step="0.1" min="0" max="5" class="form-control" id="rating" name="rating" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="review">Review</label>
                            <input type="number" step="1" min="0" class="form-control" id="review" name="review" required>
                        </div>
                        <div class="form-group">
                            <label for="styles">Styles</label>
                            <input type="text" class="form-control" id="styles" name="styles" required>
                        </div>
                        <div class="form-group">
                            <label for="properties">Properties</label>
                            <input type="text" class="form-control" id="properties" name="properties" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Product Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php require_once('../inc/footer.php')?>
</div>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

</body>
</html>
