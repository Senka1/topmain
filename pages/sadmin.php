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

if(isset($_POST['category_name'])) {
  $category_name = $_POST['category_name'];
  $category_query = "INSERT INTO categories (name) VALUES ('$category_name')";
  mysqli_query($conn, $category_query);
}

if(isset($_POST['delete_category'])) {
  $category_id = $_POST['category_id'];
  $delete_products_query = "DELETE FROM products WHERE category_id='$category_id'";
  mysqli_query($conn, $delete_products_query);
  $delete_category_query = "DELETE FROM categories WHERE id='$category_id'";
  mysqli_query($conn, $delete_category_query);
}

if(isset($_POST['product_name'])) {
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_description = $_POST['product_description'];
  $product_category = $_POST['product_category'];
  $product_filename = uniqid();
  $product_file = $_FILES['product_img']['tmp_name'];
  $product_filepath = './images/products/'.$product_filename.'.jpg';
  move_uploaded_file($product_file, $product_filepath);
  $product_query = "INSERT INTO products (name, price, description, category_id, img) VALUES ('$product_name', $product_price, '$product_description', '$product_category', '$product_filename')";
  mysqli_query($conn, $product_query);
}

if(isset($_POST['delete_product'])) {
  $product_id = $_POST['product_id'];
  $delete_product_query = "DELETE FROM products WHERE id='$product_id'";
  mysqli_query($conn, $delete_product_query);
}

?>

<html>
<head>
  <title>Админ панель</title>
  <link rel="stylesheet" type="text/css" href="../css/admin.css>
  <link rel="stylesheet" type="text/css" href="../css/common-style.css">
  <link rel="icon" type="image/png" href="../images/favicon.png">
</head>

<body>
  <div class="wrapper">
    <div class="header">
      <a href="index.php\"><img src="../images/logo.png" alt="logo" class="logo"></a>
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
        <li><a href="../index.php">Главная</a></li>
        <li><a href="../products.php">Каталог</a></li>
        <li><a href="../about.php">О нас</a></li>
        <li><a href="../contact.php">Контакты</a></li>
      </ul></b>
    </nav>

    <div class="categories">
      <h2>Управление категориями</h2>
      <form method="post">
        <label for="category_name">Добавить категорию:</label>
        <input type="text" id="category_name" name="category_name" placeholder="Введите название категории" required>
        <input type="submit" value="Добавить">
      </form>
      <?php
      $categories_query = "SELECT * FROM categories";
      $result = mysqli_query($conn, $categories_query);
      echo "<table>";
      foreach($result as $category) {
        $category_id = $category['id'];
        $category_name = $category['name'];
        echo "<tr><td>$category_name</td><td>
        <form method='post'>
        <input type='hidden' name='category_id' value='$category_id'>
        <input type='submit' value='Удалить' name='delete_category'></form></td></tr>";
      }
      echo "</table>";
      ?>
    </div>

    <div class="products">
      <h2>Управление товарами</h2>
      <form method="post" enctype="multipart/form-data">
        <label for="product_name">Добавить товар:</label><br>
        <input type="text" id="product_name" name="product_name" placeholder="Введите название товара" required><br>
        <input type="number" min="0" step="0.01" name="product_price" placeholder="Цена" required><br>
        <textarea name="product_description" placeholder="Описание" required></textarea><br>
        <select name="product_category">
          <?php
            $categories_query = "SELECT * FROM categories";
            $result = mysqli_query($conn, $categories_query);
            foreach($result as $category) {
              $category_id = $category['id'];
              $category_name = $category['name'];
              echo "<option value='$category_id'>$category_name</option>";
            }
          ?>
        </select><br  >
        <input type="file" name="product_img\"><br>
        <input type="submit" value="Добавить">
      </form>
      <?php
      $products_query = "SELECT * FROM products";
      $result = mysqli_query($conn, $products_query);
      echo "<table>";
      foreach($result as $product) {
        $product_id = $product['id'];
        $product_name = $product['name'];
        $product_price = $product['price'];
        $product_description = $product['description'];
        $product_category_id = $product['category_id'];
        $product_category_name = mysqli_query($conn, "SELECT name FROM categories WHERE id='$product_category_id'");
        $product_category_name = mysqli_fetch_assoc($product_category_name)['name'];
        echo "
        <tr><td><img src='images/products/$product[id].jpg' alt='$product_name' class='product-img'></td>
        <td><div class='name'>$product_name</div><div class='description'>$product_description</div></td>
        <td><div class='price'>$product_price руб.</div></td>
        <td><div class='category'>$product_category_name</div></td>
        <td>
        <form method='post'>
        <input type='hidden' name='product_id' value='$product_id'>
        <input type='submit' value='Удалить' name='delete_product'></form></td></tr>
        ";
      }
      echo "</table>";
      ?>
    </div>

  </div>

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
```