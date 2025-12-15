<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';
checkRole('karyawan');

$user_id = $_SESSION['user_id'];
$pesanan_id = $_GET['id'] ?? '';

if (empty($pesanan_id)) {
    header("Location: pesanan.php");
    exit;
}

// Cek pesanan milik user
$query = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE pemesanan_id='$pesanan_id' AND user_id='$user_id'");
if (mysqli_num_rows($query) == 0) {
    header("Location: pesanan.php");
    exit;
}

$pesanan = mysqli_fetch_assoc($query);

// Get layanan untuk dropdown
$layanan_query = mysqli_query($koneksi, "SELECT * FROM layanan ORDER BY nama_layanan ASC");
$layanan_list = mysqli_fetch_all($layanan_query, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan - Super Wash Karyawan</title>
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
                <img src="../img/superwashlogo.png" alt="Logo" />
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
                <h1 class="page-title">Edit Pesanan</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>
            <div class="content">
                <a href="pesanan.php" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <div class="form-card">
                    <h2><i class="fa-solid fa-edit"></i> Edit Pesanan</h2>
                    <form action="../backend/process/edit_pesanan.php" method="POST">
                        <input type="hidden" name="pemesanan_id" value="<?php echo $pesanan['pemesanan_id']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        
                        <div class="form-group">
                            <label for="nama_pemesan">Nama Pelanggan</label>
                            <input type="text" id="nama_pemesan" name="nama_pemesan" value="<?php echo htmlspecialchars($pesanan['nama_pemesan']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="no_pemesan">No. Telepon Pelanggan</label>
                            <input type="text" id="no_pemesan" name="no_pemesan" value="<?php echo htmlspecialchars($pesanan['no_pemesan']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="layanan_id">Layanan</label>
                            <select id="layanan_id" name="layanan_id" required>
                                <option value="">-- Pilih Layanan --</option>
                                <?php foreach ($layanan_list as $layanan) { ?>
                                <option value="<?php echo $layanan['layanan_id']; ?>" <?php echo ($layanan['layanan_id'] == $pesanan['layanan_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($layanan['nama_layanan']); ?> - Rp <?php echo number_format($layanan['harga_per_kg'], 0, ',', '.'); ?>/kg
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="jumlah_berat">Berat (kg)</label>
                            <input type="number" id="jumlah_berat" name="jumlah_berat" value="<?php echo $pesanan['jumlah_berat']; ?>" min="0" step="0.1" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                            <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" value="<?php echo $pesanan['tanggal_pemesanan']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="metode_bayar">Metode Pembayaran</label>
                            <select id="metode_bayar" name="metode_bayar" required>
                                <option value="tunai" <?php echo ($pesanan['metode_bayar'] == 'tunai') ? 'selected' : ''; ?>>Tunai</option>
                                <option value="transfer" <?php echo ($pesanan['metode_bayar'] == 'transfer') ? 'selected' : ''; ?>>Transfer Bank</option>
                                <option value="kartu_kredit" <?php echo ($pesanan['metode_bayar'] == 'kartu_kredit') ? 'selected' : ''; ?>>Kartu Kredit</option>
                                <option value="e_wallet" <?php echo ($pesanan['metode_bayar'] == 'e_wallet') ? 'selected' : ''; ?>>E-Wallet</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" required>
                                <option value="pending" <?php echo ($pesanan['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="diproses" <?php echo ($pesanan['status'] == 'diproses') ? 'selected' : ''; ?>>Diproses</option>
                                <option value="selesai" <?php echo ($pesanan['status'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
                            </select>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <i class="fa-solid fa-save"></i> Simpan Perubahan
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
