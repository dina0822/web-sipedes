<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['nik'])) {
    header("Location: login.html");
    exit;
}

$nik = $_SESSION['nik'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE nik='$nik'");
$user = mysqli_fetch_assoc($query);
?>
