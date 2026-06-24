<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['reset_phone'])){
    header("Location: forgot_password.php");
    exit();
}

$phone = $_SESSION['reset_phone'];

if(isset($_POST['verify'])){
    $userOtp = trim($_POST['otp']);

    $res = $conn->query("SELECT * FROM password_otp 
                         WHERE user_role='FARMER' AND phone='$phone' 
                         ORDER BY id DESC LIMIT 1");

    if($res && $res->num_rows > 0){
        $row = $res->fetch_assoc();

        if($row['otp'] == $userOtp){
            $_SESSION['otp_verified'] = true;
            header("Location: reset_password.php");
            exit();
        } else {
            echo "<script>alert('Invalid OTP ❌');</script>";
        }
    } else {
        echo "<script>alert('OTP expired or not found ❌');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Verify OTP</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
<div class="card shadow-sm">
<div class="card-body">
<h4 class="fw-bold">✅ Verify OTP (Farmer)</h4>

<form method="POST">
  <label class="form-label">Enter OTP</label>
  <input type="text" name="otp" class="form-control" required>
  <button name="verify" class="btn btn-success w-100 mt-3">Verify OTP</button>
</form>

</div>
</div>
</div>
</body>
</html>
