<?php
require('db_connection.php');
session_start();
$login = false;

if (isset($_SESSION['userid'])) {
  $login = true;
}

if (isset($_GET['product_id'])) {
  $product_id = $_GET['product_id'];

  // Fetch detailed product information from the database based on the product_id
  $sql = "SELECT * FROM products WHERE product_id = '$product_id' ";
  $result = mysqli_query($conn, $sql);

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Description | FashionNOVA</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="message.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      /* Reset some default styles */
      body,
      h1,
      h2,
      h3,
      p,
      figure {
        margin: 0;
      }

      body {
        font-family: 'Arial', sans-serif;
      }

      /* Header styles */
      header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: center;
      }

      /* Alert styles */
      #alertContainer {
        position: fixed;
        top: 0;
        right: 0;
        padding: 10px;
        z-index: 9999;
      }

      /* Product details styles */
      .detailedProduct {
        display: flex;
        justify-content: space-around;
        margin: 20px;
      }

      .detailedProduct-image {
        max-width: 50%;
        text-align: center;
      }

      .main-image {
        margin-top: 20px;
      }

      .main-image-link {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        cursor: pointer;
      }

      .detailedProduct-desc {
        max-width: 50%;
      }

      .product-name {
        font-size: 24px;
        margin-bottom: 10px;
      }

      .rating {
        color: #FFD700;
        margin-bottom: 10px;
      }

      .product-price {
        font-size: 18px;
        margin-bottom: 10px;
      }

      .line {
        border-top: 1px solid #ddd;
        margin-bottom: 10px;
      }

      .detailedProduct-desc_info {
        line-height: 1.6;
        margin-bottom: 20px;
      }

      .detailedProduct-btns {
        margin-bottom: 20px;
      }

      .addCart-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
      }

      /* Recommended products styles */
      .recommended-products {
        text-align: center;
        margin: 20px;
      }

      .recommended-products-title {
        font-size: 24px;
        margin-bottom: 20px;
      }

      .products-wrapper {
        position: relative;
        overflow: hidden;
      }

      .product-slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
      }

      .product-card {
        flex: 0 0 auto;
        margin: 0 10px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
        cursor: pointer;
      }

      .card-image img {
        width: 100%;
        height: auto;
        border-bottom: 1px solid #ddd;
      }

      .card-content {
        padding: 15px;
      }

      .card-content h3 {
        font-size: 18px;
        margin-bottom: 10px;
      }

      .card-content h4 {
        font-size: 16px;
        margin-bottom: 10px;
      }

      .rating {
        color: #FFD700;
        margin-bottom: 10px;
      }

      .card-content p {
        font-size: 16px;
        margin-bottom: 10px;
      }

      /* Slider navigation styles */
      .change {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 24px;
        color: #333;
        cursor: pointer;
      }

      #left {
        left: 10px;
      }

      #right {
        right: 10px;
      }
    </style>
  </head>

  <body>

    <?php $page = "products";
    include('header.php') ?>
    <div id="alertContainer">
    </div>
    <div class="heading">
      <h3>Detailed Product</h3>
      <p> <a href="home.php">HOME</a> / DETAILS </p>
    </div>

    <!-- Product Description -->
    <?php

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $name = $row['name'];
        $price = $row['price'];
        $desc = $row['description'];
        $img = $row['image'];

    ?>

        <div class="detailedProduct">
          <div class="detailedProduct-image">
            <div class="image-list">
              <img src="./images/<?= $img; ?>" alt="<?php echo "$img" ?>" class="image-link active-image" />
            </div>
          </div>

          <div class="detailedProduct-desc">
            <h2 class="product-name">
              <?php echo $name ?>
            </h2>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
            </div>
            <h4 class="product-price">Rs
              <?php echo $price; ?>
            </h4>

            <div class="line"></div>

            <div class="detailedProduct-desc_info">
              <p>
                <?php echo $desc; ?>
              </p>
            </div>


            <div class="detailedProduct-btns">
              <?php
              if ($login) {
                echo '<a href="add_to_cart.php?product_id=' . $row["product_id"] . '" class="addCart-btn">Add to Cart</a>';
              } else {
                echo '<a href="login.php" class="addCart-btn">Add to Cart</a>';
              }
              ?>
            </div>

          </div>
        </div>
    <?php }
    } else {
      echo "Product not found.";
    }
  } else {
    echo "Invalid request.";
  }
    ?>

    <!-- Recommended Products Section -->
    <div class="recommended-products">
      <div class="recommended-products-title">
        <h1>Recommended Products</h1>
      </div>

      <div class="products-wrapper">
        <i id="left" class="fa-solid fa-angle-left change"></i>
        <div class="product-slider">
          <!-- First Product -->
          <!-- Include other product cards here -->

        </div>
        <i id="right" class="fa-solid fa-angle-right change"></i>
      </div>
    </div>
    <?php include('footer.php') ?>


    <script src="js/script.js"></script>
  </body>

  </html>
