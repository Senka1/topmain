<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "larkov");
    
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    }
    
    if(isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
?>

<html>

<head>
    
    <title>PWS Магазин</title>
    <link rel="stylesheet" type="text/css" href="../css/home-style.css">
    <link rel="stylesheet" type="text/css" href="../css/common-style.css">
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        

        // корзина

        $(document).ready(function() {
            var cartNum = localStorage.getItem("cartCount")
            if(cartNum) {
                $(".count").text(cartNum)
            }

            $(".buy").click(function() {
                var id = $(this).attr("id")

                var user = "<?php 
                    $session = (isset($_SESSION['usern'])) ? $_SESSION['usern'] : '';
                    echo $session;
                ?>"
                
                if(user) {
                    var count = parseInt(localStorage.getItem("cartCount"))
                    var items = localStorage.getItem("cartItems")

                    if(count) {
                        localStorage.setItem("cartCount", count + 1)
                        $(".count").text(count + 1)
                    }
                    else {
                        localStorage.setItem("cartCount", 1)
                        $(".count").text(1)
                    }

                    if(items) {
                        var cartItems = JSON.parse(localStorage.getItem("cartItems"))
                        cartItems[id] = (cartItems[id]) ? (cartItems[id] + 1) : 1
                        localStorage.setItem("cartItems", JSON.stringify(cartItems))
                    }
                    else {
                        var cartItems = {}
                        cartItems[id] = 1
                        localStorage.setItem("cartItems", JSON.stringify(cartItems))
                    }

                    $(this).text("Added")
                    $(this).prop('disabled', true);
                    $(this).attr('class', 'added');
                }
                else {
                    window.location.href = "login.php"
                }
            })
        })
    </script>
</head>

<body>
    <div class="wrapper">


        <!-- header -->
        
        <div class="header">
            <a href="index.php"><img src="../images/logo.png" alt="logo" class="logo"></a>
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
            <ul class="nav-links">
                <li><a href="../index.php" id="active"><b>Главная</b></a></li>
                <li><a href="../products.php"><b>Каталог</b></a></li>
                <li><a href="../about.php"><b>О нас</b></a></li>
                <li><a href="../contact.php"><b>Контакты</b></a></li>
            </ul>
        </nav>



        <!-- контент-->
<!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="..//images/sale1.png" alt="sale1"></div>
      <div class="swiper-slide"><img src="../images/sale2.png" alt="sale2"></div>
      <div class="swiper-slide"><img src="../images/sale3.png" alt="sale3"></div>
      <div class="swiper-slide"><img src="../images/sale4.png" alt="sale4"></div>
    </div>
  </div>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      centeredSlides: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
    });
  </script>

        <div class="categories-sale">
            <ul class="categories">
                <h3>категории</h3>
                <li><a href="products.php#pc" id="pc">Персональные компьютеры</a></li>
                <li><a href="products.php#displays" id="displays">мониторы</a></li>
                <li><a href="products.php#keyboards" id="keyboards">клавиатуры</a></li>
                <li><a href="products.php#mices" id="mice">мышкки</a></li>
                <li><a href="products.php#laptops" id="laptops">ноутбуки</a></li>
                <li><a href="products.php#tablets" id="tablets">планшеты</a></li>
                <li><a href="products.php#microphones" id="microphones">микрофоны</a></li>
            </ul>
            <div class="sale">
                <div class="sale-text">
                    <p><b>быстря и бесплатня !</b></p>
                    <h1>если стоимость покупки свыше 4 тысяч рублей</h1>
                </div>
            </div>
        </div>
        <h1 class="products-header">Новые товары<a href="products.php"><span class="all-products">Все товары &rarr;</span></a></h1>
        <div class="products">
            <div class="product">
                <img src="images/products/mouse3.jpg" alt="mouse3">
                <div class="detail">
                    <div class="name">супер мышка</div>
                    <span class="price">15руб</span>
                    <button type="button" id="mouse3" class="buy">добавить в корзину</button>
                </div>
            </div>
         
        </div>
    </div>


    <!-- Подвал -->


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