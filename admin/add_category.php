<?php
include "config.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();

    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>
<body>
    <form action="" method="post">
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" required>
        <input type="submit" name="submit" value="Add Category">
    </form>
</body>
</html>