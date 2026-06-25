<?php
include("../config/db.php");

$crop = isset($_GET['crop']) ? trim($_GET['crop']) : '';

if ($crop == "") {
    echo "0";
    exit();
}

$today = date("Y-m-d");

/*
==========================================
Get Today's Market Price
==========================================
*/

$sql = "SELECT market_price
        FROM market_prices
        WHERE crop_name = '$crop'
        AND price_date = '$today'
        LIMIT 1";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    $row = $result->fetch_assoc();
    echo number_format($row['market_price'], 2);

} else {

    /*
    If today's price is not available,
    return latest available price.
    */

    $sql = "SELECT market_price
            FROM market_prices
            WHERE crop_name = '$crop'
            ORDER BY price_date DESC
            LIMIT 1";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {

        $row = $result->fetch_assoc();
        echo number_format($row['market_price'], 2);

    } else {

        echo "0";

    }

}
?>