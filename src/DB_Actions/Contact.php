<?php
class Contact {

    private $table_name = "contact"; // Table name

    // Contact properties
    public $id;
    public $name;
    public $email;
    public $message;
    public $user_id; 


    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db; // Assuming $db is a database connection object
    }

    // Create Contact
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, email, message,user_id) 
        VALUES ('$this->name', '$this->email', '$this->message','$this->user_id')";
        return mysqli_query($this->conn, $query);

    }
    // Read Single Contact
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '$id'";
        return mysqli_query($this->conn,$query);
    }

    // Read All Contacts
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        return mysqli_query($this->conn, $query);
    }

    // Update Contact
    public function update() {
        $query = "UPDATE " . $this->table_name . "
            SET name = ?, email = ?, message = ?, user_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssii", $this->name, $this->email, $this->message, $this->user_id, $this->id);
        return $stmt->execute();
    }

    // Delete Contact
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}
?>
