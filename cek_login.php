<?php
session_start();

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE username='$username' AND password='$password'");

$cek = mysqli_num_rows($login);

if($cek > 0){
    $data = mysqli_fetch_assoc($login);

    if($data['role'] == "admin"){

        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = "admin";
        $_SESSION['id_karyawan'] = $data['id_karyawan'];
        $_SESSION['status'] = "login";

        header("location:admin/index.php");

    } else if($data['role'] == "owner"){

        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = "owner";
        $_SESSION['id_karyawan'] = $data['id_karyawan'];
        $_SESSION['status'] = "login";

        header("location:owner/index.php");

    } else {
        header("location:login.php?pesan=gagal");
    }

} else {
    header("location:login.php?pesan=gagal");
}
?>