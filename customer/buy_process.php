<?php
session_start();
include("../config/db.php");
if (!isset($_SESSION['customer_id'])) { header("Location: login.php"); exit(); }

$customer_id = $_SESSION['customer_id'];
$crop_id = (int)$_POST['crop_id'];
$qty = (int)$_POST['buy_qty'];

$crop = $conn->query("SELECT price_per_kg FROM crops WHERE crop_id=$crop_id")->fetch_assoc();
$total = $qty * $crop['price_per_kg'];

$conn->query("INSERT INTO orders (customer_id,crop_id,quantity,total_amount,status)
              VALUES ($customer_id,$crop_id,$qty,$total,'PLACED')");

header("Location: my_orders.php");
exit();
