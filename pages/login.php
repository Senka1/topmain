<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "larkov");
    
    if (!$conn) {
        die("Connection has been failed");
    }

    if(isset($_SESSION['usern'])) {
        header('Location: index.php');
    }
    
    if(isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
?>

<html>

<head>
    <title>Вход</title>
    <link rel="stylesheet" type="text/css" href="../css/login-style.css">
    <link rel="stylesheet" type="text/css" href="../css/common-style.css">
    <link rel="icon" type="image/png" href="../images/favicon.png">
</head>

<body>
    <div class="wrapper">
        

        <!-- Шапка -->


        
        <div class="header">
            <a href="index.php"><img src="images/logo.png" alt="logo" class="logo"></a>
            <a href="login.php" class="login">Вход</a>
        </div>
        <nav>
            <b><ul class="nav-links">
                <li><a href="./index.php">Главная</a></li>
                <li><a href="./products.php">Каталог</a></li>
                <li><a href="./about.php">О нас</a></li>
                <li><a href="./contact.php">Контакты</a></li>
            </ul></b>
        </nav>
    </div>


    <!-- логин регистр -->


    <div class="forms">
        <div class="login-section">
            <form class="login-form" method="post" action="">
                <h1>Вход</h1>
                <?php
                    if(isset($_POST['lsubmit'])) {
                        if ($_POST['luser'] != "" && $_POST['lpass'] != "") {
                            $query = "SELECT count(*) AS count FROM users WHERE username='".$_POST['luser']."' AND password='".$_POST['lpass']."'";

                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_array($result);
                            
                            $count = $row['count'];

                            if($count > 0) {
                                $_SESSION['usern'] = $_POST['luser'];
                                header('Location: index.php');
                            }
                            else {
                                echo "<span class='err'>Имя или пароль не правильные</span><br>";
                            }
                        }
                        else {
                            echo "<span class='err'>Вы не ввели имя или пароль</span><br>";
                        }
                    }
                ?>
                <input type="textbox" placeholder="имя" class="username" name="luser" autocomplete="off"/>
                <input type="password" placeholder="пароль" class="password" name="lpass" autocomplete="off"/>
                <input type="submit" value="Войти" name="lsubmit" class="submit">
            </form>
        </div>
        <div class="register-section">
            <form class="register-form" method="post" action="">
                <h1>регистрация</h1>
                <?php
                    if(isset($_POST['rsubmit'])) {
                        if ($_POST['ruser'] != "" && $_POST['rpass1'] != "" && $_POST['rpass2'] != "") {
                            $query = "SELECT count(*) AS count FROM users WHERE username='".$_POST['ruser']."'";

                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_array($result);

                            $count = $row['count'];

                            if($count > 0) {
                                echo "<span class='err'>Это имя уже занято</span><br>";
                            }

                            else {
                                if($_POST['rpass1'] == $_POST['rpass2']) {
                                    $insertion_query = "INSERT INTO users (username, password) VALUES ('".$_POST['ruser']."', '".$_POST['rpass1']."')";
                                    if(mysqli_query($conn, $insertion_query)) {
                                        echo "<span class='succ'>Вы успешно зарегестрировались</span><br>";
                                    }
                                }
                                else {
                                    echo "<span class='err'>Пароль не совпадает</span><br>";
                                }
                            }
                        }
                        else {
                            echo "<span class='err'>Вы не ввели имя или пароль</span><br>";
                        }
                    }
                ?>
                <input type="textbox" placeholder="имя" class="username" name="ruser" autocomplete="off"/>
                <input type="password" placeholder="пароль" class="password" name="rpass1" autocomplete="off"/>
                <input type="password" placeholder="подтвердить пароль" class="password"  name="rpass2" autocomplete="off"/>
                <input type="submit" value="Зарегестрироваться" name="rsubmit" class="submit">
            </form>
        </div>
    </div>


    <!-- подвал -->


    <footer>
        <div class="sections">
            <div class="about-info">
                <h2>Информация</h2>
                <p>Наш интернет-магазин специализируется на продаже высококачественной электронной продукции. Мы
                    предлагаем широкий выбор современных устройств от ведущих производителей, гарантирующих стабильную
                    работу и высокую надежность.</p>
            </div>
            <div class="about-shipping">
                <h2>Доставка</h2>
                <p>Наши партнеры по доставке пользуются хорошей репутацией и доверием, и мы тесно сотрудничаем с ними,
                    чтобы гарантировать, что ваши заказы будут обработаны с осторожностью и доставлены вовремя</p>
            </div>
            <div class="faq">
                <h2>FAQ</h2>
                <ul>
                    <li><a href="./faq.php">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            &copy;2023 &bull; Все права защищены &bull; дизайн by <b>Семён Ларьков</b>
        </div>
    </footer>

</body>

</html>