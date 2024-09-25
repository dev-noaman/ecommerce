<?php
class Users {
    private $conn; // Database connection
    private $table_name = "users"; // Table name

    // User properties
    public $id;
    public $username; // Username field in the database
    public $email; // Email field in the database
    public $password; // Password field in the database
    public $role; // Role field in the database
    public $permissions; // Permissions field in the database (optional)

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db; // Initialize the database connection
    }

    // Create User
    public function create() {
        // Hash the password
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // Prepare the SQL statement to insert the user
        $query = "INSERT INTO " . $this->table_name . " (username, email, password, role) VALUES (?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $this->username, $this->email, $this->password, $this->role);

        // Execute the query and return true/false based on success
        return $stmt->execute();
    }

    // Read a single user by ID
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc(); // Return the user data as an associative array
    }

    // Read all users
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC); // Return all users as an array
    }

    // Update user details
    public function update() {
        // If the password is being updated
        if (!empty($this->password)) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT); // Hash the new password
            $query = "UPDATE " . $this->table_name . " SET username = ?, email = ?, password = ?, role = ?, permissions = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sssssi", $this->username, $this->email, $this->password, $this->role, $this->permissions, $this->id);
        } else {
            // If no password update, update other fields
            $query = "UPDATE " . $this->table_name . " SET username = ?, email = ?, role = ?, permissions = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sssii", $this->username, $this->email, $this->role, $this->permissions, $this->id);
        }

        // Execute the statement and return true/false based on success
        return $stmt->execute();
    }

    // Update the user's password only
    public function updatePassword($email, $new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Hash the new password
        $query = "UPDATE " . $this->table_name . " SET password = ? WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $hashed_password, $email);
        return $stmt->execute(); // Return true/false based on success
    }

    // Delete user by ID
    public function delete() {
        // Proceed with user deletion (no need to check for blog posts)
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
    
    
    
}
