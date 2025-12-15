<?php
$host = "localhost";
$user = "root";
$pass = "123";
$db   = "db_laundry"; // edit dewe us

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>