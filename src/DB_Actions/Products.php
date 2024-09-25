<?php
// Product.php
class Product {
    private $conn;
    private $table_name = "products";

    // Product properties
    public $id;
    public $name;
    public $subtitle; // Add the subtitle property
    public $description;
    public $price;
    public $price_after_sale;
    public $image;
    public $rating;
    public $review;
    public $styles;
    public $properties;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Create Product
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
            SET name = ?, subtitle = ?, description = ?, price = ?, price_after_sale = ?, image = ?, rating = ?, review = ?, styles = ?, properties = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssisiisss", $this->name, $this->subtitle, $this->description, $this->price, $this->price_after_sale, $this->image, $this->rating, $this->review, $this->styles, $this->properties);
        return $stmt->execute();
    }

    // Read Single Product
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '$id'";
        return mysqli_query($this->conn,$query);
    }

    // Read all Products
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        return mysqli_query($this->conn, $query);
    }

    // Update Product
    public function update() {
        $query = "UPDATE " . $this->table_name . "
            SET name = ?, subtitle = ?, description = ?, price = ?, price_after_sale = ?, image = ?, rating = ?, review = ?, styles = ?, properties = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssisiisssi", $this->name, $this->subtitle, $this->description, $this->price, $this->price_after_sale, $this->image, $this->rating, $this->review, $this->styles, $this->properties, $this->id);
        return $stmt->execute();
    }

    // Delete Product
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}
?>
