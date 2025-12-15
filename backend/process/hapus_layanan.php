<?php
include '../koneksi.php';
include '../helpers/auth.php';

checkRole('admin');

// Validasi input
$layanan_id = mysqli_real_escape_string($koneksi, $_POST['layanan_id'] ?? '');

if (empty($layanan_id)) {
    echo json_encode(['status' => 'error', 'message' => 'ID layanan tidak valid']);
    exit;
}

// Cek apakah layanan ada
$check = mysqli_query($koneksi, "SELECT layanan_id FROM layanan WHERE layanan_id='$layanan_id'");
if (mysqli_num_rows($check) == 0) {
    echo json_encode(['status' => 'error', 'message' => 'Layanan tidak ditemukan']);
    exit;
}

// Delete layanan
$query = "DELETE FROM layanan WHERE layanan_id='$layanan_id'";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(['status' => 'success', 'message' => 'Layanan berhasil dihapus']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($koneksi)]);
}
?>
