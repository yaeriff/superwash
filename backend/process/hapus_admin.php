<?php
session_start();
include '../koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM karyawan WHERE id_karyawan='$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../../owner/user_admin.php?success=1");
} else {
    echo "<script>alert('Gagal menghapus admin'); window.history.back();</script>";
}
?>
