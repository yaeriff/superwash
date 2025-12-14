<?php
session_start();

include 'koneksi.php';

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

$role = $_SESSION['role']; 
$halaman_tujuan = $role . '/profile.php'; 

if (mysqli_query($koneksi, $query)) {
    
    $_SESSION['nama'] = $nama;

    echo "<script>
            alert('Profile Berhasil Diupdate!');
            // Redirect dinamis sesuai role
            window.location.href='$halaman_tujuan';
          </script>";
} else {
    echo "<script>
            alert('Gagal Update Profile: " . mysqli_error($koneksi) . "');
            // Redirect dinamis sesuai role
            window.location.href='$halaman_tujuan';
          </script>";
}
?>