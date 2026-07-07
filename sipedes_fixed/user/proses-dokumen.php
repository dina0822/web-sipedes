<?php
session_start();

include "../koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit;
}

$id_pengajuan = $_SESSION['id_pengajuan'];

$upload_dir = "uploads/";

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

function uploadFile($name, $dir)
{
    if (!isset($_FILES[$name]) || $_FILES[$name]['error'] != 0) {
        return "";
    }

    $filename = time() . "_" . basename($_FILES[$name]['name']);
    $target = $dir . $filename;

    move_uploaded_file($_FILES[$name]['tmp_name'], $target);

    return $filename;
}

// upload file
$ktp = uploadFile('ktp', $upload_dir);
$kk = uploadFile('kk', $upload_dir);
$surat_rt = uploadFile('surat_rt', $upload_dir);
$lain = uploadFile('lain', $upload_dir);

// update database
$query = "UPDATE pengajuan SET 
            foto_ktp='$ktp',
            foto_kk='$kk',
            foto_surat_rt='$surat_rt'
          WHERE id='$id_pengajuan'";

mysqli_query($conn, $query);

// simpan pesan sukses
$_SESSION['success'] = "Pengajuan berhasil dikirim";

// pindah ke halaman konfirmasi
header("Location: konfirmasi.php");
exit;
