<?php

include 'db_connection.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (isset($_POST['add_to_cart'])) {
   if (!$user_id) {
      header('location: login.php');
      exit;
   }

   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
   $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
   $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die(mysqli_error($conn));

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'Product already added to the cart!';
   } else {
      $insert_query = "INSERT INTO `cart` (user_id, name, price, quantity, image) VALUES ('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')";
      $insert_result = mysqli_query($conn, $insert_query) or die(mysqli_error($conn));

      if ($insert_result) {
         $message[] = 'Product added to the cart!';
      } else {
         $message[] = 'Error adding product to the cart. Please try again.';
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- css file link  -->
   <link rel="stylesheet" href="./style.css">

   <style>
      .home {
         min-height: 70vh;
         background: linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url(images/background.png) no-repeat;
         background-size: cover;
         background-position: center;
         display: flex;
         align-items: center;
         justify-content: center;
      }

      .products-title {
         width: 100%;
         margin-bottom: 4rem;
      }

      .products-title h1 {
         font-weight: 800;
         font-size: 52px;
         line-height: 65px;
         letter-spacing: -0.04em;
         text-align: center;
      }

      .product-list {
         flex: 1;
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
         grid-gap: 2rem;
      }

      .product {
         display: flex;
         flex-direction: column;
         justify-content: space-between;
         align-items: flex-start;
         border: 1px solid #cce7d0;
         border-radius: 10px;
         cursor: pointer;
         box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02);
         transition: 0.2s ease;
      }

      .product:hover {
         box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.06);
      }

      .product-content {
         height: 100%;
         padding: 1rem 1.5rem;
      }

      .product-image {
         width: 100%;
         height: 100%;
         padding: 1rem 1rem 0rem;
      }

      .product-image img {
         width: 100%;
         height: 100%;
         border-radius: 10px;
      }

      .product-content h3 {
         color: #a5a7aa;
         font-weight: 700;
      }

      .product-content h4 {
         font-size: 20px;
         line-height: 28px;
         font-weight: 600;
      }

      .rating .fa-solid {
         color: #ff9529;
      }

      .product-content p {
         font-size: 18px;
         line-height: 25px;
         font-weight: 500;
         margin: 0.5rem 0rem;
         color: red;
      }
   </style>
</head>
<body>
   
   <?php include 'header.php'; ?>

   <section class="home">
      <div class="content">
         <h3>Hands Picked Clothes to your door</h3>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, quod? Reiciendis ut porro iste totam.</p>
         <a href="about.php" class="white-btn">discover more</a>
      </div>
   </section>

   <section class="products">
      <div class="products-title">
         <h1>Latest Products</h1>
      </div>

      <div class="product-list">
         <?php  
            $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 8") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
               while($fetch_products = mysqli_fetch_assoc($select_products)){
         ?>
            <form action="" method="post" class="product">
               <div class="product-image">
                  <img src="images/<?php echo $fetch_products['image']; ?>" alt="<?php echo $fetch_products['name']; ?>">
               </div>
               <div class="product-content">
                  <h4><?php echo $fetch_products['name']; ?></h4>
                  <div class="rating">
                     <!-- Rating Star Icons -->
                     <i class="fa-solid fa-star"></i>
                     <i class="fa-solid fa-star"></i>
                     <i class="fa-solid fa-star"></i>
                     <i class="fa-solid fa-star"></i>
                     <i class="fa-solid fa-star-half-stroke"></i>
                  </div>
                  <p>$<?php echo $fetch_products['price']; ?>/-</p>
                  <p><?php echo $fetch_products['description']; ?></p>
                  <input type="number" min="1" name="product_quantity" value="1" class="qty">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="add to cart" name="add_to_cart" class="btn">
               </div>
            </form>
         <?php
               }
            } else {
               echo '<p class="empty">no products added yet!</p>';
            }
         ?>
      </div>

      <div class="load-more"style="margin-top: 2rem; text-align:center">
         <a href="products.php" class="option-btn">load more</a>
      </div>
   </section>

   <section class="about">
      <div class="flex">
         <div class="image">
            <img src="images/about_img.jpg" alt="">
         </div>
         <div class="content">
            <h3>about us</h3>
            <p>If you're looking for branded and promotional clothing, it's worth choosing your supplier with care. With FashionNOVA you'll enjoy the best possible products, quality, service and support – guaranteed!</p>
            <a href="about.php" class="btn">read more</a>
         </div>
      </div>
   </section>

   <section class="home-contact">
      <div class="content">
         <h3>have any questions?</h3>
         <p>If you're looking for branded and promotional clothing, it's worth choosing your supplier with care. With FashionNOVA you'll enjoy the best possible products, quality, service and support – guaranteed!</p>
         <a href="contact.php" class="white-btn">contact us</a>
      </div>
   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>
</body>
</html>
