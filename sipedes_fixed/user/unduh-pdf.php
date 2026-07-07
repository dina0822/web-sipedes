<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['nik'])) {
  header("Location: login.html");
  exit;
}

$nik = mysqli_real_escape_string($conn, $_SESSION['nik']);
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$query = mysqli_query($conn, "
  SELECT p.*, u.email, u.nama_lengkap, u.tempat_lahir, u.tanggal_lahir, u.kelamin, u.alamat, u.rt, u.rw, u.kelurahan
  FROM pengajuan p
  JOIN user u ON u.nik = p.nik
  WHERE p.id = '$id' AND p.nik = '$nik'
  LIMIT 1
");

$data = $query ? mysqli_fetch_assoc($query) : null;

if (!$data) {
  http_response_code(404);
  echo "Pengajuan tidak ditemukan.";
  exit;
}

if (strtolower(trim((string) $data['cara_ambil'])) !== 'unduh pdf') {
  http_response_code(403);
  echo "Pengajuan ini dipilih untuk diambil di kantor desa, jadi PDF tidak tersedia.";
  exit;
}

function e($value) {
  $value = trim((string) ($value ?? ''));
  return htmlspecialchars($value !== '' ? $value : '-', ENT_QUOTES, 'UTF-8');
}

function formatTanggal($value) {
  if (empty($value) || $value === '0000-00-00') {
    return '-';
  }

  $timestamp = strtotime($value);
  return $timestamp ? date('d-m-Y', $timestamp) : $value;
}

function dokumenStatus($filename) {
  return !empty($filename) ? 'Terlampir (' . $filename . ')' : '-';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Pengajuan #<?= e($data['id']) ?></title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      background: #f3f4f6;
      color: #111827;
      font-family: "Times New Roman", serif;
    }

    .toolbar {
      position: sticky;
      top: 0;
      background: #7c3aed;
      color: white;
      padding: 14px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-family: "Segoe UI", Arial, sans-serif;
    }

    .toolbar button {
      border: none;
      background: white;
      color: #7c3aed;
      border-radius: 8px;
      padding: 10px 14px;
      font-weight: 700;
      cursor: pointer;
    }

    .page {
      width: 210mm;
      min-height: 297mm;
      margin: 24px auto;
      background: white;
      padding: 24mm 22mm;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }

    .kop {
      text-align: center;
      border-bottom: 3px double #111827;
      padding-bottom: 14px;
      margin-bottom: 28px;
    }

    .kop h1 {
      font-size: 20px;
      margin: 0 0 4px;
      text-transform: uppercase;
    }

    .kop h2 {
      font-size: 18px;
      margin: 0 0 6px;
      text-transform: uppercase;
    }

    .kop p,
    .content p {
      margin: 0;
      line-height: 1.6;
      font-size: 15px;
    }

    .title {
      text-align: center;
      margin-bottom: 24px;
    }

    .title h3 {
      display: inline-block;
      border-bottom: 1px solid #111827;
      margin: 0 0 6px;
      font-size: 17px;
      text-transform: uppercase;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 16px 0;
      font-size: 15px;
    }

    td {
      padding: 5px 0;
      vertical-align: top;
    }

    td:first-child {
      width: 170px;
    }

    td:nth-child(2) {
      width: 16px;
    }

    .signature {
      width: 260px;
      margin-left: auto;
      margin-top: 46px;
      text-align: center;
      font-size: 15px;
    }

    .signature-space {
      height: 72px;
    }

    .letterhead-info {
      display: flex;
      justify-content: space-between;
      margin: 20px 0 24px;
      font-size: 15px;
    }

    .letterhead-info table td {
      padding: 1px 6px 1px 0;
      vertical-align: top;
    }

    .letterhead-info table td:first-child {
      width: 80px;
    }

    .letterhead-info .kepada {
      text-align: right;
      font-size: 15px;
    }

    .letterhead-info .kepada p {
      margin: 0;
      line-height: 1.5;
    }

    .content p.paragraf {
      text-align: justify;
      margin-bottom: 12px;
    }

    .identity-list {
      margin: 14px 0 14px 20px;
    }

    .identity-list td {
      padding: 3px 0;
      vertical-align: top;
      font-size: 15px;
    }

    .identity-list td:first-child {
      width: 190px;
    }

    .identity-list td:nth-child(2) {
      width: 16px;
    }

    @media print {
      body {
        background: white;
      }

      .toolbar {
        display: none;
      }

      .page {
        margin: 0;
        width: auto;
        min-height: auto;
        box-shadow: none;
        padding: 18mm;
      }
    }
  </style>
</head>
<body>
  <div class="toolbar">
    <span>Surat Pengajuan #<?= e($data['id']) ?></span>
    <button type="button" onclick="window.print()">Unduh / Simpan PDF</button>
  </div>

  <main class="page">
    <header class="kop">
      <h1>Pemerintah Desa Ciamis</h1>
      <h2>SiPeDes</h2>
      <p>Pelayanan Surat Desa Online</p>
    </header>

    <section class="title">
      <h3>Surat Keterangan Domisili</h3>
    </section>

    <div class="letterhead-info">
      <table>
        <tr>
          <td>Nomor</td>
          <td>: <?= e($data['id']) ?>/SIPEDES/DS-CIAMIS/<?= date('Y') ?></td>
        </tr>
        <tr>
          <td>Lampiran</td>
          <td>: -</td>
        </tr>
        <tr>
          <td>Perihal</td>
          <td>: <?= e($data['jenis_surat']) ?></td>
        </tr>
      </table>

      <div class="kepada">
        <p>Kepada Yth.</p>
        <p><strong><?= e($data['instansi']) ?></strong></p>
        <p>Di tempat</p>
      </div>
    </div>

    <section class="content">
      <p class="paragraf">Yang bertanda tangan di bawah ini, Kepala Desa Ciamis, dengan ini menerangkan dengan sebenarnya bahwa:</p>

      <table class="identity-list">
        <tr>
          <td>Nama Lengkap</td>
          <td>:</td>
          <td><?= e($data['nama_lengkap']) ?></td>
        </tr>
        <tr>
          <td>NIK</td>
          <td>:</td>
          <td><?= e($data['nik']) ?></td>
        </tr>
        <tr>
          <td>Tempat/Tanggal Lahir</td>
          <td>:</td>
          <td><?= e($data['tempat_lahir']) ?>, <?= e(formatTanggal($data['tanggal_lahir'])) ?></td>
        </tr>
        <tr>
          <td>Jenis Kelamin</td>
          <td>:</td>
          <td><?= e($data['kelamin']) ?></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td><?= e($data['alamat']) ?>, RT <?= e($data['rt']) ?>/RW <?= e($data['rw']) ?>, <?= e($data['kelurahan']) ?></td>
        </tr>
      </table>

      <p class="paragraf">
        adalah benar warga yang berdomisili di wilayah Desa Ciamis sesuai dengan alamat tersebut di atas.
        Surat keterangan ini dibuat untuk keperluan <strong><?= e($data['tujuan']) ?></strong>,
        guna diajukan kepada <strong><?= e($data['instansi']) ?></strong>.
      </p>

      <?php if (trim((string) $data['keterangan']) !== ''): ?>
        <p class="paragraf">Keterangan tambahan: <?= e($data['keterangan']) ?>.</p>
      <?php endif; ?>

      <p class="paragraf">Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
    </section>

    <section class="signature">
      <p>Ciamis, <?= date('d-m-Y') ?></p>
      <p>Kepala Desa Ciamis</p>
      <div class="signature-space"></div>
      <p><strong>( ________ )</strong></p>
    </section>
  </main>

  <script>
    window.addEventListener("load", () => {
      setTimeout(() => window.print(), 400);
    });
  </script>
</body>
</html>