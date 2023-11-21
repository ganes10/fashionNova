<?php
include 'db_connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['update_order'])) {
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
    $message[] = 'Payment status has been updated!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_orders.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- admin css file link  -->
   <link rel="stylesheet" href="admin_style.css">
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">
   <h1 class="title">Placed Orders</h1>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if (mysqli_num_rows($select_orders) > 0) {
      ?>
      <table>
         <tr>
            <th>Placed On</th>
            <th>User's ID</th>
            <th>Name</th>
            <th>Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Total Products</th>
            <th>Total Price</th>
            <th>Payment Method</th>
            <th>Action</th>
         </tr>
         <?php
            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
         ?>
         <tr>
            <td><?php echo $fetch_orders['placed_on']; ?></td>
            <td><?php echo $fetch_orders['user_id']; ?></td>
            <td><?php echo $fetch_orders['name']; ?></td>
            <td><?php echo $fetch_orders['number']; ?></td>
            <td><?php echo $fetch_orders['email']; ?></td>
            <td><?php echo $fetch_orders['address']; ?></td>
            <td><?php echo $fetch_orders['total_products']; ?></td>
            <td>$<?php echo $fetch_orders['total_price']; ?>/-</td>
            <td><?php echo $fetch_orders['method']; ?></td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                  <select name="update_payment">
                     <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                     <option value="pending">PENDING</option>
                     <option value="completed">COMPLETED</option>
                  </select>
                  <input type="submit" value="update" name="update_order" class="option-btn">
               </form>
               <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Delete this order?');" class="delete-btn">Delete</a>
            </td>
         </tr>
         <?php
            }
         ?>
      </table>
      <?php
      } else {
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>
   </div>
</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
