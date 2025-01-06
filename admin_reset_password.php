<?php
session_start();
require('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password = filter_input(INPUT_POST, "new_password", FILTER_SANITIZE_SPECIAL_CHARS);
    $confirm_password = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS);

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        $_SESSION['message'] = "Passwords do not match.";
        header("location:admin_reset_password.php");
        exit();
    }

    // Get admin ID from the session or however you obtain it
    $adminid = isset($_SESSION['admin_reset_id']) ? $_SESSION['admin_reset_id'] : null;

    // Update the password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $updatePasswordQuery = "UPDATE admins SET password = '$hashed_password' WHERE admin_id = '$adminid'";
    mysqli_query($conn, $updatePasswordQuery);

    // Delete the used token
    $deleteTokenQuery = "DELETE FROM admin_password_reset_tokens WHERE admin_id = '$adminid'";
    mysqli_query($conn, $deleteTokenQuery);

    $_SESSION['success_msg'] = "Password reset successful. You can now log in with your new password.";

    // Clear admin_reset_id in the session
    unset($_SESSION['admin_reset_id']);

    header("location:adminlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reset Password</title>
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

<!-- Display the password reset form for admin -->
<form action="admin_reset_password.php" method="POST" novalidate>
    <h2>Reset Your Password</h2>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p style="color: red;">' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    ?>
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required>
    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" name="confirm_password" required>
    <input type="submit" class="button" value="Reset Password">
</form>

</body>
</html>
