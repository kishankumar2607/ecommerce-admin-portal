<?php
require_once "../includes/dbinit.php";

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $conn->prepare("INSERT INTO computers (ComputerName, Description, Quantity, Price, ProductAddedBy) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param("ssids", $_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['price'], $_POST['added_by']);
    $query->execute();
    $message = "Computer added successfully!";

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Computer</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700;900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="navbar-brand">
                <a href="index.php">
                    <h1>Computer Inventory</h1>
                </a>
            </div>
            <ul class="navbar-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="insert.php">Add New</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="form-container">
            <h1 class="page-title">Add a New Computer</h1>
            <p class="message"><?= htmlspecialchars($message) ?></p>
            <form method="POST" class="add-computer-form">
                <div class="form-group">
                    <label for="name">Computer Name:</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" required>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" name="price" step="0.01" id="price" required>
                </div>

                <div class="form-group">
                    <label for="added_by">Product Added By:</label>
                    <input type="text" name="added_by" id="added_by" required>
                </div>

                <button type="submit" class="submit-btn">Add Computer</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Computer Inventory Management</p>
    </footer>
</body>

</html>