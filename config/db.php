<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "agriconnect_db";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
