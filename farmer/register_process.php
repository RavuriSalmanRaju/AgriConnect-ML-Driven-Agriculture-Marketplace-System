<?php
session_start();
include("../config/db.php");

$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$location = trim($_POST['location']);
$password = trim($_POST['password']);

if ($name == "" || $phone == "" || $location == "" || $password == "") {
    echo "<script>alert('All fields are required!'); window.location='register.php';</script>";
    exit();
}

// ✅ Check if phone already exists
$check = $conn->query("SELECT farmer_id FROM farmers WHERE phone='$phone' LIMIT 1");

if ($check && $check->num_rows > 0) {
    echo "<script>alert('This phone number is already registered! Please login.'); window.location='login.php';</script>";
    exit();
}

// ✅ Insert farmer
$sql = "INSERT INTO farmers (name, phone, location, password, status, created_at)
        VALUES ('$name', '$phone', '$location', '$password', 'ACTIVE', NOW())";

if ($conn->query($sql)) {
    echo "<script>alert('Account created successfully ✅ Please login'); window.location='login.php';</script>";
    exit();
} else {
    echo "<script>alert('Registration Failed ❌ Try again'); window.location='register.php';</script>";
    exit();
}
?>
