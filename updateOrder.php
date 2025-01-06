<?php
require('db_connection.php'); 
session_start();

if (isset($_GET['customer_id']) && isset($_GET['order_id'])) {
    $customer_id = $_GET['customer_id'];
    $order_id = $_GET['order_id'];

        $sql = "UPDATE `orders` SET `status` = 'Order Sucessful' WHERE `orders`.`customer_id` = '$customer_id' AND `orders`.`order_id` = '$order_id'";
        if (mysqli_query($conn, $sql)) {
            header('location:manageOrders.php'); 

            exit();
        } else {
            echo "Error updating order: " . mysqli_error($conn);
        }
    
}
?>