<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "larkov");
    
    if(!$conn) {
        die("Connection has been failed");
    }

    if(!isset($_SESSION['usern'])) {
        header('Location: index.php');
    }
    else if($_SESSION['usern'] !== "admin") {
        header('Location: index.php');
    }
    
    if(isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
?>

<html>

<head>
    <title>Админ панель</title>
    <link rel="stylesheet" type="text/css" href="panel-style.css">
    <link rel="stylesheet" type="text/css" href="common-style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
</head>

<body>
    <div class="wrapper">


        <!-- шапка -->


        
        <div class="header">
            <a href="index.php"><img src="images/logo.png" alt="logo" class="logo"></a>
            <?php
                if(!isset($_SESSION['usern'])) {
                    echo "<a href='login.php' class='login'>Вход</a>";
                }
                else {
                    echo "
                    <form action='index.php' method='post'>
                        <input type='submit' name='logout' method='post' class='logout' value='Выход'/>
                    </form>
                    <a href='cart.php' class='cart'>Корзина <u class='count'>0</u></a>
                    <span class='welcome'>Добро пожаловать <b>".$_SESSION['usern']."</b>!</span>
                    ";
                    if($_SESSION['usern'] == 'admin') {
                        echo "
                        <a href='panel.php' class='panel'>Админ панель</a>
                        ";
                    }
                }
            ?>
        </div>
        <nav>
            <b><ul class="nav-links">
                <li><a href="./index.php">Главная</a></li>
                <li><a href="./products.php">Каталог</a></li>
                <li><a href="./about.php">О нас</a></li>
                <li><a href="./contact.php">Контакты</a></li>
            </ul></b>
        </nav>


        <!-- Товары -->
        
        



        <form action="" method="post">
            <div class="save">
                <input type="submit" value="сохранить" name="submit">
            </div>
            <?php
                $query = "SELECT * FROM products";
                $result = mysqli_query($conn, $query);

                if(isset($_POST["submit"])) {
                    foreach($result as $product) {
                        $id = $product['id'];
                        $update_query = "UPDATE products SET stock='".$_POST[$id]."' WHERE id='".$id."'";
                        mysqli_query($conn, $update_query);
                    }
                    echo "<span class='succ'>Успешно сохраненно</span><br>";
                }
            ?>
            <table>
                <thead>
                    <tr>
                        <th class="product-th">Товар</th>
                        <th>Название</th>
                        <th class="quantity-th">kоличество</th>
                        <th>цена</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $query = "SELECT * FROM products";
                        $result = mysqli_query($conn, $query);

                        foreach($result as $product) {
                            $id = $product['id'];
                            $name = $product['name'];
                            $price = $product['price'];
                            $stock = $product['stock'];

                            echo "
                            <tr id='".$id."'>
                                <td><img src='images/products/".$id.".jpg' alt='".$id."' class='product-img'></td>
                                <td><div class='name'>".$name."</div></td>
                                <td><input type='number' name='".$id."' class='stock' value='".$stock."' min='0'></td>
                                <td><div class='price'>$".$price."</div></td>
                            </tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
        </form>
    </div>


    <!-- FOOTER -->


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