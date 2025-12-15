<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';
checkRole('karyawan');

$user_id = $_SESSION['user_id'];

// Get layanan untuk dropdown
$layanan_query = mysqli_query($koneksi, "SELECT * FROM layanan ORDER BY nama_layanan ASC");
$layanan_list = mysqli_fetch_all($layanan_query, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pesanan - Super Wash Karyawan</title>
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
                <a href="pesanan.php" class="active">
                    <i class="fa-solid fa-shopping-cart"></i> <span>Pesanan</span>
                </a>
                <a href="transaksi.php">
                    <i class="fa-solid fa-wallet"></i> <span>Transaksi</span>
                </a>
            </nav>
        </aside>
        <main class="main-content">
            <header class="top-bar">
                <h1 class="page-title">Tambah Pesanan</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>
            <div class="content">
                <a href="pesanan.php" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <div class="form-card">
                    <h2><i class="fa-solid fa-plus-circle"></i> Tambah Pesanan Baru</h2>
                    <form action="../backend/process/tambah_pesanan.php" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        
                        <div class="form-group">
                            <label for="nama_pemesan">Nama Pelanggan</label>
                            <input type="text" id="nama_pemesan" name="nama_pemesan" placeholder="Masukkan nama pelanggan" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="no_pemesan">No. Telepon Pelanggan</label>
                            <input type="text" id="no_pemesan" name="no_pemesan" placeholder="08123456789" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="layanan_id">Layanan</label>
                            <select id="layanan_id" name="layanan_id" required>
                                <option value="">-- Pilih Layanan --</option>
                                <?php foreach ($layanan_list as $layanan) { ?>
                                <option value="<?php echo $layanan['layanan_id']; ?>">
                                    <?php echo htmlspecialchars($layanan['nama_layanan']); ?> - Rp <?php echo number_format($layanan['harga_satuan'], 0, ',', '.'); ?>/kg
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="jumlah_berat">Berat (kg)</label>
                            <input type="number" id="jumlah_berat" name="jumlah_berat" placeholder="0" min="0" step="0.1" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                            <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="metode_bayar">Metode Pembayaran</label>
                            <select id="metode_bayar" name="metode_bayar" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="tunai">Tunai</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="ewallet">E-Wallet</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <i class="fa-solid fa-save"></i> Simpan
                            </button>
                            <button type="reset" class="btn-clear">
                                <i class="fa-solid fa-redo"></i> Bersihkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <footer class="footer">
                <i class="fa-solid fa-box"></i> Kelompok 4 2025
            </footer>
        </main>
    </div>
</body>
</html>
