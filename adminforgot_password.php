<?php
require('db_connection.php');

$adminforgotpassword = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $adminemail = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "SELECT * FROM admins WHERE email='$adminemail'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        $adminid = $row['admin_id'];

        // Generate a unique OTP
        $otp = rand(100000, 999999);

        // Insert into admin_password_reset_tokens table
        $insertTokenQuery = "INSERT INTO admin_password_reset_tokens (admin_id, token, expiry_time) VALUES ('$adminid', '$otp', NOW() + INTERVAL 1 HOUR)";
        mysqli_query($conn, $insertTokenQuery);

        session_start();
        $_SESSION['admin_reset_id'] = $adminid;
        $_SESSION['admin_reset_otp'] = $otp;

        // Redirect to the OTP verification form
        header("location:admin_password_verification.php");
        exit();
    } else {
        $_SESSION['message'] = "Admin user doesn't exist";
        header("location:adminforgot_password.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Forgot Password</title>
    <!-- Add your CSS styling here -->
    <style>
        /* Add your styling here */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 400px;
    width: 100%;
}

input {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    box-sizing: border-box;
}

.button {
    background-color: #7065D4;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

label {
    display: block;
    text-align: left;
    margin-bottom: 5px;
}

    </style>
</head>
<body>

<!-- Display the admin forgot password form -->
<form action="<?php echo htmlspecialchars('adminforgot_password.php') ?>" method="POST" novalidate>
    <h2>Forgot Your Password</h2>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p style="color: red;">' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    ?>
    <input type="email" name="email" placeholder="Enter your email" required>
    <input type="submit" class="button" value="Submit">
</form>

</body>
</html>
