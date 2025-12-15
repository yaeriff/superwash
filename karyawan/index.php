<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';
checkRole('karyawan');
$user_id = $_SESSION['user_id'];
$transaksi_saya = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE user_id='$user_id' AND status='selesai'"));
$transaksi_hari_ini = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE user_id='$user_id' AND DATE(tanggal_pemesanan) = CURDATE()"));
$total_layanan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM layanan"));
$page = 'index';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Super Wash Karyawan</title>
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
                <a href="index.php" class="active">
                    <i class="fa-solid fa-home"></i> <span>Beranda</span>
                </a>
                <a href="pesanan.php">
                    <i class="fa-solid fa-shopping-cart"></i> <span>Pesanan</span>
                </a>
                <a href="transaksi.php">
                    <i class="fa-solid fa-wallet"></i> <span>Transaksi</span>
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
                                <h4 style="margin: 0 0 10px 0; color: #1a253a; font-size: 14px; font-weight: 500;">Transaksi Saya</h4>
                                <p style="margin: 0; font-size: 28px; font-weight: 700; color: #1a253a;"><?php echo $transaksi_saya; ?></p>
                            </div>
                            <i class="fa-solid fa-wallet" style="font-size: 40px; color: #e67e22;"></i>
                        </div>
                    </div>
                    <div style="background-color: white; padding: 25px; border-radius: 8px; border-left: 5px solid #e67e22; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h4 style="margin: 0 0 10px 0; color: #1a253a; font-size: 14px; font-weight: 500;">Transaksi Hari Ini</h4>
                                <p style="margin: 0; font-size: 28px; font-weight: 700; color: #1a253a;"><?php echo $transaksi_hari_ini; ?></p>
                            </div>
                            <i class="fa-solid fa-shopping-cart" style="font-size: 40px; color: #e67e22;"></i>
                        </div>
                    </div>
                    <div style="background-color: white; padding: 25px; border-radius: 8px; border-left: 5px solid #e67e22; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h4 style="margin: 0 0 10px 0; color: #1a253a; font-size: 14px; font-weight: 500;">Total Layanan</h4>
                                <p style="margin: 0; font-size: 28px; font-weight: 700; color: #1a253a;"><?php echo $total_layanan; ?></p>
                            </div>
                            <i class="fa-solid fa-list" style="font-size: 40px; color: #e67e22;"></i>
                        </div>
                    </div>
                </div>
                <div style="background-color: white; padding: 25px; border-radius: 8px; border-left: 5px solid #ffd700; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                    <h3 style="color: #1a253a; margin-top: 0;">📋 Dashboard Karyawan</h3>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 15px;">Kelola pesanan Anda dan lihat data transaksi serta layanan tersedia.</p>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <a href="pesanan.php" style="background-color: #e67e22; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: 600; font-size: 13px;">Kelola Pesanan</a>
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
