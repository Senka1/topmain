<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "larkov");

if (!$conn) {
    die("Connection has been failed");
}

if (!isset($_SESSION['usern'])) {
    header('Location: index.php');
} else if ($_SESSION['usern'] !== "admin") {
    header('Location: index.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}
?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/cat-add.css">
    <link rel="stylesheet" type="text/css" href="../css/common-style.css">
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <title>Категории</title>

</head>

<body>
    <div class="wrapper">


        <!-- шапка -->



        <div class="header">
            <a href="index.php"><img src="images/logo.png" alt="logo" class="logo"></a>
            <?php
            if (!isset($_SESSION['usern'])) {
                echo "<a href='login.php' class='login'>Вход</a>";
            } else {
                echo "
                    <form action='index.php' method='post'>
                        <input type='submit' name='logout' method='post' class='logout' value='Выход'/>
                    </form>
                    <a href='cart.php' class='cart'>Корзина <u class='count'>0</u></a>
                    <span class='welcome'>Добро пожаловать <b>" . $_SESSION['usern'] . "</b>!</span>
                    ";
                if ($_SESSION['usern'] == 'admin') {
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
                    <li><a href="../index.php">Главная</a></li>
                    <li><a href="../products.php">Каталог</a></li>
                    <li><a href="../about.php">О нас</a></li>
                    <li><a href="../contact.php">Контакты</a></li>
                </ul>
            </b>
        </nav>

        <body>
            <div class="contain">
                <div class="contain2">
                    <div class="text-center">
                        <div class="menu">
                            <h1 class="text-center sub"><strong>Категории</strong></h1>
                            <hr class="w-25 mx-auto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <form class="form-control mx-auto w-50" action="" method="post">
                                <label class="pt-2 pb-4 text-center">категория</label>
                                <input class="form-control" type="text" id="category" placeholder="название категории">
                                <br>
                                <input type="button" class="form-control btn btn-primary" onclick="addcategory()"
                                    value="Добавить категорию">
                                <div class="error pt-2"></div>
                                <div class="pt-2 success"></div>
                            </form>

                        </div>
                        <div class="error2"></div>
                        <script>
                            function addcategory() {
                                var x = $('#category').val();
                                var input = {
                                    "category": x,
                                    "action": 'addcategory'
                                };
                                $.ajax({
                                    url: 'controller.php',
                                    type: 'POST',
                                    dataType: "json",
                                    data: input,
                                    success: function (response) {
                                        $('.success').html(response.message).show();
                                        $('.error').hide();
                                    },
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-sm-10 w-50 mx-auto rounded bg-white">
        <h3 class="text-center pt-2 pb-5\"><strong>Удалить категорию</strong></h3>
        <ol>
            <li>
                <form action="del-category.php" method="post">
                    <?php echo ($row['name']); ?>
                    <input type="hidden" name="category-name" value="<?php echo ($row['name']); ?> ">
                    <button type="submit" class="btn btn-link text-decoration-none">Удалить</button>
                </form>
            </li>
        </ol>
    </div>
    <div class="error2"></div>

    <footer>
        <div class="sections">
            <div class="about-info">
                <h2>Информация</h2>
                <p>Наш интернет-магазин специализируется на продаже высококачественной электронной продукции. Мы
                    предлагаем широкий выбор современных устройств от ведущих производителей, гарантирующих
                    стабильную
                    работу и высокую надежность.</p>
            </div>
            <div class="about-shipping">
                <h2>Доставка</h2>
                <p>Наши партнеры по доставке пользуются хорошей репутацией и доверием, и мы тесно сотрудничаем с
                    ними,
                    чтобы гарантировать, что ваши заказы будут обработаны с осторожностью и доставлены вовремя
                </p>
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