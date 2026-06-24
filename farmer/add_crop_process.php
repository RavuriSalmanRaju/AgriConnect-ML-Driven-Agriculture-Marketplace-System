<?php
session_start();
include("../config/db.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['farmer_id'])) {
    die("Farmer not logged in");
}

$farmer_id = $_SESSION['farmer_id'];

$crop_name = trim($_POST['crop_name']);
$quantity  = (int)$_POST['quantity'];
$price     = (float)$_POST['price_per_kg'];

/* MARKET PRICE CHECK */
$market = $conn->query("
    SELECT market_price
    FROM market_prices
    WHERE crop_name='$crop_name'
    ORDER BY price_date DESC
    LIMIT 1
");

if($market && $market->num_rows > 0){

    $marketPrice = $market->fetch_assoc()['market_price'];

    if($price > $marketPrice){

        echo "<script>
        alert('Warning!\\n\\nCrop: $crop_name\\nMarket Price: ₹$marketPrice / Kg\\nYour Price: ₹$price / Kg\\n\\nYou cannot sell above today\\'s market price.');
        window.location='add_crop.php';
        </script>";
        exit();
    }
}

/* IMAGE UPLOAD */
$image_name = $_FILES['crop_image']['name'];
$tmp_name   = $_FILES['crop_image']['tmp_name'];

$upload_dir = "../uploads/";

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$final_image = time() . "_" . $image_name;

move_uploaded_file(
    $tmp_name,
    $upload_dir . $final_image
);

/* INSERT CROP */
$sql = "
INSERT INTO crops
(farmer_id,crop_name,quantity,price_per_kg,crop_image,status)
VALUES
('$farmer_id','$crop_name','$quantity','$price','$final_image','AVAILABLE')
";

if ($conn->query($sql)) {

    echo "<script>
    alert('Crop Added Successfully');
    window.location='my_crops.php';
    </script>";

} else {

    echo 'DB Error: ' . $conn->error;

}
?>
