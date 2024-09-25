
<?php
// Initialize database and create tables
require_once 'Database.php';
$db = new DataBase();

// SQL to create tables
$createTablesSQL = "
CREATE TABLE IF NOT EXISTS users (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    permissions TEXT
);

CREATE TABLE IF NOT EXISTS categories (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS products (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    subtitle VARCHAR(100) NOT NULL,
    description TEXT,
    price INT NOT NULL,
    price_after_sale INT,
    image VARCHAR(255),
    rating SMALLINT NOT NULL DEFAULT 0,
    review SMALLINT NOT NULL DEFAULT 0,
    styles VARCHAR(100) NOT NULL,
    properties VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS messages (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS blogs (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    content TEXT,
    author_id INT,
    author_name VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255),
    FOREIGN KEY (author_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS slider (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255),
    title VARCHAR(100),
    description TEXT,
    link VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS users_opinion(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    opinion TEXT,
    image VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS contact(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT,
    user_id int,
    FOREIGN KEY (user_id) REFERENCES users(id)
);


CREATE TABLE IF NOT EXISTS settings (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    facebook VARCHAR(255) DEFAULT NULL,
    twitter VARCHAR(255) DEFAULT NULL,
    instagram VARCHAR(255) DEFAULT NULL,
    linkedin VARCHAR(255) DEFAULT NULL
);
";
$conn = $db->getConnection();
$create_tables = mysqli_multi_query($conn,$createTablesSQL);
/*
 //Insert dummy data for products
$sql = ("INSERT INTO products (name, description, price, category_id, image, is_index, rating, review) VALUES
    ('DJI Phantom 4', 'Advanced drone with 4K camera', 1499.99, 1, 'phantom4.jpg', 1, 5, 100),
    ('Parrot Anafi', 'Compact and portable drone', 699.99, 1, 'anafi.jpg', 0, 4, 50),
    ('DJI Mavic Air 2', 'Foldable drone with high performance', 999.99, 1, 'mavicair2.jpg', 1, 5, 80),
    ('Drone Battery Pack', 'High-capacity battery for longer flights', 99.99, 2, 'battery.jpg', 0, 3, 20)
");
mysqli_query($conn,$sql);
// Insert dummy data for users
$passwordAdmin = password_hash('admin123', PASSWORD_BCRYPT);
$passwordUser = password_hash('password', PASSWORD_BCRYPT);
$db->query("INSERT INTO users (username, password, email, role, permissions) VALUES
    ('admin', '$passwordAdmin', 'admin@example.com', 'admin', 'all'),
    ('john_doe', '$passwordUser', 'john@example.com', 'user', '')
");
*/
?>
