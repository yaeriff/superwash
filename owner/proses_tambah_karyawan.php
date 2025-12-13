<?php
include '../koneksi.php';

$id       = $_POST['id_karyawan'];
$nama     = $_POST['nama'];
$nohp     = $_POST['nohp'];
$alamat   = $_POST['alamat'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = "INSERT INTO karyawan (id_karyawan, nama, nohp, alamat, username, password) 
          VALUES ('$id', '$nama', '$nohp', '$alamat', '$username', '$password')";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
            alert('Data Berhasil Disimpan!');
            window.location.href='karyawan.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal Menyimpan Data: " . mysqli_error($koneksi) . "');
            window.location.href='addkaryawan.php';
          </script>";
}
?>