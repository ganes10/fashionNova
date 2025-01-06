<?php
require('db_connection.php');
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] != true) {
    header("location: adminlogin.php");
    exit();
}

$adminid = $_SESSION['adminid'];

// Fetch orders data
$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Set up headers for CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="order_report.csv"');

$output = fopen('php://output', 'w');

// CSV header
fputcsv($output, array('Order ID', 'Customer ID', 'Customer Name', 'Product Name', 'Email', 'Address', 'Payment Type', 'Order Status', 'Order Created'));

// Fetch and output data
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
mysqli_close($conn);
?>
