<?php
session_start();
if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

// Include your database connection file here
require_once '../database.php';

// Add, edit or delete products here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

    <div class="container">
        <header>
            <h1>Manage Products</h1>
        </header>

        <!-- Add product form -->
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" required />

            <label for="product_price">Price</label>
            <input type="number" step="0.01" name="product_price" id="product_price" required />

            <label for="product_description">Description</label>
            <input type="text" name="product_description" id="product_description" required />

            <label for="product_image">Image</label>
            <input type="file" name="product_image" id="product_image" required />

            <input type="submit" value="Add Product" />
        </form>

        <!-- Manage existing products: display a table with the products and the possibility to edit or delete each one -->
        <!-- Assume products are fetched from the database and put into an array called $products -->
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><img src="../images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="50" height="50"></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a> | 
                            <a href="delete_product.php?id=<?php echo $product['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</