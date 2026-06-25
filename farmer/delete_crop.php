<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: my_crops.php");
    exit();
}

$farmer_id = $_SESSION['farmer_id'];
$crop_id = intval($_GET['id']);

// Get crop details
$sql = "SELECT * FROM crops
        WHERE crop_id='$crop_id'
        AND farmer_id='$farmer_id'";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<h3 style='color:red;'>Crop not found or Access Denied ❌</h3>";
    exit();
}

$row = $result->fetch_assoc();

// Delete image if exists
if (!empty($row['crop_image'])) {

    $image = "../uploads/" . basename($row['crop_image']);

    if (file_exists($image)) {
        unlink($image);
    }

}

// Delete crop
$conn->query("
DELETE FROM crops
WHERE crop_id='$crop_id'
AND farmer_id='$farmer_id'
");

header("Location: my_crops.php?deleted=1");
exit();
?>