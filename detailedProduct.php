<?php
require('db_connection.php');
session_start();
$login = false;
if (isset($_SESSION['userid'])) {
    $login = true;
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch detailed product information from the database based on the product_id
    $sql = "SELECT * FROM products WHERE product_id = '$product_id' ";
    $result = mysqli_query($conn, $sql);

    // Fetch some products for the recommended section
    $recommendedSql = "SELECT * FROM products WHERE product_id <> '$product_id' ORDER BY RAND() LIMIT 4";
    $recommendedResult = mysqli_query($conn, $recommendedSql);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Product Description</title>
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/message.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <?php include('header.php') ?>
        <div id="alertContainer">
            <?php include('message.php') ?>
        </div>

 <!-- Product Description -->
<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $name = $row['name'];
        $category = $row['category'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        $desc = $row['description'];
        $img = $row['img_main'];
        ?>

        <div class="detailedProduct">
            <div class="detailedProduct-image">
                <div style="height: 500px; width:400px; margin-left: 150px" class="main-image">
                <img src="images/<?= $img; ?>" alt="<?php echo "$name" ?>" /> 
                </div>
            </div>

            <div class="detailedProduct-desc">
                <h2 class="product-name">
                    <?php echo $name ?>
                </h2>
                <!-- Other details... -->

                <div class="detailedProduct-desc_info">
                    <p>
                        <?php echo $desc; ?>
                    </p>
                </div>

                <div class="detailedProduct-desc_info">
                    <p> Price:
                        <?php echo $price; ?>
                    $</p>
                </div>

                <div class="detailedProduct-btns">
                    <?php
                    if ($login) {
                        echo '<a href="addtoCart.php?product_id=' . $row["product_id"] . '" class="addCart-btn">Add to Cart</a>';
                    } else {
                        echo '<a href="login.php" class="addCart-btn">Add to Cart</a>';
                    }
                    ?>
                </div>

                <div class="more-info">
                    <h3>Category: <span>
                            <?php echo $category ?>
                        </span></h3>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "Product not found.";
}
?>

<!-- Recommended Products Section -->
<div class="recommended-products">
    <div class="recommended-products-title">
        <h1>Recommended Products</h1>
    </div>

    <div class="products-wrapper">
        <?php
        while ($recommendedRow = mysqli_fetch_assoc($recommendedResult)) {
            $recommendedProductId = $recommendedRow['product_id'];
            $recommendedProductName = $recommendedRow['name'];
            $recommendedProductPrice = $recommendedRow['price'];
            $recommendedProductImage = $recommendedRow['img_main'];
            ?>

            <a href="?product_id=<?php echo $recommendedProductId; ?>" class="product-link">
                <!-- Use "?product_id=" to preserve other query parameters -->
                <div class="product-card">
                    <div class="card-image">
                        <img src="./images/<?= $recommendedProductImage; ?>" alt="<?= $recommendedProductName; ?>" draggable="false" />
                    </div>
                    <div class="card-content">
                        <h3><?php echo $recommendedRow['category']; ?></h3>
                        <h4><?php echo $recommendedProductName; ?></h4>
                        <div class="rating">
                            <!-- Your rating icons... -->
                            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
            </div>
                        </div>
                        <p>Rs <?php echo $recommendedProductPrice; ?></p>
                    </div>
                </div>
            </a>
            <?php
        }
        ?>
    </div>
</div>

        <?php include('footer.php') ?>

        <script src="js/script.js"></script>
        <script src="js/message.js"></script>
    </body>

    </html>

<?php
} else {
    echo "Invalid request.";
}
?>
