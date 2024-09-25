<?php
class Order {
    private $conn;
    private $table_name = "`order`"; // Backticks required because 'order' is a reserved keyword in SQL

    // Order properties
    public $id;
    public $name;
    public $country;
    public $address;
    public $city;
    public $phone;
    public $user_id;
    public $total_price;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Create Order
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, country,address,city,phone,user_id,total_price) 
        VALUES ('$this->name', '$this->country','$this->address','$this->city','$this->phone','$this->user_id','$this->total_price')";
        return mysqli_query($this->conn, $query);

    }

    // Read Single Order
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '$id'";
        return mysqli_query($this->conn,$query);
    }

    // Read All Orders by a User
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        return mysqli_query($this->conn, $query);
    }

    // Update Order
    public function update() {
        $query = "UPDATE " . $this->table_name . "
            SET first_name = ?, last_name = ?, country = ?, address = ?, city = ?, phone = ? 
            WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssi", 
            $this->first_name, 
            $this->last_name, 
            $this->country, 
            $this->address, 
            $this->city, 
            $this->phone, 
            $this->id
        );
        return $stmt->execute();
    }

    // Delete Order
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = '$id'";
        return mysqli_query($this->conn,$query);
    }
    public function get_id()
    {
        return mysqli_insert_id($this->conn);
    }
}
?>
