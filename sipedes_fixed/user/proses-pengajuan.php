<?php
session_start();
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: formulir.html");
    exit;
}

if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit;
}

$id_user = intval($_SESSION['id']);

$jenis_slug = $_POST['jenis_surat'] ?? '';
$jenis_surat = $_POST['jenis_surat_label'];
$tujuan = $_POST['keperluan'];
$instansi = $_POST['instansi'] ?? '';
$keterangan = $_POST['keterangan'] ?? '';
$cara_ambil = $_POST['cara_ambil'];

// Data diri yang diisi user di formulir-step1.html
$nik = $_POST['nik'] ?? '';
$nama = $_POST['nama_lengkap'] ?? '';
$tempat_lahir = $_POST['tempat_lahir'] ?? '';
$tanggal_lahir_input = $_POST['tanggal_lahir'] ?? '';
$tanggal_lahir = !empty($tanggal_lahir_input) ? $tanggal_lahir_input : null;
$kelamin = $_POST['kelamin'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$rt = $_POST['rt'] ?? '';
$rw = $_POST['rw'] ?? '';
$kelurahan = $_POST['kelurahan'] ?? '';

if ($jenis_slug === '') {
    $slug_map = [
        'Surat Domisili' => 'domisili',
        'Pengantar KTP / KK' => 'ktp',
        'Surat Keterangan Usaha' => 'usaha',
        'Surat Ahli Waris' => 'waris',
        'Surat Tidak Mampu' => 'tidakmampu',
    ];

    $jenis_slug = $slug_map[$jenis_surat] ?? '';
}

// Lengkapi/perbarui profil user dengan data diri yang baru diisi,
// supaya dashboard & pengajuan berikutnya sudah punya NIK.
$nik_db = mysqli_real_escape_string($conn, $nik);
$nama_db = mysqli_real_escape_string($conn, $nama);
$tempat_db = mysqli_real_escape_string($conn, $tempat_lahir);
$tanggal_db = $tanggal_lahir ? mysqli_real_escape_string($conn, $tanggal_lahir) : null;
$kelamin_db = mysqli_real_escape_string($conn, $kelamin);
$alamat_db = mysqli_real_escape_string($conn, $alamat);
$rt_db = mysqli_real_escape_string($conn, $rt);
$rw_db = mysqli_real_escape_string($conn, $rw);
$kelurahan_db = mysqli_real_escape_string($conn, $kelurahan);

$updateProfil = "UPDATE user SET
    nik='$nik_db',
    nama_lengkap='$nama_db',
    tempat_lahir='$tempat_db',
    tanggal_lahir=" . ($tanggal_db ? "'$tanggal_db'" : "NULL") . ",
    kelamin='$kelamin_db',
    alamat='$alamat_db',
    rt='$rt_db',
    rw='$rw_db',
    kelurahan='$kelurahan_db'
    WHERE id='$id_user'";
mysqli_query($conn, $updateProfil);

// Sinkronkan session supaya halaman lain (dashboard, konfirmasi) langsung update
$_SESSION['nik'] = $nik;
$_SESSION['nama'] = $nama;
$_SESSION['alamat'] = $alamat;
$_SESSION['rt'] = $rt;
$_SESSION['rw'] = $rw;
$_SESSION['jenis_surat'] = $jenis_surat;
$_SESSION['jenis_surat_slug'] = $jenis_slug;
$_SESSION['keperluan'] = $tujuan;
$_SESSION['cara_ambil'] = $cara_ambil;

$nik_pengajuan = mysqli_real_escape_string($conn, $nik);
$jenis_surat_esc = mysqli_real_escape_string($conn, $jenis_surat);
$tujuan_esc = mysqli_real_escape_string($conn, $tujuan);
$instansi_esc = mysqli_real_escape_string($conn, $instansi);
$keterangan_esc = mysqli_real_escape_string($conn, $keterangan);
$cara_ambil_esc = mysqli_real_escape_string($conn, $cara_ambil);

$query = "INSERT INTO pengajuan (nik, jenis_surat, tujuan, instansi, keterangan, cara_ambil)
VALUES ('$nik_pengajuan', '$jenis_surat_esc', '$tujuan_esc', '$instansi_esc', '$keterangan_esc', '$cara_ambil_esc')";

if (mysqli_query($conn, $query)) {
    $_SESSION['id_pengajuan'] = mysqli_insert_id($conn);
    header("Location: formulir-step2.html?jenis=" . urlencode($jenis_slug));
    exit;
} else {
    echo "Gagal: " . mysqli_error($conn);
}
