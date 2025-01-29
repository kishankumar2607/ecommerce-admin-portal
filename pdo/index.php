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
                <input type="text" name="search" placeholder="Search..." class="search-input">
                <button type="submit" class="btn">Search</button>
            </form>
        </div>


        <div class="grid-container">
            <div class="computer-card">
                <div class="computer-card-header">
                    <h3 class="computer-name">Name</h3>
                </div>
                <div class="computer-card-body">
                    <p><strong>Description:</strong></p>
                    <p><strong>Quantity:</strong></p>
                    <p><strong>Price:</strong></p>
                </div>
                <div class="computer-card-footer">
                    <a href="" class="edit-btn">Edit</a>
                    <a href="" class="delete-btn">Delete</a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Computer Inventory Management</p>
    </footer>
</body>

</html>