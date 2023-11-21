<?php

// Check if the product_id is set in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Assuming you have a session variable to store the cart items, e.g., $_SESSION['cart']
    session_start();

    // Check if the cart session variable is not set, initialize it as an empty array
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add the product_id to the cart array
    $_SESSION['cart'][] = $product_id;

    // Redirect back to the product details page or any other page
    header("Location: product_details.php?product_id=" . $product_id);
    exit();
} else {
    // Redirect to an error page or home page if product_id is not set
    header("Location: error.php");
    exit();
}
?>
