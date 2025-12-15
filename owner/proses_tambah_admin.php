<?php
session_start();
include '../backend/koneksi.php';

if ($_SESSION['role'] != 'owner') {
    header("Location: ../login.php?pesan=gagal");
    exit;
}

$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);
$no_tlpn = mysqli_real_escape_string($koneksi, $_POST['no_tlpn']);

$query = "INSERT INTO user (nama, username, password, no_tlpn, role) 
          VALUES ('$nama', '$username', '$password', '$no_tlpn', 'admin')";

if (mysqli_query($koneksi, $query)) {
    header("Location: user_admin.php?success=1");
} else {
    echo "<script>alert('Gagal menambah admin'); window.history.back();</script>";
}
?>
