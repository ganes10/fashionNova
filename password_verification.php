<?php
session_start();
require('db_connection.php');

// Check if the OTP verification form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $enteredOTP = filter_input(INPUT_POST, "otp", FILTER_SANITIZE_SPECIAL_CHARS);
    $userid = isset($_SESSION['reset_user_id']) ? $_SESSION['reset_user_id'] : null;
    $storedOTP = isset($_SESSION['reset_otp']) ? $_SESSION['reset_otp'] : null;

    // Check if entered OTP matches the stored OTP
    if ($enteredOTP == $storedOTP) {
        // OTP verification successful, clear session variables
        unset($_SESSION['reset_otp']);

        // Redirect to the reset password form
        header("location:reset_password.php");
        exit();
    } else {
        $_SESSION['message'] = "Invalid OTP. Please try again.";
        header("location:password_verification.php");  // Redirect back to OTP verification
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
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
    </style>
</head>
<body>

<!-- Display the OTP verification form -->
<form action="<?php echo htmlspecialchars('password_verification.php') ?>" method="POST" novalidate>
    <h2>OTP Verification</h2>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p style="color: red;">' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    ?>
    <label for="otp">Enter the OTP sent to your email:</label>
    <input type="text" name="otp" required>
    <input type="submit" class="button" value="Verify OTP">
</form>

</body>
</html>
