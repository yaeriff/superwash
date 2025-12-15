<?php
session_start();
include '../koneksi.php';

$user_id = $_POST['user_id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$no_tlpn = $_POST['no_tlpn'];

$query = "UPDATE user SET nama='$nama', username='$username', password='$password', no_tlpn='$no_tlpn' WHERE user_id='$user_id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../../admin/karyawan.php?success=1");
} else {
    echo "<script>alert('Gagal mengupdate karyawan'); window.history.back();</script>";
}
?>
