<?php
session_start();
include '../koneksi.php';

// Generate ID Karyawan
$query_id = mysqli_query($koneksi, "SELECT max(user_id) as kodeTerbesar FROM user WHERE role='karyawan'");
$data_id = mysqli_fetch_array($query_id);
$kodeKaryawan = $data_id['kodeTerbesar'];
$urutan = (int) substr($kodeKaryawan, 1, 4);
$urutan++;
$id_karyawan_baru = "K" . sprintf("%04s", $urutan);

// Get Data
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$no_tlpn = $_POST['no_tlpn'];
$role = 'karyawan';

// Insert
$query = "INSERT INTO user (user_id, nama, username, password, no_tlpn, role) 
          VALUES ('$id_karyawan_baru', '$nama', '$username', '$password', '$no_tlpn', '$role')";
if (mysqli_query($koneksi, $query)) {
    header("Location: ../../admin/karyawan.php?success=1");
} else {
    echo "<script>alert('Gagal menambah karyawan'); window.history.back();</script>";
}
?>
