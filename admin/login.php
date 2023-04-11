<?php
    // Start the session
    session_start();
    // Check if the user is already logged in
    if(isset($_SESSION['adminLoggedIn']) && $_SESSION['adminLoggedIn'] === true){
        header("Location: index.php");
        exit;
    }

    // Define your admin username and password here
    $adminUsername = "your_admin_username";
    $adminPassword = "your_admin_password";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username === $adminUsername && $password === $adminPassword){
            $_SESSION['adminLoggedIn'] = true;
            header("Location: index.php");
        } else {
            $error = "Invalid username or password";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Admin Login</h1>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <?php if(isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>