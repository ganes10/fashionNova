<?php
require('db_connection.php');
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] != true) {
    header("location: adminlogin.php");
    exit();
}

// Fetch customer data
$sql = "SELECT * FROM customers";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Set up headers for CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="customer_report.csv"');

$output = fopen('php://output', 'w');

// CSV header
fputcsv($output, array('Customer ID', 'Full Name', 'Email', 'Mobile Number', 'Registered Date'));

// Fetch and output data
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
mysqli_close($conn);
?>