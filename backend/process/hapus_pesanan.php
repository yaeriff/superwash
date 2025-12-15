<?php
session_start();
include '../koneksi.php';
include '../helpers/auth.php';

checkRole('karyawan');

$pemesanan_id = $_POST['pemesanan_id'] ?? '';
$user_id = $_SESSION['user_id'];

// Cek pesanan milik user
$check_query = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE pemesanan_id='$pemesanan_id' AND user_id='$user_id'");
if (mysqli_num_rows($check_query) == 0) {
    echo json_encode(['status' => 'error', 'message' => 'Pesanan tidak ditemukan']);
    exit;
}

// Delete
$query = "DELETE FROM pemesanan WHERE pemesanan_id='$pemesanan_id' AND user_id='$user_id'";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(['status' => 'success', 'message' => 'Pesanan berhasil dihapus']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($koneksi)]);
}
?>
