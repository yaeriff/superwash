<?php
include '../koneksi.php';

$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);
$no_tlpn = mysqli_real_escape_string($koneksi, $_POST['no_tlpn']);
$role = mysqli_real_escape_string($koneksi, $_POST['role']);

$query = "INSERT INTO user (nama, username, password, no_tlpn, role) 
          VALUES ('$nama', '$username', '$password', '$no_tlpn', '$role')";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../../admin/index.php?success=1");
} else {
    echo "<script>alert('Gagal menambah user'); window.history.back();</script>";
}
?>
