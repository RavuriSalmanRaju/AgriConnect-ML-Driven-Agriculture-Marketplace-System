<?php
session_start();
include("../config/db.php");

$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$address = trim($_POST['address']);
$password = trim($_POST['password']);

if ($name == "" || $phone == "" || $address == "" || $password == "") {
    echo "<script>alert('All fields are required!'); window.location='register.php';</script>";
    exit();
}

// ✅ Check if phone already exists
$check = $conn->query("SELECT customer_id FROM customers WHERE phone='$phone' LIMIT 1");

if ($check && $check->num_rows > 0) {
    echo "<script>alert('This phone number is already registered! Please login.'); window.location='login.php';</script>";
    exit();
}

// ✅ Insert customer
$sql = "INSERT INTO customers (name, phone, address, password, status, created_at)
        VALUES ('$name', '$phone', '$address', '$password', 'ACTIVE', NOW())";

if ($conn->query($sql)) {
    echo "<script>alert('Customer account created successfully ✅ Please login'); window.location='login.php';</script>";
    exit();
} else {
    echo "<script>alert('Registration Failed ❌ Try again'); window.location='register.php';</script>";
    exit();
}
?>
