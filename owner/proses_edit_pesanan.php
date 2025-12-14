<?php
include '../koneksi.php';

$kode_booking   = $_POST['kode_booking'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$no_handphone   = $_POST['no_handphone'];
$tanggal        = $_POST['tanggal'];
$nama_paket     = $_POST['nama_paket'];
$jenis_cuci     = $_POST['jenis_cuci'];
$jumlah         = $_POST['jumlah'];
$estimasi       = $_POST['estimasi'];
$total_harga    = $_POST['total_harga'];

$query = "UPDATE pemesanan SET 
            nama_pelanggan = '$nama_pelanggan',
            no_handphone   = '$no_handphone',
            tanggal        = '$tanggal',
            nama_paket     = '$nama_paket',
            jenis_cuci     = '$jenis_cuci',
            jumlah         = '$jumlah',
            estimasi       = '$estimasi',
            total_harga    = '$total_harga'
          WHERE kode_booking = '$kode_booking'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
            alert('Data Pesanan Berhasil Diupdate!');
            window.location.href='pesanan.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal Update Data: " . mysqli_error($koneksi) . "');
            window.location.href='editpesanan.php?id=$kode_booking';
          </script>";
}
?>