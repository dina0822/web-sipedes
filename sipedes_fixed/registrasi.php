<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email_registrasi'] ?? '';
    $password = $_POST['password'] ?? '';
    $konfirmasi = $_POST['konfirmasi_password'] ?? '';

    if ($password !== $konfirmasi) {
        echo "<script>
            alert('Password tidak sama!');
            window.history.back();
        </script>";
        exit;
    }

    $email = mysqli_real_escape_string($conn, $email);
    $password_db = mysqli_real_escape_string($conn, $password);

    $cek_email = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    if (mysqli_num_rows($cek_email) > 0) {
        echo "<script>
            alert('Email sudah terdaftar!');
            window.location='registrasi.html';
        </script>";
        exit;
    }

    // Akun dibuat cukup dengan email & password.
    // NIK dan data diri lain akan dilengkapi otomatis saat user
    // mengajukan surat pertama kali (lihat user/proses-pengajuan.php).
    $query = "INSERT INTO user
        (nik, email, password, nama_lengkap, tempat_lahir, tanggal_lahir, kelamin, alamat, rt, rw, kelurahan)
        VALUES
        ('', '$email', '$password_db', '', '', NULL, '', '', '', '', '')";

    if (mysqli_query($conn, $query)) {
        header("Location: user/login.html");
        exit;
    } else {
        echo "Registrasi gagal: " . mysqli_error($conn);
        exit;
    }
}

header("Location: registrasi.html");
exit;
