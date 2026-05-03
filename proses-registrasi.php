<?php
session_start();
include "koneksi.php";

$nik = $_POST['nik'];
$email = $_POST['email_registrasi'];
$nama_lengkap = $_POST['nama_lengkap'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$kelamin = $_POST['kelamin'];
$alamat = $_POST['alamat'];
$rt = $_POST['rt'];
$rw = $_POST['rw'];
$kelurahan = $_POST['kelurahan'];

$password = $_POST['password'];
$konfirmasi = $_POST['konfirmasi_password'];

if ($password !== $konfirmasi) {
    echo "<script>
        alert('Password tidak sama!');
        window.history.back();
    </script>";
    exit;
}

$cek_nik = mysqli_query($conn, "SELECT * FROM user WHERE nik='$nik'");
if (mysqli_num_rows($cek_nik) > 0) {
    echo "<script>
        alert('NIK sudah terdaftar!');
        window.history.back();
    </script>";
    exit;
}

$cek_email = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
if (mysqli_num_rows($cek_email) > 0) {
    echo "<script>
        alert('Email sudah terdaftar!');
        window.history.back();
    </script>";
    exit;
}

$query = "INSERT INTO user 
(nik, email, password, nama_lengkap, tempat_lahir, tanggal_lahir, kelamin, alamat, rt, rw, kelurahan)
VALUES
('$nik', '$email', '$password', '$nama_lengkap', '$tempat_lahir', '$tanggal_lahir', '$kelamin', '$alamat', '$rt', '$rw', '$kelurahan')";

if (mysqli_query($conn, $query)) {
    $_SESSION['nik'] = $nik;
    $_SESSION['nama'] = $nama_lengkap;

    echo "<script>
        alert('Registrasi berhasil!');
        window.location = 'dashboard.html';
    </script>";
    exit;
} else {
    echo "Registrasi gagal: " . mysqli_error($conn);
}
?>