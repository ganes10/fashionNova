<?php
require('db_connection.php');
session_start();

// Fetch distinct categories from the database
$categoryQuery = "SELECT DISTINCT category FROM products";
$categoryResult = mysqli_query($conn, $categoryQuery);

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Products | FashionNOVA </title>
  <link rel="stylesheet" href="./style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      
.explore-category {
  display: flex;
  flex-direction: column;
}
.explore-products {
    display: flex;
    flex-wrap: wrap; /* Allow the items to wrap to the next line if there's not enough space */
    justify-content: space-around; /* Center the items horizontally with equal space between them */
  }

  .product {
    flex: 0 0 calc(33.33% - 20px); /* Adjust the width of each product item as per your requirement */
    margin: 10px; /* Add some margin for spacing between products */
  }

.explore-category h2 {
  text-align: center;
  font-size: 36px;
  line-height: 48px;
  font-weight: 700;
}

.explore-category span {
  text-align: center;
  padding-top: 0.5rem;
  padding-bottom: 1rem;
}

/* Product Section */
.products {
  display: flex;
  flex-direction: column;
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
.product-category {
  display: flex;
  flex-direction: column;
  margin-right: 10rem;
}

.product-category h2 {
  font-size: 36px;
  line-height: 48px;
  margin-bottom: 2rem;
}

.product-category-list {
  padding-top: 2rem;
}

.product-category-list h4 {
  font-size: 24px;
  line-height: 36px;
  padding: 0.5rem 0;
  text-align: center;
  cursor: pointer;
  color: black;
}

.category-link.active-link,
.category-link:hover {
  color: red;
}

.product-item {
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

.product-item:hover {
  box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.06);
}

.product-item img {
  width: 100%;
  height: 100%;
  border-radius: 10px;
  padding: 1rem 1rem 0rem;
}

.product-description {
  height: 100%;
  padding: 1rem 1.5rem;
}

.product-description h3 {
  color: #a5a7aa;
  font-weight: 700;
}

.product-description h4 {
  font-size: 20px;
  line-height: 28px;
  font-weight: 600;
}

.product-description p {
  font-size: 18px;
  line-height: 25px;
  font-weight: 500;
  margin: 0.3rem 0;
}

/* ProductDescription Page */
.detailedProduct {
  display: flex;
  flex-direction: row;
  padding: 4rem 6rem;
}

.detailedProduct-image {
  flex: 1;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

.image-list {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: space-between;
  margin-right: 10px;
}

.image-list img {
  width: 75px;
  height: 120px;
  border: 3px solid transparent;
  border-radius: 6px;
  cursor: pointer;
}

</style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>about us</h3>
        <p> <a href="home.php">HOME</a> / PRODUCTS </p>
    </div>

    <!-- Category Navigation -->
    <div class="product-category">
        <h2>Categories</h2>
        <div class="product-category-list">
            <?php
            while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                $category = $categoryRow['category'];
                echo '<h4 class="category-link" data-category="' . $category . '">' . $category . '</h4>';
            }
            ?>
        </div>
    </div>

    <!-- Explore Products -->
    <div class="explore-category">
        <h2>EXPLORE PRODUCTS</h2>

        <!-- All Category -->
        <div class="explore-products active-tab" id="all">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['product_id'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $img = $row['image'];
                    $desc = $row['description'];
                    ?>

                    <div class="product" data-category="<?php echo $row['category']; ?>" onclick="window.location.href='detailedProduct.php?product_id=<?php echo $product_id; ?>'">
                        <div class="product-image">
                            <img src="images/<?= $img; ?>" alt="<?php echo "$name" ?>" />
                        </div>
                        <div class="product-content">
                            <h4><?php echo $name; ?></h4>
                            <div class="rating">
                                <!-- Rating Star Icons -->
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i>
                            </div>
                            <p>Rs <?php echo $price; ?></p>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "NO DATA FOUND";
            }
            ?>
        </div>
    </div>

    <?php include('footer.php') ?>
    <script src="js/script.js"></script>

    <script>
        // JavaScript to handle category filtering
        document.addEventListener('DOMContentLoaded', function () {
            const categoryLinks = document.querySelectorAll('.category-link');
            const exploreProducts = document.querySelector('.explore-products');

            categoryLinks.forEach(link => {
                link.addEventListener('click', function () {
                    const selectedCategory = this.dataset.category;
                    exploreProducts.innerHTML = ''; // Clear existing products

                    // Fetch products based on the selected category
                    fetch('get_products_by_category.php?category=' + selectedCategory)
                        .then(response => response.json())
                        .then(products => {
                            products.forEach(product => {
                                const productElement = createProductElement(product);
                                exploreProducts.appendChild(productElement);
                            });
                        });
                });
            });
        });

        // Function to create a product element
        function createProductElement(product) {
            const productElement = document.createElement('div');
            productElement.classList.add('product');
            productElement.dataset.category = product.category;

            productElement.innerHTML = `
                <div class="product-image">
                    <img src="images/${product.image}" alt="${product.name}" />
                </div>
                <div class="product-content">
                    <h4>${product.name}</h4>
                    <div class="rating">
                        <!-- Rating Star Icons -->
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <p>Rs ${product.price}</p>
                </div>
            `;

            return productElement;
        }
    </script>
</body>

</html>
