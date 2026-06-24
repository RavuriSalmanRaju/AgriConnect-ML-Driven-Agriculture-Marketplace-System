<?php
session_start();
include("../config/db.php");

$phone = trim($_POST['phone']);

$check = $conn->query("SELECT farmer_id FROM farmers WHERE phone='$phone' LIMIT 1");
if(!$check || $check->num_rows == 0){
    echo "<script>alert('Phone number not registered ❌'); window.location='forgot_password.php';</script>";
    exit();
}

$otp = rand(100000,999999);

// ✅ delete old otp (prevents duplicate otp issue)
$conn->query("DELETE FROM password_otp WHERE user_role='FARMER' AND phone='$phone'");

// ✅ insert new otp
$conn->query("INSERT INTO password_otp(user_role, phone, otp) VALUES('FARMER','$phone','$otp')");

// ✅ demo purpose: show OTP in alert (Real project: SMS API)
$_SESSION['reset_phone'] = $phone;

echo "<script>alert('Your OTP is: $otp'); window.location='verify_otp.php';</script>";
exit();
?>
