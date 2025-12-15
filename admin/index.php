<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';
checkRole('admin');

// Ganti 'karyawan' dengan 'user' WHERE role='karyawan'
$total_karyawan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user WHERE role='karyawan'"));
$total_layanan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM layanan"));
$total_transaksi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE status='selesai'"));
$pendapatan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total_bayar) as total FROM pemesanan WHERE status='selesai'"));
$total_pendapatan = $pendapatan['total'] ?? 0;
$page = 'index';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Super Wash Admin</title>
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
                <a href="index.php" >
                    <i class="fa-solid fa-home"></i> <span>Beranda</span>
                </a>
                <a href="karyawan.php">
                    <i class="fa-solid fa-users"></i> <span>Karyawan</span>
                </a>
                <a href="layanan.php">
                    <i class="fa-solid fa-list"></i> <span>Layanan</span>
                </a>
                <a href="transaksi.php">
                    <i class="fa-solid fa-wallet"></i> <span>Transaksi</span>
                </a>
                <a href="pesanan.php">
                    <i class="fa-solid fa-shopping-cart"></i> <span>Pesanan</span>
                </a>
            </nav>
        </aside>
        <main class="main-content">
            <header class="top-bar">
                <h1 class="page-title">Beranda</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>
            <div class="content">
                <h2 style="color: #1a253a; margin-bottom: 30px;">Selamat datang, <?php echo htmlspecialchars($_SESSION['nama']); ?> 👋</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
                    <div style="background-color: white; padding: 25px; border-radius: 8px; border-left: 5px solid #e67e22; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; font-weight: 500;">Total Karyawan</h4>
                                <p style="margin: 0; font-size: 28px; font-weight: 700; color: #1a253a;"><?php echo $total_karyawan; ?></p>
                            </div>
                            <i class="fa-solid fa-users" style="font-size: 40px; color: #e67e22; opacity: 0.2;"></i>
                        </div>
                    </div>
                    <div style="background-color: white; padding: 25px; border-radius: 8px; border-left: 5px solid #e67e22; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; font-weight: 500;">Total Layanan</h4>
                                <p style="margin: 0; font-size: 28px; font-weight: 700; color: #1a253a;"><?php echo $total_layanan; ?></p>
                            </div>
                            <i class="fa-solid fa-list" style="font-size: 40px; color: #e67e22; opacity: 0.2;"></i>
                        </div>
                    </div>
                    <div style="background-color: white; padding: 25px; border-radius: 8px; border-left: 5px solid #e67e22; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; font-weight: 500;">Total Transaksi</h4>
                                <p style="margin: 0; font-size: 28px; font-weight: 700; color: #1a253a;"><?php echo $total_transaksi; ?></p>
                            </div>
                            <i class="fa-solid fa-wallet" style="font-size: 40px; color: #e67e22; opacity: 0.2;"></i>
                        </div>
                    </div>
                    <div style="background-color: white; padding: 25px; border-radius: 8px; border-left: 5px solid #e67e22; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; font-weight: 500;">Total Pendapatan</h4>
                                <p style="margin: 0; font-size: 28px; font-weight: 700; color: #1a253a;">Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></p>
                            </div>
                            <i class="fa-solid fa-money-bill-wave" style="font-size: 40px; color: #e67e22; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
                <div style="background-color: white; padding: 25px; border-radius: 8px; border-left: 5px solid #ffd700; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                    <h3 style="color: #1a253a; margin-top: 0;">📊 Panel Admin</h3>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 15px;">Kelola karyawan, layanan, transaksi, dan pesanan dari sini.</p>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <a href="karyawan.php" style="background-color: #e67e22; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: 600; font-size: 13px;">Kelola Karyawan</a>
                        <a href="layanan.php" style="background-color: #e67e22; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: 600; font-size: 13px;">Kelola Layanan</a>
                        <a href="transaksi.php" style="background-color: #e67e22; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: 600; font-size: 13px;">Lihat Transaksi</a>
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
