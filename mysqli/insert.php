<?php
require_once "../includes/dbinit.php";

$message = "";
$errors = [];

$name = $description = $quantity = $price = $added_by = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $quantity = trim($_POST['quantity']);
    $price = trim($_POST['price']);
    $added_by = trim($_POST['added_by']);

    if (empty($name)) {
        $errors['name'] = "Computer name is required";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $errors['name'] = "Only letters and white space allowed";
    }

    if (empty($description)) {
        $errors['description'] = "Description is required";
    } elseif (!preg_match("/^[a-zA-Z0-9\s.,!?]+$/", $description)) {
        $errors['description'] = "Only letters, numbers, spaces, commas, periods, exclamation marks, and question marks allowed";
    }

    if (empty($quantity)) {
        $errors['quantity'] = "Quantity is required";
    } elseif (!filter_var($quantity, FILTER_VALIDATE_INT) || $quantity <= 0) {
        $errors['quantity'] = "Quantity must be a number greater than 0.";
    }

    if (empty($price)) {
        $errors['price'] = "Price is required";
    } elseif (!filter_var($price, FILTER_VALIDATE_FLOAT) || $price <= 0) {
        $errors['price'] = "Price must be a valid positive number.";
    }

    if (empty($added_by)) {
        $errors['added_by'] = "Product added by is required";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $added_by)) {
        $errors['added_by'] = "Only letters and white space allowed";
    }


    if (empty($errors)) {
        $query = $conn->prepare("INSERT INTO computers (ComputerName, Description, Quantity, Price, ProductAddedBy) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param("ssids", $name, $description, $quantity, $price, $added_by);

        if ($query->execute()) {
            $message = "Computer added successfully!";
            // Reset values after successful submission
            $name = $description = $quantity = $price = $added_by = "";

            header("Location: index.php");
        } else {
            $message = "Error adding computer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Computer</title>
    <link rel="icon" type="image/png" href="../assets/favicon.ico">
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

            <?php if ($message): ?>
                <p class="success"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>

            <form method="POST"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="add-computer-form">
                <div class="form-group">
                    <label for="name">Computer Name:</label>
                    <input type="text" name="name" id="name" value="<?= htmlspecialchars($name) ?>">
                    <span class="error"><?= $errors['name'] ?? '' ?></span>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description"><?= htmlspecialchars($description) ?></textarea>
                    <span class="error"><?= $errors['description'] ?? '' ?></span>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="text" name="quantity" id="quantity" value="<?= htmlspecialchars($quantity) ?>">
                    <span class="error"><?= $errors['quantity'] ?? '' ?></span>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" name="price" step="0.01" id="price" value="<?= htmlspecialchars($price) ?>">
                    <span class="error"><?= $errors['price'] ?? '' ?></span>
                </div>

                <div class="form-group">
                    <label for="added_by">Product Added By:</label>
                    <input type="text" name="added_by" id="added_by" value="Kishan Kumar Das">
                    <span class="error"><?= $errors['added_by'] ?? '' ?></span>
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