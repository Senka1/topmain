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
    <title>Всё о нас</title>
    <link rel="stylesheet" type="text/css" href="./css/about-style.css">
    <link rel="stylesheet" type="text/css" href="./css/common-style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
    <script type="text/javascript">
        // корзина

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


        <!-- header -->



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
                    <li><a href="./products.php">каталог</a></li>
                    <li><a href="./about.php" id="active">о нас</a></li>
                    <li><a href="./contact.php">контакты</a></li>
                </ul>
            </b>
        </nav>


        <!-- Информация -->


        <img src="images/branch.png" alt="branch" class="branch">
        <div class="abouttext">
            <p style="text-indent: 5%;"><b>Pws Shop</b> даёт возможность приобретения качественной электронной продукции. Мы предлагаем широкий
            ассортимент современных устройств, которые отличаются высоким качеством и функциональностью.
            Кроме того, мы предлагаем уникальные товары с необычным дизайном, в том числе рисунками на корпусе. Наш
            магазин готов предложить вам огромный выбор электронных устройств с оригинальным дизайном, которые
            подчеркнут вашу индивидуальность и стиль.<br></p>

            <p style="text-indent: 5%;">Мы убеждены, что наши клиенты оценят качество и надежность предлагаемой продукции, а также оригинальный
            дизайн. Мы готовы предложить профессиональную консультацию по выбору электронных устройств и помочь вам
            сделать правильный выбор.<br></p>

            <p style="text-indent: 5%;">Приглашаем вас посетить наш магазин и ознакомиться с нашим широким ассортиментом. Мы гарантируем высокое
            качество предлагаемых товаров, индивидуальный подход к каждому клиенту и оперативную доставку заказов в
            любой регион.
            </p>
        </div>
        <div class="buket-wrapper">
            <div class="buket">
                <h1>Ларьков Семён</h1>
                <h2>Автор идеи</h2><br>
                <img src="./images/la.jpg" alt="semyon">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur iure quod esse debitis est
                    consequuntur nostrum repudiandae a, maiores totam quia nobis exercitationem. Necessitatibus, earum
                    dolore eaque animi corrupti commodi?
                </p>
            </div>
        </div>
        <div class="yunus-wrapper">
            <div class="yunus">
                <h1>Ларьков Семён</h1>
                <h2>Создатель сайта</h2><br>
                <img src="./images/ls.jpg" alt="semyon">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla consequatur repellendus itaque est,
                    nesciunt ratione perferendis dolore vel porro quaerat veniam inventore corporis excepturi saepe eius
                    esse molestias quas doloremque?
                </p>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer>
        <div class="sections">
            <div class="about-info">
                <h2>Информация</h2>
                <p> Наш интернет-магазин специализируется на продаже высококачественной электронной продукции. Мы
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