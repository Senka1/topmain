<?php
session_start();
if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

// Include your database connection file here
require_once '../database.php';

// Add, edit or delete categories here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

    <div class="container">
        <header>
            <h1>Manage Categories</h1>
        </header>
        <!-- Add category form -->
        <form action="add_category.php" method="POST">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" id="category_name" required />
            <input type="submit" value="Add Category" />
        </form>

        <!-- Manage existing categories: display a table with the categories and the possibility to edit or delete each one -->
        <!-- Assume categories are fetched from the database and put into an array called $categories -->
        <table>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?php echo $category['name']; ?></td>
                        <td>
                            <a href="edit_category.php?id=<?php echo $category['id']; ?>">Edit</a> | 
                            <a href="delete_category.php?id=<?php echo $category['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>