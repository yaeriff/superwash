<?php
session_start();
include '../koneksi.php';
include '../helpers/auth.php';

checkRole('karyawan');

// Validasi input
$user_id = $_POST['user_id'] ?? '';
$nama_pemesan = $_POST['nama_pemesan'] ?? '';
$no_pemesan = $_POST['no_pemesan'] ?? '';
$layanan_id = $_POST['layanan_id'] ?? '';
$jumlah_berat = $_POST['jumlah_berat'] ?? 0;
$tanggal_pemesanan = $_POST['tanggal_pemesanan'] ?? date('Y-m-d');
$metode_bayar = $_POST['metode_bayar'] ?? '';
$status = $_POST['status'] ?? 'pending';

// Cek layanan untuk hitung harga
$layanan_query = mysqli_query($koneksi, "SELECT harga_satuan FROM layanan WHERE layanan_id='$layanan_id'");
$layanan = mysqli_fetch_assoc($layanan_query);

if (!$layanan) {
    die('Layanan tidak ditemukan');
}

// Hitung total bayar
$harga_per_kg = $layanan['harga_satuan'] ?? 0;
$total_bayar = $jumlah_berat * $harga_per_kg;

// Buat ID pesanan (Random 5 karakter)
$pemesanan_id = strtoupper(substr(uniqid(), -5));


// Insert ke database
$query = "INSERT INTO pemesanan (pemesanan_id, user_id, nama_pemesan, no_pemesan, layanan_id, jumlah_berat, tanggal_pemesanan, total_bayar, metode_bayar, status) 
          VALUES ('$pemesanan_id', '$user_id', '$nama_pemesan', '$no_pemesan', '$layanan_id', '$jumlah_berat', '$tanggal_pemesanan', '$total_bayar', '$metode_bayar', '$status')";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(['status' => 'success', 'message' => 'Pesanan berhasil ditambahkan']);
    header('Location: ../../karyawan/pesanan.php');
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($koneksi)]);
}
?>
