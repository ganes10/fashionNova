<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}

$loggedin = false; // Assume the user is not logged in by default

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
    $user_id = $_SESSION['user_id']; // Assuming your user ID is stored in the session
}

?>

<header class="header">

    <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="https://www.facebook.com/" class="fab fa-facebook-f"></a>
                <a href="https://twitter.com/?lang=en" class="fab fa-twitter"></a>
                <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
                <a href="https://np.linkedin.com/" class="fab fa-linkedin"></a>
            </div>
            <p> NEW <a href="login.php">LOGIN</a> | <a href="register.php">REGISTER</a>| <a href="logout.php">LOGOUT</a></p>
        </div>
    </div>

    <div class="header-2">
        <div class="flex">
            <a href="home.php" class="logo">FashionNOVA</a>

            <nav class="navbar">
                <a href="home.php">HOME</a>
                <a href="about.php">ABOUT</a>
                <a href="products.php">PRODUCTS</a>
                <a href="contact.php">CONTACT</a>
                <!-- <a href="orders.php">ORDERS</a> -->
            </nav>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <a href="search_page.php" class="fas fa-search"></a>

                <div id="user-btn">
                    <a href="<?php echo $loggedin ? 'customer_dashboard.php' : 'login.php'; ?>" class="fas fa-user"></a>
                </div>

                <?php
                $cart_rows_number = 0; // Set to 0 by default

                if ($loggedin) {
                    $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    $cart_rows_number = mysqli_num_rows($select_cart_number);
                } elseif (isset($_SESSION['cart'])) {
                    // If the user is not logged in, but there is a cart session set
                    $cart_rows_number = count($_SESSION['cart']);
                }
                ?>

                <a href="cart.php"><i class="fas fa-shopping-cart"></i> <span><?php echo $cart_rows_number; ?></span></a>

                <?php if ($loggedin) { ?>
                    <!-- Display logout option if logged in -->
                    <a href="logout.php" class="logout-link">Logout</a>
                <?php } ?>
            </div>

            <div class="user-box">
                <?php if (!$loggedin) { ?>
                    <p><a href="login.php" class="<?php if ($page === 'login') {
                        echo 'active';
                    } ?>"><i class="fa-solid fa-user"></i></a></p>
                    <p><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></p>
                <?php } else { ?>
                    <p><a href="customerDashboard.php" class="<?php if ($page === 'customer') {
                        echo 'active';
                    } ?>"><i class="fa-solid fa-user"></i></a></p>
                    <p><a href="cart.php" class="<?php if ($page === 'cart') {
                        echo 'active';
                    } ?>"><i class="fa-solid fa-cart-shopping"></i></a></p>
                    <p><a class="hide-logout" href="logout.php">LogOut</a></p>
                <?php } ?>
            </div>
        </div>
    </div>

</header>
