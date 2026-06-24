<?php
session_start();
include("../config/db.php");
if (!isset($_SESSION['customer_id'])) { header("Location: login.php"); exit(); }

$cid=$_SESSION['customer_id'];
$id=(int)$_GET['id'];

$conn->query("UPDATE orders SET status='CANCELLED'
              WHERE order_id=$id AND customer_id=$cid AND status='PLACED'");

header("Location: my_orders.php");
exit();
