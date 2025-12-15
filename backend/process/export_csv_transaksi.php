<?php
// MULAI DENGAN OUTPUT BUFFER BERSIH
ob_start();
ob_clean();

session_start();
include '../koneksi.php';

// Cek login
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("Location: ../../login.php?pesan=belum_login");
    exit;
}

// FLUSH SEMUA OUTPUT BUFFER SEBELUMNYA
while (@ob_end_clean());

$user_id = $_SESSION['user_id'];

// Set header CSV HARUS SEBELUM OUTPUT APAPUN
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="transaksi_' . date('Y-m-d_H-i-s') . '.csv"');
header('Pragma: no-cache');
header('Expires: 0');

// Query data - hanya status 'selesai'
$query = mysqli_query($koneksi, "
    SELECT p.pemesanan_id, p.nama_pemesan, p.no_pemesan, p.tanggal_pemesanan, 
           l.nama_layanan, p.jumlah_berat, p.total_bayar, p.metode_bayar, u.nama 
    FROM pemesanan p 
    LEFT JOIN layanan l ON p.layanan_id = l.layanan_id 
    LEFT JOIN user u ON p.user_id = u.user_id 
    WHERE p.user_id='$user_id' AND p.status = 'selesai'
    ORDER BY p.tanggal_pemesanan DESC
");

if (!$query) {
    die('Error: ' . mysqli_error($koneksi));
}

// Open output stream
$output = fopen('php://output', 'w');

// UTF-8 BOM untuk Excel support
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Header column
fputcsv($output, array('Kode Booking', 'Nama Pelanggan', 'No. HP', 'Tanggal', 'Layanan', 'Berat (kg)', 'Total Bayar', 'Metode', 'User'));

// Data rows
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        fputcsv($output, array(
            $row['pemesanan_id'],
            $row['nama_pemesan'],
            $row['no_pemesan'],
            $row['tanggal_pemesanan'],
            $row['nama_layanan'] ?? '-',
            $row['jumlah_berat'],
            $row['total_bayar'],
            $row['metode_bayar'],
            $row['nama'] ?? '-'
        ));
    }
}

fclose($output);
exit;
?>
