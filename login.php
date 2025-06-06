<?php
session_start();
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $user = $stmt->get_result()->fetch_assoc();
  if ($user && password_verify($password, $user["password"])) {
    $_SESSION["user_id"] = $user["user_id"];
    $_SESSION["role"] = $user["role"];
    header("Location: dashboard.php");
  } else {
    $error = "Invalid login.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color:#ffeef2; font-family:'Comic Sans MS', cursive;">
  <div class="container mt-5" style="max-width: 400px;">
    <a href="index.php" class="btn btn-outline-danger mb-3">← Back to Home</a>
    <h2 class="text-center text-danger">Login</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</body>
</html>
