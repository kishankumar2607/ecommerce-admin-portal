<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ecommerce';

try {
    // Connect to MySQL
    $conn = new mysqli($host, $user, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database if it doesn't exist
    $conn->query("CREATE DATABASE IF NOT EXISTS $dbname");

    // Select the database
    $conn->select_db($dbname);

    // Create `computers` table if it doesn't exist
    $sql = "
    CREATE TABLE IF NOT EXISTS computers (
        ComputerID INT AUTO_INCREMENT PRIMARY KEY,
        ComputerName VARCHAR(255) NOT NULL,
        Description TEXT NOT NULL,
        Quantity INT NOT NULL,
        Price DECIMAL(10, 2) NOT NULL,
        ProductAddedBy VARCHAR(255) DEFAULT 'YourName' NOT NULL
    )";
    $conn->query($sql);
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
