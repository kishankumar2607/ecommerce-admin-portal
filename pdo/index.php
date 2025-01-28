
<?php
require_once "../includes/dbinit.php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle form submissions
    $message = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['insert'])) {
            $stmt = $pdo->prepare("INSERT INTO computers (ComputerName, Description, Quantity, Price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['price']]);
            $message = "Computer added successfully!";
        }

        if (isset($_POST['update'])) {
            $stmt = $pdo->prepare("UPDATE computers SET ComputerName = ?, Description = ?, Quantity = ?, Price = ? WHERE ComputerID = ?");
            $stmt->execute([$_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['price'], $_POST['id']]);
            $message = "Computer updated successfully!";
        }

        if (isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM computers WHERE ComputerID = ?");
            $stmt->execute([$_POST['id']]);
            $message = "Computer deleted successfully!";
        }
    }

    $stmt = $pdo->query("SELECT * FROM computers");
    $computers = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
