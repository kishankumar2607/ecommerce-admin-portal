<?php
require_once "../includes/dbinit.php";

// Fetch all computer records from the database
$query = "SELECT * FROM computers";
$result = $conn->query($query);

if ($result) {
    $computers = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $computers = [];
}

// Search functionality if search term is present
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
if ($searchTerm) {
    $query = "SELECT * FROM computers WHERE ComputerName LIKE '%" . mysqli_real_escape_string($conn, $searchTerm) . "%'";
    $result = $conn->query($query);

    if ($result) {
        $computers = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $computers = [];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Computer Inventory</title>
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

    <main class="dashboard-container">
        <h2 class="dashboard-title">Welcome to the Computer Inventory Dashboard</h2>

        <div class="search-container">
            <form method="get" action="index.php" class="search-form">
                <input type="text" name="search" placeholder="Search..." class="search-input" value="<?= htmlspecialchars($searchTerm) ?>">
                <button type="submit" class="btn">Search</button>
                <?php if ($searchTerm): ?>
                    <a href="index.php" class="delete-btn" id="clear-btn">Clear Search</a>
                <?php endif; ?>
            </form>
        </div>

        <?php if (empty($computers)): ?>
            <div class="no-data-found">
                <h3>No data found</h3>
                <p>There are no computers in the inventory. You can add new computers using the button below.</p>
                <a href="insert.php" class="btn">Add Data</a>
            </div>
        <?php else: ?>
            <div class="grid-container">
                <?php foreach ($computers as $computer): ?>
                    <div class="computer-card">
                        <div class="computer-card-header">
                            <h3 class="computer-name"><?= htmlspecialchars($computer['ComputerName']) ?></h3>
                        </div>
                        <div class="computer-card-body">
                            <p><strong>Description:</strong> <?= htmlspecialchars($computer['Description']) ?></p>
                            <p><strong>Quantity:</strong> <?= htmlspecialchars($computer['Quantity']) ?></p>
                            <p><strong>Price:</strong> $<?= number_format($computer['Price'], 2) ?></p>
                        </div>
                        <div class="computer-card-footer">
                            <a href="update.php?id=<?= $computer['ComputerID'] ?>" class="edit-btn">Edit</a>
                            <a href="delete.php?id=<?= $computer['ComputerID'] ?>" class="delete-btn">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Computer Inventory Management</p>
    </footer>
</body>

</html>