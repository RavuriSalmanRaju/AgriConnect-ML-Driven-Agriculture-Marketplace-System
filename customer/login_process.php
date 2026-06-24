<?php
session_start();
include("../config/db.php");

$phone = trim($_POST['phone']);
$pass  = trim($_POST['password']);

$sql = "SELECT * FROM customers WHERE phone='$phone' LIMIT 1";
$res = $conn->query($sql);

if($res && $res->num_rows > 0){

    $row = $res->fetch_assoc();

    if($row['status'] != 'ACTIVE'){
        echo "<script>alert('Account is Inactive (Deleted)'); window.location='login.php';</script>";
        exit();
    }

    // Plain text password check
    if($pass == $row['password']){

        $_SESSION['customer_id'] = $row['customer_id'];
        $_SESSION['customer_name'] = $row['name'];

        header("Location: dashboard.php");
        exit();

    } else {

        echo "<script>alert('Invalid password'); window.location='login.php';</script>";
        exit();

    }

} else {

    echo "<script>alert('Phone number not registered'); window.location='login.php';</script>";
    exit();

}
?>
