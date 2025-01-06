<?php
require('db_connection.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Optionally redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Retrieve user ID from session
$userid = $_SESSION['userid'];

// Prepare and execute SQL query to fetch user details
$stmt = $conn->prepare("SELECT * FROM customers WHERE customer_id = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile | Customer Dashboard</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/customerDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php $page = 'customer'; include('header.php'); ?>

    <!-- Logged in Customer's Profile Zone -->
    <div class="profile">
        <!-- Side Menu -->
        <div class="profile-category">
            <div class="profile-sidemenu">
                <div class="profile-sidemenu-item">
                    <a href="./customerDashboard.php">
                        <p><i class="fa-solid fa-table-cells-large"></i>Dashboard</p>
                    </a>
                </div>
                <div class="profile-sidemenu-item">
                    <a href="./customerOrders.php">
                        <p><i class="fa-solid fa-rectangle-list"></i>Orders</p>
                    </a>
                </div>
                <div class="profile-sidemenu-item active-sidemenu">
                    <a href="#">
                        <p><i class="fa-solid fa-money-check"></i>Profile</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="profile-details section-padding">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="card">
                        <h1>Profile Details</h1>
                        <div class="row">
                            <div class="row-1">
                                <h2>Fullname</h2>
                            </div>
                            <div class="row-2">
                                <p><?php echo htmlspecialchars($row["fullname"]); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row-1">
                                <h2>Email</h2>
                            </div>
                            <div class="row-2">
                                <p><?php echo htmlspecialchars($row["email"]); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row-1">
                                <h2>Phone</h2>
                            </div>
                            <div class="row-2">
                                <p><?php echo htmlspecialchars($row["phone"]); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div>
                    <h1>No Details Found</h1>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include('footer.php'); ?>
    <script src="js/script.js"></script>
</body>

</html>
