<?php
session_start();
include 'db.php';
$product_id = $_POST["product_id"];
$buyer_id = $_SESSION["user_id"];
$stmt = $conn->prepare("INSERT INTO sales (product_id, buyer_id) VALUES (?, ?)");
$stmt->bind_param("ii", $product_id, $buyer_id);
$stmt->execute();
$conn->query("UPDATE products SET sold = 1 WHERE product_id = $product_id");
echo "Purchase successful!";
?>
