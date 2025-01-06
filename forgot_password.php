<?php
session_start();
require('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $useremail = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "SELECT * FROM customers WHERE email='$useremail'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        $userid = $row['customer_id'];

        // Generate a unique OTP
        $otp = rand(100000, 999999);

        // Insert into password_reset_tokens table
        $insertTokenQuery = "INSERT INTO password_reset_tokens (user_id, token, expiry_time) VALUES ('$userid', '$otp', NOW() + INTERVAL 1 HOUR)";
        mysqli_query($conn, $insertTokenQuery);

        $_SESSION['reset_user_id'] = $userid;
        $_SESSION['reset_otp'] = $otp;

        // Redirect to the OTP verification form
        header("location:password_verification.php");
        exit();
    } else {
        $_SESSION['message'] = "User doesn't exist";
        header("location:forgot_password.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
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

<!-- Display the forgot password form -->
<form action="<?php echo htmlspecialchars('forgot_password.php') ?>" method="POST" novalidate>
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
