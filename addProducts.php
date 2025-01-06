<?php
require('db_connection.php');
session_start();

if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] != true) {
    header("location: adminlogin.php");
    exit();
}

$adminid = $_SESSION['adminid'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST['productName']) &&
        isset($_POST['productDescription']) &&
        isset($_POST['productCategory']) &&
        isset($_POST['productPrice']) &&
        isset($_POST['productQuantity']) &&
        isset($_FILES['productImage'])
    ) {
        $name = $_POST['productName'];
        $description = $_POST['productDescription'];
        $category = $_POST['productCategory'];
        $price = $_POST['productPrice'];
        $quantity = $_POST['productQuantity'];

        $img_name = $_FILES['productImage']['name'];
        $img_size = $_FILES['productImage']['size'];
        $tmp_name = $_FILES['productImage']['tmp_name'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $allowed_ex = array("jpeg", "jpg", "png");

        if (in_array($img_ex, $allowed_ex)) {
            $img_upload_path = 'images/' . $img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $sql = "INSERT INTO products (name, category, price, quantity, img_main, description, created_at, admin_id) VALUES ('$name', '$category', '$price', '$quantity', '$img_name', '$description', current_timestamp(), $adminid)";

            if (mysqli_query($conn, $sql)) {
                $_SESSION['success_msg'] = "Product has been added successfully.";
                header("location: manageProducts.php");
                exit();
            } else {
                $_SESSION['message'] = "Product cannot be added.";
            }
        } else {
            echo "Invalid image format. Allowed formats: jpeg, jpg, png.";
        }
    } else {
        echo "Incomplete form data.";
    }
} else {
    echo "Error in adding product.";
}
?>
