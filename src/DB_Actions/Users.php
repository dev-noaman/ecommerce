<?php 
// User.php
class Users {

    private $table_name = "users";

    // User properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $permissions;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db; // Assuming $db is a database connection object
    }

    // Create User
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (username, email, password) 
              VALUES ('$this->name', '$this->email', '$this->password')";

    // Execute the query
    return mysqli_query($this->conn, $query);
    }

    // Read Single User
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '$id'";
        return mysqli_query($this->conn, $query);
    }

    // Read All Users
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        return mysqli_query($this->conn, $query);
    }
    public function check($email)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE `email` = '$email'";
        return mysqli_query($this->conn,$query);
    }
    // Update User
    public function update() {
        $query = "UPDATE " . $this->table_name . "
            SET name = ?, email = ?, password = ?, role = ?, permissions = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $this->name, $this->email, $this->password, $this->role, $this->permissions, $this->id);
        return $stmt->execute();
    }
    public function update_password($email,$password)
    {
        $query = "UPDATE " . $this->table_name.
        " SET `password` = '$password' WHERE `email` = '$email'";
        return mysqli_query($this->conn,$query);
    }

    // Delete User
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}
?>

