<?php
// db.php — database connection
$host = "localhost";
$user = "root";          // default for XAMPP / WAMP
$pass = "";              // default empty for XAMPP
$dbname = "narefree";

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

// Create contacts table
$conn->query("CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    service VARCHAR(100) NOT NULL,
    comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Create owners (admin login) table
$conn->query("CREATE TABLE IF NOT EXISTS owners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)");

// Seed a default owner if table is empty  ->  username: admin   password: admin123
$res = $conn->query("SELECT COUNT(*) AS c FROM owners");
$row = $res->fetch_assoc();
if ($row['c'] == 0) {
    $hash = password_hash("admin123", PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO owners (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $u, $hash);
    $u = "admin";
    $stmt->execute();
}
?>
