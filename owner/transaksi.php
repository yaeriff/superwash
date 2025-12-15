<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';
checkRole('owner');
$start_date = $_GET['start_date'] ?? date('Y-m-01');
$end_date = $_GET['end_date'] ?? date('Y-m-d');
$query = mysqli_query($koneksi, "
    SELECT p.pemesanan_id, p.nama_pemesan, p.no_pemesan, p.tanggal_pemesanan, 
           l.nama_layanan, p.jumlah_berat, p.total_bayar, p.metode_bayar, u.nama 
    FROM pemesanan p 
    LEFT JOIN layanan l ON p.layanan_id = l.layanan_id 
    LEFT JOIN user u ON p.user_id = u.user_id 
    WHERE p.status = 'selesai' 
    AND DATE(p.tanggal_pemesanan) BETWEEN '$start_date' AND '$end_date'
    ORDER BY p.tanggal_pemesanan DESC
");
$transaksi_list = mysqli_fetch_all($query, MYSQLI_ASSOC);
$summary = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT COUNT(*) as total, SUM(total_bayar) as pendapatan 
    FROM pemesanan 
    WHERE status = 'selesai' 
    AND DATE(tanggal_pemesanan) BETWEEN '$start_date' AND '$end_date'
"));
$page = 'transaksi';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Super Wash Owner</title>
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
                <a href="karyawan.php">
                    <i class="fa-solid fa-users"></i> <span>Karyawan</span>
                </a>
                <a href="transaksi.php" class="active">
                    <i class="fa-solid fa-wallet"></i> <span>Transaksi</span>
                </a>
                <a href="pesanan.php">
                    <i class="fa-solid fa-shopping-cart"></i> <span>Pesanan</span>
                </a>
            </nav>
        </aside>
        <main class="main-content">
            <header class="top-bar">
                <h1 class="page-title">Transaksi</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>
            <div class="content">
                <div style="background-color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">
                    <form method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end; flex: 1;">
                        <div>
                            <label style="display: block; font-weight: 600; margin-bottom: 5px; font-size: 13px;">Dari Tanggal</label>
                            <input type="date" name="start_date" value="<?php echo $start_date; ?>" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; margin-bottom: 5px; font-size: 13px;">Sampai Tanggal</label>
                            <input type="date" name="end_date" value="<?php echo $end_date; ?>" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                        </div>
                        <button type="submit" style="background-color: #e67e22; color: white; border: none; padding: 8px 20px; border-radius: 5px; cursor: pointer; font-weight: 600; font-size: 13px;">
                            <i class="fa-solid fa-filter"></i> Filter
                        </button>
                    </form>
                    <a href="export_transaksi.php?start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" style="background-color: #27ae60; color: white; padding: 8px 20px; border-radius: 5px; text-decoration: none; font-weight: 600; font-size: 13px;">
                        <i class="fa-solid fa-download"></i> Export CSV
                    </a>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
                    <div style="background-color: white; padding: 15px; border-radius: 8px; border-left: 4px solid #e67e22;">
                        <h4 style="margin: 0 0 10px 0; color: #666; font-size: 13px;">Total Transaksi</h4>
                        <p style="margin: 0; font-size: 22px; font-weight: 700; color: #1a253a;"><?php echo $summary['total'] ?? 0; ?></p>
                    </div>
                    <div style="background-color: white; padding: 15px; border-radius: 8px; border-left: 4px solid #e67e22;">
                        <h4 style="margin: 0 0 10px 0; color: #666; font-size: 13px;">Total Pendapatan</h4>
                        <p style="margin: 0; font-size: 22px; font-weight: 700; color: #1a253a;">Rp <?php echo number_format($summary['pendapatan'] ?? 0, 0, ',', '.'); ?></p>
                    </div>
                </div>
                <div class="table-card">
                    <div class="table-header">
                        <h2>Data Transaksi</h2>
                    </div>
                    <div style="overflow-x: auto;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Layanan</th>
                                    <th>Berat</th>
                                    <th>Total</th>
                                    <th>Metode</th>
                                    <th>Petugas</th>
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
                                    <td><?php echo ucfirst($row['metode_bayar']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama'] ?? '-'); ?></td>
                                </tr>
                                <?php 
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 30px; color: #999;">
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
