<?php
include '../koneksi.php';

$user_id = $_GET['id'];

$query = "DELETE FROM user WHERE user_id='$user_id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../../admin/index.php?success=1");
} else {
    echo "<script>alert('Gagal menghapus user'); window.history.back();</script>";
}
?>
