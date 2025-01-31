
<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ecommerce');
define('CHARSET', 'utf8mb4');

try {
    $data_source_name = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=" . CHARSET;
    $pdo = new PDO($data_source_name, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>