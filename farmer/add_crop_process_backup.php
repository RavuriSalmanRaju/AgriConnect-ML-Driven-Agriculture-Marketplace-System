<?php
session_start();
include("../config/db.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['farmer_id'])) {
    die("Farmer not logged in");
}

$farmer_id = $_SESSION['farmer_id'];
$crop_name = $_POST['crop_name'];
$quantity  = $_POST['quantity'];
$price     = $_POST['price_per_kg'];

// Image upload
$image_name = $_FILES['crop_image']['name'];
$tmp_name   = $_FILES['crop_image']['tmp_name'];

$upload_dir = "../uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$final_image = time() . "_" . $image_name;
move_uploaded_file($tmp_name, $upload_dir . $final_image);

// Insert query

        $sql = "INSERT INTO crops 
        (farmer_id, crop_name, quantity, price_per_kg, crop_image)
        VALUES 
        ('$farmer_id', '$crop_name', '$quantity', '$price', '$final_image')";


if ($conn->query($sql)) {
    header("Location: my_crops.php");
    exit();
} else {
    echo "DB Error: " . $conn->error;
}
?>
