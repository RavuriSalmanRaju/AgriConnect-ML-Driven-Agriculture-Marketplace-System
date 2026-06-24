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
$crop_id = $_GET['id'];

// ✅ First: get image path of this crop (only farmer can delete own crop)
$get = "SELECT crop_image FROM crops WHERE crop_id='$crop_id' AND farmer_id='$farmer_id'";
$result = $conn->query($get);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $imagePath = "../" . $row['crop_image']; // full server path

    // ✅ Delete crop from DB
    $delete = "DELETE FROM crops WHERE crop_id='$crop_id' AND farmer_id='$farmer_id'";
    if ($conn->query($delete) === TRUE) {

        // ✅ Delete image file from uploads folder (optional safe delete)
        if (!empty($row['crop_image']) && file_exists($imagePath)) {
            unlink($imagePath);
        }

        header("Location: my_crops.php");
        exit();

    } else {
        echo "Delete Error: " . $conn->error;
    }
} else {
    echo "<h3 style='color:red;'>Invalid Crop or Access Denied ❌</h3>";
    echo "<a href='my_crops.php'>Go Back</a>";
}
?>
