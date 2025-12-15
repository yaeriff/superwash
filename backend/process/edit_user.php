<?php
include '../koneksi.php';

$user_id = mysqli_real_escape_string($koneksi, $_POST['user_id']);
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);
$no_tlpn = mysqli_real_escape_string($koneksi, $_POST['no_tlpn']);
$role = mysqli_real_escape_string($koneksi, $_POST['role']);

$query = "UPDATE user SET nama='$nama', username='$username', password='$password', 
          no_tlpn='$no_tlpn', role='$role' WHERE user_id='$user_id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../../admin/index.php?success=1");
} else {
    echo "<script>alert('Gagal mengupdate user'); window.history.back();</script>";
}
?>
