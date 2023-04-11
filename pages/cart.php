<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "larkov");
    
    if (!$conn) {
        die("Connection has been failed");
    }

    if(!isset($_SESSION['usern'])) {
        header('Location: index.php');
    }
    
    if(isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
?>

<html>

<head>
    <title>корзина</title>
    <link rel="stylesheet" type="text/css" href="./css/cart-style.css">
    <link rel="stylesheet" type="text/css" href="./css/common-style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // обновление счёта в корзине

            var cartNum = localStorage.getItem("cartCount")
            if(cartNum) {
                $(".count").text(cartNum)
            }

            // перевод localstorage в пхп

            var itemsInCart = localStorage.getItem("cartItems")
            if(itemsInCart !== "{}" && itemsInCart !== null) {
                $.ajax({
                    type: "POST",
                    url: "cart-items.php",
                    data: {items: itemsInCart},
                    success: function(data) {
                        $(".cart-items").html(data)
                    }
                })
            }
            else {
                $(".cart-items").html("<p class='empty'>Твоя корзина <b>пуста!</b></p>")
            }
        })
    </script>
</head>

<body>
    <div class="wrapper">


        <!-- хеадер -->


        
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
                    <li><a href="index.php">главная</a></li>
                    <li><a href="about.php">о нас</a></li>
                    <li><a href="contact.php">контакты</a></li>
                    <li><a href="products.php">каталог</a></li>
                </ul>
            </b>
        </nav>


        <!-- корзина -->

        
        <div class="cart-items"></div>


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