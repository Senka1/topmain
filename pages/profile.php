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
    <title>Профиль</title>
    <link rel="stylesheet" type="text/css" href="./css/profile.css">
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


        <!-- профиль -->

        <div class="profile-wrapper">
            <h1 class="headline">Профиль</h1>
            <div class="columnshadow">
                <div class="column">
                    <div class="first">
                    <div class="twice_placeholder"><label class="labels">Имя</label><input type="text" class="form-control"
                                placeholder="Имя" value=""></div>
                        <div class="twice_placeholder"><label class="labels">Фамилия</label><input type="text"
                                class="form-control" value="" placeholder="Фамилия"></div>
                    </div>
                    <div class="first">
                        <div class="twice_placeholder"><label class="labels">Почта</label><input type="text"
                                class="form-control" placeholder="Введите вашу почту" value=""></div>
                        <div class="twice_placeholder"><label class="labels">Телефон</label><input type="text"
                                class="form-control" placeholder="Введите ваш телефон" value=""></div>
                    </div>
                    <div class="first">
                        <div class="twice_placeholder"><label class="labels">Город</label><input type="text"
                                class="form-control" placeholder="Введите ваш город" value=""></div>
                        <div class="twice_placeholder"><label class="labels">Индекс</label><input type="text"
                                class="form-control" placeholder="Введите ваш почтовый индекс" value=""></div>
                    </div>
                    </div>
                </div>
            </div>
            <button class="headline" type="button"><p class="save">Сохранить</p></button>
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