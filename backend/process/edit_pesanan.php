<?php
session_start();
include '../koneksi.php';
include '../helpers/auth.php';

checkRole('karyawan');

// Validasi input
$pemesanan_id = $_POST['pemesanan_id'] ?? '';
$user_id = $_POST['user_id'] ?? '';
$nama_pemesan = $_POST['nama_pemesan'] ?? '';
$no_pemesan = $_POST['no_pemesan'] ?? '';
$layanan_id = $_POST['layanan_id'] ?? '';
$jumlah_berat = $_POST['jumlah_berat'] ?? 0;
$tanggal_pemesanan = $_POST['tanggal_pemesanan'] ?? date('Y-m-d');
$metode_bayar = $_POST['metode_bayar'] ?? '';
$status = $_POST['status'] ?? 'pending';

// Cek pesanan milik user
$check_query = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE pemesanan_id='$pemesanan_id' AND user_id='$user_id'");
if (mysqli_num_rows($check_query) == 0) {
    die('Pesanan tidak ditemukan atau bukan milik Anda');
}

// Cek layanan untuk hitung harga
$layanan_query = mysqli_query($koneksi, "SELECT harga_satuan FROM layanan WHERE layanan_id='$layanan_id'");
$layanan = mysqli_fetch_assoc($layanan_query);

if (!$layanan) {
    die('Layanan tidak ditemukan');
}

// Hitung total bayar
$harga_per_kg = $layanan['harga_satuan'] ?? 0;
$total_bayar = $jumlah_berat * $harga_per_kg;

// Update database
$query = "UPDATE pemesanan SET 
          nama_pemesan='$nama_pemesan', 
          no_pemesan='$no_pemesan', 
          layanan_id='$layanan_id', 
          jumlah_berat='$jumlah_berat', 
          tanggal_pemesanan='$tanggal_pemesanan', 
          total_bayar='$total_bayar', 
          metode_bayar='$metode_bayar', 
          status='$status'
          WHERE pemesanan_id='$pemesanan_id' AND user_id='$user_id'";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(['status' => 'success', 'message' => 'Pesanan berhasil diperbarui']);
    header('Location: ../../karyawan/pesanan.php');
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($koneksi)]);
}
?>
