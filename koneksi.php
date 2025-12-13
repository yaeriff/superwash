<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "superwash_db"; // edit dewe us

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>