<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="customer_dashboard.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <?php $page = 'customer'; include('header.php') ?>

    <div class="profile">
        <div class="profile-category">
            <div class="profile-sidemenu">
                <div class="profile-sidemenu-item active-sidemenu">
                    <a href="#">
                        <p><i class="fa-solid fa-table-cells-large"></i>Dashboard</p>
                    </a>
                </div>
                <div class="profile-sidemenu-item">
                    <a href="orders.php">
                        <p><i class="fa-solid fa-rectangle-list"></i>Orders</p>
                    </a>
                </div>
                <div class="profile-sidemenu-item">
                    <a href="./customerDetails.php">
                        <p><i class="fa-solid fa-money-check"></i>Details</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="welcome-section">
            <div class="welcome-header">
                <h1>Welcome <?php echo isset($result) ? $row['fullname'] : ''; ?></h1>
            </div>

            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo isset($totalorders) ? $totalorders['TotalOrders'] : '0'; ?></div>
                        <div class="cardName">TOTAL ORDERS</div>
                    </div>
                    <div class="iconBx">
                        <i class="fa-solid fa-rectangle-list"></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">TOTAL TRANSACTIONS</div>
                    </div>
                    <div class="iconBx">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">TOTAL PURCHASES</div>
                    </div>
                    <div class="iconBx">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">MY WALLET</div>
                    </div>
                    <div class="iconBx">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">Rewards</div>
                    </div>
                    <div class="iconBx">
                        <i class="fas fa-gift"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- 
    <div class="bottom-menu">
        <div class="bottom-menu-item active-bottom">
            <a href="#">
                <i class="fa-solid fa-table-cells-large"></i>
                <p>Dashboard</p>
            </a>
        </div>
        <div class="bottom-menu-item">
            <a href="./customerOrders.php">
                <i class="fa-solid fa-rectangle-list"></i>
                <p>Orders</p>
            </a>
        </div>
        <div class="bottom-menu-item">
            <a href="./customerDetails.php">
                <i class="fa-solid fa-money-check"></i>
                <p>Details</p>
            </a>
        </div>
    </div> -->

    <?php include('footer.php') ?>
    <script src="js/script.js"></script>
</body>

</html>
 