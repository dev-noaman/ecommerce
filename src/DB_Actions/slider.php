<?php
// Product.php
class Slider {
    
    private $table_name = "slider";

    // Product properties
    public $id;
    public $title;
    public $description;
    public $link;
    public $image;


    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db; // Assuming $db is a database connection object
    }
 

    // Create Product
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
            SET title = ?, description = ?, link = ?, image = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $this->title, $this->description, $this->link, $this->image);
        return $stmt->execute();
    }

    // Read Single Product
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            $this->title = $result['title'];
            $this->description = $result['description'];
            $this->image = $result['image'];
            $this->link = $result['link'];
            return true;
        }
        return false;
    }
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        return mysqli_query($this->conn,$query);
        
    }

    // Update Product
    public function update() {
        $query = "UPDATE " . $this->table_name . "
            SET title = ?, description = ?, link = ?, image = ?  WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $this->title, $this->description, $this->link,  $this->image, $this->id);
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
