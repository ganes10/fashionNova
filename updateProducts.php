<?php
require('db_connection.php');
session_start();

if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] != true) {
    header("location:adminlogin.php");
    exit();
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch product details from the database
    $sql = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching product details: " . mysqli_error($conn);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $productCategory = $_POST['productCategory'];
        $productPrice = $_POST['productPrice'];
        $productQuantity = $_POST['productQuantity'];

        // Handle the new image file
        $newImage = $_FILES['newProductImage'];

        // Check if a new image file is provided
        if ($newImage['size'] > 0) {
            // Generate a unique name for the new image
            $newImageName = uniqid('product_') . '_' . time() . '.' . pathinfo($newImage['name'], PATHINFO_EXTENSION);

            // Move the uploaded image to the images folder
            $targetPath = "./images/" . $newImageName;
            move_uploaded_file($newImage['tmp_name'], $targetPath);

            // Update the product's image in the database
            $updateImageSql = "UPDATE `products` SET `img_main` = '$newImageName' WHERE `products`.`product_id` = '$product_id'";
            if (mysqli_query($conn, $updateImageSql)) {
                // Remove the old image file if it exists
                if ($product['img_main']) {
                    $oldImagePath = "./images/" . $product['img_main'];
                    unlink($oldImagePath);
                }
            } else {
                echo "Error updating image: " . mysqli_error($conn);
            }
        }

        // Update the product details in the database
        $updateSql = "UPDATE `products` SET 
                      `name` = '$productName', 
                      `category` = '$productCategory', 
                      `price` = '$productPrice', 
                      `quantity` = '$productQuantity', 
                      `description` = '$productDescription' 
                      WHERE `products`.`product_id` = '$product_id'";

        if (mysqli_query($conn, $updateSql)) {
            header('location:manageProducts.php');
            exit();
        } else {
            echo "Error updating product: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | Admin Dashboard</title>
    <link rel="stylesheet" href="css/updateProducts.css">
</head>

<body>
    <!-- Edit Product -->
    <div class="container" id="edit_product">
        <div class="container-content">
            <h3>Edit Product
                <button id="closeEditProduct" onclick="window.location.href='manageProducts.php'">x</button>
            </h3>
            <div class="content">
                <form id="editProductForm" action="#" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Product Name</span>
                            <input type="text" id="productName" name="productName" value="<?php echo $product['name']; ?>">
                            <div class="form-error name-error"></div>
                        </div>
                        <div class="input-box">
                            <span class="details">Category</span>
                            <input type="text" id="productCategory" name="productCategory" value="<?php echo $product['category']; ?>">
                            <div class="form-error category-error"></div>
                        </div>
                        <div class="input-box">
                            <span class="details">Description</span>
                            <textarea id="productDescription" cols="30" rows="10" name="productDescription"><?php echo $product['description']; ?></textarea>
                            <div class="form-error description-error"></div>
                        </div>
                        <div class="input-box">
                            <span class="details">Price</span>
                            <input type="number" id="productPrice" name="productPrice" step="5" value="<?php echo $product['price']; ?>">
                            <div class="form-error price-error"></div>
                        </div>
                        <div class="input-box">
                            <span class="details">Quantity</span>
                            <input type="number" id="productQuantity" name="productQuantity" value="<?php echo $product['quantity']; ?>">
                            <div class="form-error quantity-error"></div>
                        </div>

                        <div class="input-box">
                            <span class="details">Current Image</span>
                            <img src="./images/<?php echo $product['img_main']; ?>" alt="<?php echo $product['img_main']; ?>" class="product-image" />
                        </div>

                        <div class="input-box">
                            <span class="details">New Image</span>
                            <input type="file" id="newProductImage" name="newProductImage" accept="image/*">
                            <div class="form-error image-error"></div>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" value="Update Product">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editProductForm = document.getElementById('editProductForm');

            editProductForm.addEventListener('submit', function (e) {
                let hasError = false;

                // Product Name validation
                const productName = document.getElementById('productName').value;
                if (productName === '') {
                    document.querySelector('.name-error').textContent = 'Product name is required!';
                    hasError = true;
                } else {
                    document.querySelector('.name-error').textContent = '';
                }

                // Category validation
                const productCategory = document.getElementById('productCategory').value;
                if (productCategory === '') {
                    document.querySelector('.category-error').textContent = 'Category is required!';
                    hasError = true;
                } else {
                    document.querySelector('.category-error').textContent = '';
                }

                // Description validation
                const productDescription = document.getElementById('productDescription').value;
                if (productDescription === '') {
                    document.querySelector('.description-error').textContent = 'Description is required!';
                    hasError = true;
                } else {
                    document.querySelector('.description-error').textContent = '';
                }

                // Price validation
                const productPrice = document.getElementById('productPrice').value;
                if (productPrice === '' || productPrice <= 0) {
                    document.querySelector('.price-error').textContent = 'Enter a valid price!';
                    hasError = true;
                } else {
                    document.querySelector('.price-error').textContent = '';
                }

                // Quantity validation
                const productQuantity = document.getElementById('productQuantity').value;
                if (productQuantity === '' || productQuantity < 0) {
                    document.querySelector('.quantity-error').textContent = 'Enter a valid quantity!';
                    hasError = true;
                } else {
                    document.querySelector('.quantity-error').textContent = '';
                }

                // Prevent form submission if there's an error
                if (hasError) {
                    e.preventDefault();
                }
            });
        });

    </script>
</body>

</html>