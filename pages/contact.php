<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "larkov");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}
?>

<html>

<head>
    <title>Свяжитесь с нами</title>
    <link rel="stylesheet" type="text/css" href="./css/contact-style.css">
    <link rel="stylesheet" type="text/css" href="./css/common-style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
    <script type="text/javascript">
        // корзино считатель

        $(document).ready(function () {
            var cartNum = localStorage.getItem("cartCount")
            if (cartNum) {
                $(".count").text(cartNum)
            }
        })
    </script>
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
            <b>
                <ul class="nav-links">
                    <li><a href="./index.php">главная</a></li>
                    <li><a href="./products.php">Каталог</a></li>
                    <li><a href="./about.php">О нас</a></li>
                    <li><a href="./contact.php" id="active">Контакты</a></li>
                </ul>
            </b>
        </nav>


        <!-- Контакты -->


        <div class="branches-wrapper">
            <div class="d1">
                <div class="branches">
                    <img src="images/branch1.png" alt="">
                    <div class="detail">
                        <b>Офис #1</b><br>
                        <p class="adress">Старый Оскол, восточный, 14</p>
                        <span class="number">8942555455</span>
                    </div>
                </div>
                <iframe class="ifr"
                    src="https://yandex.ru/map-widget/v1/?um=constructor%3Abef44881044fc50c7497a78a75e68144c46f559f7692ba8a400f510fb8e05055&amp;source=constructor"
                    width="100%" height="240" frameborder="0"></iframe>
            </div>
            <div class="d1">
                <div class="branches">
                    <img src="images/branch3.png" alt="">
                    <div class="detail">
                        <b>Офис #2</b><br>
                        <p class="adress">Губкин, Советская улица, 21</p>
                        <span class="number">89555552455</span>
                    </div>
                </div>
                <iframe class="ifr"
                    src="https://yandex.ru/map-widget/v1/?um=constructor%3A788477de46788f68222ce6655eb0ad8fac2ef6259616845532a531c6ebae7eab&amp;source=constructor"
                    width="100%" height="240" frameborder="0">
                </iframe>
            </div>
            <div class="cont1">
                <h1>Контактные данные для обратной связи</h1>
                <div class="social-media">
                <div class="mail"><a href="mailto:pwsshop@yandex.ru">pwsshop@yandex.ru</a></div>
                <div class="tphone"><a href="tel:89040834163">89040834163</a></div>
                </div>
            </div>
            <div class="cont2">
                <h1>Мы в соц сетях</h1>
                <div class="social-media">
                <a href="https://vk.com/abcdbnb" target="_blank"><div class="vk"></div></a>
                <a href="https://www.youtube.com" target="_blank"><div class="youtube"></div></a>
                <a href="https://twitter.com" target="_blank"><div class="twitter"></div></a>
                <a href="https://www.facebook.com" target="_blank"><div class="facebook"></div></a>
            </div>
            </div>
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