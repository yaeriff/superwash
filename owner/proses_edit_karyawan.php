<?php
include '../koneksi.php';

$id       = $_POST['id_karyawan'];
$nama     = $_POST['nama'];
$nohp     = $_POST['nohp'];
$alamat   = $_POST['alamat'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = "UPDATE karyawan SET 
            nama = '$nama',
            nohp = '$nohp',
            alamat = '$alamat',
            username = '$username',
            password = '$password'
          WHERE id_karyawan = '$id'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
            alert('Data Berhasil Diupdate!');
            window.location.href='karyawan.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal Update Data: " . mysqli_error($koneksi) . "');
            window.location.href='editkaryawan.php?id=$id';
          </script>";
}
?>