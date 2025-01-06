<?php
require('db_connection.php');
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit();
}

if (isset($_SESSION['userid'])) {
  $userid = $_SESSION['userid'];
}

$sql = "SELECT * FROM orders where `customer_id` = $userid";
$result = mysqli_query($conn, $sql);

if (isset($_POST['generate_report'])) {
  $filename = "orders_report.csv";
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="' . $filename . '"');

  $output = fopen('php://output', 'w');

  // Output CSV column headers
  fputcsv($output, array('Order ID', 'Product Name', 'Address', 'Payment Type', 'Order Status', 'Order Created'));

  // Output data from the recent orders table
  while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
  }

  fclose($output);
  exit();
}
?>
