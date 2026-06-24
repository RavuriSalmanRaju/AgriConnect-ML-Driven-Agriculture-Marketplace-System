<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];
$order_id = (int)$_GET['id'];

// Only customer's own PLACED order
$check = "SELECT order_id FROM orders
          WHERE order_id=$order_id
          AND customer_id=$customer_id
          AND UPPER(TRIM(status))='PLACED'";

$res = $conn->query($check);

if ($res && $res->num_rows == 1) {
    $conn->query("DELETE FROM orders WHERE order_id=$order_id");
}

header("Location: my_orders.php");
exit();
