<?php
session_start();
include '../koneksi.php';

$id = $_POST['id_karyawan'];
$nama = $_POST['nama'];
$nohp = $_POST['nohp'];
$alamat = $_POST['alamat'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = 'admin';

$query = "INSERT INTO karyawan (id_karyawan, nama, nohp, alamat, username, password, role) 
          VALUES ('$id', '$nama', '$nohp', '$alamat', '$username', '$password', '$role')";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../../owner/user_admin.php?success=1");
} else {
    echo "<script>alert('Gagal menambah admin'); window.history.back();</script>";
}
?>
