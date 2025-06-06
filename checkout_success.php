<?php
session_start();
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Checkout Complete</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body { background-color: #ffeef2; font-family: 'Comic Sans MS', cursive; text-align: center; margin-top: 100px; }
  </style>
</head>
<body>
  <h2>🎉 Thank you! Your payment was successful.</h2>
  <a href="index.php" class="btn btn-outline-success mt-4">Back to Home</a>
</body>
</html>
