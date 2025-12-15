<?php
session_start();
include '../koneksi.php';

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: ../../login.php?pesan=gagal");
    exit;
}

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    echo "<script>alert('Database Error: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
    exit;
}

$cek = mysqli_num_rows($result);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($result);
    
    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role'];
    $_SESSION['user_id'] = $data['user_id'];
    $_SESSION['status'] = 'login';
    
    if ($data['role'] == 'admin') {
        header("Location: ../../admin/index.php");
    } elseif ($data['role'] == 'owner') {
        header("Location: ../../owner/index.php");
    } elseif ($data['role'] == 'karyawan') {
        header("Location: ../../karyawan/index.php");
    } else {
        header("Location: ../../login.php?pesan=gagal");
    }
} else {
    header("Location: ../../login.php?pesan=gagal");
}
?>
