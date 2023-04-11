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
    <title>Каталог</title>
    <link rel="stylesheet" type="text/css" href="./css/products-style.css">
    <link rel="stylesheet" type="text/css" href="./css/common-style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
    <script type="text/javascript">
        // CART ADDING
        
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
                <li><a href="./products.php" id="active">Каталог</a></li>
                <li><a href="./about.php">О нас</a></li>
                <li><a href="./contact.php">Контакты</a></li>
            </ul></b>
        </nav>


        

        <?php
            // result

            echo "
            <h1 class='products-header' id='displays'>Monitors</h1>
            <div class='products'>
            ";

            $query = "SELECT * FROM products WHERE id LIKE 'display%'";
            $result = mysqli_query($conn, $query);

            foreach($result as $product) {
                $id = $product['id'];
                $name = $product['name'];
                $price = $product['price'];
                $stock = $product['stock'];

                echo "         
                    <div class='product'>
                        <img src='images/products/".$id.".jpg' alt='".$id."' id='displays'>
                        <div class='detail'>
                            <div class='name'>".$name."</div>
                            <span class='price'>$".$price."0</span>
                            ";
                            if($stock == 0) {
                                echo "<button disabled type='button' class='no-stock'>Out of Stock</button>";
                            }
                            else {
                                echo "<button type='button' id='".$id."' class='buy'>Add to Cart</button>";
                            }
                            echo "
                        </div>
                    </div>
                ";
            }
            echo "</div>";


            // LAPTOPS

            echo "
            <h1 class='products-header' id='laptops'>Laptops</h1>
            <div class='products'>
            ";

            $query = "SELECT * FROM products WHERE id LIKE 'laptop%'";
            $result = mysqli_query($conn, $query);

            foreach($result as $product) {
                $id = $product['id'];
                $name = $product['name'];
                $price = $product['price'];
                $stock = $product['stock'];

                echo "         
                    <div class='product'>
                        <img src='images/products/".$id.".jpg' alt='".$id."' id='laptops'>
                        <div class='detail'>
                            <div class='name'>".$name."</div>
                            <span class='price'>$".$price."0</span>
                            ";
                            if($stock == 0) {
                                echo "<button disabled type='button' class='no-stock'>Out of Stock</button>";
                            }
                            else {
                                echo "<button type='button' id='".$id."' class='buy'>Add to Cart</button>";
                            }
                            echo "
                        </div>
                    </div>
                ";
            }
            echo "</div>";


            // MICE

            echo "
            <h1 class='products-header' id='mice'>Mice</h1>
            <div class='products'>
            ";

            $query = "SELECT * FROM products WHERE id LIKE 'mouse%'";
            $result = mysqli_query($conn, $query);

            foreach($result as $product) {
                $id = $product['id'];
                $name = $product['name'];
                $price = $product['price'];
                $stock = $product['stock'];

                echo "         
                    <div class='product'>
                        <img src='images/products/".$id.".jpg' alt='".$id."' id='mice'>
                        <div class='detail'>
                            <div class='name'>".$name."</div>
                            <span class='price'>$".$price."0</span>
                            ";
                            if($stock == 0) {
                                echo "<button disabled type='button' class='no-stock'>Out of Stock</button>";
                            }
                            else {
                                echo "<button type='button' id='".$id."' class='buy'>Add to Cart</button>";
                            }
                            echo "
                        </div>
                    </div>
                ";
            }
            echo "</div>";


            // PRINT

            echo "
            <h1 class='products-header' id='keyboards'>Keyboards</h1>
            <div class='products'>
            ";

            $query = "SELECT * FROM products WHERE id LIKE 'printer%'";
            $result = mysqli_query($conn, $query);

            foreach($result as $product) {
                $id = $product['id'];
                $name = $product['name'];
                $price = $product['price'];
                $stock = $product['stock'];

                echo "         
                    <div class='product'>
                        <img src='images/products/".$id.".jpg' alt='".$id."'>
                        <div class='detail'>
                            <div class='name'>".$name."</div>
                            <span class='price'>$".$price."0</span>
                            ";
                            if($stock == 0) {
                                echo "<button disabled type='button' class='no-stock'>Out of Stock</button>";
                            }
                            else {
                                echo "<button type='button' id='".$id."' class='buy'>Add to Cart</button>";
                            }
                            echo "
                        </div>
                    </div>
                ";
            }
            echo "</div>";


            // TABLETS

            echo "
            <h1 class='products-header' id='tablets'>Tablets</h1>
            <div class='products'>
            ";

            $query = "SELECT * FROM products WHERE id LIKE 'tablet%'";
            $result = mysqli_query($conn, $query);

            foreach($result as $product) {
                $id = $product['id'];
                $name = $product['name'];
                $price = $product['price'];
                $stock = $product['stock'];

                echo "         
                    <div class='product'>
                        <img src='images/products/".$id.".jpg' alt='".$id."'>
                        <div class='detail'>
                            <div class='name'>".$name."</div>
                            <span class='price'>$".$price."0</span>
                            ";
                            if($stock == 0) {
                                echo "<button disabled type='button' class='no-stock'>Out of Stock</button>";
                            }
                            else {
                                echo "<button type='button' id='".$id."' class='buy'>Add to Cart</button>";
                            }
                            echo "
                        </div>
                    </div>
                ";
            }
            echo "</div>";
        ?>


    </div>


    <!-- footer -->


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