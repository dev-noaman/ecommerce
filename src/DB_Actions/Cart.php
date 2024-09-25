<?php
class Cart {

    private $table_name = "cart"; // Table name for the cart items

    // Cart properties
    public $id;
    public $product;
    public $price;
    public $image;
    public $user_id;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db; // Assuming $db is a database connection object
    }

    // Create Cart Item
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (products, price, image, user_id) 
                  VALUES ('$this->product', '$this->price',  '$this->image', '$this->user_id')";
        return mysqli_query($this->conn, $query);
    }

    // Read Single Cart Item
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '$id'";
        return mysqli_query($this->conn, $query);
    }

    // Read All Cart Items for a User
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        return mysqli_query($this->conn, $query);
    }

    // Update Cart Item
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET product = ?, price = ?,  image = ?, user_id = ? 
                  WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdsii", $this->product, $this->price, $this->total, $this->image, $this->user_id, $this->id);
        return $stmt->execute();
    }

    // Delete Cart Item
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = '$id'";
        return mysqli_query($this->conn,$query);
    }
    public function delete_all() {
        $query = "DELETE FROM " . $this->table_name;
        return mysqli_query($this->conn,$query);
    }
}
?>
