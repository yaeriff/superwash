<?php
session_start();
include '../backend/koneksi.php';


if ($_SESSION['role'] != 'owner') {
    header("Location: ../login.php?pesan=gagal");
    exit;
}

$user_id = mysqli_real_escape_string($koneksi, $_POST['user_id']);
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);
$no_tlpn = mysqli_real_escape_string($koneksi, $_POST['no_tlpn']);

$query = "UPDATE user SET nama='$nama', username='$username', password='$password', 
          no_tlpn='$no_tlpn' WHERE user_id='$user_id' AND role='admin'";

if (mysqli_query($koneksi, $query)) {
    header("Location: user_admin.php?success=1");
} else {
    echo "<script>alert('Gagal mengupdate admin'); window.history.back();</script>";
}
?>
