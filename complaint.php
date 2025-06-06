<?php
session_start();
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_id = $_SESSION["user_id"];
  $message = $_POST["message"];
  $product_id = $_POST["product_id"];
  $stmt = $conn->prepare("INSERT INTO complaints (user_id, product_id, message) VALUES (?, ?, ?)");
  $stmt->bind_param("iis", $user_id, $product_id, $message);
  $stmt->execute();
  echo "Complaint submitted!";
}
?>

<form method="POST">
  <input type="hidden" name="product_id" value="<?= $_GET['product_id'] ?>">
  <textarea name="message" required placeholder="Enter your complaint here..."></textarea><br>
  <button type="submit">Submit Complaint</button>
</form>
