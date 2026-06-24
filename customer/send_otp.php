<?php
session_start();
include("../config/db.php");

$phone = trim($_POST['phone']);

$check = $conn->query("SELECT customer_id FROM customers WHERE phone='$phone' LIMIT 1");
if(!$check || $check->num_rows == 0){
    echo "<script>alert('Phone number not registered ❌'); window.location='forgot_password.php';</script>";
    exit();
}

$otp = rand(100000,999999);

// ✅ delete old otp (prevents duplicate otp)
$conn->query("DELETE FROM password_otp WHERE user_role='CUSTOMER' AND phone='$phone'");

// ✅ insert new otp
$conn->query("INSERT INTO password_otp(user_role, phone, otp) VALUES('CUSTOMER','$phone','$otp')");

// ✅ demo OTP alert (real app lo SMS API)
$_SESSION['reset_phone'] = $phone;

echo "<script>alert('Your OTP is: $otp'); window.location='verify_otp.php';</script>";
exit();
?>
