<?php
session_start();
include 'db.php';
if ($_SESSION["role"] !== "seller") {
  echo "Access denied!";
  exit;
}
$id = $_POST["id"];
$conn->query("DELETE FROM products WHERE product_id = $id AND seller_id = {$_SESSION['user_id']}");
header("Location: inventory.php");
?>
