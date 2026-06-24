<?php
include("../config/db.php");

$crop = $_GET['crop'] ?? '';

$sql = "SELECT market_price
        FROM market_prices
        WHERE crop_name='$crop'
        LIMIT 1";

$result = $conn->query($sql);

if($result && $result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    echo $row['market_price'];
}
else
{
    echo "0";
}
?>