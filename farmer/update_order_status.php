<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$order_id = intval($_GET['id']);
$status   = $_GET['status'];

// Update order status
$conn->query("UPDATE orders SET status='$status' WHERE order_id=$order_id");

// Get customer id
$res = $conn->query("SELECT customer_id FROM orders WHERE order_id=$order_id");
$row = $res->fetch_assoc();
$customer_id = $row['customer_id'];

// Notification message
$msg = "";
if($status=="ACCEPTED"){
    $msg = "Your order #$order_id has been ACCEPTED by farmer.";
}
if($status=="DELIVERED"){
    $msg = "Your order #$order_id has been DELIVERED successfully.";
}

if($msg!=""){
    $conn->query("
        INSERT INTO notifications(customer_id,message)
        VALUES($customer_id,'$msg')
    ");
}

header("Location: orders.php");
exit();
