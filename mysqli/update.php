<?php
require_once "../includes/dbinit.php";

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateQuery = $conn->prepare("UPDATE computers SET ComputerName = ?, Description = ?, Quantity = ?, Price = ?, ProductAddedBy = ? WHERE ComputerID = ?");

    $updateQuery->bind_param("ssidsi", $_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['price'], $_POST['added_by'], $_POST['id']);

    $updateQuery->execute();
    $message = "Data updated successfully!";

    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$fetchQuery = $conn->prepare("SELECT * FROM computers WHERE ComputerID = ?");
$fetchQuery->bind_param("i", $id); // Binding the ID as integer
$fetchQuery->execute();
$result = $fetchQuery->get_result();
$computer = $result->fetch_assoc();
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

            <?php if (isset($_GET['message'])): ?>
                <div class="message"><?= htmlspecialchars($_GET['message']) ?></div>
            <?php endif; ?>


            <div class="back-home">
                <a href="index.php">Back to Home</a>
            </div>

            <form method="POST" class="add-computer-form">
                <input type="hidden" name="id" value="<?= htmlspecialchars($computer['ComputerID']) ?>">

                <div class="form-group">
                    <label for="name">Computer Name:</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($computer['ComputerName']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required><?= htmlspecialchars($computer['Description']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity Available:</label>
                    <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($computer['Quantity']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($computer['Price']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="added_by">Product Added By:</label>
                    <input type="text" id="added_by" name="added_by" value="<?= htmlspecialchars($computer['ProductAddedBy']) ?>">
                </div>

                <button type="submit" class="submit-btn">Update</button>
            </form>
        </div>
    </main>
</body>

</html>