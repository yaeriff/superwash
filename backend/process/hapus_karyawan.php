<?php
session_start();
include '../koneksi.php';
include '../helpers/auth.php';

checkRole('owner');

// Validasi input
$user_id = mysqli_real_escape_string($koneksi, $_POST['user_id'] ?? '');

if (empty($user_id)) {
    echo json_encode(['status' => 'error', 'message' => 'User ID tidak valid']);
    exit;
}

// Cek apakah karyawan ada
$check = mysqli_query($koneksi, "SELECT user_id FROM user WHERE user_id='$user_id' AND role='karyawan'");
if (mysqli_num_rows($check) == 0) {
    echo json_encode(['status' => 'error', 'message' => 'Karyawan tidak ditemukan']);
    exit;
}

// Delete karyawan
$query = "DELETE FROM user WHERE user_id='$user_id' AND role='karyawan'";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(['status' => 'success', 'message' => 'Karyawan berhasil dihapus']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($koneksi)]);
}
?>
