<?php
require('db_connection.php');
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:login.php");
  exit();
}

if (isset($_SESSION['userid'])) {
  $customer_id = $_SESSION['userid'];
  $sql = "SELECT products.name, products.product_id, products.img_main, products.price,
  cart.product_id, cart.customer_id, cart.quantity
  FROM products
  JOIN cart ON products.product_id = cart.product_id WHERE cart.customer_id=$customer_id";
  $result = mysqli_query($conn, $sql);

  $totalPrice = 0;
  $totalItem = 0; 
  $query = "SELECT  products.product_id,  products.price,
  cart.product_id, cart.customer_id, cart.quantity
  FROM products
  JOIN cart ON products.product_id = cart.product_id WHERE cart.customer_id=$customer_id";
  $query_res = mysqli_query($conn, $query);
  while ($order_row = mysqli_fetch_assoc($query_res)) {
    $totalPrice += $order_row['price'] * $order_row['quantity']; 
    $totalItem += $order_row['quantity']; 

    // R display  cart items
  }
  $_SESSION['totalprice'] = $totalPrice;
  $_SESSION['totalitem'] = $totalItem;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/cart.css">
  <link rel="stylesheet" href="css/message.css">
  <link rel="stylesheet" href="css/adminProduct.css">

</head>

<body>
  <?php $page = "cart";
  include('header.php') ?>
  <div id="alertContainer">
    <?php include('message.php') ?>
  </div>
  <!-- Cart Section -->
  <div class="cart-section-header">
    <h1>Shopping Cart</h1>
  </div>

  <div class="cart-info">
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)):
              $img = $row['img_main'];
              ?>
              <tr>
                <td> <img src="./images/<?= $img; ?>" alt="<?php echo "$img" ?>" class="cart-image" /></td>
                <td>
                  <?php echo $row["name"]; ?>
                </td>
                <td>Rs
                  <?php echo $row["price"]; ?>
                </td>
                <td>
                  <?php echo $row["quantity"]; ?>
                </td>
                <td>
                  <a href="updateCart.php?product_id=<?php echo $row['product_id'] ?>" class="edit-button">Edit</a>
                  <a href="deleteCart.php?product_id=<?php echo $row['product_id']; ?>" class="delete-button">Remove</a>
                </td>
              </tr>
            <?php endwhile; ?>

          </tbody>
        <?php else: ?>
          <tr>
            <td colspan='5'> "There are no items in the cart."</td>
          </tr>
        <?php endif; ?>
      </table>
    </div>


    <!-- Order Info Table -->
    <div class="order-info">
      <div class="order-title">
        <h2>Order Summary</h2>
      </div>

      <div class="total-items-info">
        <?php if ($totalItem > 0): ?>
          <h3 id="itemNum"> Items Added:
            <?php echo $totalItem ?>
          </h3>
          <h3 id="totalPrice">Total Price: Rs
            <?php echo $totalPrice ?>
          </h3>
        <?php else: ?>
          <h3 id="itemNum"> Items Number: 0 </h3>
          <h3 id="totalPrice">Total Price: Rs 0 </h3>
        <?php endif; ?>
      </div>

      <div class="place-order">
  <?php if ($totalItem > 0): ?>
    <a href="checkout.php">Proceed to Checkout</a>
  <?php else: ?>
    <?php
    $_SESSION['cart_message'] = "No items in the cart. Add some items to proceed.";
    ?>
    <a href="#">Proceed to Checkout</a>
  <?php endif; ?>
</div>
    </div>

  </div>
  <?php include('footer.php') ?>
  <script src="js/script.js"></script>
  <script src="js/message.js"></script>
</body>

</html>