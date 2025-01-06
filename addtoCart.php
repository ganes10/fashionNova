<?php
include ('db_connection.php');
session_start();

if(isset($_GET['product_id']) && isset($_SESSION['userid'])){
    $product_id = $_GET['product_id'];
    $customer_id = $_SESSION['userid'];

    // Check if the customer exists in the customers table
    $checkCustomerQuery = "SELECT * FROM `customers` WHERE `customer_id`='$customer_id'";
    $checkCustomerResult = mysqli_query($conn, $checkCustomerQuery);

    if (mysqli_num_rows($checkCustomerResult) > 0) {
        // The customer exists, proceed with checking and inserting into the cart table
        $checkCartQuery = "SELECT * FROM `cart` WHERE `product_id`='$product_id' AND `customer_id`='$customer_id'";
        $checkCartResult = mysqli_query($conn, $checkCartQuery);

        if (mysqli_num_rows($checkCartResult) >= 1) {
            // The product is already added to the cart
            $_SESSION['message'] = "The product is already added to the cart";
            header("location:detailedProduct.php?product_id=$product_id");
            exit();
        } else {
            // The product is not in the cart, proceed with insertion
            $priceQuery = "SELECT `price` FROM `products` WHERE `product_id`='$product_id'";
            $priceResult = mysqli_query($conn, $priceQuery);

            if ($row = mysqli_fetch_assoc($priceResult)) {
                $price = $row['price'];
                $quantity = 1;
                $totalPrice = $quantity * $price;

                $insertCartQuery = "INSERT INTO `cart` (`product_id`, `quantity`, `customer_id`) VALUES ('$product_id', '$quantity', '$customer_id')";
                mysqli_query($conn, $insertCartQuery);

                $_SESSION['success_msg'] = "You have successfully added the product to the cart!";
                header("location:detailedProduct.php?product_id=$product_id");
                exit();
            }
        }
    } else {
        // The customer does not exist
        $_SESSION['message'] = "Customer does not exist!";
        header("location:some_page.php"); // Redirect to an appropriate page
        exit();
    }
}
?>
