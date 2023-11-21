<?php
require('db_connection.php');

// Check if the 'category' parameter is set
if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];

    // Fetch products based on the selected category
    $sql = "SELECT * FROM products WHERE category = '$selectedCategory'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $products = array();

        while ($row = mysqli_fetch_assoc($result)) {
            // Add each product to the array
            $products[] = $row;
        }

        // Return products as JSON
        echo json_encode($products);
    } else {
        // Handle the query error, if any
        echo json_encode(array('error' => 'Error executing the query.'));
    }
} else {
    // Handle the case where the 'category' parameter is not set
    echo json_encode(array('error' => 'Category parameter is not set.'));
}

?>
