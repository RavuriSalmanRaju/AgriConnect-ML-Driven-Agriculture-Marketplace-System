<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['reset_phone']) || !isset($_SESSION['otp_verified'])){
    header("Location: forgot_password.php");
    exit();
}

$phone = $_SESSION['reset_phone'];

if(isset($_POST['reset'])){
    $newpass = trim($_POST['new_password']);

    $hashed = password_hash($newpass, PASSWORD_DEFAULT);

    $conn->query("UPDATE farmers SET password='$hashed' WHERE phone='$phone'");
    $conn->query("DELETE FROM password_otp WHERE user_role='FARMER' AND phone='$phone'");

    session_destroy();
    echo "<script>alert('Password reset successful ✅ Please login'); window.location='login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
<div class="card shadow-sm">
<div class="card-body">
<h4 class="fw-bold">🔁 Reset Password (Farmer)</h4>

<form method="POST">
  <label class="form-label">New Password</label>
  <input type="password" name="new_password" class="form-control" required>
  <button name="reset" class="btn btn-success w-100 mt-3">Reset Password ✅</button>
</form>

</div>
</div>
</div>
</body>
</html>
