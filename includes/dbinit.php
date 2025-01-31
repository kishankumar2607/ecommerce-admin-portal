<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ecommerce';

try {
    $conn = new mysqli($host, $user, $password);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->query("CREATE DATABASE IF NOT EXISTS $dbname");

    $conn->select_db($dbname);

    $sql = "
    CREATE TABLE IF NOT EXISTS computers (
        ComputerID INT AUTO_INCREMENT PRIMARY KEY,
        ComputerName VARCHAR(255) NOT NULL,
        Description TEXT NOT NULL,
        Quantity INT NOT NULL,
        Price DECIMAL(10, 2) NOT NULL,
        ProductAddedBy VARCHAR(255) DEFAULT 'Kishan Kumar Das' NOT NULL
    )";

    $conn->query($sql);
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