<?php
require('db_connection.php');
session_start();
$login = false;

if (isset($_SESSION['userid'])) {
  $login = true;
}

if (isset($_GET['product_id'])) {
  $product_id = $_GET['product_id'];

  // Fetch detailed product information from the database based on the product_id
  $sql = "SELECT * FROM products WHERE product_id = '$product_id' ";
  $result = mysqli_query($conn, $sql);

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Description | FashionNOVA</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="message.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      /* Reset some default styles */
      body,
      h1,
      h2,
      h3,
      p,
      figure {
        margin: 0;
      }

      body {
        font-family: 'Arial', sans-serif;
      }

      /* Header styles */
      header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: center;
      }

      /* Alert styles */
      #alertContainer {
        position: fixed;
        top: 0;
        right: 0;
        padding: 10px;
        z-index: 9999;
      }

      /* Product details styles */
      .detailedProduct {
        display: flex;
        justify-content: space-around;
        margin: 20px;
      }

      .detailedProduct-image {
        max-width: 50%;
        text-align: center;
      }

      .main-image {
        margin-top: 20px;
      }

      .main-image-link {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        cursor: pointer;
      }

      .detailedProduct-desc {
        max-width: 50%;
      }

      .product-name {
        font-size: 24px;
        margin-bottom: 10px;
      }

      .rating {
        color: #FFD700;
        margin-bottom: 10px;
      }

      .product-price {
        font-size: 18px;
        margin-bottom: 10px;
      }

      .line {
        border-top: 1px solid #ddd;
        margin-bottom: 10px;
      }

      .detailedProduct-desc_info {
        line-height: 1.6;
        margin-bottom: 20px;
      }

      .detailedProduct-btns {
        margin-bottom: 20px;
      }

      .addCart-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
      }

      /* Recommended products styles */
      .recommended-products {
        text-align: center;
        margin: 20px;
      }

      .recommended-products-title {
        font-size: 24px;
        margin-bottom: 20px;
      }

      .products-wrapper {
        position: relative;
        overflow: hidden;
      }

      .product-slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
      }

      .product-card {
        flex: 0 0 auto;
        margin: 0 10px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
        cursor: pointer;
      }

      .card-image img {
        width: 100%;
        height: auto;
        border-bottom: 1px solid #ddd;
      }

      .card-content {
        padding: 15px;
      }

      .card-content h3 {
        font-size: 18px;
        margin-bottom: 10px;
      }

      .card-content h4 {
        font-size: 16px;
        margin-bottom: 10px;
      }

      .rating {
        color: #FFD700;
        margin-bottom: 10px;
      }

      .card-content p {
        font-size: 16px;
        margin-bottom: 10px;
      }

      /* Slider navigation styles */
      .change {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 24px;
        color: #333;
        cursor: pointer;
      }

      #left {
        left: 10px;
      }

      #right {
        right: 10px;
      }
    </style>
  </head>

  <body>

    <?php $page = "products";
    include('header.php') ?>
    <div id="alertContainer">
    </div>
    <div class="heading">
      <h3>Detailed Product</h3>
      <p> <a href="home.php">HOME</a> / DETAILS </p>
    </div>

    <!-- Product Description -->
    <?php

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $name = $row['name'];
        $price = $row['price'];
        $desc = $row['description'];
        $img = $row['image'];

    ?>

        <div class="detailedProduct">
          <div class="detailedProduct-image">
            <div class="image-list">
              <img src="./images/<?= $img; ?>" alt="<?php echo "$img" ?>" class="image-link active-image" />
            </div>
          </div>

          <div class="detailedProduct-desc">
            <h2 class="product-name">
              <?php echo $name ?>
            </h2>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
            </div>
            <h4 class="product-price">Rs
              <?php echo $price; ?>
            </h4>

            <div class="line"></div>

            <div class="detailedProduct-desc_info">
              <p>
                <?php echo $desc; ?>
              </p>
            </div>


            <div class="detailedProduct-btns">
              <?php
              if ($login) {
                echo '<a href="add_to_cart.php?product_id=' . $row["product_id"] . '" class="addCart-btn">Add to Cart</a>';
              } else {
                echo '<a href="login.php" class="addCart-btn">Add to Cart</a>';
              }
              ?>
            </div>

          </div>
        </div>
    <?php }
    } else {
      echo "Product not found.";
    }
  } else {
    echo "Invalid request.";
  }
    ?>

    <!-- Recommended Products Section -->
    <div class="recommended-products">
      <div class="recommended-products-title">
        <h1>Recommended Products</h1>
      </div>

      <div class="products-wrapper">
        <i id="left" class="fa-solid fa-angle-left change"></i>
        <div class="product-slider">
          <!-- First Product -->
          <!-- Include other product cards here -->

        </div>
        <i id="right" class="fa-solid fa-angle-right change"></i>
      </div>
    </div>
    <?php include('footer.php') ?>


    <script src="js/script.js"></script>
  </body>

  </html>
