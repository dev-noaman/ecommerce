<?php
// UsersOpinion.php
class Users_Opinion {

    private $table_name = "users_opinion";

    // UsersOpinion properties
    public $id;
    public $name;
    public $position;
    public $opinion;
    public $image;
    public $created_at;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db; // Assuming $db is a database connection object
    }

    // Create Opinion
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
            SET name = ?, position = ?, opinion = ?, image = ?, created_at = NOW()";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $this->name, $this->position, $this->opinion, $this->image);
        return $stmt->execute();
    }

    // Read Single Opinion
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            $this->name = $result['name'];
            $this->position = $result['position'];
            $this->opinion = $result['opinion'];
            $this->image = $result['image'];
            $this->created_at = $result['created_at'];
            return true;
        }
        return false;
    }

    // Read All Opinions
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        return mysqli_query($this->conn, $query);
    }

    // Update Opinion
    public function update() {
        $query = "UPDATE " . $this->table_name . "
            SET name = ?, position = ?, opinion = ?, image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $this->name, $this->position, $this->opinion, $this->image, $this->id);
        return $stmt->execute();
    }

    // Delete Opinion
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}
?>
