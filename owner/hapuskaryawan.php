<?php
include '../koneksi.php';
$id = $_GET['id'];

$query = "DELETE FROM karyawan WHERE id_karyawan = '$id'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
            alert('Data Berhasil Dihapus!');
            window.location.href='karyawan.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal Menghapus Data: " . mysqli_error($koneksi) . "');
            window.location.href='karyawan.php';
          </script>";
}
?>