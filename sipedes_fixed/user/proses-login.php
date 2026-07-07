<?php
session_start();
include "../koneksi.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$email_esc = mysqli_real_escape_string($conn, $email);
$query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email_esc'");

if (!$query || mysqli_num_rows($query) === 0) {
    echo "<script>
        alert('Email tidak ditemukan!');
        window.location = 'login.html';
    </script>";
    exit;
}

$data = mysqli_fetch_assoc($query);

if (trim($password) == trim($data['password'])) {

    $_SESSION['id'] = $data['id'];
    $_SESSION['nik'] = $data['nik'];
    $_SESSION['nama'] = $data['nama_lengkap'];

    echo "<script>
        alert('Login berhasil!');
        window.location = 'dashboard.html';
    </script>";
    exit;

} else {
    echo "<script>
        alert('Password salah!');
        window.location = 'login.html';
    </script>";
    exit;
}
