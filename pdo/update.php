<?php
require_once "../includes/pdodbinit.php";

$message = "";
$errors = [];

$name = $description = $quantity = $price = $added_by = "";
$id = "";

// Fetch the current data to pre-fill the form if it's a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the current data from the database
    $fetchQuery = $pdo->prepare("SELECT * FROM computers WHERE ComputerID = :id");
    $fetchQuery->bindParam(':id', $id, PDO::PARAM_INT);
    $fetchQuery->execute();
    $computer = $fetchQuery->fetch(PDO::FETCH_ASSOC);

    if ($computer) {
        $name = $computer['ComputerName'];
        $description = $computer['Description'];
        $quantity = $computer['Quantity'];
        $price = $computer['Price'];
        $added_by = $computer['ProductAddedBy'];
    } else {
        die("Computer not found.");
    }
}

// Handle POST request (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $quantity = trim($_POST['quantity']);
    $price = trim($_POST['price']);
    $added_by = trim($_POST['added_by']);
    $id = $_POST['id'];

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
        $updateQuery = $pdo->prepare("UPDATE computers SET ComputerName = :name, Description = :description, Quantity = :quantity, Price = :price, ProductAddedBy = :added_by WHERE ComputerID = :id");
        $updateQuery->bindParam(':name', $name, PDO::PARAM_STR);
        $updateQuery->bindParam(':description', $description, PDO::PARAM_STR);
        $updateQuery->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $updateQuery->bindParam(':price', $price, PDO::PARAM_STR);
        $updateQuery->bindParam(':added_by', $added_by, PDO::PARAM_STR);
        $updateQuery->bindParam(':id', $id, PDO::PARAM_INT);

        $updateQuery->execute();

        $message = "Data updated successfully!";
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Computer</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700;900&display=swap" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="form-container">
            <h1 class="page-title">Edit Computer</h1>

            <?php if ($message): ?>
                <div class="error"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <div class="back-home">
                <a href="index.php">Back to Home</a>
            </div>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="edit-computer-form">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

                <div class="form-group">
                    <label for="name">Computer Name:</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>">
                    <span class="error"><?= $errors['name'] ?? '' ?></span>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description"><?= htmlspecialchars($description) ?></textarea>
                    <span class="error"><?= $errors['description'] ?? '' ?></span>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity Available:</label>
                    <input type="text" id="quantity" name="quantity" value="<?= htmlspecialchars($quantity) ?>">
                    <span class="error"><?= $errors['quantity'] ?? '' ?></span>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" step="0.01" value="<?= htmlspecialchars($price) ?>">
                    <span class="error"><?= $errors['price'] ?? '' ?></span>
                </div>

                <div class="form-group">
                    <label for="added_by">Product Added By:</label>
                    <input type="text" id="added_by" name="added_by" value="<?= htmlspecialchars($added_by) ?>">
                    <span class="error"><?= $errors['added_by'] ?? '' ?></span>
                </div>

                <button type="submit" class="submit-btn">Update</button>
            </form>
        </div>
    </main>
</body>

</html>