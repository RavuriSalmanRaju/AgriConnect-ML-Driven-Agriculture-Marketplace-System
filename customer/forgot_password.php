<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Customer Forgot Password</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <h4 class="fw-bold">🔑 Customer Forgot Password</h4>

      <form method="POST" action="send_otp.php">
        <label class="form-label">Phone Number</label>
        <input type="text" name="phone" class="form-control" required>
        <button class="btn btn-success w-100 mt-3">Send OTP ✅</button>
      </form>

      <a href="login.php" class="btn btn-secondary w-100 mt-2">⬅ Back</a>
    </div>
  </div>
</div>

</body>
</html>
