<?php
require('db_connection.php');
session_start();

// Check if the database connection is successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM products LIMIT 4";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/message.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <?php $page = "index";
  include('header.php') ?>

  <div id="alertContainer">
    <?php include('message.php') ?>
  </div>
  <!-- Header Section -->
  <div class="header section-padding">
    <div class="header-content">
      <h1>Step into Style: FashionNova Where Trends Come to Life</h1>
      <p>
        "Unlock Your Style at Unbeatable Prices! Dive into FashionNova, where trendsetting meets budget-friendly.
        Discover a world of fashion that won't break the bank – because style shouldn't cost a fortune!"
      </p>

      <div class="explore-button">
        <a style="background-color:  #7065D4;" href="products.php">Learn More <i id="right-arrow"
            class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>

    <div class="header-image">
      <img src="./images/homepage.png" alt="groceries" />
    </div>
  </div>
  <div class="product-page">

    <div class="explore-category">
      <h2>FEATURED PRODUCTS</h2>


      <div class="explore-products active-tab" id="all">

        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $name = $row['name'];
            $category = $row['category'];
            $price = $row['price'];
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
                <!-- Rating Star Icons -->
                <div class="rating">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <p>Rs
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
    </div>
  </div>

  <div class="container">

    <section class="home-contact">
      <div class="flex">
        <div class="content">
          <h3>Have Any Questions?</h3>
          <p>If you're looking for branded and promotional clothing, it's worth choosing your supplier with care. With
            FashionNOVA, you'll enjoy the best possible products, quality, service, and support – guaranteed!</p>
          <a href="contact.php" class="white-btn">Contact Us</a>
        </div>
      </div>
    </section>
  </div>
  <?php include('footer.php') ?>
  <script src="js/script.js"></script>
  <script src="js/message.js"></script>
</body>

</html>