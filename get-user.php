<?php
session_start();
include "koneksi.php";

header('Content-Type: application/json');

if (!isset($_SESSION['nik'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Belum login"
    ]);
    exit;
}

$nik = $_SESSION['nik'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE nik='$nik'");
$user = mysqli_fetch_assoc($query);

if (!$user) {
    echo json_encode([
        "status" => "error",
        "message" => "User tidak ditemukan"
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "nama" => $user['nama_lengkap'],
    "nik" => $user['nik'],
    "email" => $user['email'],
    "alamat" => $user['alamat'],
    "rt" => $user['rt'],
    "rw" => $user['rw'],
    "kelurahan" => $user['kelurahan']
]);
?>