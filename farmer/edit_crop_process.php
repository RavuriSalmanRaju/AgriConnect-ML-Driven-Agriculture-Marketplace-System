<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$farmer_id = $_SESSION['farmer_id'];

$crop_id = $_POST['crop_id'];
$crop_name = $_POST['crop_name'];
$quantity = $_POST['quantity'];
$price_per_kg = $_POST['price_per_kg'];

$sql = "UPDATE crops 
        SET crop_name='$crop_name', quantity='$quantity', price_per_kg='$price_per_kg'
        WHERE crop_id='$crop_id' AND farmer_id='$farmer_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: my_crops.php");
    exit();
} else {
    echo "<h3 style='color:red;'>Update Error ❌</h3>";
    echo $conn->error;
}
?>
