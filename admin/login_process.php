<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === "admin" && $password === "admin123") {
    $_SESSION['admin'] = true;
    $_SESSION['admin_name'] = "Admin";
    header("Location: dashboard.php");
    exit();
} else {
    echo "<h3 style='color:red;'>Invalid Admin Credentials ❌</h3>";
    echo "<a href='login.php'>Go back</a>";
}
?>
