<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $role = $_POST["role"];
  $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $password, $role);
  $stmt->execute();
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register - SA E-Commerce</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #ffeef2;
      font-family: 'Comic Sans MS', cursive, sans-serif;
    }
    .register-container {
      max-width: 450px;
      margin: 100px auto;
      background-color: #fff0f5;
      padding: 30px;
      border-radius: 15px;
      border: 2px solid #ffc0cb;
    }
    h2 {
      text-align: center;
      color: #ff69b4;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Create Account</h2>
    <form method="POST">
      <div class="mb-3">
        <input name="name" class="form-control" placeholder="Full Name" required>
      </div>
      <div class="mb-3">
        <input name="email" type="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="mb-3">
        <input name="password" type="password" class="form-control" placeholder="Password" required>
      </div>
      <div class="mb-3">
        <select name="role" class="form-select">
          <option value="buyer">Buyer</option>
          <option value="seller">Seller</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
  </div>
</body>
</html>
