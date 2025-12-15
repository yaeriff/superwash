<?php
include '../koneksi.php';

// Validasi input
$layanan_id = mysqli_real_escape_string($koneksi, $_POST['layanan_id'] ?? '');
$nama_layanan = mysqli_real_escape_string($koneksi, $_POST['nama_layanan'] ?? '');
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi'] ?? '');
$harga_satuan = mysqli_real_escape_string($koneksi, $_POST['harga_satuan'] ?? '');
$aktif = mysqli_real_escape_string($koneksi, $_POST['aktif'] ?? 'Y');

// Cek input kosong
if (empty($layanan_id) || empty($nama_layanan) || empty($harga_satuan)) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
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

// Update database
$query = "UPDATE layanan SET nama_layanan='$nama_layanan', deskripsi='$deskripsi', 
          harga_satuan='$harga_satuan', aktif='$aktif' WHERE layanan_id='$layanan_id'";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(['status' => 'success', 'message' => 'Layanan berhasil diupdate']);
    header("Location: ../../admin/layanan.php?success=1");
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($koneksi)]);
}
?>
