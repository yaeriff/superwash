<?php
session_start();
include '../koneksi.php';

$id = $_POST['id_karyawan'];
$nama = $_POST['nama'];
$nohp = $_POST['nohp'];
$alamat = $_POST['alamat'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = "UPDATE karyawan SET nama='$nama', nohp='$nohp', alamat='$alamat', 
          username='$username', password='$password' WHERE id_karyawan='$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../../owner/user_admin.php?success=1");
} else {
    echo "<script>alert('Gagal mengupdate admin'); window.history.back();</script>";
}
?>
