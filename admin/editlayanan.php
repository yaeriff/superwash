<?php
session_start();
include '../backend/koneksi.php';
include '../backend/helpers/auth.php';

checkRole('admin');

$layanan_id = $_GET['id'] ?? '';
if (empty($layanan_id)) {
    header("Location: layanan.php");
    exit;
}

$query = mysqli_query($koneksi, "SELECT * FROM layanan WHERE layanan_id='$layanan_id'");
if (mysqli_num_rows($query) == 0) {
    header("Location: layanan.php");
    exit;
}

$layanan = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Layanan - Super Wash Admin</title>
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
                <a href="layanan.php" class="active">
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
                <h1 class="page-title">Edit Layanan</h1>
                <a href="../logout.php" class="logout-btn">Logout</a>
            </header>

            <div class="content">
                <a href="layanan.php" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>

                <div class="form-card">
                    <h2><i class="fa-solid fa-edit"></i> Form Edit Layanan</h2>

                    <form action="../backend/process/edit_layanan.php" method="POST">
                        <!-- HIDDEN: Layanan ID (tidak ditampilkan, hanya untuk sistem) -->
                        <input type="hidden" name="layanan_id" value="<?php echo $layanan['layanan_id']; ?>">

                        <div class="form-group">
                            <label for="layanan_id_display">Layanan ID (Tidak bisa diubah)</label>
                            <input type="text" id="layanan_id_display" value="<?php echo htmlspecialchars($layanan['layanan_id']); ?>" disabled style="background-color: #f0f0f0; cursor: not-allowed;">
                            <small style="color: #666; display: block; margin-top: 5px;">ID layanan sudah ditentukan oleh sistem dan tidak dapat diubah</small>
                        </div>

                        <div class="form-group">
                            <label for="nama_layanan">Nama Layanan *</label>
                            <input type="text" id="nama_layanan" name="nama_layanan" value="<?php echo htmlspecialchars($layanan['nama_layanan']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="harga_satuan">Harga per kg (Rp) *</label>
                            <input type="number" id="harga_satuan" name="harga_satuan" value="<?php echo $layanan['harga_satuan']; ?>" min="1000" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" style="resize: vertical;"><?php echo htmlspecialchars($layanan['deskripsi'] ?? ''); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Status Layanan *</label>
                            <div style="display: flex; gap: 20px;">
                                <label style="display: flex; align-items: center; gap: 8px;">
                                    <input type="radio" name="aktif" value="Y" <?php echo $layanan['aktif'] == 'Y' ? 'checked' : ''; ?> required>
                                    <span>✓ Aktif</span>
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px;">
                                    <input type="radio" name="aktif" value="N" <?php echo $layanan['aktif'] == 'N' ? 'checked' : ''; ?> required>
                                    <span>✗ Nonaktif</span>
                                </label>
                            </div>
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
