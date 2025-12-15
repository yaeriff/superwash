<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';

checkRole('karyawan');

// Get all layanan
$query = mysqli_query($koneksi, "SELECT * FROM layanan ORDER BY nama_layanan ASC");
$layanan_list = mysqli_fetch_all($query, MYSQLI_ASSOC);

$page = 'layanan';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan - Super Wash Karyawan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="logo-area">
                <img src="../img/superwashlogo.png" alt="Logo" />
            </div>
            <nav class="menu">
                <a href="index.php">
                    <i class="fa-solid fa-home"></i> <span>Beranda</span>
                </a>
                <a href="transaksi.php">
                    <i class="fa-solid fa-wallet"></i> <span>Transaksi</span>
                </a>
                <a href="layanan.php" class="active">
                    <i class="fa-solid fa-list"></i> <span>Layanan</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <!-- HEADER -->
            <header class="top-bar">
                <h1 class="page-title">Layanan</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>

            <!-- CONTENT -->
            <div class="content">
                <!-- TABLE CARD -->
                <div class="table-card">
                    <!-- TABLE HEADER -->
                    <div class="table-header">
                        <h2>Daftar Layanan Tersedia</h2>
                    </div>

                    <!-- TABLE -->
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Layanan</th>
                                <th>Harga/kg</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (count($layanan_list) > 0) {
                                $no = 1;
                                foreach ($layanan_list as $row) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nama_layanan']); ?></td>
                                <td>Rp <?php echo number_format($row['harga_satuan'], 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($row['deskripsi'] ?? '-'); ?></td>
                            </tr>
                            <?php 
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 30px; color: #999;">
                                    <i class="fa-solid fa-inbox" style="font-size: 40px; margin-bottom: 10px; display: block;"></i>
                                    Belum ada data layanan
                                </td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- FOOTER -->
            <footer class="footer">
                <i class="fa-solid fa-box"></i> Kelompok 4 2025
            </footer>
        </main>
    </div>
</body>
</html>
