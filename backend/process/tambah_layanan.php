<?php
include '../koneksi.php';

// Validasi input
$nama_layanan = mysqli_real_escape_string($koneksi, $_POST['nama_layanan'] ?? '');
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi'] ?? '');
$harga_satuan = mysqli_real_escape_string($koneksi, $_POST['harga_satuan'] ?? '');
$aktif = mysqli_real_escape_string($koneksi, $_POST['aktif'] ?? 'Y');

// Cek input kosong
if (empty($nama_layanan) || empty($harga_satuan)) {
    echo json_encode(['status' => 'error', 'message' => 'Nama layanan dan harga harus diisi!']);
    exit;
}

// Validasi harga adalah angka
if (!is_numeric($harga_satuan) || $harga_satuan < 1000) {
    echo json_encode(['status' => 'error', 'message' => 'Harga harus berupa angka minimal 1000!']);
    exit;
}

// Validasi aktif hanya Y atau N
if (!in_array($aktif, ['Y', 'N'])) {
    $aktif = 'Y';
}

// 🔑 AUTO-GENERATE LAYANAN ID (L001, L002, L003, dll)
$result = mysqli_query($koneksi, "SELECT MAX(CAST(SUBSTRING(layanan_id, 2) AS UNSIGNED)) as max_id FROM layanan WHERE layanan_id LIKE 'L%'");
$row = mysqli_fetch_assoc($result);
$next_id = ($row['max_id'] ?? 0) + 1;
$layanan_id = 'L' . str_pad($next_id, 3, '0', STR_PAD_LEFT);

// Insert ke database DENGAN layanan_id yang sudah di-generate
$query = "INSERT INTO layanan (layanan_id, nama_layanan, deskripsi, harga_satuan, aktif) 
          VALUES ('$layanan_id', '$nama_layanan', '$deskripsi', '$harga_satuan', '$aktif')";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(['status' => 'success', 'message' => 'Layanan berhasil ditambahkan']);
    header("Location: ../../admin/layanan.php?success=1");
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($koneksi)]);
}
?>
