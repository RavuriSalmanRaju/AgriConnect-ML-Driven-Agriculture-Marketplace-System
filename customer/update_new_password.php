<?php
session_start();
include("../config/db.php");

// ✅ Must come only after OTP verified
if (!isset($_SESSION['reset_phone']) || !isset($_SESSION['otp_verified'])) {
    header("Location: forgot_password.php");
    exit();
}

$phone = $_SESSION['reset_phone'];
$phone = $conn->real_escape_string($phone);

$newPassword = $_POST['new_password'] ?? "";
$confirmPassword = $_POST['confirm_password'] ?? "";

$newPassword = trim($newPassword);
$confirmPassword = trim($confirmPassword);

if ($newPassword == "" || $confirmPassword == "") {
    echo "<h3 style='color:red;'>Password fields cannot be empty ❌</h3>";
    echo "<a href='verify_otp.php'>Try Again</a>";
    exit();
}

if ($newPassword !== $confirmPassword) {
    echo "<h3 style='color:red;'>Passwords do not match ❌</h3>";
    echo "<a href='verify_otp.php'>Try Again</a>";
    exit();
}

if (strlen($newPassword) < 4) {
    echo "<h3 style='color:red;'>Password too short ❌</h3>";
    echo "<a href='verify_otp.php'>Try Again</a>";
    exit();
}

// ✅ Hash password
$hashed = password_hash($newPassword, PASSWORD_BCRYPT);

// ✅ Update password + clear otp
$sql = "UPDATE customers 
        SET password='$hashed', otp_code=NULL, otp_expiry=NULL 
        WHERE phone='$phone'";

if ($conn->query($sql) === TRUE) {

    // ✅ Clear sessions
    unset($_SESSION['reset_phone']);
    unset($_SESSION['otp_verified']);
    if (isset($_SESSION['demo_otp'])) unset($_SESSION['demo_otp']);

    // ✅ Success UI
    echo "
    <html>
    <head>
      <title>Password Updated</title>
      <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
      <link rel='stylesheet' href='../assets/css/style.css'>
    </head>
    <body class='bg-farm'>
      <div class='page-wrap'>
        <div class='container'>
          <div class='agri-card'>
            <div class='agri-card-header'>
              <h2 class='agri-title'>Password Updated ✅</h2>
              <p class='agri-subtitle'>Your password has been changed successfully.</p>
            </div>
            <div class='p-4 text-center'>
              <a href='login.php' class='btn btn-agri w-100'>Go to Login ✅</a>
            </div>
          </div>
        </div>
      </div>
    </body>
    </html>
    ";
    exit();

} else {
    echo "Error: " . $conn->error;
}
?>
