<?php
require('db_connection.php');
session_start();
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Products </title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php $page = "products";
  include('header.php') ?>
  <!-- Products Section -->
  <div class="product-page">
    <div class="product-category">
      <h2>CATEGORY</h2>
      <div class="product-category-list">
        <h4 class="category-link active-link">ALL</h4>
        <h4 class="category-link">Men</h4>
        <h4 class="category-link">Women</h4>
        <!-- <h4 class="category-link">Child</h4> -->
      </div>
    </div>

    <!-- For Responsive product Category -->
    <i class="fa-solid fa-filter" id="open-category" onclick="openCategoryMenu()"></i>

    <div class="side-menu-category">
      <h4 class="category-link active-link">ALL</h4>
      <h4 class="category-link">Men</h4>
      <h4 class="category-link">Women</h4>
      <!-- <h4 class="category-link">Child</h4> -->
      <i class="fa-solid fa-xmark" id="close-category" onclick="closeCategoryMenu()"></i>
    </div>

    <div class="explore-category">
      <h2>PRODUCTS</h2>

      <!-- All Category -->
      <div class="explore-products active-tab" id="all">

        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $name = $row['name'];
            $category = $row['category'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $desc = $row['description'];
            $img = $row['img_main'];
            ?>

            <div class="product" onclick="window.location.href='detailedProduct.php?product_id=<?php echo $product_id; ?>'">
              <div class="product-image">
                <img src="images/<?= $img; ?>" alt="<?php echo "$name" ?>" />
              </div>
              <div class="product-content">
                <h3>
                  <?php echo $category ?>
                </h3>
                <h4>
                  <?php echo $name; ?>
                </h4>
                <p style="font-size: large;">Rs
                  <?php echo $price; ?>
                </p>
              </div>
            </div>

            <?php
          }
        } else {
          echo "NO DATA FOUND";
        } ?>

      </div>
      <!-- Men Category -->
      <div class="explore-products" id="men">

        <?php
        $sql_men = "SELECT * FROM products WHERE category = 'Men'";
        $result_men = mysqli_query($conn, $sql_men);

        if (mysqli_num_rows($result_men) > 0) {
          while ($row_men = mysqli_fetch_assoc($result_men)) {
            $product_id = $row_men['product_id'];
            $name = $row_men['name'];
            $category = $row_men['category'];
            $price = $row_men['price'];
            $quantity = $row_men['quantity'];
            $desc = $row_men['description'];
            $img = $row_men['img_main'];
            ?>

            <!-- Wrap each product in an anchor tag for redirection -->
            <a href="detailedProduct.php?product_id=<?php echo $product_id; ?>" class="product">
              <div class="product-image">
                <img src="images/<?= $img; ?>" alt="<?php echo "$name" ?>" />
              </div>
              <div class="product-content">
                <h3>
                  <?php echo $category ?>
                </h3>
                <h4>
                  <?php echo $name; ?>
                </h4>
                <!-- Rating Star Icons -->
                <div class="rating">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <p>Rs
                  <?php echo $price; ?>
                </p>
              </div>
            </a>

            <?php
          }
        } else {
          echo "NO DATA FOUND";
        } ?>

      </div>

      <!-- Women Category -->
      <div class="explore-products" id="women">

        <?php
        $sql_women = "SELECT * FROM products WHERE category = 'Women'";
        $result_women = mysqli_query($conn, $sql_women);

        if (mysqli_num_rows($result_women) > 0) {
          while ($row_women = mysqli_fetch_assoc($result_women)) {
            $product_id = $row_women['product_id'];
            $name = $row_women['name'];
            $category = $row_women['category'];
            $price = $row_women['price'];
            $quantity = $row_women['quantity'];
            $desc = $row_women['description'];
            $img = $row_women['img_main'];
            ?>

            <!-- Wrap each product in an anchor tag for redirection -->
            <a href="detailedProduct.php?product_id=<?php echo $product_id; ?>" class="product">
              <div class="product-image">
                <img src="images/<?= $img; ?>" alt="<?php echo "$name" ?>" />
              </div>
              <div class="product-content">
                <h3>
                  <?php echo $category ?>
                </h3>
                <h4>
                  <?php echo $name; ?>
                </h4>
                <!-- Rating Star Icons -->
                <div class="rating">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <p>Rs
                  <?php echo $price; ?>
                </p>
              </div>
            </a>

            <?php
          }
        } else {
          echo "NO DATA FOUND";
        } ?>

      </div>



    </div>
  </div>
  </div>

  <?php include('footer.php') ?>
  <script src="js/script.js"></script>
</body>

</html>