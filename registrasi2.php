<?php
session_start();

// CEK apakah form benar-benar dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION['nik'] = $_POST['nik'] ?? '';
    $_SESSION['nama_lengkap'] = $_POST['nama_lengkap'] ?? '';
    $_SESSION['tempat_lahir'] = $_POST['tempat_lahir'] ?? '';
    $_SESSION['tanggal_lahir'] = $_POST['tanggal_lahir'] ?? '';
    $_SESSION['kelamin'] = $_POST['kelamin'] ?? '';
    $_SESSION['alamat'] = $_POST['alamat'] ?? '';
    $_SESSION['rt'] = $_POST['rt'] ?? '';
    $_SESSION['rw'] = $_POST['rw'] ?? '';
    $_SESSION['kelurahan'] = $_POST['kelurahan'] ?? '';

    header("Location: registrasi2.html");
    exit;

} else {
  
    header("Location: registrasi.html");
    exit;
}
?>