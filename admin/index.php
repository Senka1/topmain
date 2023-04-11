<?php
// Start the session and check if the user is logged in
session_start();
if(!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] !== true){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to the Admin Dashboard</h1>
        </header>

        <nav>
            <a href="categories.php">Manage Categories</a> 
            <a href="products.php">Manage Products</a>
        </nav>

        <hr>
        <footer>
            <a href="logout.php">Logout</a>
        </footer>
    </div>
</body>
</html>