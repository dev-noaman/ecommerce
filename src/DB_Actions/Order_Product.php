<?php
class Order_Product {

    private $table_name = "order_product"; // Table name for order-product items

    // OrderProduct properties
    public $id;
    public $order_id;
    public $product_name;
    public $user_id;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db; // Assuming $db is a database connection object
    }

    // Create OrderProduct Entry
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (order_id, product_name, user_id) 
                  VALUES ('$this->order_id', '$this->product_name', '$this->user_id')";
        return mysqli_query($this->conn, $query);
    }

    // Read Single OrderProduct Entry
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '$id'";
        return mysqli_query($this->conn, $query);
    }

    // Read All OrderProduct Entries for a User or Order
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
       
        
        return mysqli_query($this->conn, $query);
    }

    // Update OrderProduct Entry
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET order_id = ?, product_id = ?, user_id = ? 
                  WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiii", $this->order_id, $this->product_id, $this->user_id, $this->id);
        return $stmt->execute();
    }

    // Delete OrderProduct Entry
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = '$id'";
        return mysqli_query($this->conn, $query);
    }
}
?>
