<?php
include '../koneksi.php';
include '../helpers/auth.php';

checkRole('admin');

// Validasi input
$layanan_id = mysqli_real_escape_string($koneksi, $_POST['layanan_id'] ?? '');
$aktif = mysqli_real_escape_string($koneksi, $_POST['aktif'] ?? '');

if (empty($layanan_id) || !in_array($aktif, ['Y', 'N'])) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
    exit;
}

// Update status aktif
$query = "UPDATE layanan SET aktif='$aktif' WHERE layanan_id='$layanan_id'";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(['status' => 'success', 'message' => 'Status berhasil diubah']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($koneksi)]);
}
?>
