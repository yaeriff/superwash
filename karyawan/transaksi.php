<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';
checkRole('karyawan');
$user_id = $_SESSION['user_id'];
$query = mysqli_query($koneksi, "
    SELECT p.pemesanan_id, p.nama_pemesan, p.no_pemesan, p.tanggal_pemesanan, 
           l.nama_layanan, p.jumlah_berat, p.total_bayar, p.status
    FROM pemesanan p 
    LEFT JOIN layanan l ON p.layanan_id = l.layanan_id 
    WHERE p.user_id='$user_id' AND p.status='selesai'
    ORDER BY p.tanggal_pemesanan DESC
");
$transaksi_list = mysqli_fetch_all($query, MYSQLI_ASSOC);
$page = 'transaksi';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Super Wash Karyawan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo-area">
                <img src="../img/superwash_logo.png" alt="Logo" />
            </div>
            <nav class="menu">
                <a href="index.php">
                    <i class="fa-solid fa-home"></i> <span>Beranda</span>
                </a>
                <a href="pesanan.php">
                    <i class="fa-solid fa-shopping-cart"></i> <span>Pesanan</span>
                </a>
                <a href="transaksi.php" class="active">
                    <i class="fa-solid fa-wallet"></i> <span>Transaksi</span>
                </a>
            </nav>
        </aside>
        <main class="main-content">
            <header class="top-bar">
                <h1 class="page-title">Transaksi Saya</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>
            <div class="content">
                <div class="table-card">
                    <div class="table-header">
                        <h2>Daftar Transaksi</h2>
                    </div>
                    <div style="overflow-x: auto;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Layanan</th>
                                    <th>Berat</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (count($transaksi_list) > 0) {
                                    foreach ($transaksi_list as $row) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['pemesanan_id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_pemesan']); ?></td>
                                    <td><?php echo $row['tanggal_pemesanan']; ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_layanan'] ?? '-'); ?></td>
                                    <td><?php echo $row['jumlah_berat']; ?> kg</td>
                                    <td>Rp <?php echo number_format($row['total_bayar'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php 
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 30px; color: #999;">
                                        <i class="fa-solid fa-inbox" style="font-size: 40px; margin-bottom: 10px; display: block;"></i>
                                        Belum ada data transaksi
                                    </td>
                                </tr>
                                <?php 
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <i class="fa-solid fa-box"></i> Kelompok 4 2025
            </footer>
        </main>
    </div>
</body>
</html>
