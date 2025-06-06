<?php
session_start();
include 'db.php';
if ($_SESSION["role"] !== "admin") {
  echo "Access denied!";
  exit;
}

$users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc();
$products = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc();
$sales = $conn->query("SELECT COUNT(*) AS total FROM sales")->fetch_assoc();

echo "<h2>Platform Report</h2>";
echo "<p>Total Users: {$users['total']}</p>";
echo "<p>Total Products: {$products['total']}</p>";
echo "<p>Total Sales: {$sales['total']}</p>";
?>
