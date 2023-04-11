<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM categories WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: index.php');
    exit();
} else {
    header('Location: index.php');
    exit();}
    ?>