<?php
// Blog.php
class Blog {

    private $table_name = "blogs";

    // Blog properties
    public $id;
    public $title;
    public $content;
    public $author_id;
    public $image;
    public $author_name;
    public $special_content;
    public $created_at;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db; // Assuming $db is a database connection object
    }

    // Create Blog
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
            SET title = ?, content = ?, author_id = ?, image = ?, author_name = ?, special_content = ?, created_at = NOW()";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssisss", $this->title, $this->content, $this->author_id, $this->image, $this->author_name, $this->special_content);
        return $stmt->execute();
    }

    // Read Single Blog
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '$id'";
        return mysqli_query($this->conn,$query);
    }

    // Read All Blogs
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        return mysqli_query($this->conn, $query);
    }

    // Update Blog
    public function update() {
        $query = "UPDATE " . $this->table_name . "
            SET title = ?, content = ?, author_id = ?, image = ?, author_name = ?, special_content = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssisssi", $this->title, $this->content, $this->author_id, $this->image, $this->author_name, $this->special_content, $this->id);
        return $stmt->execute();
    }

    // Delete Blog
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}
?>
