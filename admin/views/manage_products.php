<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "drophut");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Function to fetch all products
function getAllProducts($conn) {
    $sql = "SELECT * FROM products ORDER BY id ASC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to delete a product
function deleteProduct($conn, $id) {
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Function to update a product
function updateProduct($conn, $id, $name, $subtitle, $price, $price_after_sale, $rating, $description, $review, $styles, $properties) {
    $sql = "UPDATE products 
            SET name = ?, subtitle = ?, price = ?, price_after_sale = ?, rating = ?, description = ?, review = ?, styles = ?, properties = ?  
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiidsssii", $name, $subtitle, $price, $price_after_sale, $rating, $description, $review, $styles, $properties, $id);
    return $stmt->execute();
}


// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'delete' && isset($_POST['id'])) {
            $id = $_POST['id'];
            if (deleteProduct($conn, $id)) {
                $message = "Product deleted successfully.";
            } else {
                $message = "Error deleting product.";
            }
        } elseif ($_POST['action'] == 'edit' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $subtitle = $_POST['subtitle'];
            $price = $_POST['price'];
            $price_after_sale = $_POST['price_after_sale'];
            $rating = $_POST['rating'];
            $description = $_POST['description'];
            $review = $_POST['review'];
            $styles = $_POST['styles'];
            $properties = $_POST['properties'];
            
            if (updateProduct($conn, $id, $name, $subtitle, $price, $price_after_sale, $rating, $description, $review, $styles, $properties)) {
                $message = "Product updated successfully.";
            } else {
                $message = "Error updating product.";
            }
        }
    }
}

// Fetch all products
$products = getAllProducts($conn);

// Fetch categories for dropdown
$categories = [];
$category_query = "SELECT id, name FROM categories";
$result = $conn->query($category_query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Products</title>

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
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .table th {
            background-color: #f8f9fa;
            text-align: center;
        }
        .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-action {
            width: 100%;
            margin-bottom: 5px;
        }
        .product-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: contain;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
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
                        <h1>Manage Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Manage Products</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Products List</h3>

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
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-info"><?php echo $message; ?></div>
                    <?php endif; ?>
                    
                    <!-- Products Table -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Subtitle</th>
                                <th>Price</th>
                                <th>Price After Sale</th>
                                <th>Rating</th>
                                <th>Description</th>
                                <th>Review</th>
                                <th>Image</th>
                                <th>Styles</th>
                                <th>Properties</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo $product['id']; ?></td>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td><?php echo htmlspecialchars($product['subtitle']); ?></td>
                                    <td><?php echo $product['price']; ?></td>
                                    <td><?php echo $product['price_after_sale'] ?? 'N/A'; ?></td>
                                    <td><?php echo $product['rating']; ?></td>
                                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                                    <td><?php echo htmlspecialchars($product['review']); ?></td>
                                    <td><img src="../../public/images/products/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" class="product-image"></td>
                                    <td><?php echo htmlspecialchars($product['styles']); ?></td>
                                    <td><?php echo htmlspecialchars($product['properties']); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary btn-action edit-product" 
                                            data-id="<?php echo $product['id']; ?>"
                                            data-name="<?php echo htmlspecialchars($product['name']); ?>"
                                            data-subtitle="<?php echo htmlspecialchars($product['subtitle']); ?>"
                                            data-price="<?php echo $product['price']; ?>"
                                            data-price-after-sale="<?php echo $product['price_after_sale'] ?? ''; ?>"
                                            data-rating="<?php echo $product['rating']; ?>"
                                            data-description="<?php echo htmlspecialchars($product['description']); ?>"
                                            data-review="<?php echo htmlspecialchars($product['review']); ?>"
                                            data-styles="<?php echo htmlspecialchars($product['styles']); ?>"
                                            data-properties="<?php echo htmlspecialchars($product['properties']); ?>">
                                            Edit
                                        </button>
                                    </td>
                                    <td>
                                        <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger btn-action">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" id="edit_product_id" name="id">
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_subtitle">Subtitle</label>
                        <input type="text" class="form-control" id="edit_subtitle" name="subtitle" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_price">Price</label>
                        <input type="number" step="0.01" class="form-control" id="edit_price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_price_after_sale">Price After Sale</label>
                        <input type="number" step="0.01" class="form-control" id="edit_price_after_sale" name="price_after_sale">
                    </div>
                    <div class="form-group">
                        <label for="edit_rating">Rating</label>
                        <input type="number" step="0.1" min="0" max="5" class="form-control" id="edit_rating" name="rating" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_review">Review</label>
                        <input type="number" step="1" min="0" class="form-control" id="edit_review" name="review" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_styles">Styles</label>
                        <input type="text" class="form-control" id="edit_styles" name="styles" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_properties">Properties</label>
                        <input type="text" class="form-control" id="edit_properties" name="properties" required>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function() {
    // When an "Edit" button is clicked
    $('.edit-product').on('click', function() {
        // Fetch product data from the clicked button's data attributes
        var id = $(this).data('id');
        var name = $(this).data('name');
        var subtitle = $(this).data('subtitle');
        var price = $(this).data('price');
        var priceAfterSale = $(this).data('price-after-sale');
        var rating = $(this).data('rating');
        var description = $(this).data('description');
        var review = $(this).data('review');
        var styles = $(this).data('styles');
        var properties = $(this).data('properties');
        
        // Set the modal input fields with the product data
        $('#edit_product_id').val(id);
        $('#edit_name').val(name);
        $('#edit_subtitle').val(subtitle);
        $('#edit_price').val(price);
        $('#edit_price_after_sale').val(priceAfterSale);
        $('#edit_rating').val(rating);
        $('#edit_description').val(description);
        $('#edit_review').val(review);
        $('#edit_styles').val(styles);
        $('#edit_properties').val(properties);

        // Show the modal
        $('#editProductModal').modal('show');
    });
});
</script>
</body>
</html>
